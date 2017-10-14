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

        <div class="row">
        <br>
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-bar-chart"></i> Grafik Ice Cream Terlaris</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <br>
                <div class="col-md-3">
                  <select class="form-control select2" style="width: 100%;" name="bulan" id="pilihBulan">
                    <option disabled="disabled" selected="selected" value="0">Pilih Bulan</option>
                      <option value="1">Januari</option>
                      <option value="2">Februari</option>
                      <option value="3">Maret</option>
                      <option value="4">April</option>
                      <option value="5">Mei</option>
                      <option value="6">Juni</option>
                      <option value="7">Juli</option>
                      <option value="8">Agustus</option>
                      <option value="9">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                  </select>
                <br>
                </div>
                 <div class="col-md-3">
                  <select class="form-control select2" style="width: 100%;" name="tahun" id="pilihTahun3">
                    <option disabled="disabled" selected="selected" value="0">Pilih Tahun</option>
                    @foreach($tahun as $t)
                      <option value="{{ $t->tahun }}">{{ $t->tahun }}</option>
                    @endforeach
                  </select>
                <br>
                </div>
                <div class="col-md-2">
                  <button class="btn btn-primary" id="btnCari">Cari</button>
                <br>
                </div>
                <div class="col-md-12">
                  
                  <div id="container3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    
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
    Highcharts.chart('container3', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Ice Cream Terlaris'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Jumlah Ice Cream'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
            }
        }
    },

    tooltip: {
       enabled: false
    },

    series: [{
        name: 'Ice Cream',
        colorByPoint: true,
        data: [
                @foreach($laporanterlaris as $item)
                  {
                    name: "{{$item->nama}}",
                    y: {{$item->Jumlah}}
                  },
                @endforeach
        ]
    }]
});
    </script>



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
                  text: 'Grafik Untung Rugi'
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
                  },
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

  $('#btnCari').click(function(){
      var tahun = $('#pilihTahun3').val();
      var bulan = $('#pilihBulan').val();
      console.log(bulan)
      $.get('/dynasti/public/manager/beranda/terlaris/'+tahun+'/'+bulan,
          function(data){
            console.log(data)
          var hasilNama = new Array();
          var hasilJumlah = new Array();
          var i = 0;
          $.each(data, function (key, value) {
            hasilNama[i] = value.nama;
            hasilJumlah[i] = parseInt(value.Jumlah);
            i++;
          })
           console.log("hasilJumlah"+hasilNama[1])
           Highcharts.chart('container3', {
              chart: {
                  type: 'column'
              },
              title: {
                  text: 'Grafik Ice Cream Terlaris'
              },
              xAxis: {
                  type: 'category'
              },
              yAxis: {
                  title: {
                      text: 'Jumlah Ice Cream'
                  }

              },
              legend: {
                  enabled: false
              },
              plotOptions: {
                  series: {
                      borderWidth: 0,
                      dataLabels: {
                          enabled: true,
                      }
                  }
              },

              tooltip: {
                 enabled: false
              },

              series: [{
                  name: 'Ice Cream',
                  colorByPoint: true,
                  data: [ 
                      {name: hasilNama[0], y:hasilJumlah[0]},
                      {name: hasilNama[1], y:hasilJumlah[1]},
                      {name: hasilNama[2], y:hasilJumlah[2]},
                      {name: hasilNama[3], y:hasilJumlah[3]},
                      {name: hasilNama[4], y:hasilJumlah[4]},
                      {name: hasilNama[5], y:hasilJumlah[5]},
                      {name: hasilNama[6], y:hasilJumlah[6]},
                      {name: hasilNama[7], y:hasilJumlah[7]},
                      {name: hasilNama[8], y:hasilJumlah[8]},
                      {name: hasilNama[9], y:hasilJumlah[9]},
                          
                  ],
                  dataLabels:{
                enabled:true,
                formatter:function(){
                    if(this.y > 0){
                        return this.y;
                    }else {
                      return null;
                    }
                  }
                }
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
            text: 'Grafik Untung Rugi'
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