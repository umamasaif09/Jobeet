
<?php $active = isset($active)? $active: ''; ?>
<div class="admin-header">

        <nav class = "admin-nav">
            <button class="nav-menu" aria-label="Toggle navigation">
              ☰
          </button>

          <a class="mobile-heading" href= "/jobs/">Jobeet</a>
          <div class="mobile-menu">

            <a href="<?php echo site_url('admin/dashboard'); ?>" <?php echo($active == 'dashboard')? 'active' : ''; ?>">
                <?= $this->lang->line("dashboard"); ?>
                </a>
                <a href="<?php echo site_url("admin/categories"); ?>" <?php echo($active == 'categories')? 'active' : ''; ?>">
                    <?= $this->lang->line("manage_categories"); ?>
                </a>
                <a href="<?php echo site_url("admin/jobs"); ?>" <?php echo($active == 'jobs')? 'active' : ''; ?>">
                    <?= $this->lang->line("manage_jobs"); ?>
                </a>
                <a href="<?php echo site_url("admin/affiliates"); ?>" <?php echo($active == 'affiliates')? 'active' : ''; ?>">
                    <?= $this->lang->line("manage_affiliates"); ?>
                </a>
                <a href="<?php echo site_url("admin/admins"); ?>" <?php echo($active == 'admins')? 'active' : ''; ?>">
                    Manage Admins
                </a>
                <a href="<?php echo site_url('admin/logout'); ?>" onclick="return confirm('Are you sure you want to logout?')">
                    Logout
                </a>
          </div>
            <div class= "nav-right">
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
                <a href="<?php echo site_url("admin/admins"); ?>" class="nav-item <?php echo($active == 'admins')? 'active' : ''; ?>">
                    Manage Admins
                </a>

                <a href="<?php echo site_url('admin/logout'); ?>" class="nav-item logout-btn" onclick="return confirm('Are you sure you want to logout?')">
                    Logout
                </a>
            </div>
        
    </nav>

</div>
