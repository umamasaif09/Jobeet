<?php $error= $this->session->flashdata("error"); ?>
<?php $success= $this->session->flashdata("success"); ?>

<?php if($error): ?>
    <div class ="flash-error">
        <?php echo $error; ?>
    </div>
    <?php end if; ?>

<?php if($success): ?>
    <div class ="flash-success">
        <?php echo $success; ?>
    </div>
    <?php end if; ?>

<form action="<?php echo site_url("admin/login");?>" method="POST" class="admin-form">
    <p><?php echo validation_errors(); ?></p>
    <div class = "form-group">
        <label>Email</label>
        <input type="email" name= "email" placeholder = "Enter your email" required value= "<?php echo set_value('email'); ?>">
    </div>

    <div class = "form-group">
        <label>Password</label>
        <input type="password" name= "password" placeholder= "Enter your password" required>
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
    
</form>

