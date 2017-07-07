@extends('layout_master.master')

@section("title", "Tambah Ice Cream")

@section("es", "active")

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
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Data Master</a></li>
        <li><a href="#">Ice Cream</a></li>
        <li class="active">Ubah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        
        <div class="col-md-12">
          <a href="{{route('icecream')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman detail ice cream </button></a>
        </div>   

        <!-- Tambah Es -->
          <div class="col-md-12">
            <br>
            <div class="box box-success">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Ice Cream</h3></li>
              </ul>

              <!-- Form tambah es -->
                <form role="form" action="" method="post">
                  {{csrf_field()}}
                  <div class="box-body">
                    <input class="form-control" type="hidden" name="ides" id="ides" value="{{ $data->id }}">
                    <input class="form-control" type="hidden" name="nama" id="nama" value="{{ $data->nama }}">
                    <div class="col-md-6">
                      <div class="form-group">
                        <br>
                        <label>Pilih Jenis</label> atau <button type="button" data-toggle="modal" data-target="#tambahJenis" class="btn btn-default btn-xs"><i class="fa fa-plus"></i> Tambah Jenis</button>
                        <select class="form-control select2" style="width: 100%;" name="listJenis" id="listJenis">
                          @foreach($dataJenis as $dataJenis)
                            @if($dataJenis->id == null)
                              <option disabled="disabled" selected="selected" value="0">Jenis tidak ditemukan</option>
                            @else
                              <option value="{{ $dataJenis->id }}"
                                @if($data->id_jenis == $dataJenis->id)
                                  {{ 'selected' }}
                                @endif
                                >
                                {{$dataJenis->nama }}
                              </option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Harga</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input class="form-control" placeholder="Harga" name="harga" id="harga" value="{{ $data->harga }}" onKeyPress="return goodchars(event,'0123456789',this)">
                          </div>
                          @if($errors->has('harga'))
                            <span class="help-block">{{$errors->first('harga')}}</span>
                          @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <br>
                        <label>Pilih Rasa</label> atau <button type="button" data-toggle="modal" data-target="#tambahRasa" class="btn btn-default btn-xs"><i class="fa fa-plus"></i> Tambah Rasa</button>
                        <select class="form-control select2" style="width: 100%;" name="listRasa" id="listRasa">
                          @foreach($dataRasa as $dataRasa)
                            <option value="{{ $dataRasa->id }}"
                              @if($data->id_rasa == $dataRasa->id)
                                {{ 'selected' }}
                              @endif
                              >
                              {{$dataRasa->nama }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Stok</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                            <input class="form-control" placeholder="Stok" name="stok" id="stok" value="{{ $data->stok }}" onKeyPress="return goodchars(event,'0123456789',this)">
                          </div>
                          @if($errors->has('stok'))
                            <span class="help-block">{{$errors->first('stok')}}</span>
                          @endif
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
                  <input type="hidden" class="form-control" id="namaBahan" placeholder="Nama Bahan">
                </div>
                <div class="col-xs-3">
                  <input type="text" class="form-control" id="satuanBahan" placeholder="Satuan" disabled>
                </div>
                <input class="form-control" type="hidden" name="idBahan" id="idBahan" value="">
                <div class="col-xs-3">
                  <input type="text" class="form-control" id="jumlahBahan" placeholder="Jumlah yang dibutuhkan" onKeyPress="return goodchars(event,'0123456789',this)">
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
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="type_container">
                      <?php $no=1; ?>
                      @foreach($data->detail_bahan as $detailBahan)
                        <?php 
                          $id = $no+1;
                          $nama = str_replace(' ', '', $detailBahan->bahan->nama);
                        ?>
                          <tr id="tr{{$id}}" no="{{$no}}">
                            <td>{{ $no++ }}</td>
                            <td>{{ $detailBahan->bahan->nama }}</td>
                            <td>{{ $detailBahan->bahan->satuan }}</td>
                            <td id="{{ $nama }}">{{ $detailBahan->takaran }}</td>
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

        <!-- Modal tambah jenis -->
          <div id="tambahJenis" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Tambah Data Jenis</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="{{url('manager/jenis/simpan')}}" method="POST">
                {{csrf_field()}}
                <label>Nama Jenis</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-font"></i></span>
                  <input class="form-control" placeholder="Nama Jenis" name="nama">
                </div>
                @if($errors->has('nama'))
                  <span class="help-block">{{$errors->first('nama')}}</span>
                @endif
            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          </div>
        <!-- /Modal tambah jenis -->

        <!-- Modal tambah rasa -->
          <div id="tambahRasa" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Tambah Data Rasa</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="{{url('manager/rasa/simpan')}}" method="POST">
                {{csrf_field()}}
              <label>Nama Rasa</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                <input class="form-control" placeholder="Nama Rasa" name="nama">
              </div>
              @if($errors->has('nama'))
                <span class="help-block">{{$errors->first('nama')}}</span>
              @endif
            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
          </div>
        <!-- /Modal tambah rasa -->
        

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


  <script>
    var nomorBaris = {{$no - 1}};
    jQuery(document).ready(function() {
      var doc = $(document);
      jQuery('.btnTambahBahan').die('click').live('click', function(e) {
        e.preventDefault();
        for(var i = 0; i<1; i++){
          var type_div = 'teams_'+jQuery.now();
    
          $.get('/dynasti/public/api/namaBahan/'+$('#namaBahan').val(),
            function(hasil){
              var nama = hasil;
              var satuan = $('#satuanBahan').val();
              var jumlah = $('#jumlahBahan').val();
              var Subtotal = parseInt(harga) * parseInt(jumlah);
              var namadb  = "#" + nama.replace(/\s/g,'');
              if ($(namadb).length){
                prevVal = $(namadb).text();
                newVal = parseInt(prevVal)+parseInt(jumlah);
                $(namadb).text(newVal);
              }
              else{
                nomorBaris = nomorBaris + 1;
                $('#type_container').append('<tr id="'+type_div+'" no="'+nomorBaris+'"><td id="no'+nomorBaris+'">'+nomorBaris+'</td><td>'+nama+'</td><td>'+satuan+'</td><td id='+nama.replace(/\s/g,'')+'>'+jumlah+'</td><td class="col-md-3 control-label"><a class="remove-type pull-right" targetDiv="" data-nama="'+nama.replace(/\s/g,'')+'" data-id="'+type_div+'" href="javascript: void(0)"><i class="glyphicon glyphicon-trash"></i></a></td></tr>');            
              }
              $('#namaBahan').val('');
              $('#jumlahBahan').val('');
              $('#satuanBahan').val('');
            }
          )
        }
      });
  
      jQuery(".remove-type").die('click').live('click', function (e) {
        var didConfirm = confirm("Are you sure You want to delete");
        if (didConfirm == true) {
            var id = jQuery(this).attr('data-id');
            //if (id == 0) {
                //var trID = jQuery(this).parents("tr").attr('id');
                
                var jmltr = $('#type_container').children().length;
                // console.log(jmltr);
                // console.log($(this).closest('tr').attr('no'));
                for(var i = parseInt($(this).closest('tr').attr('no'))+1; i<=jmltr; i++){
                  
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
            $('#satuanBahan').val(hasil.satuan);
          }
        ) //ngambil value nama

      });

      //save multi record to db
      $('#submit').on('click', function(){
        var nama = $('#nama').val();
        var ides = $('#ides').val();
        var listJenis = $('#listJenis').val();
        var harga = $('#harga').val();
        var listRasa = $('#listRasa').val();
        var stok = $('#stok').val();
        var total = $('#totalHarga').val();

        var arrData=[];

        //loop over each table row (tr)
        $("#type_container tr").each(function(){
          var currentRow = $(this);

          var col0_value = currentRow.find("td:eq(0)").text();
          var col1_value = currentRow.find("td:eq(1)").text();
          var col2_value = currentRow.find("td:eq(2)").text();
          var col3_value = currentRow.find("td:eq(3)").text();

          var obj={};
          obj.no = col0_value;
          obj.nama_bahan = col1_value;
          obj.jumlah = col2_value;
          obj.satuan = col3_value;

          arrData.push(obj);
        });
  
        var ides = {{ $data->id }};
 
        function a(){
          for (var i=0; i<arrData.length; i++){
            $.ajax({
              type: "POST",
              url: "http://localhost:8081/dynasti/public/icecream/ubah1",
              data:'ides=' + ides + '& nama_bahan=' + arrData[i]['nama_bahan'] + '& jumlah =' + arrData[i]['jumlah'] + '& satuan =' + arrData[i]['satuan'] +'& _token='+"{{csrf_token()}}",
              success: function(result) {
              }
            });
          }
        };

          $.ajax({
              type: "POST",
              url: "http://localhost:8081/dynasti/public/icecream/ubah",
              data:'ides=' + ides + '& nama=' + nama + '& harga = ' + harga + '& stok = ' + stok + '& listRasa = ' + listRasa + '& listJenis = ' + listJenis+'& _token='+"{{csrf_token()}}",
              success: function(result) {

              }
          });
        

        $.ajax({
              type: "POST",
              url: "http://localhost:8081/dynasti/public/icecream/hapusDetailBahan",
              data: 'ides=' + ides +'& _token='+"{{csrf_token()}}",
              success: function(result) {
               console.log(result);
              }
          }).done(a);

        $(document).ajaxStop(function(){
          window.location="{{URL::to('icecream')}}";
        });

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