<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cwarrantee extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array(
            'dashboard/warrantee_model',
            'dashboard/Suppliers',
            'dashboard/Purchases',
            'dashboard/Stores',
            'dashboard/Variants',
            'dashboard/Soft_settings',
            'template/Template_model',
        ));
        $this->load->library('dashboard/occational');

    }
    public function index()
    {
        $this->permission->check_label('Warrantee')->read()->redirect();
        $all_supplier =$this->Purchases->select_all_supplier();
        $store_list   =$this->Stores->store_list();
        $get_def_store=$this->Stores->get_def_store();
        $variant_list =$this->Variants->variant_list();
        $data = array(
            'title'       =>display('warrantee'),
            'all_supplier'=>$all_supplier,
            'store_list'  =>$store_list,
            'def_store'   =>$get_def_store,
            'variant_list'=>$variant_list,
        );
        $data['setting']=$this->Template_model->setting();
        $data['module'] ="dashboard";
        $data['page']   ='warrantee/index';
        $this->parser->parse('template/layout', $data);
    }
    public function get_invoice_warrantee_detail()
    {
        $invoice_no                    =$this->input->post('invoice_no',true);
        $warrantee_details             =$this->warrantee_model->invoice_wise_warrantee($invoice_no);
        $invoice_wise_warantee_products=[];
        $invoice_wise_product=[];
        if ($warrantee_details) {
            foreach ($warrantee_details as $warrantee_product){
                $invoice_wise_product  = $warrantee_product;
                $product_wise_warrantee=$this->warrantee_model->product_wise_warrantee($warrantee_product['product_id']);
                $invoice_wise_product['warrantee_status']=($product_wise_warrantee->warrantee)?'Has Warrantee':'N/A';
                $invoice_wise_product['product_name']    =$product_wise_warrantee->product_name;
                if(!empty($product_wise_warrantee->warrantee)){
                    $purchase_date = strtotime($invoice_wise_product['created_at']);
                    $newDate = date('Y-m-d',$purchase_date);
                    $warrantee_expiry = strtotime(date("Y-m-d",strtotime($newDate))."+".$product_wise_warrantee->warrantee." month");
                    $invoice_wise_product['warrantee_expiry']  =date('Y-m-d',$warrantee_expiry);
                    $invoice_wise_product['warrantee_duration']=$product_wise_warrantee->warrantee;
                }else{
                    $invoice_wise_product['warrantee_expiry']  ="N/A";
                    $invoice_wise_product['warrantee_duration']="N/A";
                }
                array_push($invoice_wise_warantee_products, $invoice_wise_product);
            }
            $warrantee_html = '';
            foreach ($invoice_wise_warantee_products as $warantee_product){
                $single_html = "<tr>
                                    <td>
                                        ".substr_replace($warantee_product['product_name'], '...', 25)."
                                    </td>
                                    <td class='text-center'>
                                        ".$warantee_product['quantity']."
                                    </td>
                                    <td class='text-center'>
                                        ".$warantee_product['date']."
                                    </td>
                                    <td class='text-center'>
                                        ".$warantee_product['warrantee_duration']."
                                    </td>
                                    <td class='text-center'>
                                        ".$warantee_product['warrantee_expiry']."
                                    </td>
                                    <td class='text-center'>
                                        ".$warantee_product['warrantee_status']."
                                    </td>
                                </tr>";
                $warrantee_html = $warrantee_html.$single_html;
            }
            echo $warrantee_html;
        }else{
            return false;
        }
    }
}