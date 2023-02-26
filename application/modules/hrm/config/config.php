<?php
// module directory name
$HmvcConfig['hrm']["_title"]     = "Human Resource";
$HmvcConfig['hrm']["_description"] = "Isshue system hrm";
	  
	  
$HmvcConfig['hrm']['_database'] = true;
$HmvcConfig['hrm']["_tables"] = array( 
	'attendance',
	'designation',
	'employee_history',
	'employee_salary_payment',
	'employee_salary_setup',
	'expense',
	'expense_item',
	'personal_loan',
	'person_information',
	'person_ledger',
	'pesonal_loan_information',
	'salary_sheet_generate',
	'salary_type',
);
//Table sql Data insert into existing tables to run module
$HmvcConfig['hrm']["_extra_query"] = TRUE;