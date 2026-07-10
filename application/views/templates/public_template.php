<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title)? $title: "Jobeet"; ?></title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>
    <?php $this->load->view("partials/header"); ?>
    <?php if(!empty($showPageHeader)): ?>
        <?php $this->load->view("partials/pageHeader"); ?>
    <?php endif; ?>

    <div>
        <?php $this->load->view($content); ?>
    </div>

    <?php $this->load->view("partials/footer"); ?>
</body>
</html>