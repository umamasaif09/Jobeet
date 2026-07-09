
    <?php $this->load->view("partials/adminHeader"); ?>
            <?php $this->load->view("partials/pageHeader"); ?>
    <div class="container">
        <section >
            
            
        <form action="<?php echo site_url("admin/updateCategory"); ?>" method="POST" class="admin-form">
            <input type="hidden" name="id" value="<?php echo $category["id"] ?>">
            <div class=form-group>
                <label>Category Name: </label>
                <input type="text" name= "category_name" placeholder="Enter category name" required>
            </div>

            <button type="submit" class="btn-primary">Update Category</button>
        </form>
    </section>
    </div>
    

</body>
</html>