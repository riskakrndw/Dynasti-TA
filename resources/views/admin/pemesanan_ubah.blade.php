@extends('layout_master.master')

@section("title", "Manager | Ubah Data Pemesanan")

@section("pesanan", "active")

@section("pemesanan", "active")

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
        <li><a>Pemesanan</a></li>
        <li><a href="{{route('pemesanan')}}">Data Pemesanan</a></li>
        <li class="active">Ubah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        
        <div class="col-md-12">
          <a href="{{route('pemesanan')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data pemesanan </button></a>
        </div>   

        <!-- Tambah penjualan -->
          <div class="col-md-12">
            <br>
            <div class="box">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Pemesanan</h3></li>
              </ul>

              <!-- Form tambah penjualan -->
                <form role="form" action="" method="" onsubmit="return Validate()" name="vform">
                  {{csrf_field()}}
                  <div class="box-body">
                    <input class="form-control" type="hidden" name="idPengguna" id="idPengguna" value="{{Auth::User()->id}}">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kode Pemesanan</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                          <input class="form-control" placeholder="Kode Penjualan" name="kode" id="kode" value="PMS| {{\Carbon\Carbon::parse($data->tgl)->format('Y-m-d')}}| {{$data->id}}" disabled>
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
                          <input type="text" class="form-control pull-right" id="datepicker" value="{{ $data->tanggal }}" name="tanggal" data-date-start-date="0d">
                        </div>
                        <span class="help-block val_error" id="tanggal_error" style="color:red;"></span>
                      </div>
                    </div>
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
                        <label>Telepon</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                          <input class="form-control" placeholder="Telepon" name="telepon" id="telepon" value="{{ $data->telepon }}">
                        </div>
                        <span class="help-block val_error" id="telepon_error" style="color:red;"></span>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Alamat</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-home"></i></span>
                          <textarea class="form-control" placeholder="Alamat" name="alamat" id="alamat">{{ $data->alamat }}</textarea>
                        </div>
                        <span class="help-block val_error" id="alamat_error" style="color:red;"></span>
                      </div>
                    </div>
                  </div>
                

              <!-- /Form tambah penjualan -->

              <hr id="garis">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Ice Cream yang dipesan</h3></li>
              </ul>

              <!-- Data bahan -->
                <div class="col-xs-3">
                  <input type="hidden" class="form-control" id="namaEs" placeholder="Nama Ice Cream" name="namaes">
                  <span class="help-block val_error" id="namaes_error" style="color:red;"></span>
                </div>
                <input class="form-control" type="hidden" name="idEs" id="idEs" value="">
                <input class="form-control" type="hidden" name="stokEs" id="stokEs" value="">
                <div class="col-xs-3">
                  <input type="text" class="form-control" id="hargaEs" placeholder="Harga" disabled>
                </div>
                <div class="col-xs-3">
                  <input type="text" class="form-control" id="jumlahEs" name="jumlaes" placeholder="Jumlah yang dipesan" onKeyPress="return goodchars(event,'0123456789',this)">
                  <span class="help-block val_error" id="jumlahes_error" style="color:red;"></span>
                </div>
                <div class="col-xs-3">
                  <a href="javascript: void(0)"><button type="button" class="btn btn-sm btn-default btnTambahEs"><i class="fa  fa-plus "></i> Tambah Ice Cream </button></a>
                </div>
              <!-- ./Data bahan -->

              <!-- tabel bahan -->
                <div class="box-body table-responsive" style="width:99%; margin:auto;">
                  <br><br>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width:50px; display:none">No</th>
                        <th style="width: 200px">Nama Ice Cream</th>
                        <th style="width: 175px">Harga</th>
                        <th style="width: 100px">Status</th>
                        <th style="width: 100px">Jumlah</th>
                        <th style="width: 250px">Subtotal</th>
                        <th style="display:none">id</th>
                        <th style="display:none">id detail</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="type_container">
                      <?php $no=0; ?>
                      @foreach($data->detail_pemesanan as $detail_pemesanan)
                        <?php 
                          $id = $no+1;
                          $no++; 
                          $nama = str_replace(' ', '', $detail_pemesanan->ice_cream->nama);
                        ?>
                        <tr id="tr{{$no}}">
                          <td style="width:50px; display:none">{{ $no }}</td>
                          <td>{{ $detail_pemesanan->ice_cream->nama }}</td>
                          <td>{{ $detail_pemesanan->ice_cream->jenis->harga }}</td>
                          <td id="{{$nama}}status{{$detail_pemesanan->status}}">{{ $detail_pemesanan->status }}</td>
                          <td id="{{$nama}}{{$detail_pemesanan->status}}">
                            @if($detail_pemesanan->status == "menunggu")
                            <input type="number" class="nunggupemesanan" nama="{{ $nama }}" harga = "{{ $detail_pemesanan->ice_cream->jenis->harga }}" value="{{ $detail_pemesanan->jumlah }}" min="1" style="width: 50px;">
                            @else
                            <input type="number" value="{{ $detail_pemesanan->jumlah }}" min="1" style="width: 50px;" disabled>
                            @endif
                          </td>
                          <td id="{{ $nama }}subTotal{{$detail_pemesanan->status}}" class="subTotal">{{ $detail_pemesanan->subtotal }}</td>
                          <td style="display:none">{{ $detail_pemesanan->id_es }}</td>
                          <td style="display:none">{{ $detail_pemesanan->id }}</td>
                          @if($detail_pemesanan->status == "menunggu")
                            <td>
                              <a class="remove-type btn btn-sm btn-default" targetDiv="" data-id="tr{{$no}}" href="javascript: void(0)"><i class="glyphicon glyphicon-trash"></i></a>
                            </td>

                          @else
                            <td>
                              <a class="remove-type btn btn-sm btn-default" targetDiv="" data-id="tr{{$no}}" href="javascript: void(0)" disabled><i class="glyphicon glyphicon-trash"></i></a>
                            </td>
                          @endif
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
        <!-- /Tambah penjualan -->
        
      </div>
    </section>
    <!-- /. main content -->
  </div>
