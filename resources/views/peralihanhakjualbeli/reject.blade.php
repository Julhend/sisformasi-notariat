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
        <form action="/peralihanjualbeli/{{$peralihanjualbeli->id}}/reject" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Tolak Permintaan</h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
                <div class="col-8">
                    <label for="keterangan_ditolak">Keterangan Penolakan</label>
                    <input name="keterangan_ditolak" type="text" class="form-control bg-light" id="keterangan_ditolak"
                        placeholder="Keterangan" value="{{$peralihanjualbeli->keterangan_ditolak}}" required>
                   
                </div>
              
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Confirm</button>
            <a class="btn btn-danger btn-sm" href="/peralihanjualbeli/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection
