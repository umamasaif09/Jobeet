 
    <?php if(empty($jobs) or empty($keyword)) { ?>
        <p> No Results Found for this Search. </p>
        <?php } else { ?> 


        <div class="category-section">
            <div class="jobs-table-card">
                 <table class="jobs-table">
                <thead>
                        <tr>
                            <th>Position</th>
                            <th>Location</th>
                            <th>Company</th>
                            <th>Category</th>
                        </tr>
                </thead>

                <tbody>
                    

                        <?php foreach($jobs as $job) {?>
                
                            <tr>
                                <td><a href="<?php echo site_url("jobs/job/".$job["id"]); ?>" class="job-title"> <?php echo $job["position"]; ?></a></td>
                                <td> <?php echo $job["location"]; ?></td>
                                <td> <?php echo $job["company"]; ?></td>
                                <td> <?php echo $job["name"]; ?></td>
                            </tr>
                        
                        <?php }?>
                    
                </tbody>
            </table>
            </div>
        </div>
           
    
    <?php }?>


