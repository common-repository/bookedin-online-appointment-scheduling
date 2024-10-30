<?php
include_once('stepTemplate.php');

class WidgetStep implements stepTemplate {
    private $plugin_name;

    public function __construct($plugin_name) {
        $this->plugin_name = $plugin_name;
    }

    public function build() {
        $this->build_options();
    }

    private function build_options() {
        add_settings_section(
            $this->plugin_name . '_widget',
            '',
            array($this, $this->plugin_name . '_widget_cb'),
            $this->plugin_name
        );

        add_settings_field(
            $this->plugin_name . '_widget_config',
            'Widget',
            array($this, $this->plugin_name . '_widget_config_cb'),
            $this->plugin_name,
            $this->plugin_name . '_widget'
        );
    }

    public function render_template() {
        include_once(plugin_dir_path(dirname(__FILE__)) . 'partials/step-widget.php');
    }

    public function bookedin_widget_config_cb() {
        echo '<label for="widget-font">Font: </label>
              <select id="widget-font" name="bookedin_widget_font">
                  <option value="arial">Arial</option>
                  <option value="verdana">Verdana</option>
                  <option value="tahoma">Tahoma</option>
                  <option value="georgia">Georgia</option>
                  <option value="times">Times</option>
              </select>
              <label for="widget-theme">Theme: </label>
              <select id="widget-theme" name="bookedin_widget_theme">
                  <option value="white">White</option>
                  <option value="black">Black</option>
                  <option value="brown">Brown</option>
                  <option value="blue">Blue</option>
                  <option value="green">Green</option>
                  <option value="red">Red</option>
                  <option value="custom">Custom</option>
              </select>
              <div class="custom-theme-wrapper" style="display: none;">
                  <label for="widget-custom-background">Background: </label>
                  <select id="widget-custom-background" name="bookedin_custom_background">
                      <option value="light">Light</option>
                      <option value="dark">Dark</option>
                  </select>
                  <label for="bar-color-picker">Bar Color: </label>
                  <input id="bar-color-picker" />
              </div>
              <input type="hidden" id="widget-bar-color" name="bookedin_custom_bar_color" value='. get_option('bookedin_custom_bar_color') .'>
              <input type="hidden" id="selected-font" value='. get_option('bookedin_widget_font') .'>
              <input type="hidden" id="selected-theme" value='. get_option('bookedin_widget_theme') .'>
              <input type="hidden" id="selected-background" value='. get_option('bookedin_custom_background') .'>
              <input type="hidden" id="bookedin-just-saved" name="bookedin_just_saved">
              <input type="hidden" id="bar-text-color" name="bookedin_widget_bar_text_color" value='. get_option('bookedin_widget_bar_text_color') .'>';

    }

    public function bookedin_widget_cb() {

    }
}