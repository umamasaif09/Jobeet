<div class="form-container">
    <div class = "form-card">
       <form action="<?php echo site_url("admin/updateAffiliate"); ?>" method="POST" class="admin-form">
            <input type="hidden" name="id" value="<?php echo $affiliate["id"] ?>">
            <?php $this->load->view("partials/affiliates_form_fields"); ?>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-lg"><?= $this->lang->line("update_effiliate"); ?></button>
            </div>
            
        </form>
    </div>
</div>
