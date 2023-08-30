<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/sankey.js"></script>
<script src="https://code.highcharts.com/modules/organization.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<style>
  .highcharts-container {
    width: 100%;
}
.highcharts-container svg {
    width: 100%;
    display: flex;
}
#container {
    min-width: 300px;
    overflow: scroll !important;
}
</style>
<figure class="highcharts-figure">
  <div id="container" style="height:100%;width:100%;margin: 0 auto"></div>
</figure>
<script>

    let url = '<?=base_url('simanja/analisis_jabatan/fetch_peta_jabatan/'.$id)?>'
    var normal = []
    var nested = []

    fetch(url)
    .then(response => response.json())
    .then(data => {
        data.forEach((x,i) => {
            if(x.eselon_jabatan == null || x.eselon_jabatan == undefined){
                x.eselon_jabatan == 0;
            }
            normal.push({
                id: x.id,
                name: x.nama,
                pid: x.id_induk_jabatan,
                tags: [x.jenis_jabatan],
                jumlah_kebutuhan_pegawai: x.jumlah_kebutuhan_pegawai,
                jumlah_pemangku: x.jumlah_pemangku,
                kondisi_saat_ini: x.jumlah_pemangku - x.jumlah_kebutuhan_pegawai,
                one_line: x.nama+'('+x.jenis_pegawai+')',
                real_kelas: x.kelas,
                golongan_pendidikan: x.eselon_jabatan
            })
            if(x.id_induk_jabatan > 0){
              nested.push([
                x.id_induk_jabatan, x.id
              ])
            }
          })

          console.log(nested)
          console.log(normal)

          Highcharts.chart('container', {
          chart: {
            height: 2000,
            width: 50000,
            inverted: true
          },

          title: {
            text: 'Peta Jabatan <br> <?=$detail->nama_skpd?>'
          },

          accessibility: {
            point: {
              descriptionFormatter: function (point) {
                var nodeName = point.toNode.name,
                  nodeId = point.toNode.id,
                  nodeDesc = nodeName === nodeId ? nodeName : nodeName + ', ' + nodeId,
                  parentDesc = point.fromNode.id;
                return point.index + '. ' + nodeDesc + ', reports to ' + parentDesc + '.';
              }
            }
          },

          series: [{
            type: 'organization',
            name: '<?=$detail->nama_skpd?>',
            keys: ['from', 'to'],
            data: nested,
            levels: [{
              level: 0,
              color: 'silver',
              dataLabels: {
                nodeFormatter: function () {
                  let html = Highcharts.defaultOptions
                    .plotOptions
                    .organization
                    .dataLabels
                    .nodeFormatter
                    .call(this);

                  html = html.replace(
                    '<h4 style="',
                    '<p style="font-size: 13px; position: absolute; top: 0;',
                    );
                    return html;
                }
              },
              height: 25
            }, {
              level: 1,
              color: 'silver',
              dataLabels: {
                color: 'black'
              },
              height: 25
            }, {
              level: 2,
              color: '#980104'
            }, {
              level: 4,
              color: '#359154'
            }],
            nodes: normal,
            colorByPoint: false,
            color: '#007ad0',
            dataLabels: {
              color: 'white'
            },
            borderColor: 'white',
            height: 100,
            width: 300            
          }],
          tooltip: {
            outside: true
          },
          exporting: {
            allowHTML: true,
            sourceWidth: 2000,
            sourceHeight: 50000
          }

        });
      }
    );



</script>