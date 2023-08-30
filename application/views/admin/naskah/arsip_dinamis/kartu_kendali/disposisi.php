<!DOCTYPE html>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                    <p style="margin-top: 0px; margin-bottom: 0px;"><?= strtoupper($skpd->nama_skpd); ?></p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; border-top: 0; font-weight: bold; padding-bottom: 0; padding-top: 10px; text-transform: uppercase; text-decoration: underline;">
                    KARTU DISPOSISI
                </td>
            </tr>
        </table>
        <table cellpadding="5" cellspacing="5">
            <tr>
                <td width="25%">
                    <label class="fw-bold">Dari</label>
                </td>
                <td width="5%">
                    <label>:</label>
                </td>
                <td width="">
                    <label><?= $surat->pengirim; ?></label>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <label class="fw-bold">Perihal</label>
                </td>
                <td width="5%">
                    <label>:</label>
                </td>
                <td width="">
                    <label><?= $surat->perihal; ?></label>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <label class="fw-bold">Tanggal Surat</label>
                </td>
                <td width="5%">
                    <label>:</label>
                </td>
                <td width="">
                    <label><?= tanggal($surat->tanggal_surat); ?></label>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <label class="fw-bold">No. Surat</label>
                </td>
                <td width="5%">
                    <label>:</label>
                </td>
                <td width="">
                    <label><?= $surat->nomer_surat; ?></label>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <label class="fw-bold">Tanggal Surat Masuk</label>
                </td>
                <td width="5%">
                    <label>:</label>
                </td>
                <td width="">
                    <label><?= tanggal($surat->tanggal_surat); ?></label>
                </td>
            </tr>
        </table><br/>
        <table class="table table-border">
            <thead>
            <tr>
                <th style="text-align: center; font-weight: bold; border: 1px solid #000;">No</th>
                <th style="text-align: center; font-weight: bold; border: 1px solid #000;">Tanggal</th>
                <th style="text-align: center; font-weight: bold; border: 1px solid #000;">Instruksi / Informasi</th>
                <th style="text-align: center; font-weight: bold; border: 1px solid #000;">Diteruskan Kepada</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1; foreach ($disposisi as $d) { ?>
                <tr>
                    <td width="5%" style="text-align: center; padding: 5px;"><?= $no++; ?></td>
                    <td width="15%" style="padding: 5px;"><?= (!empty($d->tgl_terima)) ? $d->tgl_terima : "-" ?></td>
                    <td width="40%" style="padding: 5px;"><?= $d->instruksi; ?></td>
                    <td width="40%" style="padding: 5px;"><?= $d->id_pegawai->nama_lengkap . " - " . $d->id_pegawai->id_jabatan->nama_jabatan; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/calendar/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>