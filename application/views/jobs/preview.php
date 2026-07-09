<?php $this->load->view("partials/header", [
    "title" => $title
]); ?>

<?php $this->load->view("partials/pageHeader"); ?>

    <div class="container">
        <?php $this->load->view("partials/previewJob"); ?>

        <form method="POST" action="<?php echo site_url("jobs/postJob"); ?>" enctype= "multipart/form-data">
            <?php $this->load->view("partials/preview_submit_form"); ?>
            <input type="hidden" name="is_admin" value= "<?php echo $is_admin? 1: 0; ?>">

            <button type="submit" class="btn-primary">Create Job Post</button>
        </form>
    </div>

    
    
   <?php $this->load->view("partials/footer"); ?>