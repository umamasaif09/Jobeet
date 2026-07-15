
      
<form action="<?php echo site_url("admin/updateCategory"); ?>" method="POST" class="admin-form">
    <input type="hidden" name="id" value="<?php echo $category["id"] ?>">
    <div class=form-group>
        <label><?= $this->lang->line("category_name"); ?></label>
        <input type="text" name= "category_name" placeholder="Enter category name" required value="<?php echo $category["name"]?>">
    </div>

    <button type="submit" class="btn btn-primary"><?= $this->lang->line("update_category"); ?></button>
</form>


