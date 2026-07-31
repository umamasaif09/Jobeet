<section>
     <p><strong>Category: </strong><?php echo $category["name"];?></p>
    <p><strong>Type: </strong><?php echo $job["type"];?></p>
    <p><strong>Company: </strong><?php echo $job["company"];?></p>

    
    <?php if(!empty($job["logo"])) { ?>
        <p><strong>Logo: </strong></p>
        <img src="<?php echo base_url("uploads/".$job["logo"]); ?>" alt="Company Logo" width="150">
    <?php } ?>
    
    <p><strong>Webiste: </strong><a href="<?php echo $job["url"]; ?>"><?php echo $job["url"];?></a></p>

    <p><strong>Position: </strong><?php echo $job["position"];?></p>
    <p><strong>Location: </strong><?php echo $job["location"];?></p>
    <p><strong>Email: </strong><a href="mailto:<?php echo $job["email"]; ?>"><?php echo $job["email"];?></a></p>

    <p><strong>Description: </strong></p>
    <p><?php echo nl2br($job["description"]); ?></p>

    <p><strong>How to Apply: </strong></p>
    <p><?php echo nl2br($job["how_to_apply"]); ?></p>

    <p><strong>Public: </strong><?php echo $job["is_public"] ? "Yes" : "No"; ?></p>

    
    <?php if(
      isset($daysRemaining) &&
      isset($job["id"]) &&
      isset($job["token"]) &&
      $daysRemaining <= 5
    ) { ?> 
            <form action="<?php echo site_url("jobs/extendJob/".$job["id"]."/".$job["token"]); ?>" method="POST" class="extend-form">
                <input type="hidden" name="id" value= "<?php echo $job["id"]; ?>">
                <input type="hidden" name="token" value= "<?php echo $job["token"]; ?>">
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Extend Job for 30 days</button>
                </div>
                
            </form>
        <?php }?>
</section>
   
    


    