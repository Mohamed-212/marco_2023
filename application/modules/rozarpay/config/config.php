<?php

// module directory name
$HmvcConfig['rozarpay']["_title"]       = "Razor Payment Gateway";
$HmvcConfig['rozarpay']["_description"] = "Razor Payment Gateway";
$HmvcConfig['rozarpay']["_version"]   = 1.1;


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['rozarpay']['_database'] = false;
$HmvcConfig['rozarpay']["_tables"] = array();
//Table sql Data insert into existing tables to run module
$HmvcConfig['rozarpay']["_extra_query"] = true;


