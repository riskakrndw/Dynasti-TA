<html>
    <body>
        <center>
            <table text-align="center" style="margin-top:40px">
                <tr>
                    <td align="center" rowspan="5" style="width: 6em"><img src="{{url('dist/img/logo.jpeg')}}" class="img-circle" width="90px" height="110px" /></td>
                </tr>
                <tr><td align="center" style="font-size:20px;"><b>Dynasti Ice Cream</b></td></tr>
                <tr><td align="center"style="font-size:20px;"><b></b></td></tr>
                <tr><td align="center">Komplek Paledang Indah MB RT 08 Rw 11 </td></tr>
                <tr><td align="center">Ds. Bojongkunci, Kec. Pameungpeuk, Kab. Bandung </td></tr>   
            </table>

            <hr size="3px" style="width:85%;" />
        </center>

        <br>

        <table align="center" style="width:85%;border-collapse: collapse; margin-top:10px">
            <tr>
                <td style="font-size:35px;" align="center">Laporan Stok Bahan Baku </td>
            </tr>
        </table>

        <table align="center" style="width:85%;border-collapse: collapse; margin-top:10px">
            <tr>
                <td style="font-size:20px;">Dari tanggal : Sampai tanggal : </td>
            </tr>
        </table>

        <br><br>

         <table align="center" style="width:85%;border-collapse: collapse; margin-top:10px; " id="dataTables-example" border="1">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th style="width: 300px">Nama Bahan</th>
              <th style="width: 200px">Satuan</th>
              <th style="width: 100px">Stok</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $v)
            <tr>
              <td style="text-align: center; height:35px;">1</td>
              <td style="text-align: center; height:35px;">{{$v->nama}}</td>
              <td style="text-align: center; height:35px;">{{$v->satuan}}</td>
              <td>{{$v->stok}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <br><br><br><br>   
                
        <table align="center" style="width:85%"; >
            <tr>
                <td align="right" style="padding-right:55px;"><u><b></b></u></td>
            </tr>
        </table>
                
        <table align="center" style="width:75%";>
            <tr><td align="left"><b></b></td></tr>
        </table>
            
        <table align="center" style="width:85%";>
            <tr><td align="left"><b></b></td></tr>
        </table>
      
    </body>

    <script src="{{ asset('vendor/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            window.print();
         setTimeout(window.close, 0);
        })
    </script>
</html>