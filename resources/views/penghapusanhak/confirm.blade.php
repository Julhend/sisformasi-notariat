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
        <form action="/penghapusanhak/{{$penghapusanhak->id}}/confirm" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Upload Akta </h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
            <!--------------------table--------------------->
            <div class="portlet-content col-12">
             <div class="table-responsive" id="news-grid">
            <table class="table table-hover">
            <thead>
            <tr>
            <th id="news-grid_c0">No</th><th id="news-grid_c1">Upload Dokumen</th><th id="news-grid_c2">File</th><th id="news-grid_c3">Action</th></tr>
            </thead>
            <tbody>
                
            <tr class="odd">
            <td width="2%">1</td><td width="30%">AKTA</td><td width="10%"><a href="/datapenghapusanhak/{{$penghapusanhak->akta}}" download="{{$penghapusanhak->akta}}">{{$penghapusanhak->akta}}</td><td width="10%"><input name="akta" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$penghapusanhak->akta}}" required></td></tr>
            </tbody>
            </table><div class="keys" style="display:none" title="/pengajuan/view?IDPengajuan=992&amp;IDJenisSidang=6"><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span></div>
            </div>        
            </div>
            <!--------------------table--------------------->
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SELESAI</button>
            <a class="btn btn-danger btn-sm" href="/penghapusanhak/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
