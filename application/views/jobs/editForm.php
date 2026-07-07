<?php $this->load->view("partials/header", [
    "title" => $title
]); ?>

    
<?php $this->load->view("partials/previewJob"); ?>
<?php $this->load->view("partials/preview_submit_form"); ?>


    


    <section>
        <form method="POST" action="<?php echo site_url("jobs/updateJob"); ?>" enctype= "multipart/form-data">
        <input type="hidden" name="id" value= "<?php echo $job["id"]; ?>">
        <input type="hidden" name="token" value= "<?php echo $job["token"]; ?>">

            <?php $this->load->view("partials/job_form_fields", [
                "job" => $job,
                "categories" => $categories
            ]); ?>

            
            
            <button type="submit">Update</button>
            
            
        </form>

        <?php if($job["daysRemaining"] <= 5) { ?> 
                <form action="<?php echo site_url("jobs/extendJob"); ?>" method="POST">
                    <input type="hidden" name="id" value= "<?php echo $job["id"]; ?>">
                    <input type="hidden" name="token" value= "<?php echo $job["token"]; ?>">

                    <button type="submit">Extend Job for 30 days</button>
                </form>
        <?php }?>

    </section>

   <?php $this->load->view("partials/footer"); ?>