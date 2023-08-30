
<!-- jQuery -->
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url()."asset/pixel/inverse/" ;?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="<?php echo base_url()."asset/pixel/inverse/" ;?>js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url()."asset/pixel/inverse/" ;?>js/waves.js"></script>
<script src="<?php echo base_url()."asset/pixel/inverse/" ;?>js/mask.js"></script>
<!--weather icon -->
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/skycons/skycons.js"></script>
<!--Morris JavaScript -->
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/raphael/raphael-min.js"></script>
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/morrisjs/morris.js"></script>
<!-- jQuery for carousel -->
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/owl.carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/owl.carousel/owl.custom.js"></script>
<!-- Sparkline chart JavaScript -->
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
<!--Counter js -->
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!-- Sweet-Alert  -->
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
<!-- Magnific popup JavaScript -->
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
<!--wizard Effects -->

<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js"></script>

<script src="<?php echo base_url()."asset/pixel/inverse/" ;?>js/footable-init.js"></script>

<!--  Knob JavaScript -->
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/knob/jquery.knob.js"></script>



<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url()."asset/pixel/inverse/" ;?>js/custom.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
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
        highlight: true, /* Enable substring highlighting */
        minLength: 1 /* Specify minimum characters required for showing suggestions */
    },
    {
        name: 'cars',
        source: cars
    });
});
</script>
<script src="<?php echo base_url()."asset/pixel/" ;?>typeahead.js"></script>
<script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/moment/moment.js"></script>

<script type="text/javascript" src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<!-- Horizontal-timeline JavaScript -->
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/horizontal-timeline/js/horizontal-timeline.js"></script>

<?php
if($this->uri->segment('1')=="ref_surat"&&$this->uri->segment('2')=="add"){
    ?>

    <script type="text/javascript" src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/form-builder/js/vendor.js"></script>
    <script type="text/javascript" src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/form-builder/js/form-builder.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/form-builder/js/form-render.min.js"></script>
    <script>
      jQuery(function($) {
        $(document.getElementById('builder')).formBuilder();
    });
</script>

<?php } ?>

<script src="<?php echo base_url()."asset/pixel/inverse/" ;?>js/widget.js"></script>

<?php if ($this->uri->segment(1)=="admin"): ?>
    <script src="<?php echo base_url()."asset/pixel/inverse/" ;?>js/dashboard1.js"></script>
    <?php else: ?>
        <script src="<?php echo base_url()."asset/pixel/inverse/" ;?>js/chat.js"></script>
    <?php endif;?>


    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/switchery/dist/switchery.min.js"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/footable/js/footable.all.min.js"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>

    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/nestable/jquery.nestable.js"></script>

    <!-- Calendar JavaScript -->
    <?php if ($this->uri->segment(1)=="manage_todolist"): ?>
        <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/calendar/jquery-ui.min.js"></script>
    <?php endif;?>
    <script src='<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/calendar/dist/fullcalendar.min.js'></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/calendar/dist/jquery.fullcalendar.js"></script>

    <!-- EASY PIE CHART JS -->
    <script src='<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js'></script>
    <script src='<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/jquery.easy-pie-chart/easy-pie-chart.init.js'></script>






    <script>
        jQuery(document).ready(function() {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());

            });

            $('.js-switch2').each(function() {
                var elem = $(this)[0];
                var init = new Switchery(elem, {color:'#6003c8'});


                if(elem.checked==true){

                    $(elem).siblings(".switchery").css("width", "100px").prepend("<span>Terima</span>").find("small").css("left", "70px");
                    $(elem).siblings(".switchery").find("span").text('Terima').css('float','left').css('color','#fff');
                    $(elem).siblings(".switchery").find("small").html('<i class="ti-check"></i>');
                }else{

                    $(elem).siblings(".switchery").css("width", "100px").prepend("<span>Tolak</span>");
                    $(elem).siblings(".switchery").find("span").text('Tolak').css('float','right').css('color','#6003c8');;
                    $(elem).siblings(".switchery").find("small").html('<i class="ti-close"></i>');
                }

                elem.onchange = function(e) {
                    if(elem.checked==true){
                        $(elem).siblings(".switchery").find("span").text('Terima').css('float','left').css('color','#fff');
                        $(elem).siblings(".switchery").find("small").html('<i class="ti-check"></i>');
                        alert($(elem).html());
                    }else{
                        $(elem).siblings(".switchery").find("span").text('Tolak').css('float','right').css('color','#6003c8');;
                        $(elem).siblings(".switchery").find("small").html('<i class="ti-close"></i>');
                    }
                };


            });
            // For select 2

            $(".select2").select2();
            $('.selectpicker').selectpicker();

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

            // For multiselect

            $('#pre-selected-options').multiSelect();
            $('#optgroup').multiSelect({
                selectableOptgroup: true
            });

            $('#public-methods').multiSelect();
            $('#select-all').click(function() {
                $('#public-methods').multiSelect('select_all');
                return false;
            });
            $('#deselect-all').click(function() {
                $('#public-methods').multiSelect('deselect_all');
                return false;
            });
            $('#refresh').on('click', function() {
                $('#public-methods').multiSelect('refresh');
                return false;
            });
            $('#add-option').on('click', function() {
                $('#public-methods').multiSelect('addOption', {
                    value: 42,
                    text: 'test 42',
                    index: 0
                });
                return false;
            });

        });
    </script>


    <!-- jQuery file upload -->
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
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
    });
