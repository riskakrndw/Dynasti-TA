<html>
    <body>

        <style type="text/css">
          .row{
            background-color: #ff851b;
            -webkit-print-color-adjust: exact;
          }
        </style>

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

            <hr size="3px" style="width:95%;" />
        </center>

        <br>

        <table align="center" style="width:85%;border-collapse: collapse; margin-top:10px">
            <tr>
                <td style="font-size:25px;" align="center">Laporan Penjualan </td>
            </tr>
        </table>
        <table align="center" style="width:85%;border-collapse: collapse; margin-top:10px">
            <tr>
                <td style="font-size:15px;" align="center">Periode : {{date('d F Y',strtotime($tgl_a))}} - {{date('d F Y',strtotime($tgl_b))}}</td>
            </tr>
        </table>

        <br>

        <table align="center" style="width:100%;border-collapse: collapse; margin-top:10px; " id="dataTables-example" border="1">
            <thead>
                <tr style="font-size:18px; height:50px;">
                    <th class = "row" style="width: 50px; background-color:#bdc3c7;">No</th>
                    <th class = "row" style="width: 130px; background-color:#bdc3c7;">Kode</th>
                    <th class = "row" style="width: 120px; background-color:#bdc3c7;">Tanggal</th>
                    <th class = "row" style="width: 180px; background-color:#bdc3c7;" colspan="4">Daftar Ice Cream</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($data as $q=>$v)
                    <tr>
                        <td align="center" rowspan="{{ count($v->detail_jual)+1 }}">{{ $q+1 }}</td>
                        <td rowspan="{{ count($v->detail_jual)+1 }}">{{$v->kode_penjualan}}</td>
                        <td align="center" rowspan="{{ count($v->detail_jual)+1 }}">{{$v->tgl}}</td>
                        <th class = "row" style="width: 180px; background-color:#ecf0f1;">Nama</th>
                        <th class = "row" style="width: 110px; background-color:#ecf0f1;">Harga</th>
                        <th class = "row" style="width: 60px; background-color:#ecf0f1;">Jumlah</th>
                        <th class = "row" style="width: 120px; background-color:#ecf0f1;">Subtotal</th>
                    </tr>
                    @foreach($v->detail_jual as $x)
                        <tr>
                            <td>{{$x->ice_cream->nama}}</td>
                            <td align="center">Rp {{ number_format($x->ice_cream->jenis->harga,2,",","." ) }}</td>
                            <td align="center">{{$x->jumlah}}</td>
                            <td align="center">Rp {{ number_format($x->subtotal,2,",","." ) }}</td>
                        </tr>
                    @endforeach
                @endforeach
                <tr style="font-size:18px; height:30px;">
                    <td align="center" colspan="6">Total</td>
                    <td>Rp {{ number_format($totalpenjualan,2,",","." ) }}</td>
                </tr>
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