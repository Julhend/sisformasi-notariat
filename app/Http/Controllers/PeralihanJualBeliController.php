<?php

namespace App\Http\Controllers;
use Mail;
use App\User;
use App\PeralihanJualBeli;
use App\Instansi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class PeralihanJualBeliController extends Controller
{
    public function index()
    {
        $data_peralihan_jual_beli = \App\PeralihanJualBeli::all();
        return view('peralihanhakjualbeli.index',['data_peralihanjualbeli'=> $data_peralihan_jual_beli]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        // $data_klasifikasi = \App\Klasifikasi::all();
        return view('peralihanhakjualbeli.create');
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
        $peralihanjualbeli = new PeralihanJualBeli();
        $peralihanjualbeli->jenis_pengajuan   = $request->input('jenis');
        $peralihanjualbeli->tgl_pengajuan        = $request->input('tgl_pengajuan');
        $peralihanjualbeli->pihakpertama  = $request->input('pihakpertama');
        $peralihanjualbeli->pihakkedua = $request->input('pihakkedua');
        $peralihanjualbeli->keterangan = $request->input('keterangan');
        $peralihanjualbeli->users_id = Auth::id();
        $peralihanjualbeli->save();

        $userid=$peralihanjualbeli->users->id;
        $nomor_antrian = $peralihanjualbeli->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Pengajuanmu untuk Hak Peralihan Jual Beli dengan nomor antrian '.$nomor_antrian.', berhasil dikirim. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('/peralihanjualbeli/index')->with("sukses", "Data Surat Peralihan Hak Jual Beli Berhasil Ditambahkan");

     }

      public function see($id)
    {
        $peralihanjualbeli = \App\Peralihanjualbeli::find($id);
        return view('peralihanhakjualbeli.upload',['peralihanjualbeli'=>$peralihanjualbeli]);
    }

     public function upload (Request $request,$id)
     {
        $request->validate([
            'pertamakk'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'pertamaktp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'pertamaktppasangan'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'pertamaaktanikah'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'pertamanpwp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'pertamapbb'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'pertamasertifikat'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'pertamakwitansi'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'keduaktp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'keduakk'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
            'keduanpwp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf|max:500',
        ]);
        $peralihanjualbeli = \App\PeralihanJualBeli::find($id);
        $file1 = $request->file('pertamaktp');
        $file2 = $request->file('pertamakk');
        $file3 = $request->file('pertamaktppasangan');
        $file4 = $request->file('pertamaaktanikah');
        $file5 = $request->file('pertamanpwp');
        $file6 = $request->file('pertamapbb');
        $file7 = $request->file('pertamasertifikat');
        $file8 = $request->file('pertamakwitansi');
        $file9 = $request->file('keduaktp');
        $file10 = $request->file('keduakk');
        $file11 = $request->file('keduanpwp');

        if(!is_null($file1)){    
            $fileName1   = 'ktp-'. $file1->getClientOriginalName();
            $file1->move('dataperalihanjualbeli/', $fileName1);
            $peralihanjualbeli->pertamaktp  = $fileName1;
        }
        if(!is_null($file2)){
            $fileName2   = 'kk-'. $file2->getClientOriginalName();
            $file2->move('dataperalihanjualbeli/', $fileName2);
            $peralihanjualbeli->pertamakk  = $fileName2;
        }
        if(!is_null($file3)){
            $fileName3   = 'ktpasangan-'. $file3->getClientOriginalName();
            $file3->move('dataperalihanjualbeli/', $fileName3);
            $peralihanjualbeli->pertamaktppasangan  = $fileName3;
        }
        if(!is_null($file4)){
            $fileName4   = 'aktanikah-'. $file4->getClientOriginalName();
            $file4->move('dataperalihanjualbeli/', $fileName4);
            $peralihanjualbeli->pertamaaktanikah  = $fileName4;
        }
        if(!is_null($file5)){
            $fileName5   = 'npwp-'. $file5->getClientOriginalName();
            $file5->move('dataperalihanjualbeli/', $fileName5);
            $peralihanjualbeli->pertamanpwp  = $fileName5;
        }
        if(!is_null($file6)){
            $fileName6   = 'pbb-'. $file6->getClientOriginalName();
            $file6->move('dataperalihanjualbeli/', $fileName6);
            $peralihanjualbeli->pertamapbb  = $fileName6;
        }
        if(!is_null($file7)){
            $fileName7   = 'sertifikat-'. $file7->getClientOriginalName();
            $file7->move('dataperalihanjualbeli/', $fileName7);
            $peralihanjualbeli->pertamasertifikat  = $fileName7;
        }
        if(!is_null($file8)){
            $fileName8   = 'kwitansi-'. $file8->getClientOriginalName();
            $file8->move('dataperalihanjualbeli/', $fileName8);
            $peralihanjualbeli->pertamakwitansi  = $fileName8;
        }
        if(!is_null($file9)){
            $fileName9   = 'ktp-pihak-kedua-'. $file9->getClientOriginalName();
            $file9->move('dataperalihanjualbeli/', $fileName9);
            $peralihanjualbeli->keduaktp  = $fileName9;
        }
        if(!is_null($file10)){
            $fileName10   = 'kk-pihak-kedua-'. $file10->getClientOriginalName();
            $file10->move('dataperalihanjualbeli/', $fileName10);
            $peralihanjualbeli->keduakk  = $fileName10;
        }
        if(!is_null($file11)){
            $fileName11   = 'npwp-pihak-kedua-'. $file11->getClientOriginalName();
            $file11->move('dataperalihanjualbeli/', $fileName11);
            $peralihanjualbeli->keduanpwp  = $fileName11;
        }

        $peralihanjualbeli->update();
        // return redirect('/peralihanjualbeli/$balik/dokumen')->with("sukses", "Dokumen Peralihan Hak Jual Beli Berhasil Di upload");
        return \Redirect::back()->with("sukses", "Dokumen Peralihan Hak Jual Beli Berhasil Di upload");

     }

    //function untuk melihat file
    public function tampil($id_suratperalihanhakjualbeli)
    {
        $suratperalihanjualbeli = \App\Peralihanjualbeli::find($id_suratperalihanhakjualbeli);
        return view('peralihanhakjualbeli.tampil',['peralihanjualbeli'=>$suratperalihanjualbeli]);
    }

    //function untuk download file
    public function downfunc(){

        $peralihanjualbeli=DB::table('peralihanjualbeli')->get();
        return view('peralihanhakjualbeli.upload',compact('peralihanjualbeli'));
    }

    //function untuk masuk ke view edit
     public function edit ($id)
    {
        
        $peralihanjualbeli = \App\Peralihanjualbeli::find($id);
        return view('peralihanhakjualbeli.edit',['peralihanjualbeli'=>$peralihanjualbeli]);
    }

    public function update (Request $request, $id)
    {
        $peralihanjualbeli = \App\PeralihanJualBeli::find($id);
        $peralihanjualbeli->jenis_pengajuan = $request->jenis;
        $peralihanjualbeli->tgl_pengajuan = $request->tgl_pengajuan;
        $peralihanjualbeli->pihakpertama = $request->pihakpertama;
        $peralihanjualbeli->pihakkedua = $request->pihakkedua;
        $peralihanjualbeli->keterangan = $request->keterangan;
        $peralihanjualbeli->update();

        return redirect('peralihanjualbeli/index') ->with('sukses','Data Surat Peralihan Hak Jual Beli Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id_suratperalihanhakjualbeli)
    {
        $peralihanjualbeli=\App\Peralihanjualbeli::find($id_suratperalihanhakjualbeli);
        $peralihanjualbeli->delete();
        return redirect('peralihanjualbeli/index')->with('sukses','Data Surat Peralihan Hak Jual Beli Berhasil Dihapus');
    }

      public function upload_akta($id)
    {
        $peralihanjualbeli = \App\Peralihanjualbeli::find($id);
        return view('peralihanhakjualbeli.confirm',['peralihanjualbeli'=>$peralihanjualbeli]);
    }

    public function confirm(Request $request, $id)    
    {
        $request->validate([
            'akta'  => 'mimes:pdf|max:500',
        ]);

        $peralihanjualbeli =\App\Peralihanjualbeli::find($id);

         $file1 = $request->file('akta');
         $fileName1   = 'akta-'. $file1->getClientOriginalName();
         $file1->move('dataperalihanjualbeli/', $fileName1);
        
        $peralihanjualbeli->akta  = $fileName1;
        $peralihanjualbeli->status = 'diterima';
        $peralihanjualbeli->save();
        $userid=$peralihanjualbeli->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian = $peralihanjualbeli->id;
        Mail::raw( 'Selamat Pengajuanmu untuk Hak Peralihan Jual Beli dengan nomor antrian '.$nomor_antrian.', Sudah diterima. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanjualbeli/index')->with('sukses','Surat Peralihan Hak Jual Beli Berhasil Dikonfirmasi');
    }



    public function reject($id)
    {
        $peralihanjualbeli=\App\Peralihanjualbeli::find($id);
        $peralihanjualbeli->status = 'ditolak';
        $peralihanjualbeli->save();
        $userid=$peralihanjualbeli->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian=$peralihanjualbeli->id;
        Mail::raw( 'Maaf Pengajuanmu untuk Hak Peralihan Jual Beli dengan nomor antrian '.$nomor_antrian.', di tolak oleh Admin, silahkan periksa berkas dan lakukan pengajuan ulang. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanjualbeli/index')->with('sukses','Surat Peralihan Hak Jual Beli Berhasil Dikonfirmasi');
    }
   
    public function process($id)
    {
        $peralihanjualbeli=\App\Peralihanjualbeli::find($id);
        $peralihanjualbeli->status = 'diproses';
        $peralihanjualbeli->save();
        
        $userid=$peralihanjualbeli->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian=$peralihanjualbeli->id;
        Mail::raw( 'Pengajuanmu untuk Hak Peralihan Jual Beli dengan nomor antrian '.$nomor_antrian.' sedang di proses oleh Admin. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanjualbeli/index')->with('sukses','Surat Peralihan Hak Jual Beli Berhasil Dikonfirmasi');
    }


    public function agenda(Request $request)
    {
        $data_peralihan_jual_beli = \App\PeralihanJualBeli::all();
        return view('peralihanhakjualbeli.agenda', compact('data_peralihan_jual_beli'));
    }

    public function agendamasukcetak_pdf(Request $request)
    {
        $inst = Instansi::first();
        $suratmasuk = \App\PeralihanJualBeli::all();
        $pdf = PDF::loadview('peralihanhakjualbeli.cetakagendaPDF', compact('inst','suratmasuk'));
        return $pdf->stream();
    }

 
}
