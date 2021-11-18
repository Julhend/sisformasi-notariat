<?php

namespace App\Http\Controllers;
use App\Peralihanjualbeli;
use App\Instansi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class ArsipController extends Controller
{
    public function jualbeli()
    {
        $data_arsip = \App\Peralihanjualbeli::all();
        return view('arsip.jualbeli',['data_arsip'=> $data_arsip]);
    }
    public function hibah()
    {
        $data_arsip = \App\PeralihanHibah::all();
        return view('arsip.hibah',['data_arsip'=> $data_arsip]);
    }
    public function waris()
    {
        $data_arsip = \App\PeralihanWaris::all();
        return view('arsip.waris',['data_arsip'=> $data_arsip]);
    }
    public function lelang()
    {
        $data_arsip = \App\PeralihanLelang::all();
        return view('arsip.lelang',['data_arsip'=> $data_arsip]);
    }
    public function pemberianhak()
    {
        $data_arsip = \App\PemberianHak::all();
        return view('arsip.pemberianhak',['data_arsip'=> $data_arsip]);
    }
    public function penghapusanhak()
    {
        $data_arsip = \App\PenghapusanHak::all();
        return view('arsip.penghapusanhak',['data_arsip'=> $data_arsip]);
    }
    public function suratkuasamenjual()
    {
        $data_arsip = \App\SuratKuasaMenjual::all();
        return view('arsip.suratkuasamenjual',['data_arsip'=> $data_arsip]);
    }
    public function suratpernyataanwaris()
    {
        $data_arsip = \App\SuratPernyataanWaris::all();
        return view('arsip.suratpernyataanwaris',['data_arsip'=> $data_arsip]);
    }

}
