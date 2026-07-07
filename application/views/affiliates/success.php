<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head> <title><?php echo $title; ?></title>
     <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">

</head>
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
        <h1>
            Your request has been submitted!
        </h1>

        <h2>
            Thank you, <?php echo $affiliate["name"];?>.
        </h2>

        <p>Your affiliate application has been submitted.</p>

        <p>Your account will be activated by an administrator.</p>
           
       
    </section>

    <footer>
        <a href="">About Jobeet</a>
        <a href="">Full RSS Feed</a>
        <a href="http://jobeet.test/index.php/api/jobs?token=&limit=&category=">Jobeet API</a>
        <a href="<?php echo site_url("affiliates/apply"); ?>">Affiliates</a>
    </footer>
</body>
</html>