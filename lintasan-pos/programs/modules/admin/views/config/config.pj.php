<table class="osxtable form">
    <tr>
        <td width='150px'><label for="pjgudang">Gudang Penjualan</label> </td>
        <td width='5px'>:</td>
        <td>
            <select name="pjgudang" id="pjgudang" class="form-control select" style="width:100%"
                    data-placeholder="Gudang Penjualan">
                <option value="<?= $pjgudang ?>" selected='selected'><?= $pjgudang ?> - <?= $ketpjgudang ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td width='150px'><label for="rekpjpiutang">Rek. Piutang PJ</label> </td>
        <td width='5px'>:</td>
        <td>
            <select name="rekpjpiutang" id="rekpjpiutang" class="form-control select" style="width:100%"
                    data-placeholder="Rek. Piutang Penjualan">
                <option value="<?= $rekpjpiutang ?>" selected='selected'><?= $rekpjpiutang ?> - <?= $ketrekpjpiutang ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td width='150px'><label for="rekpjppn">Rek. PPn PJ</label> </td>
        <td width='5px'>:</td>
        <td>
            <select name="rekpjppn" id="rekpjppn" class="form-control select rekakt" style="width:100%"
                    data-placeholder="Rek. PPn Pembelian">
                <option value="<?= $rekpjppn ?>" selected='selected'><?= $rekpjppn ?> - <?= $ketrekpjppn ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td width='150px'><label for="rekpjpiutangdisc">Rek. Disc Piutang PJ</label> </td>
        <td width='5px'>:</td>
        <td>
            <select name="rekpjpiutangdisc" id="rekpjpiutangdisc" class="form-control select" style="width:100%"
                    data-placeholder="Rek. Disc Piutang Penjualan">
                <option value="<?= $rekpjpiutangdisc ?>" selected='selected'><?= $rekpjpiutangdisc ?> - <?= $ketrekpjpiutangdisc ?></option>
            </select>
        </td>
    </tr>

    <tr>
        <td width='150px'><label for="rekpjpiutangpembulatan">Rek. Pembulatan Piutang PJ</label> </td>
        <td width='5px'>:</td>
        <td>
            <select name="rekpjpiutangpembulatan" id="rekpjpiutangpembulatan" class="form-control select" style="width:100%"
                    data-placeholder="Rek. Disc Piutang Penjualan">
                <option value="<?= $rekpjpiutangpembulatan ?>" selected='selected'><?= $rekpjpiutangpembulatan ?> - <?= $ketrekpjpiutangpembulatan ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td width='150px'><label for="rekpjuangmuka">Rek. Uang Muka PJ</label> </td>
        <td width='5px'>:</td>
        <td>
            <select name="rekpjuangmuka" id="rekpjuangmuka" class="form-control select rekakt" style="width:100%"
                    data-placeholder="Rek. Uang Muka Penjualan">
                <option value="<?= $rekpjuangmuka ?>" selected='selected'><?= $rekpjuangmuka ?> - <?= $ketrekpjuangmuka ?></option>
            </select>
        </td>
    </tr>
</table>