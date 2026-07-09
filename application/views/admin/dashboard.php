    <div class="container">
        <div class = "admin-title">
            <h1><?= $this->lang->line("dashboard"); ?></h1>
        </div>
    </div>

    
    <?php $this->load->view("partials/adminHeader"); ?>

    <div class="container">
        

        <section class="dashboard">

        <div class= "dashboard-cards">
            <div class= "card">
                <h3><?= $this->lang->line("categories"); ?></h3>
                <p><?php echo $totalCategories; ?></p>
                <small><?= $this->lang->line("total_categories"); ?></small>
            </div>

            <div class= "card">
                <h3><?= $this->lang->line("jobs"); ?></h3>
                <p><?php echo $totalJobs; ?></p>
                <small><?= $this->lang->line("total_jobs"); ?></small>
            </div>

            <div class= "card">
                <h3><?= $this->lang->line("affiliates"); ?></h3>
                <p><?php echo $totalAffiliates; ?></p>
                <small><?= $this->lang->line("total_affiliates"); ?></small>
            </div>

        </div>
    </section>
    </div>

    
</body>
</html>