<?php $error= $this->session->flashdata("error"); ?>
<?php $success= $this->session->flashdata("success"); ?>

<?php if($error): ?>
    <div class ="flash-error">
        <?php echo $error; ?>
    </div>
    <?php endif; ?>

<?php if($success): ?>
    <div class ="flash-success">
        <?php echo $success; ?>
    </div>
    <?php endif; ?>

    <div class="form-container">
    <div class="form-card">
        <form action="<?php echo site_url("admin/resetPassword");?>" method="POST" class="auth-form">
            <input type="hidden" name="token" value="<?php echo $token ?>">
            <h2><?php echo $title; ?></h2>   
            
            <?php if(validation_errors()): ?>
                <div class="flash-error">
                    <?php echo validation_errors(); ?>
                </div>
            
            <?php endif; ?>

            <div class = "form-group">
                <label>Password</label>
                <input type="password" name= "password" placeholder= "Enter new password" required>
            </div>

            <div class = "form-group">
                <label>Confirm Password</label>
                <input type="password" name= "confirm_password" placeholder= "Confirm password" required>
            </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            
        </form>   
    </div>
</div>
