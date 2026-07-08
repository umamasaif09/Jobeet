
     <?php $this->load->view("partials/adminHeader"); ?>

    <?php $this->load->view("partials/pageHeader"); ?>

    <div class="container">
        <section>
        <h2>Add an Affiliate</h2>
        <form action="<?php echo site_url("admin/createAffiliate"); ?>" method="POST" class="admin-form">
            
                <?php $this->load->view("partials/affiliates_form_fields"); ?>
            <button type="submit" clas="btn-primary">Create Affiliate</button>
        </form>
    </section>

    <section>
        <h2>Existing Affiliates</h2>
        
        <div class="table-wrapper">
            <table class="admin-table affiliate-table">
            <thead>
                <tr>
                    <th><strong>Affiliate ID</strong></th>
                    <th><strong>Affiliate Name</strong></th>
                    <th><strong>Affiliate Email</strong></th>
                    <th><strong>Affiliate Website</strong></th>
                    <th><strong>Affiliate Token</strong></th>
                    <th><strong>Active Status</strong></th>
                    <th><strong>Created At</strong></th>
                    <th class="actions-column">Actions</th>
                </tr>
            </thead>

            <tbody>
                    <?php foreach($affiliates as $affiliate) { ?>

                        <tr>
                            <td><?php echo $affiliate["id"]; ?></td>
                            <td><?php echo $affiliate["name"]; ?></td>
                            <td><?php echo $affiliate["email"]; ?></td>
                            <td><?php echo $affiliate["site_url"]; ?></td>
                            <td><?php echo $affiliate["token"]; ?></td>
                            <td><?php if ($affiliate["is_active"]) {
                                echo "Active";
                            } else {
                                echo "Inactive";
                            } ?></td>
                            <td><?php echo $affiliate["created_at"]; ?></td>

                            <td class ="actions">
                                <a href="<?php echo site_url("admin/editAffiliate/".$affiliate["id"]) ?>" class="btn-warning"> 
                                    Edit
                                </a>

                                <a href="<?php echo site_url("admin/deleteAffiliate/".$affiliate["id"]) ?>" 
                                    onclick="return confirm('Delete this affiliate?')"
                                    class="btn-danger">
                                    
                                    Delete
                                </a>

                                <?php if($affiliate["is_active"]) {?> 
                                    <a href="<?php echo site_url("admin/disableAffiliate/".$affiliate["id"]) ?>" class="btn-warning">
                                    
                                            Disable
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo site_url("admin/activateAffiliate/".$affiliate["id"]) ?>" class="btn-success" >
                                    
                                            Activate
                                    </a>
                                <?php }?>

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