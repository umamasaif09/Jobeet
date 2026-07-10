<div  class = "form-group">
    <label>Affiliate Name</label>
    <input type="text" name= "name" placeholder = "Enter affiliate name" required>
</div>
        
<div class = "form-group">
    <label>Email</label>
    <input type="email" name= "email" placeholder = "Enter affiliate email" required>
</div>

<div class = "form-group">
    <label>Website</label>
    <input type="url" name= "url" placeholder= "Enter affiliate website url" required>
</div>

<div class = "form-group">
    <fieldset>
        <legend>Categories</legend>
        
        <?php foreach($categories as $category) { ?>
        
            <div class="checkbox-group">
                <input type="checkbox"
                id="category_<?php echo $category["id"]; ?>"
                name="categories[]"
                value="<?php echo $category["id"]; ?>"
                >
                <label for="category_<?php echo $category["id"]; ?>">
                    <?php echo $category["name"]; ?>
                </label>
            </div>
            
        <?php } ?>
    </fieldset>
            
</div>