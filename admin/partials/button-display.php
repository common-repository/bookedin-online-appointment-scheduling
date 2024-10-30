<?php
    require_once("ButtonConfig.php");
    $loggedIn = get_option('bookedin_username');
    $isSmall = get_option('bookedin_size') === 'small' ? 1 : 0;
    $scriptName = isset($scriptName) ? $scriptName : "button-script";
    $buttonConfig = new ButtonConfig();

    //Clean values as required by the insert script.
    $buttonConfig->backgroundColor    = str_replace('#', '', get_option('bookedin_color'));
    $buttonConfig->bottomColor        = str_replace('#', '', get_option('bookedin_bottom_color'));
    $buttonConfig->textColor          = str_replace('#', '', get_option('bookedin_text_color'));
    $buttonConfig->buttonText         = get_option('bookedin_button_text') ?: 'Book Now';
    $buttonConfig->companyToken       = get_option('bookedin_token');
    $buttonConfig->textColor          = $buttonConfig->textColor ?: 'ffffff';
    $buttonConfig->isSmall            = $isSmall;
    $buttonConfig->textWidth          = $isSmall ? '75' : '100';
    $buttonConfig->textMargin         = $isSmall ? '12' : '18';
    $buttonConfig->iconWidth          = $isSmall ? '22' : '31';
    $buttonConfig->height             = $isSmall ? '35' : '56';
    $buttonConfig->fontSize           = $isSmall ? '15' : '20';
?>

<?php if ($loggedIn) { ?>
    <?php $this->pluginConfig->enqueue_plugin_config();?>
    <!-- begin Bookedin button -->
    <a href='<?php echo '//scheduler.bookedin.com/' . $buttonConfig->companyToken?>' title='Book Your Appointment Online' class='b-w-button' target='_blank'>
        <?php echo $buttonConfig->buttonText ?>
    </a>
    <?php $this->pluginConfig->enqueue_plugin_button_script($buttonConfig->buildArray(), $scriptName);?>
    <!-- end Bookedin button -->
<?php } else { ?>
    <span style='font-weight: 800; margin: 10px 10px 10px 0; display: block;'>
        !!! Bookedin Button is not configured!!!
        <br> (see Bookedin section in WordPress admin console)
    </span>
<?php } ?>
