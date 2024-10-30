<?php

require_once('settings/StepsFactory.php');
require_once('settings/Settings.php');
require_once('settings/PluginConfig.php');

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://bookedin.com/?cid=265
 * @since      1.0.0
 *
 * @package    booked_in
 * @subpackage booked_in/admin
 */

/**
 * Bookedin admin functionality.
 *
 * Sets up all the plugin admin screens.
 *
 * @package    booked_in
 * @subpackage booked_in/admin
 * @author     Kelvin De Moya <kelvin.demoya@bookedin.net>
 */
class BookedIn_Admin {
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    private $email;
    private $currentStep;
    private $settings;
    private $pluginConfig;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version     The version of this plugin.
     */
    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->email = get_option('bookedin_username');
        $this->settings = new Settings($this->plugin_name);
        $this->setCurrentStep(new StepsFactory());
        $this->pluginConfig = new PluginConfig($plugin_name, $version);
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/admin.css', array(), $this->version, 'all');
        wp_enqueue_style('spectrum', plugin_dir_url(__FILE__) . 'css/spectrum.css', array(), $this->version, 'all');
        wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        $this->pluginConfig->enqueue_plugin_config();
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/admin.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name . 'widget', plugin_dir_url(__FILE__) . 'js/widget.js', array('jquery'), $this->version, false);
        wp_enqueue_script('spectrum', plugin_dir_url(__FILE__) . 'js/spectrum.js', array('jquery'), $this->version, false);
    }

    public function register_metabox() {
        add_meta_box( 'bookedin_meta', 'Bookedin Online Scheduling', array(__CLASS__, 'render_metabox'), array('post', 'page') );
    }

    public static function render_metabox($post) {
        $email = get_option('bookedin_username');

        if (strlen($email)) {
            include('partials/metabox-display.php');
        }
    }

    public function save_metabox($postId, $post) {
        $shouldButtonDisplay = isset($_POST['bookedin-add-button']);
        $shouldWidgetDisplay = isset($_POST['bookedin-add-widget']);
        $buttonKey = 'bookedin_button';
        $widgetKey = 'bookedin_widget';

        if ($shouldButtonDisplay) {
            update_post_meta($postId, $buttonKey, $shouldButtonDisplay);
        } else {
            delete_post_meta($postId, $buttonKey);
        }

        if ($shouldWidgetDisplay) {
            update_post_meta($postId, $widgetKey, $shouldWidgetDisplay);
        } else {
            delete_post_meta($postId, $widgetKey);
        }
    }

    public function process_content($content) {
        $postId = get_the_ID();

        if (!empty($postId)) {
            $buttonShortCode = get_post_meta($postId, 'bookedin_button', true) ? '[bookedin-button]' : '';
            $widgetShortCode = get_post_meta($postId, 'bookedin_widget', true) ? '[bookedin-widget]' : '';
            $content = $content . $buttonShortCode . $widgetShortCode;
        }

        return $content;
    }

    private function setCurrentStep($stepFactory) {
        $stepParam = isset($_GET['step']) ? $_GET['step'] : '';

        if ($stepParam == 'button') {
            $this->currentStep = $stepFactory->create('button', $this->plugin_name);
        } else if ($stepParam == 'widget') {
            $this->currentStep = $stepFactory->create('widget', $this->plugin_name);
        } else if (strlen($this->email) && !get_option('bookedin_logout')) {
            $this->currentStep = $stepFactory->create('selection', $this->plugin_name);
        } else {
            $this->currentStep = $stepFactory->create('login', $this->plugin_name);
        }

        $this->settings->init($this->plugin_name);
    }

    public function add_menu() {
        add_menu_page(
            apply_filters($this->plugin_name . '-settings', 'Bookedin Settings'),
            apply_filters($this->plugin_name . '-settings', 'Bookedin'),
            'manage_options',
            $this->plugin_name,
            array($this, 'get_admin_page')
        );
    }

    public function register_shortcodes() {
        // Button shortcodes.
        add_shortcode('bookedin-button', array($this, 'get_shortcode_button'));
        add_shortcode('bookedinbutton', array($this, 'get_shortcode_button'));
        add_shortcode('bookedin_button', array($this, 'get_shortcode_button'));

        // Widget shortcodes.
        add_shortcode('bookedin-widget', array($this, 'get_shortcode_widget'));
        add_shortcode('bookedinwidget', array($this, 'get_shortcode_widget'));
        add_shortcode('bookedin_widget', array($this, 'get_shortcode_widget'));
    }

    public function get_shortcode_button() {
        ob_start();
        include('partials/button-display.php');
        return ob_get_clean();
    }

    public function get_shortcode_widget() {
        ob_start();
        include('partials/widget-display.php');
        return ob_get_clean();
    }

    public function get_admin_page() {
        $this->currentStep->render_template();
    }

    public function register_bookedin_widget() {
        $widget = new BookedInWidget($this->pluginConfig);
        register_widget($widget);
    }

    public function register_settings() {
        $this->currentStep->build();
    }
}