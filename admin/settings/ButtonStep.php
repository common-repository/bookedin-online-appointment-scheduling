<?php
include_once('stepTemplate.php');

class ButtonStep implements stepTemplate {
    private $plugin_name;

    public function __construct($plugin_name) {
        $this->plugin_name = $plugin_name;
    }

    public function build() {
        $this->build_button();
    }

    private function build_button() {
        add_settings_section(
            $this->plugin_name . '_button',
            '',
            array($this, $this->plugin_name . '_button_cb'),
            $this->plugin_name
        );

        add_settings_field(
            $this->plugin_name . '_color',
            'Color',
            array($this, $this->plugin_name . '_color_cb'),
            $this->plugin_name,
            $this->plugin_name . '_button',
            array('label_for' => $this->plugin_name . '_color')
        );

        add_settings_field(
            $this->plugin_name . '_logout',
            'Logout',
            array($this, $this->plugin_name . '_logout_cb'),
            $this->plugin_name . '_logout'
        );
    }

    public function bookedin_color_cb() {
        echo '<label for="button-size">Size: </label>
              <select id="button-size" name="bookedin_size">
                  <option value="standard">Standard</option>
                  <option value="small">Small</option>
              </select>
              <label for="button-color">Color: </label>
              <select id="button-color">
                  <option value="red">Red</option>
                  <option value="green">Green</option>
                  <option value="blue">Blue</option>
                  <option value="custom">Custom</option>
              </select>
              <input id="colorpicker" style="display: none;" />
              <input type="hidden" id="bookedin-color" name="bookedin_color" value='. get_option('bookedin_color') .'>
              <input type="hidden" id="bookedin-bottom-color" name="bookedin_bottom_color" value='. get_option('bookedin_bottom_color') .'>
              <input type="hidden" id="bookedin-text-color" name="bookedin_text_color" value='. get_option('bookedin_text_color') .'>
              <input type="hidden" id="bookedin-color-name" name="bookedin_color_name" value='. get_option('bookedin_color_name') .'>
              <input type="hidden" id="bookedin-just-saved" name="bookedin_just_saved">
              <input type="hidden" id="bookedin-preview-size" value='. get_option('bookedin_size') .'>';
    }

    public function bookedin_logout_cb() {
        echo '<input type="hidden" id="bookedin-logout" value="true" name="bookedin_logout">';
    }

    public function bookedin_button_cb() {
    }

    public function render_template() {
        include_once(plugin_dir_path(dirname(__FILE__)) . 'partials/step-button.php');
    }
}