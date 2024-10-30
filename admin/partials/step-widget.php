<?php
    if (get_option('bookedin_logout')) {
        $path = admin_url('admin.php?page=bookedin');
        echo "<script>window.location.replace(\"{$path}\")</script>";
    };

    $displayName = get_option('bookedin_name');
    $displaySuccess = get_option('bookedin_just_saved') === 'true' ? 'visible' : '';
    $postsUrl = admin_url('edit.php');
    $pagesUrl = admin_url('edit.php?post_type=page');
    delete_option('bookedin_just_saved');
?>
<div class="widget-user-info">
    <?php include_once('step-logout.php'); ?>
</div>
<div class="bookedin-widget">
    <img src="<?php echo plugins_url('images/bookedin_logo_slogan.png', dirname(__FILE__)); ?>"
         alt="Bookedin Logo"
         class="bookedin-logo"/>
    <span class="step-header">
        Design your widget for:
        <p class="display-name"><?php echo $displayName ?></p>
    </span>
    <form id="widget-step" method="post" action="options.php">
        <hr>
        <?php settings_fields('bookedin'); ?>
        <?php do_settings_sections('bookedin'); ?>
        <a href="javascript:saveWidget()" class="button-primary">Save Changes</a>
        <div class="<?php echo 'success-message ' . $displaySuccess ?>">
            <span class="message-text">
                Success! Your widget has been saved.
                <br>Now you can add online booking to any <a href="<?php echo $pagesUrl ?>">Page</a> or <a href="<?php echo $postsUrl ?>">Post</a>.
            </span>
        </div>
        <hr>
    </form>
    <span class="button-container-label">Preview (actual size)</span>
    <div class="bookedin-widget-wrapper" inverted-bar-color="true" style="font-family: Arial;">
        <span class="date">Wednesday, December 16, 2015</span>
        <div class="calendar-icon"><i class="fa fa-calendar"></i></div>
        <div class="date-changer">
            <div class="prev">
                <i class="fa fa-caret-left"></i> Prev Avail
            </div>
            <div class="today">Today</div>
            <div class="next">
                <i class="fa fa-caret-right"></i> Next Avail
            </div>
        </div>
        <div class="category">
            <div class="category-title">Sample Category</div>
            <div class="service">
                <div class="service-title">Sample Service</div>
                <p></p>
                <div class="resource">
                    <div class="resource-title">John Smith</div>
                    <table class="dates-table">
                        <tbody>
                        <tr>
                            <td><a onclick="return false;">9:00am</a></td>
                            <td><a onclick="return false;">10:00am</a></td>
                            <td><a onclick="return false;">1:00pm</a></td>
                            <td><a onclick="return false;">2:00pm</a></td>
                            <td><a onclick="return false;">3:00pm</a></td>
                            <td><a onclick="return false;">4:00pm</a></td>
                            <td><a onclick="return false;">5:00pm</a></td>
                            <td><a onclick="return false;">6:00pm</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="resource">
                    <div class="resource-title">Smith John</div>
                    <table class="dates-table">
                        <tbody>
                        <tr>
                            <td><a onclick="return false;">9:00am</a></td>
                            <td><a onclick="return false;">10:00am</a></td>
                            <td><a onclick="return false;">1:00pm</a></td>
                            <td><a onclick="return false;">2:00pm</a></td>
                            <td><a onclick="return false;">3:00pm</a></td>
                            <td><a onclick="return false;">4:00pm</a></td>
                            <td><a onclick="return false;">5:00pm</a></td>
                            <td><a onclick="return false;">6:00pm</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="category">
            <div class="category-title">Sample Category #2</div>
            <div class="service">
                <div class="service-title">Sample Service #2</div>
                <p></p>
                <div class="resource">
                    <div class="resource-title">John Smith</div>
                    <table class="dates-table">
                        <tbody>
                        <tr>
                            <td><a onclick="return false;">9:00am</a></td>
                            <td><a onclick="return false;">10:00am</a></td>
                            <td><a onclick="return false;">1:00pm</a></td>
                            <td><a onclick="return false;">2:00pm</a></td>
                            <td><a onclick="return false;">3:00pm</a></td>
                            <td><a onclick="return false;">4:00pm</a></td>
                            <td><a onclick="return false;">5:00pm</a></td>
                            <td><a onclick="return false;">6:00pm</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="resource">
                    <div class="resource-title">Smith John</div>
                    <table class="dates-table">
                        <tbody>
                        <tr>
                            <td><a onclick="return false;">9:00am</a></td>
                            <td><a onclick="return false;">10:00am</a></td>
                            <td><a onclick="return false;">1:00pm</a></td>
                            <td><a onclick="return false;">2:00pm</a></td>
                            <td><a onclick="return false;">3:00pm</a></td>
                            <td><a onclick="return false;">4:00pm</a></td>
                            <td><a onclick="return false;">5:00pm</a></td>
                            <td><a onclick="return false;">6:00pm</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="resource">
                    <div class="resource-title">John Smith</div>
                    <table class="dates-table">
                        <tbody>
                        <tr>
                            <td><a onclick="return false;">9:00am</a></td>
                            <td><a onclick="return false;">10:00am</a></td>
                            <td><a onclick="return false;">1:00pm</a></td>
                            <td><a onclick="return false;">2:00pm</a></td>
                            <td><a onclick="return false;">3:00pm</a></td>
                            <td><a onclick="return false;">4:00pm</a></td>
                            <td><a onclick="return false;">5:00pm</a></td>
                            <td><a onclick="return false;">6:00pm</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function saveWidget() {
        jQuery(window).trigger('saveWidget');
    }
</script>
