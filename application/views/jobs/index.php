
<div class="container">
    <?php foreach($categories as $categoryId =>$category) { ?>

    <div class="category-section">
    <h2 class="category_titl">
        <a href="<?php echo site_url("jobs/category/".$categoryId); ?>"><?php echo $category["name"]; ?></a>
    </h2>
   
    <table class="job-table">
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
    </div>
</div>
