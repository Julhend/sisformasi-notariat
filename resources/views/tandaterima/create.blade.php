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
        <form action="/tandaterima/tambah" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Tanda Terima</h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
      
            
                <div class="col-6">
                   <label for="jenis_dokumen">Jenis Dokumen</label>
                    <input value="{{old('jenis_dokumen')}}" name="jenis_dokumen" type="text" class="form-control bg-light"
                        id="jenis_hak" placeholder="Jenis Dokumen" required>
                    <label for="jenis_hak">Jenis Hak</label>
                    <input value="{{old('jenis_hak')}}" name="jenis_hak" type="text" class="form-control bg-light"
                        id="jenis_hak" placeholder="Jenis Hak" required>
                    <label for="nomor_antrian">Nomor Antrian</label>
                    <input value="{{old('nomor_antrian')}}" name="nomor_antrian" type="text" class="form-control bg-light"
                        id="nomor_antrian" placeholder="Nomor Antrian" required>
                    <label for="no_sertifikat">No Sertifikat</label>
                    <input value="{{old('no_sertifikat')}}" name="no_sertifikat" type="text" class="form-control bg-light"
                        id="no_sertifikat" placeholder="No Sertifikat" required>
                    <label for="penyerah_sertifikat">Penyerah Sertifikat</label>
                    <input value="{{old('penyerah_sertifikat')}}" name="penyerah_sertifikat" type="text" class="form-control bg-light"
                        id="penyerah_sertifikat" placeholder="Penyerah Sertifikat" required>
                </div>
                <div class="col-6">
                    <label for="sertifikat_atas_nama">Sertifikat A/N</label>
                    <input value="{{old('sertifikat_atas_nama')}}" name="sertifikat_atas_nama" type="text" class="form-control bg-light"
                        id="sertifikat_atas_nama" placeholder="Sertifikat A/N" required>
                    <label for="nomor_handphone">Nomor Handphone</label>
                    <input value="{{old('nomor_handphone')}}" name="nomor_handphone" type="text" class="form-control bg-light"
                        id="nomor_handphone" placeholder="Nomor Handphone" required>
                    <label for="kelurahan">Kelurahan</label>
                    <input value="{{old('kelurahan')}}" name="kelurahan" type="text" class="form-control bg-light"
                        id="kelurahan" placeholder="Kelurahan" required>
                    <label for="luas">Luas</label>
                    <input value="{{old('luas')}}" name="luas" type="text" class="form-control bg-light"
                        id="luas" placeholder="Luas" required>
                    <label for="keterangan">Keterangan</label>
                    <input value="{{old('keterangan')}}" name="keterangan" type="text" class="form-control bg-light"
                        id="keterangan" placeholder="Keterangan" required>
                    <div class="form-group">
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
