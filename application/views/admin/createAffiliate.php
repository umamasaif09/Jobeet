<form action="<?php echo site_url("admin/createAffiliate"); ?>" method="POST" class="admin-form">
        
        <?php $this->load->view("partials/affiliates_form_fields"); ?>
    <button type="submit" class="btn btn-primary"><?= $this->lang->line("create_affiliate"); ?></button>
</form>