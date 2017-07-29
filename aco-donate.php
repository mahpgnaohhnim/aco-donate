<?php
/**
 * Created by IntelliJ IDEA.
 * User: henry
 * Date: 23.04.17
 * Time: 19:34
 */
/*
Plugin Name: ACO Donate
Plugin URI: https://github.com/mahpgnaohhnim/aco-donate
Description: ACO Donation Plugin with Slider and Paypal payment
Author: mahpgnaohhnim
Version: 1.1
Author URI: https://github.com/mahpgnaohhnim
*/

require_once(plugin_dir_path( __FILE__ )."aco-donate-setting.php");

add_shortcode("aco_donation", "aco_donate_shortcode");


function aco_donate_shortcode($atts = [], $content = null){

    wp_enqueue_style('ACODonateSlider', plugin_dir_url( __FILE__ ).'assets/ACODonateSlider.css',false,'1.0','all');
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-1.12.4.js',false,'1.0',true);
    wp_enqueue_script('jqueryUI', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js',false,'1.0',true);
    wp_enqueue_script( 'ACODonateSlider', plugin_dir_url( __FILE__ ) . 'assets/ACODonateSlider.js', array ( 'jquery' ), 1.0, true);

    /*default values*/
    $minDonateValue = 1;
    $maxDonateValue = 1000;
    /*if shortcode got params*/
    if($atts["max"]){
        $maxDonateValue = $atts["max"];
    }
    if($atts["min"]){
        $minDonateValue = $atts["min"];
    }

    $donationCurrency = getDonationCurrency();

    $donationInput = "<div>" .
        "<input name='amount' id='donation-input' placeholder='Donation' value='".$minDonateValue."' min='".$minDonateValue."' max='".$maxDonateValue."' autocomplete='off' pattern='[0-9]' type='number'>" .
        "<span id='donation-currency'> ". $donationCurrency ."</span>".
        "</div>";

    $slider =   "<div id='donation-slider'>" .
        "<div id='slide-rail'>" .
        "<div id='slide-grip'></div>" .
        "</div>" .
        "<span id='min-donation'>".$minDonateValue."</span>" .
        "<span id='max-donation'>".$maxDonateValue."</span>" .
        "</div>";

    $donationForm = "<form target='_blank' name='Donation Form' action='https://www.paypal.com/cgi-bin/webscr' method='post'>" .
        "<input type='hidden' name='cmd' value='_donations'>" .
        "<input type='hidden' name='return' value='". $returnPage ."' />" .
        "<input name='business' value='finance@asia-charity.de' type='hidden'>" .
        "<input name='currency_code' value='EUR' type='hidden'>" .
        "<label class='labelCenter'>Project auswählen:</labelid>".
        "<select id='projDrop' name='item_name'>";
        $options = get_option('aco_donation_options');
        foreach ($options['projects'] as $project){
            $donationForm .= "<option value='Spende: ".$project."'>".$project."</option>";

        };
        $donationForm .= "</select><br><br>".
        $donationInput .
        "<br>" .
        $slider .
        "<br>" .
        "<button type='submit' name='submit' >Spenden</button>" .
        //"<input type=\"image\" src=\"http://www.paypal.com/en_US/i/btn/x-click-butcc-donate.gif\" name=\"submit\" alt=\"Make payments with PayPal - it's fast, free and secure!\">" .
        "</form>";

    return $content.$donationForm;

}

function getDonationCurrency(){
    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
    echo '<h2>My Custom Submenu Page</h2>';
    echo '</div>';
}
