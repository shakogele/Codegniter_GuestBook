<div class="card login-form">
  <div class="card-header bg-transparent border-success">
      Log In
  </div>
  <div class="card-body">
    <?php echo form_open('auth/login'); ?>
    <?php echo validation_errors(); ?>
        <div class="form-group">
            <label for="username">Username</label>
            <input
                type="text"
                class="form-control"
                name="username"
                id="username"
                value="<?php echo set_value('username');?>"
                placeholder="Enter username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                value="<?php echo set_value('password');?>"
                placeholder="Password">
        </div>
        <button type="submit" class="btn btn-outline-success pull-right">Login</button>
    </form>
  </div>
</div>
