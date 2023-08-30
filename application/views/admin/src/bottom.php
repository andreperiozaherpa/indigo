<!-- Dropzone Plugin JavaScript -->

<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/dropzone-master/dist/dropzone.js">
</script>

<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/calendar/jquery-ui.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js">
</script>
<?php if ($this->router->fetch_class() == 'simpeg') {
    $this->load->view('admin/simpeg/src/bottom');
} ?>
<?php if ($this->router->fetch_class() == 'auditor') {
        // $this->load->view('admin/auditor/src/bottom');
    } ?>
<!--slimscroll JavaScript -->
<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/waves.js"></script>
<!-- <script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/mask.js"></script> -->
<!--weather icon -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/skycons/skycons.js"></script>
<!--Morris JavaScript -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/raphael/raphael-min.js"></script>
<!-- <script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/morrisjs/morris.js"></script> -->
<!-- jQuery for carousel -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/owl.carousel/owl.carousel.min.js">
</script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/owl.carousel/owl.custom.js"></script>
<!-- Sparkline chart JavaScript -->
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js">
</script>
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js">
</script>
<!--Counter js -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/waypoints/lib/jquery.waypoints.js">
</script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/counterup/jquery.counterup.min.js">
</script>
<!-- Sweet-Alert  -->

<?php if ($this->router->fetch_class() != 'simpeg' or $this->router->fetch_class() == 'auditor') { ?>
        <script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
        <script
            src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js">
        </script>
<?php } ?>
<!-- Magnific popup JavaScript -->
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js">
</script>
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js">
</script>
<!--wizard Effects -->

<script
    src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js">
</script>

<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/footable-init.js"></script>

<!--  Knob JavaScript -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/knob/jquery.knob.js"></script>

<!-- FormValidation -->
<link rel="stylesheet"
    href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css">
<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js">
</script>
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js">
</script>

<script>
$.fn.modal.Constructor.prototype.enforceFocus = function() {};
</script>
<?php
if (!empty($map) && $map == true): ?>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF-EKYJaTXFn5AsQudXlemdxuzApgTTjw&sensor=true&callback=loadMap">
        </script>
<?php endif ?>


<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/custom.min.js"></script>

<script>
function menuOffice() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("mySearch");
    filter = input.value.toUpperCase();
    ul = document.getElementById("side-menu");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>

