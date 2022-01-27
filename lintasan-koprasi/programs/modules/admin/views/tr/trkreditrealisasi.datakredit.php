<table class="osxtable form" border="0" width="100%">
<tr>
    <td width="15%"><label for="tgl">Tgl Realisasi</label> </td>
    <td width="1%">:</td>
    <td> 
      <input style="width: 100px;" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>> 
    </td>
  </tr>
  <tr>
    <td width="5%"><label for="sku">Kode Anggota</label> </td>
    <td>:</td>
    <td>
      <div style="width:30%" class="input-group">
        <input type="text" id="kode_anggota" name="kode_anggota" class="form-control" placeholder="Kode Anggota">
        <span class="input-group-btn">
          <button class="form-control btn btn-info" type="button" id="cmdanggota"><i class="fa fa-search"></i></button>
        </span> 
      </div>              
    </td>    
  </tr>
  <tr>
    <td><label for="nama">Nama</label> </td>
    <td width="1%">:</td>
    <td>
      <input disabled style="width:50%" type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required>
    </td>
  </tr>
  <tr>
    <td><label for="alamat">Alamat</label> </td>
    <td width="1%">:</td>
    <td>
      <input disabled style="width:50%" type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" required>
    </td> 
  </tr>
  <tr>
    <td><label for="telepon">Telepon</label> </td>
    <td width="1%">:</td>
    <td>
      <input disabled style="width:30%" type="text" id="telepon" name="telepon" class="form-control" placeholder="Nomor Telepon" required>
    </td>
  </tr>  
</table>

<table class="osxtable form" border="0" width="100%">
  <tr>
    <td width="15%"><label for="no_spk">No SPK</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="no_spk" name="no_spk" class="form-control" placeholder="No SPK" required>
    </td>
    <td><label for="nama">Biaya Administrasi</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="administrasi" name="administrasi" class="form-control number" placeholder="0" required>
    </td> 
  </tr>
  <tr>
    <td><label for="rekening">Golongan Kredit</label> </td>
    <td width="1%">:</td>
    <td>
    <select name="golongan_kredit" id="golongan_kredit" class="form-control select" style="width:90%" data-sf="load_kredit_golongan" data-placeholder="Golongan Kredit" required></select>
    </td>
    <td><label for="nama">Biaya Provisi</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="provisi" name="provisi" class="form-control number" placeholder="0" required>
    </td>
  </tr> 
  <tr>
    <td><label for="alamat">Plafond</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="plafond" name="plafond" class="form-control number" placeholder="Plafond" required>
    </td> 
    <td><label for="nama">Biaya Materai</label> </td>
    <td width="1%">:</td>
    <td> 
      <input style="width:90%" type="text" id="materai" name="materai" class="form-control number" placeholder="0" required>
    </td>
  </tr>
  <tr>
    <td><label for="telepon">SukuBunga</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="sukubunga" name="sukubunga" class="form-control number" placeholder="% per tahun" required>
    </td>
    <td><label for="rekening">AO</label> </td>
    <td width="1%">:</td>
    <td>
    <select name="ao" id="ao" class="form-control select" style="width:90%" data-sf="load_kredit_golongan" data-placeholder="AO" required></select>
    </td>
  </tr> 
  <tr>
    <td><label for="rekening">Jangka Waktu</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="lama" name="lama" class="form-control number" placeholder="Berapa Bulan" required>
    </td>
    <td><label for="nama">Tujuan Pembukaan</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="tujuan_pembukaan" name="tujuan_pembukaan" class="form-control" placeholder="Tujuan Pembukaan" required>
    </td>
  </tr>
  <tr>
    <td colspan="3">
    <td><label for="nama">Ahli Waris</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="ahli_waris" name="ahli_waris" class="form-control" placeholder="Ahli Waris" required>
    </td>
  </tr>
</table>