<?php
    $path = 'admin.php?page=bookedin';
    $url = admin_url($path);
?>
<div class="bookedin-selection">
    <img alt="Bookedin Logo" class="bookedin-logo" src="<?php echo plugins_url('images/bookedin_logo_slogan.png', dirname(__FILE__));?>"/>
    <div class="choices">
        <a href="<?php echo $url . '&step=widget' ?>" class="choice choice-widget">
            <div class="choice-wrapper">
                <span class="step-header">Calendar Widget</span>
                <div class="choice-image">
                    <img class="icon-calendar" src="<?php echo plugins_url('images/icon_calendar.png', dirname(__FILE__)); ?>" alt="">
                </div>
                <p>Let's clients book and pay for appointments directly on your website.</p>
                <span class="button-primary">Design your Widget &raquo;</span>
            </div>
        </a>
        <a href="<?php echo $url . '&step=button' ?>" class="choice choice-button">
            <div class="choice-wrapper">
                <span class="step-header">Booking Button</span>
                <div class="choice-image">
                    <span class="icon-button">Book</span>
                </div>
                <p>A button that redirects clients to your Bookedin public scheduling page.</p>
                <span class="button-primary">Design your Button &raquo;</span>
            </div>
        </a>
    </div>
</div>
