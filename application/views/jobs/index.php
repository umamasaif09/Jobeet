

<!DOCTYPE html>
<html>
<head> <title><?php echo $title; ?></title>
        <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">

</head>

<body>
    <header>
        <h1>Jobeet</h1>
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
         <?php foreach($categories as $categoryId =>$category) { ?>
    
        <a href="<?php echo site_url("jobs/category/".$categoryId); ?>"><?php echo $category["name"]; ?></a>
        <table>
            <thead>
                    <tr>
                        <th>Location</th>
                        <th>Position</th>
                        <th>Company</th>
                    </tr>
            </thead>

            <tbody>
                <?php foreach($category["jobs"] as $job) {?>
        
                    <tr>
                        <td> <?php echo $job["location"]; ?></td>
                        <td><a href="<?php echo site_url("jobs/job/".$job["id"]); ?>"> <?php echo $job["position"]; ?></a></td>
                        <td> <?php echo $job["company"]; ?></td>
                    </tr>
                
                <?php }?>
            </tbody>
        </table>
            
        <?php } ?>
            
    </section>
   
    <footer>
        <a href="">About Jobeet</a>
        <a href="">Full RSS Feed</a>
        <a href="http://jobeet.test/index.php/api/jobs?token=&limit=&category=">Jobeet API</a>
        <a href="<?php echo site_url("affiliates/apply"); ?>">Affiliates</a>
    </footer>

</body>
</html>