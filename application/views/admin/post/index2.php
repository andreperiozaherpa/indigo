
<ol class="breadcrumb bc-3">
	<li>
		<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
	</li>
	<li>	
		<a href="<?php echo base_url();?>manage_post">Post</a>
	</li>
	<li class="active">		
		<strong>All post</strong>
	</li>
</ol>
			
<div class="row">
	<div class="col-md-9 col-sm-7">
		<h2>All Post</h2>
	</div>
	
	<div class="col-md-3 col-sm-5">
		
		<form method="get" role="form" class="search-form-full">
		
			<div class="form-group">
				<input type="text" class="form-control" value='<?php if (!empty($search)) echo $search;?>' name="s" id="search-input" placeholder="Search..." />
				<i class="entypo-search"></i>
			</div>
			
		</form>
	</div>
</div>
<table class="table table-bordered datatable" id="data">
	<thead>
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Category</th>
			<th>Tags</th>
			<th>Author</th>
			<th>Post Date</th>
			<th>Status</th>
			<th width=70px>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$num = 0;
			if (!empty($offset)) $num = $offset;
			foreach ($query as $row) {
				$tag = "";
				$tags= $row->tag;
				if ($tags!=""){
					$exp = explode(";", $tags);
					$_tag = array();
					foreach ($Qtag as $r) {
						$_tag[$r->tag_name] = $r->tag_slug;
					}
					
					for ($x=0; $x < (count($exp) - 1) ; $x++)
					{
						$slug = $_tag[$exp[$x]];
						$tag .= "<a target='_blank' href='".base_url()."berita/tag/$slug' >#$exp[$x]</a> ";
					}
				}
				$num++;
				echo"
					<tr>
						<td>$num</td>
						<td>
							<a target='_blank' href='".base_url()."berita/read/$row->title_slug' >$row->title</a></td>
						<td>";
						if ($row->category_name!="")
							echo"
							<a target='_blank' href='".base_url()."berita/category/$row->category_slug' >
							$row->category_name</a>";
						else
							echo "::Internal::";
				echo"
						</td>
						<td>$tag</td>
						<td>$row->full_name</td>
						<td>
							". date('d M Y',strtotime($row->date)) ." $row->time
						</td>
						<td>$row->post_status</td>
						<td>
							<a href='".base_url()."manage_post/edit/$row->post_id' class='btn-xs' title='Edit'>
								
								<i class='entypo-pencil'></i>
							</a>
							<a class='btn-xs' title='Delete' onclick='jQuery(\"#confirm\").modal(\"show\");delete_(\"$row->post_id\")'>
								<i class='entypo-cancel'></i>
							</a>
							
						</td>
					</tr>
				";

				
			}
			if ($num==0){
				echo"
					<tr>
					<td colspan=8 align=center>No data</td>
					</tr>
				";
			}
		?>
	</tbody>
</table>
<?php
		
			echo"<div class='row'>
					<div class='col-md-12 pager'>";

                        $CI =& get_instance();
                        $CI->load->library('pagination');

                        $config['base_url'] = base_url(). 'manage_post/index/';
                        $config['total_rows'] = $total_rows;
                        $config['per_page'] = $per_page;
                        $config['attributes'] = array('class' => 'btn btn-primary btn-xm marginleft2px');
                        $config['page_query_string']=TRUE;
                        $CI->pagination->initialize($config);
                        $link = $CI->pagination->create_links();
                        $link = str_replace("<strong>", "<button type='button' class='btn btn-primary btn-xm disabled marginleft2px' >", $link);
                        $link = str_replace("</strong>", "</button>", $link);
                        echo $link;
                        
                    ?>
	                </div>
	            </div>
<script type="text/javascript">
	function delete_(id)
	{
		$('#confirm_title').html('Confirmation');
		$('#confirm_content').html('Are you sure want to delete it?');
		$('#confirm_btn').html('Delete');
		$('#confirm_btn').attr('href',"<?php echo base_url();?>manage_post/delete/"+id);
	}
</script>