<header>
    <nav>
        <a href="<?php echo site_url('admin/affiliates'); ?>">
            <button type="button">← Back</button>
        </a>
        <a href="<?php echo site_url("admin/categories"); ?>">
            <button><?= $this->lang->line("manage_categories"); ?></button>
        </a>
        <a href="<?php echo site_url("admin/jobs"); ?>">
            <button><?= $this->lang->line("manage_jobs"); ?></button>
        </a>
        <a href="<?php echo site_url("admin/affiliates"); ?>">
            <button><?= $this->lang->line("manage_affiliates"); ?></button>
        </a>
        
    </nav>
</header>