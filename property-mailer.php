<?php
/**
Plugin Name: Property Mailer
Description: Email available properties to agencies
Version: 2.0
Author: Rokas Bendikas
Text Domain: pm-api
*/

/////////////////////////////////////////////////////////////////////////////////////////

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/////////////////////////////////////////////////////////////////////////////////////////
//SETTINGS
/////////////////////////////////////////////////////////////////////////////////////////
    

///Hook into that action that'll fire at set time
add_action('send_email', 'send_email');
add_action('send_email_daily_check', 'send_email_daily_check');


//Function sending an email to the agencies periodically
function send_email($show_time = "+ 60 days") {
    
    
	$message = 
	"Header";


    $properties = get_property_ids();
    
    foreach($properties as &$i) {
        
        $date = get_date($i);
        $area = get_area($i);
        $price = round(get_price($i) * get_area($i),0);
        $image = get_image($i);
        $title = get_title($i);
        $plan = get_plan($i);
        $link = get_property_link($i);
        
        if(get_today() >= $date){
            
            $date_for_show = "<span style='Color:#00ff00;'>Laisva</span>";
            
            $message .=
            "
            <strong>$title</strong>
            <p>
            <img class='wp-image-667 alignleft' title=$title src=$image alt='' width='140' height='105'>
            <p>
                <strong>Status: </strong>$date_for_show
                <p>
            <strong>Area:</strong> $area m²
            <p>
                <strong>Price:</strong> $price EUR + PVM
                <p>
            <a href=$plan target='_blank' rel='noopener noreferrer'>Plan (PDF)
            </a>
            <p>
            <a href=$link>More...</a>
            <hr>";
            
        } elseif($date < date('Y-m-d', strtotime($show_time))){
            
            $date_for_show = "<span style='Color:red;'>Free from $date</span>";
            
            $message .=
            "
            <strong>$title</strong>
            <p>
            <img class='wp-image-667 alignleft' title=$title src=$image alt='' width='140' height='105'>
            <p>
                <strong>Status: </strong>$date_for_show
                <p>
            <strong>Area:</strong> $area m²
            <p>
                <strong>Price:</strong> $price EUR + PVM
                <p>
            <a href=$plan target='_blank' rel='noopener noreferrer'>Plan (PDF)
            </a>
            <p>
            <a href=$link>More...</a>
            <hr>";

        }
        
    }
    
     
    
    
    $subject = '';
    $to = array('');
    $bcc = get_option('pm_mlist');

    $headers = array('Content-Type: text/html; charset=UTF-8');
    $headers[] = 'From: Email-name <email@adress.com>';
    $headers[] = 'Bcc:'.$bcc;
    $headers[] = 'x-smtpapi-to: email@adress.com';

    $mail = wp_mail($to, $subject, $message, $headers, $attachments);

    $redirect_url = get_bloginfo("url") . "/wp-admin/admin.php?page=PropertyMailer&sent=success";
    header("Location: ".$redirect_url);
    exit;
}
    
