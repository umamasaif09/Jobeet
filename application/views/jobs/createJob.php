<div class="form-container">
    <div class="form-card">
        <form method="POST" action="<?php echo site_url("jobs/preview"); ?>" enctype= "multipart/form-data" class="job-form">
        
            <?php $this->load->view("partials/job_form_fields"); ?>
                
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Preview Job</button>
            </div>
        </form>
    </div>
</div>


