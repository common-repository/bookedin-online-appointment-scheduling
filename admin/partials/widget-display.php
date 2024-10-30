<?php
    $loggedIn = get_option('bookedin_username');

    //Clean values as required by the insert script.
    $widgetFont         = ucfirst(get_option('bookedin_widget_font'));
    $widgetTheme        = ucfirst(get_option('bookedin_widget_theme'));
    $widgetBarColor     = $widgetTheme === 'Custom' ? str_replace('#', '', get_option('bookedin_custom_bar_color')) : '';
    $widgetBarLightness = $widgetTheme === 'Custom' ? get_option('bookedin_widget_bar_text_color') === 'white' ? 0 : 100 : '';

    $widgetTheme = $widgetTheme === 'Custom'
                    ? $widgetTheme . '-' . ucfirst(get_option('bookedin_custom_background'))
                    : $widgetTheme;
    $companyToken = get_option('bookedin_token');
?>

<?php if ($loggedIn) { ?>
    <?php $this->pluginConfig->enqueue_plugin_config();?>
    <!-- begin Bookedin widget -->
    <div class='b-w-widget'
         widget-font='<?php echo $widgetFont ?>'
         widget-theme-color='<?php echo $widgetTheme ?>'
         widget-bar-color='<?php echo $widgetBarColor ?>'
         widget-bar-color-lightness='<?php echo $widgetBarLightness ?>'
         widget-company='<?php echo $companyToken ?>'
         widget-gunton-url='https://directory.bookedin.com/'><a href="https://bookedin.com/?cid=266" rel="nofollow" target="_blank"></a>
    </div>
    <?php $this->pluginConfig->enqueue_plugin_widget_script();?>
    <!-- end Bookedin widget -->
<?php } else { ?>
    <span style='font-weight: 800; margin: 10px 10px 10px 0; display: block;'>
        !!! Bookedin Widget is not configured!!!
        <br> (see Bookedin section in WordPress admin console)
    </span>
<?php } ?>