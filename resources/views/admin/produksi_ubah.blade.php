@extends('layout_master.master')

@section("title", "Manager | Tambah Data Produksi")

@section("dataproduksi", "active")

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
          <a href="{{route('produksi')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data produksi </button></a>
        </div>   

        <!-- Tambah penjualan -->
          <div class="col-md-12">
            <br>
            <div class="box">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Produksi</h3></li>
              </ul>
              <!-- Form tambah penjualan -->
                <form role="form" action="" method="" onsubmit="return Validate()" name="vform">
                  {{csrf_field()}}
                  <div class="box-body">
                    <input type="hidden" name="idPengguna" id="idPengguna" value="{{ Auth::User()->id }}">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Tanggal</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" placeholder="Tanggal Produksi" data-date-end-date="0d" value="{{ $data->tgl }}">
                        </div>
                        <span class="help-block val_error" id="tanggal_error" style="color:red;"></span>
                      </div>
                    </div>
                    <input type="hidden" name="ides" id="ides">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Rasa</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-font"></i></span>
                          <input type="hidden" class="form-control" id="rasa" name="rasa" placeholder="Rasa">
                        </div>
                        <span class="help-block val_error" id="rasa_error" style="color:red;"></span>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Jumlah Produksi</label>
                        <div id="namaJenis">

                        </div>
                      </div>
                    </div>
                  </div>
                
              <!-- /Form tambah penjualan -->

              <hr id="garis">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Daftar Bahan Baku</h3></li>
              </ul>

                <div class="box-body table-responsive">
                  
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width:50px">No</th>
                        <th style="width: 250px">Nama Bahan</th>
                        <th style="width: 200px">Satuan</th>
                        <th style="width: 250px">Jumlah</th>
                        <th>Stok</th>
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
  <script src="{{url('plugins/datepicker/locales/bootstrap-datepicker.id.js')}}"></script>

  <script type="text/javascript">

    //getting all input object
      var tanggal = document.forms["vform"]["datepicker"];
      var rasa = document.forms["vform"]["rasa"];

    //getting all error display object
      var tanggal_error = document.getElementById("tanggal_error");
      var rasa_error = document.getElementById("rasa_error");

    //setting all event listener
      tanggal.addEventListener("blur", tanggalVerify, true);

    //validation function
      function Validate(){
        var hasil = true;

        console.log(tanggal.value);
        
        if(tanggal.value == ""){
          tanggal.style.border = "1px solid red";
          tanggal_error.textContent = "Tanggal harus diisi";
          tanggal.focus();
          hasil = false;
        }else{
            tanggal.style.border = "1px solid #5E6E66";
            tanggal_error.innerHTML = "";
        }

        if(hasil == true){
          var cek = false;
          if(rasa.value == ""){
            rasa.style.border = "1px solid red";
            rasa_error.textContent = "Rasa harus diisi";
            rasa.focus();
            cek = true;
          }else{
            rasa.style.border = "1px solid #5E6E66";
            rasa_error.innerHTML = "";
          }

          if(cek == false){
            var cekjumlah = false;
            $(".bb").each(function() {
              if($(this).val() > 0){
                cekjumlah = true;
              }
            })
          }
          

          if(cekjumlah == true){
            return true;
          }else{
            alert("Minimal jumlah produksi harap diisi");
            return false;
          }
        }else{
          return false;
        }

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
    var w = 0;
    var arr  = [];
    var arr2 = [];
    var jumlahdipakai = [];
    var awalidbahan = [];
    var idbahan = [];
    var bahandipakai = [];
    var arrides = [];
    var arrstok = [];
    var nomorBaris = 0;
    var no;

    jQuery(document).ready(function() {
      var doc = $(document);
      w = 0;
      arr = [];
      arr2 = [];
      arrTakaran = [];
    
    });

    $(document).on('focusin', '.bb', function(){
      $(this).data('val', $(this).val());
    });

    $(document).on('change','.bb',function(){
      if($(this).val() == ''){
        $(this).val(0);
      }
       inputLama = $(this).data('val');
       console.log("input yg lama" + inputLama + $(this).val());
      console.log('cek takan:'+arrTakaran)
      var j=0;
      wh = false;
         $('.total').each(function(){ 
       
          var totalTakaran = 0; 
          
          
          for(var i = 1; i<=no; i++){
            var jumlahproduksi = $('#jumlahPro'+i).attr('jmlproduksi'); //jumlah yang dihasilkan dalam 1 takaran
            var jumlah = $('#jumlahPro'+i).val(); //jumlah yang ingin diproduksi
            var takaranjenis = parseFloat(jumlah) * (parseInt(arrTakaran[j]) / parseInt(jumlahproduksi)); //jumlah yg ingin diproduksi * takaran per bahan / jumlah yang dihasilkan dalam 1 takaran
            totalTakaran = totalTakaran + takaranjenis;
            var total = $(this).text();

              // if(w == 0)
              

              bahandipakai[j] = totalTakaran.toFixed(2);
              if((parseFloat(totalTakaran)) > arr2[j] || wh == true){
                wh = true;
               
                
              } else{
                arr.push(total);

                $(this).text(parseFloat(totalTakaran.toFixed(2)));
              }
          }
          
          j++;

      })

        if(wh == true)
        {
          alert('Bahan baku tidak mencukupi. Harap melakukan pengadaan bahan baku terlebih dahulu')
          // $('#submit').attr('disabled',true);
          $(this).val(inputLama);
        }else{
          // $('#submit').attr('disabled',false);
        }
        w = 1
        console.log(arr);
      });

      //menampilkan detail es
      $('#rasa').change(function(){
        w = 0;
        arr2 = [];
        $('#type_container').html('');
        nomorBaris = 0;

        $.get('/dynasti/public/api/rasa/'+$('#rasa').val(),
          function(hasil){
            $('#ides').val(hasil[0]);
            console.log("hasil : "+hasil);
          }
        )

        $.get('/dynasti/public/api/detail-jenis/'+$('#rasa').val(),
          function(data){
            no = 0;
            $('#namaJenis').empty();
            arrides = [];
             $.each(data, function(index, data){
              no++
                $('#namaJenis').append('<div class="input-group">' + data[1] +
                            '<input class="form-control bb" jmlproduksi="'+data[2]+'" placeholder="Jumlah Produksi" name="jumlah" min="0" value="0" type="number" data-no="'+no+'" id="jumlahPro'+no+'" ides="'+data[0]+'">' +
                          '</div>');
              arrides.push(data[0]);            
              console.log('data: '+data);
             })

            if($('#rasa').val() == '{{$data->detail_produksi[0]->ice_cream->id_rasa}}'){
              $('.bb').each(function(){ 

                var ides = $(this).attr('ides');
                var datano = $(this).attr('data-no')
                var jumlah = $(this).val();
                console.log("zzzz" + ides)
                console.log("yyy" + jumlah)


                $.ajax({
                    type: "GET",
                    url: "/dynasti/public/api/getJumlahProduksi/"+ides+"/{{$data->id}}",
                    success: function(result) {
                      jumlah = result;
                      $('#jumlahPro'+datano).val(jumlah);
                      console.log("aaa" + jumlah)
                    }
                });
              });

            }
          
          }
        ).done(tabel);

        function tabel(){
          $.get('/dynasti/public/api/detail-rasa/'+$('#rasa').val(),
          function(data){
            arrTakaran = [];
            console.log("datasss: " + data);
            idbahan = [];
             $.each(data, function(index, data){
              idbahan.push(data.id); //ngambil id bahan
              nomorBaris++
                $('#type_container').append('<tr id="'+data.id+'"><td>'+nomorBaris+'</td><td>'+data.nama+'</td><td>'+data.satuan+'</td><td id="total'+nomorBaris+'" class="total">'+"0"+'</td><td class="stok"  id="stok'+data.id+'">'+data.stok+'</td></tr>');            
                
              arr2.push(data.stok);
              arrstok.push(data.stok);
              arrTakaran.push(data.takaran);
             })


             console.log("Wwww")
             console.log(arrTakaran)
          
          }).done(a);


          function a(){
            console.log("hasil arr2" +arr2);
            if($('#rasa').val() == '{{$data->detail_produksi[0]->ice_cream->id_rasa}}'){

              awalidbahan = idbahan;
              console.log("awalidbahan" + awalidbahan);
              var j=0;
              wh = false; 
              console.log("pwpwpwp")
                 $('.total').each(function(){ 
                  var totalTakaran = 0; 
                  var i = 1;
                  var l = 1;
                  
                  
                  @foreach($data->detail_produksi as $q=>$value)
                    var jumlahproduksi = $('#jumlahPro'+i).attr('jmlproduksi'); //jumlah yang dihasilkan dalam 1 takaran
                    console.log('jumlahproduksi' + $('#jumlahPro'+i).val())
                    var jumlah = '{{$value->jumlah}}' //jumlah yang ingin diproduksi
                    var takaranjenis = parseFloat(jumlah) * (parseInt(arrTakaran[j]) / parseInt(jumlahproduksi)); //jumlah yg ingin diproduksi * takaran per bahan / jumlah yang dihasilkan dalam 1 takaran
                    totalTakaran = totalTakaran + takaranjenis;
                    var total = $(this).text();

                      // if(w == 0)
                      

                      bahandipakai[j] = totalTakaran.toFixed(2);
                      jumlahdipakai[j] = totalTakaran.toFixed(2);
                      arr2[j] = parseFloat(arrstok[j]) + parseFloat(bahandipakai[j]);

                      console.log("arr2 " +arr2);
                      console.log("bahandipakai " +bahandipakai);
                      

                      // if((parseFloat(totalTakaran)) > arr2[j] || wh == true){
                      //   wh = true;
                       
                        
                      // } else{
                        arr.push(total);

                        $(this).text(parseFloat(totalTakaran.toFixed(2)));
                        console.log("lll" +parseFloat(totalTakaran.toFixed(2)));
                      // }
                      i++;
                  @endforeach
                  
                  l++;
                  j++;

              })
        
              var indexarr2 = 0;
              $('.stok').each(function(){
                $(this).text(arr2[indexarr2]);
                indexarr2++;
              })

              console.log("hasil arr2" +arr2);

                // if(wh == true)
                // {
                //   alert('Bahan baku tidak mencukupi. Harap melakukan pengadaan bahan baku terlebih dahulu')
                //   // $('#submit').attr('disabled',true);
                //   $(this).val(inputLama);
                // }else{
                //   // $('#submit').attr('disabled',false);
                // }

                w = 1
                
              

          }else{
            for(var i=0; i<=jumlahdipakai.length - 1; i++){
            // alert("assa");
              $('#stok'+awalidbahan[i]).text(parseFloat($('#stok'+awalidbahan[i]).text()) + parseFloat(jumlahdipakai[i]));
              console.log('#stok'+awalidbahan[i]);
            }
          }
          }
        }
        

      });
      
      $('.bb').change(function(){
        alert('halo');
      })

      //save multi record to db
      $('#submit').on('click', function(){
        if(Validate()){
          var kode = $('#kode').val();
          var pengguna = $('#idPengguna').val();
          var ides = $('#ides').val();
          var datepicker = $('#datepicker').val();
          var bulan = new Date(datepicker).getMonth()+1;
          var datepicker = new Date(datepicker).getFullYear() + '-' + bulan + '-' + new Date(datepicker).getDate();
          // console.log(bulan);
          var rasa = $('#rasa').val();
          var jumlah = $('#jumlah').val();
          console.log(idbahan)

          var jumlahes = [];

          $('.bb').each(function(){ 
            jumlahes.push($(this).val());
          });

          $.ajax({
            type: "POST",
            url: "http://localhost:8081/dynasti/public/manager/produksi/ubah",
            data: 'datepicker= ' + datepicker + '& id_rasa=' + '{{$data->detail_produksi[0]->ice_cream->id_rasa}}' + '& id=' + '{{$data->id}}'  + '& id_es=' + arrides + '& jumlahes=' + jumlahes + '& _token='+"{{csrf_token()}}",
            success: function(result) {
            }
          });

          $.ajax({
            type: "POST",
            url: "http://localhost:8081/dynasti/public/manager/produksi/ubah1",
            data: 'idbahanawal= ' + awalidbahan + '& jumlahbahanawal=' + jumlahdipakai + '& idbahandipakai=' + idbahan  + '& jumlahbahandipakai=' + bahandipakai + '& _token='+"{{csrf_token()}}",
            success: function(result) {
            }
          });

          $(document).ajaxStop(function(){
            window.location="{{URL::to('manager/produksi')}}";
            toastr.success("Data berhasil ditambah");
          });
        }
        
        
      });
    // });
  </script>

  <!-- script select 2 untuk nyari bahan -->
  <script>
  console.log("{{ $data->detail_produksi[0]->ice_cream->id_rasa }}")
    jQuery(document).ready(function($) {
      $.get("/dynasti/public/api/rasa/{{$data->detail_produksi[0]->ice_cream->id_rasa}}", function(hasil){
        console.log("ini " + hasil[0]);
        $('#rasa').select2('data', {id:hasil[0], text:hasil[1]}).trigger('change');
      })
        // trigger select2 for each untriggered select2 box
        $("#rasa").each(function (i, obj) {
          if (!$(obj).data("select2"))
          {
            $(obj).select2({
              placeholder: "Rasa",
              minimumInputLength: "1",
              ajax: {
                url: "/dynasti/public/api/rasa",
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
                $.ajax("/dynasti/public/api/rasa" + '/'  , {
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