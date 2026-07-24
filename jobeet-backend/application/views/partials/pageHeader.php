
<div class="page-header">

<div class ="page-header-left">

    <?php if (isset($showBackButton)) { ?>
        <button class="back-button">← Back</button>
    <?php } ?>

    <?php if(isset($title)) {?>
        
            <h2><?php echo $title; ?></h2>

    <?php }?>
</div>
    <?php if(isset($pageAction)) {?>
        <?php if(isset($pageAction['url'])) {?>

            <a href="<?php echo site_url($pageAction['url']); ?>"
            class= "btn btn-primary">
                <?php echo $pageAction['text']; ?>
            </a>
        <?php } else {?>
            <button type="button" class= "btn btn-primary" id="<?php echo $pageAction["id"]; ?>">
                <?php echo $pageAction['text']; ?>
            </button> 
        <?php }?>
    <?php }?>
</div>