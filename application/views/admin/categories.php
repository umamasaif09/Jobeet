<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
     <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>
        <?php $this->load->view("partials/adminHeader"); ?>

    

    <section>
        <h2>Add a Category</h2>
        <form action="<?php echo site_url("admin/createCategory"); ?>" method="POST" class="admin-form">

        <div class=form-group>
             <label>Category Name: </label>
            <input type="text" name= "category_name" placeholder="Enter category name" required>
        </div>
           

            <button type="submit" class="btn-primary">Add Category</button>
        </form>
    </section>

    <section>
        <h2>Existing Categories</h2>
        <table>
            <thead>
                <tr>
                    <th><strong>Category ID</strong></th>
                    <th><strong>Category Name</strong></th>
                </tr>
            </thead>

            <tbody>
                    <?php foreach($categories as $category) { ?>

                        <tr>
                            <td><?php echo $category["id"]; ?></td>
                            <td><?php echo $category["name"]; ?></td>

                            <td>
                                <a href="<?php echo site_url("admin/editCategory/".$category["id"]) ?>" class="btn-warning"> 
                                    Edit
                                </a>

                                <a href="<?php echo site_url("admin/deleteCategory/".$category["id"]) ?>" 
                                    onclick="return confirm('Delete this category?')"
                                    class="btn-danger">
                                    
                                    Delete
                                </a>
                            </td>
                        </tr>
                        
                        
                    <?php } ?>
            </tbody>
        </table>
    </section>

    
</body>
</html>