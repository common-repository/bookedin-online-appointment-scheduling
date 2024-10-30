<?php
include_once('stepTemplate.php');

class SelectionStep implements stepTemplate {
    private $plugin_name;

    public function __construct($plugin_name) {
        $this->plugin_name = $plugin_name;
    }

    public function build() {
        // Nothing to do here.
    }

    public function render_template() {
        include_once(plugin_dir_path(dirname(__FILE__)) . 'partials/step-selection.php');
    }
}