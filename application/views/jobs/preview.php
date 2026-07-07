<?php $this->load->view("partials/header", [
    "title" => $title
]); ?>

    <?php $this->load->view("partials/previewJob"); ?>

    <button type="submit">Create Job Post</button>
    
   <?php $this->load->view("partials/footer"); ?>