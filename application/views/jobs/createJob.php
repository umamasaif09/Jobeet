<?php $this->load->view("partials/header", [
    "title" => $title
]); ?>

    <section>
        <form method="POST" action="<?php echo site_url("jobs/preview"); ?>" enctype= "multipart/form-data">
             
            <?php $this->load->view("partials/job_form_fields", [
                "categories" => $categories
            ]); ?>
            
            
            <button type="submit">Preview</button>
            
            
        </form>
    </section>

   <?php $this->load->view("partials/footer"); ?>