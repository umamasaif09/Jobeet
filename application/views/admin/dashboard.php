    <div class="container">
        <div class = "admin-title">
            <h1>Admin Dashboard</h1>
        </div>
    </div>

    
    <?php $this->load->view("partials/adminHeader"); ?>

    <div class="container">
        

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
    </div>

    
</body>
</html>