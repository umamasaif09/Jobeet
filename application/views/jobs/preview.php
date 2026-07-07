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
        <p><strong>Category: </strong><?php echo $category;?></p>
        <p><strong>Type: </strong><?php echo $type;?></p>
        <p><strong>Company: </strong><?php echo $company;?></p>

        <p><strong>Logo: </strong></p>
        <img src="<?php echo base_url("uploads/".$logo); ?>" alt="Company Logo" width="150">

        <p><strong>Webiste: </strong><a href="<?php echo $url; ?>"><?php echo $url;?></a></p>

        <p><strong>Position: </strong><?php echo $position;?></p>
        <p><strong>Location: </strong><?php echo $location;?></p>
        <p><strong>Email: </strong><a href="mailto:<?php echo $email; ?>"><?php echo $email;?></a></p>

        <p><strong>Description: </strong></p>
        <p><?php echo nl2br($description); ?></p>

        <p><strong>How to Apply: </strong></p>
        <p><?php echo nl2br($how_to_apply); ?></p>

        <p><strong>Public: </strong><?php echo $is_public ? "Yes" : "No"; ?></p>
        
        <form method="POST" action="<?php echo site_url("jobs/postJob"); ?>" enctype= "multipart/form-data">
             <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
             <input type="hidden" name="type" value="<?php echo $type; ?>">
             <input type="hidden" name="company" value="<?php echo $company; ?>">
             <input type="hidden" name="url" value="<?php echo $url; ?>">
             <input type="hidden" name="position" value="<?php echo $position; ?>">
             <input type="hidden" name="location" value="<?php echo $location; ?>">
             <input type="hidden" name="email" value="<?php echo $email; ?>">
             <input type="hidden" name="description" value="<?php echo $description; ?>">
             <input type="hidden" name="how_to_apply" value="<?php echo $how_to_apply; ?>">
             <input type="hidden" name="is_public" value="<?php echo $is_public; ?>">
             <input type="hidden" name="logo" value="<?php echo $logo; ?>">

            
            
            <button type="submit">Create Job Post</button>
            
            
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