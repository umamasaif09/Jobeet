<div class="admin-section">

    <div class="section-header">

        <a href="<?php echo site_url("admin/addAdmin"); ?>" class="btn btn-primary">
                Register Admin
        </a>

    </div>

    <div class="table-wrapper">
        <table class="admin-table affiliate-table">
            <thead>
                <tr>

                    <th><strong>Name</strong></th>
                    <th><strong>Email</strong></th>
                    <th><strong>Status</strong></th>
                    <th class="actions-column">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($admins as $admin) { ?>

                    <tr>
                        <td>
                            <?php echo $admin["name"];?>
                        </td>

                        <td>
                            <?php echo $admin["email"];?>
                        </td>
                        
                        <td>
                            <div class="job-meta">
                                    <?php if($admin["is_active"]) {?>
                                    <span class="badge active">Active</span>
                                    <?php } else { ?>
                                        <span class="badge inactive">Active</span>
                                    <?php } ?>
                                </div>
                        </td>

                        <td class ="actions">
                            <a href="<?php echo site_url("admin/editAdmin?id=" .$admin["id"]); ?>" class="btn btn-warning"> 
                                Edit
                            </a>

                            <a href="<?php echo site_url("admin/deleteAdmin?id=" .$admin["id"]) ?>" 
                                onclick="return confirm('Delete this admin?')"
                                class="btn btn-danger">
                                
                                Delete
                            </a>

                            <?php if($admin["is_active"]) {?> 
                                <a href="<?php echo site_url("admin/disableAdmin?id=" .$admin["id"]) ?>" class="btn btn-warning">
                                
                                        Disable
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo site_url("admin/activateAdmin?id=" .$admin["id"]) ?>" class="btn btn-success" >
                                
                                        Activate
                                </a>
                            <?php }?>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

