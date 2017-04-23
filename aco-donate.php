<?php
/**
 * Created by IntelliJ IDEA.
 * User: henry
 * Date: 23.04.17
 * Time: 19:34
 */
/*
Plugin Name: ACO Donate
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: ACO Donation Plugin with Slider and Paypal payment
Author: mahpgnaohhnim
Version: 1.0
Author URI: https://github.com/mahpgnaohhnim
*/
add_action('wp_head', 'add_aco_donation_css_style');
add_action('wp_head', 'add_jQuery');
add_action('wp_head', 'add_aco_slider_script');
add_shortcode("aco_donation", "aco_donate_shortcode");


function aco_donate_shortcode(){

    $donationCurrency = getDonationCurrency();

    $donationInput = "<div>" .
                        "<input name='donation-input' id='donation-input' placeholder='Donation' value='1' min='1' max='1000' autocomplete='off' pattern='[0-9]' type='number'>" .
                        "<span id='donation-currency'> ". $donationCurrency ."</span>".
                    "</div>";

    $slider =   "<div id='donation-slider'>" .
                    "<div id='slide-rail'>" .
                        "<div id='slide-grip'></div>" .
                    "</div>" .
                    "<span id='current-donation'></span>" .
                    "<span id='max-donation'></span>" .
                "</div>";

    $donationForm = $donationInput ."<br>". $slider;

    echo $donationForm;
}


function getDonationCurrency(){
    $currency = "€";
    return $currency;
}

function add_jQuery(){
    ?>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php
}

function add_aco_slider_script(){
    ?>
    <script>

        $('document').ready(function(){
            var grip;
            var rail;
            var startX;
            var railLength;
            var maxVal;
            var donationInput;
            init();

            function init(){
                initSlider();
                initInput();
                startX = rail[0].offsetLeft;
                railLength = rail[0].offsetWidth - grip[0].offsetWidth;
                maxVal = getMaxDonationValue();
            }

            function initInput(){
                donationInput = document.getElementById("donation-input");
                donationInput.addEventListener("keyup", onInputKeyup);
            }

            function initSlider(){
                grip = $('#slide-grip').draggable({ containment: "parent", axis: "x" });
                rail = $('#slide-rail');
                grip.on("drag", onSlideDrag);
            }

            function onSlideDrag(e){
                var currentX = e.target.offsetLeft - startX;
                var percent = currentX/railLength;
                var currentVal = Math.round(percent * maxVal);
                donationInput.value = currentVal;

            }

            function onInputKeyup(){
                var inputVal = donationInput.value;
                if(inputVal !== ""){
                    var percent = inputVal/maxVal;
                    if(percent > 1){
                        percent = 1;
                    }
                    newXPosition = startX + (percent*railLength)
                    grip.css('left', newXPosition);
                }

            }

            function getMaxDonationValue(){
                var maxValue = donationInput.max;
                return maxValue;
            }
        });
    </script>
    <?php
}


function add_aco_donation_css_style(){
    ?>
    <style>
        #donation-input,
        #donation-currency{
            font-size: 20px;
        }

        #donation-input{
            display: inline-block;
            width: 90%;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            text-align: right;
            color: black;
        }

        #donation-slider{
            width: 100%;
            margin-bottom: 20px;
        }

        #slide-rail{
            height: 1px;
            width: 100%;
            background: darkgrey;
        }

        #slide-grip{
            position: absolute;
            height: 30px;
            width:  30px;
            border-radius: 50%;
            background-color: #3490e0;
            background-image: url("http://www.asia-charity.de/wp-content/uploads/2016/01/ACO_Vogel_W-250x250.png");
            background-size: 24px;
            background-repeat: no-repeat ;
            background-position: 2px 5px;
            margin-top: -15px;
            cursor: pointer;
        }


    </style>
    <?php
}