<?php

namespace App\Http\Controllers;
use Mail;
use App\User;
use App\PenghapusanHak;
use App\Instansi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class PenghapusanHakController extends Controller
{
    public function index()
    {
        $data_peralihan = \App\PenghapusanHak::all();
        return view('penghapusanhak.index',['data_peralihan'=> $data_peralihan]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        // $data_klasifikasi = \App\Klasifikasi::all();
        return view('penghapusanhak.create');
    }

    //function untuk tambah
     public function tambah (Request $request)
     {
        $request->validate([
            'jenis'   => '|min:5',
            'tgl_pengajuan'   => '|min:5',
        ]);
        $penghapusanhak = new PenghapusanHak();
        $penghapusanhak->jenis_pengajuan   = $request->input('jenis');
        $penghapusanhak->tgl_pengajuan        = $request->input('tgl_pengajuan');
        $penghapusanhak->keterangan = $request->input('keterangan');
        $penghapusanhak->users_id = Auth::id();
        $penghapusanhak->save();
        $userid=$penghapusanhak->users_id;
        $user = User::findOrFail($userid);
        $nomor_antrian = $penghapusanhak->id;
        Mail::raw( 'Pengajuanmu untuk Penghapusan Hak dengan nomor antrian '.$nomor_antrian.', berhasil dikirim. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('/penghapusanhak/index')->with("sukses", "Data Surat Penghapusan Hak Berhasil Ditambahkan");

     }
     
    public function update (Request $request, $id)
    {
        $penghapusanhak = \App\PenghapusanHak::find($id);
        $penghapusanhak->jenis_pengajuan = $request->jenis;
        $penghapusanhak->tgl_pengajuan = $request->tgl_pengajuan;
        $penghapusanhak->keterangan = $request->keterangan;
        $penghapusanhak->update();

        return redirect('penghapusanhak/index') ->with('sukses','Data Surat Penghapusan Hak Berhasil Diedit');
    }

      public function see($id)
    {
        $penghapusanhak = \App\PenghapusanHak::find($id);
        return view('penghapusanhak.upload',['penghapusanhak'=>$penghapusanhak]);
    }

     public function upload (Request $request,$id)
     {
        $request->validate([
            'sertifikat_asli'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'sertifikat_hak_tanggungan'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'surat_roya'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'ktp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
        ]);
        $penghapusanhak = \App\PenghapusanHak::find($id);
        $file1 = $request->file('sertifikat_asli');
        $file2 = $request->file('sertifikat_hak_tanggungan');
        $file3 = $request->file('surat_roya');
        $file4 = $request->file('ktp');

        if(!is_null($file1)){
            $fileName1   = 'sertifikat_asli-'. $file1->getClientOriginalName();
            $file1->move('datapenghapusanhak/', $fileName1);
            $penghapusanhak->sertifikat_asli  = $fileName1;
        }
        if(!is_null($file2)){
            $fileName2   = 'sertifikat_hak_tanggungan-'. $file2->getClientOriginalName();
            $file2->move('datapenghapusanhak/', $fileName2);
            $penghapusanhak->sertifikat_hak_tanggungan  = $fileName2;
        }
        if(!is_null($file3)){
            $fileName3   = 'surat_roya-'. $file3->getClientOriginalName();
            $file3->move('datapenghapusanhak/', $fileName3);
            $penghapusanhak->surat_roya  = $fileName3;
        }
        if(!is_null($file4)){
            $fileName4   = 'ktp-'. $file4->getClientOriginalName();
            $file4->move('datapenghapusanhak/', $fileName4);
            $penghapusanhak->ktp  = $fileName4;  
        }
     
        $penghapusanhak->update();
       // return redirect('/penghapusanhak/index')->with("sukses", "Dokumen Penghapusan Hak Berhasil Di upload");
        return \Redirect::back()->with("sukses", "Dokumen Penghapusan Hak Berhasil Di upload");

     }

    //function untuk download file
    public function downfunc(){

        $penghapusanhak=DB::table('penghapusanhak')->get();
        return view('penghapusanhak.upload',compact('penghapusanhak'));
    }

    //function untuk masuk ke view edit
     public function edit ($id)
    {
        
        $penghapusanhak = \App\PenghapusanHak::find($id);
        return view('penghapusanhak.edit',['penghapusanhak'=>$penghapusanhak]);
    }


    //function untuk hapus
    public function delete($id)
    {
        $penghapusanhak=\App\PenghapusanHak::find($id);
        $penghapusanhak->delete();
        return redirect('penghapusanhak/index')->with('sukses','Data Surat Penghapusan Hak Berhasil Dihapus');
    }
      public function upload_akta($id)
    {
        $penghapusanhak = \App\PenghapusanHak::find($id);
        return view('penghapusanhak.confirm',['penghapusanhak'=>$penghapusanhak]);
    }

    public function confirm(Request $request, $id)    
    {
        $penghapusanhak =\App\PenghapusanHak::find($id);

         $file1 = $request->file('akta');
         $fileName1   = 'akta-'. $file1->getClientOriginalName();
         $file1->move('datapenghapusanhak/', $fileName1);
        
        $penghapusanhak->akta  = $fileName1;
        $penghapusanhak->status = 'diterima';
        $penghapusanhak->save();
        $userid=$penghapusanhak->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian = $penghapusanhak->id;
        Mail::raw( 'Selamat Pengajuanmu untuk Penghapusan Hak dengan nomor antrian '.$nomor_antrian.', sudah diterima. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('penghapusanhak/index')->with('sukses','Surat Penghapusan Hak Berhasil Dikonfirmasi');
    }
    public function reject($id)
    {
        $penghapusanhak=\App\PenghapusanHak::find($id);
        $penghapusanhak->status = 'ditolak';
        $penghapusanhak->save();
        $userid=$penghapusanhak->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian = $penghapusanhak->id;
        Mail::raw( 'Maaf Pengajuanmu untuk Penghapusan Hak dengan nomor antrian '.$nomor_antrian.', telah ditolakk oleh Admin, silahkan periksa berkas dan laukan pengajuan ulang. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('penghapusanhak/index')->with('sukses','Surat Penghapusan Hak Berhasil Dikonfirmasi');
    }
    public function process($id)
    {
        $penghapusanhak=\App\PenghapusanHak::find($id);
        $penghapusanhak->status = 'diproses';
        $penghapusanhak->save();
        $userid=$penghapusanhak->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian = $penghapusanhak->id;
        Mail::raw( 'Pengajuanmu untuk Penghapusan Hak dengan nomor antrian '.$nomor_antrian.', sedang di proses oleh Admin. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('penghapusanhak/index')->with('sukses','Surat Pemberian / Pembaruan Hak Berhasil Dikonfirmasi');
    }
 
}
