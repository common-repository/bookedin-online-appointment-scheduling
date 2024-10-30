<?php
    $path = 'admin.php?page=bookedin';
    $url = admin_url($path);

    wp_nonce_field(basename(__FILE__), 'bookedin_post_nonce');
?>
<p>
    <label><input type="checkbox" name="bookedin-add-button" id="bookedin-add-button" <?php echo get_post_meta(get_the_ID(), 'bookedin_button', true) ? 'checked' : ''?>> Add Bookedin Button</label>
    <br>
    <label><input type="checkbox" name="bookedin-add-widget" id="bookedin-add-widget" <?php echo get_post_meta(get_the_ID(), 'bookedin_widget', true) ? 'checked' : ''?>> Add Bookedin Calendar Widget</label>
</p>
<p>
    Let clients book appointments by adding a Bookedin Button or Widget at the end of your page, <a href="<?php echo $url ?>">design them here</a>.
</p>
<p>
    You can also type <b>[bookedin-button]</b> or <b>[bookedin-widget]</b> anywhere inside your content.
</p>
