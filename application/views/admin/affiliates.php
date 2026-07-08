<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel= "stylesheet"  href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>
     <?php $this->load->view("partials/adminHeader"); ?>

    

    <section>
        <h2><?= $this->lang->line("categories"); ?></h2>
        <form action="<?php echo site_url("admin/createAffiliate"); ?>" method="POST">
            <strong><?= $this->lang->line("affiliate_name"); ?></strong>
            <input type="text" name= "name"><br><br>

            <strong><?= $this->lang->line("affiliate_email"); ?></strong>
            <input type="text" name= "email"><br><br>

            <strong><?= $this->lang->line("affiliate_website"); ?></strong>
            <input type="text" name= "url"><br><br>

            <strong><?= $this->lang->line("categories"); ?></strong> <br>
            <?php foreach($categories as $category) { ?>
                <input type="checkbox"
                name="categories[]"
                value="<?php echo $category["id"]; ?>"
                >
                <?php echo $category["name"]; ?><br>
            <?php } ?>
            <br><br>

            <button type="submit">Create</button>
        </form>
    </section>

    <section>
        <h2><?= $this->lang->line("existing_affiliates"); ?></h2>
        <table>
            <thead>
                <tr>
                    <th><strong><?= $this->lang->line("affiliate_id"); ?></strong></th>
                    <th><strong><?= $this->lang->line("affiliate_name"); ?></strong></th>
                    <th><strong><?= $this->lang->line("affiliate_email"); ?></strong></th>
                    <th><strong><?= $this->lang->line("affiliate_website"); ?></strong></th>
                    <th><strong><?= $this->lang->line("affiliate_token"); ?></strong></th>
                    <th><strong>Active Status</strong></th>
                    <th><strong>Created At</strong></th>
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
                                <a href="<?php echo site_url("admin/editAffiliate/".$affiliate["id"]) ?>"> 
                                    <button type="button">Edit</button>
                                </a>

                                <a href="<?php echo site_url("admin/deleteAffiliate/".$affiliate["id"]) ?>" 
                                    onclick="return confirm('Delete this affiliate?')">
                                    
                                    <button type="button" >Delete</button>
                                </a>

                                <?php if($affiliate["is_active"]) {?> 
                                    <a href="<?php echo site_url("admin/disableAffiliate/".$affiliate["id"]) ?>" >
                                    
                                            <button type="button" >Disable</button>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo site_url("admin/activateAffiliate/".$affiliate["id"]) ?>" >
                                    
                                            <button type="button" >Activate</button>
                                    </a>
                                <?php }?>

                            </td>
                        </tr>
                        
                        
                    <?php } ?>
            </tbody>
        </table>
    </section>

    
</body>
</html>