<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FCPATH."vendor/autoload.php");
use League\Csv\CannotInsertRecord;
use League\Csv\Writer;
class Export_csv{

	public $CI;
    function __construct() {
    	$this->CI =& get_instance();
    }
   	public function index($order_date)
   	{

		$filename = './my-assets/csvfiles/orders.csv';

		$writer = Writer::createFromPath($filename, 'w+');
		$writer->insertOne(['Date', 'Branch', 'TransactionCurrency','ExchangeRate','PartyAccountCode','PartyAccount','VATCSTTransactionType','Remarks','ProductCode','Product','UOM','Quantity','UnitRate','GrossAmount','DiscountBasis1','Discount1','TaxStructure','VATCSTProductCategory','VATCSTCommodityCode','Comments']);

		$today_invoices = $this->get_today_invoices($order_date);

		if(!empty($today_invoices)){
			$records = [];
			foreach ($today_invoices as $item) {

				$datearr = explode('-', $item->date);
				$date_slice = [];
				foreach ($datearr as $dval) {
					$date_slice[] = intval($dval);
				}
				$date = implode('/', $date_slice);


				$records[] = [
					$item->date,
					'RIYADH',
					'SAR',
					'1',
					$item->HeadCode,
					$item->HeadName,
					'15%',
					'',
					$item->product_id,
					$item->product_name,
					$item->unit,
					$item->quantity,
					$item->rate,
					$item->total_price,
					'number',
					$item->discount,
					'SAUDI VAT',
					'Inputs 15% GCC VAT',
					'15%',
					$item->invoice_details
				];
			}

			$result = $writer->insertAll($records); //using an array
			// $result = $writer->insertAll(new ArrayIterator($records)); //using a Traversable object

		}
		$this->CI->load->helper('download');
		force_download($filename, NULL);
		return TRUE;
   	}

   	private function get_today_invoices($order_date)
   	{
   		$ci =& get_instance();

   		$today = date('m-d-Y');
   		$ci->db->select('a.*,b.HeadName,b.HeadCode, c.product_id, c.quantity, c.rate, total_price, c.discount, d.product_name,d.unit');
   		$ci->db->from('invoice a');
   		$ci->db->join('acc_coa b','b.customer_id=a.customer_id','left');
   		$ci->db->join('invoice_details c','c.invoice_id=a.invoice_id','left');
   		$ci->db->join('product_information d','d.product_id=c.product_id','left');
   		$ci->db->where('a.date',$order_date);
   		$ci->db->group_by('a.invoice_id,c.invoice_details_id');
   		$result = $ci->db->get()->result();
   		return $result;
   	}
 }
