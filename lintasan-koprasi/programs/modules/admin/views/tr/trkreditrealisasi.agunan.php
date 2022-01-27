<table class="osxtable form" border="0" width="100%">
  <tr>
    <td width="15%"><label for="rekening">Jenis Agunan</label> </td>
    <td width="1%">:</td>
    <td>
    <select name="jenis_agunan" id="jenis_agunan" class="form-control select" style="width:50%" data-sf="load_kredit_jenis_agunan" data-placeholder="Jenis Agunan" required></select>
    </td>
  </tr> 
  <tr>
    <td width="15%"><label for="rekening">Nilai Agunan</label> </td>
    <td width="1%">:</td>
    <td>
      <input style="font-size:12px; padding-right: 15px;width:50%" type="text" id="nilai_agunan" name="nilai_agunan" class="form-control number" placeholder="0" required>
    </td>
  </tr> 
  <tr>
    <td valign="top"><label for="nama">Data Agunan</label> </td>
    <td width="1%" valign="top">:</td>
    <td>
    </td>
  </tr> 
  <tr>
    <td colspan="3" valign="top">
      <textarea style="font-size:16px;padding:12px;" id="data_agunan" name="data_agunan" class="form-control" placeholder="Data Agunan" rows="10" required></textarea>
    </td> 
  </tr>
  <tr>
    <td colspan="3" align="right"> 
      <div class="" style="height:32px">  
        <input type="button" class="btn btn-info" id="cmdadd" onClick="bos.trkreditrealisasi.cmdadd()" value="Tambah">
      </div> 
    </td> 
  </tr>
  <tr>
    <td colspan="3" valign="top"> 
      <div id="data_agunan_tmp_header"></div> 
      <div id="data_agunan_tmp_data" style="height:250px"></div> 
    </td> 
  </tr>
</table>