
        <?php $this->load->view("partials/previewJob"); ?>

        <form method="POST" action="<?php echo site_url("jobs/postJob"); ?>" enctype= "multipart/form-data">
            <?php $this->load->view("partials/preview_submit_form"); ?>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Job Post</button>
            </div>
            
        </form>


    
