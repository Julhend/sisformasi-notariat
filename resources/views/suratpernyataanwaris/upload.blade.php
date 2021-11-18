@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="/suratpernyataanwaris/{{$suratpernyataanwaris->id}}/upload" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Upload Dokumen Surat Pernyataan & Keterangan Waris</h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
            <!--------------------table--------------------->
            {{-- <label class="fas fa-dot-circle"> Almarhum / Almarhumah</label> --}}
            <div class="portlet-content col-12">
             <div class="table-responsive" id="news-grid">
            <table class="table table-hover">
            <thead>
            <tr>
            <th id="news-grid_c0">No</th><th id="news-grid_c1">Upload Dokumen</th><th id="news-grid_c2">File</th><th id="news-grid_c3">Action</th></tr>
            </thead>
            <tbody>
                
            <tr class="odd">
            <td width="2%">1</td><td width="30%">Akta Kematian Alm </td><td width="10%"><a href="/datasuratpernyataanwaris/{{$suratpernyataanwaris->akta_kematian}}" download="{{$suratpernyataanwaris->akta_kematian}}">{{$suratpernyataanwaris->akta_kematian}}</td><td width="10%"><input name="akta_kematian" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$suratpernyataanwaris->akta_kematian}}" required></td></tr>
            <tr class="even">
            <td width="2%">2</td><td width="30%">KTP Alm</td><td width="10%"><a href="/datasuratpernyataanwaris/{{$suratpernyataanwaris->ktp_alm}}" download="{{$suratpernyataanwaris->ktp_alm}}">{{$suratpernyataanwaris->ktp_alm}}</td><td width="10%"><input name="ktp_alm" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$suratpernyataanwaris->ktp_alm}}" required></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">3</td><td width="30%">KK Alm</td><td width="10%"><a href="/datasuratpernyataanwaris/{{$suratpernyataanwaris->kk_alm}}" download="{{$suratpernyataanwaris->kk_alm}}">{{$suratpernyataanwaris->kk_alm}}</td><td width="10%"><input name="kk_alm" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$suratpernyataanwaris->kk_alm}}" required></td></tr></td></tr>
            <tr class="even">
                <td width="2%">4</td><td width="30%">Akta Nikah Alm</td><td width="10%"><a href="/datasuratpernyataanwaris/{{$suratpernyataanwaris->akta_nikah_alm}}" download="{{$suratpernyataanwaris->akta_nikah_alm}}">{{$suratpernyataanwaris->akta_nikah_alm}}</td><td width="10%"><input name="akta_nikah_alm" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$suratpernyataanwaris->akta_nikah_alm}}" required></td></tr></td></tr>
            <tr class="odd">
                <td width="2%">5</td><td width="30%">KTP Penerima</td><td width="10%"><a href="/datasuratpernyataanwaris/{{$suratpernyataanwaris->ktp_penerima}}" download="{{$suratpernyataanwaris->ktp_penerima}}">{{$suratpernyataanwaris->ktp_penerima}}</td><td width="10%"><input name="ktp_penerima" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$suratpernyataanwaris->ktp_penerima}}" required></td></tr></td></tr>
            <tr class="even">
                <td width="2%">6</td><td width="30%">KK Penerima</td><td width="10%"><a href="/datasuratpernyataanwaris/{{$suratpernyataanwaris->kk_penerima}}" download="{{$suratpernyataanwaris->kk_penerima}}">{{$suratpernyataanwaris->kk_penerima}}</td><td width="10%"><input name="kk_penerima" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$suratpernyataanwaris->kk_penerima}}" required></td></tr></td></tr>
            <tr class="odd">
                <td width="2%">7</td><td width="30%">Akta Lahir Penerima</td><td width="10%"><a href="/datasuratpernyataanwaris/{{$suratpernyataanwaris->akta_lahir_penerima}}" download="{{$suratpernyataanwaris->akta_lahir_penerima}}">{{$suratpernyataanwaris->akta_lahir_penerima}}</td><td width="10%"><input name="akta_lahir_penerima" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$suratpernyataanwaris->akta_lahir_penerima}}" required></td></tr></td></tr>
            </tbody>
            </table><div class="keys" style="display:none" title="/pengajuan/view?IDPengajuan=992&amp;IDJenisSidang=6"><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span></div>
            </div>        
            </div>
            <!--------------------table--------------------->
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SELESAI</button>
            <a class="btn btn-danger btn-sm" href="/datasuratpernyataanwaris/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
