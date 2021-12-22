<?php

namespace App\Http\Controllers;
use App\TandaTerima;
use App\Instansi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class TandaTerimaController extends Controller
{
    public function index()
    {
        $data_tanter = \App\TandaTerima::all();
        return view('tandaterima.index',['data_tanter'=> $data_tanter]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        // $data_klasifikasi = \App\Klasifikasi::all();
        return view('tandaterima.create');
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
        $data = new TandaTerima();
        $data->jenis_dokumen   = $request->input('jenis_dokumen');
        $data->jenis_hak        = $request->input('jenis_hak');
        $data->nomor_antrian        = $request->input('nomor_antrian');
        $data->no_sertifikat  = $request->input('no_sertifikat');
        $data->penyerah_sertifikat  = $request->input('penyerah_sertifikat');
        $data->sertifikat_atas_nama  = $request->input('sertifikat_atas_nama');
        $data->nomor_handphone  = $request->input('nomor_handphone');
        $data->kelurahan = $request->input('kelurahan');
        $data->luas = $request->input('luas');
        $data->keterangan = $request->input('keterangan');
        $data->users_id = Auth::id();
        $data->save();
        return redirect('/tandaterima/index')->with("sukses", "Data Tanda Terima Berhasil Ditambahkan");

     }


    //function untuk hapus
    public function delete($id)
    {
        $data=\App\TandaTerima::find($id);
        $data->delete();
        return redirect('tandaterima/index')->with('sukses','Data Surat Peralihan Hak Jual Beli Berhasil Dihapus');
    }

    public function cetak_pdf(Request $request,$id)
    {
        $inst = Instansi::first();
        $data = \App\TandaTerima::find($id);
        // dd($data);
        $pdf = PDF::loadview('tandaterima.cetaktanterPDF', compact('inst','data'));
        return $pdf->stream();
    }

 
}
