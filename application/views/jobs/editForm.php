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

    <p><strong>Category: </strong><?php echo $job["company"];?></p>
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


    <section>
        <form method="POST" action="<?php echo site_url("jobs/updateJob"); ?>" enctype= "multipart/form-data">

        <input type="hidden" name="id" value= "<?php echo $job["id"]; ?>">
        <input type="hidden" name="token" value= "<?php echo $job["token"]; ?>">

             Category <select name="category_id" id="">
                <?php foreach($categories as $category) { ?>
                    <option value="<?php echo $category["id"]; ?>"
                        <?php 
                            if($category["id"]==$job["category_id"])
                                echo "selected";
                        ?>
                        >
                        <?php echo $category["name"]; ?>

                    </option>
                <?php }?>
            </select><br><br>
            Type 
            <input type="radio" name="type" value="Full-time"
                <?php if($job["type"] == "Full-time")
                    echo "checked"; 
                ?>
            > Full-time
            <input type="radio" name="type" value="Part-time"
                <?php if($job["type"] == "Part-time")
                    echo "checked"; 
                ?>
            > Part-time
            <input type="radio" name="type" value="Freelance"
                <?php if($job["type"] == "Freelance")
                    echo "checked"; 
                ?>
            > Freelance
            <br><br>

            Company <input type="text" name="company" value="<?php echo $job["company"]; ?>"> <br><br>

            Current Logo <img src="<?php echo base_url("uploads/".$job["logo"]); ?>"  width= "150">
            <input type="hidden" name= "old_logo" value="<?php echo $job["logo"]; ?>">
            <br><br>
            Upload New Logo <input type="file" name="logo" ><br><br>

            URL <input type="text" name="url" value="<?php echo $job["url"]; ?>"><br><br>
            Position <input type="text" name="position" value="<?php echo $job["position"]; ?>"><br><br>
            Location <input type="text" name="location" value="<?php echo $job["location"]; ?>"><br><br>
            Email <input type="text" name="email" value="<?php echo $job["email"]; ?>"><br><br>
            
            Description <textarea name="description" id="" ><?php echo $job["description"]; ?></textarea><br><br>
            How to Apply <textarea name="how_to_apply" id="" ><?php echo $job["how_to_apply"]; ?></textarea><br><br>

            Public <input type="checkbox" name="is_public" value="1" 
                <?php
                    if($job["is_public"])
                        echo "checked";
                ?>
            ><br><br>

            <?php if($job["daysRemaining"] <= 5) { ?> 
                <form action="<?php echo site_url("jobs/extendJob"); ?>" method="POST">
                    <input type="hidden" name="id" value= "<?php echo $job["id"]; ?>">
                    <input type="hidden" name="token" value= "<?php echo $job["token"]; ?>">

                    <button type="submit">Extend Job for 30 days</button>
                </form>
            <?php }?>
            
            <button type="submit">Update</button>
            
            
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