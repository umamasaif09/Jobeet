<?php $this->load->view("partials/header", [
    "title" => $title
]); ?>

<?php $this->load->view("partials/pageHeader"); ?>

    <div class="container">
        <section>
        <form method="POST" action="<?php echo site_url("jobs/preview"); ?>" enctype= "multipart/form-data" class="job-form">
             
            <?php $this->load->view("partials/job_form_fields", [
                "categories" => $categories
            ]); ?>
            
            
            <button type="submit" class="btn-primary">Preview Job</button>
            
            
        </form>
    </section>
    </div>

    

   <?php $this->load->view("partials/footer"); ?>