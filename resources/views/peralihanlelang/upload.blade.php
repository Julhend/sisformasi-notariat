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
        <form action="/peralihanlelang/{{$peralihanlelang->id}}/upload" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Upload Dokumen Peralihan Hak Lelang</h3>
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
            <td width="2%">1</td><td width="30%">KTP </td><td width="10%"><a href="/dataperalihanlelang/{{$peralihanlelang->ktp}}" download="{{$peralihanlelang->ktp}}">{{$peralihanlelang->ktp}}</td><td width="10%"><input name="ktp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanlelang->ktp}}" required></td></tr>
            <tr class="even">
            <td width="2%">2</td><td width="30%">Risalah Lelang</td><td width="10%"><a href="/dataperalihanlelang/{{$peralihanlelang->risalah_lelang}}" download="{{$peralihanlelang->risalah_lelang}}">{{$peralihanlelang->risalah_lelang}}</td><td width="10%"><input name="risalah_lelang" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanlelang->risalah_lelang}}" required></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">3</td><td width="30%">Kwitansi Lelang</td><td width="10%"><a href="/dataperalihanlelang/{{$peralihanlelang->kwitansi_lelang}}" download="{{$peralihanlelang->kwitansi_lelang}}">{{$peralihanlelang->kwitansi_lelang}}</td><td width="10%"><input name="kwitansi_lelang" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanlelang->kwitansi_lelang}}" required></td></tr></td></tr>
            <tr class="even">
            <td width="2%">4</td><td width="30%">Sertifikat Asli</td><td width="10%"><a href="/dataperalihanlelang/{{$peralihanlelang->sertifikat}}" download="{{$peralihanlelang->sertifikat}}">{{$peralihanlelang->sertifikat}}</td><td width="10%"><input name="sertifikat" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanlelang->sertifikat}}" required></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">5</td><td width="30%">PBB 2021 (Yang telah di bayar)</td><td width="10%"><a href="/dataperalihanlelang/{{$peralihanlelang->pbb}}" download="{{$peralihanlelang->pbb}}">{{$peralihanlelang->pbb}}</td><td width="10%"><input name="pbb" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanlelang->pbb}}" required></td></tr></td></tr>
            
            </tbody>
            </table><div class="keys" style="display:none" title="/pengajuan/view?IDPengajuan=992&amp;IDJenisSidang=6"><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span></div>
            </div>        
            </div>
            <!--------------------table--------------------->
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SELESAI</button>
            <a class="btn btn-danger btn-sm" href="/dataperalihanlelang/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
