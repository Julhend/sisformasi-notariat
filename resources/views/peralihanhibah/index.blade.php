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
                <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Peralihan Hak Hibah</h3>
                <hr />
            </div>
        </div>
        <div>
            <div class="col">
                    @if (auth()->user()->role == 'pemohon')
                     <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="create" role="button"><i class="fas fa-plus"></i>
                    Tambah Data</a>
                <br>
                @endif
            </div>
        </div>
        <div class="row table-responsive">
            <div class="col">
                <table class="table table-hover table-head-fixed" id='tabelPeralihanjualbeli'>
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>No Antrian</th>
                            <th>Pihak Pertama</th>
                            <th>Pihak Kedua</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (auth()->user()->role == 'pemohon')
                        <?php $no = 0;?>
                        @foreach($data_peralihan->where('users_id', Auth::id()) as $data)
                        <?php $no++ ;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->id}}</td>
                            <td>{{$data->pihakpertama}}</td>
                            <td>{{$data->pihakkedua}}</td>
                            <td>{{$data->tgl_pengajuan}}</td>
                            <td>{{$data->keterangan}}</td>
                            <td>{{$data->status}}</td>
                            <td>
                          
                                <a href="/peralihanhibah/{{$data->id}}/dokumen"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"><i
                                    class="nav-icon fas fa-upload"></i> File</a>
                                <a href="/peralihanhibah/{{$data->id}}/edit"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"><i
                                    class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                @if($data->status == 'ditolak')
                                <a href="/peralihanhibah/{{$data->id}}/resend"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"
                                    onclick="return confirm('Kirim ulang permohonan ini ?')"><i class="nav-icon fas fa-sync"></i>
                                     Kirim Ulang</a>
                                @endif
                                <a href="/peralihanhibah/{{$data->id}}/delete"
                                    class="btn btn-danger btn-sm my-1 mr-sm-1 btn-block"
                                    onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                    Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                        @if (auth()->user()->role == 'admin')
                        <?php $no = 0;?>
                        @foreach($data_peralihan as $data)
                        <?php $no++ ;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->id}}</td>
                            <td>{{$data->pihakpertama}}</td>
                            <td>{{$data->pihakkedua}}</td>
                            <td>{{$data->tgl_pengajuan}}</td>
                            <td>{{$data->keterangan}}</td>
                            <td>{{$data->status}}</td>
                            <td>
                                <a href="/peralihanhibah/{{$data->id}}/dokumen"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"><i
                                    class="nav-icon fas fa-upload"></i> dokumen</a>
                                    @if($data->status == 'pending')
                                    <a href="/peralihanhibah/{{$data->id}}/process"
                                        class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"
                                        onclick="return confirm('Proses surat ini ?')"><i class="nav-icon fas fa-sync"></i>
                                        Process</a>
                                        @endif
                                        @if($data->status == 'diproses')
                                    <a href="/peralihanhibah/{{$data->id}}/upload-akta"
                                        class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"
                                        onclick="return confirm('Konfirmasi surat ini ?')"><i class="nav-icon fas fa-file-alt"></i>
                                        Confirm</a>
                                        @endif
                                        @if($data->status == 'pending' || $data->status == 'diproses' )
                                <a href="/peralihanhibah/{{$data->id}}/reject"
                                    class="btn btn-danger btn-sm my-1 mr-sm-1 btn-block"
                                    onclick="return confirm('Reject surat ini ?')"><i class="nav-icon fas fa-times"></i>
                                    Reject</a>
                                        @endif

                                {{-- <a href="/peralihanhibah/{{$data->id}}/upload-akta"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"
                                    onclick="return confirm('Konfirmasi surat ini ?')"><i class="nav-icon fas fa-file-alt"></i>
                                    Confirm</a>
                                <a href="/peralihanhibah/{{$data->id}}/process"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"
                                    onclick="return confirm('Proses surat ini ?')"><i class="nav-icon fas fa-sync"></i>
                                    Process</a>
                                <a href="/peralihanhibah/{{$data->id}}/reject"
                                    class="btn btn-danger btn-sm my-1 mr-sm-1 btn-block"
                                    onclick="return confirm('Reject surat ini ?')"><i class="nav-icon fas fa-times"></i>
                                    Reject</a> --}}


                                <a href="/peralihanhibah/{{$data->id}}/delete"
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
