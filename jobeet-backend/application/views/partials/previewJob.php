<section>
    <table class="preview-table">
      <tbody>
        <tr>
        <td><strong>Category  </strong></td>
        <td><?php echo $category["name"];?></td>
      </tr>
      <tr>
        <td><strong>Type  </strong></td>
        <td><?php echo $job["type"]?></td>
      </tr>
      <tr>
        <td><strong>Company  </strong></td>
        <td><?php echo $job["company"];?></td>
      </tr>
      <?php if(!empty($job["logo"])) { ?>
        <tr>
          <td><strong>Logo  </strong></td>
          <td>
            <img src="<?php echo base_url("uploads/".$job["logo"]); ?>" alt="Company Logo" class="logo">
          </td>
        </tr>
      <?php } ?>
      <tr>
        <td><strong>Webiste  </strong></td>
        <td><a href="<?php echo $job["url"]; ?>"><?php echo $job["url"];?></a></td>
      </tr>
      <tr>
        <td><strong>Position  </strong></td>
        <td><?php echo $job["position"];?></td>
      </tr>
      <tr>
        <td><strong>Location  </strong></td>
        <td><?php echo $job["location"];?></td>
      </tr>
      <tr>
        <td><strong>Email  </strong></td>
        <td><a href="mailto <?php echo $job["email"]; ?>"><?php echo $job["email"];?></a></td>
      </tr>
      <tr>
        <td><strong>Description  </strong></td>
        <td><?php echo nl2br($job["description"]); ?></td>
      </tr>
      <tr>
        <td><strong>How to Apply  </strong></td>
        <td><?php echo nl2br($job["how_to_apply"]); ?></td>
      </tr>
      <tr>
        <td><strong>Public  </strong></td>
        <td><?php echo $job["is_public"] ? "Yes" : "No"; ?></td>
      </tr>
      </tbody>
  </table>
</section>