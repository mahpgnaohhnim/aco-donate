<?php
/**
 * Created by IntelliJ IDEA.
 * User: henry
 * Date: 29.07.17
 * Time: 15:07
 */


add_action( 'admin_menu', 'adminPageCreate' );

function adminPageCreate(){
    //add_plugins_page("ACO Donation", "ACO Donation", 'manage_options', "Test-identifier","initPluginSettings");

    $page_title = 'ACO Donation';
    $menu_title = 'ACO Donation';
    $capability = 'manage_options';
    $menu_slug = 'aco_donation_page';
    $function = 'acoDonationAdminPage';
    /*$icon_url = '';
    $position = 24;*/

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function);

}

function acoDonationAdminPage(){
    ?>
    <h1>ACO Donation Settings</h1>
    <?php
}