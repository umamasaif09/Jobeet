

<div class="container">

    <h2><?= $this->lang->line("add_job"); ?></h2>

        <form method="POST" action="<?php echo site_url("admin/createJob"); ?>" enctype= "multipart/form-data" class="admin-form">
         
            <button type="submit" clas="btn-primary"><?= $this->lang->line("create_job"); ?></button>
           
        </form>

</div>

<div class="table-container">

    <h2><?= $this->lang->line("existing_jobs"); ?></h2>

    <div class="table-wrapper">
        <table class="admin-table jobs-table">
            <thead>
                <tr>
                    <th><strong><?= $this->lang->line("job_id"); ?></strong></th>
                    <th><strong><?= $this->lang->line("category_id"); ?></strong></th>
                    <th><strong><?= $this->lang->line("company_nme"); ?></strong></th>
                    <th><strong><?= $this->lang->line("company_email"); ?></strong></th>
                    <th><strong><?= $this->lang->line("position"); ?></strong></th>
                    <th><strong><?= $this->lang->line("type"); ?></strong></th>
                    <th><strong><?= $this->lang->line("location"); ?></strong></th>
                    <th><strong><?= $this->lang->line("active_status"); ?></strong></th>
                    <th><strong><?= $this->lang->line("expires_at"); ?></strong></th>
                    <th><strong><?= $this->lang->line("public_status"); ?></strong></th>
                    <th class="actions-column"><?= $this->lang->line("actions"); ?></th>
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
                                    <?= $this->lang->line("view"); ?>
                                </a>

                                <a href="<?php echo site_url("admin/editJob/".$job["id"]) ?>" class="btn-warning"> 
                                    <?= $this->lang->line("edit"); ?>
                                </a>

                                <a href="<?php echo site_url("admin/deleteJob/".$job["id"]); ?>" 
                                    onclick="return confirm('Delete this job?')" class="btn-danger">
                                    
                                    <?= $this->lang->line("delete"); ?>
                                </a>
                            </td>
                        </tr>
                        
                        
                    <?php } ?>
            </tbody>
        </table>
    </div>
            