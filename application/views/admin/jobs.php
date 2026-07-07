<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>
     <?php $this->load->view("partials/adminHeader"); ?>

    

    <section>
        <h2>Add a Job</h2>
        <section>
            <form method="POST" action="<?php echo site_url("jobs/createJob"); ?>" enctype= "multipart/form-data">
                

                
                
                <button type="submit">Create Job</button>
                
                
            </form>
        </section>
    </section>

    <section>
        <h2>Existing Jobs</h2>
        <table>
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
                                <a href="<?php echo site_url("admin/viewJob/".$job["id"]) ?>"> 
                                    <button type="button">View</button>
                                </a>

                                <a href="<?php echo site_url("admin/editJob/".$job["id"]) ?>"> 
                                    <button type="button">Edit</button>
                                </a>

                                <a href="<?php echo site_url("admin/deleteJob/".$job["id"]) ?>" 
                                    onclick="return confirm('Delete this job?')">
                                    
                                    <button type="button" >Delete</button>
                                </a>
                            </td>
                        </tr>
                        
                        
                    <?php } ?>
            </tbody>
        </table>
    </section>

    
</body>
</html>