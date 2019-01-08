<?php

$user = new apps_libs_UsersIdentity;
$user->logout();
#$t = (new apps_libs_Router);
#$t->loginPage();

(new apps_libs_Router)->loginPage();

