@extends('layout_master.master')

@section("title", "Admin | Beranda")

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
          <p>Selamat Datang di Halaman Bagian Keuangan</p>
        </div>
      <!-- /Alert Success -->

      <!-- Info beranda -->
        <div class="row">

          <div class="col-lg-3 col-xs-3">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>Rp {{ number_format($totalpengadaan,2,",","." ) }}</h3>
                <p>Total Pengadaan</p>
              </div>
              <a href="{{route('pembelianKeu')}}" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{ $jumlahpembelian }}</h3>
                <p>Konfirmasi Pengadaan yang Telah Dibeli</p>
              </div>
              <div class="icon">
                <i class="ion ion-plus"></i>
              </div>
              <a href="{{route('konfirmasikeu')}}" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-3">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>Rp {{ number_format($totalpenjualan,2,",","." ) }}</h3>
                <p>Total Penjualan</p>
              </div>
              <a href="{{route('penjualanKeu')}}" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      <!-- /Info beranda -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-bar-chart"></i> Grafik Penjualan</h3>
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

                        var url= "/dynasti/public/keuangan/beranda/tahun="+$(this).val();
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
    <!-- /. main content -->
  </div>
@endsection