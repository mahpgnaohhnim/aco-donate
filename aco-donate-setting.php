<?php
/**
 * Created by IntelliJ IDEA.
 * User: henry
 * Date: 29.07.17
 * Time: 15:07
 */


add_action('admin_menu', 'adminPageCreate');

function adminPageCreate() {

    $page_title = 'ACO Donation';
    $menu_title = 'ACO Donation';
    $capability = 'manage_options';
    $menu_slug = 'aco_donation_page';
    $function = 'acoDonationAdminPage';
    /*$icon_url = '';
    $position = 24;*/

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);

}

function saveProject() {
    if (isset($_POST["project"]) && $_POST["project"] != "") {
        $val = $_POST["project"];
        $options = get_option('aco_donation_options');
        $projArr = array();

        if (!isset($options['projects'])) {
            $options['projects'] = array();
        } else {
            $projArr = $options['projects'];
        }

        $entryExist = checkEntry($projArr, $val);
        if ($entryExist == false) {
            array_push($projArr, $val);//if(isset())
            $options['projects'] = $projArr;
            update_option('aco_donation_options', $options);
        }
    }
}

function deleteProject(){
   $options = get_option('aco_donation_options');

    $projArr = array_diff($options['projects'], array($_POST['deleteProject']));
    $options['projects'] = $projArr;
    update_option('aco_donation_options', $options);
}

function checkEntry($array, $value) {
    $entryExist = false;
    foreach ($array as $entry) {
        if ($value == $entry) {
            $entryExist = true;
        }
    }
    return $entryExist;
}

function saveGeneralSettings(){
    if (isset($_POST["ButtonText"]) && $_POST["ButtonText"] != "") {
        $options = get_option('aco_donation_options');
        $options['btnText'] = $_POST["ButtonText"];
        update_option('aco_donation_options', $options);
    }
}

function acoDonationAdminPage() {
    //delete_option('aco_donation_options');
    add_option('aco_donation_options', array());
    include "aco-donate-settings-view.php";
}