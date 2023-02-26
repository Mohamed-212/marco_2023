INSERT INTO `language` (`phrase`, `english`) VALUES
('accounting', 'Accounting'),
('chart_of_account', 'Chart of Account'),
('opening_balance', 'Opening Balance'),
('supplier_payment', 'Supplier Payment'),
('customer_receive', 'Customer Receive'),
('cash_adjustment', 'Cash Adjustment'),
('debit_voucher', 'Debit Voucher'),
('credit_voucher', 'Credit Voucher'),
('contra_voucher', 'Contra Voucher'),
('journal_voucher', 'Journal Voucher'),
('voucher_approval', 'Voucher Approval'),
('voucher_no', 'Voucher No'),
('account_head', 'Account Head'),
('remark', 'Remark'),
('receipt_voucher', 'Receipt Voucher'),
('receipt_voucher_form', 'Receipt Voucher Form'),
('manage_receipt_voucher', 'Manage Receipt Voucher'),
('payment_voucher', 'Payment Voucher'),
('payment_voucher_form', 'Payment Voucher Form'),
('customer_balance', 'Customer Balance'),
('vat', 'Vat'),
('total_balance', 'Total Balance'),
('remaining_balance', 'Remaining Balance'),
('pay_vat', 'Pay Vat'),
('pay_amount', 'Pay Amount'),
('cash_payment', 'Cash Payment'),
('bank_payment', 'Bank Payment'),
('adjustment_type', 'Adjustment Type'),
('code', 'Code'),
('paytype', 'Paytype'),
('txtCode', 'TxtCode'),
('approved', 'Approved'),
('approve', 'Approve'),
('credit_account_head', 'Credit Account Head'),
('successfully_approved', 'Successfully Approved'),
('debit_account_head', 'Debit Account Head'),
('add_more', 'Add More'),
('update_debit_voucher', 'Update Debit Voucher'),
('update_credit_voucher', 'Update Credit Voucher'),
('update_journal_voucher', 'Update Journal Voucher'),
('update_contra_voucher', 'Update Contra Voucher'),
('customer_head_code', 'Customer Head Code'),
('current_balance', 'Current Balance'),
('total_vat', 'Total Vat'),
('account_reports', 'Account Reports'),
('general_ledger', 'General Ledger'),
('profit_loss', 'Profit Loss'),
('balance_sheet', 'Balance Sheet'),
('cash_flow_statement', 'Cash Flow Statement'),
('trial_balance', 'Trial Balance'),
('reports_by_voucher', 'Reports By Voucher'),
('select_voucher_no', 'Select Voucher No'),
('voucher_reports', 'Voucher Reports'),
('account_code', 'Account Code'),
('created_date', 'Created Date'),
('general_ledger_form', 'General Ledger Form'),
('general_ledger_report', 'General Ledger Report'),
('transection_date', 'Transection Date'),
('head_code', 'Head Code'),
('particulars', 'Particulars'),
('profit_loss_report', 'Profit Loss Report'),
('authorized_signature', 'Authorized Signature'),
('trial_balance_with_opening_as_on', 'Trial balance with opening as on'),
('opening_cash_and_equivalent', 'Opening Cash and Equivalent'),
('trial_balance_without_opening', 'Trial Balance Without Opening'),
('trial_balance_with_opening', 'Trial Balance With Opening'),
('general_ledger_reports', 'General Ledger Reports'),
('another_fiscal_year_exist_in_given_range', 'Another Fiscal Year Exist in Given Date Range!'),
('invalid_date_selection', 'Invalid date selection! Please select a date from active fiscal year'),
('fields_must_not_be_empty', 'Fields must not be empty!'),
('fiscal_year', 'Fiscal Year'),
('cash_control_account', 'Cash Control Account'),
('fiscal_year_ending', 'Fiscal Year Ending'),
('fiscal_year_closed_successfully', 'Fiscal Year Closed Successfully'),
('an_active_fiscal_year_exists', 'An active fiscal year exists'),
('please_add_new_fiscal_year_first', 'Please add new fiscal year first');


INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `PHeadCode`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `customer_id`, `supplier_id`, `bank_id`, `store_id`, `service_id`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES
('1', 'Assets(الأصـــــول)', 'COA', '0', 0, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-17 09:50:20', '', '0000-00-00 00:00:00'),
('11', 'Current Assets(الأصول المتداوله)', 'Assets(الأصـــــول)', '1', 1, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-17 08:27:49', '', '0000-00-00 00:00:00'),
('111', 'Cash In Boxes(النقدية بالصناديق)', 'Current Assets(الأصول المتداوله)', '11', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:30:14', '', '0000-00-00 00:00:00'),
('1111', 'Cash in box general administration(صندوق الإدارة العامة)', 'Cash In Boxes(النقدية بالصناديق)', '111', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 12:38:53', '', '0000-00-00 00:00:00'),
('1112', 'Cash in box Amanuh branch 1(صندوق فرع الأمانة 1)', 'Cash In Boxes(النقدية بالصناديق)', '111', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 12:39:12', '', '0000-00-00 00:00:00'),
('1113', 'Cash in box Narges branch 2(صندوق فرع النرجس 2)', 'Cash In Boxes(النقدية بالصناديق)', '111', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 12:39:15', '', '0000-00-00 00:00:00'),
('1114', 'Cash in box Al-Sahafa branch(صندوق فرع الصحافة)', 'Cash In Boxes(النقدية بالصناديق)', '111', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 12:39:17', '', '0000-00-00 00:00:00'),
('1115', 'Cash in box Al-Sahafa branch 4(صندوق فرع الصحافة 4)', 'Cash In Boxes(النقدية بالصناديق)', '111', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 12:39:20', '', '0000-00-00 00:00:00'),
('1116', 'Cash in box gameleven store', 'Cash In Boxes(النقدية بالصناديق)', '111', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, 'UBEVXKARBN86OUQ', NULL, '0.00', 'super admin', '2021-12-01 08:49:45', '', '0000-00-00 00:00:00'),
('1117', 'Cash in box New Store 1', 'Cash In Boxes(النقدية بالصناديق)', '111', 4, 1, 1, 0, 'A', 0, 0, NULL, NULL, NULL, 'J7UR5HPUQ59H689', NULL, '0.00', 'super admin', '2021-12-01 08:50:27', '', '0000-00-00 00:00:00'),
('112', 'Cash in Banks(البنك )', 'Current Assets(الأصول المتداوله)', '11', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:30:19', '', '0000-00-00 00:00:00'),
('1120001', 'YITM5B6CM5 - sabit banksdgs', 'Cash in Banks(البنك )', '112', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, 'YITM5B6CM5', NULL, NULL, '0.00', 'super admin', '2021-12-09 09:29:57', '', '0000-00-00 00:00:00'),
('1120003', 'TKEQCGCNSI - sabit 2', 'Cash in Banks(البنك )', '112', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, 'TKEQCGCNSI', NULL, NULL, '0.00', 'super admin', '2021-12-09 09:30:42', '', '0000-00-00 00:00:00'),
('1121', 'Alrajhi Bank (مصرف الراجحي)', 'Cash in Banks(البنك )', '112', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 10:35:01', '', '0000-00-00 00:00:00'),
('1121001', 'Alrajhi Bank Account Number 1 ( مصرف الراجحي حساب رقم 1 )', 'Alrajhi Bank (مصرف الراجحي)', '1121', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-12-02 06:21:04', '', '0000-00-00 00:00:00'),
('1121002', 'Al Rajhi Bank points of sale ( نقاط البيع مصرف الراجحي )', 'Alrajhi Bank (مصرف الراجحي)', '1121', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-12-02 06:22:03', '', '0000-00-00 00:00:00'),
('1122', 'Bank Aljazira(بنك الجزيرة)', 'Cash in Banks(البنك )', '112', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 10:34:58', '', '0000-00-00 00:00:00'),
('1122001', 'Bank Aljazira Account Number 1 ( بنك الجزيره حساب رقم 1  )', 'Bank Aljazira(بنك الجزيرة)', '1122', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-12-02 06:23:07', '', '0000-00-00 00:00:00'),
('1123', 'SNB(  البنك الاهلي السعودي)', 'Cash in Banks(البنك )', '112', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 10:35:05', '', '0000-00-00 00:00:00'),
('1123001', 'SNB Account Number 1 ( بنك الاهلي حساب رقم  )', 'SNB(  البنك الاهلي السعودي)', '1123', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-12-02 06:24:06', '', '0000-00-00 00:00:00'),
('1124', 'Al Rajhi Bank points of sale(نقاط البيع مصرف الراجحي)', 'Cash in Banks(البنك )', '112', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 10:35:07', '', '0000-00-00 00:00:00'),
('1126', '1 - Duch bangla bank', 'Cash in Banks(البنك )', '112', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, '1', NULL, NULL, '0.00', 'super admin', '2021-11-22 10:19:55', '', '0000-00-00 00:00:00'),
('1128', 'QZMQ63W97B - New Bank', 'Cash in Banks(البنك )', '112', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, 'QZMQ63W97B', NULL, NULL, '0.00', 'super admin', '2021-11-22 10:20:01', '', '0000-00-00 00:00:00'),
('113', 'Debit Accounts(الحسابات المدينة)', 'Current Assets(الأصول المتداوله)', '11', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:30:26', '', '0000-00-00 00:00:00'),
('1130', 'VX1WNENHS7 - City Bank', 'Cash in Banks(البنك )', '112', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, 'VX1WNENHS7', NULL, NULL, '0.00', 'super admin', '2021-11-22 10:20:07', '', '0000-00-00 00:00:00'),
('1131', 'Customers(العملاء)', 'Debit Accounts(الحسابات المدينة)', '113', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:27:45', '', '0000-00-00 00:00:00'),
('11310001', 'API3CustomerMobile - 16ZKNXRMRDP4WSA', 'Customers(العملاء)', '1131', 4, 1, 1, 0, 'A', 0, 0, '16ZKNXRMRDP4WSA', NULL, NULL, NULL, NULL, '0.00', 'super admin', '2022-01-10 12:47:03', '', '0000-00-00 00:00:00'),
('11310002', 'Sabit Sabit - 26ZKZEZ37TJU4CI', 'Customers(العملاء)', '1131', 4, 1, 1, 0, 'A', 0, 0, '26ZKZEZ37TJU4CI', NULL, NULL, NULL, NULL, '0.00', 'super admin', '2022-01-11 08:50:15', '', '0000-00-00 00:00:00'),
('11310003', 'Walking Customer - 1', 'Customers(العملاء)', '1131', 4, 1, 1, 0, 'A', 0, 0, '1', NULL, NULL, NULL, NULL, '0.00', 'super admin', '2022-01-11 09:44:29', '', '0000-00-00 00:00:00'),
('11310004', 'Sabit Sabit - 2WVB2GT5YWYMVI2', 'Customers(العملاء)', '1131', 4, 1, 1, 0, 'A', 0, 0, '2WVB2GT5YWYMVI2', NULL, NULL, NULL, NULL, '0.00', 'super admin', '2022-01-11 12:41:35', '', '0000-00-00 00:00:00'),
('11310005', 'Demo User - 2WLEAVH16C29CFI', 'Customers(العملاء)', '1131', 4, 1, 1, 0, 'A', 0, 0, '2WLEAVH16C29CFI', NULL, NULL, NULL, NULL, '0.00', 'super admin', '2022-01-20 11:32:02', '', '0000-00-00 00:00:00'),
('11310006', 'Sabit Sabit - 21VM1WY66BDPSJ2', 'Customers(العملاء)', '1131', 4, 1, 1, 0, 'A', 0, 0, '21VM1WY66BDPSJ2', NULL, NULL, NULL, NULL, '0.00', 'super admin', '2022-01-20 14:56:16', '', '0000-00-00 00:00:00'),
('11310007', 'Alesandro Martin - 1E9FXKHOWDEKKGD', 'Customers(العملاء)', '1131', 4, 1, 1, 0, 'A', 0, 0, '1E9FXKHOWDEKKGD', NULL, NULL, NULL, NULL, '0.00', 'Store  User', '2022-01-23 08:45:28', '', '0000-00-00 00:00:00'),
('11310008', 'Api 3 Updated From Api 3IAGH73ZGQF5O93 - OEAT2G1S4TL8ZEL', 'Customers(العملاء)', '1131', 4, 1, 1, 0, 'A', 0, 0, 'OEAT2G1S4TL8ZEL', NULL, NULL, NULL, NULL, '0.00', 'Store  User', '2022-01-23 09:14:07', '', '0000-00-00 00:00:00'),
('11311', 'New Customer 2 - 81X2U8SBVXO9FB9', 'Customers(العملاء)', '1131', 4, 1, 1, 1, 'A', 0, 0, '81X2U8SBVXO9FB9', NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-15 07:31:21', '', '0000-00-00 00:00:00'),
('11313', 'New Customer - FKTW3LT6E7ZC4LD', 'Customers(العملاء)', '1131', 4, 1, 1, 0, 'A', 0, 0, 'FKTW3LT6E7ZC4LD', NULL, NULL, NULL, NULL, '0.00', 'super admin', '2021-11-04 09:13:05', '', '0000-00-00 00:00:00'),
('11315', 'Sabit Sabit - 4REE6O8SB4X8O7C', 'Customers(العملاء)', '1131', 4, 1, 1, 0, 'A', 0, 0, '4REE6O8SB4X8O7C', NULL, NULL, NULL, NULL, '0.00', 'super admin', '2021-11-04 10:34:50', '', '0000-00-00 00:00:00'),
('11317', 'waseem abudawod - T8S15TBXPD68C9U', 'Customers(العملاء)', '1131', 4, 1, 1, 0, 'A', 0, 0, 'T8S15TBXPD68C9U', NULL, NULL, NULL, NULL, '0.00', 'super admin', '2021-11-06 08:25:43', '', '0000-00-00 00:00:00'),
('11319', 'AlAmin Shobuj - DXB71Z1OJ1PX48N', 'Customers(العملاء)', '1131', 4, 1, 1, 0, 'A', 0, 0, 'DXB71Z1OJ1PX48N', NULL, NULL, NULL, NULL, '0.00', 'super admin', '2021-11-15 09:17:22', '', '0000-00-00 00:00:00'),
('1132', 'Prepaid Expenses(المصروفات المدفوعة مقدما)', 'Debit Accounts(الحسابات المدينة)', '113', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:27:48', '', '0000-00-00 00:00:00'),
('11321', 'Prepaid Rents(الإيجارات المدفوعة مقدما)', 'Prepaid Expenses(المصروفات المدفوعة مقدما)', '1132', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:09', '', '0000-00-00 00:00:00'),
('11322', 'Prepaid Key-money for Exhibition(مصروفات تقبيل الفرع المدفوعة مقدما)', 'Prepaid Expenses(المصروفات المدفوعة مقدما)', '1132', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:12', '', '0000-00-00 00:00:00'),
('11323', 'Prepaid Renewal of residence and work permit(مصاريف تجديد الإقامات وكروت العمل المدفوعة مقدما)', 'Prepaid Expenses(المصروفات المدفوعة مقدما)', '1132', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:15', '', '0000-00-00 00:00:00'),
('11324', 'Prepaid Government fees and expenses(الرسوم والمصروفات الحكومية المدفوعة مقدما)', 'Prepaid Expenses(المصروفات المدفوعة مقدما)', '1132', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:17', '', '0000-00-00 00:00:00'),
('1133', 'Related parties(أطراف ذات علاقة)', 'Debit Accounts(الحسابات المدينة)', '113', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:27:52', '', '0000-00-00 00:00:00'),
('11331', 'Mohammed Ahmed Al-Maadi(محمد أحمد المعدي)', 'Related parties(أطراف ذات علاقة)', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:20', '', '0000-00-00 00:00:00'),
('11332', 'Saad Abdullah Al-Qahtani(سعد عبد الله القحطاني)', 'Related parties(أطراف ذات علاقة)', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:24', '', '0000-00-00 00:00:00'),
('11333', 'Mohammed Saeed Alfar(محمد سعيد الفار)', 'Related parties(أطراف ذات علاقة)', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:27', '', '0000-00-00 00:00:00'),
('11334', 'Saeed Ali Al-Qahtani(سعيد علي القحطاني)', 'Related parties(أطراف ذات علاقة)', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:30', '', '0000-00-00 00:00:00'),
('11335', 'General Manager Saleh Al-Qahtani(المدير العام  صالح القحطاني)', 'Related parties(أطراف ذات علاقة)', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:34', '', '0000-00-00 00:00:00'),
('11336', 'Al-Dirah House Saleh Al-Qahtani(بيت الديرة صالح القحطاني)', 'Related parties(أطراف ذات علاقة)', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:43', '', '0000-00-00 00:00:00'),
('11337', 'Al Jar Allah(آل جار الله)', 'Related parties(أطراف ذات علاقة)', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:47', '', '0000-00-00 00:00:00'),
('114', 'Inventory accounts(حسابات المخزون)', 'Current Assets(الأصول المتداوله)', '11', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:30:29', '', '0000-00-00 00:00:00'),
('1141', 'Inventory(المخزون )', 'Inventory accounts(حسابات المخزون)', '114', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:56', '', '0000-00-00 00:00:00'),
('11411', 'Main warehouse(المستودع الرئيسي )', 'Inventory(المخزون )', '1141', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:02', '', '0000-00-00 00:00:00'),
('11412', 'warehouse Amanuh branch 1(مستودع  فرع الأمانة 1)', 'Inventory(المخزون )', '1141', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:04', '', '0000-00-00 00:00:00'),
('11413', 'warehouse Narges branch 2(مستودع  فرع النرجس 2)', 'Inventory(المخزون )', '1141', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:07', '', '0000-00-00 00:00:00'),
('11414', 'warehouse Al-Sahafa branch (مستودع  فرع الصحافة)', 'Inventory(المخزون )', '1141', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:09', '', '0000-00-00 00:00:00'),
('11415', 'warehouse Al-Sahafa branch 4(مستودع  فرع الصحافة 4)', 'Inventory(المخزون )', '1141', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:13', '', '0000-00-00 00:00:00'),
('11416', 'Goods transport warehouse(مستودع  نقل بضاعه )', 'Inventory(المخزون )', '1141', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:16', '', '0000-00-00 00:00:00'),
('11417', 'Warehouse damaged and lost during transportation(مستودع تالف وفاقد أثناء النقل)', 'Inventory(المخزون )', '1141', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:19', '', '0000-00-00 00:00:00'),
('11418', 'damaged warehouse(مستودع تالف )', 'Inventory(المخزون )', '1141', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:22', '', '0000-00-00 00:00:00'),
('11419', 'Warehouse maintenance and replacement(مستودع الصيانة والاستبدال  )', 'Inventory(المخزون )', '1141', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:24', '', '0000-00-00 00:00:00'),
('115', 'employees advances and deposits(سلف وعهد الموظفين)', 'Current Assets(الأصول المتداوله)', '11', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:32:07', '', '0000-00-00 00:00:00'),
('1151', 'employee advances(سلف الموظفين)', 'employees advances and deposits(سلف وعهد الموظفين)', '115', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:43', '', '0000-00-00 00:00:00'),
('1152', 'employee custody(عهد الموظفين)', 'employees advances and deposits(سلف وعهد الموظفين)', '115', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:46', '', '0000-00-00 00:00:00'),
('116', 'VAT on inputs(ضريبة القيمة المضافة على المدخلات )', 'Current Assets(الأصول المتداوله)', '11', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:48', '', '0000-00-00 00:00:00'),
('12', 'Non-current assets(الأصول الغير متداولة)', 'Assets(الأصـــــول)', '1', 1, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:32:23', '', '0000-00-00 00:00:00'),
('121', 'investments (الإستثمارات)', 'Non-current assets(الأصول الغير متداولة)', '12', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:53', '', '0000-00-00 00:00:00'),
('13', 'Fixed assets(الأصول الثابتة)', 'Assets(الأصـــــول)', '1', 1, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:33:05', '', '0000-00-00 00:00:00'),
('131', 'The historical value of the buildings(القيمة التاريخية للمباني)', 'Fixed assets(الأصول الثابتة)', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:25', '', '0000-00-00 00:00:00'),
('132', 'Historical value of cars(القيمة التاريخية للسيارات)', 'Fixed assets(الأصول الثابتة)', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:28', '', '0000-00-00 00:00:00'),
('133', 'Historical value of equipment and machinery(القيمة التاريخية للمعدات والآلات)', 'Fixed assets(الأصول الثابتة)', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:30', '', '0000-00-00 00:00:00'),
('134', 'Historical value of electronic devices and computers(القيمة التاريخية للأجهزة الألكترونية والحاسب)', 'Fixed assets(الأصول الثابتة)', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:34', '', '0000-00-00 00:00:00'),
('135', 'Historical value of electrical appliances(القيمة التاريخية للأجهزة الكهربائية)', 'Fixed assets(الأصول الثابتة)', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:38', '', '0000-00-00 00:00:00'),
('136', 'Historical value of furniture and furnishings(القيمة التاريخية للآثاث والمفروشات)', 'Fixed assets(الأصول الثابتة)', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:41', '', '0000-00-00 00:00:00'),
('137', 'Historical value of improvements and decoration(القيمة التاريخية للتحسينات والديكور)', 'Fixed assets(الأصول الثابتة)', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:44', '', '0000-00-00 00:00:00'),
('138', 'Historical value of accounting software(القيمة التاريخية للبرامج المحاسبية)', 'Fixed assets(الأصول الثابتة)', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:49', '', '0000-00-00 00:00:00'),
('2', 'Liabilities(الخصوم)', 'COA', '0', 0, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-17 09:50:55', '', '0000-00-00 00:00:00'),
('21', 'Current Liabilities(الخصوم المتداولة)', 'Liabilities(الخصوم)', '2', 1, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2022-01-24 07:09:38', '', '0000-00-00 00:00:00'),
('211', 'Accounts payable(الحسابات الدائنة)', 'Current Liabilities(الخصوم المتداولة)', '21', 2, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-17 09:47:06', '', '0000-00-00 00:00:00'),
('2111', 'Suppliers(الموردين)', 'Accounts payable(الحسابات الدائنة)', '211', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-17 09:47:03', '', '0000-00-00 00:00:00'),
('21111', 'SWITCH', 'Suppliers(الموردين)', '2111', 4, 1, 1, 0, 'L', 0, 0, NULL, '2NGBRB5X82Y6STCAKLWY', NULL, NULL, NULL, '0.00', 'super admin', '2021-11-02 07:37:24', '', '0000-00-00 00:00:00'),
('21112', 'MARVO', 'Suppliers(الموردين)', '2111', 4, 1, 1, 0, 'L', 0, 0, NULL, 'ISLIQU7SRAICT2TOAPCE', NULL, NULL, NULL, '0.00', 'super admin', '2021-11-02 08:18:59', '', '0000-00-00 00:00:00'),
('21113', 'Alvaro Martinez', 'Suppliers(الموردين)', '2111', 4, 1, 1, 0, 'L', 0, 0, NULL, 'M2DCBKNRXUSYMLYLUTRP', NULL, NULL, NULL, '0.00', 'super admin', '2021-11-17 12:21:54', '', '0000-00-00 00:00:00'),
('2112', 'Accrued Expenses(المصروفات المستحقة)', 'Accounts payable(الحسابات الدائنة)', '211', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:08:51', '', '0000-00-00 00:00:00'),
('21121', 'Accured Wages(أجور مستحقة)', 'Accrued Expenses(المصروفات المستحقة)', '2112', 4, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:09:15', '', '0000-00-00 00:00:00'),
('21122', 'Accured Rents(الإيجارات المستحقة)', 'Accrued Expenses(المصروفات المستحقة)', '2112', 4, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:09:17', '', '0000-00-00 00:00:00'),
('21123', 'Commissions due to employees(عمولات الموظفين المستحقة)', 'Accrued Expenses(المصروفات المستحقة)', '2112', 4, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:09:20', '', '0000-00-00 00:00:00'),
('2113', 'bank loans(القروض البنكية)', 'Accounts payable(الحسابات الدائنة)', '211', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:08:53', '', '0000-00-00 00:00:00'),
('21131', 'Al Rajhi Bank short term loan(قرض مصرف الراجحي قصير الآجل)', 'bank loans(القروض البنكية)', '2113', 4, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:09:26', '', '0000-00-00 00:00:00'),
('2114', 'Value added tax on sales(ضريبة القيمة المضافة على المبيعات)', 'Accounts payable(الحسابات الدائنة)', '211', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:08:56', '', '0000-00-00 00:00:00'),
('2115', 'Current Inventory(خصوم المخزون)', 'Accounts payable(الحسابات الدائنة)', '211', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:08:59', '', '0000-00-00 00:00:00'),
('21151', 'Inventory received unbilled(المخزون المستلم غير المفوتر)', 'Current Inventory(خصوم المخزون)', '2115', 4, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:09:36', '', '0000-00-00 00:00:00'),
('22', 'Non-current liabilities(الخصوم الغير متداولة)', 'Liabilities(الخصوم)', '2', 1, 1, 0, 0, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('221', 'long term loans(القروض طويلة الأجل)', 'Non-current liabilities(الخصوم الغير متداولة)', '22', 2, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:09:55', '', '0000-00-00 00:00:00'),
('2211', 'Al Rajhi Bank loan(قرض مصرف الراجحي)', 'long term loans(القروض طويلة الأجل)', '221', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:07', '', '0000-00-00 00:00:00'),
('222', 'Long-term Allowances (المخصصات طويلة الأجل)', 'Non-current liabilities(الخصوم الغير متداولة)', '22', 2, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:34:02', '', '0000-00-00 00:00:00'),
('2221', 'Provision for end of severance pay(مخصص مكافأة نهاية الخدمة)', 'Long-term Allowances (المخصصات طويلة الأجل)', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:16', '', '0000-00-00 00:00:00'),
('2222', 'Fixed Asset Depreciation Complex(مجمع إهلاك الأصول الثابتة)', 'Long-term Allowances (المخصصات طويلة الأجل)', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:19', '', '0000-00-00 00:00:00'),
('2223', 'Building depreciation complex(مجمع إهلاك المباني)', 'Long-term Allowances (المخصصات طويلة الأجل)', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:23', '', '0000-00-00 00:00:00'),
('2224', 'Cars depreciation complex(مجمع إهلاك السيارات)', 'Long-term Allowances (المخصصات طويلة الأجل)', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:25', '', '0000-00-00 00:00:00'),
('2225', 'Equipment and machinery depreciation complex(مجمع إهلاك المعدات والآلات)', 'Long-term Allowances (المخصصات طويلة الأجل)', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:29', '', '0000-00-00 00:00:00'),
('2226', 'Electronic and computer depreciation complex(مجمع إهلاك الأجهزة الألكترونية والحاسب)', 'Long-term Allowances (المخصصات طويلة الأجل)', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:33', '', '0000-00-00 00:00:00'),
('2227', 'Electrical appliances depreciation complex(مجمع إهلاك الأجهزة الكهربائية)', 'Long-term Allowances (المخصصات طويلة الأجل)', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:35', '', '0000-00-00 00:00:00'),
('2228', 'Furniture and furnishings depreciation complex(مجمع إهلاك الآثاث والمفروشات)', 'Long-term Allowances (المخصصات طويلة الأجل)', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:40', '', '0000-00-00 00:00:00'),
('2229', 'Complex depreciation improvements and decoration(مجمع إهلاك التحسينات والديكور)', 'Long-term Allowances (المخصصات طويلة الأجل)', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:42', '', '0000-00-00 00:00:00'),
('3', 'Owners\' Equity And Capital(حقوق الملكية ورأس المال)', 'COA', '0', 0, 1, 0, 0, 'O', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('31', 'Capital(رأس المال)', 'Owners\' Equity And Capital(حقوق الملكية ورأس المال', '3', 1, 1, 0, 0, 'O', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('32', 'Profits and losses of previous years(الأرباح أو الخسائر المرحلة)', 'Owners\' Equity And Capital(حقوق الملكية ورأس المال', '3', 1, 1, 0, 0, 'O', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('33', 'Owner`s Current(جاري صاحب المؤسسة)', 'Owners\' Equity And Capital(حقوق الملكية ورأس المال', '3', 1, 1, 0, 0, 'O', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4', 'Expenses(المصروفات)', 'COA', '0', 0, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('41', 'Direct Expenses(المصروفات المباشرة)', 'Expenses(المصروفات)', '4', 1, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('411', 'Net Cost Of Goods Sold(صافي تكلفة البضاعة المباعة)', 'Direct Expenses(المصروفات المباشرة)', '41', 2, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:34:17', '', '0000-00-00 00:00:00'),
('4111', 'Cost of goods sold(تكلفة البضاعة المباعة)', 'Net Cost Of Goods Sold(صافي تكلفة البضاعة المباعة)', '411', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:01:57', '', '0000-00-00 00:00:00'),
('4112', 'Adjustment of inventory with deficit or excess(تسوية المخزون بالعجز أو الزيادة)', 'Net Cost Of Goods Sold(صافي تكلفة البضاعة المباعة)', '411', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:02:00', '', '0000-00-00 00:00:00'),
('4113', 'Damaged items(الأصناف التالفة)', 'Net Cost Of Goods Sold(صافي تكلفة البضاعة المباعة)', '411', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:02:03', '', '0000-00-00 00:00:00'),
('4114', 'Allowed discount(الخصم المسموح به)', 'Net Cost Of Goods Sold(صافي تكلفة البضاعة المباعة)', '411', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:02:06', '', '0000-00-00 00:00:00'),
('4115', 'Expenses included in the price evaluation(مصروفات متضمنة في تقييم السعر)', 'Net Cost Of Goods Sold(صافي تكلفة البضاعة المباعة)', '411', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:02:09', '', '0000-00-00 00:00:00'),
('42', 'Indirect Expenses(المصروفات الغير مباشرة)', 'Expenses(المصروفات)', '4', 1, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('421', 'General and administrative expenses(المصروفات العمومية والإدارية)', 'Indirect Expenses(المصروفات الغير مباشرة)', '42', 2, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:34:37', '', '0000-00-00 00:00:00'),
('4211', 'Payroll(الأجور)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42111', 'Basic Salary(الراتب الأساسي)', 'Payroll(الأجور)', '4211', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42112', 'Overtime(أجر إضافي)', 'Payroll(الأجور)', '4211', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42113', 'Housing Allowance(بدل سكن)', 'Payroll(الأجور)', '4211', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42114', 'Transportation Allowance(بدل مواصلات )', 'Payroll(الأجور)', '4211', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42115', 'Other Allowances(بدلات أخري)', 'Payroll(الأجور)', '4211', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4212', 'Government expenses for employees(الأعباء والمصروفات الحكومية للموظفين)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42121', 'Iqama renewal fees for employees(رسوم تجديد الإقامات للموظفين)', 'Government expenses for employees(الأعباء والمصروف', '4212', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42122', 'Work card renewal fees for employees(رسوم تجديد كرت العمل للموظفين)', 'Government expenses for employees(الأعباء والمصروف', '4212', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42123', 'Employee sponsorship transfer fee(رسوم نقل كفالة الموظفين)', 'Government expenses for employees(الأعباء والمصروف', '4212', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42124', 'Labor recruitment visa fees(رسوم تأشيرات إستقدام عمالة)', 'Government expenses for employees(الأعباء والمصروف', '4212', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4213', 'Annual allowances(البدلات السنوية)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42131', 'Annual leave allowance(بدل الأجازة السنوية)', 'Annual allowances(البدلات السنوية)', '4213', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42132', 'Annual travel ticket allowance(بدل تذاكر السفر السنوي)', 'Annual allowances(البدلات السنوية)', '4213', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42133', 'End of work allowance(بدل نهاية الخدمة)', 'Annual allowances(البدلات السنوية)', '4213', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4214', 'Rentals(الإيجارات)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42141', 'Rent branchs(إيجار المكاتب )', 'Rentals(الإيجارات)', '4214', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42142', 'warehouse rent(إيجار مستودع)', 'Rentals(الإيجارات)', '4214', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42143', 'Showroom rental(إيجار المعارض )', 'Rentals(الإيجارات)', '4214', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42144', 'house rent(إيجار سكن )', 'Rentals(الإيجارات)', '4214', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4215', 'Expenses of public utilities and services(مصروفات المرافق العامة والخدمات)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42151', 'Electricity expenses(مصروفات الكهرباء)', 'Expenses of public utilities and services(مصروفات ', '4215', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42152', 'water expenses(مصروفات المياه)', 'Expenses of public utilities and services(مصروفات ', '4215', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42153', 'Telephone and Internet expenses(مصروفات الهاتف والإنترنت)', 'Expenses of public utilities and services(مصروفات ', '4215', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4216', 'insurance expenses(مصروفات التأمين)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42161', 'Medical insurance expenses for employees(مصروفات التأمين الطبي للموظفين)', 'insurance expenses(مصروفات التأمين)', '4216', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42162', 'Car insurance expenses(مصروفات تأمين السيارات)', 'insurance expenses(مصروفات التأمين)', '4216', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4217', 'Government Expenses(المصروفات الحكومية)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42171', 'Government Endorsements(تصديقات حكومية)', 'Government Expenses(المصروفات الحكومية)', '4217', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42172', 'Social Security(التأمينات الإجتماعية)', 'Government Expenses(المصروفات الحكومية)', '4217', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42173', 'Traffic violations(مخالفات مرورية)', 'Government Expenses(المصروفات الحكومية)', '4217', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4218', 'Prints and stationery(مطبوعات وأدوات مكتبية)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42181', 'stationary(أدوات مكتبية)', 'Prints and stationery(مطبوعات وأدوات مكتبية)', '4218', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42182', 'Publications(مطبوعات)', 'Prints and stationery(مطبوعات وأدوات مكتبية)', '4218', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4219', 'General maintenance and repair expenses(مصروفات صيانة عامة و إصلاح)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42191', 'Building maintenance expenses(مصروفات صيانة المباني)', 'General maintenance and repair expenses(مصروفات صي', '4219', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42192', 'Car maintenance expenses(مصروفات صيانة السيارات)', 'General maintenance and repair expenses(مصروفات صي', '4219', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42193', 'Petrol and fuel expenses for cars(مصروفات بنزين ومحروقات للسيارات)', 'General maintenance and repair expenses(مصروفات صي', '4219', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42194', 'Shipping and transportation expenses(مصروفات شحن وانتقالات)', 'General maintenance and repair expenses(مصروفات صي', '4219', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4220', 'Hospitality and cleaning expenses(مصروفات ضيافة ونظافة)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42201', 'Hospitality and buffet expenses(مصروفات ضيافة وبوفيه)', 'Hospitality and cleaning expenses(مصروفات ضيافة ون', '4220', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42202', 'Branch cleaning expenses(مصروفات نظافة الفروع)', 'Hospitality and cleaning expenses(مصروفات ضيافة ون', '4220', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4221', 'Commissions and bank expenses(العمولات والمصروفات البنكية)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42211', 'Bank fees and expenses(عمولات ومصروفات بنكية)', 'Commissions and bank expenses(العمولات والمصروفات ', '4220', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4222', 'Key-money for Exhibition(مصروفات تقبيل المعارض)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42221', 'Key-money for Exhibition(مصروفات تقبيل المعارض)', 'Key-money for Exhibition(مصروفات تقبيل المعارض)', '4222', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4223', 'Depreciation expense(مصروفات الإهلاك)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42231', 'Building depreciation expense(  مصروف إهلاك المباني)', 'Depreciation expense(مصروفات الإهلاك)', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42232', 'Car depreciation expense( مصروف إهلاك السيارات)', 'Depreciation expense(مصروفات الإهلاك)', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42233', 'Equipment and machinery depreciation expense( مصروف إهلاك المعدات والآلات)', 'Depreciation expense(مصروفات الإهلاك)', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42234', 'Depreciation expense for electronic and computer equipment(مصروف إهلاك الأجهزة الإلكترونية والحاسب)', 'Depreciation expense(مصروفات الإهلاك)', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42235', 'Expense for depreciation of electrical appliances(مصروف إهلاك الأجهزة الكهربائية)', 'Depreciation expense(مصروفات الإهلاك)', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42236', 'Furniture and furnishing depreciation expense(مصروف إهلاك الآثاث والمفروشات)', 'Depreciation expense(مصروفات الإهلاك)', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42237', 'Depreciation expense for improvements and decoration(مصروف إهلاك التحسينات والديكور)', 'Depreciation expense(مصروفات الإهلاك)', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42238', 'Depreciation expense of accounting software(مصروف إهلاك البرامج المحاسبية)', 'Depreciation expense(مصروفات الإهلاك)', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4224', 'Zakat expenses and income(مصروفات الزكاة و الدخل)', 'General and administrative expenses(المصروفات العم', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('5', 'Revenues(الإيرادات)', 'COA', '0', 0, 1, 0, 0, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('51', 'Sales revenue(ايرادات المبيعات)', 'Revenues(الإيرادات)', '5', 1, 1, 0, 0, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('511', 'Electricity sales(مبيعات قطاع الكهرباء)', 'Sales revenue(ايرادات المبيعات)', '51', 2, 1, 0, 0, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('5111', 'Showroom sales for Electricity sales(مبيعات المعارض لقطاع الكهرباء )', 'Electricity sales(مبيعات قطاع الكهرباء)', '511', 3, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:02:53', '', '0000-00-00 00:00:00'),
('5112', 'Wholesale sector sales for Electricity sales(مبيعات قطاع الجمله لقطاع الكهرباء   )', 'Electricity sales(مبيعات قطاع الكهرباء)', '511', 3, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:02:56', '', '0000-00-00 00:00:00'),
('5113', 'Service sales and maintenance for Electricity sales(مبيعات الخدمات والصيانة لقطاع الكهرباء   )', 'Electricity sales(مبيعات قطاع الكهرباء)', '511', 3, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:03:00', '', '0000-00-00 00:00:00'),
('512', 'Sales returns(مردودات المبيعات)', 'Sales revenue(ايرادات المبيعات)', '51', 2, 1, 0, 0, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('5121', 'Sales return for Showroom sales (مردودات مبيعات المعارض )', 'Sales returns(مردودات المبيعات)', '512', 3, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:03:05', '', '0000-00-00 00:00:00'),
('5122', 'Sales return Wholesale sector sales for Electricity sales (مرتجع مبيعات قطاع الجمله )', 'Sales returns(مردودات المبيعات)', '512', 3, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:03:09', '', '0000-00-00 00:00:00'),
('5123', 'Sales return Service sales and maintenance for Electricity sales (مرتجع مبيعات الخدمات والصيانة )', 'Sales returns(مردودات المبيعات)', '512', 3, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:03:12', '', '0000-00-00 00:00:00'),
('52', 'Other revenue(الإيرادات الاخري)', 'Revenues(الإيرادات)', '5', 1, 1, 0, 0, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('521', 'Discount Received(خصم مكتسب )', 'Other revenue(الإيرادات الاخري)', '52', 2, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-15 05:42:02', '', '0000-00-00 00:00:00');


INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) VALUES 
('accounting', NULL, 'accounting', '0', '0100', '0', '1', current_timestamp());

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'fiscal_year', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'fiscal_year_ending', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'chart_of_account', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'opening_balance', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'add_stock_opening', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'supplier_payment', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'cash_adjustment', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'debit_voucher', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'credit_voucher', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'contra_voucher', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'journal_voucher', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'voucher_approval', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'receipt_voucher', NULL, 'accounting', sec_menu_item.menu_id, '1111', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'account_reports', NULL, 'accounting', sec_menu_item.menu_id, '0100', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'accounting';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'reports_by_voucher', NULL, 'accounting', sec_menu_item.menu_id, '0100', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'account_reports';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'general_ledger', NULL, 'accounting', sec_menu_item.menu_id, '0100', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'account_reports';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'profit_loss', NULL, 'accounting', sec_menu_item.menu_id, '0100', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'account_reports';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'balance_sheet', NULL, 'accounting', sec_menu_item.menu_id, '0100', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'account_reports';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'trial_balance', NULL, 'accounting', sec_menu_item.menu_id, '0100', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'account_reports';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) 
SELECT 'coa_print', NULL, 'accounting', sec_menu_item.menu_id, '0100', '0', '1', current_timestamp() FROM sec_menu_item WHERE sec_menu_item.menu_title = 'account_reports';