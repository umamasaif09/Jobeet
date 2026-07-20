<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title)? $title: "Jobeet"; ?></title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/public_style.css"); ?>">
    <script src="<?php echo base_url("assets/js/public.js"); ?>"></script>
</head>
<body>
    <div class="container">
        <?php $this->load->view("partials/header"); ?>
        <?php if(!empty($showPageHeader)): ?>
            <?php $this->load->view("partials/pageHeader"); ?>
        <?php endif; ?>


        <?php $this->load->view($content); ?>


        <?php $this->load->view("partials/footer"); ?>
        </div>
</body>
</html>