@endsection

@section("morescript")

<!-- Modal Windows -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> -->
<!-- validasi keyboard numeric only -->
  <script src="{{url('dist/js/validasinumeric.js')}}"></script>
<!-- dinamically add -->
  <script src="{{url('dist/js/jquery-1.8.2.min.js')}}" type="text/javascript" charset="utf8"></script>
  <script src="{{url('dist/js/select2/select2.js')}}"></script>
<!-- date -->
  <script src="{{url('dist/js/bootstrap-datepicker.js')}}"></script>
  <script src="{{url('plugins/datepicker/locales/bootstrap-datepicker.id.js')}}"></script>
  <script src="{{url('dist/js/bootstrap-modalmanager.js')}}"></script>
  <script src="{{url('dist/js/bootstrap-modal.js')}}"></script>

  <script type="text/javascript">

    //getting all input object
      var tanggal = document.forms["vform"]["tanggal"];
      var nama = document.forms["vform"]["nama"];
      var telepon = document.forms["vform"]["telepon"];
      var alamat = document.forms["vform"]["alamat"];

    //getting all error display object
      var tanggal_error = document.getElementById("tanggal_error");
      var namaEs = document.getElementById("namaEs");
      var namaes_error = document.getElementById("namaes_error");
      var jumlahEs = document.getElementById("jumlahEs");
      var jumlahes_error = document.getElementById("jumlahes_error");

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

        if(nama.value == ""){
          nama.style.border = "1px solid red";
          nama_error.textContent = "Nama harus diisi";
          nama.focus();
          cek = true;
        }else{
          nama.style.border = "1px solid #5E6E66";
          nama_error.innerHTML = "";
        }

        if(telepon.value == ""){
          telepon.style.border = "1px solid red";
          telepon_error.textContent = "Telepon harus diisi";
          telepon.focus();
          cek = true;
        }else{
          telepon.style.border = "1px solid #5E6E66";
          telepon_error.innerHTML = "";
        }

        if(alamat.value == ""){
          alamat.style.border = "1px solid red";
          alamat_error.textContent = "Alamat harus diisi";
          alamat.focus();
          cek = true;
        }else{
          alamat.style.border = "1px solid #5E6E66";
          alamat_error.innerHTML = "";
        }

        if(cek == false){
          if($('#type_container').children().length == 0){

            alert('Ice Cream harus diisi');
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
        
        if(namaEs.value == ""){
          namaEs.style.border = "1px solid red";
          namaes_error.textContent = "Nama Ice Cream harus diisi";
          namaEs.focus();
          return false;
        }else{
          namaEs.style.border = "1px solid #5E6E66";
          namaes_error.innerHTML = "";
        }

        if(jumlahEs.value == ""){
          jumlahEs.style.border = "1px solid red";
          jumlahes_error.textContent = "Jumlah harus diisi";
          jumlahEs.focus();
          return false;
        }else{
          jumlahEs.style.border = "1px solid #5E6E66";
          jumlahes_error.innerHTML = "";
        }

          return true;

      }
  </script>

  <!-- script tambah bahan baku -->
  <script>
    //Date picker
      $('#datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayBtn:"linked",
        language:"id",
      });

    var nomorBaris = {{$no}};
    jQuery(document).ready(function() {
      var doc = $(document);
      jQuery('.btnTambahEs').die('click').live('click', function(e) {
        if(ValidateDetail()){
          e.preventDefault();
          for(var i = 0; i<1; i++){
            var type_div = 'teams_'+jQuery.now();
      
            $.get('/dynasti/public/api/arraynamaIceCream/'+$('#idEs').val()+'/'+$('#jumlahEs').val(),
              function(hasil){
                var nama = hasil[1];
                var ides = hasil[0];
                var status = hasil[2];
                var harga = $('#hargaEs').val();
                var jumlah = $('#jumlahEs').val();
                var total = $('#totalHarga').val();
                var Subtotal = parseInt(harga) * parseInt(jumlah);
                var namadb  = "#" + nama.replace(/\s/g,'');
                var namaSub = namadb + "subTotalmenunggu";
                if ($(namadb+'menunggu').length){
                  prevVal = $(namadb+'menunggu' + ' .nunggupemesanan').val();
                  console.log(prevVal);
                  newVal = parseInt(prevVal)+parseInt(jumlah);
                  $(namadb+'menunggu' + ' .nunggupemesanan').val(newVal);

                  prevSub = $(namaSub).text();
                  newSub = parseInt(prevSub) + parseInt(jumlah) * parseInt(harga);
                  $(namaSub).text(newSub);
                  
                }
                else{
                  nomorBaris = nomorBaris + 1;
                  $('#type_container').append('<tr id="tr'+nomorBaris+'" no="'+nomorBaris+'"><td style="display:none" id="no'+nomorBaris+'">'+nomorBaris+'</td><td>'+nama+'</td><td>'+harga+'</td><td id='+nama.replace(/\s/g,'')+'statusmenunggu'+'>'+status+'</td><td id='+nama.replace(/\s/g,'')+'menunggu'+'><input type="number" class="nunggupemesanan" nama="'+nama.replace(/\s/g,'')+'" harga="'+harga+'" value="'+jumlah+'" min="1" style="width: 50px;"></td><td class="subTotal" id='+nama.replace(/\s/g,'')+'subTotalmenunggu'+'>'+Subtotal+'</td><td style="display:none">'+ides+'</td><td style="display:none">'+0+'</td><td class="col-md-3 control-label"> '+
                         '     <a class="remove-type btn btn-sm btn-default" targetDiv="" data-id="tr'+nomorBaris+'" href="javascript: void(0)" ><i class="glyphicon glyphicon-trash"></i></a></td></tr>');
                }
                $('#namaEs').val('');
                $('#hargaEs').val('');
                $('#jumlahEs').val('');

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

            var jmltr = $('#type_container').children().length;
            for(var i = parseInt($(this).closest('tr').attr('no'))+1; i<=jmltr; i++){
              
              $('#no'+i).text($('#no'+i).text() - 1);
              $('#no'+i).attr('id', $('#no'+i).text() - 1);

            }

                jQuery('#' + id).remove();
                nomorBaris = nomorBaris - 1;
                var deletedSubTotal = $(this).closest("tr").find(".subTotal").text();
                var totalHargaLama = parseInt(document.getElementById('totalHarga').value);
                var totalHargaBaru = totalHargaLama - deletedSubTotal;

                console.log("deletedSubTotal : " + deletedSubTotal);
                console.log("totalHargaLama : " + totalHargaLama);
                console.log("totalHargaBaru : " + totalHargaBaru);
                document.getElementById('totalHarga').value = totalHargaBaru;
                
           // }
            return true;
        } else {
            return false;
        }
      });

      $('.nunggupemesanan').change(function(){

        console.log("lll");
        var namaes = $(this).attr('nama');
        var jumlah = parseInt($(this).val());
        var harga = parseInt($(this).attr('harga'));
        var subTotalLama = parseInt($('#'+namaes+'subTotalmenunggu').text());
        $('#'+namaes+'subTotalmenunggu').text(jumlah*harga);
        var subTotalBaru = parseInt($('#'+namaes+'subTotalmenunggu').text());
        $('#totalHarga').val(parseInt($('#totalHarga').val()) + subTotalBaru - subTotalLama);


      });

      $(document).on('change','.nunggupemesanan',function(){
        var namaes = $(this).attr('nama');
        var jumlah = parseInt($(this).val());
        var harga = parseInt($(this).attr('harga'));
        var subTotalLama = parseInt($('#'+namaes+'subTotalmenunggu').text());
        $('#'+namaes+'subTotalmenunggu').text(jumlah*harga);
        var subTotalBaru = parseInt($('#'+namaes+'subTotalmenunggu').text());
        $('#totalHarga').val(parseInt($('#totalHarga').val()) + subTotalBaru - subTotalLama);

      });

      //nampilin id
      $('#namaEs').change(function(){
        $.get('/dynasti/public/api/icecream/'+$('#namaEs').val(),
          function(hasil){
            console.log(hasil)
            $('#idEs').val(hasil[0]);
            if($('#'+hasil[2].replace(/\s/g,'')).length){
              $('#stokEs').val(hasil[1]-$('#'+hasil[2].replace(/\s/g,'')).text());  
            }
            else{
            $('#stokEs').val(hasil[1]);
            }
            $('#namaEs').val(hasil[2]);
            $('#hargaEs').val(hasil[3]);
          }
        ) //ngambil value nama

      });

      //save multi record to db
      $('#submit').on('click', function(){
        if(Validate()){
          var kode = $('#kode').val();
          var pengguna = $('#idPengguna').val();
          var nama = $('#nama').val();
          var alamat = $('#alamat').val();
          var telepon = $('#telepon').val();
          var status = $('#pilihstatus').val();
          var datepicker = $('#datepicker').val();
          var bulan = new Date(datepicker).getMonth()+1;
          var datepicker = new Date(datepicker).getFullYear() + '-' + bulan + '-' + new Date(datepicker).getDate();
          console.log(bulan);
          var total = $('#totalHarga').val();

          var arrData=[];
          var arriddetailpesan = [];

          //loop over each table row (tr)
          $("#type_container tr").each(function(){
            var currentRow = $(this);

            var col0_value = currentRow.find("td:eq(0)").text();
            var col1_value = currentRow.find("td:eq(1)").text();
            var col2_value = currentRow.find("td:eq(2)").text();
            var col3_value = currentRow.find("td:eq(3)").text();
            var col4_value = currentRow.find("td:eq(4)").find("input").val();
            var col5_value = currentRow.find("td:eq(5)").text();
            var col6_value = currentRow.find("td:eq(6)").text();
            var col7_value = currentRow.find("td:eq(7)").text();

            var obj={};
            obj.no = col0_value;
            obj.nama_es = col1_value;
            obj.harga = col2_value;
            obj.status = col3_value;
            obj.jumlah = col4_value;
            obj.subtotal = col5_value;
            obj.ides = col6_value;
            obj.iddetail = col7_value;


            arriddetailpesan.push(col7_value);
            arrData.push(obj);
          });
    
          var idpesan;

          // function a(){
           $.ajax({
                type: "POST",
                url: "http://localhost:8081/dynasti/public/manager/pemesanan/hapusDetailPemesanan",
                data: 'idpesan= {{$data->id}}' + '& id=' + arriddetailpesan + '& _token='+"{{csrf_token()}}",
                success: function(result) {
                 console.log("arriddetailpesan : " + arriddetailpesan);
                }
            }).done(a);
          // };
    
          function a(){
            for (var i=0; i<arrData.length; i++){
              console.log(arrData[i]['jumlah']);
              console.log(arrData[i]['subtotal']);
              $.ajax({
                type: "GET",
                url: "/dynasti/public/manager/pemesanan/ubah1/{{$data->id}}/"+arrData[i]['ides']+"/"+arrData[i]['jumlah']+"/"+arrData[i]['status']+"/"+arrData[i]['subtotal'],
                success: function(result) {
                  console.log("{{$data->id}}");
                }
              });
            }
          }
            

          $.ajax({
              type: "GET",
              url: "/dynasti/public/manager/pemesanan/ubah/{{$data->id}}/"+pengguna+"/"+nama+"/"+alamat+"/"+telepon+"/"+datepicker+"/"+total,
              success: function(result) {
                idpesan = result;
                /*console.log(idjual)*/
              }
          });

          $(document).ajaxStop(function(){
            window.location="{{URL::to('manager/pemesanan')}}";
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