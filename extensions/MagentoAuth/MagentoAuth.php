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
        Mage::app();
        $user = Mage::getModel('admin/user')->setWebsiteId(Mage::app()->getStore()->getWebsiteId());
        $auth = $user->authenticate(strtolower($username), $password);
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
