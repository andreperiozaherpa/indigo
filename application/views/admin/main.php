<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('admin/src/head_v2');?>
	<style type="text/css">
		.marginleft2px{
			margin-left: 2px;
		}
	</style>

</head>

<body>
    <!-- Preloader -->
    <!-- <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div> -->
	<div class="modal fade" id="confirm">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id='confirm_title'>Title</h4>
				</div>

				<div class="modal-body" id='confirm_content'>
					Content
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<a  id='confirm_btn' class="btn btn-info">Confirm</a>
				</div>
			</div>
		</div>
	</div>

	<div id="wrapper">
        <!-- Navigation -->
        	<?php $this->load->view('admin/src/top_nav');?>
        <!-- Left navbar-header -->
        	<?php $this->load->view('admin/src/menu');?>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
        <?php
			if ($content!="") {
				$this->load->view("admin/".$content);
			}
		?>
        </div>
        <!-- /#page-wrapper -->
        <?php $this->load->view('admin/src/footer');
			if (!empty($active_menu) && $active_menu=="dashboard") {
				$this->load->view('admin/monitor_grafik');
			}?>
    </div>



	<?php $this->load->view('admin/src/bottom_v2');?>

	<script type="text/javascript">
		var active_menu = "<?php echo $active_menu;?>";
		$('#'+active_menu).attr('class','opened active');
	</script>

</body>
</html>
