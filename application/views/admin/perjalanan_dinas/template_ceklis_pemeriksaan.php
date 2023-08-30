<html>
<style>
    body{
        font-size: 14px;
    }
    .judul {
        text-align: center;
        margin-bottom: 10px;
    }

    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 30px;
        margin-bottom: 8px;
        cursor: pointer;
        font-size: 14px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #fff;
        border: solid 1px #222;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input~.checkmark {
        background-color: #fff;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked~.checkmark {
        background-color: #fff;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
        left: 6px;
        top: 2px;
        width: 5px;
        height: 10px;
        border: solid #222;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    table.titimangsa {
        border-collapse: collapse;
        width: 100%;
        table-layout: fixed;
    }

    
    th,
    td {
        font-size: 14px;
        word-wrap: break-word;
    }


</style>

<body>
    <div class="judul">
        <h3>CEKLIS PEMERIKSAAN KELENGKAPAN AJUAN SPJ<br>KEGIATAN PERJALANAN DINAS</h3>
    </div>
    <table>
        <tr>
            <td>Bagian</td>
            <td>:</td>
            <td><?= $detail->nama_unit_kerja ?></td>
        </tr>
        <tr>
            <td>Sub Bagian</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>PA. Sub Bagian</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Kegiatan</td>
            <td>:</td>
            <td><?= $detail->deskripsi_kegiatan ?></td>
        </tr>
        <tr>
            <td>Tgl. Terima SPJ</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Tgl. Verifikasi SPJ</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Yang di Periksa</td>
            <td>:</td>
            <td></td>
        </tr>
    </table>
    <table>
        <?php
        foreach ($ref_file as $r) {
            $cek = $this->perjalanan_dinas_model->get_file_by_name($r->label, $detail->id_perjalanan_dinas);
            $checked = '';
            if($cek){
                if($cek->status_verifikasi=='sudah_diverifikasi'){
                    $checked = ' checked';
                }
            }
        ?>
            <tr>
                <td><input type="checkbox" <?= $checked?>></td>
                <td style="padding-left: 22.5px;"><?= $r->label ?></td>
            </tr>
        <?php } ?>
        <?php
        foreach ($pembiayaan as $k => $p) {
            $nama_peg = !empty($p->id_pegawai) ? $p->nama_lengkap : $p->nama_pegawai;
            $cek_fi = $this->perjalanan_dinas_model->get_file_by_name("Fakta Integritas $nama_peg", $detail->id_perjalanan_dinas);
            $cek_st = $this->perjalanan_dinas_model->get_file_by_name("Surat Perintah $nama_peg", $detail->id_perjalanan_dinas);
        ?>
            <tr>
                <td><input type="checkbox" <?= $cek_fi ? 'checked' : null ?>></td>
                <td style="padding-left: 22.5px;">Fakta Integritas <?= $nama_peg ?></td>
            </tr>
            <tr>
                <td><input type="checkbox" <?= $cek_st ? 'checked' : null ?>></td>
                <td style="padding-left: 22.5px;">Surat Perintah <?= $nama_peg ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td><input type="checkbox"></td>
            <td style="padding-left: 22.5px;">Eviden yang sesuai dengan Ajuan</td>
        </tr>

        <?php
        foreach ($file as $f) {
            foreach ($ref_file as $r) {
                if ($f->nama_file == $r->label) {
                    continue (2);
                }
            }

            foreach ($pembiayaan as $k => $p) {
                $nama_peg = !empty($p->id_pegawai) ? $p->nama_lengkap : $p->nama_pegawai;
                if ($f->nama_file == "Fakta Integritas $nama_peg") {
                    continue (2);
                }
                if ($f->nama_file == "Surat Perintah $nama_peg") {
                    continue (2);
                }
            }
        ?>
            <tr>
                <td>&nbsp;</td>
                <td style="padding-left: 22.5px;"><input type="checkbox" style="margin-top:5px" checked /> <?= $f->nama_file ?></td>
            </tr>
        <?php } ?>
    </table>
    <table class="titimangsa" style="margin-top: 35px;">
        <tr>
            <td style="text-align: center;">
                Kepala Sub Bagian TU Pimpinan<br><br><br><br><br><br>
                <span style="text-decoration: underline;font-weight: bold;font-size:14px"><?= $kabag->nama_lengkap ?></span><br>
                <span>NIP. <?= $kabag->nip ?></span>
            </td>
            <td style="text-align: center;">
                BPP,<br><br><br><br><br><br>
                <span style="text-decoration: underline;font-weight: bold;font-size:14px"><?= $bpp->nama_lengkap ?></span><br>
                <span>NIP. <?= $bpp->nip ?></span>
            </td>
            <td style="text-align: center;">
                PA.<br><br><br><br><br><br>
                <span style="text-decoration: underline;font-weight: bold;font-size:14px"><?= $kabag->nama_lengkap ?></span><br>
                <span>NIP. <?= $kabag->nip ?></span>
            </td>
        </tr>
        <tr>
        <td style="padding-top:20px;text-align:center" colspan="3">
                Mengetahui,<br>Kepala Bagian Umum<br><br><br><br><br><br>
                <span style="text-decoration: underline;font-weight: bold;font-size:14px"><?= $kabag->nama_lengkap ?></span><br>
                <span>NIP. <?= $kabag->nip ?></span>
            </td>
        </tr>
    </table>
</body>

</html>