<?php $isEdit= isset($job); ?>

<div class="form-group">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id">
      <option value="" disabled selected>Select Category</option>
         <?php foreach($categories as $category) { ?>
                    <option value="<?php echo $category["id"]; ?>"
                        <?php
                            if($isEdit && $category["id"] == $job["category_id"]) {
                                echo "selected";
                            }
                        ?>
                    >
                        <?php echo $category["name"]; ?>
                    </option>
                <?php }?>
    </select>

</div>

<div class= "form-group radio-row">
        <label for="type">Job Type </label>

        <div class="radio-options">
            <div class="radio-group">
                <input type="radio" name="type" value="Full-time"  id="full_time"
                    <?php if($isEdit && $job["type"]=="Full-time"){
                        echo "checked";
                    } ?>
                >
                <label for="full_time">Full-time</label>
            </div>

            <div class="radio-group">
                <input type="radio" name="type" value="Part-time"  id="part_time"
                        <?php if($isEdit && $job["type"]=="Part-time"){
                            echo "checked";
                        } ?>
                    >
                    <label for="part_time">Part-time</label>
            </div>

            <div class="radio-group">
                <input type="radio" name="type" value="Freelance"  id="freelance"
                        <?php if($isEdit && $job["type"]=="Freelance"){
                            echo "checked";
                        } ?>
                    >
                    <label for="freelance">Freelance</label>
            </div>
        </div>

</div>

<div class="form-group">
    <label for="company">Company Name</label>
    <input type="text" name="company" id="company" placeholder="Enter company name"
        value="<?php echo $isEdit ? $job["company"] : ''; ?>" required
    >
</div>

<div class="form-group">
    <label for="logo">Upload Logo</label>

    <div class="logo-upload">
        <img
            id="logo-preview"
            src="<?php echo !empty($job['logo']) ? base_url('uploads/'.$job['logo']) : ''; ?>"
            alt="Company Logo"
            <?php echo empty($job['logo']) ? 'style="display:none;"' : ''; ?>
        >

        <label for="logo" class="file-button">Choose File</label>
<input type="file" name="logo" id="logo" accept="image/*" hidden>
    </div>

    <?php if ($isEdit && !empty($job["logo"])) { ?>
        <input
            type="hidden"
            name="old_logo"
            value="<?php echo $job["logo"]; ?>"
        >
    <?php } ?>

</div>

<div class="form-group">
    <label for="url">Website Url</label>
    <input type="url" name="url" id="url" placeholder= "Enter website url"
        value="<?php echo $isEdit ? $job["url"] : ''; ?>" required>
</div>

<div class="form-group">
    <label for="position">Position</label>
    <input type="text" name="position" id="position" placeholder= "Enter position"
        value="<?php echo $isEdit ? $job["position"] : ''; ?>" required
        >
</div>

<div class="form-group">
    <label for="location">Location</label>
    <input type="text" name="location" id="location" placeholder="Enter location"
                value="<?php echo $isEdit ? $job["location"] : ''; ?>" required
            >
</div>

<div class="form-group">
    <label for="email">Company Email</label>
    <input type="email" name="email" id="email" placeholder="Enter company email"
                value="<?php echo $isEdit ? $job["email"] : ''; ?>" required
            >
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" placeholder="Enter job description here"><?php echo $isEdit ? $job["description"]: '' ?></textarea>
</div>

<div class="form-group">
    <label for="how_to_apply">How to apply</label>
    <textarea name="how_to_apply" id="how_to_apply" placeholder="Enter how to apply here"><?php echo $isEdit ? $job["how_to_apply"]: '' ?></textarea>
</div>

<div class="checkbox-group">
    <input type="checkbox"  id="is-public" name="is_public" value="1" <?php
                if($isEdit && $job["is_public"]) {
                    echo "checked";
                }
             ?>>
             <label for="is-public">Public Job Listing</label>
</div>


