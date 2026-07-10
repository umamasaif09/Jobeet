
<div class="container">
    <?php $this->load->view("partials/previewJob"); ?>

    <form method="POST" action="<?php echo site_url("jobs/postJob"); ?>" enctype= "multipart/form-data">
        <?php $this->load->view("partials/preview_submit_form"); ?>
        

        <button type="submit" class="btn-primary">Create Job Post</button>
    </form>
</div>
