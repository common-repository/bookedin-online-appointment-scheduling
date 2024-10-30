<?php
    //Get initial setup
    $currentUser = get_option('bookedin_username');
    $choiceUrl = admin_url('admin.php?page=bookedin');
?>

<div class="bookedin-user-info">
    <a href="<?php echo $choiceUrl ?>" class="button-back">&laquo; Go back</a>
    <span class="logged-user">
        <?php echo $currentUser ?> &bull;
        <form id="logout" method="post" action="options.php">
            <?php settings_fields('bookedin_logout'); ?>
            <?php do_settings_sections('bookedin_logout'); ?>
            <input type="hidden" id="bookedin-logout" value="true" name="bookedin_logout">
            <a href="javascript:{}" class="bookedin_logout" onclick="document.getElementById('logout').submit();">Switch account</a>
        </form>
    </span>
</div>