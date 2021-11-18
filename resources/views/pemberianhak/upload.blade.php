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
        <form action="/pemberianhak/{{$pemberianhak->id}}/upload" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Upload Dokumen Pemberian / Pembaruan Hak</h3>
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
            <td width="2%">1</td><td width="30%">KTP </td><td width="10%"><a href="/datapemberianhak/{{$pemberianhak->ktp}}" download="{{$pemberianhak->ktp}}">{{$pemberianhak->ktp}}</td><td width="10%"><input name="ktp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$pemberianhak->ktp}}" required></td></tr>
            <tr class="even">
            <td width="2%">2</td><td width="30%">KK</td><td width="10%"><a href="/datapemberianhak/{{$pemberianhak->kk}}" download="{{$pemberianhak->kk}}">{{$pemberianhak->kk}}</td><td width="10%"><input name="kk" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$pemberianhak->kk}}" required></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">3</td><td width="30%">Sertifikat Asli</td><td width="10%"><a href="/datapemberianhak/{{$pemberianhak->sertifikat}}" download="{{$pemberianhak->sertifikat}}">{{$pemberianhak->sertifikat}}</td><td width="10%"><input name="sertifikat" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$pemberianhak->sertifikat}}" required></td></tr></td></tr>
            <tr class="even">
            <td width="2%">4</td><td width="30%">PBB 2021 (Yang telah di bayar)</td><td width="10%"><a href="/datapemberianhak/{{$pemberianhak->pbb}}" download="{{$pemberianhak->pbb}}">{{$pemberianhak->pbb}}</td><td width="10%"><input name="pbb" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$pemberianhak->pbb}}" required></td></tr></td></tr>    
            </tbody>
            </table><div class="keys" style="display:none" title="/pengajuan/view?IDPengajuan=992&amp;IDJenisSidang=6"><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span></div>
            </div>        
            </div>
            <!--------------------table--------------------->
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SELESAI</button>
            <a class="btn btn-danger btn-sm" href="/pemberianhak/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
