<?php
// module directory name
$HmvcConfig['accounting']["_title"]     = "Accounting";
$HmvcConfig['accounting']["_description"] = "Isshue system accounting";
	  
$HmvcConfig['accounting']['_database'] = TRUE;
$HmvcConfig['accounting']["_tables"] = array( 
	'acc_coa',
	'acc_transaction',
	'acc_fiscal_year',
	'acc_card_payments',
	'acc_rv_details',
	'acc_opening_balances'
);
//Table sql Data insert into existing tables to run module
$HmvcConfig['accounting']["_extra_query"] = TRUE;