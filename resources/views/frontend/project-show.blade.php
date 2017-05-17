<link rel="stylesheet" href="{{ URL::asset('') }}css/bootstrap.css" type="text/css">
<div class="container project-view">
    <div class="row">
        <div class="col-md-12 project-images">
            <a href="" class="thumbnail" >
            <img src="{{ URL::asset('') }}/uploads/produk/{{$data->pasPhotoProduk}}" alt="" class="img-responsive" style=" height:200px"/>
        </a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Merk</th>
                        <td>{{$data->brand_usaha}}</td>
                    </tr>

                    <tr>
                        <th>Jenis Usaha</th>
                        <td>{{$data->jenis_usaha}}</td>
                    </tr>
                    <tr>
                        <th>Nama Anggota</th>
                        <td>{{$data->nm_anggota}}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{$data->alamat_usaha}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
