@extends('layout_master.master')

@section("title", "Manager | Ubah Data Pengadaan")

@section("beli", "active")

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
        <li><a href="{{route('beranda')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Transaksi</a></li>
        <li><a href="{{route('pembelian')}}">Data Pengadaan</a></li>
        <li class="active">Ubah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        
        <div class="col-md-12">
          <a href="{{route('pembelian')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data pengadaan </button></a>
        </div>   

        <!-- Tambah Pembelian -->
          <div class="col-md-12">
            <br>
            <div class="box">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Pembelian</h3></li>
              </ul>

              <!-- Form tambah pembelian -->
                <form role="form" action="" method="" onsubmit="return Validate()" name="vform">
                  {{csrf_field()}}
                  <div class="box-body">
                    <input class="form-control" type="hidden" name="idPengguna" id="idPengguna" value="{{Auth::User()->id}}">
                    <input class="form-control" type="hidden" name="status" id="status" value="">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kode Pengadaan</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-font"></i></span>
                          <input class="form-control" placeholder="Kode Pembelian" name="kode" id="kode" value="{{ $data->kode_pembelian }}" disabled>
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
                          <input type="text" class="form-control pull-right" id="datepicker" value="{{ $data->tgl }}" name="tanggal" data-date-end-date="0d">
                        </div>
                        <span class="help-block val_error" id="tanggal_error" style="color:red;"></span>
                      </div>
                    </div>
                  </div>
                
              <!-- /Form tambah es -->

              <hr id="garis">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Daftar Bahan Baku</h3></li>
              </ul>

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

              <!-- tabel bahan -->
                <div class="box-body table-responsive" style="width:99%; margin:auto;">
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
                      <?php $no=1; ?>
                      @foreach($data->detail_beli as $detail_beli)
                        <?php 
                          $id = $no+1;
                          $nama = str_replace(' ', '', $detail_beli->bahan->nama);
                        ?>
                        <tr id="tr{{$id}}" no="{{$no}}">
                          <td style="width:50px; display:none">{{ $no++ }}</td>
                          <td>{{ $detail_beli->bahan->nama }}</td>
                          <td>{{ $detail_beli->bahan->satuan }}</td>
                          <td>{{ $detail_beli->bahan->harga }}</td>
                          <td id="{{ $nama }}">{{ $detail_beli->jumlah }}</td>
                          <td id="{{ $nama }}subTotal" class="subTotal">{{ $detail_beli->subtotal }}</td>
                          <td class="col-md-3 control-label"><a class="remove-type" data-nama="{{ $nama }}" targetDiv="" data-id="tr{{$no}}" href="javascript: void(0)"><i class="glyphicon glyphicon-trash"></i></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <br>

                  <span>Total Harga</span>
                  <input id="totalHarga" class="totalHarga" name="total" placeholder="0" value="{{ $data->total }}" disabled>

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
<!-- date -->
  <script src="{{url('dist/js/bootstrap-datepicker.js')}}"></script>
  <script src="{{url('plugins/datepicker/locales/bootstrap-datepicker.id.js')}}"></script>

  <script type="text/javascript">

    //getting all input object
      var tanggal = document.forms["vform"]["tanggal"];

    //getting all error display object
      var tanggal_error = document.getElementById("tanggal_error");
      var namaBahan = document.getElementById("namaBahan");
      var namabahan_error = document.getElementById("namabahan_error");
      var jumlahBahan = document.getElementById("jumlahBahan");
      var jumlahbahan_error = document.getElementById("jumlahbahan_error");

    //setting all event listener
      tanggal.addEventListener("blur", tanggalVerify, true);

    //validation function
      function Validate(){
        var cek = false;
        
        if(tanggal.value == ""){
          tanggal.style.border = "1px solid red";
          tanggal_error.textContent = "Tanggal harus diisi";
          tanggal.focus();
          cek = true;
        }else{
          tanggal.style.border = "1px solid #5E6E66";
          tanggal_error.innerHTML = "";
        }

        if(cek == false){
          if($('#type_container').children().length == 0){

            alert('Bahan baku harus diisi');
            return false;
          }else{
            return true;
          }
        }else{
          return false;
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

  <script>
    //Date picker
      $('#datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayBtn:"linked",
        language:"id",
      });

    var nomorBaris = {{$no - 1}};
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
                  $('#type_container').append('<tr id="'+type_div+'" no="'+nomorBaris+'"><td style="display:none" id="no'+nomorBaris+'">'+nomorBaris+'</td><td>'+nama+'</td><td>'+satuan+'</td><td>'+harga+'</td><td id='+nama.replace(/\s/g,'')+'>'+jumlah+'</td><td class="subTotal" id='+nama.replace(/\s/g,'')+'subTotal'+'>'+Subtotal+'</td><td class="col-md-3 control-label"><a class="remove-type" targetDiv="" data-nama="'+nama.replace(/\s/g,'')+'" data-id="'+type_div+'" href="javascript: void(0)"><i class="glyphicon glyphicon-trash"></i></a></td></tr>');            
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
                
                var deletedSubTotal = $(this).closest("tr").find(".subTotal").text();
                var totalHargaLama = parseInt(document.getElementById('totalHarga').value);
                var totalHargaBaru = totalHargaLama - deletedSubTotal;
                document.getElementById('totalHarga').value = totalHargaBaru;

                var jmltr = $('#type_container').children().length;
                for(var i=parseInt($(this).closest('tr').attr('no'))+1; i<=jmltr; i++){
                  $('#no'+i).text($('#no'+i).text() - 1);
                  $('#no'+i).attr('id', $('#no'+i).text() - 1);
                }
                jQuery('#' + id).remove();
                nomorBaris = nomorBaris - 1;
                
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
          var datepicker = $('#datepicker').val();
          var bulan = new Date(datepicker).getMonth()+1;
          var datepicker = new Date(datepicker).getFullYear() + '-' + bulan + '-' + new Date(datepicker).getDate();
          console.log(bulan);
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
    
          var idbeli = {{ $data->id }};
          var status;
   
          function a(){
            for (var i=0; i<arrData.length; i++){
              $.ajax({
                type: "GET",
                url: "/dynasti/public/manager/pembelian/simpan1/"+idbeli+"/"+arrData[i]['nama_bahan']+"/"+arrData[i]['jumlah']+"/"+arrData[i]['subtotal'],
                success: function(result) {
                  console.log('berhasil');
                }
              });
            }
          };

          
            $.ajax({
                type: "GET",
                url: "/dynasti/public/manager/pembelian/ubah/"+idbeli+"/"+pengguna+"/"+datepicker+"/"+total,
                success: function(result) {

                }
            });
          

          $.ajax({
                type: "GET",
                url: "/dynasti/public/manager/pembelian/hapusDetailPembelian/"+idbeli,
                success: function(result) {
                 console.log(result);
                }
            }).done(a);

          $(document).ajaxStop(function(){
            window.location="{{URL::to('manager/pembelian')}}";
            toastr.info("Data berhasil diubah");
          });
        }
      });
    });
  </script>

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