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
        <form action="/peralihanwaris/{{$peralihanwaris->id}}/upload" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Upload Dokumen Peralihan Hak Waris</h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
            <!--------------------table--------------------->
            <label class="fas fa-dot-circle"> Almarhum / Almarhumah</label>
            <div class="portlet-content col-12">
             <div class="table-responsive" id="news-grid">
            <table class="table table-hover">
            <thead>
            <tr>
            <th id="news-grid_c0">No</th><th id="news-grid_c1">Upload Dokumen</th><th id="news-grid_c2">File</th><th id="news-grid_c3">Action</th></tr>
            </thead>
            <tbody>
                
            <tr class="odd">
            <td width="2%">1</td><td width="30%">Akta Kematian </td><td width="10%"><a href="/dataperalihanwaris/{{$peralihanwaris->almaktakematian}}" download="{{$peralihanwaris->almaktakematian}}">{{$peralihanwaris->almaktakematian}}</td><td width="10%"><input name="almaktakematian" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanwaris->almaktakematian}}"></td></tr>
            <tr class="even">
            <td width="2%">2</td><td width="30%">Akta Nikah</td><td width="10%"><a href="/dataperalihanwaris/{{$peralihanwaris->almaktanikah}}" download="{{$peralihanwaris->almaktanikah}}">{{$peralihanwaris->almaktanikah}}</td><td width="10%"><input name="almaktanikah" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanwaris->almaktanikah}}"></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">3</td><td width="30%">KK</td><td width="10%"><a href="/dataperalihanwaris/{{$peralihanwaris->almkk}}" download="{{$peralihanwaris->almkk}}">{{$peralihanwaris->almkk}}</td><td width="10%"><input name="almkk" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanwaris->almkk}}"></td></tr></td></tr>
            <tr class="even">
            <td width="2%">4</td><td width="30%">NPWP</td><td width="10%"><a href="/dataperalihanwaris/{{$peralihanwaris->almnpwp}}" download="{{$peralihanwaris->almnpwp}}">{{$peralihanwaris->almnpwp}}</td><td width="10%"><input name="almnpwp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanwaris->almnpwp}}"></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">5</td><td width="30%">PBB 2021 (Yang telah di bayar)</td><td width="10%"><a href="/dataperalihanwaris/{{$peralihanwaris->almpbb}}" download="{{$peralihanwaris->almpbb}}">{{$peralihanwaris->almpbb}}</td><td width="10%"><input name="almpbb" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanwaris->almpbb}}"></td></tr></td></tr>
            <tr class="even">
            <td width="2%">6</td><td width="30%">Sertifikat Asli</td><td width="10%"><a href="/dataperalihanwaris/{{$peralihanwaris->almsertifikat}}" download="{{$peralihanwaris->almsertifikat}}">{{$peralihanwaris->almsertifikat}}</td><td width="10%"><input name="almsertifikat" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanwaris->almsertifikat}}"></td></tr></td></tr>
            </tbody>
            </table><div class="keys" style="display:none" title="/pengajuan/view?IDPengajuan=992&amp;IDJenisSidang=6"><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span></div>
            </div>        
            </div>
              <label class="fas fa-dot-circle"> Pihak Penerima</label>
            <div class="portlet-content col-12">
             <div class="table-responsive" id="news-grid">
            <table class="table table-hover">
            <thead>
            <tr>
            <th id="news-grid_c0">No</th><th id="news-grid_c1">Upload Dokumen</th><th id="news-grid_c2">File</th><th id="news-grid_c3">Action</th></tr>
            </thead>
            <tbody>
            <tr class="odd">
            <td width="2%">1</td><td width="30%">KTP</td><td width="10%"><a href="/dataperalihanwaris/{{$peralihanwaris->penerimaktp}}" download="{{$peralihanwaris->penerimaktp}}">{{$peralihanwaris->penerimaktp}}</td><td width="10%"><input name="penerimaktp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanwaris->penerimaktp}}" ></td></tr></td></tr></td></tr>
            <tr class="even">
            <td width="2%">2</td><td width="30%">KK</td><td width="10%"><a href="/dataperalihanwaris/{{$peralihanwaris->penerimakk}}" download="{{$peralihanwaris->penerimakk}}">{{$peralihanwaris->penerimakk}}</td><td width="10%"><input name="penerimakk" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanwaris->penerimakk}}" ></td></tr></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">3</td><td width="30%">Akta Lahir</td><td width="10%"><a href="/dataperalihanwaris/{{$peralihanwaris->penerimaaktalahir}}" download="{{$peralihanwaris->penerimaaktalahir}}">{{$peralihanwaris->penerimaaktalahir}}</td><td width="10%"><input name="penerimaaktalahir" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanwaris->penerimaaktalahir}}" ></td></tr></td></tr></td></tr>
            </tbody>
            </table><div class="keys" style="display:none" title="/pengajuan/view?IDPengajuan=992&amp;IDJenisSidang=6"><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span></div>
            </div>        
            </div>
            <!--------------------table--------------------->
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SELESAI</button>
            <a class="btn btn-danger btn-sm" href="/dataperalihanwaris/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
