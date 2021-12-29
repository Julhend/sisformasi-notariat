<?php

namespace App\Http\Controllers;
use Mail;
use App\User;
use App\PeralihanLelang;
use App\Instansi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class PeralihanLelangController extends Controller
{
    public function index()
    {
        $data_peralihan = \App\PeralihanLelang::all();
        return view('peralihanlelang.index',['data_peralihan'=> $data_peralihan]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        // $data_klasifikasi = \App\Klasifikasi::all();
        return view('peralihanlelang.create');
    }

    //function untuk tambah
     public function tambah (Request $request)
     {
        $request->validate([
            'jenis'   => '|min:5',
            'tgl_pengajuan'   => '|min:5',
        ]);
        $peralihanlelang = new PeralihanLelang();
        $peralihanlelang->jenis_pengajuan   = $request->input('jenis');
        $peralihanlelang->tgl_pengajuan        = $request->input('tgl_pengajuan');
        $peralihanlelang->keterangan = $request->input('keterangan');
        $peralihanlelang->users_id = Auth::id();
        $peralihanlelang->save();
        $userid=$peralihanlelang->users->id;
        $nomor_antrian = $peralihanlelang->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Pengajuanmu untuk Peralihan Hak Lelang dengan nomor antrian '.$nomor_antrian.', berhasil dikirim. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('/peralihanlelang/index')->with("sukses", "Data Surat Peralihan Hak Lelang Berhasil Ditambahkan");

     }
     
    public function update (Request $request, $id)
    {
        $peralihanlelang = \App\PeralihanLelang::find($id);
        $peralihanlelang->jenis_pengajuan = $request->jenis;
        $peralihanlelang->tgl_pengajuan = $request->tgl_pengajuan;
        $peralihanlelang->keterangan = $request->keterangan;
        $peralihanlelang->update();

        return redirect('peralihanlelang/index') ->with('sukses','Data Surat Peralihan Hak Lelang Berhasil Diedit');
    }

      public function see($id)
    {
        $peralihanlelang = \App\PeralihanLelang::find($id);
        return view('peralihanlelang.upload',['peralihanlelang'=>$peralihanlelang]);
    }

     public function upload (Request $request,$id)
     {
        $request->validate([
            'ktp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'risalah_lelang'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'kwitansi_lelang'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'sertifikat'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pbb'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
        ]);
        $peralihanlelang = \App\PeralihanLelang::find($id);
        $file1 = $request->file('ktp');
        $file2 = $request->file('risalah_lelang');
        $file3 = $request->file('kwitansi_lelang');
        $file4 = $request->file('sertifikat');
        $file5 = $request->file('pbb');


        $fileName1   = 'ktp-'. $file1->getClientOriginalName();
        $fileName2   = 'risalah-lelang-'. $file2->getClientOriginalName();
        $fileName3   = 'kwitansi-lelang-'. $file3->getClientOriginalName();
        $fileName4   = 'sertifikat-'. $file4->getClientOriginalName();
        $fileName5   = 'pbb-'. $file5->getClientOriginalName();
       

        $file1->move('dataperalihanlelang/', $fileName1);
        $file2->move('dataperalihanlelang/', $fileName2);
        $file3->move('dataperalihanlelang/', $fileName3);
        $file4->move('dataperalihanlelang/', $fileName4);
        $file5->move('dataperalihanlelang/', $fileName5);
       
        $peralihanlelang->risalah_lelang  = $fileName1;
        $peralihanlelang->ktp  = $fileName2;
        $peralihanlelang->kwitansi_lelang  = $fileName3;
        $peralihanlelang->sertifikat  = $fileName4;
        $peralihanlelang->pbb  = $fileName5;
    
        $peralihanlelang->update();
        return redirect('/peralihanlelang/index')->with("sukses", "Dokumen Peralihan Hak Lelang Berhasil Di upload");

     }

    //function untuk download file
    public function downfunc(){

        $peralihanlelang=DB::table('peralihanlelang')->get();
        return view('peralihanlelang.upload',compact('peralihanlelang'));
    }

    //function untuk masuk ke view edit
     public function edit ($id)
    {
        
        $peralihanlelang = \App\PeralihanLelang::find($id);
        return view('peralihanlelang.edit',['peralihanlelang'=>$peralihanlelang]);
    }


    //function untuk hapus
    public function delete($id)
    {
        $peralihanlelang=\App\PeralihanLelang::find($id);
        $peralihanlelang->delete();
        return redirect('peralihanlelang/index')->with('sukses','Data Surat Peralihan Hak Lelang Berhasil Dihapus');
    }
    public function upload_akta($id)
    {
        $peralihanlelang = \App\PeralihanLelang::find($id);
        return view('peralihanlelang.confirm',['peralihanlelang'=>$peralihanlelang]);
    }

    public function confirm(Request $request, $id)    
    {
        $peralihanlelang =\App\PeralihanLelang::find($id);

         $file1 = $request->file('akta');
         $fileName1   = 'akta-'. $file1->getClientOriginalName();
         $file1->move('dataperalihanlelang/', $fileName1);
        
        $peralihanlelang->akta  = $fileName1;
        $peralihanlelang->status = 'diterima';
        $peralihanlelang->save();
        $userid=$peralihanlelang->users->id;
        $nomor_antrian = $peralihanlelang->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Selamat Pengajuanmu untuk Peralihan Hak Lelang dengan nomor antrian '.$nomor_antrian.', telah diterima. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanlelang/index')->with('sukses','Surat Peralihan Hak Lelang Berhasil Dikonfirmasi');
    }
    public function reject($id)
    {
        $peralihanlelang=\App\PeralihanLelang::find($id);
        $peralihanlelang->status = 'ditolak';
        $peralihanlelang->save();
        $userid=$peralihanlelang->users->id;
        $nomor_antrian = $peralihanlelang->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Maaf Pengajuanmu untuk Peralihan Hak Lelang dengan nomor antrian '.$nomor_antrian.', di tolak oleh Admin, silahlan periksa berkas dan lakukan pengajuan ulang. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanlelang/index')->with('sukses','Surat Peralihan Hak Lelang Berhasil Dikonfirmasi');
    }
    public function process($id)
    {
        $peralihanlelang=\App\PeralihanLelang::find($id);
        $peralihanlelang->status = 'diproses';
        $peralihanlelang->save();
        $userid=$peralihanlelang->users->id;
        $nomor_antrian = $peralihanlelang->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Pengajuanmu untuk Peralihan Hak Lelang dengan nomor antrian '.$nomor_antrian.', telah di proses oleh Admin. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanlelang/index')->with('sukses','Surat Peralihan Hak Lelang Berhasil Dikonfirmasi');
    }
 
}
