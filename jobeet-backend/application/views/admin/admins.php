

    <div class="table-wrapper">
        <div class= "jobs-table-card">
                <table class="admin-table jobs-table admin-table">
                <thead>
                    <tr>
                        <th><strong>Admin ID</strong></th>
                        <th><strong>Admin Name</strong></th>
                        <th><strong>Admin Email</strong></th>
                        <th><strong>Active Status</strong></th>
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
                                    <button type="button" class="btn btn-warning menu-btn edit-admin-btn"
                                      data-id="<?php echo $admin["id"]; ?>"
                                      data-name="<?php echo htmlspecialchars($admin["name"]); ?>"
                                      data-email= "<?php echo htmlspecialchars($admin["email"]); ?>"
                                    >
                                        <?= $this->lang->line("edit"); ?>
                                    </button>

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


<!-- Edit Adnin Modal -->
<div class="modal" id="editAdminModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Admin</h2>
            <button type="button" class="modal-close" id="closeEditAdminModal">
                &times;
            </button>
        </div>

        <form action="<?php echo site_url("admin/editAdmin"); ?>" method="POST" class="admin-form" id="editAdminForm">
            <input type="hidden" name="id" id="edit_admin_id" value="<?php echo $admin["id"] ?>">
            <div  class = "form-group">
                <label>Name</label>
                <input type="text" name= "name" id= "edit_admin_name" placeholder = "Enter admin name" required>
            </div>
                    
            <div class = "form-group">
                <label>Email</label>
                <input type="email" name= "email" id= "edit_admin_email" placeholder = "Enter admin email" required>
            </div>
              
            <button type="submit" class="btn btn-primary">Update</button>
            
        </form>
    </div>
</div>