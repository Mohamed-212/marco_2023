
--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `invoice_installment` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `invioce_id` varchar(100) NOT NULL,
    `amount` decimal(18,2) NOT NULL DEFAULT 0.00,
    `due_date` date NOT NULL,
    `Payment_Date` date NULL,
    `status` boolean DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY `invioce_id` (`invioce_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
    `att_id` int(11) NOT NULL AUTO_INCREMENT,
    `employee_id` int(11) NOT NULL,
    `date` date NOT NULL,
    `sign_in` varchar(30) NOT NULL,
    `sign_out` varchar(30) NOT NULL,
    `staytime` varchar(30) NOT NULL,
    PRIMARY KEY (`att_id`),
    KEY `employee_id` (`employee_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `designation` varchar(150) NOT NULL,
    `details` text NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_history`
--

CREATE TABLE IF NOT EXISTS `employee_history` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `first_name` varchar(50) NOT NULL,
    `last_name` varchar(50) NOT NULL,
    `designation` varchar(100) NOT NULL,
    `phone` varchar(50) NOT NULL,
    `rate_type` int(11) NOT NULL,
    `hrate` float NOT NULL,
    `email` varchar(50) NOT NULL,
    `blood_group` varchar(10) NOT NULL,
    `address_line_1` text NOT NULL,
    `address_line_2` text NOT NULL,
    `image` text DEFAULT NULL,
    `country` varchar(50) NOT NULL,
    `city` varchar(50) NOT NULL,
    `zip` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_payment`
--

CREATE TABLE IF NOT EXISTS `employee_salary_payment` (
    `emp_sal_pay_id` int(11) NOT NULL AUTO_INCREMENT,
    `generate_id` int(11) NOT NULL,
    `employee_id` varchar(50) CHARACTER SET latin1 NOT NULL,
    `total_salary` decimal(18,2) NOT NULL DEFAULT 0.00,
    `total_working_minutes` varchar(50) CHARACTER SET latin1 NOT NULL,
    `working_period` varchar(50) CHARACTER SET latin1 NOT NULL,
    `payment_due` varchar(50) CHARACTER SET latin1 NOT NULL,
    `payment_date` varchar(50) CHARACTER SET latin1 NOT NULL,
    `paid_by` varchar(50) CHARACTER SET latin1 NOT NULL,
    `salary_month` varchar(70) DEFAULT NULL,
    PRIMARY KEY (`emp_sal_pay_id`),
    KEY `employee_id` (`employee_id`),
    KEY `generate_id` (`generate_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_setup`
--

CREATE TABLE IF NOT EXISTS `employee_salary_setup` (
    `e_s_s_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `employee_id` varchar(30) CHARACTER SET latin1 NOT NULL,
    `sal_type` varchar(30) NOT NULL,
    `salary_type_id` varchar(30) CHARACTER SET latin1 NOT NULL,
    `amount` decimal(12,2) NOT NULL DEFAULT 0.00,
    `create_date` date DEFAULT NULL,
    `update_date` datetime(6) DEFAULT NULL,
    `update_id` varchar(30) CHARACTER SET latin1 NOT NULL,
    `gross_salary` float NOT NULL,
    PRIMARY KEY (`e_s_s_id`),
    KEY `employee_id` (`employee_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `date` date NOT NULL,
    `type` varchar(100) NOT NULL,
    `voucher_no` varchar(50) NOT NULL,
    `amount` float NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expense_item`
--

CREATE TABLE IF NOT EXISTS `expense_item` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `expense_item_name` varchar(200) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `personal_loan`
--

CREATE TABLE IF NOT EXISTS `personal_loan` (
    `per_loan_id` int(11) NOT NULL AUTO_INCREMENT,
    `transaction_id` varchar(30) NOT NULL,
    `person_id` varchar(30) NOT NULL,
    `debit` decimal(12,2) DEFAULT 0.00,
    `credit` decimal(12,2) NOT NULL DEFAULT 0.00,
    `date` varchar(30) NOT NULL,
    `details` varchar(100) NOT NULL,
    `status` int(11) NOT NULL COMMENT '1=no paid,2=paid',
    PRIMARY KEY (`per_loan_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `person_information`
--

CREATE TABLE IF NOT EXISTS `person_information` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `person_id` varchar(50) NOT NULL,
    `person_name` varchar(50) NOT NULL,
    `person_phone` varchar(50) NOT NULL,
    `person_address` text NOT NULL,
    `status` int(11) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `person_ledger`
--

CREATE TABLE IF NOT EXISTS `person_ledger` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `transaction_id` varchar(50) NOT NULL,
    `person_id` varchar(50) NOT NULL,
    `date` varchar(50) NOT NULL,
    `debit` decimal(12,2) NOT NULL DEFAULT 0.00,
    `credit` decimal(12,2) NOT NULL DEFAULT 0.00,
    `details` text NOT NULL,
    `status` int(11) NOT NULL COMMENT '1=no paid,2=paid',
    PRIMARY KEY (`id`),
    KEY `person_id` (`person_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pesonal_loan_information`
--

CREATE TABLE IF NOT EXISTS `pesonal_loan_information` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `person_id` varchar(50) NOT NULL,
    `person_name` varchar(50) NOT NULL,
    `person_phone` varchar(30) NOT NULL,
    `person_address` text NOT NULL,
    `status` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `person_id` (`person_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salary_sheet_generate`
--

CREATE TABLE IF NOT EXISTS `salary_sheet_generate` (
    `ssg_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
    `gdate` varchar(30) DEFAULT NULL,
    `start_date` varchar(30) CHARACTER SET latin1 NOT NULL,
    `end_date` varchar(30) CHARACTER SET latin1 NOT NULL,
    `generate_by` varchar(30) CHARACTER SET latin1 NOT NULL,
    PRIMARY KEY (`ssg_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salary_type`
--

CREATE TABLE IF NOT EXISTS `salary_type` (
    `salary_type_id` int(11) NOT NULL AUTO_INCREMENT,
    `sal_name` varchar(100) NOT NULL,
    `salary_type` varchar(50) NOT NULL,
    `status` varchar(30) NOT NULL,
    PRIMARY KEY (`salary_type_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_tax_setup`
--

CREATE TABLE IF NOT EXISTS `payroll_tax_setup` (
    `tax_setup_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `start_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
    `end_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
    `rate` decimal(12,2) NOT NULL DEFAULT 0.00,
    `status` varchar(30) CHARACTER SET latin1 NOT NULL,
    PRIMARY KEY (`tax_setup_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_tax_setup`
--

CREATE TABLE IF NOT EXISTS `payroll_tax_setup` (
    `tax_setup_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `start_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
    `end_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
    `rate` decimal(12,2) NOT NULL DEFAULT 0.00,
    `status` varchar(30) CHARACTER SET latin1 NOT NULL,
    PRIMARY KEY (`tax_setup_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;