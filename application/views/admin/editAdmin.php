
      
<form action="<?php echo site_url("admin/editAdmin"); ?>" method="POST" class="admin-form">
    <input type="hidden" name="id" value="<?php echo $admin["id"] ?>">
    <div  class = "form-group">
        <label>Name</label>
        <input type="text" name= "name" placeholder = "Enter admin name" value="<?php echo $admin["name"]; ?>" required>
    </div>
            
    <div class = "form-group">
        <label>Email</label>
        <input type="email" name= "email" placeholder = "Enter admin email" value="<?php echo $admin["email"]; ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Admin</button>
</form>


