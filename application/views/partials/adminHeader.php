<?php $active = isset($active)? $active: ''; ?>

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