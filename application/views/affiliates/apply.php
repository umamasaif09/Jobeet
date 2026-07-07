<?php $this->load->view("partials/header"); ?>

    <section>
        <form method="POST" action="<?php echo site_url("affiliates/submitApplication"); ?>">
            Name <input type="text" name="name"> <br><br>
            Email <input type="text" name="email"><br><br>
            Website <input type="text" name="site_url"><br><br>

            Categories <br>
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