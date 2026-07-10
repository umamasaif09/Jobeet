<div class="admin-section">

   <div class="section-header">
         <h2><?= $this->lang->line("existing_jobs"); ?></h2>

        <a href="<?php echo site_url("admin/createJob"); ?>" class="btn btn-primary">
            <?= $this->lang->line("add_job"); ?>
        </a>
    </div>
        

    <div class="table-wrapper">
        <table class="admin-table jobs-table">
            <thead>
                <tr>
                    <th><strong><?= $this->lang->line("job_details"); ?></strong></th>
                    <th><strong><?= $this->lang->line("company_details"); ?></strong></th>
                    <th><strong><?= $this->lang->line("status"); ?></strong></th>
                    <th class="actions-column"><?= $this->lang->line("actions"); ?></th>
                </tr>
            </thead>

            <tbody>
                    <?php foreach($jobs as $job) { ?>

                        <tr>
                            <td>
                                <div class="job-title">
                                    <?php echo $job["position"]; ?>
                                </div>

                                <div class="job-meta">
                                    <strong>Job ID:</strong> <?php echo $job["id"]; ?>
                                </div>

                                <div class="job-meta">
                                    <strong>Category ID:</strong> <?php echo $job["category_id"]; ?>
                                </div>
                                
                                <div class="job-meta">
                                    <strong>Type:</strong> <?php echo $job["type"]; ?>
                                </div>
                                
                            </td>
                            
                            <td>
                                <div class="company-name">
                                    <?php echo $job["company"]; ?>
                                </div>    

                                <div class="job-meta">
                                    <strong>Email:</strong> <?php echo $job["email"]; ?>
                                </div>

                                <div class="job-meta">
                                    <strong>Location:</strong> <?php echo $job["location"]; ?> 
                                </div>
                            </td>
                            

                            <td>
                                <div class="job-meta">
                                    <?php if($job["is_active"]) {?>
                                    <span class="badge active">Active</span>
                                    <?php } else { ?>
                                        <span class="badge inactive">Active</span>
                                    <?php } ?>
                                </div>
                                

                                <div class="job-meta">
                                    <strong>Expires:</strong> <?php echo date("d M Y", strtotime($job["expires_at"])); ?>
                                </div>
                               
                                <div class="job-meta">
                                    <?php if($job["is_public"]) {?>
                                    <span class="badge public">Public</span>
                                    <?php } else { ?>
                                        <span class="badge private">Private</span>
                                    <?php } ?>
                                </div>
                                
                            </td>
                            
                            <td class="actions">
                                <a href="<?php echo site_url("admin/viewJob/".$job["id"]) ?>" class="btn btn-primary"> 
                                    <?= $this->lang->line("view"); ?>
                                </a>

                                <a href="<?php echo site_url("admin/editJob/".$job["id"]) ?>" class="btn btn-warning"> 
                                    <?= $this->lang->line("edit"); ?>
                                </a>

                                <a href="<?php echo site_url("admin/deleteJob/".$job["id"]); ?>" 
                                    onclick="return confirm('Delete this job?')" class="btn btn-danger">
                                    
                                    <?= $this->lang->line("delete"); ?>
                                </a>
                            </td>
                        </tr>
                        
                        
                    <?php } ?>
            </tbody>
        </table>
    </div>
</div>
            