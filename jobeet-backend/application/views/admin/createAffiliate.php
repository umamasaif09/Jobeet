<div class="form-container">
    <div class = "form-card">
        <form action="<?php echo site_url("admin/createAffiliate"); ?>" method="POST" class="admin-form">
        
        <?php $this->load->view("partials/affiliates_form_fields"); ?>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-lg"><?= $this->lang->line("create_affiliate"); ?></button>
        </div>
        
    </form>

    </div>
</div>

    
    


