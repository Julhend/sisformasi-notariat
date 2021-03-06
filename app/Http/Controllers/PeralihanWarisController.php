<?php

namespace App\Http\Controllers;
use Mail;
use App\User;
use App\PemberianHak;
use App\PeralihanWaris;
use App\Instansi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class PeralihanWarisController extends Controller
{
    public function index()
    {
        $data_peralihan = \App\PeralihanWaris::all();
        return view('peralihanwaris.index',['data_peralihan'=> $data_peralihan]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        // $data_klasifikasi = \App\Klasifikasi::all();
        return view('peralihanwaris.create');
    }

    //function untuk tambah
     public function tambah (Request $request)
     {
        $request->validate([
            'jenis'   => '|min:5',
            'tgl_pengajuan'   => '|min:5',
            'pihakpertama'   => '|min:5',
            'pihakkedua'   => '|min:5',
        ]);
        $peralihanwaris = new PeralihanWaris();
        $peralihanwaris->jenis_pengajuan   = $request->input('jenis');
        $peralihanwaris->tgl_pengajuan        = $request->input('tgl_pengajuan');
        $peralihanwaris->pihakpertama  = $request->input('pihakpertama');
        $peralihanwaris->pihakkedua = $request->input('pihakkedua');
        $peralihanwaris->keterangan = $request->input('keterangan');
        $peralihanwaris->users_id = Auth::id();
        $peralihanwaris->save();
        $userid=$peralihanwaris->users->id;
        $nomor_antrian = $peralihanwaris->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Pengajuanmu untuk Peralihan Hak Waris dengan nomor antrian '.$nomor_antrian.', berhasil dikirim. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('/peralihanwaris/index')->with("sukses", "Data Surat Peralihan Hak Waris Berhasil Ditambahkan");

     }

      public function see($id)
    {
        $peralihanwaris = \App\PeralihanWaris::find($id);
        return view('peralihanwaris.upload',['peralihanwaris'=>$peralihanwaris]);
    }

     public function upload (Request $request,$id)
     {
        $request->validate([
            'almaktakematian'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'almaktanikah'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'almkk'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'almnpwp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'almpbb'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'almsertifikat'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'penerimaktp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'penerimakk'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'penerimaaktalahir'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
        ]);
        $peralihanwaris = \App\PeralihanWaris::find($id);
        $file1 = $request->file('almaktakematian');
        $file2 = $request->file('almaktanikah');
        $file3 = $request->file('almkk');
        $file4 = $request->file('almnpwp');
        $file5 = $request->file('almpbb');
        $file6 = $request->file('almsertifikat');
        $file9 = $request->file('penerimakk');
        $file10 = $request->file('penerimaktp');
        $file11 = $request->file('penerimaaktalahir');

        if(!is_null($file1)){
            $fileName1   = 'akta-kematian-'. $file1->getClientOriginalName();
            $file1->move('dataperalihanwaris/', $fileName1);
            $peralihanwaris->almaktanikah  = $fileName1;
        }
        if(!is_null($file2)){
            $fileName2   = 'akta-nikah-'. $file2->getClientOriginalName();
            $file2->move('dataperalihanwaris/', $fileName2);
            $peralihanwaris->almaktakematian  = $fileName2;
        }
        if(!is_null($file3)){
            $fileName3   = 'kk-'. $file3->getClientOriginalName();
            $file3->move('dataperalihanwaris/', $fileName3);
            $peralihanwaris->almkk  = $fileName3;
        }
        if(!is_null($file4)){
            $fileName4   = 'npwp-'. $file4->getClientOriginalName();
            $file4->move('dataperalihanwaris/', $fileName4);
            $peralihanwaris->almnpwp  = $fileName4;
        }
        if(!is_null($file5)){
            $fileName5   = 'pbb-'. $file5->getClientOriginalName();
            $file5->move('dataperalihanwaris/', $fileName5);
            $peralihanwaris->almpbb  = $fileName5;
        }
        if(!is_null($file6)){
            $fileName6   = 'sertifikat-'. $file6->getClientOriginalName();
            $file6->move('dataperalihanwaris/', $fileName6);
            $peralihanwaris->almsertifikat  = $fileName6;
        }
        if(!is_null($file9)){
            $fileName9   = 'ktp-pihak-penerima-'. $file9->getClientOriginalName();
            $file9->move('dataperalihanwaris/', $fileName9);
            $peralihanwaris->penerimaktp  = $fileName9;
        }
        if(!is_null($file10)){
            $fileName10   = 'kk-pihak-penerima-'. $file10->getClientOriginalName();
            $file10->move('dataperalihanwaris/', $fileName10);
            $peralihanwaris->penerimakk  = $fileName10;
        }
        if(!is_null($file11)){
            $fileName11   = 'akta-lahir-pihak-penerima-'. $file11->getClientOriginalName();
            $file11->move('dataperalihanwaris/', $fileName11);
            $peralihanwaris->penerimaaktalahir  = $fileName11;
        }
      
        $peralihanwaris->update();
        return \Redirect::back()->with("sukses", "Dokumen Peralihan Hak Waris Berhasil Di upload");

     }

    //function untuk download file
    public function downfunc(){

        $peralihanwaris=DB::table('peralihanwaris')->get();
        return view('peralihanwaris.upload',compact('peralihanwaris'));
    }

    //function untuk masuk ke view edit
     public function edit ($id)
    {
        
        $peralihanwaris = \App\PeralihanWaris::find($id);
        return view('peralihanwaris.edit',['peralihanwaris'=>$peralihanwaris]);
    }

    public function update (Request $request, $id)
    {
        $peralihanwaris = \App\PeralihanWaris::find($id);
        $peralihanwaris->jenis_pengajuan = $request->jenis;
        $peralihanwaris->tgl_pengajuan = $request->tgl_pengajuan;
        $peralihanwaris->pihakpertama = $request->pihakpertama;
        $peralihanwaris->pihakkedua = $request->pihakkedua;
        $peralihanwaris->keterangan = $request->keterangan;
        $peralihanwaris->update();

        return redirect('peralihanwaris/index') ->with('sukses','Data Surat Peralihan Hak Waris Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        $peralihanwaris=\App\PeralihanWaris::find($id);
        $peralihanwaris->delete();
        return redirect('peralihanwaris/index')->with('sukses','Data Surat Peralihan Hak Waris Berhasil Dihapus');
    }
      public function upload_akta($id)
    {
        $peralihanwaris = \App\PeralihanWaris::find($id);
        return view('peralihanwaris.confirm',['peralihanwaris'=>$peralihanwaris]);
    }

    public function confirm(Request $request, $id)    
    {
        $peralihanwaris =\App\PeralihanWaris::find($id);

         $file1 = $request->file('akta');
         $fileName1   = 'akta-'. $file1->getClientOriginalName();
         $file1->move('dataperalihanwaris/', $fileName1);
        
        $peralihanwaris->akta  = $fileName1;
        $peralihanwaris->status = 'diterima';
        $peralihanwaris->save();
        $userid=$peralihanwaris->users->id;
        $nomor_antrian = $peralihanwaris->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Selamat Pengajuanmu untuk Peralihan Hak Waris dengan nomor antrian'.$nomor_antrian.', telah diterima. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanwaris/index')->with('sukses','Surat Peralihan Hak Waris Berhasil Dikonfirmasi');
    }

    public function rejectDocument($id)
    {
        $peralihanwaris=\App\PeralihanWaris::find($id);
        return view('peralihanwaris.reject',['peralihanwaris'=>$peralihanwaris]);
    }
    
    public function reject($id, Request $request)
    {
        $peralihanwaris=\App\PeralihanWaris::find($id);
        $peralihanwaris->keterangan_ditolak = $request->keterangan_ditolak;
        $peralihanwaris->status = 'ditolak';
        $peralihanwaris->save();
        $userid=$peralihanwaris->users->id;
        $nomor_antrian = $peralihanwaris->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Maaf Pengajuanmu untuk Peralihan Hak Waris dengan nomor antrian'.$nomor_antrian.', di tolak oleh Admin dengan alasan, '.$request->keterangan_ditolak.'. silahkan periksa berkas dan lakukan pengajuan ulang. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanwaris/index')->with('sukses','Surat Peralihan Hak Waris Berhasil Di Reject');
    }
    public function process($id)
    {
        $peralihanwaris=\App\PeralihanWaris::find($id);
        $peralihanwaris->status = 'diproses';
        $peralihanwaris->save();
        $userid=$peralihanwaris->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian = $peralihanwaris->id;
        Mail::raw( 'Pengajuanmu untuk Peralihan Hak Waris dengan nomor antrian '.$nomor_antrian.', sedang di proses oleh Admin. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanwaris/index')->with('sukses','Surat Peralihan Hak Waris Berhasil Dikonfirmasi');
    }

    public function resend($id)
    {
        $peralihanwaris=\App\PeralihanWaris::find($id);
        $peralihanwaris->status = 'pending';
        $peralihanwaris->save();
        
        $userid=$peralihanwaris->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian=$peralihanwaris->id;
        Mail::raw( 'Pengajuan ulang untuk Hak Waris dengan nomor antrian '.$nomor_antrian.' berhasil di kirim kembali. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanwaris/index')->with('sukses','Surat Peralihan Hak Waris berhasil di Kirim Kembali');
    }

    
 
}
