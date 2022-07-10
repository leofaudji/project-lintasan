<table class="osxtable form">
    <tr>
        <td width='150px'><label for="reklrthlalu">Rek. L/R Thn Lalu</label> </td>
        <td width='5px'>:</td>
        <td colspan = '3'>
            <select name="reklrthlalu" id="reklrthlalu" class="form-control select" style="width:100%"
                    data-placeholder="Rek. L/R Thn Lalu">
                <option value="<?= $reklrthlalu ?>" selected='selected'><?= $reklrthlalu ?> - <?= $ketreklrthlalu ?></option>
            </select>
        </td>
    </tr>

    <tr>
        <td width='150px'><label for="reklrthberjalan">Rek. L/R Tahun Berjalan</label> </td>
        <td width='5px'>:</td>
        <td colspan = '3'>
            <select name="reklrthberjalan" id="reklrthberjalan" class="form-control select" style="width:100%"
                    data-placeholder="Rek. L/R Thn Berjalan">
                <option value="<?= $reklrthberjalan ?>" selected='selected'><?= $reklrthberjalan ?> - <?= $ketreklrthberjalan ?></option>
            </select>
        </td>
    </tr>

    <tr>
        <td width='150px'><label for="reklrblnberjalan">Rek. L/R Bulan Berjalan</label> </td>
        <td width='5px'>:</td>
        <td colspan = '3'>
            <select name="reklrblnberjalan" id="reklrblnberjalan" class="form-control select rekakt" style="width:100%"
                    data-placeholder="Rek. L/R Bln Berjalan">
                <option value="<?= $reklrblnberjalan ?>" selected='selected'><?= $reklrblnberjalan ?> - <?= $ketreklrblnberjalan ?></option>
            </select>
        </td>
    </tr>

    <tr>
        <td width='150px'><label for="rekpendoprawal">Rek. Pend. Opr Awal</label> </td>
        <td width='5px'>:</td>
        <td>

            <select name="rekpendoprawal" id="rekpendoprawal" class="form-control select" style="width:100%;"
                    data-placeholder="Rek. Pend Opr Awal">
                <option value="<?= $rekpendoprawal ?>" selected='selected'><?= $rekpendoprawal ?> - <?= $ketrekpendoprawal ?></option>
            </select>
        </td>
        <td width='5px'>sd</td>
        <td>
            <select name="rekpendoprakhir" id="rekpendoprakhir" class="form-control select" style="width:100%;"
                    data-placeholder="Rek. Pend Opr Akhir">
                <option value="<?= $rekpendoprakhir ?>" selected='selected'><?= $rekpendoprakhir ?> - <?= $ketrekpendoprakhir ?></option>
            </select>
        </td>
    </tr>
    
    <tr>
        <td width='150px'><label for="rekhppawal">Rek. HPP Awal</label> </td>
        <td width='5px'>:</td>
        <td>

            <select name="rekhppawal" id="rekhppawal" class="form-control select rekakt" style="width:100%;"
                    data-placeholder="Rek. HPP Awal">
                <option value="<?= $rekhppawal ?>" selected='selected'><?= $rekhppawal ?> - <?= $ketrekhppawal ?></option>
            </select>
        </td>
        <td width='5px'>sd</td>
        <td>
            <select name="rekhppakhir" id="rekhppakhir" class="form-control select rekakt" style="width:100%;"
                    data-placeholder="Rek. HPP Akhir">
                <option value="<?= $rekhppakhir ?>" selected='selected'><?= $rekhppakhir ?> - <?= $ketrekhppakhir ?></option>
            </select>
        </td>
    </tr>

    <tr>
        <td width='150px'><label for="rekbyoprawal">Rek. By. Opr Awal</label> </td>
        <td width='5px'>:</td>
        <td>

            <select name="rekbyoprawal" id="rekbyoprawal" class="form-control select" style="width:100%;"
                    data-placeholder="Rek. By Opr Awal">
                <option value="<?= $rekbyoprawal ?>" selected='selected'><?= $rekbyoprawal ?> - <?= $ketrekbyoprawal ?></option>
            </select>
        </td>
        <td width='5px'>sd</td>
        <td>
            <select name="rekbyoprakhir" id="rekbyoprakhir" class="form-control select" style="width:100%;"
                    data-placeholder="Rek. By Opr Akhir">
                <option value="<?= $rekbyoprakhir ?>" selected='selected'><?= $rekbyoprakhir ?> - <?= $ketrekbyoprakhir ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td width='150px'><label for="rekpendnonoprawal">Rek. Pend. Non Opr Awal</label> </td>
        <td width='5px'>:</td>
        <td>

            <select name="rekpendnonoprawal" id="rekpendnonoprawal" class="form-control select" style="width:100%;"
                    data-placeholder="Rek. Pend Non Opr Awal">
                <option value="<?= $rekpendnonoprawal ?>" selected='selected'><?= $rekpendnonoprawal ?> - <?= $ketrekpendnonoprawal ?></option>
            </select>
        </td>
        <td width='5px'>sd</td>
        <td>
            <select name="rekpendnonoprakhir" id="rekpendnonoprakhir" class="form-control select" style="width:100%;"
                    data-placeholder="Rek. Pend Non Opr Akhir">
                <option value="<?= $rekpendnonoprakhir ?>" selected='selected'><?= $rekpendnonoprakhir ?> - <?= $ketrekpendnonoprakhir ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td width='150px'><label for="rekbynonoprawal">Rek. By. Non Opr Awal</label> </td>
        <td width='5px'>:</td>
        <td>

            <select name="rekbynonoprawal" id="rekbynonoprawal" class="form-control select" style="width:100%;"
                    data-placeholder="Rek. By Opr Awal">
                <option value="<?= $rekbynonoprawal ?>" selected='selected'><?= $rekbynonoprawal ?> - <?= $ketrekbynonoprawal ?></option>
            </select>
        </td>
        <td width='5px'>sd</td>
        <td>
            <select name="rekbynonoprakhir" id="rekbynonoprakhir" class="form-control select" style="width:100%;"
                    data-placeholder="Rek. By Non Opr Akhir">
                <option value="<?= $rekbynonoprakhir ?>" selected='selected'><?= $rekbynonoprakhir ?> - <?= $ketrekbynonoprakhir ?></option>
            </select>
        </td>
    </tr>    
    <tr>
        <td width='150px'><label for="rekpajakawal">Rek. Pajak Awal</label> </td>
        <td width='5px'>:</td>
        <td>

            <select name="rekpajakawal" id="rekpajakawal" class="form-control select" style="width:100%;"
                    data-placeholder="Rek. Pajak Awal">
                <option value="<?= $rekpajakawal ?>" selected='selected'><?= $rekpajakawal ?> - <?= $ketrekpajakawal ?></option>
            </select>
            </td>
        <td width='5px'>sd</td>
        <td>
            <select name="rekpajakakhir" id="rekpajakakhir" class="form-control select" style="width:100%;"
                    data-placeholder="Rek. Pajak Akhir">
                <option value="<?= $rekpajakakhir ?>" selected='selected'><?= $rekpajakakhir ?> - <?= $ketrekpajakakhir ?></option>
            </select>
        </td>
    </tr>

    <tr>
        <td width='150px'><label for="rekselisih">Rek. Selisih</label> </td>
        <td width='5px'>:</td>
        <td colspan = '3'>

            <select name="rekselisih" id="rekselisih" class="form-control select" style="width:100%;"
                    data-placeholder="Rek. Slisih">
                <option value="<?= $rekselisih ?>" selected='selected'><?= $rekselisih ?> - <?= $ketrekselisih ?></option>
            </select>
            </td>
    </tr>
    <tr>
        <td width='150px'><label for="rekselisihopname">Rek. Selisih Opnam Stock</label> </td>
        <td width='5px'>:</td>
        <td colspan = '3'>
            <select name="rekselisihopname" id="rekselisihopname" class="form-control select rekakt" style="width:100%"
                    data-placeholder="Rek. Selisih Opname Stock">
                <option value="<?= $rekselisihopname ?>" selected='selected'><?= $rekselisihopname ?> - <?= $ketrekselisihopname ?></option>
            </select>
        </td>
    </tr>
</table>