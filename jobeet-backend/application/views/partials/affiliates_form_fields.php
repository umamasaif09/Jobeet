<?php $isEdit= isset($affiliate); 
    $selectedCategories = isset($selectedCategories) ? $selectedCategories:array();
?>


        <div  class = "form-group">
            <label>Name</label>
            <input type="text" name= "name" placeholder = "Enter affiliate name" required value="<?php echo $isEdit ? $affiliate["name"] : ''; ?>">
        </div>
                
        <div class = "form-group">
            <label>Email</label>
            <input type="email" name= "email" placeholder = "Enter affiliate email" required value="<?php echo $isEdit ? $affiliate["email"] : ''; ?>">
        </div>

        <div class = "form-group">
            <label>Website</label>
            <input type="url" name= "site_url" placeholder= "Enter affiliate website url" required value="<?php echo $isEdit ? $affiliate["site_url"] : ''; ?>">
        </div>

        <div class = "form-group">
            <div>
                <Label class="category-label">Categories</Label>
                
                <?php foreach($categories as $category) { ?>
                
                    <div class="checkbox-group">
                        <?php
                            $checked = ($isEdit && in_array($category["id"], $selectedCategories) ? "checked" : "");
                        ?>
                        <input type="checkbox"
                        id="category_<?php echo $category["id"]; ?>"
                        name="categories[]"
                        value="<?php echo $category["id"]; ?>"
                        <?php echo $checked; ?>
                        >
                        <label for="category_<?php echo $category["id"]; ?>">
                            <?php echo $category["name"]; ?>
                        </label>
                    </div>
                    
                <?php } ?>
</div>
                    
        </div>


