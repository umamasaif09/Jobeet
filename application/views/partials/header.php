<!DOCTYPE html>
<html>
<head> <title><?php echo $title; ?></title>
        <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">

</head>

<body>
    <header>
        <h1>Jobeet</h1>
        
       
        <nav class="top-bar">
            <a href="<?php echo site_url("jobs/index"); ?>">Home</a>

            <form method = "GET" action="<?php echo site_url("jobs/search"); ?>" class="search-form">
            <input type="text" name="keyword" placeholder = "Live Search" required>
            <button type="submit" class="btn-primary">Search Keyword</button>
            </form>
        
            <a href="<?php echo site_url("jobs/createJob"); ?>" class="btn-primary">
                Post a Job
            </a>
        </nav>
        

    </header>

    