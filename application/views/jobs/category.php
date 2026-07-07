<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $result["category"]["name"]; ?></title>
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
        <h2><?php echo $result["category"]["name"] ?></h2>
        <hr>
       
    
        <table>
            <thead>
                    <tr>
                        <th>Location</th>
                        <th>Position</th>
                        <th>Company</th>
                    </tr>
            </thead>

            <tbody>
                <?php foreach($result["jobs"] as $job) {?>
        
                    <tr>
                        <td> <?php echo $job["location"]; ?></td>
                        <td><a href="<?php echo site_url("jobs/job/".$job["id"]); ?>"> <?php echo $job["position"]; ?></a></td>
                        <td> <?php echo $job["company"]; ?></td>
                    </tr>
                
                <?php }?>
            </tbody>
        </table>
         
        <p><?php echo $result["totalJobs"]; ?> Jobs in this category - Page <?php echo $currentPage. "/". $result["totalPages"]; ?></p>
        
        <div>
            <?php if($currentPage >1 ) { ?>
                <a href="<?php echo site_url("jobs/category/". $result["category"]["id"]."/".($currentPage-1)); ?>"> ← Previous </a>
            <?php } ?>
        </div>
        <div>
            <?php if($currentPage < $result["totalPages"] ) { ?>
                <a href="<?php echo site_url("jobs/category/". $result["category"]["id"]."/".($currentPage+1)); ?>"> Next → </a>
            <?php } ?>
        </div>
        

        

       
    </section>

    <footer>
        <a href="">About Jobeet</a>
        <a href="">Full RSS Feed</a>
        <a href="http://jobeet.test/index.php/api/jobs?token=&limit=&category=">Jobeet API</a>
        <a href="<?php echo site_url("affiliates/apply"); ?>">Affiliates</a>
    </footer>

</body>
</html>