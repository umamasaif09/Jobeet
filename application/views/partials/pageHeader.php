<div class="container">
    <div class="page-header">

        <!-- <a href="<?php echo $backUrl; ?>" class="btn">
            ← Back
        </a> -->
        <button onclick= "history.back()" class="btn">← Back</button>

    <?php if(isset($title)) {?>
        
            <h2><?php echo $title; ?></h2>

    <?php }?>
</div>
</div>