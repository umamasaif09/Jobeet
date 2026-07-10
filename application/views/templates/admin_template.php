<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title)? $title: "Admin"; ?></title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>
    <div class="container">
        <?php $this->load->view("partials/adminHeader"); ?>
        <?php if(!empty($showPageHeader)): ?>
            <?php $this->load->view("partials/pageHeader"); ?>
        <?php endif; ?>

    <div>
        <?php $this->load->view($content); ?>
    </div>
    </div>
</body>
</html>