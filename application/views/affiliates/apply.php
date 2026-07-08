<?php $this->load->view("partials/header"); ?>

    <section>
        <form method="POST" action="<?php echo site_url("affiliates/submitApplication"); ?>">
            <?php $this->load->view("partials/affiliates_form_fields"); ?>
            <button type="submit" class="btn-primary">Apply</button>
        </form>
    </section>

    <?php $this->load->view("partials/footer"); ?>