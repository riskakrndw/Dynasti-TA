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

            <hr size="3px" style="width:95%;" />
        </center>

        <br>

        <table align="center" style="width:85%;border-collapse: collapse; margin-top:10px">
            <tr>
                <td style="font-size:25px;" align="center">Laporan Produksi </td>
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
                    <th style="width: 50px;">No</th>
                    <th style="width: 130px">Kode</th>
                    <th style="width: 120px">Tanggal</th>
                    <th style="width: 180px" colspan="3">Daftar Ice Cream</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($data as $q=>$v)
                    <tr>
                        <td align="center" rowspan="{{ count($v->detail_produksi)+1 }}">{{ $q+1 }}</td>
                        <td rowspan="{{ count($v->detail_produksi)+1 }}">{{$v->kode_produksi}}</td>
                        <td align="center" rowspan="{{ count($v->detail_produksi)+1 }}">{{$v->tgl}}</td>
                        <th style="width: 190px">Nama</th>
                        <th style="width: 120px">Harga</th>
                        <th style="width: 80px">Jumlah</th>
                    </tr>
                    @foreach($v->detail_produksi as $x)
                        <tr>
                            <td>{{$x->ice_cream->nama}}</td>
                            <td align="center">Rp {{ number_format($x->ice_cream->jenis->harga,2,",","." ) }}</td>
                            <td align="center">{{$x->jumlah}}</td>
                        </tr>
                    @endforeach
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