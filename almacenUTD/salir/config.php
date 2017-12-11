<?php

/*

PassMasterFlex
Version 1.1

Released July 15, 2003

Updated December 3, 2003

© Lethal Penguin 2003

PassMasterFlex is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by the
Free Software Foundation; either version 2 of the License, or any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

See http://www.gnu.org/ for more information regrading the GNU General Public License.

*/


//Login Settings, username and password. CHANGE THIS IMMEDIATELY!
$set_user = "user";
$set_pass_raw = "pass";


//Header text
$PageTitle = "Lethal Penguin: PassMasterFlex";


//After logout, specify redirect page (currently set to return to login screen):
$redirectURL = "index.php";


//Redirect delay (in milliseconds). This should be OK.
$redirectDelay = "1000";


//No change needed, this encrypts password.
$set_pass = md5($set_pass_raw);

?>