//Function sending email daily with properties which are about to go free. Used to inform our managers.
function send_email_daily_check() {
    
    
	$message = 
	"Header";



    $to_send = 0;

    $properties = get_property_ids();
    
    foreach($properties as &$i) {
        
        $date = get_date($i);
        $area = get_area($i);
        $price = round(get_price($i) * get_area($i),0);
        $image = get_image($i);
        $title = get_title($i);
        $plan = get_plan($i);
        $link = get_property_link($i);
        
        
        
            
        if(($date == date('Y-m-d', strtotime('+90 days')))||($date == date('Y-m-d', strtotime('+85 days')))){
            
            $date_for_show = "<span style='Color:red;'>Free from $date</span>";
            $to_send = $to_send + 1;
            
            $message .=
            "
            <strong>$title</strong>
            <p>
            <img class='wp-image-667 alignleft' title=$title src=$image alt='' width='140' height='105'>
            <p>
                <strong>Status: </strong>$date_for_show
                <p>
            <strong>Area:</strong> $area m²
            <p>
                <strong>Price:</strong> $price EUR + PVM
                <p>
            <a href=$plan target='_blank' rel='noopener noreferrer'>Plan (PDF)
            </a>
            <p>
            <a href=$link>More...</a>
            <hr>";

        }
        
    }
    
    
    
    
    if ($to_send != 0){
    $subject = '';
    $to = array('email@adress.com');
    $cc = get_option('pm_mlist');

    $headers = array('Content-Type: text/html; charset=UTF-8');
    $headers[] = 'From: Email-name <email@adress.com>';
    $headers[] = 'Cc: email@adress.com';
    $headers[] = 'x-smtpapi-to: email@adress.com';

    $mail = wp_mail($to, $subject, $message, $headers, $attachments);}


    $redirect_url = get_bloginfo("url") . "/wp-admin/admin.php?page=PropertyMailer&sent=success";
    header("Location: ".$redirect_url);
    exit;
}
        
    
    
    


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Register the menu

add_action( "admin_menu", "pm_plugin_menu_func" );

function pm_plugin_menu_func() {
    add_menu_page( 
                        "Property Mailer",               // Page title
                        "Property Mailer",               // Menu title
                        "edit_pages",                    // Minimum capability (manage_options is an easy way to target Admins)
                        "PropertyMailer",                // Menu slug
                        "pm_plugin_options"              // Callback that prints the markup
                    );
}

//////////////////////////////////////////////////////////////////////////////////////

// Print the markup for the page

