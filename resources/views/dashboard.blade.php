<style>
.text{
    text-align: center;
    font-size: 20px;
    /* font-family: "Times New Roman", Times, serif; */
    font-style: italic;
      border: 3px solid #fd7e14;
}

 </style>

@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <div class="row">
            <div class="col">
                <center>
                    <h3 class="font-weight-bold">SELAMAT DATANG DI BERANDA SISTEM INFORMASI KENOTARIATAN</h3>
                    <hr />
                </center>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="card-body">
                <div class="text">
                     <p>Untuk pertanyaan dan bantuan lebih lanjut</p>
                     <p>silahkan kirim email dengan cara klik link dibawah ini</p>
                     <a href="mailto:Ronaling25@gmail.com">Email Us</a>
                </div>
                @if (auth()->user()->role == 'pemohon')
                <div class="title">
                <p >STATUS SURAT DITERIMA</p>
                </div>
                <!-- Small boxes (Stat box) -->
                <div class="filter-container p-0 row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanjualbeli')->where('status', 'diterima')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Peralihan Hak Jual Beli</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-balance-scale-right"></i>
                            </div>
                            <a href="/peralihanjualbeli/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanhibah')->where('status', 'diterima')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Peralihan Hak Hibah</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-layer-group"></i>
                            </div>
                            <a href="/peralihanhibah/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanwaris')->where('status', 'diterima')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Peralihan Hak Waris</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                            </div>
                            <a href="/peralihanwaris/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanlelang')->where('status', 'diterima')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Peralihan Hak Lelang</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope"></i>
                            </div>
                            <a href="/peralihanlelang/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('pemberianpembaruanhaks')->where('status', 'diterima')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Pemberian / Pembaruan Hak</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-paper-plane"></i>
                            </div>
                            <a href="/pemberian-pembaruan-hak/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('penghapusanhaks')->where('status', 'diterima')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Penghapusan Hak</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-inbox"></i>
                            </div>
                            <a href="/penghapusanhak/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('suratkuasamenjual')->where('status', 'diterima')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Surat Kuasa Menjual</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope-open"></i>
                            </div>
                            <a href="/suratkuasamenjual/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                     <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('suratwaris')->where('status', 'diterima')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Surat Pernyataan & Waris</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-mail-bulk"></i>
                            </div>
                            <a href="/suratpernyataanwaris/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                <div class="titlee">
                 <p >STATUS SURAT PENDING</p>
                </div>
                <!-- Small boxes (Stat box) -->
                <div class="filter-container p-0 row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanjualbeli')->where('status', 'pending')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Peralihan Hak Jual Beli</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-balance-scale-right"></i>
                            </div>
                            <a href="/peralihanjualbeli/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanhibah')->where('status', 'pending')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Peralihan Hak Hibah</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-layer-group"></i>
                            </div>
                            <a href="/peralihanhibah/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanwaris')->where('status', 'pending')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Peralihan Hak Waris</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                            </div>
                            <a href="/peralihanwaris/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanlelang')->where('status', 'pending')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Peralihan Hak Lelang</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope"></i>
                            </div>
                            <a href="/peralihanlelang/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('pemberianpembaruanhaks')->where('status', 'pending')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Pemberian / Pembaruan Hak</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-paper-plane"></i>
                            </div>
                            <a href="/pemberian-pembaruan-hak/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('penghapusanhaks')->where('status', 'pending')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Penghapusan Hak</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-inbox"></i>
                            </div>
                            <a href="/penghapusanhak/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('suratkuasamenjual')->where('status', 'pending')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Surat Kuasa Menjual</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope-open"></i>
                            </div>
                            <a href="/suratkuasamenjual/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                     <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('suratwaris')->where('status', 'pending')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Surat Pernyataan & Waris</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-mail-bulk"></i>
                            </div>
                            <a href="/suratpernyataanwaris/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="titleee">
                <p>STATUS SURAT REJECT</p>
                </div>
                <!-- Small boxes (Stat box) -->
                <div class="filter-container p-0 row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanjualbeli')->where('status', 'ditolak')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Peralihan Hak Jual Beli</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-balance-scale-right"></i>
                            </div>
                            <a href="/peralihanjualbeli/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanhibah')->where('status', 'ditolak')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Peralihan Hak Hibah</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-layer-group"></i>
                            </div>
                            <a href="/peralihanhibah/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanwaris')->where('status', 'ditolak')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Peralihan Hak Waris</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                            </div>
                            <a href="/peralihanwaris/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanlelang')->where('status', 'ditolak')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Peralihan Hak Lelang</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope"></i>
                            </div>
                            <a href="/peralihanlelang/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('pemberianpembaruanhaks')->where('status', 'ditolak')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Pemberian / Pembaruan Hak</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-paper-plane"></i>
                            </div>
                            <a href="/pemberian-pembaruan-hak/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('penghapusanhaks')->where('status', 'ditolak')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Penghapusan Hak</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-inbox"></i>
                            </div>
                            <a href="/penghapusanhak/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('suratkuasamenjual')->where('status', 'ditolak')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Surat Kuasa Menjual</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope-open"></i>
                            </div>
                            <a href="/suratkuasamenjual/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                     <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('suratwaris')->where('status', 'ditolak')->where('users_id', Auth::id())->count()}}</h3>
                                <p>Surat Pernyataan & Waris</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-mail-bulk"></i>
                            </div>
                            <a href="/suratpernyataanwaris/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    <!-- ./col -->
                    @if (auth()->user()->role == 'admin')
                    <div class="titleeee">
                    <p>STATUS SURAT PENDING</p>
                    </div>
                     <!-- Small boxes (Stat box) -->
                <div class="filter-container p-0 row">

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanjualbeli')->where('status', 'pending')->count()}}</h3>
                                <p>Peralihan Hak Jual Beli</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-balance-scale-right"></i>
                            </div>
                            <a href="/peralihanjualbeli/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanhibah')->where('status', 'pending')->count()}}</h3>
                                <p>Peralihan Hak Hibah</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-layer-group"></i>
                            </div>
                            <a href="/peralihanhibah/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanwaris')->where('status', 'pending')->count()}}</h3>
                                <p>Peralihan Hak Waris</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                            </div>
                            <a href="/peralihanwaris/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('peralihanlelang')->where('status', 'pending')->count()}}</h3>
                                <p>Peralihan Hak Lelang</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope"></i>
                            </div>
                            <a href="/peralihanlelang/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('pemberianpembaruanhaks')->where('status', 'pending')->count()}}</h3>
                                <p>Pemberian / Pembaruan Hak</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-paper-plane"></i>
                            </div>
                            <a href="/pemberian-pembaruan-hak/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('penghapusanhaks')->where('status', 'pending')->count()}}</h3>
                                <p>Penghapusan Hak</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-inbox"></i>
                            </div>
                            <a href="/penghapusanhak/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('suratkuasamenjual')->where('status', 'pending')->count()}}</h3>
                                <p>Surat Kuasa Menjual</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope-open"></i>
                            </div>
                            <a href="/suratkuasamenjual/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                     <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('suratwaris')->where('status', 'pending')->count()}}</h3>
                                <p>Surat Pernyataan & Waris</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-mail-bulk"></i>
                            </div>
                            <a href="/suratpernyataanwaris/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        </div>
                       </div>
                           <p>DATA PENGGUNA</p>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('users')->count()}}</h3>
                                <p>Pengguna</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-user"></i>
                            </div>
                            <a href="{{ route('pengguna.index') }}" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    <!-- ./col -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
