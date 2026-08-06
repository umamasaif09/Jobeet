

    <div class="table-wrapper">
        <div class="jobs-table-card">
        <table class="admin-table jobs-table affiliate-table">
            <thead>
                <tr>

                    <th><strong><?= $this->lang->line("affiliate_id"); ?></strong></th>
                        <th><strong><?= $this->lang->line("affiliate_name"); ?></strong></th>
                        <th><strong><?= $this->lang->line("affiliate_email"); ?></strong></th>
                        <th><strong><?= $this->lang->line("affiliate_website"); ?></strong></th>
                        <th><strong><?= $this->lang->line("status"); ?></strong></th>
                        <th><strong><?= $this->lang->line("affiliate_token"); ?></strong></th>
                        <th class="menu-column"></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($affiliates as $affiliate) { ?>

                    <tr>
                       <td class="id-column"><?php echo $affiliate["id"]; ?></td>
                            
                            <td>
                                <div class="job-title">
                                    <?php echo $affiliate["name"]; ?>
                                </div>
                            </td>
                            
                            <td>
                                <div class="job-meta">
                                    <?php echo $affiliate["email"]; ?>
                                </div>
                            </td>

                            <td>
                                <div class="job-meta">
                                    <?php echo $affiliate["site_url"]; ?>
                                </div>
                            </td>

                            <td>
                                <?php if($affiliate["is_active"]) { ?>
                                    <span class="badge active">Active</span>

                                    
                                <?php } else { ?>
                                    <span class="badge inactive">Inactive</span>
                                <?php } ?>
                            </td>

                            <td>
                                <div class="job-meta">
                                         <?php echo $affiliate["token"]; ?>
                                </div>
                            </td>
                            

                        <td class="row-menu">
                                <button type="button" class="menu-toggle">⋮</button>
                                <div class="menu-dropdown">
                                    <a href="<?php echo site_url("admin/editAffiliate/".$affiliate["id"]) ?>" class="btn btn-warning menu-btn">
                                        <?= $this->lang->line("edit"); ?>
                                    </a>
                                    
                                    <?php if($affiliate["is_active"]) { ?> 
                                        <a href="<?php echo site_url("admin/disableAffiliate/".$affiliate["id"]) ?>" class="btn btn-warning menu-btn">
                                            <?= $this->lang->line("disable"); ?>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url("admin/activateAffiliate/".$affiliate["id"]) ?>" class="btn btn-success menu-btn">
                                            <?= $this->lang->line("activate"); ?>
                                        </a>
                                    <?php } ?>

                                    <a href="<?php echo site_url("admin/deleteAffiliate/".$affiliate["id"]) ?>" 
                                       onclick="return confirm('Delete this affiliate?')" 
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
