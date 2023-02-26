<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Stichoza\GoogleTranslate\GoogleTranslate;

class Language extends MX_Controller
{

    private $table  = "language";
    private $phrase = "phrase";

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->load->dbforge();
        $this->load->helper('language');
        $this->auth->check_user_auth();

    }

    public function index()
    {
        $this->permission->check_label('language')->read()->redirect();

        $data = array(
            'title' => 'Language List', 
            'languages' => $this->languages()
            );
     
        $content = $this->parser->parse('dashboard/language/main',$data,true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function phrase()
    {
        $this->permission->check_label('language')->read()->redirect();

        $data['title']    = 'Phrase List';
        $data['languages']    = $this->languages();
        $data['phrases']      = $this->phrases();

        $content = $this->parser->parse('dashboard/language/phrase',$data,true);
        $this->template_lib->full_admin_html_view($content);
    }
 

    public function languages()
    {
        $this->permission->check_label('language')->read()->redirect();

        if ($this->db->table_exists($this->table)) {

            $fields = $this->db->field_data($this->table);

            $i = 1;
            foreach ($fields as $field) {
                if ($i++ > 2)
                    $result[$field->name] = ucfirst($field->name);
            }

            if (!empty($result)) return $result;

        } else {
            return false;
        }
    }

    // Language configuration
    private function set_language_config($language, $direction = 'ltr')
    {
        $config = $this->db->select('id')->from('language_config')->where('language', $language)->get()->num_rows();
        if($config){
            $lang_config = array(
                'direction' => $direction
            );
            $this->db->update('language_config', $lang_config, array('language' => $language));
        }else{
            $lang_config = array(
                'language' => $language,
                'direction' => $direction
            );
            $this->db->insert('language_config', $lang_config);
        }
    }


    public function addLanguage()
    {
       
        $this->permission->check_label('language')->create()->redirect();

        $language = preg_replace('/[^a-zA-Z0-9_]/', '', $this->input->post('language', true));
        $language = strtolower($language);
        $direction = $this->input->post('direction', TRUE);
        $lang_prefix = $this->input->post('lang_prefix', TRUE);
        if (!empty($language)) {
            if (!$this->db->field_exists($language, $this->table)) {
                $this->dbforge->add_column($this->table, [
                    $language => [
                        'type' => 'TEXT'
                    ]
                ]);
            $this->set_language_config($language, $direction);
          

        $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

        $phrases=$this->db->select('id,phrase')->from('language')->get()->result();
 
        foreach($phrases as $phrase){
        $ph=str_replace("_"," ",$phrase->phrase);
        $value=$tr->setSource('en')->setTarget($lang_prefix)->translate($ph);
        $this->db->where('id', $phrase->id)->update('language', [$language=>$value]);
                }
        
        $this->session->set_flashdata('message', 'Language added successfully');
        redirect('dashboard/language');
            }
        } else {
            $this->session->set_flashdata('exception', 'Please try again');
        }
        redirect('dashboard/language');
    }

    public function editPhrase($language = null)
    {
        $this->permission->check_label('language')->update()->redirect();

        $data['title']   ='Phrase Edit';
        $data['language']=$language;
        $data['phrases'] =$this->phrases();

        $content = $this->parser->parse('dashboard/language/phrase_edit',$data,true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function languagePhaseUpdate()
    {
        $this->permission->check_label('language')->update()->redirect();
        $id = $this->input->post('id',TRUE);
        $value = $this->input->post('phase_value',TRUE);
        $language = $this->input->post('language',TRUE);
        $data = array($language => $value);
        $ss = $this->db->where('id', $id)->update('language', $data);

        $this->create_jsonFile(); //put language data to language.json file.
        echo $value;
    }


    public function addPhrase()
    {
        $this->permission->check_label('language')->create()->redirect();

        $lang = $this->input->post('phrase',TRUE);
        

        if (sizeof($lang) > 0) {

            if ($this->db->table_exists($this->table)) {

                if ($this->db->field_exists($this->phrase, $this->table)) {

                    foreach ($lang as $value) {

                        $value = preg_replace('/[^a-zA-Z0-9_]/', '', $value);
                        $value = strtolower($value);

                        if (!empty($value)) {
                            $num_rows = $this->db->get_where($this->table, [$this->phrase => $value])->num_rows();

                            if ($num_rows == 0) {
                                $this->db->insert($this->table, [$this->phrase => $value]);
                                $this->create_jsonFile(); //put language data to language.json file.
                                $this->session->set_flashdata('message', 'Phrase added successfully');
                            } else {
                                $this->session->set_flashdata('exception', 'Phrase already exists!');
                            }
                        }
                    }

                    redirect('dashboard/language/phrase');
                }

            }
        }

        $this->session->set_flashdata('exception', 'Please try again');
        redirect('dashboard/language/phrase');
    }

    public function phrases()
    {
        $this->permission->check_label('language')->read()->redirect();

        if ($this->db->table_exists($this->table)) {

            if ($this->db->field_exists($this->phrase, $this->table)) {

                return $this->db->order_by($this->phrase, 'asc')
                    ->get($this->table)
                    ->result();

            }

        }

        return false;
    }

    public function addLebel()
    {
        $language = $this->input->post('language', true);
        $phrase = $this->input->post('phrase', true);
        $lang = $this->input->post('lang', true);

        if (!empty($language)) {

            if ($this->db->table_exists($this->table)) {

                if ($this->db->field_exists($language, $this->table)) {

                    if (sizeof($phrase) > 0)
                        for ($i = 0; $i < sizeof($phrase); $i++) {
                            $this->db->where($this->phrase, $phrase[$i])
                                ->set($language, $lang[$i])
                                ->update($this->table);

                        }
                    $this->session->set_flashdata('message', 'Label added successfully!');
                    redirect($_SERVER['HTTP_REFERER']);

                }

            }
        }

        $this->session->set_flashdata('exception', 'Please try again');
        redirect('dashboard/language/editPhrase/' . $language);
    }


    public function deletePhrase($language = null)
    {
        $this->permission->check_label('language')->delete()->redirect();

        $this->dbforge->drop_column('language', $language);
        $this->db->delete('language_config', array('language' => $language));
        $this->session->set_flashdata('message', 'Language Deleted successfully');
        redirect('dashboard/Language');
    }


    private function create_jsonFile()
    {
        $this->db->select('*');
        $this->db->from('language');
        $query = $this->db->get();
        $result = $query->result();
        $cache_file = './assets/js/language.json';
        $newarray = [];
        foreach ($result as $key => $value) {
            $newarray = array_merge($newarray, array($value->phrase => $value));
        }

        $languageList = json_encode($newarray);

        file_put_contents($cache_file, $languageList);
    }


    public function language_excel_import()
    {
        $this->load->library('excel');
        
        if (isset($_FILES["upload_excel_file"]["name"])) {
            $_FILES["upload_excel_file"]["name"];
            $path = $_FILES["upload_excel_file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);

            $allitems = [];
            foreach ($object->getWorksheetIterator() as $sale) {
                $highestRow = $sale->getHighestRowAndColumn();
                $maxCell = $sale->getHighestRowAndColumn();
                $data1 = $sale->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);
                if (count($data1) <= 1) {
                    $this->session->set_userdata(array('error_message' => 'Empty Filed Not Allow!'));
                    redirect(base_url('dashboard/language/language_excel_import'));
                    exit;
                }
                $highestColumn = $sale->getHighestColumn();
                for ($i = 2; $i <= count($data1); $i++) {
                    $id         =$sale->getCellByColumnAndRow(0, $i)->getValue();
                    $phrase         =$sale->getCellByColumnAndRow(1, $i)->getValue();
                    $english        =$sale->getCellByColumnAndRow(2, $i)->getValue();
                    $arabic               =$sale->getCellByColumnAndRow(3, $i)->getValue();


                    $allitems[] = array(
                        'id'       => $id,
                        'phrase'   => $phrase,
                        'english'  => $english,
                        'arabic'   => $arabic
                    );
                }
            }

            if(!empty($allitems)){
                $this->db->insert_batch('language', $allitems);
            }
        }
        
        $data = array(
            'title' => 'Language import'
        );
        $content = $this->parser->parse('dashboard/language/import_excel',$data,true);
        $this->template_lib->full_admin_html_view($content);

    }


}



 