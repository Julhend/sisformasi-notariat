<?php

namespace App\Http\Controllers;
use Mail;
use App\User;
use App\PemberianHak;
use App\Instansi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class PemberianHakController extends Controller
{
    public function index()
    {
        $data_peralihan = \App\PemberianHak::all();
        return view('pemberianhak.index',['data_peralihan'=> $data_peralihan]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        // $data_klasifikasi = \App\Klasifikasi::all();
        return view('pemberianhak.create');
    }

    //function untuk tambah
     public function tambah (Request $request)
     {
        $request->validate([
            'jenis'   => '|min:5',
            'tgl_pengajuan'   => '|min:5',
        ]);
        $pemberianhak = new PemberianHak();
        $pemberianhak->jenis_pengajuan   = $request->input('jenis');
        $pemberianhak->tgl_pengajuan        = $request->input('tgl_pengajuan');
        $pemberianhak->keterangan = $request->input('keterangan');
        $pemberianhak->users_id = Auth::id();
        $pemberianhak->save();
        $userid=$pemberianhak->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian = $pemberianhak->id;
        Mail::raw( 'Pengajuanmu untuk Pemberian / Pembaruan Hak dengan nomor antrian '.$nomor_antrian.', berhasil dikirim. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('/pemberianhak/index')->with("sukses", "Data Surat Pemberian / Pembaruan Hak Berhasil Ditambahkan");

     }
     
    public function update (Request $request, $id)
    {
        $pemberianhak = \App\PemberianHak::find($id);
        $pemberianhak->jenis_pengajuan = $request->jenis;
        $pemberianhak->tgl_pengajuan = $request->tgl_pengajuan;
        $pemberianhak->keterangan = $request->keterangan;
        $pemberianhak->update();

        return redirect('pemberianhak/index') ->with('sukses','Data Surat Pemberian / Pembaruan Hak Berhasil Diedit');
    }

      public function see($id)
    {
        $pemberianhak = \App\PemberianHak::find($id);
        return view('pemberianhak.upload',['pemberianhak'=>$pemberianhak]);
    }

     public function upload (Request $request,$id)
     {
        $request->validate([
            'ktp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'kk'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pbb'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'sertifikat'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
        ]);
        $pemberianhak = \App\PemberianHak::find($id);
        $file1 = $request->file('ktp');
        $file2 = $request->file('kk');
        $file3 = $request->file('pbb');
        $file4 = $request->file('sertifikat');


        $fileName1   = 'ktp-'. $file1->getClientOriginalName();
        $fileName2   = 'kk-'. $file2->getClientOriginalName();
        $fileName3   = 'pbb-'. $file3->getClientOriginalName();
        $fileName4   = 'sertifikat-'. $file4->getClientOriginalName();

        $file1->move('datapemberianhak/', $fileName1);
        $file2->move('datapemberianhak/', $fileName2);
        $file3->move('datapemberianhak/', $fileName3);
        $file4->move('datapemberianhak/', $fileName4);

       
        $pemberianhak->kk  = $fileName1;
        $pemberianhak->ktp  = $fileName2;
        $pemberianhak->pbb  = $fileName3;
        $pemberianhak->sertifikat  = $fileName4;  
        $pemberianhak->update();
        return redirect('/pemberianhak/index')->with("sukses", "Dokumen Pemberian / Pembaruan Hak Berhasil Di upload");

     }

    //function untuk download file
    public function downfunc(){

        $pemberianhak=DB::table('pemberianhak')->get();
        return view('pemberianhak.upload',compact('pemberianhak'));
    }

    //function untuk masuk ke view edit
     public function edit ($id)
    {
        
        $pemberianhak = \App\PemberianHak::find($id);
        return view('pemberianhak.edit',['pemberianhak'=>$pemberianhak]);
    }


    //function untuk hapus
    public function delete($id)
    {
        $pemberianhak=\App\PemberianHak::find($id);
        $pemberianhak->delete();
        return redirect('pemberianhak/index')->with('sukses','Data Surat Pemberian / Pembaruan Hak Berhasil Dihapus');
    }

    public function upload_akta($id)
    {
        $pemberianhak = \App\PemberianHak::find($id);
        return view('pemberianhak.confirm',['pemberianhak'=>$pemberianhak]);
    }

    public function confirm(Request $request, $id)    
    {
        $pemberianhak =\App\PemberianHak::find($id);

         $file1 = $request->file('akta');
         $fileName1   = 'akta-'. $file1->getClientOriginalName();
         $file1->move('datapemberianhak/', $fileName1);
        
        $pemberianhak->akta  = $fileName1;
        $pemberianhak->status = 'diterima';
        $pemberianhak->save();
        $userid=$pemberianhak->users->id;
        $userid=$pemberianhak->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian = $pemberianhak->id;
        Mail::raw( 'Selamat Pengajuanmu untuk Pemberian / Pembaruan Hak dengan nomor antrian '.$nomor_antrian.', sudah diterima. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('pemberianhak/index')->with('sukses','Surat Pemberian Hak Berhasil Dikonfirmasi');
    }
    public function reject($id)
    {
        $pemberianhak=\App\PemberianHak::find($id);
        $pemberianhak->status = 'ditolak';
        $pemberianhak->save();
        $userid=$pemberianhak->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian = $pemberianhak->id;
        Mail::raw( 'Maaf Pengajuanmu untuk Pemberian / Pembaruan Hak dengan nomor antrian '.$nomor_antrian.', di tolak oleh admin, silahkan periksa berkas dan lakukan pengajuan ulang. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('pemberianhak/index')->with('sukses','Surat Pemberian / Pembaruan Hak Berhasil Dikonfirmasi');
    }
    public function process($id)
    {
        $pemberianhak=\App\PemberianHak::find($id);
        $pemberianhak->status = 'diproses';
        $pemberianhak->save();
        $userid=$pemberianhak->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian = $pemberianhak->id;
        Mail::raw( 'Pengajuanmu untuk Pemberian / Pembaruan Hak dengan nomor antrian '.$nomor_antrian.', sedang di proses oleh Admin. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('pemberianhak/index')->with('sukses','Surat Pemberian / Pembaruan Hak Berhasil Dikonfirmasi');
    }
 
}
