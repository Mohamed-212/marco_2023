<?php

// module name
$HmvcMenu["accounting"] = array(
    //set icon
    "icon"           => '<i class="fa fa-book" aria-hidden="true"></i>',
    // Menu List
  	"fiscal_year" => array(
        "controller" => "accounting",
        "method"     => "fiscal_year",
        "permission" => "read"
    ),
    "fiscal_year_ending" => array(
        "controller" => "accounting",
        "method"     => "fiscal_year_ending",
        "permission" => "read"
    ),
    "chart_of_account" => array(
        "controller" => "accounting",
        "method"     => "chart_of_account",
        "permission" => "read"
    ),
    "opening_balance" => array(
        "controller" => "accounting",
        "method"     => "opening_balance",
        "permission" => "read"
    ),
    "customers_opening_balance" => array(
        "controller" => "accounting",
        "method"     => "customers_opening_balance",
        "permission" => "read"
    ),
    "suppliers_opening_balance" => array(
        "controller" => "accounting",
        "method"     => "suppliers_opening_balance",
        "permission" => "read"
    ),
    "supplier_payment" => array(
        "controller" => "accounting",
        "method"     => "supplier_payment",
        "permission" => "read"
    ),
    "cash_adjustment" => array(
        "controller" => "accounting",
        "method"     => "cash_adjustment",
        "permission" => "read"
    ),
    "debit_voucher" => array(
        "controller" => "accounting",
        "method"     => "debit_voucher",
        "permission" => "read"
    ),
    "credit_voucher" => array(
        "controller" => "accounting",
        "method"     => "credit_voucher",
        "permission" => "read"
    ),
    "contra_voucher" => array(
        "controller" => "accounting",
        "method"     => "contra_voucher",
        "permission" => "read"
    ),
    "journal_voucher" => array(
        "controller" => "accounting",
        "method"     => "journal_voucher",
        "permission" => "read"
    ),
    // "voucher_approval" => array(
    //     "controller" => "accounting",
    //     "method"     => "voucher_approval",
    //     "permission" => "read"
    // ),
//    "receipt_voucher" => array(
//        "controller" => "accounting",
//        "method"     => "receipt_voucher",
//        "permission" => "read"
//    ),
    "account_reports" => array(
    	"reports_by_voucher" => array(
	        "controller" => "areports",
	        "method"     => "reports_by_voucher",
	        "permission" => "read"
	    ),
	    "general_ledger" => array(
	        "controller" => "areports",
	        "method"     => "general_ledger",
	        "permission" => "read"
	    ),
	    "profit_loss" => array(
	        "controller" => "areports",
	        "method"     => "profit_loss",
	        "permission" => "read"
	    ),
	    "balance_sheet" => array(
	        "controller" => "areports",
	        "method"     => "balance_sheet",
	        "permission" => "read"
	    ),
	    "trial_balance" => array(
	        "controller" => "areports",
	        "method"     => "trial_balance",
	        "permission" => "read"
	    ),
        "coa_print" => array(
            "controller" => "areports",
            "method"     => "coa_print",
            "permission" => "read"
        ),
    )
);
   