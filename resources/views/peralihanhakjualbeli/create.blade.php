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
        <form action="/peralihanjualbeli/tambah" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Peralihan Hak Jual Beli</h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
      
            
                <div class="col-6">
                    <label for="jenis">Jenis Pengajuan</label>
                    <input value="{{old('jenis')}}" name="jenis" type="text" class="form-control bg-light"
                        id="jenis" placeholder="Jenis Pengajuan" required>
                        <label for="tglpengajuan">Tanggal Pengajuan</label>
                        <input value="{{old('tgl_pengajuan')}}" name="tgl_pengajuan" type="date" class="form-control bg-light"
                            id="tglpengajuan" required>
                        </div>
                <div class="col-6">
                    <label for="pihakpertama">Pihak Pertama</label>
                     <input value="{{old('pihakpertama')}}" name="pihakpertama" type="text" class="form-control bg-light"
                   id="pihakpertama" placeholder="Pihak Pertama" required>
                    <label for="pihakkedua">Pihak Kedua</label>
                    <input value="{{old('pihakkedua')}}" name="pihakkedua" type="text" class="form-control bg-light"
                        id="pihakkedua" placeholder="Pihak Kedua" required>
                    <label for="keterangan">Keterangan</label>
                    <input value="{{old('keterangan')}}" name="keterangan" type="text" class="form-control bg-light"
                        id="keterangan" placeholder="Keterangan" required>
                    <div class="form-group">
                        {{-- <label for="exampleFormControlFile1">File</label>
                        <input name="filemasuk" type="file" class="form-control-file" id="exampleFormControlFile1"
                            required>
                        <small id="exampleFormControlFile1" class="text-danger">
                            Pastikan file anda ( jpg,jpeg,png,doc,docx,pdf ) !!!
                        </small> --}}
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
