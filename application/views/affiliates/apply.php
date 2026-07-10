
<div class="container">

    <form method="POST" action="<?php echo site_url("affiliates/submitApplication"); ?>">
        <?php $this->load->view("partials/affiliates_form_fields"); ?>
        <button type="submit" class="btn-primary"><?= $this->lang->line("apply"); ?></button>
    </form>

</div>
