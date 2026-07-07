<?php $isEdit= isset($job); ?>

Category <select name="category_id" id="">


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
            
            <br><br>

            Type 
            <input type="radio" name="type" value="Full-time"
                <?php if($isEdit && $job["type"]=="Full-time"){
                    echo "checked";
                } ?>
            > Full-time

            <input type="radio" name="type" value="Part-time"
                <?php if($isEdit && $job["type"]=="Part-time"){
                    echo "checked";
                } ?>
            > Part-time

            <input type="radio" name="type" value="Freelance"
                <?php if($isEdit && $job["type"]=="Freelance"){
                    echo "checked";
                } ?>
            > Freelance
            <br><br>

            Company <input type="text" name="company"
                value="<?php echo $isEdit ? $job["company"] : ''; ?>"
            > <br><br>

            <?php if($isEdit) { ?>
                Current Logo <img src="<?php echo base_url("uploads/".$job["logo"]); ?>"  width= "150">
                <input type="hidden" name= "old_logo" value="<?php echo $job["logo"]; ?>">
                <br><br>
                Upload New Logo <input type="file" name="logo" >
            <?php } else { ?>
                Logo <input type="file" name="logo">
            <?php } ?>
            <br><br>

            
                
            ><br><br>
            URL <input type="text" name="url"
                value="<?php echo $isEdit ? $job["url"] : ''; ?>"
            ><br><br>
            Position <input type="text" name="position"
                value="<?php echo $isEdit ? $job["position"] : ''; ?>"
            ><br><br>
            Location <input type="text" name="location"
                value="<?php echo $isEdit ? $job["location"] : ''; ?>"
            ><br><br>
            Email <input type="text" name="email"
                value="<?php echo $isEdit ? $job["email"] : ''; ?>"
            ><br><br>

            Description <textarea name="description" id=""><?php echo $isEdit ? $job["description"]: '' ?></textarea><br><br>
            How to Apply <textarea name="how_to_apply" id=""><?php echo $isEdit ? $job["how_to_apply"]: '' ?></textarea><br><br>

            Public <input type="checkbox" name="is_public" value="1" <?php
                if($isEdit && $job["is_public"]) {
                    echo "checked";
                }
             ?>><br><br>

