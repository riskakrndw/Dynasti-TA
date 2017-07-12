@extends('layout_master.master')

@section("title", "Tambah Produksi")

@section("produksi", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />
<link href="{{url('dist/js/select2/select2.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('dist/js/select2/select2-bootstrap-dick.css')}}" rel="stylesheet" type="text/css" />

<style type="text/css">
  #garis{
    border: 2px solid #dbdbdb;
  }
</style>
@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data Produksi</a></li>
        <li class="active">Tambah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        
        <div class="col-md-12">
          <a href="{{route('produksi')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data penjualan </button></a>
        </div>   

        <!-- Tambah penjualan -->
          <div class="col-md-12">
            <br>
            <div class="box box-success">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Penjualan</h3></li>
              </ul>

              <!-- Form tambah penjualan -->
                <form role="form" action="" method="">
                  {{csrf_field()}}
                  <div class="box-body">
                    <input type="hidden" name="idPengguna" id="idPengguna" value="{{ Auth::User()->id }}">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kode Produksi</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-font"></i></span>
                          <input class="form-control" placeholder="Kode Produksi" name="kode" id="kode" value="{{ $data->kode_produksi }}">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tanggal</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" value="{{ $data->tgl }}">
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="ides" id="ides">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Nama Ice Cream</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-font"></i></span>
                          <input type="hidden" class="form-control" id="namaEs" name="namaEs" placeholder="Nama Ice Cream" value"">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Jumlah Produksi</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-font"></i></span>
                          <input class="form-control" placeholder="Jumlah Produksi" name="jumlah" id="jumlah" onKeyPress="return goodchars(event,'0123456789',this)">
                        </div>
                      </div>
                    </div>
                  </div>
                
              <!-- /Form tambah penjualan -->

              <hr id="garis">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Daftar bahan yang diperlukan</h3></li>
              </ul>

                <div class="box-body">
                  
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width:50px">No</th>
                        <th style="width: 250px">Nama Bahan</th>
                        <th style="width: 200px">Satuan</th>
                        <th style="width: 250px">Jumlah</th>
                        <th style="width: 250px">Stok</th>
                      </tr>
                    </thead>
                    <tbody id="type_container">
                      
                    </tbody>
                  </table>
                  
                  <br>
                  <div class="col-md-12">
                    <button type="button" class="btn btn-sm btn-primary pull-right" value="Submit" id="submit"><i class="fa fa-floppy-o"></i> Simpan </button>
                  </div>

                </div>
              <!-- /.tabel bahan -->
            </div>
          </div>
          </form>
        <!-- /Tambah penjualan -->
        
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
<!-- validasi keyboard numeric only -->
  <script src="{{url('dist/js/validasinumeric.js')}}"></script>
<!-- dinamically add -->
  <script src="{{url('dist/js/jquery-1.8.2.min.js')}}" type="text/javascript" charset="utf8"></script>
  <script src="{{url('dist/js/select2/select2.js')}}"></script>
<!-- date -->
  <script src="{{url('dist/js/bootstrap-datepicker.js')}}"></script>


  <!-- script tambah bahan baku -->
  <script>
    //Date picker
      $('#datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
      });
    var w = 0;
    var arr  = [];
    var nomorBaris = 0;

    jQuery(document).ready(function() {
      var doc = $(document);
      w = 0;
      arr = [];
      $('#jumlah').change(function(){
        var jumlah = $('#jumlah').val();
        if (jumlah <= 0){
          alert('jumlah produksi minimal 1')
        }else{
          i = 0
          
          // $('.stok').each(function(){
          //   var stok = $(this).text();
          // });

          $('.total').each(function(){
            var total = $(this).text();
            // if (stok < total){
            //   alert('stok tidak cukup')
            // }else{

              if(w == 0)
                arr.push(total);

              $(this).text(parseInt(arr[i])*jumlah);
              i++;
            // }
          });

          w = 1
          console.log(arr);

          //alert(total);
        }
      });

      //menampilkan detail es
      $('#namaEs').change(function(){
        w = 0;
        $('#type_container').html('');
        nomorBaris = 0;

        $.get('/dynasti/public/api/icecream/'+$('#namaEs').val(),
          function(hasil){
            $('#ides').val(hasil[0]);
          }
        )

        $.get('/dynasti/public/api/detail-icecream/'+$('#namaEs').val(),
          function(data){
             $.each(data, function(index, data){
              nomorBaris++
                $('#type_container').append('<tr id="'+data.id+'"><td>'+nomorBaris+'</td><td>'+data.nama+'</td><td>'+data.satuan+'</td><td class="total">'+data.takaran+'</td><td>'+data.stok+'</td></tr>');            
              console.log(data);
             })
          
          }
        ) //ngambil value nama
      });

      //save multi record to db
      $('#submit').on('click', function(){
        var kode = $('#kode').val();
        var pengguna = $('#idPengguna').val();
        var ides = $('#ides').val();
        var datepicker = $('#datepicker').val();
        var bulan = new Date(datepicker).getMonth()+1;
        var datepicker = new Date(datepicker).getFullYear() + '-' + bulan + '-' + new Date(datepicker).getDate();
        // console.log(bulan);
        var namaEs = $('#namaEs').val();
        var jumlah = $('#jumlah').val();


        var arrData=[];

        //loop over each table row (tr)
        $("#type_container tr").each(function(){
          var currentRow = $(this);

          var col0_value = currentRow.find("td:eq(0)").text();
          var col1_value = currentRow.find("td:eq(1)").text();
          var col2_value = currentRow.find("td:eq(2)").text();
          var col3_value = currentRow.find("td:eq(3)").text();
          var col4_value = currentRow.find("td:eq(4)").text();

          var obj={};
          obj.no = col0_value;
          obj.nama_bahan = col1_value;
          obj.satuan = col2_value;
          obj.total = col3_value;

          arrData.push(obj);
        });


        $.ajax({
            type: "GET",
            url: "/dynasti/public/manager/produksi/simpan/"+ides+"/"+pengguna+"/"+kode+"/"+datepicker+"/"+jumlah,
            success: function(result) {
              /*console.log(idjual)*/
            }
        });

        $(document).ajaxStop(function(){
          window.location="{{URL::to('manager/produksi')}}";
        });
        
      });
    });
  </script>

  <!-- script select 2 untuk nyari bahan -->
  <script>
    jQuery(document).ready(function($) {
        // trigger select2 for each untriggered select2 box
        $("#namaEs").each(function (i, obj) {
          if (!$(obj).data("select2"))
          {
            $(obj).select2({
              placeholder: "Nama Ice Cream",
              minimumInputLength: "1",
              ajax: {
                url: "/dynasti/public/api/icecream",
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                  return {
                    q: term, // search term
                    page: page
                  };
                },
                results: function (data, params) {
                  params.page = params.page || 1;
                  var result = {
                    results: $.map(data.data, function (item) {
                      textField = "nama";
                      return {
                        text: item[textField],
                        id: item["id"]
                      }
                    }),
                    more: data.current_page < data.last_page
                  };
                  return result;
                },
                cache: true
              },
              initSelection: function(element, callback) {
                // the input tag has a value attribute preloaded that points to a preselected repository's id
                // this function resolves that id attribute to an object that select2 can render
                // using its formatResult renderer - that way the repository name is shown preselected
                $.ajax("/dynasti/public/api/icecream" + '/' , {
                  dataType: "json"
                }).done(function(data) {
                  textField = "nama";
                  callback({ text: data[textField], id: data["id"] });
                });
              },
            });
          }
        });
    });
  </script>
@endsection