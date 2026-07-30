

    <div class="table-wrapper">
        <div class= "jobs-table-card">
                <table class="admin-table jobs-table admin-table">
                <thead>
                    <tr>
                        <th><strong>Admin ID</strong></th>
                        <th><strong>Name</strong></th>
                        <th><strong>Email</strong></th>
                        <th><strong>Status</strong></th>
                        <th><strong>Created At</strong></th>
                        <th class="menu-column"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($admins as $admin) { ?>

                        <tr>
                            <td class="id-column"><?php echo $admin["id"]; ?></td>
                            <td>
                                <div class="job-title">
                                    <?php echo $admin["name"]; ?>
                                </div>
                            </td>

                             <td>
                                <div class="job-meta">
                                    <?php echo $admin["email"]; ?>
                                </div>
                            </td>
                            
                            <td>
                                <?php if($admin["is_active"]) { ?>
                                    <span class="badge active">Active</span>
                                <?php } else { ?>
                                    <span class="badge inactive">Inactive</span>
                                <?php } ?>
                            </td>

                            <td>
                                <span class="expiry-date">
                                    <?php echo date("d M Y", strtotime($admin["created_at"] ?? date('Y-m-d H:i:s'))); ?>
                                </span>
                            </td>

                            <td class="row-menu">
                                <button type="button" class="menu-toggle">⋮</button>
                                <div class="menu-dropdown">
                                    <a href="<?php echo site_url("admin/editAdmin?id=" . $admin["id"]); ?>" class="btn btn-warning menu-btn">
                                        <?= $this->lang->line("edit"); ?>
                                    </a>

                                    <?php if($admin["is_active"]) { ?> 
                                        <a href="<?php echo site_url("admin/disableAdmin?id=" . $admin["id"]); ?>" class="btn btn-warning menu-btn">
                                            <?= $this->lang->line("disable"); ?>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url("admin/activateAdmin?id=" . $admin["id"]); ?>" class="btn btn-success menu-btn">
                                            <?= $this->lang->line("activate"); ?>
                                        </a>
                                    <?php } ?>
                                    
                                    <a href="<?php echo site_url("admin/deleteAdmin?id=" . $admin["id"]); ?>" 
                                       onclick="return confirm('Delete this admin?')" 
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


