<div class="form-container">
    <div class="form-card">
        <form action="<?php echo site_url("admin/addAdmin"); ?>" method="POST" class="admin-form">
            <div  class = "form-group">
                <label>Name</label>
                <input type="text" name= "name" placeholder = "Enter admin name" required>
            </div>
                    
            <div class = "form-group">
                <label>Email</label>
                <input type="email" name= "email" placeholder = "Enter admin email" required>
            </div>

            <div class = "form-group">
                <label>Password</label>
                <input type="password" name= "password" placeholder= "Enter password" required>
            </div>

            <div class = "form-group">
                <label>Confirm Password</label>
                <input type="password" name= "confirm_password" placeholder= "Confirm password" required>
            </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Register Admin</button>
                </div>
            
        </form>
    </div>
</div>
