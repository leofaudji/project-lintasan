<table class="osxtable form" border="0" width="100%">
  <tr>
    <td valign="top" width="50%">
      <table style="background:white;"> 
        <tr>
          <td colspan="3" style="text-align:center;font-weight:bold">:: Data Anggota ::</td>
        </tr>        
        <tr>
          <td>Rekening</td>
          <td>:</td>
          <td id="s_rekening"></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td id="s_nama">Faudji</td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td id="s_alamat"></td>
        </tr>
        <tr>
          <td>Golongan Kredit</td>
          <td>:</td>
          <td id="s_golongan_kredit"></td>
        </tr>
        <tr>
          <td>Tujuan Pembukaan</td>
          <td>:</td>
          <td id="s_tujuan_pembukaan"></td>
        </tr>
        <tr>
          <td>Ahli Waris</td>
          <td>:</td>
          <td id="s_ahli_waris"></td>
        </tr>
        <tr>
          <td>Tgl Realisasi</td>
          <td>:</td>
          <td id="s_tgl"></td>
        </tr>
        <tr>
          <td>Plafond</td>
          <td>:</td>
          <td id="s_plafond"></td>
        </tr>
        <tr>
          <td>SukuBunga</td>
          <td>:</td>
          <td id="s_sukubunga"></td>
        </tr>
        <tr>
          <td>Jangka Waktu</td>
          <td>:</td>
          <td id="s_lama"></td>
        </tr>
        <tr>
          <td>Tgl Jatuh Tempo</td>
          <td>:</td>
          <td id="s_tgl_jthtmp"></td>
        </tr>
        <tr>
          <td>Angsuran Per Bulan</td>
          <td>:</td>
          <td id="s_angsuran"></td> 
        </tr> 
      </table>

      <table style="background:white;"> 
        <tr> 
          <td colspan="4" style="text-align:center;font-weight:bold">:: Data Agunan ::</td>
        </tr>        
        <tr style="font-weight: bold;">
          <td>No.</td>
          <td align="center" width="200px">Jenis Agunan</td>
          <td align="center" width="120px">Nilai Agunan</td>
          <td align="center" width="120px">Keterangan</td>
        </tr>
        <?php
          for($i=1;$i<=3;$i++){
            echo('
              <tr>
                <td>'.$i.'</td>
                <td>05 - BPKB Kendaraaan Roda 2</td>
                <td align="right">Rp. 20.000.000,-</td>
                <td>-</td>
              </tr>
            ');
          }
        ?>
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