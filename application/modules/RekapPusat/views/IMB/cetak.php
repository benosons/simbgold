<html>
<head>
  <title>Cetak PDF</title>
  <style>
    table {
      border-collapse:collapse;
      table-layout:fixed;width: 630px;
    }
    table td {
      word-wrap:break-word;
      width: 20%;
    }
  </style>
</head>
<body>
    <b><?php echo $ket; ?></b><br /><br />
    
  <table border="1" cellpadding="8">
  <tr>
    <th>Tanggal</th>
    <th>No. SK IMB</th>
    <th>Nama Pemilik</th>
    <th>Alamat Bangunan Gedung</th>
    <th>TotalRetribusi</th>
  </tr>
    <?php
    if( ! empty($retribusi)){
      $no = 1;
      foreach($retribusi as $data){
            $tgl = date('d-m-Y', strtotime($data->tgl));
        echo "<tr>";
        echo "<td></td>";
        echo "<td>".$data->id_permohonan."</td>";
        echo "<td>".$data->id_permohonan."</td>";
        echo "<td>".$data->id_permohonan."</td>";
        echo "<td>".$data->id_permohonan."</td>";
        echo "</tr>";
        $no++;
      }
    }
    ?>
  </table>
</body>
</html>