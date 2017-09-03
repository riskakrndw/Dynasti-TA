@extends('layout_master.master')

@section("title", "Data Permintaan Pengadaan")

@section("pembelianPeng", "active")

@section("transaksi", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Pengadaan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Transaksi</a></li>
        <li class="active">Data Pengadaan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Tambah es -->
          <div class="col-md-12">
            <a href="{{route('tambahBeliPeng')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Pengadaan </button></a>
          </div>

        <!-- /Tambah es -->        
        <div class="col-md-12">
          <br>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#semua" data-toggle="tab">Semua</a></li>
              <li><a href="#menunggu" data-toggle="tab">Menunggu Persetujuan</a></li>
              <li><a href="#disetujui" data-toggle="tab">Permintaan Disetujui</a></li>
              <li><a href="#ditolak" data-toggle="tab">Permintaan Ditolak</a></li>
              <li><a href="#dibeli" data-toggle="tab">Dibeli</a></li>
              <li><a href="#diterima" data-toggle="tab">Diterima</a></li>
              <li><a href="#gagal" data-toggle="tab">Gagal</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="semua">
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 0px">No</th>
                        <th style="width: 210px">Kode Pengadaan</th>
                        <th style="width: 168px">Tanggal</th>
                        <th style="width: 168px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($data as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pembelian }}</td>
                          <td>{{ $data->tgl }}</td>
                          <td>Rp {{ number_format($data->total,2,",","." ) }}</td>
                          <td>
                           <a href="{{ url('pengadaan/pembelian/lihat/'.$data->id) }}" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                           <a href="{{ url('pengadaan/pembelian/edit/'.$data->id) }}" class="btn btn-sm btn-default btnEditEs"><i class="fa fa-edit"></i> Ubah</a>
                           <!-- <a type="button" href="{{route('hapusPembelian', ['id'=>$data->id])}}" class="btn btn-sm btn-danger btn-delete" onclick="return confirm('Apakah anda yakin akan menghapus?')"><i class="fa fa-trash-o"></i> Hapus</button> -->
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- /.tab-pane -->
              <div class="tab-pane" id="menunggu">
                <div class="box-body table-responsive">
                  <table id="example12" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 0px">No</th>
                        <th style="width: 210px">Kode Pengadaan</th>
                        <th style="width: 168px">Tanggal</th>
                        <th style="width: 168px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($datamenunggu as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pembelian }}</td>
                          <td>{{ $data->tgl }}</td>
                          <td>Rp {{ number_format($data->total,2,",","." ) }}</td>
                          <td>
                            <a href="{{ url('pengadaan/pembelian/lihat/'.$data->id) }}" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="disetujui">
                <div class="box-body table-responsive">
                  <table id="example13" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 0px">No</th>
                        <th style="width: 210px">Kode Pengadaan</th>
                        <th style="width: 168px">Tanggal</th>
                        <th style="width: 168px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($datadisetujui as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pembelian }}</td>
                          <td>{{ $data->tgl }}</td>
                          <td>Rp {{ number_format($data->total,2,",","." ) }}</td>
                          <td>
                           <a href="{{ url('pengadaan/pembelian/lihat/'.$data->id) }}" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="ditolak">
                <div class="box-body table-responsive">
                  <table id="example14" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 0px">No</th>
                        <th style="width: 210px">Kode Pengadaan</th>
                        <th style="width: 168px">Tanggal</th>
                        <th style="width: 168px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($dataditolak as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pembelian }}</td>
                          <td>{{ $data->tgl }}</td>
                          <td>Rp {{ number_format($data->total,2,",","." ) }}</td>
                          <td>
                           <a href="{{ url('pengadaan/pembelian/lihat/'.$data->id) }}" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane" id="dibeli">
                <div class="box-body table-responsive">
                  <table id="example15" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 0px">No</th>
                        <th style="width: 210px">Kode Pengadaan</th>
                        <th style="width: 168px">Tanggal</th>
                        <th style="width: 168px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($datadibeli as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pembelian }}</td>
                          <td>{{ $data->tgl }}</td>
                          <td>Rp {{ number_format($data->total,2,",","." ) }}</td>
                          <td>
                            <a href="{{ url('pengadaan/pembelian/lihat/'.$data->id) }}" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                            <form method="post" action="{{ url('pengadaan/pembelian/diterima') }}">
                              {{csrf_field()}}
                              <input class="form-control" type="hidden" name="id" id="id" value="{{ $data->id }}">
                              <input class="form-control" type="hidden" name="status" value="diterima">
                              <br>
                              <button type="submit" class="btn btn-sm btn-default" onclick='return confirm("Apakah anda yakin telah menerima barang pengadaan?")'><i class="fa fa-check"></i> Diterima</button>
                            </form>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane" id="diterima">
                <div class="box-body table-responsive">
                  <table id="example16" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 0px">No</th>
                        <th style="width: 210px">Kode Pengadaan</th>
                        <th style="width: 168px">Tanggal</th>
                        <th style="width: 168px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($dataditerima as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pembelian }}</td>
                          <td>{{ $data->tgl }}</td>
                          <td>Rp {{ number_format($data->total,2,",","." ) }}</td>
                          <td>
                           <a href="{{ url('pengadaan/pembelian/lihat/'.$data->id) }}" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane" id="gagal">
                <div class="box-body table-responsive">
                  <table id="example17" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 0px">No</th>
                        <th style="width: 210px">Kode Pengadaan</th>
                        <th style="width: 168px">Tanggal</th>
                        <th style="width: 168px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($datagagal as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pembelian }}</td>
                          <td>{{ $data->tgl }}</td>
                          <td>Rp {{ number_format($data->total,2,",","." ) }}</td>
                          <td>
                           <a href="{{ url('pengadaan/pembelian/lihat/'.$data->id) }}" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>

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

@endsection