<?php $active = isset($active)? $active: ''; ?>

<header class = "admin-title">
    <nav class = "admin-nav">
        <a href="<?php echo site_url('admin/dashboard'); ?>" class="nav-item <?php echo($active == 'dashboard')? 'active' : ''; ?>">
            Dashboard
        </a>
        <a href="<?php echo site_url("admin/categories"); ?>" class="nav-item <?php echo($active == 'categories')? 'active' : ''; ?>">
            Manage Categories
        </a>
        <a href="<?php echo site_url("admin/jobs"); ?>" class="nav-item <?php echo($active == 'jobs')? 'active' : ''; ?>">
            Manage Jobs
        </a>
        <a href="<?php echo site_url("admin/affiliates"); ?>" class="nav-item <?php echo($active == 'affiliates')? 'active' : ''; ?>">
            Manage Affiliates
        </a>
        
    </nav>
</header>