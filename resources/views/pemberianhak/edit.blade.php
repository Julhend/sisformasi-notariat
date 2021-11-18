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
        <form action="/pemberianhak/{{$pemberianhak->id}}/update" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Edit Data Pemberian / Pembaruan Hak </h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="jenis">Jenis Pengajuan</label>
                    <input name="jenis" type="text" class="form-control bg-light" id="jenis"
                        placeholder="Jenis Pengajuan" value="{{$pemberianhak->jenis_pengajuan}}" required>
                    <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                    <input name="tgl_pengajuan" type="date" class="form-control bg-light" id="tgl_pengajuan"
                        value="{{$pemberianhak->tgl_pengajuan}}" required>
                </div>
                <div class="col-6">
                    <label for="keterangan">Keterangan</label>
                    <input name="keterangan" type="text" class="form-control bg-light" id="keterangan"
                        placeholder="Keterangan" value="{{$pemberianhak->keterangan}}" required>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/pemberianhak/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection
