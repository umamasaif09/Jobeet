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
       
        <form action="<?php echo site_url("admin/updateAffiliate"); ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $affiliate["id"] ?>">
           <strong>Affiliate Name</strong>
            <input type="text" name= "name" value="<?php echo $affiliate["name"] ?>"><br><br>

            <strong>Email</strong>
            <input type="text" name= "email" value="<?php echo $affiliate["email"] ?>"><br><br>

            <strong>Website</strong>
            <input type="text" name= "url" value="<?php echo $affiliate["site_url"] ?>"><br><br>


            <button type="submit">Update</button>
        </form>
    </section>

</body>
</html>