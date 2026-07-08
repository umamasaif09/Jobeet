<?php $this->load->view("partials/header", [
    "title" => $title
]); ?>

    <section>
        <div class="category-section">
            <h2><?php echo $result["category"]["name"] ?></h2>
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
        </div>
         
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

    <?php $this->load->view("partials/footer"); ?>