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
                <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Arsip Peralihan Hak Lelang</h3>
                <hr />
            </div>
        </div>
        <div>
        </div>
        <div class="row table-responsive">
            <div class="col">
                <table class="table table-hover table-head-fixed" id='tabelPeralihanjualbeli'>
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>No Antrian</th>
                            <th>Pengaju</th>
                            <th>Jenis Pengajuan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Keterangan</th>
                            <th>Akta</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (auth()->user()->role == 'pemohon')
                        <?php $no = 0;?>
                        @foreach($data_arsip->where('status','diterima')->where('users_id', Auth::id()) as $data)
                        <?php $no++ ;?>
                        <tr>
                             <td>{{$no}}</td>
                            <td>{{$data->id}}</td>
                            <td>{{$data->users->name}}</td>
                            <td>{{$data->jenis_pengajuan}}</td>
                            <td>{{$data->tgl_pengajuan}}</td>
                            <td>{{$data->keterangan}}</td>
                            <td> <a href="/dataperalihanlelang/{{$data->akta}}" download="{{$data->akta}}">{{$data->akta}}</td>
                            <td>{{$data->status}}</td>
                            <td>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                         @if (auth()->user()->role == 'admin')
                        <?php $no = 0;?>
                        @foreach($data_arsip->where('status','diterima') as $data)
                        <?php $no++ ;?>
                        <tr>
                             <td>{{$no}}</td>
                            <td>{{$data->id}}</td>
                            <td>{{$data->users->name}}</td>
                            <td>{{$data->jenis_pengajuan}}</td>
                            <td>{{$data->tgl_pengajuan}}</td>
                            <td>{{$data->keterangan}}</td>
                            <td> <a href="/dataperalihanlelang/{{$data->akta}}" download="{{$data->akta}}">{{$data->akta}}</td>
                            <td>{{$data->status}}</td>
                            <td>
                                <a href="/peralihanlelang/{{$data->id}}/upload-akta"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"
                                    onclick="return confirm('Konfirmasi surat ini ?')"><i class="nav-icon fas fa-file-alt"></i>
                                    Confirm</a>
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
