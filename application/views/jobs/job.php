<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
     <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>
    <header>
        <h1>Jobeet</h1>
        <a href="<?php echo site_url("jobs/index"); ?>">Home</a>
    </header>

    <section>
        <div class="top-bar"><form method = "GET" action="<?php echo site_url("jobs/search"); ?>">
            <input type="text" name="keyword" placeholder = "Live Search">
            <button>Search</button>
        </form>
        
        <a href="<?php echo site_url("jobs/createJob"); ?>">
            <button type="button">Post a Job</button>
        </a></div>

        
    </section>

    <section>
        <h2>
            <?php echo $job["company"]; ?>
            <img src="<?php echo base_url("uploads/".$job["logo"]); ?>" alt="Company Logo" width="100" style="float: right;">
        </h2>
        <h3><?php echo $job["location"]; ?></h3>
        <hr>
        <h4><?php echo $job["position"]; ?></h4>
        <hr>
        <p><?php echo $job["description"]; ?></p>
        <br>
        <h5>How to apply?</h5>
        <p><?php echo $job["how_to_apply"]; ?></p>

    </section>

    <footer>
        <a href="">About Jobeet</a>
        <a href="">Full RSS Feed</a>
        <a href="http://jobeet.test/index.php/api/jobs?token=&limit=&category=">Jobeet API</a>
        <a href="<?php echo site_url("affiliates/apply"); ?>">Affiliates</a>
</body>
</html>