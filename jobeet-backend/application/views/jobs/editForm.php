
        
<form method="POST" action="<?php echo site_url("jobs/updateJob"); ?>" enctype= "multipart/form-data" class="job-form">
    <input type="hidden" name="id" value= "<?php echo $job["id"]; ?>">
    <input type="hidden" name="token" value= "<?php echo $job["token"]; ?>">
    <input type="hidden" name="admin-flag" value= "<?php echo $is_admin?>">

        <?php $this->load->view("partials/job_form_fields", [
            "job" => $job,
            "category" => $category
        ]); ?>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Job</button>
        </div>
        
    </form>
          



    

    