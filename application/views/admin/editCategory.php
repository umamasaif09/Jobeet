
    <?php $this->load->view("partials/adminHeader"); ?>
            <?php $this->load->view("partials/pageHeader"); ?>
    <div class="container">
        <section >
            
            
        <form action="<?php echo site_url("admin/updateCategory"); ?>" method="POST" class="admin-form">
            <input type="hidden" name="id" value="<?php echo $category["id"] ?>">
            <div class=form-group>
                <label><?= $this->lang->line("<?= $this->lang->line(""); ?>"); ?></label>
                <input type="text" name= "category_name" placeholder="Enter category name" required>
            </div>

            <button type="submit" class="btn-primary"><?= $this->lang->line("update_category"); ?></button>
        </form>
    </section>
    </div>
    

</body>
</html>