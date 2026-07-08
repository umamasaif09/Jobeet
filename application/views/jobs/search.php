<?php $this->load->view("partials/header", [
    "title" => $title
]); ?>

<?php $this->load->view("partials/pageHeader"); ?>

    <div class="container">
        <section>
        
       <?php if(empty($jobs) or empty($keyword)) { ?>
            <p> No Results Found for this Search. </p>
            <?php } else { ?> 
    
                <table class="job-table">
                    <thead>
                            <tr>
                                <th>Location</th>
                                <th>Position</th>
                                <th>Company</th>
                                <th>Category</th>
                            </tr>
                    </thead>

                    <tbody>
                        

                            <?php foreach($jobs as $job) {?>
                    
                                <tr>
                                    <td> <?php echo $job["location"]; ?></td>
                                    <td><a href="<?php echo site_url("jobs/job/".$job["id"]); ?>"> <?php echo $job["position"]; ?></a></td>
                                    <td> <?php echo $job["company"]; ?></td>
                                    <td> <?php echo $job["name"]; ?></td>
                                </tr>
                            
                            <?php }?>
                        
                    </tbody>
                </table>
        
        <?php }?>

       
    </section>
    </div>

    

   <?php $this->load->view("partials/footer"); ?>