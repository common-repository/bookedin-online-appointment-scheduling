<?php

class PluginConfig {
    private $config = array(
        'server' => 'https://scheduler.bookedin.com/',
        'gunton' => 'https://directory.bookedin.com/',
        'endpoint' => 'getToken.do',
        'apiKey' => 'KSae9OvO8H2J0JPbu29t9yYQ05j1JZ8z',
    );

    private $plugin_name;
    private $version;

    function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_plugin_config() {
        $configJs = $this->plugin_name . 'config';
        wp_register_script($configJs, plugin_dir_url(__FILE__) . '../js/config.js', false, $this->version, false);
        wp_localize_script($configJs, 'pluginConfig', $this->config);
        wp_enqueue_script($configJs); // Enqueue it!
    }

    public function enqueue_plugin_widget_script() {
        wp_enqueue_script($this->plugin_name . 'widget-script', plugin_dir_url(__FILE__) . '../js/widget-script.js', array('jquery'), $this->version, false);
    }

    public function enqueue_plugin_button_script($buttonConfig, $scriptName) {
        $buttonJs = $this->plugin_name . $scriptName;
        wp_register_script($buttonJs, plugin_dir_url(__FILE__) . '../js/button-script.js', false, $this->version, false);
        wp_localize_script($buttonJs, 'buttonConfig', $buttonConfig);
        wp_enqueue_script($buttonJs); // Enqueue it!
    }
}