<!-- BEGIN: Vendor JS-->
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script
    src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js">
</script>
<script
    src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js">
</script>
<script
    src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/tables/datatable/dataTables.responsive.js">
</script>
<script
    src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js">
</script>
<script
    src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/tables/datatable/datatables.buttons.min.js">
</script>
<script
    src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/tables/datatable/buttons.bootstrap5.min.js">
</script>
<script
    src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js">
</script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/jkanban/jkanban.min.js"></script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/forms/select/select2.full.min.js">
</script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js">
</script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/editors/quill/katex.min.js"></script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/editors/quill/highlight.min.js"></script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/editors/quill/quill.js"></script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/forms/validation/jquery.validate.min.js">
</script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/pagination/jquery.bootpag.min.js">
</script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/pagination/jquery.twbsPagination.min.js">
</script>

<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/extensions/sweetalert2.all.min.js">
</script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/extensions/polyfill.min.js"></script>
<script
    src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js">
</script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/core/app-menu.js"></script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/core/app.js"></script>
</script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/scripts/pages/modal-add-role.js"></script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/scripts/pages/app-access-roles.js"></script>
<!-- <script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/scripts/pages/app-kanban.js"></script> -->
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/scripts/pagination/components-pagination.js">
</script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/scripts/forms/form-select2.js"></script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/scripts/forms/form-number-input.js"></script>
<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/scripts/components/components-popovers.js">
</script>
<!-- END: Page JS-->

<script>
$(window).on('load', function() {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }
})

$('#addRoleForm').on('submit', function() {
    $('.modal-content').block({
        message: '<div class="spinner-grow spinner-grow-sm text-white" role="status"></div>',
        timeout: 1000,
        css: {
            backgroundColor: 'transparent',
            border: '0'
        },
        overlayCSS: {
            opacity: 0.5
        }
    });
});

function elBlock(el, time = 999999) {
    $(el).block({
        message: '<div class="spinner-grow spinner-grow-sm text-white" role="status"></div>',
        timeout: time,
        css: {
            backgroundColor: 'transparent',
            border: '0'
        },
        overlayCSS: {
            opacity: 0.5
        }
    });
}

function elUnblock(el) {
    $(el).block({
        message: '<div class="spinner-grow spinner-grow-sm text-white" role="status"></div>',
        timeout: 1,
        css: {
            backgroundColor: 'transparent',
            border: '0'
        },
        overlayCSS: {
            opacity: 0.5
        }
    });
}
</script>