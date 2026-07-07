<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
     <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>
    <section >
            <?php $this->load->view("partials/adminHeader"); ?>
        </header>
        <form action="<?php echo site_url("admin/updateCategory"); ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $category["id"] ?>">
            <strong>Category Name: </strong>

            <input type="text" name= "category_name" value="<?php echo $category["name"] ?>">

            <button type="submit">Update</button>
        </form>
    </section>

</body>
</html>