

<div class="container">

    <h2>Job Created Successfully</h2>

    <p>Save this link to edit your job later: </p>
    <a href="<?php echo site_url("jobs/edit/".$jobId."/".$token) ;?>"><p><?php echo site_url("jobs/edit/".$jobId."/".$token) ;?></p></a>


    <br><br>

    <?php $this->load->view("partials/previewJob"); ?>


</div>
