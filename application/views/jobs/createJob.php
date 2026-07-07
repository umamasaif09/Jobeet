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
        <form method="POST" action="<?php echo site_url("jobs/preview"); ?>" enctype= "multipart/form-data">
             Category <select name="category_id" id="">
                <?php foreach($categories as $category) { ?>
                    <option value="<?php echo $category["id"]; ?>">
                        <?php echo $category["name"]; ?>
                    </option>
                <?php }?>
            </select><br><br>
            Type 
            <input type="radio" name="type" value="Full-time"> Full-time
            <input type="radio" name="type" value="Part-time"> Part-time
            <input type="radio" name="type" value="Freelance"> Freelance
            <br><br>

            Company <input type="text" name="company"> <br><br>
            Logo <input type="file" name="logo"><br><br>
            URL <input type="text" name="url"><br><br>
            Position <input type="text" name="position"><br><br>
            Location <input type="text" name="location"><br><br>
            Email <input type="text" name="email"><br><br>
            
            Description <textarea name="description" id=""></textarea><br><br>
            How to Apply <textarea name="how_to_apply" id=""></textarea><br><br>

            Public <input type="checkbox" name="is_public" value="1"><br><br>

            
            
            <button type="submit">Preview</button>
            
            
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