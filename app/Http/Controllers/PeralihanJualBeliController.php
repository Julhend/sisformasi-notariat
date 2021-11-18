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
        $user = User::findOrFail($userid);
        Mail::raw( 'Pengajuanmu untuk Hak Peralihan Jual Beli sedang berhasil dikirim', function ($m) use ($user) {
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
            'pertamakk'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pertamaktp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pertamaktppasangan'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pertamaaktanikah'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pertamanpwp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pertamapbb'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pertamasertifikat'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pertamakwitansi'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'keduaktp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'keduakk'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'keduanpwp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
        ]);
        $peralihanjualbeli = \App\PeralihanJualBeli::find($id);
        $file1 = $request->file('pertamakk');
        $file2 = $request->file('pertamaktp');
        $file3 = $request->file('pertamaktppasangan');
        $file4 = $request->file('pertamaaktanikah');
        $file5 = $request->file('pertamanpwp');
        $file6 = $request->file('pertamapbb');
        $file7 = $request->file('pertamasertifikat');
        $file8 = $request->file('pertamakwitansi');
        $file9 = $request->file('keduakk');
        $file10 = $request->file('keduaktp');
        $file11 = $request->file('keduanpwp');

        $fileName1   = 'ktp-'. $file2->getClientOriginalName();
        $fileName2   = 'kk-'. $file1->getClientOriginalName();
        $fileName3   = 'ktpasangan-'. $file3->getClientOriginalName();
        $fileName4   = 'aktanikah-'. $file4->getClientOriginalName();
        $fileName5   = 'npwp-'. $file5->getClientOriginalName();
        $fileName6   = 'pbb-'. $file6->getClientOriginalName();
        $fileName7   = 'sertifikat-'. $file7->getClientOriginalName();
        $fileName8   = 'kwitansi-'. $file8->getClientOriginalName();
        $fileName9   = 'ktp-pihak-kedua-'. $file9->getClientOriginalName();
        $fileName10   = 'kk-pihak-kedua-'. $file10->getClientOriginalName();
        $fileName11   = 'npwp-pihak-kedua-'. $file11->getClientOriginalName();

        $file1->move('dataperalihanjualbeli/', $fileName1);
        $file2->move('dataperalihanjualbeli/', $fileName2);
        $file3->move('dataperalihanjualbeli/', $fileName3);
        $file4->move('dataperalihanjualbeli/', $fileName4);
        $file5->move('dataperalihanjualbeli/', $fileName5);
        $file6->move('dataperalihanjualbeli/', $fileName6);
        $file7->move('dataperalihanjualbeli/', $fileName7);
        $file8->move('dataperalihanjualbeli/', $fileName8);
        $file9->move('dataperalihanjualbeli/', $fileName9);
        $file10->move('dataperalihanjualbeli/', $fileName10);
        $file11->move('dataperalihanjualbeli/', $fileName11);

        $peralihanjualbeli->pertamaktp  = $fileName1;
        $peralihanjualbeli->pertamakk  = $fileName2;
        $peralihanjualbeli->pertamaktppasangan  = $fileName3;
        $peralihanjualbeli->pertamaaktanikah  = $fileName4;
        $peralihanjualbeli->pertamanpwp  = $fileName5;
        $peralihanjualbeli->pertamapbb  = $fileName6;
        $peralihanjualbeli->pertamasertifikat  = $fileName7;
        $peralihanjualbeli->pertamakwitansi  = $fileName8;
        $peralihanjualbeli->keduaktp  = $fileName9;
        $peralihanjualbeli->keduakk  = $fileName10;
        $peralihanjualbeli->keduanpwp  = $fileName11;
        // $peralihanjualbeli->users_id = Auth::id();
        $peralihanjualbeli->update();
        return redirect('/peralihanjualbeli/index')->with("sukses", "Dokumen Peralihan Hak Jual Beli Berhasil Di upload");

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
        $peralihanjualbeli =\App\Peralihanjualbeli::find($id);

         $file1 = $request->file('akta');
         $fileName1   = 'akta-'. $file1->getClientOriginalName();
         $file1->move('dataperalihanjualbeli/', $fileName1);
        
        $peralihanjualbeli->akta  = $fileName1;
        $peralihanjualbeli->status = 'diterima';
        $peralihanjualbeli->save();
        $userid=$peralihanjualbeli->users->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Selamat Pengajuanmu untuk Hak Peralihan Jual Beli Sudah diterima', function ($m) use ($user) {
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
        Mail::raw( 'Maaf Pengajuanmu untuk Hak Peralihan Jual Beli di tolak oleh Admin, silahkan periksa berkas dan lakukan pengajuan ulang', function ($m) use ($user) {
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
        Mail::raw( 'Pengajuanmu untuk Hak Peralihan Jual Beli sedang di proses oleh Admin', function ($m) use ($user) {
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