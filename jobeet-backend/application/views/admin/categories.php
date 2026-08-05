

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
                                <button type="button" class="btn btn-warning menu-btn edit-category-btn" 
                                    data-id="<?php echo $category["id"]; ?>"
                                    data-name="<?php echo htmlspecialchars($category["name"]); ?>">
                                <?= $this->lang->line("edit"); ?>
                            </button>

                                <a href="<?php echo site_url("admin/deleteCategory/".$category["id"]) ?>" 
                                    onclick="return confirm('Delete this category?')"
                                    class="btn btn-danger menu-btn">
                                    
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
            <h2>Create Category</h2>

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

<!-- Edit Category Modal -->
<div class="modal" id="editCategoryModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><?php echo $this->lang->line("edit_category"); ?></h2>
            <button type="button" class="modal-close" id="closeEditCategoryModal">
                &times;
            </button>
        </div>

        <form action="<?php echo site_url("admin/updateCategory"); ?>" method="POST" class="admin-form" id="editCategoryForm">
            <input type="hidden" name="id" id="edit_category_id">
            
            <div class="form-group">
                <label><?= $this->lang->line("category_name"); ?></label>
                <input type="text" name="category_name" id="edit_category_name" placeholder="Enter category name" required>
            </div>

            <button type="submit" class="btn btn-primary"><?= $this->lang->line("update_category"); ?></button>
        </form>
    </div>
</div>
