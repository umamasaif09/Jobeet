<?php $this->load->view("partials/header", [
    "title" => $title
]); ?>

<?php $this->load->view("partials/pageHeader"); ?>

    <div class="container">
        <section>
        <h2>Job Created Successfully</h2>

        <p>Save this link to edit your job later: </p>
        <a href="<?php echo site_url("jobs/edit/".$jobId."/".$token) ;?>"><p><?php echo site_url("jobs/edit/".$jobId."/".$token) ;?></p></a>

        
        <br><br>

        <?php $this->load->view("partials/previewJob"); ?>
        
    
    </section>
    </div>

    
    
   <?php $this->load->view("partials/footer"); ?>