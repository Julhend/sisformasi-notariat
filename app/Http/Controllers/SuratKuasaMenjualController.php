<?php

namespace App\Http\Controllers;
use Mail;
use App\User;
use App\SuratKuasaMenjual;
use App\Instansi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class SuratKuasaMenjualController extends Controller
{
    public function index()
    {
        $data_peralihan = \App\SuratKuasaMenjual::all();
        return view('suratkuasamenjual.index',['data_peralihan'=> $data_peralihan]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        // $data_klasifikasi = \App\Klasifikasi::all();
        return view('suratkuasamenjual.create');
    }

    //function untuk tambah
     public function tambah (Request $request)
     {
        $request->validate([
            'jenis'   => '|min:5',
            'tgl_pengajuan'   => '|min:5',
        ]);
        $suratkuasamenjual = new SuratKuasaMenjual();
        $suratkuasamenjual->jenis_pengajuan   = $request->input('jenis');
        $suratkuasamenjual->tgl_pengajuan        = $request->input('tgl_pengajuan');
        $suratkuasamenjual->keterangan = $request->input('keterangan');
        $suratkuasamenjual->users_id = Auth::id();
        $suratkuasamenjual->save();
        $userid=$suratkuasamenjual->users->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Pengajuanmu untuk Surat Kuasa Menjual berhasil dikirim', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('/suratkuasamenjual/index')->with("sukses", "Data Surat Kuasa Menjual Berhasil Ditambahkan");

     }
     
    public function update (Request $request, $id)
    {
        $suratkuasamenjual = \App\SuratKuasaMenjual::find($id);
        $suratkuasamenjual->jenis_pengajuan = $request->jenis;
        $suratkuasamenjual->tgl_pengajuan = $request->tgl_pengajuan;
        $suratkuasamenjual->keterangan = $request->keterangan;
        $suratkuasamenjual->update();

        return redirect('suratkuasamenjual/index') ->with('sukses','Data Surat Kuasa Menjual Berhasil Diedit');
    }

      public function see($id)
    {
        $suratkuasamenjual = \App\SuratKuasaMenjual::find($id);
        return view('suratkuasamenjual.upload',['suratkuasamenjual'=>$suratkuasamenjual]);
    }

     public function upload (Request $request,$id)
     {
        $request->validate([
            'ktp_pemberi_kuasa'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'ktp_penerima_kuasa'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'fotokopi_sertifikat'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
        ]);
        $suratkuasamenjual = \App\SuratKuasaMenjual::find($id);
        $file1 = $request->file('ktp_pemberi_kuasa');
        $file2 = $request->file('ktp_penerima_kuasa');
        $file3 = $request->file('fotokopi_sertifikat');
    
        $fileName1   = 'ktp_pemberi_kuasa-'. $file1->getClientOriginalName();
        $fileName2   = 'ktp_penerima_kuasa-'. $file2->getClientOriginalName();
        $fileName3   = 'fotokopi_sertifikat-'. $file3->getClientOriginalName();
   
        $file1->move('datasuratkuasamenjual/', $fileName1);
        $file2->move('datasuratkuasamenjual/', $fileName2);
        $file3->move('datasuratkuasamenjual/', $fileName3);
        $suratkuasamenjual->ktp_pemberi_kuasa  = $fileName1;
        $suratkuasamenjual->ktp_penerima_kuasa  = $fileName2;
        $suratkuasamenjual->fotokopi_sertifikat  = $fileName3;
        $suratkuasamenjual->update();
        return redirect('/suratkuasamenjual/index')->with("sukses", "Dokumen Kuasa Menjual Berhasil Di upload");

     }

    //function untuk download file
    public function downfunc(){

        $suratkuasamenjual=DB::table('suratkuasamenjual')->get();
        return view('suratkuasamenjual.upload',compact('suratkuasamenjual'));
    }

    //function untuk masuk ke view edit
     public function edit ($id)
    {
        
        $suratkuasamenjual = \App\SuratKuasaMenjual::find($id);
        return view('suratkuasamenjual.edit',['suratkuasamenjual'=>$suratkuasamenjual]);
    }


    //function untuk hapus
    public function delete($id)
    {
        $suratkuasamenjual=\App\SuratKuasaMenjual::find($id);
        $suratkuasamenjual->delete();
        return redirect('suratkuasamenjual/index')->with('sukses','Data Surat Kuasa Menjual Berhasil Dihapus');
    }  
    public function upload_akta($id)
    {
        $suratkuasamenjual = \App\SuratKuasaMenjual::find($id);
        return view('suratkuasamenjual.confirm',['suratkuasamenjual'=>$suratkuasamenjual]);
    }

    public function confirm(Request $request, $id)    
    {
        $suratkuasamenjual =\App\SuratKuasaMenjual::find($id);

         $file1 = $request->file('akta');
         $fileName1   = 'akta-'. $file1->getClientOriginalName();
         $file1->move('datasuratkuasamenjual/', $fileName1);
        
        $suratkuasamenjual->akta  = $fileName1;
        $suratkuasamenjual->status = 'diterima';
        $suratkuasamenjual->save();
        $userid=$suratkuasamenjual->users->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Selamat Pengajuanmu untuk Surat Kuasa Menjual telah diterima', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('suratkuasamenjual/index')->with('sukses','Surat Kuasa Menjual Berhasil Dikonfirmasi');
    }
    public function reject($id)
    {
        $suratkuasamenjual=\App\SuratKuasaMenjual::find($id);
        $suratkuasamenjual->status = 'ditolak';
        $suratkuasamenjual->save();
        $userid=$suratkuasamenjual->users->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Maaf Pengajuanmu untuk Surat Kuasa Menjual ditolak oleh Admin', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('suratkuasamenjual/index')->with('sukses','Surat Kuasa Menjual Berhasil Dikonfirmasi');
    }
    public function process($id)
    {
        $suratkuasamenjual=\App\SuratKuasaMenjual::find($id);
        $suratkuasamenjual->status = 'diproses';
        $suratkuasamenjual->save();
        $userid=$suratkuasamenjual->users->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Pengajuanmu untuk Surat Kuasa Menjual sedang di proses oleh Admin', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('suratkuasamenjual/index')->with('sukses','Surat Kuasa Menjual Berhasil Dikonfirmasi');
    }
 
}
