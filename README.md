# mediawiki-magento-auth
Allows you to login to your private mediawiki installation using your magento credentials

## MediaWiki Version
Tested against MediaWiki version 1.22

## Installation Steps
1. Place the MagentoAuth folder into your MediaWiki extension folder
2. Add the following to your LocalSettings.php file, amending the location of your Mage.php file
```php
$wgMageHome = '/home/user/magento/app/Mage.php';
require_once("$IP/extensions/MagentoAuth/MagentoAuth.php");
$wgAuth = new MagentoAuth();
```
