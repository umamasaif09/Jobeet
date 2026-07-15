

<div class="category-table-card">
    
    <table class="admin-table category-table">
        <thead>
            <tr>
                <th><strong><?= $this->lang->line("category_id"); ?></strong></th>
                <th><strong><?= $this->lang->line("category_name"); ?></strong></th>
                <th class="menu-column"></th>
            </tr>
        </thead>

        <tbody>
                <?php foreach($categories as $category) { ?>

                    <tr>
                        <td class="id-column"><?php echo $category["id"]; ?></td>
                        <td><?php echo $category["name"]; ?></td>

                        <td class="row-menu">
                            <button type="button" class="menu-toggle">⋮</button>
                            <div class= "menu-dropdown">
                                <a href="<?php echo site_url("admin/editCategory/".$category["id"]) ?>" class="btn btn-warning"> 
                                <?= $this->lang->line("edit"); ?>
                                </a>

                                <a href="<?php echo site_url("admin/deleteCategory/".$category["id"]) ?>" 
                                    onclick="return confirm('Delete this category?')"
                                    class="btn btn-danger">
                                    
                                    <?= $this->lang->line("delete"); ?>
                                </a>
                            </div>
                            
                        </td>
                    </tr>
                    
                    
                <?php } ?>
        </tbody>
    </table>

</div>


<div class="modal" id="categoryModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><?php echo $this->lang->line("add_category"); ?></h2>

            <button type="button" class="modal-close" id="closeCategoryModal">
                &times;
            </button>
        </div>

        <form action="<?php echo site_url("admin/createCategory"); ?>" method="POST" class="admin-form">

            <div class=form-group>
                <label><?= $this->lang->line("category_name"); ?></label>
                <input type="text" name= "category_name" placeholder="Enter category name" required>
            </div>
                

            <button type="submit" class="btn btn-primary"><?= $this->lang->line("create_category"); ?></button>
        </form>

    </div>
</div>
