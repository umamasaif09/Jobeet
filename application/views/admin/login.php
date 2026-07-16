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
        <form action="<?php echo site_url("admin/login");?>" method="POST" class="auth-form">
            <h2><?php echo $title; ?></h2>   
            
            <?php if(validation_errors()): ?>
                <div class="flash-error">
                    <?php echo validation_errors(); ?>
                </div>
            
            <?php endif; ?>

            <div class = "form-group">
                <label>Email</label>
                <input type="email" name= "email" placeholder = "Enter your email" required value= "<?php echo set_value('email'); ?>">
            </div>

            <div class = "form-group">
                <label>Password</label>
                <input type="password" name= "password" placeholder= "Enter your password" required>
            </div>

            <a href="<?php echo site_url("admin/forgotPassword"); ?>">Forgot your password?</a>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            
            
        </form>

    </div>
</div>


