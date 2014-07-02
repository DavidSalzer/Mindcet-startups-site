<html>
  <body>
    <form action="" method="post">
<?php

require_once('recaptchalib.php');

// Get a key from https://www.google.com/recaptcha/admin/create
 //qa
//$publickey = "6LdQPu4SAAAAACRzwW4h8VQtluCUAqLiMrhRQNKp";
//$privatekey = "6LdQPu4SAAAAAPdPdicVgCnfxcw4N9xb0z_wKX1E";

//production
$publickey = "6Lc_Pu4SAAAAAPo3yZJ8UQkagt5Wm_tA4W5x8Qpz";
$privatekey = "6Lc_Pu4SAAAAAP4_SfbPOk9VHWyJnFhU-4HPSgX1";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

# was there a reCAPTCHA response?
if ($_POST["recaptcha_response_field"]) {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
                echo "You got it!";
        } else {
                # set the error code so that we can display it
                $error = $resp->error;
        }
}
echo recaptcha_get_html($publickey, $error);
?>
    <br/>
    <input type="submit" value="submit" />
    </form>
  </body>
</html>
