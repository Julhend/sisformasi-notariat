<?php

namespace App\Http\Controllers;
use Mail;
use App\User;
use App\PeralihanHibah;
use App\Instansi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class PeralihanHibahController extends Controller
{
    public function index()
    {
        $data_peralihan = \App\PeralihanHibah::all();
        return view('peralihanhibah.index',['data_peralihan'=> $data_peralihan]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        // $data_klasifikasi = \App\Klasifikasi::all();
        return view('peralihanhibah.create');
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
        $peralihanhibah = new PeralihanHibah();
        $peralihanhibah->jenis_pengajuan   = $request->input('jenis');
        $peralihanhibah->tgl_pengajuan        = $request->input('tgl_pengajuan');
        $peralihanhibah->pihakpertama  = $request->input('pihakpertama');
        $peralihanhibah->pihakkedua = $request->input('pihakkedua');
        $peralihanhibah->keterangan = $request->input('keterangan');
        $peralihanhibah->users_id = Auth::id();
        $peralihanhibah->save();
        $userid=$peralihanhibah->users->id;
        $nomor_antrian = $peralihanhibah->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Pengajuanmu untuk Peralihan Hak Hibah dengan nomor antrian '.$nomor_antrian.', berhasil dikirim. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('/peralihanhibah/index')->with("sukses", "Data Surat Peralihan Hak Hibah Berhasil Ditambahkan");

     }

      public function see($id)
    {
        $peralihanhibah = \App\PeralihanHibah::find($id);
        return view('peralihanhibah.upload',['peralihanhibah'=>$peralihanhibah]);
    }

     public function upload (Request $request,$id)
     {
        $request->validate([
            'pemberikk'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pemberiktp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pemberiktppasangan'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pemberiaktanikah'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pemberinpwp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pemberipbb'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'pemberisertifikat'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'penerimaktp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'penerimakk'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'penerimanpwp'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
        ]);
        $peralihanhibah = \App\PeralihanHibah::find($id);
        $file1 = $request->file('pemberikk');
        $file2 = $request->file('pemberiktp');
        $file3 = $request->file('pemberiktppasangan');
        $file4 = $request->file('pemberiaktanikah');
        $file5 = $request->file('pemberinpwp');
        $file6 = $request->file('pemberipbb');
        $file7 = $request->file('pemberisertifikat');
        $file9 = $request->file('penerimakk');
        $file10 = $request->file('penerimaktp');
        $file11 = $request->file('penerimanpwp');

        $fileName1   = 'ktp-'. $file2->getClientOriginalName();
        $fileName2   = 'kk-'. $file1->getClientOriginalName();
        $fileName3   = 'ktpasangan-'. $file3->getClientOriginalName();
        $fileName4   = 'aktanikah-'. $file4->getClientOriginalName();
        $fileName5   = 'npwp-'. $file5->getClientOriginalName();
        $fileName6   = 'pbb-'. $file6->getClientOriginalName();
        $fileName7   = 'sertifikat-'. $file7->getClientOriginalName();
        $fileName9   = 'ktp-pihak-kedua-'. $file9->getClientOriginalName();
        $fileName10   = 'kk-pihak-kedua-'. $file10->getClientOriginalName();
        $fileName11   = 'npwp-pihak-kedua-'. $file11->getClientOriginalName();

        $file1->move('dataperalihanhibah/', $fileName1);
        $file2->move('dataperalihanhibah/', $fileName2);
        $file3->move('dataperalihanhibah/', $fileName3);
        $file4->move('dataperalihanhibah/', $fileName4);
        $file5->move('dataperalihanhibah/', $fileName5);
        $file6->move('dataperalihanhibah/', $fileName6);
        $file7->move('dataperalihanhibah/', $fileName7);
        $file9->move('dataperalihanhibah/', $fileName9);
        $file10->move('dataperalihanhibah/', $fileName10);
        $file11->move('dataperalihanhibah/', $fileName11);

        $peralihanhibah->pemberiktp  = $fileName1;
        $peralihanhibah->pemberikk  = $fileName2;
        $peralihanhibah->pemberiktppasangan  = $fileName3;
        $peralihanhibah->pemberiaktanikah  = $fileName4;
        $peralihanhibah->pemberinpwp  = $fileName5;
        $peralihanhibah->pemberipbb  = $fileName6;
        $peralihanhibah->pemberisertifikat  = $fileName7;
        $peralihanhibah->penerimaktp  = $fileName9;
        $peralihanhibah->penerimakk  = $fileName10;
        $peralihanhibah->penerimanpwp  = $fileName11;
     
        $peralihanhibah->update();
        return redirect('/peralihanhibah/index')->with("sukses", "Dokumen Peralihan Hak Hibah Berhasil Di upload");

     }

    //function untuk download file
    public function downfunc(){

        $peralihanhibah=DB::table('peralihanhibah')->get();
        return view('peralihanhibah.upload',compact('peralihanhibah'));
    }

    //function untuk masuk ke view edit
     public function edit ($id)
    {
        
        $peralihanhibah = \App\PeralihanHibah::find($id);
        return view('peralihanhibah.edit',['peralihanhibah'=>$peralihanhibah]);
    }

    public function update (Request $request, $id)
    {
        $peralihanhibah = \App\PeralihanHibah::find($id);
        $peralihanhibah->jenis_pengajuan = $request->jenis;
        $peralihanhibah->tgl_pengajuan = $request->tgl_pengajuan;
        $peralihanhibah->pihakpertama = $request->pihakpertama;
        $peralihanhibah->pihakkedua = $request->pihakkedua;
        $peralihanhibah->keterangan = $request->keterangan;
        $peralihanhibah->update();

        return redirect('peralihanhibah/index') ->with('sukses','Data Surat Peralihan Hak Hibah Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        $peralihanhibah=\App\PeralihanHibah::find($id);
        $peralihanhibah->delete();
        return redirect('peralihanhibah/index')->with('sukses','Data Surat Peralihan Hak Hibah Berhasil Dihapus');
    }
    public function upload_akta($id)
    {
        $peralihanhibah = \App\PeralihanHibah::find($id);
        return view('peralihanhibah.confirm',['peralihanhibah'=>$peralihanhibah]);
    }

    public function confirm(Request $request, $id)    
    {
        $peralihanhibah =\App\PeralihanHibah::find($id);

         $file1 = $request->file('akta');
         $fileName1   = 'akta-'. $file1->getClientOriginalName();
         $file1->move('dataperalihanhibah/', $fileName1);
        
        $peralihanhibah->akta  = $fileName1;
        $peralihanhibah->status = 'diterima';
        $peralihanhibah->save();
        $userid=$peralihanhibah->users->id;
        $nomor_antrian = $peralihanhibah->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Selamat Pengajuanmu untuk Peralihan Hak Hibah dengan nomor antrian '.$nomor_antrian.',sudah di terima. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanhibah/index')->with('sukses','Surat Peralihan Hak Hibah Berhasil Dikonfirmasi');
    }
    public function reject($id)
    {
        $peralihanhibah=\App\PeralihanHibah::find($id);
        $peralihanhibah->status = 'ditolak';
        $peralihanhibah->save();
        $userid=$peralihanhibah->users->id;
        $nomor_antrian = $peralihanhibah->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Maaf Pengajuanmu untuk Peralihan Hak Hibah dengan nomor antrian '.$nomor_antrian.', telah di tolak oleh Admin, silahkan periksa berkas dan laukan pengajuan ulang. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanhibah/index')->with('sukses','Surat Peralihan Hak Hibah Berhasil Dikonfirmasi');
    }
    public function process($id)
    {
        $peralihanhibah=\App\PeralihanHibah::find($id);
        $peralihanhibah->status = 'diproses';
        $peralihanhibah->save();
        $userid=$peralihanhibah->users->id;
        $nomor_antrian = $peralihanhibah->id;
        $user = User::findOrFail($userid);
        Mail::raw( 'Pengajuanmu untuk Peralihan Hak Hibah dengan nomor antrian '.$nomor_antrian.',sedang di proses oleh admin. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanhibah/index')->with('sukses','Surat Peralihan Hak Hibah Berhasil Dikonfirmasi');
    }
    public function resend($id)
    {
        $peralihanhibah=\App\PeralihanHibah::find($id);
        $peralihanhibah->status = 'pending';
        $peralihanhibah->save();
        
        $userid=$peralihanhibah->users->id;
        $user = User::findOrFail($userid);
        $nomor_antrian=$peralihanhibah->id;
        Mail::raw( 'Pengajuan ulang untuk Hak Hibah dengan nomor antrian '.$nomor_antrian.' berhasil di kirim kembali. Jika ada pertanyaan silahkan kirim pesan whatsapp ke nomor 0811 6687 491', function ($m) use ($user) {
            $m->from('noreply.auginugrohonotaris@gmail.com', 'Sisformasi Kenotariatan');

            $m->to($user->email, $user->name)->subject('Status Pengajuan');
        });
        return redirect('peralihanhibah/index')->with('sukses','Surat Peralihan Hak Hibah berhasil di Kirim Kembali');
    }
 
}
