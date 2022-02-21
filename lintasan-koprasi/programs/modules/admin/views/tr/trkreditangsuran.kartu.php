<table class="osxtable form" border="0" width="100%">
<tr>
    <td width="15%"><label for="tgl">Tgl Pencairan</label> </td>
    <td width="1%">:</td>
    <td> 
      <input style="width: 100px;" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>> 
    </td>
  </tr> 
  <tr>
    <td width="5%"><label for="sku">Rekening</label> </td>
    <td>:</td>
    <td>
      <div style="width:30%" class="input-group">
        <input type="text" id="rekening" name="rekening" class="form-control" placeholder="Rekening">
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
      <input disabled style="width:80%" type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" required> 
    </td> 
  </tr>
  <tr>
    <td><label for="telepon">Telepon</label> </td>
    <td width="1%">:</td>
    <td>
      <input disabled style="width:30%" type="text" id="telepon" name="telepon" class="form-control" placeholder="Nomor Telepon">
    </td>
  </tr>  
</table>

<table class="osxtable form" border="0" width="100%">
  <tr>
    <td width="15%"><label for="kpokok">Pokok</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="kpokok" name="kpokok" class="form-control number" placeholder="0">
    </td>
    <td><label for="nama">Tgl Realisasi</label> </td>
    <td width="1%">:</td>
    <td>
    <input disabled style="width: 100px;" type="text" class="form-control date" id="tgl_realisasi" name="tgl_realisasi" value=<?=date("d-m-Y")?> <?=date_set()?>> 
    </td>
  </tr>
  <tr>
    <td width="15%"><label for="kpokok">Bunga</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="kbunga" name="kbunga" class="form-control number" placeholder="0">
    </td>
    <td><label for="nama">Jangka Waktu</label> </td>
    <td width="1%">:</td>
    <td>
    <input disabled style="width: 100px;" type="text" class="form-control" id="lama" name="lama" placeholder="0 Bulan"> 
    </td> 
  </tr> 
  <tr>
    <td><label for="alamat">Denda</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="denda" name="denda" class="form-control number" placeholder="0">
    </td>
    <td><label for="nama">Jatuh Tempo</label> </td>
    <td width="1%">:</td>
    <td>
    <input disabled style="width: 100px;" type="text" class="form-control date" id="jthtmp" name="jthtmp" value=<?=date("d-m-Y")?> <?=date_set()?>> 
    </td> 
  </tr>
  <tr>
    <td><label for="telepon">Setor Titipan</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="dtitipan" name="dtitipan" class="form-control number" placeholder="0">
    </td>
    <td><label for="nama">Baki Debet Awal</label> </td>
    <td width="1%">:</td>
    <td>
      <input disabled style="width:90%" type="text" id="bakidebet_awal" name="bakidebet_awal" class="form-control number" placeholder="0">
    </td>  
  </tr> 
  <tr>
    <td><label for="rekening">Penarikan Titipan</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="ktitipan" name="ktitipan" class="form-control number" placeholder="0">
    </td>
    <td><label for="nama">Tunggakan Pokok</label> </td>
    <td width="1%">:</td>
    <td>
      <input disabled style="width:90%" type="text" id="tpokok" name="tpokok" class="form-control number" placeholder="0">
    </td>
  </tr>
  <tr>
    <td><label for="telepon">Kelebihan</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="width:90%" type="text" id="kelebihan" name="kelebihan" class="form-control number" placeholder="0">
    </td>
    <td><label for="nama">Tunggakan Bunga</label> </td>
    <td width="1%">:</td>
    <td>
      <input disabled style="width:90%" type="text" id="tbunga" name="tbunga" class="form-control number" placeholder="0">
    </td>
  </tr>
  <tr>
    <td><label for="telepon">Total Angsuran</label> </td>
    <td width="1%">:</td>
    <td> 
      <input style="width:90%" type="text" id="total_angsuran" name="total_angsuran" class="form-control number" placeholder="0">
    </td>
    <td><label for="nama">Tunggakan Denda</label> </td>
    <td width="1%">:</td>
    <td> 
      <input disabled style="width:90%" type="text" id="materai" name="materai" class="form-control number" placeholder="0">
    </td>
  </tr> 
  <tr>
    <td><label for="nama">Keterangan</label> </td>
    <td width="1%">:</td>
    <td colspan="5px">
      <input style="width:96%" type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" required>
    </td>
  </tr> 
  

</table>