<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<style>
.btn-info {
    margin-top: 17px;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-unlock fa-4x"></i></h3>

                        <div class="panel-body">

                            <h1>Account Recovery - Stage 2</h1>

                            <?php

$showform = 1;

if (isset($validation_errors)) {
    echo '
		<div style="border:1px solid red;">
			<p>
				The following error occurred while changing your password:
			</p>
			<ul>
				' . $validation_errors . '
			</ul>
			<p>
				PASSWORD NOT UPDATED
			</p>
		</div>
	';
} else {
    $display_instructions = 1;
}

if (isset($validation_passed)) {
    $login = site_url('login');
    echo '
		<div style="border:1px solid green;">
			<p>
				You have successfully changed your password.
			</p>
			<p>
				You can now <a href="/' . $login . '">login</a>
			</p>
		</div>
	';

    $showform = 0;
}
if (isset($recovery_error)) {
    echo '
		<div style="border:1px solid red;">
			<p>
				No usable data for account recovery.
			</p>
			<p>
				Account recovery links expire after
				' . ((int) config_item('recovery_code_expiration') / (60 * 60)) . '
				hours.<br />You will need to use the
				<a href="/examples/recover">Account Recovery</a> form
				to send yourself a new link.
			</p>
		</div>
	';

    $showform = 0;
}
if (isset($disabled)) {
    echo '
		<div style="border:1px solid red;">
			<p>
				Account recovery is disabled.
			</p>
			<p>
				You have exceeded the maximum login attempts or exceeded the
				allowed number of password recovery attempts.
				Please wait ' . ((int) config_item('seconds_on_hold') / 60) . '
				minutes, or contact us if you require assistance gaining access to your account.
			</p>
		</div>
	';

    $showform = 0;
}
if ($showform == 1) {
    if (isset($recovery_code, $user_id)) {
        if (isset($display_instructions)) {
            if (isset($username)) {
                echo '<p>
					Your login user name is <i>' . $username . '</i><br />
					Please write this down, and change your password now:
				</p>';
            } else {
                echo '<p>Please change your password now:</p>';
            }
        }

        ?>
                            <div id="form">
                                <?php echo form_open(); ?>
                                <fieldset>
                                    <strong>Step 2 - Choose your new password</strong>
                                    <div>

                                        <?php
// PASSWORD LABEL AND INPUT ********************************
        echo form_label('Password', 'passwd', ['class' => 'form_label']);

        $input_data = [
            'name' => 'passwd',
            'id' => 'passwd',
            'class' => 'form_input password form-control',
            'max_length' => config_item('max_chars_for_password'),
        ];
        echo form_password($input_data);
        ?>

                                    </div>
                                    <div>

                                        <?php
// CONFIRM PASSWORD LABEL AND INPUT ******************************
        echo form_label('Confirm Password', 'passwd_confirm', ['class' => 'form_label']);

        $input_data = [
            'name' => 'passwd_confirm',
            'id' => 'passwd_confirm',
            'class' => 'form_input password form-control',
            'max_length' => config_item('max_chars_for_password'),
        ];
        echo form_password($input_data);
        ?>

                                    </div>
                                </fieldset>
                                <div>
                                    <div>

                                        <?php
// RECOVERY CODE *****************************************************************
        echo form_hidden('recovery_code', $recovery_code);

        // USER ID *****************************************************************
        echo form_hidden('user_identification', $user_id);

        // SUBMIT BUTTON **************************************************************
        $input_data = [
            'name' => 'form_submit',
            'id' => 'submit_button',
            'value' => 'Change Password',
            'class' => 'form-control btn-info',
        ];
        echo form_submit($input_data);
        ?>

                                    </div>
                                </div>
                                </form>
                            </div>
                            <?php
}
}?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>