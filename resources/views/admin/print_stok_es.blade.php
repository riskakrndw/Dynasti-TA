<html>
    <body>
        <center>
            <table text-align="center" style="margin-top:40px">
                <tr>
                    <td align="center" rowspan="5" style="width: 8em"><img src="{{url('dist/img/logo.jpeg')}}" class="img-circle" width="100px" height="120px" /></td>
                </tr>
                <tr><td align="center" style="font-size:33px;"><b>Dynasti Ice Cream</b></td></tr>
                <tr><td align="center" style="font-size:18px;"><b></b></td></tr>
                <tr><td align="center" style="font-size:18px;">Komplek Paledang Indah MB RT 08 Rw 11 </td></tr>
                <tr><td align="center" style="font-size:18px;">Ds. Bojongkunci, Kec. Pameungpeuk, Kab. Bandung </td></tr>   
            </table>

            <hr size="3px" style="width:85%;" />
        </center>

        <br>

        <table align="center" style="width:85%;border-collapse: collapse; margin-top:10px">
            <tr>
                <td style="font-size:25px;" align="center">Laporan Stok Ice Cream </td>
            </tr>
        </table>

        <br><br>

         <table align="center" style="width:85%;border-collapse: collapse; margin-top:10px; " id="dataTables-example" border="1">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th style="width: 300px">Nama Ice Cream</th>
              <th style="width: 100px">Stok</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            @foreach($data as $v)
            
            @if($v->stok < 100)
                <tr style="background-color:#ff851b;">
                  <td style="text-align: center; height:35px;">{{ $no++ }}</td>
                  <td style="height:35px;">{{$v->nama}}</td>
                  <td style="text-align: center; height:35px;">{{$v->stok}}</td>
                </tr>
              @else
                <tr>
                  <td style="text-align: center; height:35px;">{{ $no++ }}</td>
                  <td style="height:35px;">{{$v->nama}}</td>
                  <td style="text-align: center; height:35px;">{{$v->stok}}</td>
                </tr>
              @endif
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

    <script src="{{url('dist/js/jquery-1.8.2.min.js')}}" type="text/javascript" charset="utf8"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            window.print();
            setTimeout(window.close, 0);
        })
    </script>
</html>