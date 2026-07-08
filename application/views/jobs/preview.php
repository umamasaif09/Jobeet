<?php $this->load->view("partials/header", [
    "title" => $title
]); ?>

<?php $this->load->view("partials/pageHeader"); ?>

    <div class="container">
        <?php $this->load->view("partials/previewJob"); ?>


    <button type="submit" class="btn-primary">Create Job Post</button>
    </div>

    
    
   <?php $this->load->view("partials/footer"); ?>