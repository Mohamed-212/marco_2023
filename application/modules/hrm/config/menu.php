<?php

// module name
$HmvcMenu["hrm"] = array(
    //set icon
    "icon"           => '<i class="fa fa-users" aria-hidden="true"></i>',
    // Menu List
    "hrm" => array(
        "add_designation" => array(
            "controller" => "hrm",
            "method"     => "bdtask_designation_form",
            "permission" => "read"
        ),
        "manage_designation" => array(
            "controller" => "hrm",
            "method"     => "bdtask_designation_list",
            "permission" => "read"
        ),
        "add_employee" => array(
            "controller" => "hrm",
            "method"     => "bdtask_employee_form",
            "permission" => "read"
        ),
        "manage_employee" => array(
            "controller" => "hrm",
            "method"     => "bdtask_employee_list",
            "permission" => "read"
        ),
    ),
    "attendance" => array(
        "attendance" => array(
            "controller" => "attendance",
            "method"     => "bdtask_add_attendance",
            "permission" => "read"
        ),
        "manage_attendance" => array(
            "controller" => "attendance",
            "method"     => "manage_attendance",
            "permission" => "read"
        ),
        "attendance_report" => array(
            "controller" => "attendance",
            "method"     => "bdtask_attendance_report",
            "permission" => "read"
        ),
    ),
    "payroll" => array(
        "add_benefits" => array(
            "controller" => "payroll",
            "method"     => "bdtask_beneficial_form",
            "permission" => "read"
        ),
        "manage_benefits" => array(
            "controller" => "payroll",
            "method"     => "manage_benefits",
            "permission" => "read"
        ),
        "add_salary_setup" => array(
            "controller" => "payroll",
            "method"     => "bdtask_salary_setup_form",
            "permission" => "read"
        ),
        "manage_salary_setup" => array(
            "controller" => "payroll",
            "method"     => "manage_salary_setup",
            "permission" => "read"
        ),
        "salary_generate" => array(
            "controller" => "payroll",
            "method"     => "bdtask_salary_generate",
            "permission" => "read"
        ),
        "manage_salary_generate" => array(
            "controller" => "payroll",
            "method"     => "manage_salary_generate",
            "permission" => "read"
        ),
        "salary_payment" => array(
            "controller" => "payroll",
            "method"     => "salary_payment",
            "permission" => "read"
        ),
    ),
//    "expense" => array(
//        "add_expense_item" => array(
//            "controller" => "expense",
//            "method"     => "bdtask_expense_item_form",
//            "permission" => "read"
//        ),
//        "manage_expense_item" => array(
//            "controller" => "expense",
//            "method"     => "bdtask_expense_item_list",
//            "permission" => "read"
//        ),
//        "add_expense" => array(
//            "controller" => "expense",
//            "method"     => "bdtask_add_expense",
//            "permission" => "read"
//        ),
//        "manage_expense" => array(
//            "controller" => "expense",
//            "method"     => "manage_expense",
//            "permission" => "read"
//        ),
//        "expense_statement" => array(
//            "controller" => "expense",
//            "method"     => "expense_statement",
//            "permission" => "read"
//        ),
//    ),
//    "office_loan" => array(
//        "add_person" => array(
//            "controller" => "loan",
//            "method"     => "bdtask_add_office_loan_person",
//            "permission" => "read"
//        ),
//        "add_loan" => array(
//            "controller" => "loan",
//            "method"     => "bdtask_add_office_loan",
//            "permission" => "read"
//        ),
//        "add_payment" => array(
//            "controller" => "loan",
//            "method"     => "bdtask_add_office_loan_payment",
//            "permission" => "read"
//        ),
//        "manage_person" => array(
//            "controller" => "loan",
//            "method"     => "manage_ofln_person",
//            "permission" => "read"
//        ),
//    ),
//    "personal_loan" => array(
//        "add_person" => array(
//            "controller" => "loan",
//            "method"     => "bdtask_add_person",
//            "permission" => "read"
//        ),
//        "add_loan" => array(
//            "controller" => "loan",
//            "method"     => "bdtask_add_loan",
//            "permission" => "read"
//        ),
//        "add_payment" => array(
//            "controller" => "loan",
//            "method"     => "bdtask_add_payment",
//            "permission" => "read"
//        ),
//        "manage_person" => array(
//            "controller" => "loan",
//            "method"     => "manage_person",
//            "permission" => "read"
//        ),
//    ),

);
   