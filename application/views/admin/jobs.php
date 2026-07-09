
     <?php $this->load->view("partials/adminHeader"); ?>

    <?php $this->load->view("partials/pageHeader"); ?>

    <div class="container">
        <section>
        <h2>Add a Job</h2>
        <section>
            <form method="POST" action="<?php echo site_url("jobs/createJob"); ?>" enctype= "multipart/form-data" class="admin-form">
                

                
                
                <button type="submit" clas="btn-primary">Create Job</button>
                
                
            </form>
        </section>
    </section>

    
    </div>

    <div class="table-container">
        <section>
            <h2>Existing Jobs</h2>

            <div class="table-wrapper">
                <table class="admin-table jobs-table">
                <thead>
                    <tr>
                        <th><strong>Job ID</strong></th>
                        <th><strong>Category ID</strong></th>
                        <th><strong>Company Name</strong></th>
                        <th><strong>Company Email</strong></th>
                        <th><strong>Position</strong></th>
                        <th><strong>Type</strong></th>
                        <th><strong>Location</strong></th>
                        <th><strong>Active Status</strong></th>
                        <th><strong>Expires At</strong></th>
                        <th><strong>Public Status</strong></th>
                        <th class="actions-column">Actions</th>
                    </tr>
                </thead>

                <tbody>
                        <?php foreach($jobs as $job) { ?>

                            <tr>
                                <td><?php echo $job["id"]; ?></td>
                                <td><?php echo $job["category_id"]; ?></td>
                                <td><?php echo $job["company"]; ?></td>
                                <td><?php echo $job["email"]; ?></td>
                                <td><?php echo $job["position"]; ?></td>
                                <td><?php echo $job["type"]; ?></td>
                                <td><?php echo $job["location"]; ?></td>

                                <td>
                                    <?php if($job["is_active"]) {
                                        echo "Active";
                                    } else {
                                        echo "Inactive";
                                    } ?>
                                </td>

                                <td><?php echo $job["expires_at"]; ?></td>
                                <td><?php if($job["is_public"]) {
                                    echo "Public";
                                } else {
                                    echo "Private";
                                } ?></td>
                                

                                <td class="actions">
                                    <a href="<?php echo site_url("admin/viewJob/".$job["id"]) ?>" class="btn-primary"> 
                                        View
                                    </a>

                                    <a href="<?php echo site_url("admin/editJob/".$job["id"]) ?>" class="btn-warning"> 
                                        Edit
                                    </a>

                                    <a href="<?php echo site_url("admin/deleteJob/".$job["id"]); ?>" 
                                        onclick="return confirm('Delete this job?')" class="btn-danger">
                                        
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            
                            
                        <?php } ?>
                </tbody>
            </table>
            </div>
            
        </section>
    </div>
    

    
</body>
</html>