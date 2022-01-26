<table class="osxtable form" border="0" width="100%">
  <tr>
    <td valign="top" width="30%">
      <table>
        <tr>
          <td style="font-weight:bold">:: Data Anggota ::</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Rekening</td>
          <td>:</td>
          <td>01.71.000001.01</td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td>Faudji</td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td>Jl. Terusan Batu Bara II/15 Malang</td>
        </tr>
        <tr>
          <td>Golongan Kredit</td>
          <td>:</td>
          <td>71 - Pinjaman Angsuran</td>
        </tr>
        <tr>
          <td>Tujuan Pembukaan</td>
          <td>:</td>
          <td>Kredit Kepemilikan Rumah</td>
        </tr>
        <tr>
          <td>Ahli Waris</td>
          <td>:</td>
          <td>Agus</td>
        </tr>
        <tr>
          <td>Tgl Realisasi</td>
          <td>:</td>
          <td>20-01-2022</td>
        </tr>
        <tr>
          <td>Plafond</td>
          <td>:</td>
          <td>Rp. 150.000.000,-</td>
        </tr>
        <tr>
          <td>SukuBunga/Tahun</td>
          <td>:</td>
          <td>12 %</td>
        </tr>
        <tr>
          <td>Jangka Waktu</td>
          <td>:</td>
          <td>12 Bulan</td>
        </tr>
        <tr>
          <td>Angsuran Per Bulan</td>
          <td>:</td>
          <td>Rp. 1.200.000,-</td>
        </tr>

      </table>
    </td>
    <td width="50%">
      <table>
        <tr>
          <td colspan="5" style="font-weight: bold;">
            :: Data Angsuran ::
          </td>
        </tr>
        <tr style="font-weight: bold;">
          <td>No.</td>
          <td align="center" width="200px">Keterangan</td>
          <td align="center" width="120px">Angsuran Pokok</td>
          <td align="center" width="120px">Angsuran Bunga</td>
          <td align="center" width="150px">Total Angsuran</td>
        </tr>
        <?php
          for($i=1;$i<=24;$i++){
            echo('
              <tr>
                <td>'.$i.'</td>
                <td>Angsuran ke '.$i.'</td>
                <td align="right">1.000.000</td>
                <td align="right">200.000</td>
                <td align="right">1.200.000</td>
              </tr>
            ');
          }
        ?>
      </table>
    </td>
  </tr>
  
</table>