<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title)? $title: "Admin"; ?></title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/admin_style.css"); ?>">
    <script src="<?php echo base_url("assets/js/admin.js"); ?>"></script>
</head>
<body>
    <div class="container">
        <?php if(!isset($showAdminHeader) || $showAdminHeader): ?>
            <?php $this->load->view("partials/adminHeader"); ?>
        <?php endif; ?>

        <?php if(!empty($showPageHeader)): ?>
            <?php $this->load->view("partials/pageHeader"); ?>
        <?php endif; ?>
        
        <?php $this->load->view($content); ?>
        </div>
        
</body>
</html>