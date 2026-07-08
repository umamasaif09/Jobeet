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
            <?php $this->load->view("partials/pageHeader"); ?>
            
        <form action="<?php echo site_url("admin/updateCategory"); ?>" method="POST" class="admin-form">
            <input type="hidden" name="id" value="<?php echo $category["id"] ?>">
            <div class=form-group>
                <label>Category Name: </label>
                <input type="text" name= "category_name" placeholder="Enter category name" required>
            </div>

            <button type="submit" class="btn-primary">Update Category</button>
        </form>
    </section>

</body>
</html>