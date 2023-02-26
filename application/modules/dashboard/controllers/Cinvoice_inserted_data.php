<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cinvoice_inserted_data extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('dashboard/Invoices'));
        $this->load->library('dashboard/linvoice');
        $this->load->library('dashboard/occational');
    }
    public function invoice_inserted_data_pdf($invoice_id)
    {

        $this->load->model('dashboard/Invoices');
        $this->load->model('dashboard/Soft_settings');
        $this->load->library('dashboard/occational');
        $this->load->model('dashboard/Shipping_methods');
        $invoice_detail = $this->Invoices->retrieve_invoice_html_data($invoice_id);
        $order_no=$this->db->select('b.order as order_no')->from('invoice a')->where('a.order_id',$invoice_detail[0]['order_id'])->join('order b','a.order_id = b.order_id','left')->get()->result();
        $quotation_no = $this->db->select('q.quotation as quotation_no')->from('invoice a')->where('a.quotation_id',$invoice_detail[0]['quotation_id'])->join('quotation q','q.quotation_id = a.quotation_id','left')->get()->result();
        $cardpayments=$this->Invoices->get_invoice_card_payments($invoice_id);
        $shipping_method  =$this->Shipping_methods->shipping_method_search_item($invoice_detail[0]['shipping_method']);
        $subTotal_quantity=0;
        $subTotal_cartoon =0;
        $subTotal_discount=0;

        if(!empty($invoice_detail)){
            foreach($invoice_detail as $k=>$v){
                $invoice_detail[$k]['final_date']=$this->occational->dateConvert($invoice_detail[$k]['date']);
                $subTotal_quantity=$subTotal_quantity+$invoice_detail[$k]['quantity'];
            }
            $i=0;
            foreach($invoice_detail as $k=>$v){
                $i++;
                $invoice_detail[$k]['sl']=$i;
            }
        }

        $currency_details=$this->Soft_settings->retrieve_currency_info();
        $company_info    =$this->Invoices->retrieve_company();
        $created_at=explode(' ', $invoice_detail[0]['created_at']);
        $invoice_time=$created_at[1];
        $data=array(
            'title'            =>display('invoice_details'),
            'invoice_id'       =>$invoice_detail[0]['invoice_id'],
            'invoice_no'       =>$invoice_detail[0]['invoice'],
            'customer_name'    =>$invoice_detail[0]['customer_name'],
            'customer_mobile'  =>$invoice_detail[0]['customer_mobile'],
            'customer_email'   =>$invoice_detail[0]['customer_email'],
            'store_id'         =>$invoice_detail[0]['store_id'],
            'vat_no'           =>$invoice_detail[0]['vat_no'],
            'cr_no'            =>$invoice_detail[0]['cr_no'],
            'customer_address' =>$invoice_detail[0]['customer_address_1'],
            'final_date'       =>$invoice_detail[0]['final_date'],
            'invoice_time'     =>$invoice_time,
            'total_amount'     =>$invoice_detail[0]['total_amount'],
            'total_discount'   =>$invoice_detail[0]['total_discount'],
            'invoice_discount' =>$invoice_detail[0]['invoice_discount'],
            'service_charge'   =>$invoice_detail[0]['service_charge'],
            'shipping_charge'  =>$invoice_detail[0]['shipping_charge'],
            'shipping_method'  =>@$shipping_method[0]['method_name'],
            'paid_amount'      =>$invoice_detail[0]['paid_amount'],
            'due_amount'       =>$invoice_detail[0]['due_amount'],
            'invoice_details'  =>$invoice_detail[0]['invoice_details'],
            'subTotal_quantity'=>$subTotal_quantity,
            'invoice_all_data' =>$invoice_detail,
            'order_no'         =>$order_no,
            'quotation_no'     =>$quotation_no,
            'company_info'     =>$company_info,
            'currency'         =>$currency_details[0]['currency_icon'],
            'position'         =>$currency_details[0]['currency_position'],
            'ship_customer_short_address'=>$invoice_detail[0]['ship_customer_short_address'],
            'ship_customer_name'  =>$invoice_detail[0]['ship_customer_name'],
            'ship_customer_mobile'=>$invoice_detail[0]['ship_customer_mobile'],
            'ship_customer_email' =>$invoice_detail[0]['ship_customer_email'],
            'cardpayments'        =>$cardpayments,
            );
        $data['Soft_settings'] = $this->Soft_settings->retrieve_setting_editdata();
        $chapterList = $this->parser->parse('dashboard/invoice/invoice_html_pdf',$data,true);

        $this->load->library('pdfgenerator');
        $file_path = $this->pdfgenerator->generate($chapterList,'Gameleven-invoice-'.$invoice_detail[0]['invoice']);
    }


    
  
}