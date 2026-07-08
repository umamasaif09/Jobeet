
        <?php $this->load->view("partials/adminHeader"); ?>
        
        <?php $this->load->view("partials/pageHeader"); ?>
    
    <div class="container">
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
        <div class="table-container"></div>
        <table class="admin-table category-table">
            <thead>
                <tr>
                    <th class="id-column"><strong>Category ID</strong></th>
                    <th><strong>Category Name</strong></th>
                    <th class="actions-column">Actions</th>
                </tr>
            </thead>

            <tbody>
                    <?php foreach($categories as $category) { ?>

                        <tr>
                            <td class="id-column"><?php echo $category["id"]; ?></td>
                            <td><?php echo $category["name"]; ?></td>

                            <td class="actions">
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
    </div>
    

    
</body>
</html>