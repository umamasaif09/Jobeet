
   <form action="<?php echo site_url("admin/updateAffiliate"); ?>" method="POST" class="admin-form">
        <input type="hidden" name="id" value="<?php echo $affiliate["id"] ?>">
        <?php $this->load->view("partials/affiliates_form_fields"); ?>


        <button type="submit" class="btn btn-primary"><?= $this->lang->line("update_effiliate"); ?></button>
    </form>
