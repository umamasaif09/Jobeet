<div class="job-details">
  <div>
    <h2><?php echo $job["position"]; ?></h2>
    <h3><?php echo $job["company"]; ?></h3>
    <h4><?php echo $job["location"]; ?></h4>
  </div>


  <?php if(!empty($job["logo"])): ?>
      <img src="<?php echo base_url("uploads/".$job["logo"]); ?>" alt="Company Logo" >
  <?php endif; ?>
</div>


<hr>
<div>
    <strong>Descrption</strong>
    <p><?php echo $job["description"]; ?></p>
</div>

<div>
    <strong>How to Apply</strong>
    <p><?php echo $job["how_to_apply"]; ?></p>
</div>



