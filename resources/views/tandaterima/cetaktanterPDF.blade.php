<html>

<head>
    <title>CETAK TANDA TERIMAs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 8pt;
        }

        footer {
            position: fixed;
            bottom: -20px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            text-align: center;
            line-height: 35px;
        }

        .ttd  {
            position:absolute;
            right:0%;
            top:50%;
        }

        .line {
            line-height: 40%;
        }
    </style>
    <div class="row">
        <center class="line">
            <h2>{{ $inst->nama }}</h2>
            <p>Alamat : {{ $inst->alamat }} </p>
            <p>Email : {{ $inst->email }} </p>
        </center>
    </div>

    <table class="table responsive-sm">
        <tr>
            <td colspan="8" align="center">
                <h6>TANDA TERIMA</h6>
            </td>
        </tr>
        <thead>
            <tr>
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
            </tr>
        </thead>
        <tbody>
          
            <tr>
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

            </tr>
        </tbody>
    </table>

         {{-- <div class="float-right text-left" style="width:30%">
            <p>Tanjungpinang, </p>
            <p>Yang menerima,<p>



           {{$data->users->name}}

    </div> --}}


    {{-- <h1>Invoice</h1>
    Awesome company<br />
    7026 Hunters Creek Dr<br />

    <h2 style="margin-top: 3rem">Bill to</h2>
    {{$data->users->name}}<br /> --}}

    <div class="ttd">
       Yang Menerima : __________________ <br />
    </div>


    <footer>
        Tanjungpinang | <?php echo date("F j, Y");?>
    </footer>
</body>

</html>
