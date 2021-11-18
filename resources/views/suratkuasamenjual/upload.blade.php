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
        <form action="/suratkuasamenjual/{{$suratkuasamenjual->id}}/upload" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Upload Dokumen Surat Kuasa Menjual</h3>
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
            <td width="2%">1</td><td width="30%">KTP Pemberi Kuasa </td><td width="10%"><a href="/datasuratkuasamenjual/{{$suratkuasamenjual->ktp_pemberi_kuasa}}" download="{{$suratkuasamenjual->ktp_pemberi_kuasa}}">{{$suratkuasamenjual->ktp_pemberi_kuasa}}</td><td width="10%"><input name="ktp_pemberi_kuasa" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$suratkuasamenjual->ktp_pemberi_kuasa}}" required></td></tr>
            <tr class="even">
            <td width="2%">2</td><td width="30%">KTP Penerima Kuasa</td><td width="10%"><a href="/datasuratkuasamenjual/{{$suratkuasamenjual->ktp_penerima_kuasa}}" download="{{$suratkuasamenjual->ktp_penerima_kuasa}}">{{$suratkuasamenjual->ktp_penerima_kuasa}}</td><td width="10%"><input name="ktp_penerima_kuasa" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$suratkuasamenjual->ktp_penerima_kuasa}}" required></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">3</td><td width="30%">Fotokopi Sertifikat</td><td width="10%"><a href="/datasuratkuasamenjual/{{$suratkuasamenjual->fotokopi_sertifikat}}" download="{{$suratkuasamenjual->fotokopi_sertifikat}}">{{$suratkuasamenjual->fotokopi_sertifikat}}</td><td width="10%"><input name="fotokopi_sertifikat" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$suratkuasamenjual->fotokopi_sertifikat}}" required></td></tr></td></tr>
            <tr class="even">
            </tbody>
            </table><div class="keys" style="display:none" title="/pengajuan/view?IDPengajuan=992&amp;IDJenisSidang=6"><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span></div>
            </div>        
            </div>
            <!--------------------table--------------------->
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SELESAI</button>
            <a class="btn btn-danger btn-sm" href="/datasuratkuasamenjual/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
