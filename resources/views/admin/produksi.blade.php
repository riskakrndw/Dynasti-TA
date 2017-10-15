@extends('layout_master.master')

@section("title", "Manager | Data Produksi")

@section("dataproduksi", "active")

@section("produksi", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Produksi
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('beranda')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Produksi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Tambah produksi -->
          <div class="col-md-12">
            <a href="{{route('tambahProduksi')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Produksi </button></a>
          </div>
        <!-- /Tambah produksi -->        

        <!-- Data produksi -->
        <div class="col-xs-12">
          <br>
          <div class="box">
            <!-- header -->
              <div class="box-header">
                <ul class="nav nav-tabs-custom">
                  <li class="pull-left box-header"><h3 class="box-title">Daftar Produksi</h3></li>
                </ul>
              </div>
            <!-- /header -->

            <!-- tabel produksi -->
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th >Kode Produksi</th>
                      <th>Tanggal</th>
                      <th>Rasa</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $datapro)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>PRO| {{\Carbon\Carbon::parse($datapro->tgl)->format('Y-m-d')}}| {{$datapro->id}}</td>
                      <td>{{ $datapro->tgl }}</td>
                      <td>{{ $datapro->detail_produksi[0]->ice_cream->rasa->nama }}</td>
                      <td>
                        <a href="{{ url('manager/produksi/edit/'.$datapro->id) }}" class="btn btn-sm btn-default btnEditEs"><i class="fa fa-edit"></i> Ubah</a>
                        <a href="{{ url('manager/produksi/lihat/'.$datapro->id.'/dataproduksi') }}" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            <!-- /.tabel produksi -->

          </div>
        </div>
        <!-- /Data produksi -->

      </div>
    </section>
    <!-- /. main content -->
  </div>
@endsection

@section("morescript")

  <!-- Modal Windows -->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> -->
  <script src="{{url('dist/js/bootstrap-modalmanager.js')}}"></script>
  <script src="{{url('dist/js/bootstrap-modal.js')}}"></script>
  <script src="{{url('dist/js/validasinumeric.js')}}"></script>
<!-- date -->
  <script src="{{url('dist/js/bootstrap-datepicker.js')}}"></script>

  <script type="text/javascript">
    //Date picker
      $('#datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
      });
  </script>
  
  <script type="text/javascript">
    @if(count($errors)>0)
      $('#editPro').modal('show');
    @endif

    $(".btnEditPro").click(function(){
      $('#idpro').val($(this).data('id'));
      $('#kodepro').val($(this).data('kode'));
      $('#datepicker').val($(this).data('tanggal'));
      $('#editPro').modal('show');
    });
  </script>

@endsection