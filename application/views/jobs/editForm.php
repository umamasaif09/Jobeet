    

<div class="edit-layout">
    <div class="preview-content">
        <?php $this->load->view("partials/previewJob"); ?>
        <?php $this->load->view("partials/preview_submit_form"); ?>

        <?php if($daysRemaining <= 5) { ?> 
            <form action="<?php echo site_url("jobs/extendJob/".$job["id"]."/".$job["token"]); ?>" method="POST" class="extend-form">
                <input type="hidden" name="id" value= "<?php echo $job["id"]; ?>">
                <input type="hidden" name="token" value= "<?php echo $job["token"]; ?>">
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Extend Job for 30 days</button>
                </div>
                
            </form>
        <?php }?>
    </div>

    <div class="edit-form">
        <div class="form-container">
            <div class="form-card">
                <form method="POST" action="<?php echo site_url("jobs/updateJob"); ?>" enctype= "multipart/form-data" class="job-form">
                    <input type="hidden" name="id" value= "<?php echo $job["id"]; ?>">
                    <input type="hidden" name="token" value= "<?php echo $job["token"]; ?>">

                        <?php $this->load->view("partials/job_form_fields", [
                            "job" => $job,
                            "category" => $category
                        ]); ?>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Job</button>
                        </div>
                        
                    </form>
            </div>
        </div>
    </div>

</div>

    

    