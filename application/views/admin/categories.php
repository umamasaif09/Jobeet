
        <?php $this->load->view("partials/adminHeader"); ?>
        
        <?php $this->load->view("partials/pageHeader"); ?>
    
    <div class="container">
        <section>
        <h2><?= $this->lang->line("add_category"); ?></h2>
        <form action="<?php echo site_url("admin/createCategory"); ?>" method="POST" class="admin-form">

        <div class=form-group>
             <label><?= $this->lang->line("category_name"); ?></label>
            <input type="text" name= "category_name" placeholder="Enter category name" required>
        </div>
           

            <button type="submit" class="btn-primary"><?= $this->lang->line("create_category"); ?></button>
        </form>
    </section>

    
    </div>
    
    <div class="table-container">
        <section>
        <h2><?= $this->lang->line("existing_categories"); ?></h2>
        <div class="table-container"></div>
        <table class="admin-table category-table">
            <thead>
                <tr>
                    <th class="id-column"><strong><?= $this->lang->line("category_id"); ?></strong></th>
                    <th><strong><?= $this->lang->line("category_name"); ?></strong></th>
                    <th class="actions-column"><?= $this->lang->line("actions"); ?></th>
                </tr>
            </thead>

            <tbody>
                    <?php foreach($categories as $category) { ?>

                        <tr>
                            <td class="id-column"><?php echo $category["id"]; ?></td>
                            <td><?php echo $category["name"]; ?></td>

                            <td class="actions">
                                <a href="<?php echo site_url("admin/editCategory/".$category["id"]) ?>" class="btn-warning"> 
                                    <?= $this->lang->line("edit"); ?>
                                </a>

                                <a href="<?php echo site_url("admin/deleteCategory/".$category["id"]) ?>" 
                                    onclick="return confirm('Delete this category?')"
                                    class="btn-danger">
                                    
                                    <?= $this->lang->line("delete"); ?>
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