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
    <section>
        <a href="<?php echo site_url("admin/categories"); ?>">
            <button>Manage Categories</button>
        </a>
        <br><br>
        <a href="<?php echo site_url("admin/jobs"); ?>">
            <button>Manage Jobs</button>
        </a>
        <br><br>
        <a href="<?php echo site_url("admin/affiliates"); ?>">
            <button>Manage Affiliates</button>
        </a>
    </section>
</body>
</html>