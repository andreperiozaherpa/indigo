<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Indikator Kompetensi</h4>
    </div>

		</div>

  <div class="row">


    <div class="col-md-12">
        <div class="white-box">


                        <div class="row ">
                          <form method="post" action="<?=base_url();?>bangkom/penilaian/submit_kompetensi">
                            <div class="col-lg-12 col-md-9 col-sm-12 col-xs-12">
                                <div class="inbox-center">


                                    <table class="table table-hover" id="data">
                                    <thead>

                                    <tr>

                                        <th colspan="4">
                                          <h3>Kompetensi : <label><?=$jenis_kompetensi;?></label></h3>
                                        </th>

                                        <th>
                                            <h3>Tahun : <label><?=$tahun_kegiatan;?></label></h3>

                                        </th>
                                        <tr>
                                            <th width="50px">#</th>
                                            <th width="200px">Unit Kompetensi</th>
                                            <th colspan="2">Indikator</th>
                                            <th width="150px" class="text-center">Status</th>
                                        </tr>
                                    </tr>
                                    <?php
                                    $no = 1;
                                    $i = 0;
                                    $nama_kompetensi = "";
                                      foreach ($dt_indikator->result() as $row) {
                                        if($nama_kompetensi != $row->nama_kompetensi)
                                        {
                                          $i = 1;
                                          $nama_kompetensi = $row->nama_kompetensi;
                                        }

                                        echo "
                                          <tr>
                                            <td>$no</td>
                                            <td>$row->nama_kompetensi</td>
                                            <td width='10px'>1.$i</td>
                                            <td><label for='checkbox$no'>$row->indikator</label></td>
                                            <td align='center'>
                                            <div class='checkbox m-t-0 m-b-0'>
                                            <input type='checkbox' class='checkbox' value='$row->id_indikator' id='checkbox$no' name='centang[]' >
                                            <label for='checkbox$no'></label>
                                            </div>

                                            </td>
                                          </tr>
                                        ";
                                        $no++;
                                        $i++;
                                      }
                                    ?>
                                    </thead>
                                    <tbody>


                                </tbody>
                                </table>

                            </div>
                            <input type="hidden" value="<?=$tahun_kegiatan;?>" name="tahun_kegiatan"/>
                            <input type="hidden" value="<?=$jenis_kompetensi;?>" name="jenis_kompetensi"/>
                            <button type="submit" value="submit" class="btn btn-primary">Submit</button>
                            <a href="<?=base_url();?>bangkom/penilaian" class="btn btn-default">Batal</a>
                        </div>
                      </form>
                    </div>
                    <div class="row">

                        <div class="col-md-12 pager">

                            <div class="btn-group" id="pagination">

                            </div>

                        </div>



                    </div>


        <!-- /.row -->
    </div>
</div>
</div>





<script type='text/javascript'>
    var csrf_hash = "<?=$this->security->get_csrf_hash();?>";
</script>
