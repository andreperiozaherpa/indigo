<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_pencapaian.xls");
?>
            <table class="table color-table dark-table table-hover">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Kode</th>
                  <th>Sasaran</th>
                  <th>Bobot</th>
                  <th>#</th>
                  <th>Kode</th>
                  <th>IKU</th>
                  <th>Bobot</th>
                  <th>Target</th>
                  <th>Satuan</th>
                  <th>Polarisasi</th>
                  <th>Realisasi</th>
                  <th>Capaian</th>
                  <th>Unit Kerja</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td rowspan="2">1</td>
                  <td rowspan="2">SS-1</td>
                  <td rowspan="2">Sasaran 1</td>
                  <td rowspan="2">25%</td>
                  <td>1</td>
                  <td>IKU-11</td>
                  <td>IKU 1-1</td>
                  <td>50%</td>
                  <td>4</td>
                  <td>Titik</td>
                  <td>Maximize</td>
                  <td>4</td>
                  <td>100%</td>
                  <td>Inspektorat</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>IKU-12</td>
                  <td>IKU 1-2</td>
                  <td>50%</td>
                  <td>4</td>
                  <td>Titik</td>
                  <td>Maximize</td>
                  <td>2</td>
                  <td>50%</td>
                  <td>Inspektorat</td>
                </tr>
                <tr>
                  <td rowspan="3">2</td>
                  <td rowspan="3">SS-2</td>
                  <td rowspan="3">Sasaran 2</td>
                  <td rowspan="3">20%</td>
                  <td>3</td>
                  <td>IKU-21</td>
                  <td>IKU 2-1</td>
                  <td>50%</td>
                  <td>15</td>
                  <td>Lokasi</td>
                  <td>Maximize</td>
                  <td>30</td>
                  <td>200%</td>
                  <td>Sekretariat Utama</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>IKU-22</td>
                  <td>IKU 2-2</td>
                  <td>20%</td>
                  <td>6</td>
                  <td>Lokasi</td>
                  <td>Maximize</td>
                  <td>4</td>
                  <td>75%</td>
                  <td>Sekretariat Utama</td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>IKU-23</td>
                  <td>IKU 2-3</td>
                  <td>30%</td>
                  <td>9</td>
                  <td>Lokasi</td>
                  <td>Maximize</td>
                  <td>9</td>
                  <td>100%</td>
                  <td>Sekretariat Utama</td>
                </tr>
                <tr>
                  <td rowspan="2">3</td>
                  <td rowspan="2">SS-3</td>
                  <td rowspan="2">Sasaran 3</td>
                  <td rowspan="2">30%</td>
                  <td>6</td>
                  <td>IKU-31</td>
                  <td>IKU 3-1</td>
                  <td>60%</td>
                  <td>6</td>
                  <td>Target</td>
                  <td>Minimize</td>
                  <td>3</td>
                  <td>150%</td>
                  <td>Biro Umum</td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>IKU-32</td>
                  <td>IKU 3-2</td>
                  <td>40%</td>
                  <td>4</td>
                  <td>Target</td>
                  <td>Minimize</td>
                  <td>4</td>
                  <td>100%</td>
                  <td>Biro Umum</td>
                </tr>
              </tbody>
              </table>