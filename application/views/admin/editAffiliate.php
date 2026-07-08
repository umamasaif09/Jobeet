<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Affiliate</title>
     <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>
    <section >
       <?php $this->load->view("partials/adminHeader"); ?>
       
        <form action="<?php echo site_url("admin/updateAffiliate"); ?>" method="POST" class="admin-form">
            <input type="hidden" name="id" value="<?php echo $affiliate["id"] ?>">
            <?php $this->load->view("partials/affiliates_form_fields"); ?>


            <button type="submit" clas="btn-primary">Update Affiliate</button>
        </form>
    </section>

</body>
</html>