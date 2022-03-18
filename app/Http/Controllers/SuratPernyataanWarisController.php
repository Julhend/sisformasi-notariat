<?php

namespace App\Http\Controllers;
use Mail;
use App\User;
use App\SuratPernyataanWaris;
use App\Instansi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class SuratPernyataanWarisController extends Controller
{
    public function index()
    {
        $data_peralihan = \App\SuratPernyataanWaris::all();
        return view('suratpernyataanwaris.index',['data_peralihan'=> $data_peralihan]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        // $data_klasifikasi = \App\Klasifikasi::all();
        return view('suratpernyataanwaris.create');
    }

    //function untuk tambah
     public function tambah (Request $request)
     {
        $request->validate([
            'jenis'   => '|min:5',
            'tgl_pengajuan'   => '|min:5',
        ]);
        $suratpernyataanwaris = new SuratPernyataanWaris();
        $suratpernyataanwaris->jenis_pengajuan   = $request->input('jenis');
        $suratpernyataanwaris->tgl_pengajuan        = $request->input('tgl_pengajuan');
        $suratpernyataanwaris->keterangan = $request->input('keterangan');
        $suratpernyataanwaris->users_id = Auth::id();
        $suratpernyataanwaris->save();
        $userid=$suratpernyataanwaris->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian=$suratpernyataanwaris->id;
        Mail::raw( 'Pengajuanmu untuk Surat Pernyataan dan Keterangan dengan nomor antrian '.$nomor_antrian.', berhasil dikirim. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('/suratpernyataanwaris/index')->with("sukses", "Data Surat Pernyataan & Keterangan Berhasil Ditambahkan");

     }
     
    public function update (Request $request, $id)
    {
        $suratpernyataanwaris = \App\SuratPernyataanWaris::find($id);
        $suratpernyataanwaris->jenis_pengajuan = $request->jenis;
        $suratpernyataanwaris->tgl_pengajuan = $request->tgl_pengajuan;
        $suratpernyataanwaris->keterangan = $request->keterangan;
        $suratpernyataanwaris->update();

        return redirect('suratpernyataanwaris/index') ->with('sukses','Data Surat Pernyataan & Keterangan Berhasil Diedit');
    }

      public function see($id)
    {
        $suratpernyataanwaris = \App\SuratPernyataanWaris::find($id);
        return view('suratpernyataanwaris.upload',['suratpernyataanwaris'=>$suratpernyataanwaris]);
    }

     public function upload (Request $request,$id)
     {
        $request->validate([
            'akta_kematian'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'ktp_alm'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'kk_alm'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'akta_nikah_alm'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'ktp_penerima'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'kk_penerima'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'akta_lahir_penerima'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
        ]);
        $suratpernyataanwaris = \App\SuratPernyataanWaris::find($id);
        $file1 = $request->file('akta_kematian');
        $file2 = $request->file('ktp_alm');
        $file3 = $request->file('kk_alm');
        $file4 = $request->file('akta_nikah_alm');
        $file5 = $request->file('ktp_penerima');
        $file6 = $request->file('kk_penerima');
        $file7 = $request->file('akta_lahir_penerima');
    
        $fileName1   = 'akta_kematian-'. $file1->getClientOriginalName();
        $fileName2   = 'ktp_alm-'. $file2->getClientOriginalName();
        $fileName3   = 'kk_alm-'. $file3->getClientOriginalName();
        $fileName4   = 'akta_nikah_alm-'. $file4->getClientOriginalName();
        $fileName5   = 'ktp_penerima-'. $file5->getClientOriginalName();
        $fileName6   = 'kk_penerima-'. $file6->getClientOriginalName();
        $fileName7   = 'akta_lahir_penerima-'. $file7->getClientOriginalName();
   
        $file1->move('datasuratpernyataanwaris/', $fileName1);
        $file2->move('datasuratpernyataanwaris/', $fileName2);
        $file3->move('datasuratpernyataanwaris/', $fileName3);
        $file4->move('datasuratpernyataanwaris/', $fileName4);
        $file5->move('datasuratpernyataanwaris/', $fileName5);
        $file6->move('datasuratpernyataanwaris/', $fileName6);
        $file7->move('datasuratpernyataanwaris/', $fileName7);


        $suratpernyataanwaris->akta_kematian  = $fileName1;
        $suratpernyataanwaris->ktp_alm  = $fileName2;
        $suratpernyataanwaris->kk_alm  = $fileName3;
        $suratpernyataanwaris->akta_nikah_alm  = $fileName4;
        $suratpernyataanwaris->ktp_penerima  = $fileName5;
        $suratpernyataanwaris->kk_penerima  = $fileName6;
        $suratpernyataanwaris->akta_lahir_penerima  = $fileName7;
        $suratpernyataanwaris->update();
        return redirect('/suratpernyataanwaris/index')->with("sukses", "Dokumen Pernyataan & Keterangan Berhasil Di upload");

     }

    //function untuk download file
    public function downfunc(){

        $suratpernyataanwaris=DB::table('suratpernyataanwaris')->get();
        return view('suratpernyataanwaris.upload',compact('suratpernyataanwaris'));
    }

    //function untuk masuk ke view edit
     public function edit ($id)
    {
        
        $suratpernyataanwaris = \App\SuratPernyataanWaris::find($id);
        return view('suratpernyataanwaris.edit',['suratpernyataanwaris'=>$suratpernyataanwaris]);
    }


    //function untuk hapus
    public function delete($id)
    {
        $suratpernyataanwaris=\App\SuratPernyataanWaris::find($id);
        $suratpernyataanwaris->delete();
        return redirect('suratpernyataanwaris/index')->with('sukses','Data Surat Pernyataan & Keterangan Waris Berhasil Dihapus');
    }
      public function upload_akta($id)
    {
        $suratpernyataanwaris = \App\SuratPernyataanWaris::find($id);
        return view('suratpernyataanwaris.confirm',['suratpernyataanwaris'=>$suratpernyataanwaris]);
    }

    public function confirm(Request $request, $id)    
    {
        $suratpernyataanwaris =\App\SuratPernyataanWaris::find($id);

         $file1 = $request->file('akta');
         $fileName1   = 'akta-'. $file1->getClientOriginalName();
         $file1->move('datasuratpernyataanwaris/', $fileName1);
        
        $suratpernyataanwaris->akta  = $fileName1;
        $suratpernyataanwaris->status = 'diterima';
        $suratpernyataanwaris->save();
        $userid=$suratpernyataanwaris->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian=$suratpernyataanwaris->id;
        Mail::raw( 'Selamat Pengajuanmu untuk Surat Pernyataan dan Keterangan dengan nomor antrian '.$nomor_antrian.', telah diterima. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('suratpernyataanwaris/index')->with('sukses','Surat Pernyataan & Keterangan Waris Berhasil Dikonfirmasi');
    }
    public function rejectDocument($id)
    {
        $suratpernyataanwaris = \App\SuratPernyataanWaris::find($id);
        return view('suratpernyataanwaris.reject',['suratpernyataanwaris'=>$suratpernyataanwaris]);
    }
    public function reject($id, Request $request)
    {
        $suratpernyataanwaris=\App\SuratPernyataanWaris::find($id);
        $suratpernyataanwaris->keterangan_ditolak = $request->keterangan_ditolak;
        $suratpernyataanwaris->status = 'ditolak';
        $suratpernyataanwaris->save();
        $userid=$suratpernyataanwaris->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian=$suratpernyataanwaris->id;
        Mail::raw( 'Maaf Pengajuanmu untuk Surat Pernyataan dan Keterangan dengan nomor antrian '.$nomor_antrian.', ditolak oleh Admin dengan alasan, '.$request->keterangan_ditolak.'. silahkan periksa berkas dan lakukan pengajuan ulang. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('suratpernyataanwaris/index')->with('sukses','Surat Pernyataan & Keterangan Berhasil Dikonfirmasi');
    }
    public function process($id)
    {
        $suratpernyataanwaris=\App\SuratPernyataanWaris::find($id);
        $suratpernyataanwaris->status = 'diproses';
        $suratpernyataanwaris->save();
        $userid=$suratpernyataanwaris->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian=$suratpernyataanwaris->id;
        Mail::raw( 'Pengajuanmu untuk Surat Pernyataan dan Keterangan dengan nomor antrian '.$nomor_antrian.', sedang di proses oleh Admin. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('suratpernyataanwaris/index')->with('sukses','Surat Pernyataan & Keterangan Berhasil Dikonfirmasi');
    }
 
}
