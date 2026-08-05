

    <div class = "admin-title">
        <h2><?php echo $this->lang->line("dashboard"); ?></h2>
    </div>




    <section class="dashboard">

    <div class= "dashboard-cards">
        <div class= "card">
            <h3><?= $this->lang->line("categories"); ?></h3>
            <p class = "card-number"><?php echo $totalCategories; ?></p>
            <span class="card-label"><?= $this->lang->line("total_categories"); ?></span>
        </div>

        <div class= "card">
            <h3><?= $this->lang->line("jobs"); ?></h3>
            <p class = "card-number"><?php echo $totalJobs; ?></p>
            <span class="card-label"><?= $this->lang->line("total_jobs"); ?></span>
        </div>

        <div class= "card">
            <h3><?= $this->lang->line("affiliates"); ?></h3>
            <p class = "card-number"><?php echo $totalAffiliates; ?></p>
            <span class="card-label"><?= $this->lang->line("total_affiliates"); ?></span>
        </div>

        <div class= "card">
            <h3>Admins</h3>
            <p class = "card-number"><?php echo $totalAdmins; ?></p>
            <span class="card-label">Total Admins</span>
        </div>

    </div>
</section>

