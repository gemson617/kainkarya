<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
.alert-danger1 {
    background-color: pink;
}
</style>
<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary">
                        <div class="text-primary text-center p-4">
                            <?php //print_r($login_url);?>
                            <h5 class="text-white font-size-20">Welcome Back !</h5>
                            <p class="text-white-50">Sign in to continue to <?php echo config_item('project_name'); ?>.
                            </p>
                            <a href="<?php echo base_url(); ?>" class="logo logo-admin">
                                <img src="<?php echo base_url(); ?>assets/images/logo-sm.png" height="60" alt="logo">
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="p-3">
                            <?php

if (!isset($on_hold_message)) {
    if (isset($login_error_mesg)) {
        echo '
			<div class="alert alert-danger1">
				<p>
					Login Error #' . $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts') . ': Invalid Username, Email Address, or Password.
				</p>
				<p>
					Username, email address and password are all case sensitive.
				</p>
			</div>
		';
    }

    if ($this->input->get(AUTH_LOGOUT_PARAM)) {
        echo '
			<div class="alert alert-success">
				<p>
					You have successfully logged out.
				</p>
			</div>
		';
    }

    echo form_open($login_url, ['class' => 'form-horizontal mt-4']);

    ?>

                            <div class="form-group">
                                <label for="username">Username / Email Address</label>
                                <input type="text" name="login_string" id="login_string" autocomplete="off"
                                    maxlength="255" class="form-control" placeholder="Enter username"
                                   />
                            </div>

                            <div class="form-group">
                                <label for="login_pass" class="form_label">Password</label>
                                <input type="password" name="login_pass" id="login_pass" class="form-control password" <?php
if (config_item('max_chars_for_password') > 0) {
        echo 'maxlength="' . config_item('max_chars_for_password') . '"';
    }

    ?> autocomplete="off" readonly="readonly" onfocus="this.removeAttribute('readonly');" placeholder="Enter password"
                                    />
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <?php
if (config_item('allow_remember_me')) {
        ?>
                                    <div class="custom-control custom-checkbox">
                                        <input id="remember_me" name="remember_me" value="yes" type="checkbox"
                                            class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Remember
                                            me</label>
                                    </div>
                                    <?php
}
    ?>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit"
                                        name="submit" value="Login" id="submit_button">Log In</button>
                                </div>
                            </div>

                            <div class="form-group mt-2 mb-0 row">
                                <div class="col-12 mt-4">
                                    <a href="<?php echo base_url(); ?>recover"><i class="mdi mdi-lock"></i> Forgot your
                                        password?</a>
                                </div>
                            </div>

                            </form>

                            <?php

} else {
    // EXCESSIVE LOGIN ATTEMPTS ERROR MESSAGE
    echo '
			<div class="alert alert-danger">
				<p>
					Excessive Login Attempts
				</p>
				<p>
					You have exceeded the maximum number of failed login<br />
					attempts that this website will allow.
				<p>
				<p>
					Your access to login and account recovery has been blocked for ' . ((int) config_item('seconds_on_hold') / 60) . ' minutes.
				</p>
				<p>
					Please use the <a href="/examples/recover">Account Recovery</a> after ' . ((int) config_item('seconds_on_hold') / 60) . ' minutes has passed,<br />
					or contact us if you require assistance gaining access to your account.
				</p>
			</div>
		';
}
?>




                        </div>
                    </div>

                </div>

                <div class="mt-5 text-center">
                    <p class="mb-0">&copy; <script>
                        document.write(new Date().getFullYear())
                        </script> <?php echo config_item('company_name'); ?>. Crafted with <i
                            class="mdi mdi-heart text-danger"></i> by AlphasoftZ Solutions</p>
                </div>


            </div>
        </div>
    </div>
</div>