<?php
include_once('stepTemplate.php');

class LoginStep implements stepTemplate {
    private $plugin_name;

    public function __construct($plugin_name) {
        $this->plugin_name = $plugin_name;
    }

    public function build() {
        $this->build_login();
    }

    public function build_login() {
        add_settings_section(
            $this->plugin_name . '_login',
            '',
            array($this, $this->plugin_name . '_login_cb'),
            $this->plugin_name . '_login'
        );

        add_settings_field(
            $this->plugin_name . '_username',
            '',
            array($this, $this->plugin_name . '_username_cb'),
            $this->plugin_name . '_login',
            $this->plugin_name . '_login'
        );
    }

    public function bookedin_username_cb() {
        echo '<input type="text" class="bookedin-username" name="bookedin_username" placeholder="name@example.com"/>
              <input type="hidden" id="bookedin-token" name="bookedin_token">
              <input type="hidden" id="bookedin-name" name="bookedin_name">
              <input type="hidden" id="bookedin-button-text" name="bookedin_button_text">';
    }

    public function bookedin_login_cb() {
    }

    public function render_template() {
        include_once(plugin_dir_path(dirname(__FILE__)) . 'partials/step-login.php');
    }
}