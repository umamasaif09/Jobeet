<div class="container">
    <div class="page-header">
    <?php if (isset($backUrl)) {?> 
        <a href="<?php echo $backUrl; ?>" class="btn">
            ← Back
        </a>
    <?php }?>
    <?php if(isset($title)) {?>
        
            <h2><?php echo $title; ?></h2>

    <?php }?>
</div>
</div>