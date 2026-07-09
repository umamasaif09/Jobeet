<?php $this->load->view("partials/header"); ?>

<?php $this->load->view("partials/pageHeader"); ?>

    <div class="container">
        <section>
        <h1>
            <?= $this->lang->line("request_submition"); ?>
        </h1>

        <h2>
            <?= $this->lang->line("thank_you"); ?> <?php echo $affiliate["name"];?>.
        </h2>

        <p><?= $this->lang->line("affiliate_application"); ?></p>

        <p><?= $this->lang->line("account_activation"); ?></p>
           
       
        </section>
    </div>

    

    <?php $this->load->view("partials/footer"); ?>