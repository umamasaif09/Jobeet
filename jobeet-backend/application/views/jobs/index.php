
    <?php foreach($categories as $categoryId =>$category) { ?>

    <div class="category-section">
        <div class="section-header">
             <h2 class="category-title">
                <a href="<?php echo site_url("jobs/category/".$categoryId); ?>"><?php echo $category["name"]; ?></a>
            </h2>
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
                    <?php foreach($category["jobs"] as $job) {?>
            
                        <tr>
                            <td><a href="<?php echo site_url("jobs/job/".$job["id"]); ?>" class="job-title"> <?php echo $job["position"]; ?></a></td>

                            <td><span>
                                <?php echo $job["location"]; ?>
                            </span></td>
                            
                            <td><span>
                                <?php echo $job["company"]; ?>
                            </span> </td>
                        </tr>
                    
                    <?php }?>
                </tbody>
            </table>
        </div>
        
            
        <?php } ?>
    </div>
