<?php $active = isset($active)? $active: ''; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
<div class="container">
    <header class = "admin-title">
    <nav class = "admin-nav">
        <a href="<?php echo site_url('admin/dashboard'); ?>" class="nav-item <?php echo($active == 'dashboard')? 'active' : ''; ?>">
            <?= $this->lang->line("dashboard"); ?>
        </a>
        <a href="<?php echo site_url("admin/categories"); ?>" class="nav-item <?php echo($active == 'categories')? 'active' : ''; ?>">
            <?= $this->lang->line("manage_categories"); ?>
        </a>
        <a href="<?php echo site_url("admin/jobs"); ?>" class="nav-item <?php echo($active == 'jobs')? 'active' : ''; ?>">
            <?= $this->lang->line("manage_jobs"); ?>
        </a>
        <a href="<?php echo site_url("admin/affiliates"); ?>" class="nav-item <?php echo($active == 'affiliates')? 'active' : ''; ?>">
            <?= $this->lang->line("manage_affiliates"); ?>
        </a>
        
    </nav>
</header>
</div>