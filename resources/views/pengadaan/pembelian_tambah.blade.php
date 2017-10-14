@extends('layout_master.master')

@section("title", "Bagian Pengadaan | Tambah Data Pengadaan")

@section("pembelianPeng", "active")

@section("transaksi", "active")

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
        <li><a href="{{route('berandapeng')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Transaksi</a></li>
        <li><a href="{{route('pembelianPeng')}}">Data Pengadaan</a></li>
        <li class="active">Tambah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        
        <div class="col-md-12">
          <a href="{{route('pembelianPeng')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data pengadaan </button></a>
        </div>   

        <!-- Tambah pembelian -->
          <div class="col-md-12">
            <br>
            <div class="box">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Pengadaan</h3></li>
              </ul>

              <!-- Form tambah pembelian -->
                <form role="form" action="" method="" onsubmit="return Validate()" name="vform">
                  {{csrf_field()}}
                  <div class="box-body">
                    <input class="form-control" type="hidden" name="idPengguna" id="idPengguna" value="{{Auth::User()->id}}">
                    <input class="form-control" type="hidden" name="status" id="status" value="">
                  </div>
                
              <!-- /Form tambah pembelian -->

              <div>
              <!-- Data bahan -->
                <div class="col-xs-3">
                  <input type="hidden" class="form-control" id="namaBahan" placeholder="Nama Bahan" name="namabahan">
                  <span class="help-block val_error" id="namabahan_error" style="color:red;"></span>
                </div>
                <div class="col-xs-2">
                  <input type="text" class="form-control" id="satuanBahan" placeholder="Satuan" disabled>
                </div>
                <input class="form-control" type="hidden" name="idBahan" id="idBahan" value="">
                <div class="col-xs-2">
                  <input type="text" class="form-control" id="hargaBahan" placeholder="Harga" disabled>
                </div>
                <div class="col-xs-3">
                  <input type="text" class="form-control" id="jumlahBahan" name="jumlahbahan" placeholder="Jumlah yang dibutuhkan" onKeyPress="return goodchars(event,'0123456789',this)">
                  <span class="help-block val_error" id="jumlahbahan_error" style="color:red;"></span>
                </div>
                <div class="col-xs-2">
                  <a href="javascript: void(0)"><button type="button" class="btn btn-sm btn-default btnTambahBahan"><i class="fa  fa-plus "></i> Tambah Bahan </button></a>
                </div>
              <!-- ./Data bahan -->
            </div>

              <!-- tabel bahan -->
                <div class="box-body table-responsive" style="width:99%; margin:auto;" >
                  <br><br>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width:50px; display:none">No</th>
                        <th style="width: 325px">Nama Bahan</th>
                        <th style="width: 200px">Satuan</th>
                        <th style="width: 200px">Harga</th>
                        <th style="width: 175px">Jumlah</th>
                        <th style="width: 250px">Subtotal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="type_container">
                      
                    </tbody>
                  </table>
                  <br>

                  <span>Total Harga</span>
                  <input id="totalHarga" class="totalHarga" name="total" placeholder="0" value="0" disabled>

                  <div class="col-md-12">
                    <button type="button" class="btn btn-sm btn-primary pull-right" value="Submit" id="submit"><i class="fa fa-floppy-o"></i> Simpan </button>
                  </div>

                </div>
              <!-- /.tabel bahan -->
            </div>
          </div>
          </form>
        <!-- /Tambah pembelian -->
        
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

  <script type="text/javascript">

    //getting all error display object
      var namaBahan = document.getElementById("namaBahan");
      var namabahan_error = document.getElementById("namabahan_error");
      var jumlahBahan = document.getElementById("jumlahBahan");
      var jumlahbahan_error = document.getElementById("jumlahbahan_error");

    //setting all event listener

    //validation function
      function Validate(){

          if($('#type_container').children().length == 0){

            alert('Bahan baku harus diisi');
            return false;
          }else{
            return true;
          }

        return true;

      }

      function ValidateDetail(){
        
        if(namaBahan.value == ""){
          namaBahan.style.border = "1px solid red";
          namabahan_error.textContent = "Nama Bahan harus diisi";
          namaBahan.focus();
          return false;
        }else{
          namaBahan.style.border = "1px solid #5E6E66";
          namabahan_error.innerHTML = "";
        }

        if(jumlahBahan.value == ""){
          jumlahBahan.style.border = "1px solid red";
          jumlahbahan_error.textContent = "Nama Bahan harus diisi";
          jumlahBahan.focus();
          return false;
        }else{
          jumlahBahan.style.border = "1px solid #5E6E66";
          jumlahbahan_error.innerHTML = "";
        }

          return true;

      }
  </script>


  <!-- script tambah bahan baku -->
  <script>
    var nomorBaris = 0;
    jQuery(document).ready(function() {
      var doc = $(document);
      jQuery('.btnTambahBahan').die('click').live('click', function(e) {
        if(ValidateDetail()){
          e.preventDefault();
          for(var i = 0; i<1; i++){
            var type_div = 'teams_'+jQuery.now();
      
            $.get('/dynasti/public/api/namaBahan/'+$('#namaBahan').val(),
              function(hasil){
                
                var nama = hasil[0];
                var satuan = $('#satuanBahan').val();
                var harga = $('#hargaBahan').val();
                var jumlah = $('#jumlahBahan').val();
                var total = $('#totalHarga').val();
                var Subtotal = parseInt(harga) * parseInt(jumlah);
                var namadb  = "#" + nama.replace(/\s/g,'');
                var namaSub = namadb + "subTotal";
                if ($(namadb).length){
                  prevVal = $(namadb).text();
                  newVal = parseInt(prevVal)+parseInt(jumlah);
                  $(namadb).text(newVal);

                  prevSub = $(namaSub).text();
                  newSub = parseInt(prevSub) + parseInt(jumlah) * parseInt(harga);
                  $(namaSub).text(newSub);
                }
                else{
                  nomorBaris = nomorBaris + 1;
                  $('#type_container').append('<tr id="'+type_div+'"><td style="display:none">'+nomorBaris+'</td><td>'+nama+'</td><td>'+satuan+'</td><td>'+harga+'</td><td id='+nama.replace(/\s/g,'')+'>'+jumlah+'</td><td class="subTotal" id='+nama.replace(/\s/g,'')+'subTotal'+'>'+Subtotal+'</td><td class="col-md-3 control-label"><a class="remove-type" targetDiv="" data-id="'+type_div+'" href="javascript: void(0)"><i class="glyphicon glyphicon-trash"></i></a></td></tr>');            
                }
                $('#namaBahan').val('');
                $('#hargaBahan').val('');
                $('#jumlahBahan').val('');
                $('#satuanBahan').val('');

                var totalHargaLama = parseInt(document.getElementById('totalHarga').value);
                var totalHargaBaru = totalHargaLama + Subtotal;
                document.getElementById('totalHarga').value = totalHargaBaru;
              }
            )
          }
        }
        
      });
  
      jQuery(".remove-type").die('click').live('click', function (e) {
        var didConfirm = confirm("Are you sure You want to delete");
        if (didConfirm == true) {
            var id = jQuery(this).attr('data-id');
            //if (id == 0) {
                //var trID = jQuery(this).parents("tr").attr('id');
                jQuery('#' + id).remove();
                nomorBaris = nomorBaris - 1;
                var deletedSubTotal = $(this).closest("tr").find(".subTotal").text();
                var totalHargaLama = parseInt(document.getElementById('totalHarga').value);
                var totalHargaBaru = totalHargaLama - deletedSubTotal;
                document.getElementById('totalHarga').value = totalHargaBaru;
                
           // }
            return true;
        } else {
            return false;
        }
      });

      //nampilin id
      $('#namaBahan').change(function(){
        $.get('/dynasti/public/api/bahan/'+$('#namaBahan').val(),
          function(hasil){
            $('#idBahan').val(hasil.id);
            $('#hargaBahan').val(hasil.harga);
            $('#satuanBahan').val(hasil.satuan);
          }
        ) //ngambil value nama

      });

      //save multi record to db
      $('#submit').on('click', function(){
        if(Validate()){
          var kode = $('#kode').val();
          var pengguna = $('#idPengguna').val();
          var total = $('#totalHarga').val();

          var arrData=[];

          //loop over each table row (tr)
          $("#type_container tr").each(function(){
            var currentRow = $(this);

            var col0_value = currentRow.find("td:eq(0)").text();
            var col1_value = currentRow.find("td:eq(1)").text();
            var col2_value = currentRow.find("td:eq(2)").text();
            var col3_value = currentRow.find("td:eq(3)").text();
            var col4_value = currentRow.find("td:eq(4)").text();
            var col5_value = currentRow.find("td:eq(5)").text();
            var col6_value = currentRow.find("td:eq(6)").text();

            var obj={};
            obj.no = col0_value;
            obj.nama_bahan = col1_value;
            obj.satuan = col2_value;
            obj.harga = col3_value;
            obj.jumlah = col4_value;
            obj.subtotal = col5_value;

            arrData.push(obj);
          });
    
          var idbeli;
          var status;
   
          function a(){
            for (var i=0; i<arrData.length; i++){
              $.ajax({
                type: "GET",
                url: "/dynasti/public/pengadaan/pembelian/simpan1/"+idbeli+"/"+arrData[i]['nama_bahan']+"/"+arrData[i]['jumlah']+"/"+arrData[i]['subtotal'],
                success: function(result) {
                  console.log('berhasil');
                }
              });
            }
          };

          $.ajax({
              type: "GET",
              url: "/dynasti/public/pengadaan/pembelian/simpan/"+pengguna+"/"+total,
              success: function(result) {
                idbeli = result;
                console.log(idbeli)
              }
          }).done(a);

          $(document).ajaxStop(function(){
            window.location="{{URL::to('pengadaan/pembelian')}}";
            toastr.success("Data berhasil ditambah");
          });
        }
        
      });
    });
  </script>

  <!-- script select 2 untuk nyari bahan -->
  <script>
    jQuery(document).ready(function($) {
        // trigger select2 for each untriggered select2 box
        $("#namaBahan").each(function (i, obj) {
          if (!$(obj).data("select2"))
          {
            $(obj).select2({
              placeholder: "Nama Bahan",
              minimumInputLength: "1",
              ajax: {
                url: "/dynasti/public/api/bahan",
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
                $.ajax("/dynasti/public/api/bahan" + '/' , {
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