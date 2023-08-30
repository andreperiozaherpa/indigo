<form method="POST">
<table>
<?php 
$uptd = $this->db->get_where('ref_skpd',array('jenis_skpd'=>'uptd'))->result();
$kelurahan = $this->db->get_where('ref_skpd',array('jenis_skpd'=>'kelurahan'))->result();
$e = array_merge($uptd,$kelurahan);
$induk = $this->db->get_where('ref_skpd',array('jenis_skpd'=>'skpd'))->result();
$kecamatan = $this->db->get_where('ref_skpd',array('jenis_skpd'=>'kecamatan'))->result();
$induk = array_merge($induk,$kecamatan);
foreach($e as $u){
    ?>
    <tr>
        <td> 
        <input type="hidden" name="id_skpd[]" value="<?=$u->id_skpd?>">    
        <?=$u->nama_skpd?></td>
        <td><select name="id_induk[]">
    <option value="">Pilih</option>
    <?php 
        foreach($induk as $i){
            $selected = $i->id_skpd == $u->id_skpd_induk ? ' selected' : '';
            echo '<option value="'.$i->id_skpd.'"'.$selected.'>'.$i->nama_skpd.'</option>';
        }
    ?>
    </select> </td>
    </tr>
    <?php
}
?>
</table>
<button type="submit">Simpan</button>
</form>