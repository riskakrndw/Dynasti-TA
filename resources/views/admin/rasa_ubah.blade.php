@extends('layout_master.master')

@section("title", "Ubah Data Rasa")

@section("rasa", "active")

@section("master", "active")

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
        <li><a> Master Data</a></li>
        <li><a href="{{route('rasa')}}">Data Rasa</a></li>
        <li class="active">Ubah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        
        <div class="col-md-12">
          <a href="{{route('rasa')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data rasa </button></a>
        </div>   

        <!-- Tambah Es -->
          <div class="col-md-12">
            <br>
            <div class="box">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Rasa</h3></li>
              </ul>

              <!-- Form tambah es -->
                <form role="form" action="" method="POST" onsubmit="return Validate()" name="vform">
                  {{csrf_field()}}
                  <div class="box-body">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Nama</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-font"></i></span>
                          <input class="form-control" placeholder="Nama" name="nama" id="nama" value="{{ $data->nama }}">
                        </div>
                        <span class="help-block val_error" id="nama_error" style="color:red;"></span>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Tersedia dalam jenis : </label>
                        @foreach($dataJenis as $key=>$dataJeniss)
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="checkjenis" class="checkjenis" data-id="{{ $dataJeniss->id }}" id="jenis{{ $dataJeniss->id }}" idjenis="{{$key}}">
                              {{ $dataJeniss->nama }}
                              <br>
                              <div id="showjenis{{$key}}" class="hide">
                                Dalam 1 resep menghasilkan:
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                  <input class="form-control inputcheckbox_error" placeholder="jumlah" name="jumlahProduksi" id="jumlahProduksi{{$dataJeniss->id}}" data-id="jenis{{ $dataJeniss->id }}" onKeyPress="return goodchars(event,'0123456789',this)">
                                  <span class="help-block input_error" style="color:red;"></span>
                                </div>
                                <br>
                                Stok Minimal:
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-warning "></i></span>
                                  <input class="form-control inputcheckbox_error" placeholder="Stok Minimal" name="stokMinimal" id="stokMinimal{{$dataJeniss->id}}" data-id="jenis{{ $dataJeniss->id }}" onKeyPress="return goodchars(event,'0123456789',this)">
                                  <span class="help-block input_error" style="color:red;"></span>
                                </div>
                              </div>
                            </label>
                            @if($key != count($dataJenis) - 1)
                              <p class="hide" id="atau{{$key}}">atau</p>
                            @endif
                          </div>
                        @endforeach
                        <span class="help-block val_error hide" id="jenis_error" style="color:red;">Jenis harus diisi minimal 1</span>
                      </div>
                    </div>
                  </div>
                
              <!-- /Form tambah es -->

              <hr id="garis">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Bahan baku yang diperlukan</h3></li>
              </ul>

              <!-- Data bahan -->
                <div class="col-xs-4">
                  <input type="hidden" class="form-control" id="namaBahan" placeholder="Nama Bahan" name="namabahan">
                  <span class="help-block val_error" id="namabahan_error" style="color:red;"></span>
                </div>
                <div class="col-xs-3">
                  <input type="text" class="form-control" id="satuanBahan" placeholder="Satuan" disabled>
                </div>
                <input class="form-control" type="hidden" name="idBahan" id="idBahan" value="">
                <div class="col-xs-3">
                  <input type="text" class="form-control" id="jumlahBahan" name="jumlahbahan" placeholder="Jumlah yang dibutuhkan" onKeyPress="return goodchars(event,'0123456789',this)">
                  <span class="help-block val_error" id="jumlahbahan_error" style="color:red;"></span>
                </div>
                <div class="col-xs-2">
                  <a href="javascript: void(0)"><button type="button" class="btn btn-sm btn-default btnTambahBahan"><i class="fa  fa-plus "></i> Tambah Bahan </button></a>
                </div>
              <!-- ./Data bahan -->

              <!-- tabel bahan -->
                <div class="box-body">
                  <br><br>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width:50px">No</th>
                        <th style="width: 325px">Nama Bahan</th>
                        <th style="width: 200px">Satuan</th>
                        <th style="width: 175px">Jumlah</th>
                        <th style="display:none">id</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="type_container">
                      <?php $no=1; ?>
                      @foreach($data->detail_rasa as $detailRasa)
                        <?php 
                          $id = $no+1;
                          $nama = str_replace(' ', '', $detailRasa->bahan->nama);
                        ?>
                        <tr id="tr{{$id}}">
                          <td>{{ $no++ }}</td>
                          <td>{{ $detailRasa->bahan->nama }}</td>
                          <td>{{ $detailRasa->bahan->satuan }}</td>
                          <td id="{{$nama}}">{{ $detailRasa->takaran }}</td>
                          <td style="display:none">{{ $detailRasa->bahan->id }}</td>
                            <td class="col-md-3 control-label"><a class="remove-type pull-right" data-nama="{{ $nama }}" targetDiv="" data-id="tr{{$no}}" href="javascript: void(0)"><i class="glyphicon glyphicon-trash"></i></a></td>
                        </tr>
                      @endforeach
                      
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
        <!-- /Tambah es -->
        
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

    //getting all input object
      var nama = document.forms["vform"]["nama"];
      // var jumlahbahan = document.getElementById("jumlahBahan");

    //getting all error display object
      var nama_error = document.getElementById("nama_error");
      var namaBahan = document.getElementById("namaBahan");
      var namabahan_error = document.getElementById("namabahan_error");
      var jumlahBahan = document.getElementById("jumlahBahan");
      var jumlahbahan_error = document.getElementById("jumlahbahan_error");
      // var jumlahbahan_error = document.getElementById("jumlahbahan_error");

    //setting all event listener
      // jumlahbahan.addEventListener("blur", jumlahbahanVerify, true);

    //validation function
      function Validate(){
        var hasil = true;

        if(nama.value == ""){
          nama.style.border = "1px solid red";
          nama_error.textContent = "Nama harus diisi";
          nama.focus();
          hasil = false;
        }else{
          nama.style.border = "1px solid #5E6E66";
          nama_error.innerHTML = "";
        }

        if(hasil == true){
          var cek = false;
            if($(".checkjenis:checkbox:checked").length > 0){
              $('#jenis_error').addClass('hide');
                $(".checkbox").each(function() {
                  if($(this).find('label').find('.checkjenis').is(':checked')){
                    if($(this).find('label').find('.input-group').find('.inputcheckbox_error').val() == ""){
                      $(this).find('label').find('.input-group').find('.input_error').text("errrrr");
                     
                    }else{
                      $(this).find('label').find('.input-group').find('.input_error').text("");
                      
                    }
                  }
                  
                });
                $(".checkbox").each(function() {
                 if($(this).find('label').find('.checkjenis').is(':checked')){
                    if($(this).find('label').find('.input-group').find('.inputcheckbox_error').val() == ""){
                      cek = true;
                    }
                  }
                });
                  console.log($('#type_container').children().length);
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
           }else {
              $('#jenis_error').removeClass('hide');
              return false;
           }
        }
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
    var arridjenis = [];

    jQuery(document).ready(function() {
      var doc = $(document);

      @foreach($data->ice_cream_notrashed as $datajenis)
        $('#jenis{{$datajenis->jenis->id}}').attr("checked", true);
        $('#showjenis'+$('#jenis{{$datajenis->jenis->id}}').attr('idjenis')).removeClass('hide');
        $('#jumlahProduksi{{$datajenis->jenis->id}}').val('{{ $datajenis->jumlah_produksi}}');
        $('#stokMinimal{{$datajenis->jenis->id}}').val('{{ $datajenis->stok_min}}');
      @endforeach

      jQuery('.btnTambahBahan').die('click').live('click', function(e) {
        if(ValidateDetail()){
          e.preventDefault();
          for(var i = 0; i<1; i++){
            var type_div = 'teams_'+jQuery.now();
      
            $.get('/dynasti/public/api/namaBahan/'+$('#namaBahan').val(),
              function(hasil){
                var nama = hasil[0];
                var id = hasil[1];
                var satuan = $('#satuanBahan').val();
                var jumlah = $('#jumlahBahan').val();
                var namadb  = "#" + nama.replace(/\s/g,'');
                if ($(namadb).length){
                  prevVal = $(namadb).text();
                  newVal = parseInt(prevVal)+parseInt(jumlah);
                  $(namadb).text(newVal);
                }
                else{
                  nomorBaris = nomorBaris + 1;
                  $('#type_container').append('<tr id="'+type_div+'"><td>'+nomorBaris+'</td><td>'+nama+'</td><td>'+satuan+'</td><td id='+nama.replace(/\s/g,'')+'>'+jumlah+'</td><td style="display:none">'+id+'</td><td class="col-md-3 control-label"><a class="remove-type pull-right" targetDiv="" data-id="'+type_div+'" href="javascript: void(0)"><i class="glyphicon glyphicon-trash"></i></a></td></tr>');            
                }
                $('#namaBahan').val('');
                $('#jumlahBahan').val('');
                $('#satuanBahan').val('');
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
            $('#satuanBahan').val(hasil.satuan);
          }
        ) //ngambil value nama

      });

      $('.checkjenis').change(function(){
        if(this.checked){
          $('#showjenis'+$(this).attr('idjenis')).removeClass('hide');
          $('#atau'+$(this).attr('idjenis')).removeClass('hide');
          $(this).closest('label').find('.input-group').find('.input_error').text("");
        }else{
          $('#showjenis'+$(this).attr('idjenis')).addClass('hide');
          $('#atau'+$(this).attr('idjenis')).addClass('hide');
        }
      });

      //save multi record to db
      $('#submit').on('click', function(){
        if(Validate()){
          var nama = $('#nama').val();
          var listJenis = $('#listJenis').val();
          var harga = $('#harga').val();
          var listRasa = $('#listRasa').val();
          var stok = $('#stok').val();
          var total = $('#totalHarga').val();

          var arrData=[];
          var arridbahan = [];

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
            obj.jumlah = col3_value;
            obj.satuan = col2_value;
            arridbahan.push(col4_value);

            arrData.push(obj);
          });
          

            $('input:checkbox[name=checkjenis]:checked').each(function(){
              var idjenis = $(this).attr('data-id')
              $.ajax({
                type: "POST",
                url: "http://localhost:8081/dynasti/public/manager/rasa/ubah2",
                data: 'idrasa= {{$data->id}}' + '& idjenis=' + idjenis + '& jumlah_produksi=' + $('#jumlahProduksi'+ idjenis).val()  + '& stok_minimal=' + $('#stokMinimal'+idjenis).val() + '& _token='+"{{csrf_token()}}",
                success: function(result) {
                }
              });
            })
            

            for (var i=0; i<arrData.length; i++){
              $.ajax({
                type: "POST",
                url: "http://localhost:8081/dynasti/public/manager/rasa/ubah1",
                data: 'idrasa= {{$data->id}}' + '& nama_bahan=' + arrData[i]['nama_bahan'] + '& takaran =' + arrData[i]['jumlah'] +'& _token='+"{{csrf_token()}}",
                success: function(result) {
                }
              });
            }

           $.ajax({
                type: "POST",
                url: "http://localhost:8081/dynasti/public/manager/rasa/ubah",
                data:'id= {{$data->id}}' + '& nama=' + $('#nama').val() +'& _token='+"{{csrf_token()}}",
                success: function(result) {
                  $('input:checkbox[name=checkjenis]:checked').each(function(){
                    var idjenis = $(this).attr('data-id')
                    arridjenis.push(idjenis);
                  })
                }
            }).done(a);


          function a(){
           $.ajax({
                type: "POST",
                url: "http://localhost:8081/dynasti/public/manager/rasa/hapusDetailRasa",
                data: 'idrasa= {{$data->id}}' + '& idbahan=' + arridbahan + '& _token='+"{{csrf_token()}}",
                success: function(result) {
                }
            });

           $.ajax({
                type: "POST",
                url: "http://localhost:8081/dynasti/public/manager/rasa/hapusEs",
                data: 'idrasa= {{$data->id}}' + '& idjenis=' + arridjenis + '& _token='+"{{csrf_token()}}",
                success: function(result) {
                }
            });
          }

          $(document).ajaxStop(function(){
            window.location="{{URL::to('manager/rasa')}}";
            toastr.info("Data berhasil diubah");
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