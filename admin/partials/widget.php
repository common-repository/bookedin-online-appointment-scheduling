<?php

class BookedInWidget extends WP_Widget {
    private $pluginConfig;

    function __construct($pluginConfig) {
        $this->pluginConfig = $pluginConfig;
        $widget_ops = array(
            'class_name' => 'bookedin_button',
            'description' => 'Your Bookedin online scheduling button.',
        );

        parent::__construct(false, __('Bookedin Button', 'bookedin'), $widget_ops);
    }

    // Render button widget form
    function form($instance) {
        $loggedIn = get_option('bookedin_username');
        $path = 'admin.php?page=bookedin';
        $url = admin_url($path);

        if($loggedIn) {
            echo '<div style="text-align: center; padding: 10px;">';
            include('button-preview.php');
            $link = "<a href='{$url}' style='margin: 10px; display: block;'>Edit color and size</a>";
            echo $link;
            echo '</div>';
        } else {
            echo "<span style='font-weight: 800; font-style: italic; margin: 10px 10px 10px 0; display: block;'>Button is not configured! see <a href='{$url}'>Bookedin</a> admin section.</span>";
        }
    }

    // Widget display
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);

        echo $before_widget;
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

        if (!empty($title))
            echo $before_title . $title . $after_title;

        $scriptName = "button-widget-script";
        include('button-display.php');

        echo $after_widget;
    }
}