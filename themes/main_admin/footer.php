<!--begin::Javascript-->

<script>
    var BASE_URL = '<?= base_url(); ?>';
    var hostUrl = "<?= base_url(); ?>assets/admin/";
    var css_btn_confirm = 'btn btn-primary';
    var css_btn_cancel = 'btn btn-danger';
    var base_foto = '<?= image_check('notfound.jpg','default') ?>';
    var user_base_foto = '<?= image_check('user.jpg','default') ?>';
     addEventListener('keypress', function(e) {
        if (e.keyCode === 13 || e.which === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="<?= base_url(); ?>assets/public/plugins/global/plugins.bundle.js"></script>
<script src="<?= base_url(); ?>assets/public/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="<?= base_url(); ?>assets/public/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="<?= base_url(); ?>assets/public/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
<!--end::Vendors Javascript-->

<!--begin::Custom Javascript(used for this page only)-->
<!-- <script src="<?= base_url(); ?>assets/admin/js/custom/widgets.js"></script> -->
<script src="<?= base_url(); ?>assets/admin/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom/utilities/modals/create-campaign.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom/utilities/modals/users-search.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/public/plugins/ckeditor5/ckeditor.js'); ?>"></script>

<script src="<?= base_url(); ?>assets/public/js/function.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/modul/mekanik.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom/javascript_pribadi.js"></script>



<!--end::Custom Javascript-->
<?php

if (isset($js_add) && is_array($js_add)) {
    foreach ($js_add as $js) {
        echo $js;
    }
} else {
    echo (isset($js_add) && ($js_add != "") ? $js_add : "");
}

?>
<!--end::Javascript-->
</body>
<!--end::Body-->

</html>