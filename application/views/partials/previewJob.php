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
        
        
    </section>