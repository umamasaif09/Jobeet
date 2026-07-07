<form method="POST" action="<?php echo site_url("jobs/postJob"); ?>" enctype= "multipart/form-data">
    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
    <input type="hidden" name="type" value="<?php echo $type; ?>">
    <input type="hidden" name="company" value="<?php echo $company; ?>">
    <input type="hidden" name="url" value="<?php echo $url; ?>">
    <input type="hidden" name="position" value="<?php echo $position; ?>">
    <input type="hidden" name="location" value="<?php echo $location; ?>">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="description" value="<?php echo $description; ?>">
    <input type="hidden" name="how_to_apply" value="<?php echo $how_to_apply; ?>">
    <input type="hidden" name="is_public" value="<?php echo $is_public; ?>">
    <input type="hidden" name="logo" value="<?php echo $logo; ?>">
            
</form>