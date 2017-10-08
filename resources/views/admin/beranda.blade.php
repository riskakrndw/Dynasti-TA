@extends('layout_master.master')

@section("title", "Manager | Beranda")

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

                <p>Bahan Baku di Bawah Stok Minimal</p>
              </div>
              <a href="{{route('stokBahan')}}" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{ $jumlahpermintaan }}</h3>

                <p>Konfirmasi Permintaan Pengadaan</p>
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

                <p>Ice Cream di Bawah Stok Minimal</p>
              </div>
              <a href="{{route('stokIce')}}" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      <!-- /Info beranda -->

      <!-- informasi pemesanan -->
        <!-- <div class="row">
          <br>
          <div class="col-md-12">
            <section class="connectedSortable">
                <div class="box">
                  <div class="nav-tabs-custom">
                    <div class="box-header">
                      <ul class="nav nav-tabs-custom">
                        <li class="pull-left header"><i class="fa fa-info-circle"></i> Pemesanan yang Mendekati Tanggal Pengiriman</li>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </ul>
                    </div>
                    <div class="box-body table-responsive">
                      <table id="example1" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Kode Pemesanan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($pemesanan as $q=>$v)
                          <tr>
                            <td>{{$q+1}}</td>
                            <td>{{ $v->kode_pemesanan }}</td>
                            <td>{{ $v->tanggal }}</td>
                            <td>
                              <a href="{{ url('manager/pemesanan/lihat/'.$v->id.'/pemesananberanda') }}" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Lihat Detail</a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </section>
          </div>
        </div> -->


      <div class="row">
        <br>
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
                    <option value="2016">2016</option>
                    @foreach($tahun as $t)
                      <option value="{{ $t->tahun }}">{{ $t->tahun }}</option>
                    @endforeach
                  </select>
                <br>
                </div>
                <div class="col-md-12">
                  
                  <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
        <br>
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-bar-chart"></i> Grafik Untung Rugi</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <br>
                <div class="col-md-3">
                  <select class="form-control select2" style="width: 100%;" name="tahun" id="pilihTahun2">
                    <option disabled="disabled" selected="selected" value="0">Pilih Tahun</option>
                    @foreach($tahun as $t)
                      <option value="{{ $t->tahun }}" url="/tahun={{$t->tahun}}">{{ $t->tahun }}</option>
                    @endforeach
                  </select>
                <br>
                </div>
                <div class="col-md-12">
                  <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    
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


@section("morescript")
  <script src="{{url('Highcharts/code/highcharts.js')}}"></script>
  <script src="{{url('Highcharts/code/modules/exporting.js')}}"></script>

  <script type="text/javascript">
    Highcharts.chart('container1', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Grafik Transaksi'
        },
        subtitle: {
            text: 'Tahun {{\Carbon\Carbon::now()->year}}'
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

      var tahun1 = $(this).val();
      $.get('/dynasti/public/manager/beranda/tahun='+tahun1,
        function(data){
          console.log(data[0]);
          Highcharts.chart('container1', {

            chart: {
                type: 'line'
            },
            title: {
                text: 'Grafik Transaksi'
            },
            subtitle: {
                text: 'Tahun ' + tahun1
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
                data: JSON.parse('['+data[0]+']')
            },
            {
                name: 'Total Pemesanan',
                data: JSON.parse('['+data[1]+']')
            }
            ]
        });
        }
      )
    });

    $('#pilihTahun2').change(function(){
      var tahun1 = $(this).val();
      $.get('/dynasti/public/manager/beranda/'+tahun1,
          function(data){
            console.log(data);
            Highcharts.chart('container2', {
              chart: {
                  type: 'line'
              },
              title: {
                  text: 'Grafik Transaksi'
              },
              subtitle: {
                  text: 'Tahun ' + tahun1
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
                  name: 'Total Untung Rugi',
                  data: JSON.parse('['+data+']')
              }]
          });
          }
        )
    });

  </script>

  <script type="text/javascript">
    Highcharts.chart('container2', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Grafik Transaksi'
        },
        subtitle: {
            text: 'Tahun {{\Carbon\Carbon::now()->year}}'
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
            name: 'Total Untung Rugi',
            data: [
                    @foreach($laporanuntungrugi as $item)
                      {{$item['total_untungrugi']}},
                    @endforeach
                  ]
        }]
    });
  </script>


@endsection