function pm_plugin_options() {

    if ( !current_user_can( "edit_pages" ) )  {
        wp_die( __( "You do not have sufficient permissions to access this page." ) );
    }

    if ( isset($_GET['status']) && $_GET['status']=='success') { 
    ?>
        <div id="message" class="updated notice is-dismissible">
            <p><?php _e("Settings updated!", "pm-api"); ?></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?php _e("Dismiss this notice.", "pm-api"); ?></span>
            </button>
        </div>
    <?php
    }

    if ( isset($_GET['sent']) && $_GET['sent']=='success') { 
    ?>
        <div id="message" class="updated notice is-dismissible">
            <p><?php _e("Email Sent!", "pm-api"); ?></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?php _e("Dismiss this notice.", "pm-api"); ?></span>
            </button>
        </div>
    <?php
    }

    ?>

<!-- Daily check mailer from here -->

// Interactive toggle
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>


<form id = "toggle_form" method="post" action="<?php echo admin_url( 'admin-post.php'); ?>">
        
        <input type="hidden" name="action" value="update_daily_toggle_state" />

        <h3><?php _e("Daily check mailer settings", "pm-api"); ?></h3>

        <label class="switch">
            

            <input type="checkbox" name="toggle_switch_value" value="1" onchange="document.getElementById('toggle_form').submit()" <?php echo (get_option('toggle') ? 'checked' : '') ?>>

            <span class="slider round"></span>
        
  
        </label>
</form>

<!-- Schedule settings form -->

    <form method="post" action="<?php echo admin_url( 'admin-post.php'); ?>">

        <input type="hidden" name="action" value="update_property_mailer_settings_schedule" />

        <h3><?php _e("Mailer settings", "pm-api"); ?></h3>
        <p>
        <label><?php _e("Sending frequency: ", "pm-api"); ?>
        <?php echo get_option('pm_f');?>
        </label>
        </p>

        <p>
        <select name="pm_f">
        <option value= "none"> Don't send </option>
        <option value= "daily"> Daily </option>
        <option value= "weekly"> Weekly </option>
        <option value= "twice a month"> Twice a month </option>
        <option value= "monthly"> Monthly </option>
        </select>
        </p>


        <p>
        <label><?php _e("Sending time: ", "pm-api"); ?>
        <?php echo get_option('pm_t');?></label>
        <p>

        <select name="pm_t"><?php echo get_times(); ?></select>

        <p>
        <input class="button button-primary" type="submit" value="<?php _e("Save", "pm-api"); ?>" />
        
    </form>
<br>

<!-- Mailing list settings form -->

    <form method="post" action="<?php echo admin_url( 'admin-post.php'); ?>">

        <input type="hidden" name="action" value="update_property_mailer_settings_mlist" />

        <p>
        <label><?php _e("Mailing list:", "pm-api"); ?></label>
        </p>

        <p>
        <textarea name="pm_mlist" rows="5" cols="40"><?php echo get_option('pm_mlist');?></textarea>
        </p>

        <input class="button button-primary" type="submit" value="<?php _e("Save", "pm-api"); ?>" />
        
    </form>


<?php

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


add_action( 'admin_post_update_property_mailer_settings_schedule', 'property_mailer_handle_save_schedule' );
add_action( 'admin_post_update_property_mailer_settings_mlist', 'property_mailer_handle_save_mlist' );
add_action( 'admin_post_update_daily_toggle_state', 'property_mailer_handle_toggle_daily' );

// Function updating toggle state
function property_mailer_handle_toggle_daily() {
    $toggle = get_option("toggle") ? False : True;
    update_option( "toggle", $toggle, TRUE);

    // Creating a schedule for event
    if (( wp_next_scheduled( "send_email_daily_check" ) ) && (!get_option("toggle"))){
        $timestamp = wp_next_scheduled( "send_email_daily_check" );
        wp_unschedule_event( $timestamp, "send_email_daily_check" );
    }

    if (get_option("toggle")){
        wp_schedule_event( strtotime('+1 day'), 'daily', "send_email_daily_check" );
    }

    // Redirect back to settings page
    // The ?page=github corresponds to the "slug" 
    // set in the fourth parameter of add_submenu_page() above.
    $redirect_url = get_bloginfo("url") . "/wp-admin/admin.php?page=PropertyMailer&status=success";
    header("Location: ".$redirect_url);
    exit;
}

// Function saving scheduling changes
function property_mailer_handle_save_schedule() {

    // Get the options that were sent
    $freq = (!empty($_POST["pm_f"])) ? $_POST["pm_f"] : NULL;
    $time = (!empty($_POST["pm_t"])) ? $_POST["pm_t"] : NULL;


    // Update the values
    update_option( "pm_f", $freq, TRUE );
    update_option("pm_t", $time, TRUE);

    // Creating a schedule for event
    if ( wp_next_scheduled( "send_email" ) ) {
        $timestamp = wp_next_scheduled( "send_email" );
        wp_unschedule_event( $timestamp, "send_email" );
    }

    if (get_option("pm_f")!= "none"){
        wp_schedule_event( strtotime(get_option('pm_t'))- 60*60*3, get_option("pm_f"), "send_email" );
    }

    // Redirect back to settings page
    // The ?page=github corresponds to the "slug" 
    // set in the fourth parameter of add_submenu_page() above.
    $redirect_url = get_bloginfo("url") . "/wp-admin/admin.php?page=PropertyMailer&status=success";
    header("Location: ".$redirect_url);
    exit;
}
   
// FUnction saving mailing list 
function property_mailer_handle_save_mlist() {

    // Get the options that were sent
       
    $mlist = (!empty($_POST["pm_mlist"])) ? $_POST["pm_mlist"] : NULL;

    // Update the values
    update_option("pm_mlist", $mlist, TRUE);

    // Redirect back to settings page
    // The ?page=github corresponds to the "slug"
    // set in the fourth parameter of add_submenu_page() above.
    $redirect_url = get_bloginfo("url") . "/wp-admin/admin.php?page=PropertyMailer&status=success";
    header("Location: ".$redirect_url);
    exit;
}

