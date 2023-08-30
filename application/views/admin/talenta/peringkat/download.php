<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Peringkat</title>
    <link href="<?php echo base_url()."asset/pixel/inverse/" ;?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
	
</head>

<body>

<?php if(!empty($dt_summary)){?>  
    
                
                <div class="row text-center">
                    <small><b style="color: #6003c8">DATA PERINGKAT</b></small>
                    <br>

                    <span style="margin-right: 10px;">Eselon <?= !empty($eselon) ? $eselon : "";?></span>
                    <span style="margin-right: 10px;">> <?=$dt_summary[0]->nama_skpd;?></span>
                    <span>> <?=$dt_summary[0]->nama_jabatan;?></span>
                </div>
                <hr>
                <table class="table color-table primary-table">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Skor</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                    foreach($dt_summary as $row){?>
                        <tr>
                            <td><?=$i;?></td>
                            <td><?=$row->nip;?></td>
                            <td><?=$row->nama_lengkap;?></td>
                            <td><?=$row->total;?></td>
                            
                        </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
    

    

<?php } ?>

</body>
</html>