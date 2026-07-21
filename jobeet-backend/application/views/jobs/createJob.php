
        <form method="POST" action="<?php echo $formAction; ?>" enctype= "multipart/form-data" class="job-form">
        
            <?php $this->load->view("partials/job_form_fields"); ?>
                
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php echo $submitButtonText; ?></button>
            </div>
        </form>