</script>

<script>
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
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker

    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
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
</script>
<!--Style Switcher -->
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

<script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/blockUI/jquery.blockUI.js"></script>

<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
<script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();


    });
</script>





<script src="<?php echo base_url()."asset/pixel/plugins/bower_components/datatables/" ;?>jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<?php
if($this->uri->segment(1)=="kegiatan"&&$this->uri->segment(2)=="add"){
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tableAnggota').on('click', '.del-anggota', function () {
                var count = $('#tableAnggota tbody tr').length;
                if(count>1){
                    $(this).closest('tr').remove();
                }else{
                    return false;
                }
            });
            $('#tableAnggota').on('change', '.id_pegawai', function () {
                var ketua = $('#id_ketua_tim').val();
                var id = $(this).val();
                if(ketua==id){
                    $(this).val('');
                    $(this).trigger('change');
                    swal('Peringatan','Pegawai ini sudah terdaftar sebagai Ketua Tim','warning');
                }else{
                    var array = [];
                    $(".id_pegawai").each(function( index ) {
                        array.push($(this).val());
                    });
                    var check = (new Set(array)).size !== array.length;
                    if(check){
                        $(this).val('');
                        $(this).trigger('change');
                        $(this).select2('val', '');
                        swal('Peringatan','Pegawai ini sudah terdaftar sebagai Anggota Tim','warning');
                    }
                }
            });
            var updateOutput = function(e) {
                var list = e.length ? e : $(e.target),
                output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };

            $('#nestable').nestable({
                group: 1
            }).on('change', updateOutput);

            $('#nestable2').nestable({
                group: 1
            }).on('change', updateOutput);

            updateOutput($('#nestable').data('output', $('#nestable-output')));
            updateOutput($('#nestable2').data('output', $('#nestable2-output')));

            $('#nestable-menu').on('click', function(e) {
                var target = $(e.target),
                action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });

            $('#nestable-menu').nestable();
        });
    </script>
<?php } ?>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();

        <?php if($this->uri->segment(2)=='quick_view'||$this->uri->segment(1)=='quick_view'){
            ?>

            $('.input-daterange-datepicker').daterangepicker({
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse',
                locale: {
            // format: 'YYYY-MM-DD'
        }
    });
// Setup - add a text input to each footer cell
$('#quick_table thead tr:eq(1) th').each( function (i) {
    var title = $('#quick_table thead tr:eq(0) th').eq( $(this).index() ).text();
    if(i!=0&&i!=4){
        $(this).html( '<input class="form-control" type="text" placeholder="Cari '+title+'" />' );
    }else if (i==4) {
        $(this).html( '<a href="javascript:void(0)" class="btn btn-primary" onclick="export_filtered()" data-toggle="tooltip" title="Unduh hasil telusur"><i class="ti-export"></i> Export</a>' );
    }
} );

    // DataTable
    window.table = $('#quick_table').DataTable({
        orderCellsTop: true
    });

    // Apply the search
    table.columns().every( function (index) {
        var that = this;

        $('#quick_table thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                .search( this.value )
                .draw();
            }
        } );
    } );


    table.column(1).every( function (index) {

        var column = this;
        var select = $('<select class="form-control"><option value="">Cari Unit Kerja</option></select>')
        .appendTo($('#quick_table thead tr:eq(1) th:eq(' + index + ')').empty())
        .on('change', function() {
            var val = $.fn.dataTable.util.escapeRegex(
              $(this).val()
              );

            column
            .search(val ? '^' + val + '$' : '', true, false)
            .draw();
        });

        column.data().unique().sort().each(function(d, j) {
          select.append('<option value="' + d + '">' + d + '</option>')
      });

    });


    <?php
} ?>

$('#myTable').DataTable();
$('#myTable1').DataTable();

$(document).ready(function() {
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
        });
});
    $('#example23').DataTable({
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
        buttons: [
        'excel', 'pdf', 'print'
        ]
    });



    function export_filtered() {

        var data_filtered = table.buttons.exportData( {
            columns: ':visible'
        } );

        var id_data = '';

        for (var i = Object.keys(data_filtered.body).length - 1; i >= 0; i--) {
            id_data += 'id:'+data_filtered['body'][i][0]+'\n';
        }
        alert(JSON.stringify(data_filtered)+id_data);
    }
</script>

