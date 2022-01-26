<table class="osxtable form" border="0" width="100%">
  <tr>
    <td width="15%"><label for="tgl">Tgl</label> </td>
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
      <input disabled type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required>
    </td>
  </tr>
  <tr>
    <td><label for="alamat">Alamat</label> </td>
    <td width="1%">:</td>
    <td>
      <input disabled type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" required>
    </td> 
  </tr>
  <tr>
    <td><label for="telepon">Telepon</label> </td>
    <td width="1%">:</td>
    <td>
      <input disabled style="width:30%" type="text" id="telepon" name="telepon" class="form-control" placeholder="Nomor Telepon" required>
    </td>
  </tr> 
  <tr>
    <td><label for="rekening">Golongan Tabungan</label> </td>
    <td width="1%">:</td>
    <td>
    <select name="golongan_tabungan" id="golongan_tabungan" class="form-control select" style="width:20%" data-sf="load_tabungan_golongan" data-placeholder="Golongan Tabungan" required></select>
    </td>
  </tr> 
  <tr>
    <td><label for="nama">Tujuan Pembukaan</label> </td>
    <td width="1%">:</td>
    <td>
      <input type="text" id="tujuan_pembukaan" name="tujuan_pembukaan" class="form-control" placeholder="Tujuan Pembukaan" required>
    </td>
  </tr>
  <tr>
    <td><label for="nama">Ahli Waris</label> </td>
    <td width="1%">:</td>
    <td>
      <input type="text" id="ahli_waris" name="ahli_waris" class="form-control" placeholder="Ahli Waris" required>
    </td>
  </tr>
</table>