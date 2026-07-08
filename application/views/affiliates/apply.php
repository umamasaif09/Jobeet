<?php $this->load->view("partials/header"); ?>

    <section>
        <form method="POST" action="<?php echo site_url("affiliates/submitApplication"); ?>">
            <?= $this->lang->line("affiliate_name"); ?><input type="text" name="name"> <br><br>
            <?= $this->lang->line("affiliate_email"); ?><input type="text" name="email"><br><br>
            <?= $this->lang->line("affiliate_website"); ?><input type="text" name="site_url"><br><br>

            <?= $this->lang->line("categories"); ?> <br>
            <?php foreach($categories as $category) { ?>
                <input type="checkbox"
                name="categories[]"
                value="<?php echo $category["id"]; ?>"
                >
                <?php echo $category["name"]; ?><br>
            <?php } ?>
            <br><br>
            <button type="submit">Apply</button>
        </form>
    </section>

    <?php $this->load->view("partials/footer"); ?>