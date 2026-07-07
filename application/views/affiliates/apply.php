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
        <form method="POST" action="<?php echo site_url("affiliates/submitApplication"); ?>">
            Name <input type="text" name="name"> <br><br>
            Email <input type="text" name="email"><br><br>
            Website <input type="text" name="site_url"><br><br>

            Categories <br>
            <?php foreach($categories as $category) { ?>
                <input type="checkbox"
                name="categories[]"
                value="<?php echo $category["id"]; ?>"
                >
                <?php echo $category["name"]; ?><br>
            <?php } ?>
            <br><br>
            <button type="submit">Apply</button>
        </form>
    </section>

    <footer>
        <a href="">About Jobeet</a>
        <a href="">Full RSS Feed</a>
        <a href="http://jobeet.test/index.php/api/jobs?token=&limit=&category=">Jobeet API</a>
        <a href="<?php echo site_url("affiliates/apply"); ?>">Affiliates</a>
    </footer>
</body>
</html>