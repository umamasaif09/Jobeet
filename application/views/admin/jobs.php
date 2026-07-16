
        

    <div class="table-wrapper">
        <div class="jobs-table-card">
            <table class="admin-table jobs-table">
                <thead>
                    <tr>
                        <th><strong><?= $this->lang->line("job_id"); ?></strong></th>
                        <th><strong><?= $this->lang->line("position"); ?></strong></th>
                        <th><strong><?= $this->lang->line("company_name"); ?></strong></th>
                        <th><strong><?= $this->lang->line("type"); ?></strong></th>
                        <th><strong><?= $this->lang->line("location"); ?></strong></th>
                        <th><strong><?= $this->lang->line("status"); ?></strong></th>
                        <th><strong><?= $this->lang->line("expires_at"); ?></strong></th>
                        <th class="menu-column"></th>
                    </tr>
                </thead>

                <tbody>
                        <?php foreach($jobs as $job) { ?>

                        <tr>
                            <td class="id-column"><?php echo $job["id"]; ?></td>
                            <td>
                                <div class="job-title">
                                    <?php echo $job["position"]; ?>
                                </div>
                            </td>
                            <td>
                                <div class="company-name">
                                    <?php echo $job["company"]; ?>
                                </div>
                            </td>
                            <td>
                                <span class="type-badge">
                                    <?php echo $job["type"]; ?>
                                </span>
                            </td>
                            <td>
                                <span class="location-text">
                                    <?php echo $job["location"]; ?>
                                </span>
                            </td>
                            <td>
                                <?php if($job["is_active"]) { ?>
                                    <span class="badge active">Active</span>
                                <?php } else { ?>
                                    <span class="badge inactive">Inactive</span>
                                <?php } ?>

                                 <?php if($job["is_public"]) { ?>
                                    <span class="badge public">Public</span>
                                <?php } else { ?>
                                    <span class="badge private">Private</span>
                                <?php } ?>
                            </td>
                            <td>
                                <span class="expiry-date">
                                    <?php echo date("d M Y", strtotime($job["expires_at"])); ?>
                                </span>
                            </td>
                            <td class="row-menu">
                                <button type="button" class="menu-toggle">⋮</button>
                                <div class="menu-dropdown">
                                    <a href="<?php echo site_url("admin/viewJob/".$job["id"]) ?>" class="btn btn-primary menu-btn">
                                        <?= $this->lang->line("view"); ?>
                                    </a>
                                    <a href="<?php echo site_url("admin/editJob/".$job["id"]) ?>" class="btn btn-warning menu-btn">
                                        <?= $this->lang->line("edit"); ?>
                                    </a>
                                    <a href="<?php echo site_url("admin/deleteJob/".$job["id"]); ?>" 
                                       onclick="return confirm('Delete this job?')" 
                                       class="btn btn-danger menu-btn">
                                        <?= $this->lang->line("delete"); ?>
                                    </a>
                                </div>
                            </td>
                        </tr>
                            
                            
                        <?php } ?>
                </tbody>
            </table>

        </div>
        
    </div>
           