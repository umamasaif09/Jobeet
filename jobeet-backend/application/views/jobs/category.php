
<div class="category-section">
    <div class="section-header">
        <h2 class="category-title" ><?php echo $result["category"]["name"] ?></h2>
    </div>
    
        
    <div class="jobs-table-card">
        <table class="jobs-table">
            <thead>
                    <tr>
                        <th>Position</th>
                        <th>Location</th>
                        <th>Company</th>
                    </tr>
            </thead>

            <tbody>
                <?php foreach($result["jobs"] as $job) {?>
        
                    <tr>
                        <td><a href="<?php echo site_url("jobs/job/".$job["id"]); ?>" class="job-title"> <?php echo $job["position"]; ?></a></td>
                        <td> <?php echo $job["location"]; ?></td>
                        <td> <?php echo $job["company"]; ?></td>
                    </tr>
                
                <?php }?>
            </tbody>
        </table>
</div>
    

         
        
    <p class="page-info"><?php echo $result["totalJobs"]; ?> Jobs in this category</p>
        
        
        
    <div class="pagination">
        <?php if($currentPage >1 ) { ?>
            <a href="<?php echo site_url("jobs/category/". $result["category"]["id"]."/".($currentPage-1)); ?>"> ← Previous </a>
        <?php } else {?>
            <span></span>
        <?php }?>

        <span class="page-number">
            Page <?php echo $currentPage; ?> of <?php echo $result["totalPages"];?>
        </span>
    
        <?php if($currentPage < $result["totalPages"] ) { ?>
            <a href="<?php echo site_url("jobs/category/". $result["category"]["id"]."/".($currentPage+1)); ?>"> Next → </a>
        <?php } ?>
    </div>
</div>

