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
        <form action="/peralihanhibah/{{$peralihanhibah->id}}/upload" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Upload Dokumen Peralihan Hak Hibah</h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
            <!--------------------table--------------------->
            <label class="fas fa-dot-circle"> Pihak Pemberi</label>
            <div class="portlet-content col-12">
             <div class="table-responsive" id="news-grid">
            <table class="table table-hover">
            <thead>
            <tr>
            <th id="news-grid_c0">No</th><th id="news-grid_c1">Upload Dokumen</th><th id="news-grid_c2">File</th><th id="news-grid_c3">Action</th></tr>
            </thead>
            <tbody>
                
            <tr class="odd">
            <td width="2%">1</td><td width="30%">KTP</td><td width="10%"><a href="/dataperalihanhibah/{{$peralihanhibah->pemberiktp}}" download="{{$peralihanhibah->pemberiktp}}">{{$peralihanhibah->pemberiktp}}</td><td width="10%"><input name="pemberiktp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanhibah->pemberiktp}}" required></td></tr>
            <tr class="even">
            <td width="2%">2</td><td width="30%">KTP Pasangan</td><td width="10%"><a href="/dataperalihanhibah/{{$peralihanhibah->pemberiktppasangan}}" download="{{$peralihanhibah->pemberiktppasangan}}">{{$peralihanhibah->pemberiktppasangan}}</td><td width="10%"><input name="pemberiktppasangan" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanhibah->pemberiktppasangan}}" required></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">3</td><td width="30%">KK</td><td width="10%"><a href="/dataperalihanhibah/{{$peralihanhibah->pemberikk}}" download="{{$peralihanhibah->pemberikk}}">{{$peralihanhibah->pemberikk}}</td><td width="10%"><input name="pemberikk" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanhibah->pemberikk}}" required></td></tr></td></tr>
            <tr class="even">
            <td width="2%">4</td><td width="30%">Akta Nikah</td><td width="10%"><a href="/dataperalihanhibah/{{$peralihanhibah->pemberiaktanikah}}" download="{{$peralihanhibah->pemberiaktanikah}}">{{$peralihanhibah->pemberiaktanikah}}</td><td width="10%"><input name="pemberiaktanikah" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanhibah->pemberiaktanikah}}" required></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">5</td><td width="30%">NPWP</td><td width="10%"><a href="/dataperalihanhibah/{{$peralihanhibah->pemberinpwp}}" download="{{$peralihanhibah->pemberinpwp}}">{{$peralihanhibah->pemberinpwp}}</td><td width="10%"><input name="pemberinpwp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanhibah->pemberinpwp}}" required></td></tr></td></tr>
            <tr class="even">
            <td width="2%">6</td><td width="30%">PBB 2021 (Yang telah dibayar)</td><td width="10%"><a href="/dataperalihanhibah/{{$peralihanhibah->pemberipbb}}" download="{{$peralihanhibah->pemberipbb}}">{{$peralihanhibah->pemberipbb}}</td><td width="10%"><input name="pemberipbb" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanhibah->pemberipbb}}" required></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">7</td><td width="30%">Sertifikat Asli</td><td width="10%"><a href="/dataperalihanhibah/{{$peralihanhibah->pemberisertifikat}}" download="{{$peralihanhibah->pemberisertifikat}}">{{$peralihanhibah->pemberisertifikat}}</td><td width="10%"><input name="pemberisertifikat" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanhibah->pemberisertifikat}}" required></td></tr></td></tr>
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
            <td width="2%">1</td><td width="30%">KTP</td><td width="10%"><a href="/dataperalihanhibah/{{$peralihanhibah->penerimaktp}}" download="{{$peralihanhibah->penerimaktp}}">{{$peralihanhibah->penerimaktp}}</td><td width="10%"><input name="penerimaktp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanhibah->penerimaktp}}" required></td></tr></td></tr></td></tr>
            <tr class="even">
            <td width="2%">2</td><td width="30%">KK</td><td width="10%"><a href="/dataperalihanhibah/{{$peralihanhibah->penerimakk}}" download="{{$peralihanhibah->penerimakk}}">{{$peralihanhibah->penerimakk}}</td><td width="10%"><input name="penerimakk" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanhibah->penerimakk}}" required></td></tr></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">3</td><td width="30%">NPWP</td><td width="10%"><a href="/dataperalihanhibah/{{$peralihanhibah->penerimanpwp}}" download="{{$peralihanhibah->penerimanpwp}}">{{$peralihanhibah->penerimanpwp}}</td><td width="10%"><input name="penerimanpwp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanhibah->penerimanpwp}}" required></td></tr></td></tr></td></tr>
            </tbody>
            </table><div class="keys" style="display:none" title="/pengajuan/view?IDPengajuan=992&amp;IDJenisSidang=6"><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span></div>
            </div>        
            </div>
            <!--------------------table--------------------->
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SELESAI</button>
            <a class="btn btn-danger btn-sm" href="/dataperalihanhibah/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
