<div class="container-fluid">
  
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?php echo title($title) ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                <ol class="breadcrumb">
                    <?php echo breadcrumb($this->uri->segment_array()); ?>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
<div class="col-md-4 col-xs-12">
                <div class="x_panel white-box">
                  <div class="x_title">
                    <h3>Jabatan Induk</h3>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <?php foreach ($item as $key) {
                     $id = $key->id_jabatan;
                     $nama = $key->nama_jabatan;
                     $status = $key->status;
                   }?>

                   <div class="x_panel white-box fixed_height_390">
                          <div class="x_content">

                            <div class="flex" style="text-align:center;">
                              
                               <!-- <img src="<?php echo base_url()."data/icon/skpd.png";?>" width="140px" align="midle"> -->
                                
                            </div>

                            <h3 class="name" style="text-align:center;"><?php echo $nama;?></h3>

                            <div class="flex">
                              <ul class="list-inline count2">
                               
                              </ul>
                            </div>
                            <p>
                              </p>
                          </div>
                        </div>
               


               
                  </div>
                </div>
              </div>





              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel white-box">
                  <div class="x_title">
                    <h3>Tambah Cabang Jabatan</h3>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form method="post" action="<?php echo base_url()."ref_jabatan/tambah_cabang/".$id;?>">
                    <table class="table table-striped">
                      
                      <tbody>
                        <tr>
                          <td>Nama Jabatan</td> <td> : <td><td>  <input type="text" class="form-control" name="nama" placeholder="nama jabatan" value="" required></td></tr>
                         <td>Status </td> <td> : <td><td><div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="Y"> &nbsp; Aktif &nbsp;
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="N"> Non Aktif
                            </label>
                          </div></td></tr>
                        
                      </tbody>
                    </table>
						<a href='<?= base_url();?>ref_jabatan' class='btn btn-default'>Back</a>
                       <button type="submit" class="btn btn-primary ">Submit </button>
                    </form> 
                  </div>
                </div>
              </div>
              </div>



</td>