
    <form method="POST" action="<?php echo site_url("affiliates/submitApplication"); ?>" class="job-form">
        <?php $this->load->view("partials/affiliates_form_fields"); ?>
        <button type="submit" class="btn btn-primary"><?= $this->lang->line("apply"); ?></button>
    </form>

