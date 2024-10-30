<?php

class Settings {
    private $plugin_name;

    public function init($plugin_name) {
        $this->plugin_name = $plugin_name;
        add_action('admin_init', array($this, 'register_all_settings'));
    }

    public function register_all_settings() {
        // Login Step
        register_setting($this->plugin_name . '_login', $this->plugin_name . '_username');
        register_setting($this->plugin_name . '_login', $this->plugin_name . '_token');
        register_setting($this->plugin_name . '_login', $this->plugin_name . '_name');
        register_setting($this->plugin_name . '_login', $this->plugin_name . '_button_text');

        // Button Step
        register_setting($this->plugin_name, $this->plugin_name . '_size');
        register_setting($this->plugin_name, $this->plugin_name . '_color');
        register_setting($this->plugin_name, $this->plugin_name . '_bottom_color');
        register_setting($this->plugin_name, $this->plugin_name . '_text_color');
        register_setting($this->plugin_name, $this->plugin_name . '_color_name');
        register_setting($this->plugin_name, $this->plugin_name . '_just_saved');
        register_setting($this->plugin_name . '_logout', $this->plugin_name . '_logout');

        // Widget Step
        register_setting($this->plugin_name, $this->plugin_name . '_widget_font');
        register_setting($this->plugin_name, $this->plugin_name . '_widget_theme');
        register_setting($this->plugin_name, $this->plugin_name . '_custom_background');
        register_setting($this->plugin_name, $this->plugin_name . '_custom_bar_color');
        register_setting($this->plugin_name, $this->plugin_name . '_widget_bar_text_color');
    }
}