<script type="text/javascript">
$(document).ready(function() {
    <?php

    $show = $this->session->userdata('modal_show');
    if ($show == NULL) {
        ?>
            $('#modalAjuanKerjaRumah').modal('show');
            <?php
            $this->session->set_userdata('modal_show', true);
    }
    ?>


    // Defining the local dataset
    var cars = ['Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche',
        'Rolls-Royce', 'Volkswagen'
    ];

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
<!-- <script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/calendar/jquery-ui.min.js"></script> -->

<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/moment/moment.js"></script>

<script type="text/javascript"
    src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js">
</script>

<!-- Horizontal-timeline JavaScript -->
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/horizontal-timeline/js/horizontal-timeline.js">
</script>

<?php
if ($this->uri->segment('1') == "ref_surat" && ($this->uri->segment('2') == "add" || $this->uri->segment('2') == "edit")) {
    ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
        <script type="text/javascript">
        var fbEditor = document.getElementById('form-builder'),
            options = {
                onSave: function(evt, formData) {
                    $('#data').val(btoa(unescape(encodeURIComponent(formData))));
                    $('button[type=submit]').show();
                },
                onOpenFieldEdit: function(editPanel) {
                    // alert('a field edit panel was opened');

                    $('button[type=submit]').hide();
                },
                onAddField: function(fieldId) {
                    $('button[type=submit]').hide();
                },
                // onAddOption: (optionTemplate, optionIndex) => {

                // 	$('button[type=submit]').hide();
                // },
                onCloseFieldEdit: function(editPanel) {
                    // alert('a field edit panel was closed')

                    $('button[type=submit]').hide();
                },
                onClearAll: function(formData) {
                    // alert('all fields removed');

                    $('button[type=submit]').hide();
                },
                disabledAttrs: [
                    'access',
                    'required',
                    'inline',
                    'multiple',
                    'other'
                ],
                disableFields: ['autocomplete'],
                typeUserAttrs: {
                    text: {
                        autofill: {
                            label: 'autofill',
                            options: {
                                'nonaktif': 'Nonaktif',
                                'aktif': 'Aktif'
                            }
                        },
                        reference_value: {
                            label: 'Reference Field Value',
                            value: '',
                            placeholder: 'Input field name from this form'
                        },
                        re_table: {
                            label: 'Table',
                            options: {
                                '': 'Pilih',
                                <?php
                                $tables = $this->db->list_tables();
                                foreach ($tables as $t) { ?> '<?= $t ?>': '<?= $t ?>',
                                <?php } ?>
                            }
                        },
                        re_value: {
                            label: 'Value',
                            options: {
                                '': 'Pilih'
                            }
                        },
                        re_event: {
                            label: 'Event',
                            options: {
                                '': 'Pilih',
                                'onchange': 'onChange',
                                'onclick': 'onClick',
                                'onkeyup': 'onKeyUp'
                            }
                        }
                    },
                    select: {
                        lookup: {
                            label: 'Lookup',
                            options: {
                                'costumize': 'Costumize',
                                'database': 'Database',
                            }
                        },
                        table: {
                            label: 'Table',
                            options: {
                                '': 'Pilih',
                                <?php
                                $tables = $this->db->list_tables();
                                foreach ($tables as $t) { ?> '<?= $t ?>': '<?= $t ?>',
                                <?php } ?>
                            }
                        },
                        t_label: {
                            label: 'Label',
                            options: {
                                '': 'Pilih'
                            }
                        },
                        t_value: {
                            label: 'Value',
                            options: {
                                '': 'Pilih'
                            }
                        }
                    },
                    'checkbox-group': {
                        lookup: {
                            label: 'Lookup',
                            options: {
                                '': 'Pilih',
                                'costumize': 'Costumize',
                                'database': 'Database',
                            }
                        },
                        table: {
                            label: 'Table',
                            options: {
                                '': 'Pilih',
                                <?php
                                $tables = $this->db->list_tables();
                                foreach ($tables as $t) { ?> '<?= $t ?>': '<?= $t ?>',
                                <?php } ?>
                            }
                        },
                        t_label: {
                            label: 'Label',
                            options: {
                                '': 'Pilih'
                            }
                        },
                        t_value: {
                            label: 'Value',
                            options: {
                                '': 'Pilih'
                            }
                        }
                    },
                    header: {
                        name: {
                            label: 'Name',
                            value: 'tes'
                        }
                    },
                    'radio-group': {
                        lookup: {
                            label: 'Lookup',
                            options: {
                                '': 'Pilih',
                                'costumize': 'Costumize',
                                'database': 'Database',
                            }
                        },
                        table: {
                            label: 'Table',
                            options: {
                                '': 'Pilih',
                                <?php
                                $tables = $this->db->list_tables();
                                foreach ($tables as $t) { ?> '<?= $t ?>': '<?= $t ?>',
                                <?php } ?>
                            }
                        },
                        t_label: {
                            label: 'Label',
                            options: {
                                '': 'Pilih'
                            }
                        },
                        t_value: {
                            label: 'Value',
                            options: {
                                '': 'Pilih'
                            }
                        }
                    },
                },
                typeUserEvents: {
                    text: {
                        onadd: function(fld) {
                            var $tableField = $(".fld-re_table", fld);
                            var $tableWrap = $tableField.parents(".re_table-wrap:eq(0)");
                            var $t_valueField = $(".fld-re_value", fld);
                            var $t_valueWrap = $t_valueField.parents(".re_value-wrap:eq(0)");
                            var $t_eventField = $(".fld-re_event", fld);
                            var $t_eventWrap = $t_eventField.parents(".re_event-wrap:eq(0)");
                            var $reference_valueField = $(".fld-reference_value", fld);
                            var $reference_valueWrap = $reference_valueField.parents(".reference_value-wrap:eq(0)");
                            var tbl = $(".fld-re_table", fld).find(":selected").val();
                            var name = $(".fld-name", fld).val();
                            var autofill = $(".fld-autofill", fld).val();

                            if (tbl !== '') {
                                $.post("<?php echo base_url(); ?>ref_surat/get_columnn/" + tbl, {}, function(obj) {
                                    $(".fld-re_value", fld).html(obj);
                                    $.post("<?php echo base_url(); ?>ref_surat/get_reference_value/" + name +
                                        "/<?= $this->uri->segment(4) ?>", {},
                                        function(obj) {
                                            $(".fld-re_value", fld).val(obj);
                                        });
                                });
                            }

                            if (autofill == 'nonaktif') {
                                $tableField.prop("disabled", true);
                                $tableWrap.hide();
                                $t_eventField.prop("disabled", true);
                                $t_eventWrap.hide();
                                $t_valueField.prop("disabled", true);
                                $t_valueWrap.hide();
                                $reference_valueField.prop("disabled", true);
                                $reference_valueWrap.hide();
                            } else {
                                $tableField.prop("disabled", false);
                                $tableWrap.show();
                                $t_eventField.prop("disabled", false);
                                $t_eventWrap.show();
                                $t_valueField.prop("disabled", false);
                                $t_valueWrap.show();
                                $reference_valueField.prop("disabled", false);
                                $reference_valueWrap.show();
                            }

                            fld.querySelector(".fld-autofill").onchange = function(e) {
                                var toggle = e.target.value === "aktif";
                                $tableField.prop("disabled", !toggle);
                                $tableWrap.toggle(toggle);
                                $t_valueField.prop("disabled", !toggle);
                                $t_valueWrap.toggle(toggle);
                                $t_eventField.prop("disabled", !toggle);
                                $t_eventWrap.toggle(toggle);
                                $reference_valueField.prop("disabled", !toggle);
                                $reference_valueWrap.toggle(toggle);
                            };

                            fld.querySelector(".fld-re_table").onchange = function(e) {
                                var tabel = e.target.value;
                                $.post("<?php echo base_url(); ?>ref_surat/get_columnn/" + tabel, {}, function(obj) {
                                    $(".fld-re_value", fld).html(obj);
                                });
                            };
                        }
                    },
                    select: {
                        onadd: function(fld) {
                            var $tableField = $(".fld-table", fld);
                            var $tableWrap = $tableField.parents(".table-wrap:eq(0)");
                            var $t_valueField = $(".fld-t_value", fld);
                            var $t_valueWrap = $t_valueField.parents(".t_value-wrap:eq(0)");
                            var $t_labelField = $(".fld-t_label", fld);
                            var $t_labelWrap = $t_labelField.parents(".t_label-wrap:eq(0)");
                            var $optionsField = $(".sortable-options", fld);
                            var $optionsWrap = $optionsField.parents(".field-options:eq(0)");
                            var tbl = $(".fld-table", fld).find(":selected").val();
                            var name = $(".fld-name", fld).val();
                            var lookup = $(".fld-lookup", fld).val();
                            if (tbl !== '') {
                                $.post("<?php echo base_url(); ?>ref_surat/get_columnn/" + tbl, {}, function(obj) {
                                    $(".fld-t_value", fld).html(obj);
                                    $(".fld-t_label", fld).html(obj);
                                    console.log('asd');
                                    $.post("<?php echo base_url(); ?>ref_surat/get_selected/label/" + name +
                                        "/<?= $this->uri->segment(4) ?>", {},
                                        function(obj) {
                                            $(".fld-t_label", fld).val(obj);
                                        });
                                    $.post("<?php echo base_url(); ?>ref_surat/get_selected/value/" + name +
                                        "/<?= $this->uri->segment(4) ?>", {},
                                        function(obj) {
                                            $(".fld-t_value", fld).val(obj);
                                        });
                                });
                            }
                            if (lookup == 'database') {
                                $optionsField.prop("disabled", true);
                                $optionsWrap.hide();
                            } else if (lookup == 'costumize') {
                                $tableField.prop("disabled", true);
                                $tableWrap.hide();
                                $t_labelField.prop("disabled", true);
                                $t_labelWrap.hide();
                                $t_valueField.prop("disabled", true);
                                $t_valueWrap.hide();
                            } else {
                                $optionsField.prop("disabled", true);
                                $optionsWrap.hide();
                                $tableField.prop("disabled", true);
                                $tableWrap.hide();
                                $t_labelField.prop("disabled", true);
                                $t_labelWrap.hide();
                                $t_valueField.prop("disabled", true);
                                $t_valueWrap.hide();
                            }
                            fld.querySelector(".fld-lookup").onchange = function(e) {
                                var toggle = e.target.value === "database";
                                $tableField.prop("disabled", !toggle);
                                $tableWrap.toggle(toggle);
                                $t_labelField.prop("disabled", !toggle);
                                $t_labelWrap.toggle(toggle);
                                $t_valueField.prop("disabled", !toggle);
                                $t_valueWrap.toggle(toggle);
                                var toggle = e.target.value === "costumize";
                                $optionsField.prop("disabled", !toggle);
                                $optionsWrap.toggle(toggle);
                            };
                            fld.querySelector(".fld-table").onchange = function(e) {
                                var tabel = e.target.value;
                                $.post("<?php echo base_url(); ?>ref_surat/get_columnn/" + tabel, {}, function(obj) {
                                    $(".fld-t_value", fld).html(obj);
                                    $(".fld-t_label", fld).html(obj);
                                    // $t_labelField.target.value == obj;
                                    // console.log(options.typeUserAttrs.select.t_label.options);
                                    // options.typeUserAttrs.select.t_label.options=JSON.parse(obj);
                                    // console.log(options.typeUserAttrs.select.t_label.options);
                                });
                            };
                        }
                    },
                    'radio-group': {
                        onadd: function(fld) {
                            var $tableField = $(".fld-table", fld);
                            var $tableWrap = $tableField.parents(".table-wrap:eq(0)");
                            var $t_valueField = $(".fld-t_value", fld);
                            var $t_valueWrap = $t_valueField.parents(".t_value-wrap:eq(0)");
                            var $t_labelField = $(".fld-t_label", fld);
                            var $t_labelWrap = $t_labelField.parents(".t_label-wrap:eq(0)");
                            var $optionsField = $(".sortable-options", fld);
                            var $optionsWrap = $optionsField.parents(".field-options:eq(0)");
                            var tbl = $(".fld-table", fld).find(":selected").val();
                            var name = $(".fld-name", fld).val();
                            var lookup = $(".fld-lookup", fld).val();
                            if (tbl !== '') {
                                $.post("<?php echo base_url(); ?>ref_surat/get_columnn/" + tbl, {}, function(obj) {
                                    $(".fld-t_value", fld).html(obj);
                                    $(".fld-t_label", fld).html(obj);
                                    $.post("<?php echo base_url(); ?>ref_surat/get_selected/label/" + name, {},
                                        function(obj) {
                                            $(".fld-t_label", fld).val(obj);
                                        });
                                    $.post("<?php echo base_url(); ?>ref_surat/get_selected/value/" + name, {},
                                        function(obj) {
                                            $(".fld-t_value", fld).val(obj);
                                        });
                                });
                            }
                            if (lookup == 'database') {
                                $optionsField.prop("disabled", true);
                                $optionsWrap.hide();
                            } else if (lookup == 'costumize') {
                                $tableField.prop("disabled", true);
                                $tableWrap.hide();
                                $t_labelField.prop("disabled", true);
                                $t_labelWrap.hide();
                                $t_valueField.prop("disabled", true);
                                $t_valueWrap.hide();
                            } else {
                                $optionsField.prop("disabled", true);
                                $optionsWrap.hide();
                                $tableField.prop("disabled", true);
                                $tableWrap.hide();
                                $t_labelField.prop("disabled", true);
                                $t_labelWrap.hide();
                                $t_valueField.prop("disabled", true);
                                $t_valueWrap.hide();
                            }
                            fld.querySelector(".fld-lookup").onchange = function(e) {
                                var toggle = e.target.value === "database";
                                $tableField.prop("disabled", !toggle);
                                $tableWrap.toggle(toggle);
                                $t_labelField.prop("disabled", !toggle);
                                $t_labelWrap.toggle(toggle);
                                $t_valueField.prop("disabled", !toggle);
                                $t_valueWrap.toggle(toggle);
                                var toggle = e.target.value === "costumize";
                                $optionsField.prop("disabled", !toggle);
                                $optionsWrap.toggle(toggle);
                            };
                            fld.querySelector(".fld-table").onchange = function(e) {
                                var tabel = e.target.value;
                                $.post("<?php echo base_url(); ?>ref_surat/get_columnn/" + tabel, {}, function(obj) {
                                    $(".fld-t_value", fld).html(obj);
                                    $(".fld-t_label", fld).html(obj);
                                    // $t_labelField.target.value == obj;
                                    // console.log(options.typeUserAttrs.select.t_label.options);
                                    // options.typeUserAttrs.select.t_label.options=JSON.parse(obj);
                                    // console.log(options.typeUserAttrs.select.t_label.options);
                                });
                            };
                        }
                    },
                    'checkbox-group': {
                        onadd: function(fld) {
                            var $tableField = $(".fld-table", fld);
                            var $tableWrap = $tableField.parents(".table-wrap:eq(0)");
                            var $t_valueField = $(".fld-t_value", fld);
                            var $t_valueWrap = $t_valueField.parents(".t_value-wrap:eq(0)");
                            var $t_labelField = $(".fld-t_label", fld);
                            var $t_labelWrap = $t_labelField.parents(".t_label-wrap:eq(0)");
                            var $optionsField = $(".sortable-options", fld);
                            var $optionsWrap = $optionsField.parents(".field-options:eq(0)");
                            var tbl = $(".fld-table", fld).find(":selected").val();
                            var name = $(".fld-name", fld).val();
                            var lookup = $(".fld-lookup", fld).val();
                            if (tbl !== '') {
                                $.post("<?php echo base_url(); ?>ref_surat/get_columnn/" + tbl, {}, function(obj) {
                                    $(".fld-t_value", fld).html(obj);
                                    $(".fld-t_label", fld).html(obj);
                                    $.post("<?php echo base_url(); ?>ref_surat/get_selected/label/" + name, {},
                                        function(obj) {
                                            $(".fld-t_label", fld).val(obj);
                                        });
                                    $.post("<?php echo base_url(); ?>ref_surat/get_selected/value/" + name, {},
                                        function(obj) {
                                            $(".fld-t_value", fld).val(obj);
                                        });
                                });
                            }
                            if (lookup == 'database') {
                                $optionsField.prop("disabled", true);
                                $optionsWrap.hide();
                            } else if (lookup == 'costumize') {
                                $tableField.prop("disabled", true);
                                $tableWrap.hide();
                                $t_labelField.prop("disabled", true);
                                $t_labelWrap.hide();
                                $t_valueField.prop("disabled", true);
                                $t_valueWrap.hide();
                            } else {
                                $optionsField.prop("disabled", true);
                                $optionsWrap.hide();
                                $tableField.prop("disabled", true);
                                $tableWrap.hide();
                                $t_labelField.prop("disabled", true);
                                $t_labelWrap.hide();
                                $t_valueField.prop("disabled", true);
                                $t_valueWrap.hide();
                            }
                            fld.querySelector(".fld-lookup").onchange = function(e) {
                                var toggle = e.target.value === "database";
                                $tableField.prop("disabled", !toggle);
                                $tableWrap.toggle(toggle);
                                $t_labelField.prop("disabled", !toggle);
                                $t_labelWrap.toggle(toggle);
                                $t_valueField.prop("disabled", !toggle);
                                $t_valueWrap.toggle(toggle);
                                var toggle = e.target.value === "costumize";
                                $optionsField.prop("disabled", !toggle);
                                $optionsWrap.toggle(toggle);
                            };
                            fld.querySelector(".fld-table").onchange = function(e) {
                                var tabel = e.target.value;
                                $.post("<?php echo base_url(); ?>ref_surat/get_columnn/" + tabel, {}, function(obj) {
                                    $(".fld-t_value", fld).html(obj);
                                    $(".fld-t_label", fld).html(obj);
                                    // $t_labelField.target.value == obj;
                                    // console.log(options.typeUserAttrs.select.t_label.options);
                                    // options.typeUserAttrs.select.t_label.options=JSON.parse(obj);
                                    // console.log(options.typeUserAttrs.select.t_label.options);
                                });
                            };
                        }
                    }
                }
            };
        <?php
        if (isset($fields)) {
            ?>
                var formData = '[<?php echo $fields; ?>]';
                <?php
        } else {
            ?>
                var formData = '';
                <?php
        }
        ?>

        var formBuilder = $(fbEditor).formBuilder(options);
        formBuilder.promise.then(formBuilder => {
            setInterval(function() {
                // let dform = formBuilder.actions.getData('json', true);
            }, 1000);
        });

        function push() {
            $(".select-field .field-options").css("display", "none");
            $.post("<?= base_url('ref_surat/get_db') ?>", function(data) {
                $(".select-field .form-elements").append(data);
            });
        }

        function sinkronForm() {
            var id = $('#sinkron_formulir').val();
            if (id !== '') {
                $("#sinkron_formulir").attr("disabled", "disabled");
                $.post("<?php echo base_url(); ?>ref_surat/json_output/" + id, {}, function(obj) {
                    formBuilder.actions.setData(obj);
                    $("#sinkron_formulir").removeAttr("disabled", "disabled");
                });
            } else {
                formBuilder.actions.setData('');
            }
        }

        function getExist() {
            var data = $('#data').val();
            var id = $('#exist').val();
            $("#exist").attr("disabled", "disabled");
            $.post("<?php echo base_url(); ?>ref_surat/json_input/" + id, {
                data: data
            }, function(obj) {
                formBuilder.actions.setData(obj);
                $("#exist").removeAttr("disabled", "disabled");
                $('#exist').val('');
                // alert(obj);
            });
        }

        $(document).ready(function() {
            formBuilder.promise.then(formBuilder => {

                $('button[type=submit]').hide();
                <?php
                if (isset($fields)) {
                    ?>
                        formBuilder.actions.setData(formData);
                        <?php
                } ?>

            });
        });
        </script>
<?php } elseif ((($this->uri->segment('1') == "ref_surat") && ($this->uri->segment('2') == "detail")) || ($this->uri->segment('2') == "tambah_surat_keluar") || ($this->uri->segment('2') == "tambah_surat_masuk")) {
    ?>
        <script type="text/javascript">
        $(document).ready(function() {
            <?php
            foreach ($fe as $f) {
                if (!empty($f->re_r_value)) {
                    ?>
                            $("[name='<?= $f->re_r_value ?>'").change(function() {
                                var reference_value = $("[name='<?= $f->re_r_value ?>'").val();
                                <?php
                                $detail = $this->ref_surat_model->get_field_with_event_detail($f->id_ref_surat, $f->re_r_value, $f->re_event);
                                foreach ($detail as $d) {
                                    ?>
                                        $("[name='<?= $d->field_name ?>'").val('');
                                        $.post("<?php echo base_url(); ?>ref_surat/get_reference/<?= $f->reference_field ?>/" +
                                            reference_value + "/<?= $d->re_table ?>/<?= $d->re_value ?>", {},
                                            function(obj) {
                                                $("[name='<?= $d->field_name ?>'").val(obj);
                                            });

                                        <?php
                                }
                                ?>

                            });
                    <?php }
            } ?>
        });
        </script>
        <?php
} ?>

<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/widget.js"></script>

<?php if ($this->uri->segment(1) == "admin"): ?>
        <script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/dashboard1.js"></script>
<?php else: ?>
        <script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/chat.js"></script>
<?php endif; ?>

<?php if ($this->uri->segment(1) == "dashboard_user"): ?>
        <script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/dashboard1.js"></script>
<?php else: ?>
        <script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/chat.js"></script>
<?php endif; ?>



<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/switchery/dist/switchery.min.js">
</script>

<?php if ($this->router->fetch_class() != 'simpeg' or $this->router->fetch_class() == 'auditor') { ?>


        <?php
        // if first segment is naskah
        // if ($this->uri->segment(1) == 'naskah') {
        ?>
                      <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
                    <?php
                    // } else {
                    ?><script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/custom-select/custom-select.min.js"
                                type="text/javascript"></script>
                    <?php
        // }
    ?>
<?php } ?>
<!-- <script src="https://select2.github.io/select2/select2-3.5.3/select2.js?ts=2015-08-29T20%3A09%3A48%2B00%3A00" type="text/javascript"></script> -->

<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/footable/js/footable.all.min.js">
</script>
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-select/bootstrap-select.min.js"
    type="text/javascript"></script>
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js">
</script>
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"
    type="text/javascript"></script>
<script type="text/javascript"
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/multiselect/js/jquery.multi-select.js">
</script>
<script type="text/javascript"
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/multiselect/js/jquery.quicksearch.js">
</script>

<script
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js">
</script>
<!-- Color Picker Plugin JavaScript -->
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js">
</script>
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js">
</script>
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js">
</script>
<!-- Date Picker Plugin JavaScript -->
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js">
</script>
<!-- Date range Plugin JavaScript -->
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/timepicker/bootstrap-timepicker.min.js">
</script>
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js">
</script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/nestable/jquery.nestable.js"></script>

<!-- Calendar JavaScript -->
<?php if ($this->uri->segment(1) == "manage_todolist"): ?>
        <script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/calendar/jquery-ui.min.js"></script>
<?php endif; ?>

<script src='<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/calendar/dist/fullcalendar.min.js'>
</script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/calendar/dist/jquery.fullcalendar.js">
</script>

<!-- EASY PIE CHART JS -->
<script
    src='<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js'>
</script>
<script
    src='<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/jquery.easy-pie-chart/easy-pie-chart.init.js'>
</script>






<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
jQuery(document).ready(function() {
    // Switchery
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function() {
        new Switchery($(this)[0], $(this).data());

    });

    $('.js-switch2').each(function() {
        var elem = $(this)[0];
        var init = new Switchery(elem, {
            color: '#6003c8'
        });


        if (elem.checked == true) {

            $(elem).siblings(".switchery").css("width", "100px").prepend("<span>Terima</span>").find(
                "small").css("left", "70px");
            $(elem).siblings(".switchery").find("span").text('Terima').css('float', 'left').css('color',
                '#fff');
            $(elem).siblings(".switchery").find("small").html('<i class="ti-check"></i>');
        } else {

            $(elem).siblings(".switchery").css("width", "100px").prepend("<span>Tolak</span>");
            $(elem).siblings(".switchery").find("span").text('Tolak').css('float', 'right').css('color',
                '#6003c8');;
            $(elem).siblings(".switchery").find("small").html('<i class="ti-close"></i>');
        }

        elem.onchange = function(e) {
            var catatan = $(elem).parent().next('td').find('input');
            if (elem.checked == true) {
                $(elem).siblings(".switchery").find("span").text('Terima').css('float', 'left').css(
                    'color', '#fff');
                $(elem).siblings(".switchery").find("small").html('<i class="ti-check"></i>');
                $(catatan).attr('disabled', 'disabled');
            } else {
                $(elem).siblings(".switchery").find("span").text('Tolak').css('float', 'right').css(
                    'color', '#6003c8');;
                $(elem).siblings(".switchery").find("small").html('<i class="ti-close"></i>');
                $(catatan).removeAttr('disabled');
            }
        };


    });


    $('.js-switch3').each(function() {
        var elem = $(this)[0];
        var init = new Switchery(elem, {
            color: '#6003c8'
        });


        if (elem.checked == true) {

            $(elem).siblings(".switchery").css("width", "200px").prepend("<span>Dijadwalkan</span>")
                .find("small").css("left", "70px");
            $(elem).siblings(".switchery").find("span").text('Dijadwalkan').css('float', 'left').css(
                'color', '#fff');
            $(elem).siblings(".switchery").find("small").html('<i class="ti-check"></i>');
        } else {

            $(elem).siblings(".switchery").css("width", "200px").prepend(
                "<span>Tidak Dijadwalkan</span>");
            $(elem).siblings(".switchery").find("span").text('Tidak Dijadwalkan').css('float', 'right')
                .css('color', '#6003c8');;
            $(elem).siblings(".switchery").find("small").html('<i class="ti-close"></i>');
        }

        elem.onchange = function(e) {
            var catatan = $(elem).parent().next('td').find('input');
            if (elem.checked == true) {
                $(elem).siblings(".switchery").find("span").text('Dijadwalkan').css('float', 'left')
                    .css('color', '#fff');
                $(elem).siblings(".switchery").find("small").html('<i class="ti-check"></i>');
                $(catatan).removeAttr('disabled');
            } else {
                $(elem).siblings(".switchery").find("span").text('Tidak Dijadwalkan').css('float',
                    'right').css('color', '#6003c8');;
                $(elem).siblings(".switchery").find("small").html('<i class="ti-close"></i>');
                $(catatan).attr('disabled', 'disabled');
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
        selectableHeader: "<input type='text' style='margin-bottom:10px' class='search-input form-control' autocomplete='off' placeholder='Cari Penerima ... '>",
        selectionHeader: "<input type='text' style='margin-bottom:10px' class='search-input form-control' autocomplete='off' placeholder='Cari Penerima ...'>",
        afterInit: function(ms) {
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#' + that.$container.attr('id') +
                ' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#' + that.$container.attr('id') +
                ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function(e) {
                    if (e.which === 40) {
                        that.$selectableUl.focus();
                        return false;
                    }
                });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function(e) {
                    if (e.which == 40) {
                        that.$selectionUl.focus();
                        return false;
                    }
                });
        },
        afterSelect: function() {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function() {
            this.qs1.cache();
            this.qs2.cache();
        }
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

    /*----- BEGIN OF PAGINATION */

    if (typeof loadPagination === "function") {
        loadPagination(1);
    }

    var pagination = document.getElementById("pagination");
    if (pagination) {
        $('#pagination').on('click', 'a', function(e) {
            e.preventDefault();
            var pageno = $(this).attr('data-ci-pagination-page');
            if (typeof loadPagination === "function") {
                loadPagination(pageno);
            }
        });

    }

    if (typeof loadPagination2 === "function") {
        loadPagination2(1);
    }

    var pagination2 = document.getElementById("pagination2");
    if (pagination) {
        $('#pagination2').on('click', 'a', function(e) {
            e.preventDefault();
            var pageno = $(this).attr('data-ci-pagination-page');
            if (typeof loadPagination2 === "function") {
                loadPagination2(pageno);
            }
        });

    }



    /*----- END OF PAGINATION */

    // checkall
    $('#check_all').click(function() {
        if (this.checked) {
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
    if (!empty($this->session->flashdata('success'))) {
        echo '
				swal("Sukses", "' . $this->session->flashdata('success') . '", "success");
				';
    }
    if (!empty($this->session->flashdata('error'))) {
        echo '
				swal("Error", "' . $this->session->flashdata('error') . '", "error");
				';
    }
    ?>

});
</script>


<!-- jQuery file upload -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/dropify/dist/js/dropify.min.js">
</script>
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
// if (/mobile/i.test(navigator.userAgent)) {
// 	$('input').prop('readOnly', true);
// }
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
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/styleswitcher/jQuery.style.switcher.js">
</script>

<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/toast-master/js/jquery.toast.js">
</script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/blockUI/jquery.blockUI.js"></script>

<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/html5-editor/wysihtml5-0.3.0.js">
</script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/html5-editor/bootstrap-wysihtml5.js">
</script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/inputmask/dist/jquery.inputmask.js">
</script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/push.js/bin/push.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/push.js/bin/serviceWorker.min.js">
</script>
<script type="text/javascript">
// $('input[name="nomer_surat"]').inputmask("9-a{1,3}9{1,3}");
</script>
<script src="<?= base_url() ?>/socket/node_modules/socket.io-client/dist/socket.io.js"></script>
<script type="text/javascript">
var base_url = '<?= base_url() ?>';
var server_url = '<?= $_SERVER['HTTP_HOST'] ?>';
var user_id = '<?= $this->session->userdata('user_id') ?>';
// $('a[href="<?php echo base_url(); ?>surat_internal/verifikasi_surat"]').append('<span class="label label-rouded label-primary pull-right">12</span>');
// alert($('.count[href="<?php echo base_url(); ?>surat_internal/verifikasi_surat"]').html());
function refresh_notification() {
    // $.get(base_url + 'pemberitahuan/fetch_count', function(res) {
    // 	var res = JSON.parse(res);
    // 	$.each(res, function(k, v) {
    // 		var navbar = $('.count[href="<?php echo base_url(); ?>' + k + '"]');
    // 		if (v > 0) {
    // 			if (navbar.find('span').length > 0) {
    // 				navbar.find('span').html(v);
    // 			} else {
    // 				navbar.append('<span id="' + k + '" class="label label-rouded label-primary pull-right">' + v + '</span>');
    // 			}
    // 		} else {
    // 			if (navbar.find('span').length > 0) {
    // 				$('.count[href="<?php echo base_url(); ?>' + k + '"] span').remove();
    // 			}
    // 		}
    // 	});
    // });
    $.get(base_url + 'pemberitahuan/fetch_some_unread', function(res) {
        var res = JSON.parse(res);
        if (res.status) {
            $('#notif_bubble').show();
            $('#notification_list').html('');
            $.each(res.data, function() {
                $('#notification_list').append('<li> <div class="message-center"> <a href="' + this
                    .link + '"><div class="mail-contnet"> <h5>' + this.title +
                    '</h5> <span class="mail-desc">' + this.message +
                    '</span> <span class="time">' + this.time + '</span> </div></a> </div></li>');
            });
        } else {
            $('#notif_bubble').hide();
            $('#notification_list').html(
                '<li id="notif_none"> <div class="message-center"> <div class="mail-contnet" style="padding: 10px;text-align: center;"> <i style="color: #6003c8; font-size: 30px;" class="text-primary icon-hourglass"></i> <p>Tidak ada pemberitahuan terbaru</p></div></div></li>'
            );
        }
        $('#notification_list').append(
            ' <li class="read-more"> <a style="padding: 5px" class="text-center" href="' + base_url +
            'pemberitahuan">Lihat semua pemberitahuan <i class="ti-arrow-circle-right"></i> </a> </li>');
    });

    <?php
    if ($this->uri->segment(1) == "pemberitahuan") {
        ?>
            $.get(base_url + 'pemberitahuan/fetch_all', function(res) {
                var res = JSON.parse(res);
                if (res.status) {
                    $('#all_notification_list').html('');
                    $.each(res.data, function() {
                        if (this.read_status == "1") {
                            var read_class = '';
                            var btn_class = ' btn-outline';
                        } else {
                            var read_class = ' read';
                            var btn_class = '';
                        }
                        $('#all_notification_list').append(
                            '<li style="margin-top: 5px;position: relative;"> <div style="padding-left: 5px" class="message-center' +
                            read_class + '"> <a href="' + this.link + '"><div class="mail-contnet"> <h5>' +
                            this.title + '</h5> <span class="mail-desc">' + this.message +
                            '</span> <span class="time">' + this.time +
                            '</span> </div></a> <div class="btn-group" style="position: absolute;top: 0;right: 0;margin-top: 5px;margin-right: 5px"> <button aria-expanded="false" data-toggle="dropdown" class="btn btn-circle' +
                            btn_class +
                            ' btn-primary dropdown-toggle waves-effect waves-light" type="button"> <i class="icon-options"></i></button> <ul role="menu" class="dropdown-menu pull-right"> <li><a href="javasciprt:void(0)" onclick="showModalDelete(\'' +
                            this.notification_id + '\')">Hapus Notifikasi</a></li></ul> </div></div></li>');
                    });
                } else {
                    $('#all_notification_list').html(
                        '<li id="notif_none"> <div class="message-center"> <div class="mail-contnet" style="padding: 10px;text-align: center;"> <i style="color: #6003c8; font-size: 30px;" class="text-primary icon-hourglass"></i> <p>Tidak ada pemberitahuan</p></div></div></li>'
                    );
                }
            });
    <?php } ?>
}
$(document).ready(function() {
    // refresh_notification();
});
// id collapse-menu click function 
$('#collapse-menu').click(function() {
    // refresh_notification();
    // alert('test');
});

</script>
<script src="<?= base_url() ?>/socket/client_socket.js?v=1.5"></script>

<script>
$(document).ready(function() {
    $(".textarea_editor").each(function() {
        $(this).wysihtml5();
    });

    // var audio = new Audio('<?= base_url() ?>/socket/definite.mp3');
    // audio.play();

});
</script>





<script src="<?php echo base_url() . "asset/pixel/plugins/bower_components/datatables/"; ?>jquery.dataTables.min.js">
</script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<?php
if ($this->uri->segment(1) == "kegiatan" && $this->uri->segment(2) == "add") {
    ?>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#tableAnggota').on('click', '.del-anggota', function() {
                var count = $('#tableAnggota tbody tr').length;
                if (count > 1) {
                    $(this).closest('tr').remove();
                } else {
                    return false;
                }
            });
            $('#tableAnggota').on('change', '.id_pegawai', function() {
                var ketua = $('#id_ketua_tim').val();
                var id = $(this).val();
                if (ketua == id) {
                    $(this).val('');
                    $(this).trigger('change');
                    swal('Peringatan', 'Pegawai ini sudah terdaftar sebagai Ketua Tim', 'warning');
                } else {
                    var array = [];
                    $(".id_pegawai").each(function(index) {
                        array.push($(this).val());
                    });
                    var check = (new Set(array)).size !== array.length;
                    if (check) {
                        $(this).val('');
                        $(this).trigger('change');
                        $(this).select2('val', '');
                        swal('Peringatan', 'Pegawai ini sudah terdaftar sebagai Anggota Tim', 'warning');
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

    <?php if ($this->uri->segment(2) == 'quick_view' || $this->uri->segment(1) == 'quick_view') {
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
            $('#quick_table thead tr:eq(1) th').each(function(i) {
                var title = $('#quick_table thead tr:eq(0) th').eq($(this).index()).text();
                if (i != 0 && i != 4) {
                    $(this).html('<input class="form-control" type="text" placeholder="Cari ' + title + '" />');
                } else if (i == 4) {
                    $(this).html(
                        '<a href="javascript:void(0)" class="btn btn-primary" onclick="export_filtered()" data-toggle="tooltip" title="Unduh hasil telusur"><i class="ti-export"></i> Export</a>'
                    );
                }
            });

            // DataTable
            window.table = $('#quick_table').DataTable({
                orderCellsTop: true
            });

            // Apply the search
            table.columns().every(function(index) {
                var that = this;

                $('#quick_table thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });


            table.column(1).every(function(index) {

                var column = this;
                var select = $(
                        '<select class="form-control"><option value="">Cari Unit Kerja</option></select>')
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


    $('#tableSimple').DataTable({
        "searching": false,
        "lengthChange": false,
        "ordering": false
    });

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
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' +
                            group + '</td></tr>');
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
    "order": [
        [0, "asc"]
    ],
    buttons: [
        'excel', 'pdf', 'print'
    ]
});
$('#inovasi1').DataTable({
    dom: 'Bfrtip',
    "order": [
        [0, "asc"]
    ],
    buttons: [
        'excel', 'pdf', 'print'
    ]
});
$('#inovasi5').DataTable({
    dom: 'Bfrtip',
    "order": [
        [0, "asc"]
    ],
    buttons: [
        'excel', 'pdf', 'print'
    ]
});
$('#inovasi3').DataTable({
    dom: 'Bfrtip',
    "order": [
        [0, "asc"]
    ],
    buttons: [
        'excel', 'pdf', 'print'
    ]
});
$('#inovasi4').DataTable({
    dom: 'Bfrtip',
    "order": [
        [0, "asc"]
    ],
    buttons: [
        'excel', 'pdf', 'print'
    ]
});


$('#example99').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'excel', 'pdf', 'print', 'csv'
    ]
});



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
</script>

<?php if ($this->uri->segment(1) == 'kinerja_pegawai') { ?>
        <script type="text/javascript">
        $(document).ready(function() {

            var ctx1 = document.getElementById("chart1").getContext("2d");
            var data1 = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
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
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.005)",
                scaleGridLineWidth: 0,
                scaleShowHorizontalLines: true,
                scaleShowVerticalLines: true,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 2,
                datasetStroke: true,
                tooltipCornerRadius: 2,
                datasetStrokeWidth: 2,
                datasetFill: true,
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                responsive: true
            });

        });
        </script>
<?php } ?>

<script type="text/javascript"
    src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/orgchart/orgchart.js"></script>
<script type="text/javascript">
var base_url = "<?= base_url() ?>";
</script>
<script>
$(document).ready(function() {
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
$(function() {
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
});
</script>
<!-- Flot Charts JavaScript -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/flot/excanvas.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/flot/jquery.flot.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/flot/jquery.flot.resize.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/flot/jquery.flot.time.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/flot/jquery.flot.stack.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/flot/jquery.flot.crosshair.js"></script>
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js">
</script>
<!-- <script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>js/flot-data.js"></script> -->

<!-- chartJs with PluginJs -->
<script type="text/javascript">
! function($) {
    "use strict";

    var EasyPieChart = function() {};

    EasyPieChart.prototype.init = function() {
            //initializing various types of easy pie charts
            $('.easy-pie-chart-1').easyPieChart({
                easing: 'easeOutBounce',
                barColor: '#13dafe',
                lineWidth: 3,
                animate: 1000,
                lineCap: 'square',
                trackColor: '#e5e5e5',
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
            $('.easy-pie-chart-2').easyPieChart({
                easing: 'easeOutBounce',
                barColor: '#99d683',
                lineWidth: 3,
                trackColor: false,
                lineCap: 'butt',
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
            $('.easy-pie-chart-3').easyPieChart({
                easing: 'easeOutBounce',
                barColor: '#6164c1',
                lineWidth: 3,
                lineCap: 'square',
                trackColor: false,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
            $('.easy-pie-chart-4').easyPieChart({
                easing: 'easeOutBounce',
                barColor: '#13dafe',
                lineWidth: 3,
                scaleColor: false,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
            $('.easy-pie-chart-5').easyPieChart({
                easing: 'easeOutBounce',
                barColor: '#99d683',
                lineWidth: 3,
                scaleColor: false,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
            $('.easy-pie-chart-6').easyPieChart({
                easing: 'easeOutBounce',
                barColor: '#6164c1',
                lineWidth: 3,
                scaleColor: false,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        },
        //init
        $.EasyPieChart = new EasyPieChart, $.EasyPieChart.Constructor = EasyPieChart
}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.EasyPieChart.init()
}(window.jQuery);
</script>
<!-- Bootstrap Datetime Picker -->
<script src="<?php echo base_url() . "assets/js"; ?>/bootstrap-datetime-picker.js"></script>
<!--Style Switcher -->
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/styleswitcher/jQuery.style.switcher.js">
</script>
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
<script>
$('#files_laporan_rapat').change(function() {
    var i = $(this).prev('a').clone();
    var file = $('#files_laporan_rapat')[0].files[0].name;
    $(this).prev('a').text(file);
});
</script>
<script>
$("#file_respons").change(function() {
    $("#name_file").text(this.files[0].name);
});
</script>
<script>
$("#files_laporan_rapat").change(function() {
    $("#files_laporan_rapat_new").text(this.files[0].name);
    $("#files_laporan_rapat_old").hide();
});
</script>
<!-- Details Kepegawaian -->
<script>
$(document).ready(function() {
    $("#form_riwayat_pangkat").hide();
    $("#tambah_riwayat_pangkat").click(function() {
        $("#table_riwayat_pangkat").hide();
        $("#form_riwayat_pangkat").show();
    });
    $("#lihat_riwayat_pangkat").click(function() {
        $("#table_riwayat_pangkat").show();
        $("#form_riwayat_pangkat").hide();
    });
});
$(document).ready(function() {
    $("#form_riwayat_jabatan").hide();
    $("#tambah_riwayat_jabatan").click(function() {
        $("#table_riwayat_jabatan").hide();
        $("#form_riwayat_jabatan").show();
    });
    $("#lihat_riwayat_jabatan").click(function() {
        $("#table_riwayat_jabatan").show();
        $("#form_riwayat_jabatan").hide();
    });
});
$(document).ready(function() {
    $("#form_riwayat_pendidikan").hide();
    $("#tambah_riwayat_pendidikan").click(function() {
        $("#table_riwayat_pendidikan").hide();
        $("#form_riwayat_pendidikan").show();
    });
    $("#lihat_riwayat_pendidikan").click(function() {
        $("#table_riwayat_pendidikan").show();
        $("#form_riwayat_pendidikan").hide();
    });
});
$(document).ready(function() {
    $("#form_riwayat_diklat").hide();
    $("#tambah_riwayat_diklat").click(function() {
        $("#table_riwayat_diklat").hide();
        $("#form_riwayat_diklat").show();
    });
    $("#lihat_riwayat_diklat").click(function() {
        $("#table_riwayat_diklat").show();
        $("#form_riwayat_diklat").hide();
    });
    $("#form_riwayat_penataran").hide();
    $("#tambah_riwayat_penataran").click(function() {
        $("#table_riwayat_penataran").hide();
        $("#form_riwayat_penataran").show();
    });
    $("#lihat_riwayat_penataran").click(function() {
        $("#table_riwayat_penataran").show();
        $("#form_riwayat_penataran").hide();
    });
    $("#form_riwayat_seminar").hide();
    $("#tambah_riwayat_seminar").click(function() {
        $("#table_riwayat_seminar").hide();
        $("#form_riwayat_seminar").show();
    });
    $("#lihat_riwayat_seminar").click(function() {
        $("#table_riwayat_seminar").show();
        $("#form_riwayat_seminar").hide();
    });
    $("#form_riwayat_kursus").hide();
    $("#tambah_riwayat_kursus").click(function() {
        $("#table_riwayat_kursus").hide();
        $("#form_riwayat_kursus").show();
    });
    $("#lihat_riwayat_kursus").click(function() {
        $("#table_riwayat_kursus").show();
        $("#form_riwayat_kursus").hide();
    });
    $("#form_riwayat_unit_kerja").hide();
    $("#tambah_riwayat_unit_kerja").click(function() {
        $("#table_riwayat_unit_kerja").hide();
        $("#form_riwayat_unit_kerja").show();
    });
    $("#lihat_riwayat_unit_kerja").click(function() {
        $("#table_riwayat_unit_kerja").show();
        $("#form_riwayat_unit_kerja").hide();
    });
    $("#form_riwayat_penghargaan").hide();
    $("#tambah_riwayat_penghargaan").click(function() {
        $("#table_riwayat_penghargaan").hide();
        $("#form_riwayat_penghargaan").show();
    });
    $("#lihat_riwayat_penghargaan").click(function() {
        $("#table_riwayat_penghargaan").show();
        $("#form_riwayat_penghargaan").hide();
    });
    $("#form_riwayat_penugasan").hide();
    $("#tambah_riwayat_penugasan").click(function() {
        $("#table_riwayat_penugasan").hide();
        $("#form_riwayat_penugasan").show();
    });
    $("#lihat_riwayat_penugasan").click(function() {
        $("#table_riwayat_penugasan").show();
        $("#form_riwayat_penugasan").hide();
    });
    $("#form_riwayat_cuti").hide();
    $("#tambah_riwayat_cuti").click(function() {
        $("#table_riwayat_cuti").hide();
        $("#form_riwayat_cuti").show();
    });
    $("#lihat_riwayat_cuti").click(function() {
        $("#table_riwayat_cuti").show();
        $("#form_riwayat_cuti").hide();
    });
    $("#form_riwayat_hukuman").hide();
    $("#tambah_riwayat_hukuman").click(function() {
        $("#table_riwayat_hukuman").hide();
        $("#form_riwayat_hukuman").show();
    });
    $("#lihat_riwayat_hukuman").click(function() {
        $("#table_riwayat_hukuman").show();
        $("#form_riwayat_hukuman").hide();
    });
    $("#form_riwayat_bahasa").hide();
    $("#tambah_riwayat_bahasa").click(function() {
        $("#table_riwayat_bahasa").hide();
        $("#form_riwayat_bahasa").show();
    });
    $("#lihat_riwayat_bahasa").click(function() {
        $("#table_riwayat_bahasa").show();
        $("#form_riwayat_bahasa").hide();
    });
    $("#form_riwayat_bahasa_asing").hide();
    $("#tambah_riwayat_bahasa_asing").click(function() {
        $("#table_riwayat_bahasa_asing").hide();
        $("#form_riwayat_bahasa_asing").show();
    });
    $("#lihat_riwayat_bahasa_asing").click(function() {
        $("#table_riwayat_bahasa_asing").show();
        $("#form_riwayat_bahasa_asing").hide();
    });
    $("#form_riwayat_pernikahan").hide();
    $("#tambah_riwayat_pernikahan").click(function() {
        $("#table_riwayat_pernikahan").hide();
        $("#form_riwayat_pernikahan").show();
    });
    $("#lihat_riwayat_pernikahan").click(function() {
        $("#table_riwayat_pernikahan").show();
        $("#form_riwayat_pernikahan").hide();
    });
    $("#form_riwayat_anak").hide();
    $("#tambah_riwayat_anak").click(function() {
        $("#table_riwayat_anak").hide();
        $("#form_riwayat_anak").show();
    });
    $("#lihat_riwayat_anak").click(function() {
        $("#table_riwayat_anak").show();
        $("#form_riwayat_anak").hide();
    });
    $("#form_riwayat_orangtua").hide();
    $("#tambah_riwayat_orangtua").click(function() {
        $("#table_riwayat_orangtua").hide();
        $("#form_riwayat_orangtua").show();
    });
    $("#lihat_riwayat_orangtua").click(function() {
        $("#table_riwayat_orangtua").show();
        $("#form_riwayat_orangtua").hide();
    });
    $("#form_riwayat_mertua").hide();
    $("#tambah_riwayat_mertua").click(function() {
        $("#table_riwayat_mertua").hide();
        $("#form_riwayat_mertua").show();
    });
    $("#lihat_riwayat_mertua").click(function() {
        $("#table_riwayat_mertua").show();
        $("#form_riwayat_mertua").hide();
    });
    // edit
    $("#form_biodata").hide();
    $("#edit_biodata").click(function() {
        $("#list_biodata").hide();
        $("#form_biodata").show();
    });
    $("#lihat_biodata").click(function() {
        $("#list_biodata").show();
        $("#form_biodata").hide();
    });
});

function getJabatan() {
    var jenis_jabatan = $("#jenis_jabatan").val();
    if (jenis_jabatan == 1) {
        $("#id_eselon").attr("disabled", false);
    } else {
        $("#id_eselon").attr("disabled", true);
        $("#id_eselon").val("");
    }
    if (jenis_jabatan == "") $("#jab_level1").html("<option value=''>Pilih</option>");
}

function current_histoty(self, target) {
    var val = $("#" + self).val();
    if (val == 0) {
        $("#" + self).val(1);
        $("#" + target).attr('disabled', true);
        $("#" + target).val(1111 - 11 - 11);
    } else if (val == 1) {
        $("#" + self).val(0);
        $("#" + target).attr('disabled', false);
    }
}
// <!-- Form -->
var arrGol = new Array;
var id_pegawai_upload = "";
var id_riwayat_upload = "";
var jenis_riwayat_upload = "";
<?php
if (isset($golongan)) {
    foreach ($golongan as $row) {
        ?>
                arrGol[<?= $row->id_golongan; ?>] = new Array("<?= $row->pangkat; ?>", "<?= $row->golongan; ?>");

                <?php
    }
}
?>
$('#id_kabupaten').prop('disabled', 'disabled');
$('#id_kecamatan').prop('disabled', 'disabled');
$('#id_desa').prop('disabled', 'disabled');

function setGol() {
    var id_gol = $("#id_golongan").val();
    var golongan = arrGol[id_gol][1];
    $("#txt_golongan").val(golongan);
}

function getKabupaten() {
    var id = $('#id_provinsi').val();
    $('#id_kabupaten').prop('disabled', false);
    $('#id_desa').html('<option value="">Pilih</option>');
    $('#id_kecamatan').html('<option value="">Pilih</option>');
    $.post("https://e-office.sumedangkab.go.id/dashboard_user/get_kabupaten/" + id, {}, function(obj) {
        $('#id_kabupaten').html(obj);
    });

}

function getKecamatan() {
    var id = $('#id_kabupaten').val();
    $('#id_kecamatan').prop('disabled', false);
    $('#id_desa').html('<option value="">Pilih</option>');
    $.post("https://e-office.sumedangkab.go.id/dashboard_user/get_kecamatan/" + id, {}, function(obj) {
        $('#id_kecamatan').html(obj);
    });

}

function getDesa() {
    var id = $('#id_kecamatan').val();
    $('#id_desa').prop('disabled', false);
    $.post("https://e-office.sumedangkab.go.id/dashboard_user/get_desa/" + id, {}, function(obj) {
        $('#id_desa').html(obj);
    });
}

<?php
if ($this->uri->segment(1) == 'verifikasi_data_pegawai') {
    ?>
        var url = window.location.href;
        var activeTab = url.substring(url.indexOf("#") + 1);
        $(".tab-pane").removeClass("active in");
        $(".tanda").removeClass("active");
        $("#" + activeTab).addClass("active in");
        $("#tabs-active" + activeTab).addClass("active");
        $('a[href="#' + activeTab + '"]').tab('show')
<?php } ?>
</script>
<script type="text/javascript"
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/tableExport/libs/FileSaver/FileSaver.min.js">
</script>
<script type="text/javascript"
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/tableExport/libs/js-xlsx/xlsx.core.min.js">
</script>
<script type="text/javascript"
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/tableExport/tableExport.min.js"></script>

<script type="text/javascript">
function downloadExcel(id, filename) {
    $('#' + id).tableExport({
        type: 'excel',
        fileName: filename,
        mso: {
            fileFormat: 'xlshtml',
            styles: ['background-color',
                'border-top-color', 'border-left-color', 'border-right-color', 'border-bottom-color',
                'border-top-width', 'border-left-width', 'border-right-width', 'border-bottom-width',
                'border-top-style', 'border-left-style', 'border-right-style', 'border-bottom-style',
                'color', 'font-size', 'font-weight', 'padding-top', 'padding-bottom', 'padding-left',
                'padding-right', 'vertical-align'
            ]
        }
    });
}

function downloadExcelMulti(classname, filename) {
    $('.' + classname).tableExport({
        type: 'excel',
        fileName: filename,
        worksheetName: ['Table 1', 'Table 2'],
        mso: {
            fileFormat: 'xlshtml',
            styles: ['background-color',
                'border-top-color', 'border-left-color', 'border-right-color', 'border-bottom-color',
                'border-top-width', 'border-left-width', 'border-right-width', 'border-bottom-width',
                'border-top-style', 'border-left-style', 'border-right-style', 'border-bottom-style',
                'color', 'font-size', 'font-weight', 'padding-top', 'padding-bottom', 'padding-left',
                'padding-right', 'vertical-align'
            ]
        }
    });
}
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>asset/zoomscroll/file/dragscroll.js"></script>

<!-- <script src="<?php echo base_url(); ?>asset/zoomscroll/file/jquery-1.9.1.js"></script> -->
<!-- <script src="https://rawgithub.com/brandonaaron/jquery-mousewheel/master/mousewheel.jquery.json"></script> -->
<script src="<?php echo base_url(); ?>asset/zoomscroll/file/jquery.mousewheel.js"></script>

<script type="text/javascript">
// zooming on mouse cursor with adjusting -transform-origin
// moving the zooming frame with the -transfrorm matrix

/*****************************************************
 * Transformations
 ****************************************************/
function Transformations(originX, originY, translateX, translateY, scale) {
    this.originX = originX;
    this.originY = originY;
    this.translateX = translateX;
    this.translateY = translateY;
    this.scale = scale;
}

/* Getters */
Transformations.prototype.getScale = function() {
    return this.scale;
}
Transformations.prototype.getOriginX = function() {
    return this.originX;
}
Transformations.prototype.getOriginY = function() {
    return this.originY;
}
Transformations.prototype.getTranslateX = function() {
    return this.translateX;
}
Transformations.prototype.getTranslateY = function() {
    return this.translateY;
}

/*****************************************************
 * Zoom Pan Renderer
 ****************************************************/
function ZoomPanRenderer(elementId) {
    this.zooming = undefined;
    this.elementId = elementId;
    this.current = new Transformations(0, 0, 0, 0, 1);
    this.last = new Transformations(0, 0, 0, 0, 1);
    new ZoomPanEventHandlers(this);
}

/* setters */
ZoomPanRenderer.prototype.setCurrentTransformations = function(t) {
    this.current = t;
}
ZoomPanRenderer.prototype.setZooming = function(z) {
    this.zooming = z;
}

/* getters */
ZoomPanRenderer.prototype.getCurrentTransformations = function() {
    return this.current;
}
ZoomPanRenderer.prototype.getZooming = function() {
    return this.zooming;
}
ZoomPanRenderer.prototype.getLastTransformations = function() {
    return this.last;
}
ZoomPanRenderer.prototype.getElementId = function() {
    return this.elementId;
}

/* Rendering */
ZoomPanRenderer.prototype.getTransform2d = function(t) {
    var transform2d = "matrix(";
    transform2d += t.getScale().toFixed(1) + ",0,0," + t.getScale().toFixed(1) + "," + t.getTranslateX().toFixed(
        1) + "," + t.getTranslateY().toFixed(1) + ")";
    //0,0)";
    return transform2d;
}

ZoomPanRenderer.prototype.applyTransformations = function(t) {
    var elem = $("#" + this.getElementId());
    var orig = t.getOriginX().toFixed(10) + "px " + t.getOriginY().toFixed(10) + "px";
    elem.css("transform-origin", orig);
    elem.css("-ms-transform-origin", orig);
    elem.css("-o-transform-origin", orig);
    elem.css("-moz-transform-origin", orig);
    elem.css("-webkit-transform-origin", orig);
    var transform2d = this.getTransform2d(t);
    elem.css("transform", transform2d);
    elem.css("-ms-transform", transform2d);
    elem.css("-o-transform", transform2d);
    elem.css("-moz-transform", transform2d);
    elem.css("-webkit-transform", transform2d);
}

/*****************************************************
 * Event handler
 ****************************************************/
function ZoomPanEventHandlers(renderer) {
    this.renderer = renderer;

    /* Disable scroll overflow - safari */
    document.addEventListener('touchmove', function(e) {
        e.preventDefault();
    }, false);

    /* Disable default drag opeartions on the element (FF makes it ready for save)*/
    $("#" + renderer.getElementId()).bind('dragstart', function(e) {
        e.preventDefault();
    });

    /* Add mouse wheel handler */
    $("#" + renderer.getElementId()).bind("mousewheel", function(event, delta) {
        if (renderer.getZooming() == undefined) {
            var offsetLeft = $("#" + renderer.getElementId()).offset().left;
            var offsetTop = $("#" + renderer.getElementId()).offset().top;
            var zooming = new MouseZoom(renderer.getCurrentTransformations(), event.pageX, event.pageY,
                offsetLeft, offsetTop, delta);
            renderer.setZooming(zooming);

            var newTransformation = zooming.zoom();
            renderer.applyTransformations(newTransformation);
            renderer.setCurrentTransformations(newTransformation);
            renderer.setZooming(undefined);
        }
        return false;
    });
}

/*****************************************************
 * Mouse zoom
 ****************************************************/
function MouseZoom(t, mouseX, mouseY, offsetLeft, offsetTop, delta) {
    this.current = t;
    this.offsetLeft = offsetLeft;
    this.offsetTop = offsetTop;
    this.mouseX = mouseX;
    this.mouseY = mouseY;
    this.delta = delta;
}

MouseZoom.prototype.zoom = function() {
    // current scale
    var previousScale = this.current.getScale();
    // new scale
    var newScale = previousScale + this.delta / 10;
    // scale limits
    var maxscale = 1;
    if (newScale < 0.2) {
        newScale = 0.2;
    } else if (newScale > maxscale) {
        newScale = maxscale;
    }
    // current cursor position on image
    var imageX = (this.mouseX - this.offsetLeft).toFixed(2);
    var imageY = (this.mouseY - this.offsetTop).toFixed(2);
    // previous cursor position on image
    var prevOrigX = (this.current.getOriginX() * previousScale).toFixed(2);
    var prevOrigY = (this.current.getOriginY() * previousScale).toFixed(2);
    // previous zooming frame translate
    var translateX = this.current.getTranslateX();
    var translateY = this.current.getTranslateY();
    // set origin to current cursor position
    var newOrigX = imageX / previousScale;
    var newOrigY = imageY / previousScale;

    // move zooming frame to current cursor position
    if ((Math.abs(imageX - prevOrigX) > 1 || Math.abs(imageY - prevOrigY) > 1) && previousScale < maxscale) {
        translateX = translateX + (imageX - prevOrigX) * (1 - 1 / previousScale);
        translateY = translateY + (imageY - prevOrigY) * (1 - 1 / previousScale);
    }
    // stabilize position by zooming on previous cursor position
    else if (previousScale != 1 || imageX != prevOrigX && imageY != prevOrigY) {
        newOrigX = prevOrigX / previousScale;
        newOrigY = prevOrigY / previousScale;
        //frame limit
    }
    // on zoom-out limit frame shifts to original frame
    if (this.delta <= 0) {
        var width = 0;
        var height = 0;
        if (translateX + newOrigX + (width - newOrigX) * newScale <= width) {
            translateX = 0;
            newOrigX = width;
        } else if (translateX + newOrigX * (1 - newScale) >= 0) {
            translateX = 0;
            newOrigX = 0;
        }
        if (translateY + newOrigY + (height - newOrigY) * newScale <= height) {
            translateY = 0;
            newOrigY = height;
        } else if (translateY + newOrigY * (1 - newScale) >= 0) {
            translateY = 0;
            newOrigY = 0;
        }
    }

    return new Transformations(newOrigX, newOrigY, translateX, translateY, newScale);
}

$(document).ready(function() {

    console.log($('#jenis_pengajuan_surat option:selected').attr('id'));

    if ($('#jenis_pengajuan_surat option:selected').attr('id') == 1) {
        var id = $('#jenis_pengajuan_surat option:selected').attr('id');

        var formid = "#form" + id;
        var formuploadid = "#form-upload" + id;
        $('input[name="no_ijazah"]').prop('required', false);
        $('input[name="tanggal_ijazah"]').prop('required', false);
        $('input[name="jadwal_kuliah"]').prop('required', true);
        $('input[name="sk_lembaga_pendidikan"]').prop('required', true);
        $('input[name="fc_ijazah"]').prop('required', false);
        $('input[name="transkip_nilai"]').prop('required', false);
        $('.form-update').hide();
        $('.top-form').show();
        $(formid).show();
        $(formuploadid).show();
    } else if ($('#jenis_pengajuan_surat option:selected').attr('id') == 2) {
        var id = $('#jenis_pengajuan_surat option:selected').attr('id');

        var formid = "#form" + id;
        var formuploadid = "#form-upload" + id;
        $('input[name="no_ijazah"]').prop('required', true);
        $('input[name="tanggal_ijazah"]').prop('required', true);
        $('input[name="jadwal_kuliah"]').prop('required', false);
        $('input[name="sk_lembaga_pendidikan"]').prop('required', false);
        $('input[name="fc_ijazah"]').prop('required', true);
        $('input[name="transkip_nilai"]').prop('required', true);
        $('.form-update').hide();
        $('.top-form').show();
        $(formid).show();
        $(formuploadid).show();
    }

    $('#jenis_pengajuan_surat').change(function() {
        var id = $('#jenis_pengajuan_surat option:selected').attr('id');

        var formid = "#form" + id;
        var formuploadid = "#form-upload" + id;

        if (id == 1) {
            $('input[name="no_ijazah"]').prop('required', false);
            $('input[name="tanggal_ijazah"]').prop('required', false);
            $('input[name="jadwal_kuliah"]').prop('required', true);
            $('input[name="sk_lembaga_pendidikan"]').prop('required', true);
            $('input[name="fc_ijazah"]').prop('required', false);
            $('input[name="transkip_nilai"]').prop('required', false);
        } else if (id == 2) {
            $('input[name="no_ijazah"]').prop('required', true);
            $('input[name="tanggal_ijazah"]').prop('required', true);
            $('input[name="jadwal_kuliah"]').prop('required', false);
            $('input[name="sk_lembaga_pendidikan"]').prop('required', false);
            $('input[name="fc_ijazah"]').prop('required', true);
            $('input[name="transkip_nilai"]').prop('required', true);
        }

        $('.form-update').hide();
        $('.top-form').show();
        $('#option-lieur').hide();
        $(formid).show();
        $(formuploadid).show();


    });
});

var renderer = new ZoomPanRenderer("tree-view");
</script>

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

<?php
if ($this->session->userdata('level') == 'User' && $this->uri->segment(1) != 'pengaturan_akun') {
    $this->load->model('user_model');
    $this->user_model->user_id = $this->session->userdata('user_id');
    $user = $this->user_model->get_user_by_id_new();
    // print_r($user);
    $message = array();
    $alert = array();
    if ($user->kepala_skpd !== "Y" && $user->id_unit_kerja == 0) {
        $message[] = "Unit Kerja anda masih kosong";
        $alert[] = 'unit_kerja';
    }
    if ($user->password == md5($user->username)) {
        $message[] = "Ganti Password Anda";
        $alert[] = 'password';
        redirect('pengaturan_akun?password');
    }

    $pesan = implode("\\n", $message);
    $parameter = implode("&", $alert);
    if (!empty($pesan)) {
        ?>

                <script type="text/javascript">
                (function() {
                    swal({
                        title: "Silahkan Ganti Data Anda",
                        text: "<?= $pesan ?>",
                        type: "info",
                        showCloseButton: false,
                        allowOutsideClick: false,
                        showCancelButton: false,
                        allowEscapekey: false,
                        closeOnConfirm: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false
                    }, function() {
                        window.location = "<?= base_url('pengaturan_akun') ?>?<?= $parameter ?>";
                    });
                })();
                </script>
        <?php }
} ?>


<?php if ($this->router->fetch_class() == 'simpeg' or $this->router->fetch_class() == 'auditor') { ?>
        <script type="text/javascript">
        setTimeout(function() {
            $('#collapse-menu').click();
        }, 100);
        </script>
<?php } ?>

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

function block_trans(id) {
    $(id).block({
        message: '<h4>Sementara Ditutup</h4>',
        css: {
            border: '1px solid #fff'
        }
    });
}
</script>


<script type="text/javascript" src="<?php echo base_url(); ?>asset/tinymce/tinymce.min.js"></script>
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

<script type="text/javascript">
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
</script>

<script type="text/javascript"
    src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/mask/jquery.maskmoney.js"></script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-F4N9YKWXJL"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'G-F4N9YKWXJL');
</script>

<script type="text/javascript">
//update last online every 10 seconds
setInterval(function() {
    $.ajax({
        url: "<?= base_url('admin/update_last_online') ?>",
        success: function() {
            console.log('update last online');
        }
    });
}, 10000);
</script>