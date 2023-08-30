<!DOCTYPE html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="google-site-verification" content="jEA0Cf2WjPZDWVJmyTGoKFqSP04LwhsA9CC-f13iB-E" />
<meta name="description" content="Neon Admin Panel" />
<meta name="author" content="" />
<title><?php echo $title; ?></title>

<link href="<?php echo base_url() . "asset/pixel/inverse/"; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url() . "asset/pixel/plugins/bower_components/datatables/"; ?>jquery.dataTables.min.css">

<!-- Custom CSS -->
<link href="<?php echo base_url() . "asset/pixel/inverse/"; ?>css/style.css?v=2.2" rel="stylesheet">
<!-- color CSS -->
<link href="<?php echo base_url() . "asset/pixel/inverse/"; ?>css/colors/default.css" id="theme" rel="stylesheet">

<link rel="icon" type="image/png" href="<?php echo base_url() . 'data/logo/e.png'; ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
<!-- jQuery -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>

<style>
    @page {
        /* dimensions for the whole page */
        size: A5;

        margin: 0;
        padding: 0;
    }


    html {
        /* off-white, so body edge is visible in browser */
        background: #eee;
    }

    body {
        /* A5 dimensions */
        height: 210mm;
        width: 148.5mm;
        margin: 0;
        font-family: sans-serif;
        font-size: 12px;
    }

    .table {
        font-size: 12px;
        width: 100%;
    }

    .table-border td {
        border: 1px solid #000000;
        border-collapse: collapse;
    }

    .fw-bold {
        font-weight: bold;
    }
</style>

</head>
<body style="background-color: #f4f6f8" class="A5">

<div class="container-fluid">
    <table class="table" border="0">
        <tr>
            <td align="center" style="border-top: 0px; font-weight: bold; padding-bottom: 0px">
                <p style="margin-bottom: 0px;">PEMERINTAH DAERAH KABUPATEN SUMEDANG</p>
                <p style="margin-top: 0px; margin-bottom: 0px;"><?= strtoupper($kendali->skpd->nama_skpd); ?></p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; border-top: 0; font-weight: bold; padding-bottom: 0; padding-top: 10px; text-transform: uppercase; text-decoration: underline;">
                KARTU KENDALI <?= strtoupper($kendali->tipe_kendali); ?>
            </td>
        </tr>
    </table>
    <table class="table table-border" cellpadding="5" cellspacing="5">
        <tr>
            <td width="33%" style="border-top: 1px solid #000">
                <label class="fw-bold">Indeks :</label>
                <p><?= $kendali->indeks; ?></p>
            </td>
            <td width="33%" style="border-top: 1px solid #000">
                <label class="fw-bold">Kode Klasifikasi :</label>
                <p><?= $kendali->klasifikasi->kode_gabungan; ?></p>
            </td>
            <td width="33%" style="border-top: 1px solid #000">
                <label class="fw-bold">No. Urut :</label>
                <p><?= $kendali->nomor_urut; ?></p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <label class="fw-bold">Perihal :</label>
                <p><?= $kendali->surat->perihal; ?></p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <label class="fw-bold">Isi Ringkasan :</label>
                <p><?= $kendali->isi_ringkasan; ?></p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <label class="fw-bold">Dari :</label>
                <p>
                    <?= $receivers[0]->name; ?>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <label class="fw-bold">Tgl. Surat :</label>
                <p><?= tanggal($kendali->surat->tanggal_surat); ?></p>
            </td>
            <td>
                <label class="fw-bold">No. Surat :</label>
                <p><?= $kendali->surat->nomer_surat; ?></p>
            </td>
            <td>
                <label class="fw-bold">Lampiran : </label>
                <p><?= $kendali->surat->lampiran; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <label class="fw-bold">Pengolah :</label>
                <p><?= (!empty($kendali->pengolah)) ? $kendali->pengolah : ""; ?></p>
            </td>
            <td>
                <label class="fw-bold">Tgl. Diteruskan :</label>
                <p>
                    <?= (isset($tgl_diteruskan)) ? $tgl_diteruskan : " "; ?>
                </p>
            </td>
            <td>
                <label class="fw-bold">Tanda Terima : </label>
                <p><?= (isset($tandaterima)) ? $tandaterima : ""; ?></p>
            </td>
        </tr>
        <tr>
            <td colspan="3" rowspan="3">
                <label class="fw-bold">Catatan :</label>
                <p><?= (!empty($kendali->catatan)) ? $kendali->catatan : "" ; ?></p>
            </td>
        </tr>
    </table>
</div>

<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/calendar/jquery-ui.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>