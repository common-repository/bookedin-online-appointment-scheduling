<?php
    $backgroundColor    = get_option('bookedin_color') ? get_option('bookedin_color') : '#D52B2B';
    $buttonSize         = get_option('bookedin_size');
    $bottomColor        = get_option('bookedin_bottom_color') ? get_option('bookedin_bottom_color') : '#b42424';
    $textColor          = get_option('bookedin_text_color') ? get_option('bookedin_text_color') : '#ffffff';
    $iconColor          = $textColor === '#ffffff' ? 'white-icon' : 'black-icon';
    $buttonText         = get_option('bookedin_button_text') ? get_option('bookedin_button_text') : 'Book Now';
?>

<div class="button-container">
    <a class="<?php echo 'button-preview ' . $buttonSize ?>" onclick="return false;" style="background-color: <?php echo $backgroundColor ?>;
                                                                                            color: <?php echo $textColor ?>;
                                                                                            border-color: <?php echo $bottomColor ?>;">
        <div class="button-icon" style="width: 31px;">
            <i class="<?php echo $iconColor ?>"></i>
        </div>
        <span class="book-now"><?php echo $buttonText ?></span>
    </a>
</div>
