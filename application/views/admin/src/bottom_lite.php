<?php if(in_array("dropzone",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/dropzone-master/dist/dropzone.js"></script>
<?php endif?>

<?php if(in_array("jquery-ui.min",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/calendar/jquery-ui.min.js"></script>
<?php endif?>

<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<?php if ($this->router->fetch_class() == 'simpeg'){
	$this->load->view('admin/simpeg/src/bottom');
} ?>
<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/waves.js"></script>

<?php if(in_array("skycons",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/skycons/skycons.js"></script>
<?php endif?>

<?php if(in_array("raphael",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/raphael/raphael-min.js"></script>
<?php endif?>

<?php if(in_array("carousel",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/owl.carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/owl.carousel/owl.custom.js"></script>
<?php endif?>

<?php if(in_array("sparkline",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
<?php endif?>

<?php if(in_array("counter",$plugins)) :?>
<!--Counter js -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<?php endif?>


<?php if(in_array("sweetalert",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
<?php endif?>

<?php if(in_array("magnific-popup",$plugins)) :?>
<!-- Magnific popup JavaScript -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
<!--wizard Effects -->
<?php endif?>

<?php if(in_array("footable",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/footable-init.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/footable/js/footable.all.min.js"></script>
<?php endif?>

<?php if(in_array("knob",$plugins)) :?>
<!--  Knob JavaScript -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/knob/jquery.knob.js"></script>
<?php endif?>

<?php if(in_array("wizard",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js"></script>
<!-- FormValidation -->
<link rel="stylesheet" href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css">
<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js"></script>
<?php endif?>

<?php
if(!empty($map) && $map==true):?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF-EKYJaTXFn5AsQudXlemdxuzApgTTjw&sensor=true&callback=loadMap"></script>
<?php endif?>


<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/custom.min.js"></script>

<?php if(in_array("typeahead",$plugins)) :?>
<script type="text/javascript">
	$(document).ready(function() {
		// Defining the local dataset
		var cars = ['Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen'];

		// Constructing the suggestion engine
		var cars = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.whitespace,
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			local: cars
		});

		// Initializing the typeahead
		$('.typeahead').typeahead({
			hint: true,
			highlight: true,
			/* Enable substring highlighting */
			minLength: 1 /* Specify minimum characters required for showing suggestions */
		}, {
			name: 'cars',
			source: cars
		});
	});
</script>

<script src="<?php echo base_url() . "asset/pixel/"; ?>typeahead.js"></script>
<?php endif?>

<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/moment/moment.js"></script>

<?php if(in_array("bootstrap-editable",$plugins)) :?>
<script type="text/javascript" src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<?php endif?>

<?php if(in_array("horizontal-timeline",$plugins)) :?>
<!-- Horizontal-timeline JavaScript -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/horizontal-timeline/js/horizontal-timeline.js"></script>
<?php endif?>



<?php if(in_array("select",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/multiselect/js/jquery.quicksearch.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<?php endif?>

<?php if(in_array("tagsinput",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<?php endif?>

<?php if(in_array("touchspin",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<?php endif?>

<?php if(in_array("clockpicker",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
<?php endif?>

<?php if(in_array("datepicker",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<?php endif?>

<?php if(in_array("nestable",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/nestable/jquery.nestable.js"></script>
<?php endif?>

<!-- Calendar JavaScript -->
<?php if ($this->uri->segment(1) == "manage_todolist") : ?>
	<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/calendar/jquery-ui.min.js"></script>
<?php endif; ?>

<?php if(in_array("fullcalendar",$plugins)) :?>
<script src='<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/calendar/dist/fullcalendar.min.js'></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/calendar/dist/jquery.fullcalendar.js"></script>
<?php endif?>

<?php if(in_array("easypiechart",$plugins)) :?>
<script src='<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js'></script>
<script src='<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/jquery.easy-pie-chart/easy-pie-chart.init.js'></script>
<?php endif?>



<script>
	jQuery(document).ready(function() {

		<?php if(in_array("select",$plugins)) :?>
		// For select 2
		$(".select2").select2();
		$('.selectpicker').selectpicker();

		<?php endif?>
		
		<?php if(in_array("touchspin",$plugins)) :?>
		//Bootstrap-TouchSpin
		$(".vertical-spin").TouchSpin({
			verticalbuttons: true,
			verticalupclass: 'ti-plus',
			verticaldownclass: 'ti-minus'
		});
		var vspinTrue = $(".vertical-spin").TouchSpin({
			verticalbuttons: true
		});
		if (vspinTrue) {
			$('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
		}

		$("input[name='tch1']").TouchSpin({
			min: 0,
			max: 100,
			step: 0.1,
			decimals: 2,
			boostat: 5,
			maxboostedstep: 10,
			postfix: '%'
		});
		$("input[name='tch2']").TouchSpin({
			min: -1000000000,
			max: 1000000000,
			stepinterval: 50,
			maxboostedstep: 10000000,
			prefix: '$'
		});
		$("input[name='tch3']").TouchSpin();

		$("input[name='tch3_22']").TouchSpin({
			initval: 40
		});

		$("input[name='tch5']").TouchSpin({
			prefix: "pre",
			postfix: "post"
		});

		<?php endif?>

		

		/*----- BEGIN OF PAGINATION */

		if(typeof loadPagination==="function"){
				loadPagination(1);
		}

		var pagination = document.getElementById("pagination");
		if(pagination){
				$('#pagination').on('click','a',function(e){
						e.preventDefault();
						var pageno = $(this).attr('data-ci-pagination-page');
						if(typeof loadPagination==="function"){
								loadPagination(pageno);
						}
				});

		}

		if(typeof loadPagination2==="function"){
				loadPagination2(1);
		}

		var pagination2 = document.getElementById("pagination2");
		if(pagination){
				$('#pagination2').on('click','a',function(e){
						e.preventDefault();
						var pageno = $(this).attr('data-ci-pagination-page');
						if(typeof loadPagination2==="function"){
								loadPagination2(pageno);
						}
				});

		}



		/*----- END OF PAGINATION */

		// checkall
		$('#check_all').click(function(){
				if(this.checked) {
						// Iterate each checkbox
						$(':checkbox').each(function() {
								this.checked = true;
						});
				} else {
						$(':checkbox').each(function() {
								this.checked = false;
						});
				}

		});

		<?php
		if(!empty($this->session->flashdata('success'))){
			echo '
				swal("Sukses", "'.$this->session->flashdata('success').'", "success");
				';
		}
		if(!empty($this->session->flashdata('error'))){
			echo '
				swal("Error", "'.$this->session->flashdata('error').'", "error");
				';
		}
		?>

	});
</script>


<?php if(in_array("dropify",$plugins)) :?>
<!-- jQuery file upload -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
<?php endif?>
<script>
	$(document).ready(function() {
		<?php if(in_array("dropify",$plugins)) :?>
		// Basic
		$('.dropify').dropify();

		// Translated
		$('.dropify-fr').dropify({
			messages: {
				default: 'Glissez-déposez un fichier ici ou cliquez',
				replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
				remove: 'Supprimer',
				error: 'Désolé, le fichier trop volumineux'
			}
		});

		// Used events
		var drEvent = $('#input-file-events').dropify();

		drEvent.on('dropify.beforeClear', function(event, element) {
			return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
		});

		drEvent.on('dropify.afterClear', function(event, element) {
			alert('File deleted');
		});

		drEvent.on('dropify.errors', function(event, element) {
			console.log('Has Errors');
		});

		var drDestroy = $('#input-file-to-destroy').dropify();
		drDestroy = drDestroy.data('dropify')
		$('#toggleDropify').on('click', function(e) {
			e.preventDefault();
			if (drDestroy.isDropified()) {
				drDestroy.destroy();
			} else {
				drDestroy.init();
			}
		})
		<?php endif?>
	});
</script>

<script>
	<?php if(in_array("clockpicker",$plugins)) :?>
	// Clock pickers
	$('#single-input').clockpicker({
		placement: 'bottom',
		align: 'left',
		autoclose: true,
		'default': 'now'

	});

	$('.clockpicker').clockpicker({
			donetext: 'Done',

		})
		.find('input').change(function() {
			console.log(this.value);
		});

	$('#check-minutes').click(function(e) {
		// Have to stop propagation here
		e.stopPropagation();
		input.clockpicker('show')
			.clockpicker('toggleView', 'minutes');
	});
	<?php endif?>


	<?php if(in_array("colorpicker",$plugins)) :?>
	// Colorpicker

	$(".colorpicker").asColorPicker();
	$(".complex-colorpicker").asColorPicker({
		mode: 'complex'
	});
	$(".gradient-colorpicker").asColorPicker({
		mode: 'gradient'
	});
	<?php endif?>

	<?php if(in_array("datepicker",$plugins)) :?>
	// Date Picker
	jQuery('.mydatepicker, #datepicker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		todayHighlight: true
		// startDate: new Date('2018-7-1'),
		// endDate: new Date('2018-7-29')
	});
	jQuery('#tanggalpicker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		todayHighlight: true
		// startDate: new Date('2018-7-1'),
		// endDate: new Date('2018-7-29')
	});
	jQuery('.timepicker, #timepicker').timepicker();
	jQuery('#datepicker-autoclose').datepicker({
		autoclose: true,
		todayHighlight: true
	});

	jQuery('#date-range').datepicker({
		toggleActive: true
	});
	jQuery('#datepicker-inline').datepicker({

		todayHighlight: true
	});


	// Daterange picker

	$('.input-daterange-datepicker').daterangepicker({
		buttonClasses: ['btn', 'btn-sm'],
		applyClass: 'btn-danger',
		cancelClass: 'btn-inverse'
	});
	$('.input-daterange-timepicker').daterangepicker({
		timePicker: true,
		format: 'MM/DD/YYYY h:mm A',
		timePickerIncrement: 30,
		timePicker12Hour: true,
		timePickerSeconds: false,
		buttonClasses: ['btn', 'btn-sm'],
		applyClass: 'btn-danger',
		cancelClass: 'btn-inverse'
	});
	$('.input-limit-datepicker').daterangepicker({
		format: 'MM/DD/YYYY',
		minDate: $mindate,
		maxDate: $maxdate,
		buttonClasses: ['btn', 'btn-sm'],
		applyClass: 'btn-success',
		cancelClass: 'btn-inverse',
		// dateLimit: {
		//     days: $dayslimit
		// }
	});

	<?php endif?>

	<?php if(in_array("fullcalendar",$plugins)) :?>
	$('#event-calendar').fullCalendar({
		events: [
			// events here
		],
		editable: true,
		eventDrop: function(event, delta, revertFunc) {

			alert(event.title + " was dropped on " + event.start.format());

			if (!confirm("Are you sure about this change?")) {
				revertFunc();
			}

		}
	});
	<?php endif?>
</script>

<?php if(in_array("toast",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<?php endif?>

<?php if(in_array("blockUI",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/blockUI/jquery.blockUI.js"></script>
<?php endif?>

<?php if(in_array("wysihtml5",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
<?php endif?>

<?php if(in_array("inputmask",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/inputmask/dist/jquery.inputmask.js"></script>
<?php endif?>

<?php if(in_array("push",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/push.js/bin/push.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/push.js/bin/serviceWorker.min.js"></script>
<?php endif?>



<script>
	$(document).ready(function() {
		<?php if(in_array("wysihtml5",$plugins)) :?>
		$(".textarea_editor").each(function() {
			$(this).wysihtml5();
		});
		<?php endif?>

	});
</script>

<?php if(in_array("datatables",$plugins)) :?>
<script src="<?php echo base_url() . "asset/pixel/plugins/bower_components/datatables/"; ?>jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<?php endif?>


<script>
	$(document).ready(function() {
		

		<?php if(in_array("datatables",$plugins)) :?>
		$('#myTable').DataTable();

		$('#myTable').DataTable();
		$('#myTable1').DataTable();


		$('#tableSimple').DataTable({
			"searching": false,
			"lengthChange": false,
			"ordering": false
		});


			var table = $('#example').DataTable({
				"columnDefs": [{
					"visible": false,
					"targets": 2
				}],
				"order": [
					[2, 'asc']
				],
				"displayLength": 25,
				"drawCallback": function(settings) {
					var api = this.api();
					var rows = api.rows({
						page: 'current'
					}).nodes();
					var last = null;
					api.column(2, {
						page: 'current'
					}).data().each(function(group, i) {
						if (last !== group) {
							$(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
							last = group;
						}
					});
				}
			});
			// Order by the grouping
			$('#example tbody').on('click', 'tr.group', function() {
				var currentOrder = table.order()[0];
				if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
					table.order([2, 'desc']).draw();
				} else {
					table.order([2, 'asc']).draw();
				}
			});

			$('#example23').DataTable({
				dom: 'Bfrtip',
				"order": [
					[0, "desc"]
				],
				buttons: [
					'excel', 'pdf', 'print'
				]
			});


			$('#example99').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'excel', 'pdf', 'print','csv'
				]
			});
		<?php endif?>
	});
	


	<?php if(in_array("datatables",$plugins)) :?>
	function export_filtered() {

		var data_filtered = table.buttons.exportData({
			columns: ':visible'
		});

		var id_data = '';

		for (var i = Object.keys(data_filtered.body).length - 1; i >= 0; i--) {
			id_data += 'id:' + data_filtered['body'][i][0] + '\n';
		}
		alert(JSON.stringify(data_filtered) + id_data);
	}
	<?php endif?>
</script>


<script type="text/javascript">
	var base_url = "<?= base_url() ?>";
</script>

<script>
	<?php if(in_array("knob",$plugins)) :?>
	$(function() {
		$('[data-plugin="knob"]').knob();
	});
	<?php endif?>
</script>

<!-- Check Semua -->
<script type="text/javascript">
	$(function() {
		$('.checkall').on('click', function() {
			$('.child').prop('checked', this.checked)
		});
	});
</script>

<?php if(in_array("datetime",$plugins)) :?>
<!-- Bootstrap Datetime Picker -->
<script src="<?php echo base_url() . "assets/js"; ?>/bootstrap-datetime-picker.js"></script>
<?php endif?>



<script type="text/javascript">
	// $( document ).ready(function() {
	if (window.location.hash) {
		var hash = window.location.hash.substring(1);
		$('#' + hash).addClass('flash-highlight');
	}
	// });
</script>

<script>
	<?php
	if (!empty($message_success)) {
		echo '
		swal("Pesan!", "' . $message_success . '", "success");
		';
	}
	if (!empty($message_error)) {
		echo '
		swal("Pesan!", "' . $message_error . '", "error");
		';
	}
	?>
</script>


<?php if(in_array("blockUI",$plugins)) :?>
<script type="text/javascript">
	function block_ui(id) {
		$(id).block({
            message: '<h4><img src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/images/busy.gif" /> Mohon tunggu...</h4>',
            css: {
                border: '1px solid #fff'
            }
        });
	}
	function unblock_ui(id) {
		$(id).unblock();
	}
</script>
<?php endif?>

<?php if(in_array("tinymce",$plugins)) :?>
    <script type="text/javascript" src="<?php echo base_url() ;?>asset/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#post_manager",
            theme: "modern",
            plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak fullscreen",
			"searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
			"table contextmenu directionality emoticons paste textcolor filemanager"
			],
			image_advtab: true,
            convert_urls: false,
			 });


    </script>
<?php endif?>