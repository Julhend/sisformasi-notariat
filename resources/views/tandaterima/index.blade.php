@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Tanda Terima</h3>
                <hr />
            </div>
        </div>
        <div>
            <div class="col">
                <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="create" role="button"><i class="fas fa-plus"></i>
                    Tambah Data</a>
                <br>
            </div>
        </div>
        <div class="row table-responsive">
            <div class="col">
                <table class="table table-hover table-head-fixed" id='tabelPeralihanjualbeli'>
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Jenis Dokumen</th>
                            <th>Jenis Hak</th>
                            <th>Nomor Antrian</th>
                            <th>No Sertifikat</th>
                            <th>Penyerah Sertifikat</th>
                            <th>Sertifikat A/N</th>
                            <th>Nomor Handphone</th>
                            <th>Kelurahan</th>
                            <th>Luas</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (auth()->user()->role == 'pemohon')
                        <?php $no = 0;?>
                        @foreach($data_tanter->where('users_id', Auth::id()) as $data)
                        <?php $no++ ;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->users->name}}</td>
                            <td>{{$data->jenis_dokumen}}</td>
                            <td>{{$data->jenis_hak}}</td>
                            <td>{{$data->nomor_antrian}}</td>
                            <td>{{$data->no_sertifikat}}</td>
                            <td>{{$data->penyerah_sertifikat}}</td>
                            <td>{{$data->sertifikat_atas_nama}}</td>
                            <td>{{$data->nomor_handphone}}</td>
                            <td>{{$data->kelurahan}}</td>
                            <td>{{$data->luas}}</td>
                            <td>{{$data->keterangan}}</td>
                            <td>
                          
                                
                                <a href="/tandaterima/{{$data->id}}/cetak_pdf"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"><i
                                    class="nav-icon fas fa-pencil-alt"></i> cetak</a>
                                <a href="/tandaterima/{{$data->id}}/delete"
                                    class="btn btn-danger btn-sm my-1 mr-sm-1 btn-block"
                                    onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                    Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                        @if (auth()->user()->role == 'admin')
                        <?php $no = 0;?>
                        @foreach($data_tanter as $data)
                        <?php $no++ ;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->users->name}}</td>
                            <td>{{$data->jenis_dokumen}}</td>
                            <td>{{$data->jenis_hak}}</td>
                            <td>{{$data->nomor_antrian}}</td>
                            <td>{{$data->no_sertifikat}}</td>
                            <td>{{$data->penyerah_sertifikat}}</td>
                            <td>{{$data->sertifikat_atas_nama}}</td>
                            <td>{{$data->nomor_handphone}}</td>
                            <td>{{$data->kelurahan}}</td>
                            <td>{{$data->luas}}</td>
                            <td>{{$data->keterangan}}</td>
                            <td>
                               
                                  <a href="/tandaterima/{{$data->id}}/cetak_pdf"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"><i
                                    class="nav-icon fas fa-pencil-alt"></i> cetak</a>
                                <a href="/tandaterima/{{$data->id}}/delete"
                                    class="btn btn-danger btn-sm my-1 mr-sm-1 btn-block"
                                    onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                    Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</section>
@endsection
