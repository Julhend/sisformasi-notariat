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
        <form action="/peralihanjualbeli/{{$peralihanjualbeli->id}}/upload" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Upload Dokumen Peralihan Hak Jual Beli</h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
            <!--------------------table--------------------->
            <label class="fas fa-dot-circle"> Pihak Pertama - <i style="color:red;">Harus diupload semua!</i></label>
            <div class="portlet-content col-12">
             <div class="table-responsive" id="news-grid">
            <table class="table table-hover">
            <thead>
            <tr>
            <th id="news-grid_c0">No</th><th id="news-grid_c1">Upload Dokumen</th><th id="news-grid_c2">File</th><th id="news-grid_c3">Action</th></tr>
            </thead>
            <tbody>
                
            <tr class="odd">
            <td width="2%">1</td><td width="11%">KTP</td><td width="10%"><a href="/dataperalihanjualbeli/{{$peralihanjualbeli->pertamaktp}}" download="{{$peralihanjualbeli->pertamaktp}}">{{$peralihanjualbeli->pertamaktp}}</td><td width="12%"><input name="pertamaktp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanjualbeli->pertamaktp}}"></td></tr>
            <tr class="even">
            <td width="2%">2</td><td width="11%">KTP Pasangan</td><td width="10%"><a href="/dataperalihanjualbeli/{{$peralihanjualbeli->pertamaktppasangan}}" download="{{$peralihanjualbeli->pertamaktppasangan}}">{{$peralihanjualbeli->pertamaktppasangan}}</td><td width="12%"><input name="pertamaktppasangan" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanjualbeli->pertamaktppasangan}}"></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">3</td><td width="11%">KK</td><td width="10%"><a href="/dataperalihanjualbeli/{{$peralihanjualbeli->pertamakk}}" download="{{$peralihanjualbeli->pertamakk}}">{{$peralihanjualbeli->pertamakk}}</td><td width="12%"><input name="pertamakk" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanjualbeli->pertamakk}}"></td></tr></td></tr>
            <tr class="even">
            <td width="2%">4</td><td width="11%">Akta Nikah</td><td width="10%"><a href="/dataperalihanjualbeli/{{$peralihanjualbeli->pertamaaktanikah}}" download="{{$peralihanjualbeli->pertamaaktanikah}}">{{$peralihanjualbeli->pertamaaktanikah}}</td><td width="12%"><input name="pertamaaktanikah" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanjualbeli->pertamaaktanikah}}"></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">5</td><td width="11%">NPWP</td><td width="10%"><a href="/dataperalihanjualbeli/{{$peralihanjualbeli->pertamanpwp}}" download="{{$peralihanjualbeli->pertamanpwp}}">{{$peralihanjualbeli->pertamanpwp}}</td><td width="12%"><input name="pertamanpwp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanjualbeli->pertamanpwp}}"></td></tr></td></tr>
            <tr class="even">
            <td width="2%">6</td><td width="11%">PBB 2021 (Yang telah dibayar)</td><td width="10%"><a href="/dataperalihanjualbeli/{{$peralihanjualbeli->pertamapbb}}" download="{{$peralihanjualbeli->pertamapbb}}">{{$peralihanjualbeli->pertamapbb}}</td><td width="12%"><input name="pertamapbb" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanjualbeli->pertamapbb}}"></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">7</td><td width="11%">Sertifikat Asli</td><td width="10%"><a href="/dataperalihanjualbeli/{{$peralihanjualbeli->pertamasertifikat}}" download="{{$peralihanjualbeli->pertamasertifikat}}">{{$peralihanjualbeli->pertamasertifikat}}</td><td width="12%"><input name="pertamasertifikat" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanjualbeli->pertamasertifikat}}"></td></tr></td></tr>
            <tr class="even">
            <td width="2%">8</td><td width="11%">Kwitansi Jual Beli Asli</td><td width="10%"><a href="/dataperalihanjualbeli/{{$peralihanjualbeli->pertamakwitansi}}" download="{{$peralihanjualbeli->pertamakwitansi}}">{{$peralihanjualbeli->pertamakwitansi}}</td><td width="12%"><input name="pertamakwitansi" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanjualbeli->pertamakwitansi}}"></td></tr></td></tr>
            </tbody>
            </table><div class="keys" style="display:none" title="/pengajuan/view?IDPengajuan=992&amp;IDJenisSidang=6"><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span></div>
            </div>        
            </div>
              <label class="fas fa-dot-circle"> Pihak Kedua - <i style="color:red;">Harus diupload semua!</i></label>
            <div class="portlet-content col-12">
             <div class="table-responsive" id="news-grid">
            <table class="table table-hover">
            <thead>
            <tr>
            <th id="news-grid_c0">No</th><th id="news-grid_c1">Upload Dokumen</th><th id="news-grid_c2">File</th><th id="news-grid_c3">Action</th></tr>
            </thead>
            <tbody>
            <tr class="odd">
            <td width="2%">1</td><td width="11%">KTP</td><td width="10%"><a href="/dataperalihanjualbeli/{{$peralihanjualbeli->keduaktp}}" download="{{$peralihanjualbeli->keduaktp}}">{{$peralihanjualbeli->keduaktp}}</td><td width="12%"><input name="keduaktp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanjualbeli->keduaktp}}"></td></tr></td></tr></td></tr>
            <tr class="even">
            <td width="2%">2</td><td width="11%">KK</td><td width="10%"><a href="/dataperalihanjualbeli/{{$peralihanjualbeli->keduakk}}" download="{{$peralihanjualbeli->keduakk}}">{{$peralihanjualbeli->keduakk}}</td><td width="12%"><input name="keduakk" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanjualbeli->keduakk}}"></td></tr></td></tr></td></tr>
            <tr class="odd">
            <td width="2%">3</td><td width="11%">NPWP</td><td width="10%"><a href="/dataperalihanjualbeli/{{$peralihanjualbeli->keduanpwp}}" download="{{$peralihanjualbeli->keduanpwp}}">{{$peralihanjualbeli->keduanpwp}}</td><td width="12%"><input name="keduanpwp" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$peralihanjualbeli->keduanpwp}}"></td></tr></td></tr></td></tr>
            </tbody>
            </table><div class="keys" style="display:none" title="/pengajuan/view?IDPengajuan=992&amp;IDJenisSidang=6"><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span><span>992</span></div>
            </div>        
            </div>
            <!--------------------table--------------------->
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> UPLOAD</button>
            <a class="btn btn-danger btn-sm" href="/peralihanjualbeli/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
