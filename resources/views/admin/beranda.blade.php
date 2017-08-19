@extends('layout_master.master')

@section("title", "Admin | Beranda")

@section("beranda", "active")

@section("content")
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Beranda
        <small>Control panel</small>
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

      <!-- info -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <section class="connectedSortable">
              <!-- info pemesanan -->
                <div class="box">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                      <li class="pull-left header"><i class="fa fa-info-circle"></i> Informasi Pemesanan</li>
                    </ul>
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
                          @foreach($pemesanan as $v)
                          <tr>
                            <td>{{ $v->kode_pemesanan }}</td>
                            <td>{{ $v->kode_pemesanan }}</td>
                            <td>{{ $v->tanggal }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              <!-- /.info pemesanan -->
            </section>
          </div>

        </div>
      <!-- / info -->


      <div class="row">      
        <div class="col-md-12">
          <script src="{{url('Highcharts/code/highcharts.js')}}"></script>
          <script src="{{url('Highcharts/code/modules/exporting.js')}}"></script>
          <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto">



          <script type="text/javascript">

      Highcharts.chart('container', {
          chart: {
              type: 'column'
          },
          title: {
              text: 'Jumlah Penjualan Berdasarkan Bulan'
          },
          subtitle: {
              text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
          },
          xAxis: {
              // type: 'category',
              // labels: {
              //     rotation: -45,
              //     style: {
              //         fontSize: '13px',
              //         fontFamily: 'Verdana, sans-serif'
              //     }
              // }
              categories: [
              @php ($i = 0)
              @foreach ($data as $row)
                @php ($i++)
                 @if($i > 1)
                 {{ "," }}
                 @endif
                 {!!"'".$row->bulan."'"!!}
              @endforeach
              ]
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Jumlah'
              }
          },
          legend: {
              enabled: false
          },
          tooltip: {
              pointFormat: 'Jumlah Penjualan: <b>{point.y:.1f} millions</b>'
          },
          series: [{
              name: 'JUmlah',
              data: [
                @php ($i = 0)
              @foreach ($data as $row)
                @php ($i++)
                 @if($i > 1)
                 {{ "," }}
                 @endif
                 {!! $row->total_penjualan !!}
              @endforeach  
              ],
              // dataLabels: {
              //     enabled: true,
              //     rotation: -90,
              //     color: '#FFFFFF',
              //     align: 'right',
              //     format: '{point.y:.1f}', // one decimal
              //     y: 10, // 10 pixels down from the top
              //     style: {
              //         fontSize: '13px',
              //         fontFamily: 'Verdana, sans-serif'
              //     }
              // }
          }]
      });
          </script>
          </div>
        </div>
      </div>

      
    </section>
    <!-- /. main content -->
  </div>
@endsection