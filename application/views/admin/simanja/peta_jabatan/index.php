<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Jabatan - <?=$detail->nama_skpd?></title>
    <script src="<?=base_url('asset/balkanOrgChartJS/orgchart.js')?>"></script>
</head>

<body>
    <div style="text-align: center;margin: 50px auto">PETA JABATAN DILINGKUNGAN UNIT KERJA <br>
        <b><?=$detail->nama_skpd?></b>
    </div>
    <div style="width:100%; height:800px;" id="tree">
        <script>
        let url = '<?=base_url('simanja/analisis_jabatan/fetch_peta_jabatan/'.$id)?>'
        let normal = []

        fetch(url)
            .then(response => response.json())
            .then(data => {
                data.forEach((x, i) => {
                    if (x.eselon_jabatan == null || x.eselon_jabatan == undefined) {
                        x.eselon_jabatan == 0;
                    }
                    normal.push({
                        id: x.id,
                        name: x.nama,
                        pid: x.id_induk_jabatan,
                        tags: [x.jenis_jabatan],
                        test: 1,
                        test1: 2,
                        kelas: 1,
                        jumlah_kebutuhan_pegawai: x.jumlah_kebutuhan_pegawai,
                        jumlah_pemangku: x.jumlah_pemangku,
                        kondisi_saat_ini: x.jumlah_pemangku - x.jumlah_kebutuhan_pegawai,
                        one_line: x.nama + '(' + x.jenis_pegawai + ')',
                        real_kelas: x.kelas,
                        golongan_pendidikan: x.eselon_jabatan
                    })
                })


                OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.olivia);
                OrgChart.templates.myTemplate.size = [500, 100];
                OrgChart.templates.myTemplate.field_0 =
                    '<text data-width="230" data-text-overflow="multiline" style="font-size: 16px;" fill="#F88917" x="300" y="30" text-anchor="middle">Kelas</text>';
                OrgChart.templates.myTemplate.field_5 =
                    '<text data-width="230" data-text-overflow="multiline" style="font-size: 16px;" fill="#757575" x="300" y="60" text-anchor="middle">{val}</text>';
                OrgChart.templates.myTemplate.field_1 =
                    '<text data-width="230" data-text-overflow="multiline" style="font-size: 16px;" fill="#757575" x="125" y="30" text-anchor="middle">{val}</text>';
                OrgChart.templates.myTemplate.field_2 =
                    '<text data-width="230" data-text-overflow="multiline" style="font-size: 16px;" fill="#900603" x="350" y="30" text-anchor="middle">B</text>';
                OrgChart.templates.myTemplate.field_6 =
                    '<text data-width="230" data-text-overflow="multiline" style="font-size: 16px;" fill="#757575" x="350" y="60" text-anchor="middle">{val}</text>';
                OrgChart.templates.myTemplate.field_3 =
                    '<text data-width="230" data-text-overflow="multiline" style="font-size: 16px;" fill="#354A21" x="400" y="30" text-anchor="middle">K</text>';
                OrgChart.templates.myTemplate.field_7 =
                    '<text data-width="230" data-text-overflow="multiline" style="font-size: 16px;" fill="#757575" x="400" y="60" text-anchor="middle">{val}</text>';
                OrgChart.templates.myTemplate.field_4 =
                    '<text data-width="230" data-text-overflow="multiline" style="font-size: 16px;" fill="#OBOB45" x="450" y="30" text-anchor="middle">+/-</text>';
                OrgChart.templates.myTemplate.field_8 =
                    '<text data-width="230" data-text-overflow="multiline" style="font-size: 16px;" fill="#757575" x="450" y="60" text-anchor="middle">{val}</text>';

                OrgChart.templates.ula = Object.assign({}, OrgChart.templates.ana);
                OrgChart.templates.ula.size = [500, 150];
                OrgChart.templates.ula.field_9 =
                    '<text data-width="400" data-text-overflow="multiline" style="font-size: 16px;" fill="#000000" x="250" y="30" text-anchor="middle">{val}</text>';
                OrgChart.templates.ula.field_5 =
                    '<text data-width="500" data-text-overflow="multiline" style="font-size: 16px;" fill="#afafaf" x="250" y="70" text-anchor="middle">{val} Kelas</text>';
                OrgChart.templates.ula.field_11 =
                    '<text data-width="500" data-text-overflow="multiline" style="font-size: 16px;" fill="#afafaf" x="250" y="100" text-anchor="middle">{val} Eselon</text>';
                OrgChart.templates.ula.node =
                    '<rect x="0" y="0" height="{h}" width="{w}" fill="#ffffff" stroke-width="1" stroke="#aeaeae"></rect>' +
                    '<line x1="0" y1="0" x2="500" y2="0" stroke-width="2" stroke="#000000"></line>';


                function pdf(nodeId) {
                    chart.exportPDF({
                        format: "A4",
                        layout: "landscape",
                        header: 'PETA JABATAN - <?=$detail->nama_skpd?>'
                    });
                }

                OrgChart.MIXED_LAYOUT_ALL_NODES = false;


                var chart = new OrgChart(document.getElementById("tree"), {
                    mouseScrool: OrgChart.action.none,
                    // orientation: OrgChart.orientation.left,
                    layout: OrgChart.treeLeftOffset,
                    scaleInitial: 0.5,
                    template: "base",
                    menu: {
                        pdf: {
                            text: "Export PDF",
                            icon: OrgChart.icon.pdf(24, 24, "#7A7A7A"),
                            onClick: pdf
                        },
                        png: {
                            text: "Export PNG"
                        },
                        svg: {
                            text: "Export SVG"
                        },
                        csv: {
                            text: "Export CSV"
                        }
                    },
                    tags: {
                        "Struktural": {
                            template: "ula"
                        }
                    },
                    template: "myTemplate",
                    nodeBinding: {
                        field_0: "tags",
                        field_1: "name",
                        field_2: "id",
                        field_3: "test",
                        field_4: "test1",
                        field_5: "real_kelas",
                        field_6: "jumlah_pemangku",
                        field_7: "jumlah_kebutuhan_pegawai",
                        field_8: "kondisi_saat_ini",
                        field_9: "one_line",
                        field_11: "golongan_pendidikan",
                    },
                    nodes: normal
                });

                console.log(normal)

                chart.on('init', function() {
                    preview();
                })
                // chart.load(normal);

                function preview() {
                    console.log(chart);
                    OrgChart.pdfPrevUI.show(chart, {
                        format: 'A1',
                        layout: "landscape",
                        header: 'PETA JABATAN - <?=$detail->nama_skpd?>'
                    });
                }
            });
        </script>
</body>

</html>