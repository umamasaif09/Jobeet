

<div class="container">

    <h2>
        <?php echo $job["company"]; ?>
        <img src="<?php echo base_url("uploads/".$job["logo"]); ?>" alt="Company Logo" width="100" style="float: right;">
    </h2>
    <h3><?php echo $job["location"]; ?></h3>
    <hr>
    <h4><?php echo $job["position"]; ?></h4>
    <hr>
    <p><?php echo $job["description"]; ?></p>
    <br>
    <h5>How to apply?</h5>
    <p><?php echo $job["how_to_apply"]; ?></p>


</div>
