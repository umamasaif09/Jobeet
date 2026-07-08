<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head> <title><?= $this->lang->line("dashboard"); ?></title>
     <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>

    <header>
        <h1><?= $this->lang->line("dashboard"); ?></h1>
    </header>
    <?php $this->load->view("partials/adminHeader"); ?>

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
</body>
</html>