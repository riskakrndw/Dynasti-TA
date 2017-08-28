@extends('layout_master.master')

@section("title", "Beranda")

@section("beranda", "active")

@section("content")
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Beranda
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Beranda</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Alert Success -->
        <div class="callout callout-info">
          <h4>Halo {{Auth::user()->name}}!</h4>
          <p>Selamat Datang di Halaman Manager</p>
        </div>
      <!-- /Alert Success -->

      <!-- Info beranda -->
        <div class="row">

          <div class="col-lg-3">
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{ $totalstokbahan }}</h3>

                <p>Stok Bahan Baku</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-cart"></i>
              </div>
              <a href="{{route('stokBahan')}}" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{ $jumlahpermintaan }}</h3>

                <p>Permintaan Pengadaan</p>
              </div>
              <div class="icon">
                <i class="ion ion-plus-round"></i>
              </div>
              <a href="{{route('konfirmasi')}}" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{ $totalstokes }}</h3>

                <p>Stok Ice Cream</p>
              </div>
              <div class="icon">
                <i class="ion ion-pricetags"></i>
              </div>
              <a href="{{route('stokIce')}}" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      <!-- /Info beranda -->

      <div class="row">
        <div class="col-md-12">
          <section class="connectedSortable">
              <div class="box">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs pull-right">
                    <li class="pull-left header"><i class="fa fa-info-circle"></i> Informasi Pemesanan</li>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </ul>
                  <br>
                  <div class="tab-content">
                    <table id="example1" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="width: 10px">No</th>
                          <th style="width: 200px">Kode Pemesanan</th>
                          <th style="width: 200px">Tanggal</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($pemesanan as $q=>$v)
                        <tr>
                          <td>{{$q+1}}</td>
                          <td>{{ $v->kode_pemesanan }}</td>
                          <td>{{ $v->tanggal }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </section>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-bar-chart"></i> Grafik Transaksi</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <br>
                <div class="col-md-3">
                  <select class="form-control select2" style="width: 100%;" name="tahun" id="pilihTahun1">
                    <option disabled="disabled" selected="selected" value="0">Pilih Tahun</option>
                    @foreach($tahun as $t)
                      <option value="{{ $t->tahun }}" url="/tahun={{$t->tahun}}">{{ $t->tahun }}</option>
                    @endforeach
                  </select>
                <br>
                </div>
                <div class="col-md-12">
                  <script src="{{url('Highcharts/code/highcharts.js')}}"></script>
                  <script src="{{url('Highcharts/code/modules/exporting.js')}}"></script>
                  <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    <script type="text/javascript">
                      Highcharts.chart('container1', {
                          chart: {
                              type: 'line'
                          },
                          title: {
                              text: 'Grafik Transaksi'
                          },
                          subtitle: {
                              text: 'Tahun ......'
                          },
                          xAxis: {
                              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                          },
                          yAxis: {
                              title: {
                                  text: 'Total'
                              }
                          },
                          plotOptions: {
                              line: {
                                  dataLabels: {
                                      enabled: true
                                  },
                                  enableMouseTracking: false
                              }
                          },
                          series: [{
                              name: 'Total Pemesanan',
                              data: [
                                      @foreach($laporanpemesanan as $item)
                                        {{$item['total_pemesanan']}},
                                      @endforeach
                                    ]
                          }, {
                              name: 'Total Penjualan',
                              data: [
                                      @foreach($laporan as $item)
                                        {{$item['total_penjualan']}},
                                      @endforeach
                                    ]
                          }]
                      });
                    </script>

                    <script>
                      $('#pilihTahun1').change(function(){

                        var url= "/dynasti/public/manager/beranda/tahun="+$(this).val();
                        console.log(url);
                        window.location = url;  
                      });

                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>
@endsection