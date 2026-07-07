<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
     <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>
     <header>
        <h1>Jobeet</h1>
    </header>

    

    <section>
        <header>
            <a href="<?php echo site_url('admin/dashboard'); ?>">
                <button type="button">← Back</button>
            </a>
        </header>
        <h2>Add a Category</h2>
        <form action="<?php echo site_url("admin/createCategory"); ?>" method="POST">
            <strong>Category Name: </strong>
            <input type="text" name= "category_name">

            <button type="submit">Create</button>
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
                                <a href="<?php echo site_url("admin/editCategory/".$category["id"]) ?>"> 
                                    <button type="button">Edit</button>
                                </a>

                                <a href="<?php echo site_url("admin/deleteCategory/".$category["id"]) ?>" 
                                    onclick="return confirm('Delete this category?')">
                                    
                                    <button type="button" >Delete</button>
                                </a>
                            </td>
                        </tr>
                        
                        
                    <?php } ?>
            </tbody>
        </table>
    </section>

    
</body>
</html>