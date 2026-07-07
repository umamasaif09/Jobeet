
<?php $this->load->view("partials/header", [
    "title" => $title
]); ?>
    
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
   
   
<?php $this->load->view("partials/footer"); ?>