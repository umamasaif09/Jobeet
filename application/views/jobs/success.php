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
        <h2>Job Created Successfully</h2>

        <p>Save this link to edit your job later: </p>
        <a href="<?php echo site_url("jobs/edit/".$jobId."/".$token) ;?>"><p><?php echo site_url("jobs/edit/".$jobId."/".$token) ;?></p></a>

        
        <br><br>

        <p><strong>Category: </strong><?php echo $category["name"];?></p>
        <p><strong>Type: </strong><?php echo $job["type"];?></p>
        <p><strong>Company: </strong><?php echo $job["company"];?></p>

        <p><strong>Logo: </strong></p>
        <img src="<?php echo base_url("uploads/".$job["logo"]); ?>" alt="Company Logo" width="150">

        <p><strong>Webiste: </strong><a href="<?php echo $job["url"]; ?>"><?php echo $job["url"];?></a></p>

        <p><strong>Position: </strong><?php echo $job["position"];?></p>
        <p><strong>Location: </strong><?php echo $job["location"];?></p>
        <p><strong>Email: </strong><a href="mailto:<?php echo $job["email"]; ?>"><?php echo $job["email"];?></a></p>

        <p><strong>Description: </strong></p>
        <p><?php echo nl2br($job["description"]); ?></p>

        <p><strong>How to Apply: </strong></p>
        <p><?php echo nl2br($job["how_to_apply"]); ?></p>

        <p><strong>Public: </strong><?php echo $job["is_public"] ? "Yes" : "No"; ?></p>
        
    
    </section>
    
    <footer>
        <a href="">About Jobeet</a>
        <a href="">Full RSS Feed</a>
        <a href="http://jobeet.test/index.php/api/jobs?token=&limit=&category=">Jobeet API</a>
        <a href="<?php echo site_url("affiliates/apply"); ?>">Affiliates</a>
    </footer>

</body>
</html>