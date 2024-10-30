<?php
    if (get_option('bookedin_logout')) {
        $path = admin_url('admin.php?page=bookedin');
        echo "<script>window.location.replace(\"{$path}\")</script>";
    };

    //Get initial setup
    $displayName = get_option('bookedin_name');
    $displaySuccess = get_option('bookedin_just_saved') === 'true' ? 'visible' : '';
    $appearanceUrl = admin_url('widgets.php');
    $postsUrl = admin_url('edit.php');
    $pagesUrl = admin_url('edit.php?post_type=page');
    delete_option('bookedin_just_saved');

    include_once('step-logout.php');
?>

<div class="bookedin-button">
    <img src="<?php echo plugins_url('images/bookedin_logo_slogan.png', dirname(__FILE__)); ?>"
         alt="Bookedin Logo"
         class="bookedin-logo"/>
    <span class="step-header">
        Design your button for:
        <p class="display-name"><?php echo $displayName ?></p>
    </span>
    <form id="button-step" method="post" action="options.php">
        <hr>
        <?php settings_fields('bookedin'); ?>
        <?php do_settings_sections('bookedin'); ?>
        <div class="button-wrapper">
            <span class="button-container-label">Preview (actual size)</span>
            <?php include_once('button-preview.php'); ?>
        </div>
        <hr>
        <a href="javascript:saveButton()" class="button-primary">Save Changes</a>
        <div class="<?php echo 'success-message ' . $displaySuccess ?>">
            <span class="message-text">
                Success! Your button has been saved.
                <br>Now you add the button to any <a href="<?php echo $pagesUrl ?>">Page</a> or <a href="<?php echo $postsUrl ?>">Post</a>.
                <br>or go to <a href="<?php echo $appearanceUrl ?>">Appearance > Widgets</a> to add to your site
            </span>
        </div>
    </form>
</div>
<div class="invitation_button">
    <img src="<?php echo plugins_url('images/invitation_button_arrow.png', dirname(__FILE__)); ?>" alt="">
    Hit save, then add your button to any <a href="<?php echo $pagesUrl ?>">Page</a> or <a href="<?php echo $postsUrl ?>">Post</a>
    <br>or go to <a href="">Appearance > Widgets</a> to add to your site.
</div>
<script>
    function saveButton() {
        jQuery(window).trigger('saveButton');
    }
</script>