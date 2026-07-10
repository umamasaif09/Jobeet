    
<?php $this->load->view("partials/previewJob"); ?>
<?php $this->load->view("partials/preview_submit_form"); ?>


<div class="container">
    <form method="POST" action="<?php echo site_url("jobs/updateJob"); ?>" enctype= "multipart/form-data" class="job-form">
    <input type="hidden" name="id" value= "<?php echo $job["id"]; ?>">
    <input type="hidden" name="token" value= "<?php echo $job["token"]; ?>">

        <?php $this->load->view("partials/job_form_fields", [
            "job" => $job,
            "category" => $category
        ]); ?>

        
        
        <button type="submit" class="btn-primary">Update Job</button>
        
        
    </form>

    <?php if($daysRemaining <= 5) { ?> 
            <form action="<?php echo site_url("jobs/extendJob"); ?>" method="POST" class="job-form">
                <input type="hidden" name="id" value= "<?php echo $job["id"]; ?>">
                <input type="hidden" name="token" value= "<?php echo $job["token"]; ?>">

                <button type="submit" class="btn-primary">Extend Job for 30 days</button>
            </form>
    <?php }?>

</div>
