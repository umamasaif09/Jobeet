<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head> <title>Admin Dashboard</title>
     <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>

    <header>
        <h1>Admin Dashboard</h1>
    </header>
    <?php $this->load->view("partials/adminHeader"); ?>

    <section class="dashboard">

        <div class= "dashboard-cards">
            <div class= "card">
                <h3>Categories</h3>
                <p><?php echo $totalCategories; ?></p>
                <small>Total Categories</small>
            </div>

            <div class= "card">
                <h3>Jobs</h3>
                <p><?php echo $totalJobs; ?></p>
                <small>Total Jobs</small>
            </div>

            <div class= "card">
                <h3>Affiliates</h3>
                <p><?php echo $totalAffiliates; ?></p>
                <small>Total Affiliates</small>
            </div>

        </div>
    </section>
</body>
</html>