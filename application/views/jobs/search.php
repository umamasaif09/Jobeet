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
        <h1>Search Results for "<?php echo $keyword; ?>"</h1>
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
        
        <hr>
       <?php if(empty($jobs) or empty($keyword)) { ?>
            <p> No Results Found for this Search. </p>
            <?php } else { ?> 
    
                <table>
                    <thead>
                            <tr>
                                <th>Location</th>
                                <th>Position</th>
                                <th>Company</th>
                                <th>Category</th>
                            </tr>
                    </thead>

                    <tbody>
                        

                            <?php foreach($jobs as $job) {?>
                    
                                <tr>
                                    <td> <?php echo $job["location"]; ?></td>
                                    <td><a href="<?php echo site_url("jobs/job/".$job["id"]); ?>"> <?php echo $job["position"]; ?></a></td>
                                    <td> <?php echo $job["company"]; ?></td>
                                    <td> <?php echo $job["name"]; ?></td>
                                </tr>
                            
                            <?php }?>
                        
                    </tbody>
                </table>
        
        <?php }?>

       
    </section>

    <footer>
        <a href="">About Jobeet</a>
        <a href="">Full RSS Feed</a>
        <a href="http://jobeet.test/index.php/api/jobs?token=&limit=&category=">Jobeet API</a>
        <a href="<?php echo site_url("affiliates/apply"); ?>">Affiliates</a>
    </footer>

</body>
</html>