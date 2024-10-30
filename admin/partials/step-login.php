<?php delete_option('bookedin_logout');?>

<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
<div class="bookedin-login">
    <img src="<?php echo plugins_url('images/bookedin_logo_slogan.png', dirname(__FILE__)); ?>"
         alt="Bookedin Logo"
         class="bookedin-logo"/>
    <div class="step-header login">
        <span>Enter your existing Bookedin account email</span>
    </div>
    <form id="email-form" method="post" action="options.php">
        <?php settings_fields('bookedin_login'); ?>
        <?php do_settings_sections('bookedin_login'); ?>
        <div class="error-message">
            <span class="message-text">

            </span>
        </div>
        <a href="javascript:validateEmail()" class="button-primary">Connect Bookedin Account</a>
    </form>
    <div class="no-account step-header">
        <span>Don't have a Bookedin account?</span>
    </div>
    <a href="https://bookedin.com/online-appointment-scheduling-software-signup/?cid=265" class="button-primary">Start Free Trial</a>
</div>

<script>
    function validateEmail() {
        jQuery(window).trigger('validateEmail');
    }
</script>
