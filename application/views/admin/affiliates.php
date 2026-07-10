<div class="admin-section">

    <div class="section-header">
       <h2><?= $this->lang->line("existing_affiliates"); ?></h2>

        <a href="<?php echo site_url("admin/addAffiliate"); ?>" class="btn btn-primary">
                <?= $this->lang->line("add_affiliate"); ?>
        </a>

    </div>

    <div class="table-wrapper">
        <table class="admin-table affiliate-table">
            <thead>
                <tr>

                    <th><strong><?= $this->lang->line("affiliate_details"); ?></strong></th>
                    <th><strong><?= $this->lang->line("contact_information"); ?></strong></th>
                    <th><strong><?= $this->lang->line("status"); ?></strong></th>
                    <th class="actions-column"><?= $this->lang->line("actions"); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($affiliates as $affiliate) { ?>

                    <tr>
                        <td>
                            <div class="job-title">
                                    <?php echo $affiliate["name"]; ?>
                                </div>

                                <div class="job-meta">
                                    <strong>ID:</strong> <?php echo $affiliate["id"]; ?>
                                </div>

                                <div class="job-meta">
                                    <strong>Created:</strong> <?php echo $affiliate["created_at"]; ?>
                                </div>
                        </td>

                        <td>
                            <div class="job-meta">
                                    <strong>Email:</strong> <?php echo $affiliate["email"]; ?>
                                </div>

                                <div class="job-meta">
                                    <strong>Website:</strong> <?php echo $affiliate["site_url"]; ?>
                                </div>

                                <div class="job-meta">
                                    <strong>Token:</strong> <?php echo $affiliate["token"]; ?>
                                </div>
                        </td>
                        
                        <td>
                            <div class="job-meta">
                                    <?php if($affiliate["is_active"]) {?>
                                    <span class="badge active">Active</span>
                                    <?php } else { ?>
                                        <span class="badge inactive">Active</span>
                                    <?php } ?>
                                </div>
                        </td>

                        <td class ="actions">
                            <a href="<?php echo site_url("admin/editAffiliate/".$affiliate["id"]) ?>" class="btn btn-warning"> 
                                <?= $this->lang->line("edit"); ?>
                            </a>

                            <a href="<?php echo site_url("admin/deleteAffiliate/".$affiliate["id"]) ?>" 
                                onclick="return confirm('Delete this affiliate?')"
                                class="btn btn-danger">
                                
                                <?= $this->lang->line("delete"); ?>
                            </a>

                            <?php if($affiliate["is_active"]) {?> 
                                <a href="<?php echo site_url("admin/disableAffiliate/".$affiliate["id"]) ?>" class="btn btn-warning">
                                
                                        <?= $this->lang->line("disable"); ?>
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo site_url("admin/activateAffiliate/".$affiliate["id"]) ?>" class="btn btn-success" >
                                
                                        <?= $this->lang->line("activate"); ?>
                                </a>
                            <?php }?>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