<?php if($this->uri->segment(1)=='kinerja_pegawai') {?>
    <script type="text/javascript">
      $( document ).ready(function() {

        var ctx1 = document.getElementById("chart1").getContext("2d");
        var data1 = {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [
          {
            label: "My First dataset",
            fillColor: "rgba(133,180,208,0.8)",
            strokeColor: "rgba(133,180,208,0.8)",
            pointColor: "rgba(133,180,208,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(133,180,208,1)",
            data: [0, 59, 80, 58, 20, 55, 40]
        }

        ]
    };

    var chart1 = new Chart(ctx1).Line(data1, {
      scaleShowGridLines : true,
      scaleGridLineColor : "rgba(0,0,0,.005)",
      scaleGridLineWidth : 0,
      scaleShowHorizontalLines: true,
      scaleShowVerticalLines: true,
      bezierCurve : true,
      bezierCurveTension : 0.4,
      pointDot : true,
      pointDotRadius : 4,
      pointDotStrokeWidth : 1,
      pointHitDetectionRadius : 2,
      datasetStroke : true,
      tooltipCornerRadius: 2,
      datasetStrokeWidth : 2,
      datasetFill : true,
      legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      responsive: true
  });

});
</script>
<?php } ?>
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/Chart.js/Chart.min.js"></script>


<script type="text/javascript">
    (function() {
        $('#exampleBasic').wizard({
            onFinish: function() {
                swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
            }
        });
        $('#submit_wizard').wizard({
            onFinish: function() {
                document.getElementById("mForm").submit();
            }
        });
        $('#exampleBasic2').wizard({
            onFinish: function() {
                swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
            }
        });
        $('#exampleValidator').wizard({
            onInit: function() {
                $('#validation').formValidation({
                    framework: 'bootstrap',
                    fields: {
                        username: {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                },
                                stringLength: {
                                    min: 6,
                                    max: 30,
                                    message: 'The username must be more than 6 and less than 30 characters long'
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9_\.]+$/,
                                    message: 'The username can only consist of alphabetical, number, dot and underscore'
                                }
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'The email address is required'
                                },
                                emailAddress: {
                                    message: 'The input is not a valid email address'
                                }
                            }
                        },
                        password: {
                            validators: {
                                notEmpty: {
                                    message: 'The password is required'
                                },
                                different: {
                                    field: 'username',
                                    message: 'The password cannot be the same as username'
                                }
                            }
                        }
                    }
                });
            },
            validator: function() {
                var fv = $('#validation').data('formValidation');

                var $this = $(this);

                // Validate the container
                fv.validateContainer($this);

                var isValidStep = fv.isValidContainer($this);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }

                return true;
            },
            onFinish: function() {
                $('#validation').submit();
                swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
            }
        });

        $('#accordion').wizard({
            step: '[data-toggle="collapse"]',

            buttonsAppendTo: '.panel-collapse',

            templates: {
                buttons: function() {
                    var options = this.options;
                    return '<div class="panel-footer"><ul class="pager">' +
                    '<li class="previous">' +
                    '<a href="#' + this.id + '" data-wizard="back" role="button">' + options.buttonLabels.back + '</a>' +
                    '</li>' +
                    '<li class="next">' +
                    '<a href="#' + this.id + '" data-wizard="next" role="button">' + options.buttonLabels.next + '</a>' +
                    '<a href="#' + this.id + '" data-wizard="finish" role="button">' + options.buttonLabels.finish + '</a>' +
                    '</li>' +
                    '</ul></div>';
                }
            },

            onBeforeShow: function(step) {
                step.$pane.collapse('show');
            },

            onBeforeHide: function(step) {
                step.$pane.collapse('hide');
            },

            onFinish: function() {
                swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
            }
        });
    })();
</script>
<script type="text/javascript" src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/orgchart/orgchart.js"></script>
<script type="text/javascript">
    var base_url = "<?=base_url()?>";
</script>
<script>
    $(document).ready(function () {
            // create a tree
            $("#tree-data").jOrgChart({
                chartElement: $("#tree-view"),
                nodeClicked: nodeClicked
            });

            // lighting a node in the selection
            function nodeClicked(node, type) {
                node = node || $(this);
                $('.jOrgChart .selected').removeClass('selected');
                node.addClass('selected');
            }
        });
    </script>
    <script>
        $(function() {
            $('[data-plugin="knob"]').knob();
        });
    </script>

    <!-- Check Semua -->
    <script type="text/javascript">

      $(function(){
          $('.checkall').on('click', function() {
              $('.child').prop('checked', this.checked)
          });
      });

  </script>
  <!-- Flot Charts JavaScript -->
  <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/flot/excanvas.min.js"></script>
  <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/flot/jquery.flot.js"></script>
  <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/flot/jquery.flot.pie.js"></script>
  <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/flot/jquery.flot.resize.js"></script>
  <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/flot/jquery.flot.time.js"></script>
  <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/flot/jquery.flot.stack.js"></script>
  <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/flot/jquery.flot.crosshair.js"></script>
  <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
  <script src="<?php echo base_url()."asset/pixel/inverse/" ;?>js/flot-data.js"></script>
