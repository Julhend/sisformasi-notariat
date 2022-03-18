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
        <form action="/penghapusanhak/{{$penghapusanhak->id}}/upload" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Upload Dokumen Penghapusan Hak Tanggungan / Roya</h3>
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
            <td width="2%">1</td><td width="30%">Sertifikat Asli </td><td width="10%"><a href="/datapenghapusanhak/{{$penghapusanhak->sertifikat_asli}}" download="{{$penghapusanhak->sertifikat_asli}}">{{$penghapusanhak->sertifikat_asli}}</td><td width="10%"><input name="sertifikat_asli" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$penghapusanhak->sertifikat_asli}}"></td></tr>
            <tr class="even">
            <td width="2%">2</td><td width="30%">Sertifikat Hak Tanggungan</td><td width="10%"><a href="/datapenghapusanhak/{{$penghapusanhak->sertifikat_hak_tanggungan}}" download="{{$penghapusanhak->sertifikat_hak_tanggungan}}">{{$penghapusanhak->sertifikat_hak_tanggungan}}</td><td width="10%"><input name="sertifikat_hak_tanggungan" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$penghapusanhak->sertifikat_hak_tanggungan}}"></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">3</td><td width="30%">Surat Roya</td><td width="10%"><a href="/datapenghapusanhak/{{$penghapusanhak->surat_roya}}" download="{{$penghapusanhak->surat_roya}}">{{$penghapusanhak->surat_roya}}</td><td width="10%"><input name="surat_roya" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$penghapusanhak->surat_roya}}"></td></tr></td></tr>
            <tr class="even">S
            <td width="2%">4</td><td width="30%">KTP</td><td width="10%"><a href="/datapenghapusanhak/{{$penghapusanhak->ktp}}" download="{{$penghapusanhak->ktp}}">{{$penghapusanhak->ktp}}</td><td width="10%"><input name="ktp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$penghapusanhak->ktp}}"></td></tr></td></tr>    
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
