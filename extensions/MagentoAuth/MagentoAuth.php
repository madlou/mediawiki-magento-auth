<?php 

# Add the following to LocalSettings.php
#  $wgMageHome = '/home/user/magento/app/Mage.php';
#  require_once("$IP/extensions/MagentoAuth/MagentoAuth.php");
#  $wgAuth = new MagentoAuth();

require_once("$IP/includes/AuthPlugin.php");

class MagentoAuth extends AuthPlugin {

    function userExists($username) {
         return true;
    }

    function authenticate($username, $password) {
        require_once $GLOBALS['wgMageHome'];
        if(!isset($_SESSION)) {
            session_set_cookie_params(0);
            session_start();
        }
        $_SESSION["username"] = strtolower($username);
        $_SESSION["password"] = $password;
        Mage::app();
        $user = Mage::getModel('admin/user')->setWebsiteId(Mage::app()->getStore()->getWebsiteId());
        $auth = $user->authenticate($_SESSION["username"], $_SESSION["password"]);
        if(strlen($auth) > 0){
            return true;
        } else {
            return false;
        }
    }

    function autoCreate() {
        return true;
    }

    function allowPasswordChange() {
        return false;
    }

    function canCreateAccounts() {
        return false;
    }

    function strict() {
        return true;
    }

}