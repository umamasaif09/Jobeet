

    <h2><?= $this->lang->line("add_affiliate");?></h2>
    <form action="<?php echo site_url("admin/createAffiliate"); ?>" method="POST" class="admin-form">
        
            <?php $this->load->view("partials/affiliates_form_fields"); ?>
        <button type="submit" class="btn btn-primary"><?= $this->lang->line("create_affiliate"); ?></button>
    </form>



<div class="table-container">
    <h2><?= $this->lang->line("existing_affiliates"); ?></h2>
    
    <div class="table-wrapper">
        <table class="admin-table affiliate-table">
        <thead>
            <tr>
                <th><strong><?= $this->lang->line("affiliate_id"); ?></strong></th>
                <th><strong><?= $this->lang->line("affiliate_name"); ?></strong></th>
                <th><strong><?= $this->lang->line("affiliate_email"); ?></strong></th>
                <th><strong><?= $this->lang->line("affiliate_website"); ?></strong></th>
                <th><strong><?= $this->lang->line("affiliate_token"); ?></strong></th>
                <th><strong><?= $this->lang->line("active_status"); ?></strong></th>
                <th><strong><?= $this->lang->line("created_at"); ?></strong></th>
                <th class="actions-column"><?= $this->lang->line("actions"); ?></th>
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
