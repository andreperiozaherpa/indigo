
<script type="text/javascript" src="<?php echo base_url()."asset" ;?>/tinymce/tinymce.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset" ;?>/tinymce/plugins/codesample/prism.css">
<script src="<?php echo base_url()."asset" ;?>/tinymce/plugins/codesample/prism.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#laporan",
            theme: "modern",
            plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor filemanager codesample ",

            ],
            codesample_dialog_width: '400',
            codesample_dialog_height: '400',
            codesample_languages: [
                {text: 'HTML/XML', value: 'markup'},
                {text: 'JavaScript', value: 'javascript'},
                {text: 'CSS', value: 'css'},
                {text: 'PHP', value: 'php'},
                {text: 'Ruby', value: 'ruby'},
                {text: 'Python', value: 'python'},
                {text: 'Java', value: 'java'},
                {text: 'C', value: 'c'},
                {text: 'C#', value: 'csharp'},
                {text: 'C++', value: 'cpp'}
            ],
            image_advtab: true,
            image_title: true, 
            automatic_uploads: true,
            theme_advanced_buttons1 : "openmanager",
            file_browser_callback_types: 'file image media',

file_browser_callback: function(field_id, url, type, win, editor) { 
            
                // from http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript
                var w = window,
                d = document,
                e = d.documentElement,
                g = d.getElementsByTagName('body')[0],
                x = w.innerWidth || e.clientWidth || g.clientWidth,
                y = w.innerHeight|| e.clientHeight|| g.clientHeight;

            if(type == 'image') {           
                type_id = "1";
            } else if(type == 'file') {           
                type_id = "2";
            } else if(type == 'media') {           
                type_id = "3";
            } else {           
                type_id = "0";
            }

            var cmsURL = '<?php echo base_url()?>asset/tinymce/plugins/filemanager/dialog.php?type='+type_id+'&field_id='+field_id+'&relative_url=1&lang='+tinymce.settings.language + '&subfolder=' + tinymce.settings.subfolder;
        
            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title: 'File Manager',
                filetype: 'all',
                classes: 'filemanager',
                inline: "yes",
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });  
        },

            toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code codesample"
             });
    </script>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="white-box">
    <div class="x_title">
      <h2>Tambah Agenda Harian</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>

      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Agenda</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="nama"required>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <SELECT class="form-control">
                            <option>Semua Kategori</option>
                          </SELECT>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="date" class="form-control" name="nama"required>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Laporan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea id="laporan" class="form-control"></textarea>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">File</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="file" class="form-control" name="nama" placeholder="Uraian" required>
                        </div>
                      </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lokasi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="nama"required>
                        </div>
                      </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control">
                            <option value="">Pilih Provinsi</option>
                          </select>
                        </div>
                      </div>           <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control">
                            <option value="">Pilih Kabupaten</option>
                          </select>
                        </div>
                      </div>           <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control">
                            <option value="">Pilih Kecamatan</option>
                          </select>
                        </div>
                      </div>           <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Desa</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control">
                            <option value="">Pilih Desa</option>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a href="<?=base_url('agenda_harian')?>" class="btn btn-default">Batal</a>
                          <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                      </div>

                    </form> 
       </div>
     </div>
   </div>
 </div>
