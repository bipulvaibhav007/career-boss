<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use Mpdf\Mpdf; 

use App\Controllers\MpdfController;
class InsManageControllers extends BaseController
{
    public $session;
    public $title;
    public $commonmodel;
    public $insmanagemodel;
    // public $membermodel;

    // public $studentsFranchiseTbl;
    // public $gradeTbl;
    // public $moduleTbl;
    // public $certlogTbl;
    public $randomcodeTbl;
    public $coursefranchiseTbl;
    public function __construct()
    {
        date_default_timezone_set('Asia/Kolkata');

        $this->commonmodel = model('App\Models\Common_model', false);
        $this->insmanagemodel = model('App\Models\InsManage_model', false);
        // $this->membermodel = model('App\Models\Member_model', false);

        // $this->studentsFranchiseTbl = 'tbl_students_franchise';
        // $this->gradeTbl = 'tbl_grade';
        // $this->moduleTbl = 'tbl_module';
        // $this->certlogTbl = 'tbl_cert_log';
        $this->randomcodeTbl = 'tbl_random_code';
        $this->coursefranchiseTbl = 'tbl_course_franchise';
        $this->title = 'Admin | Institute Management';
        
        // $this->mpdf = new Mpdf();
    }
    public function index(){
        echo 'Test';

    }
    public function batch(){
        $data['title'] = $this->title;
        $data['batches'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_insbatch','',['batch_id','DESC']);
        return view("admin/ins_adm_manage/batch_index",$data);
    }
    public function batch_cu($id=''){
        
		if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'batch_name'=>'required',
                'duration'=>'required',
                'date_from'=>'required',
                /*'cms_banner'=>[
                    //'rules'=>'uploaded[image]|max_size[image,50]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                    'rules'=>'max_size[cms_banner,524288000]|ext_in[cms_banner,png,jpg,jpeg,bmp,gif]',
                    'errors'=>[
                    //'uploaded'=>'Image is required.',
                    'max_size'=>'Image must not have size more than 500 MB in length.',
                    'ext_in'=>'File must have extension with png, gif, jpg, jpeg, bmp.',
                    ]
                ],*/
                'date_to'=>'required',
                'time_from'=>'required',
                'time_to'=>'required',
                'stu_limit'=>'required|numeric',
                'status'=>'required'
            ]);
            if(!$validation){
                $data['validation'] = $this->validator;
                //return view('admin/cms/add_edit_cms', $this->data);
            }else{
                //$id = $this->request->getPost('id');
                /*if($_FILES['cms_banner']['name'] != ''){
                    if($img = $this->request->getFile('cms_banner')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'ban_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                            
                            $data['cms_banner'] = $newName;
                        }
                    }
                }*/
                $post['batch_name']	    = strtoupper(trim($this->request->getVar('batch_name')));
				$post['duration']	    = $this->request->getVar('duration');
				$post['date_from']	    = date('Y-m-d',strtotime($this->request->getVar('date_from')));
				$post['date_to']		= date('Y-m-d',strtotime($this->request->getVar('date_to')));
				$post['time_from']     	= $this->request->getVar('time_from');
				$post['time_to']     	= $this->request->getVar('time_to');
				$post['stu_limit']     	= $this->request->getVar('stu_limit');
				$post['status']         = $this->request->getVar('status');
                if(!$id){
                    $post['added_at'] = date('Y-m-d');
                    $inserted = $this->commonmodel->insertRecord('tbl_insbatch', $post);
                    if($inserted){
						$curl_config = [
							'url' => ERP_BASE_API.'batch_cu',
							'method' => 'POST',
							'data' => $post
						];
						$this->curl_executer($curl_config);
                        session()->setFlashdata(['message'=>'Batch added successfuly','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }else{
                    $post['update_at'] = date('Y-m-d');
                    $updated = $this->commonmodel->updateRecord('tbl_insbatch', $post, ['batch_id'=>$id]);
                    if($updated){
						$curl_config = [
							'url' => ERP_BASE_API.'batch_cu/'.$id,
							'method' => 'POST',
							'data' => $post
						];
						$this->curl_executer($curl_config);
                        session()->setFlashdata(['message'=>'Batch Updated Successfully','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }
                
                return redirect()->to(base_url('/institute/batch'));
            }
            
        }
        $data['title'] = $this->title;
        if($id){
            $data['batch'] = $this->commonmodel->getOneRecord('tbl_insbatch', ['batch_id'=>$id]);
        }
        return view('admin/ins_adm_manage/batch_cu', $data);
    }
    public function delete_batch($id){
        if(!$id){
            return redirect()->to(base_url('institute/batch'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_insbatch',['batch_id'=>$id]);
            if($deleted){
				$curl_config = [
					'url' => ERP_BASE_API.'delete_batch/'.$id,
					'method' => 'DELETE',
					'data' => ''
				];
				$this->curl_executer($curl_config);
                $this->session->setFlashdata(['message'=>'Batch Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Batch Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/institute/batch'));
        }
    }

    /*****************************************Students******************************* */
    public function students()
    {
		$url = base_url('institute/student_listing');
		if(isset($_GET['s']) || isset($_GET['batch']) || isset($_GET['course'])){
			$s = (isset($_GET['s']))?$_GET['s']:'';
			$batch = (isset($_GET['batch']))?$_GET['batch']:'';
			$course = (isset($_GET['course']))?$_GET['course']:'';
			//$project_id = (isset($_GET['project_id']))?$_GET['project_id']:'';
			//$created_by = (isset($_GET['created_by']))?$_GET['created_by']:'';
			//$taskemail = (isset($_GET['taskemail']))?$_GET['taskemail']:'';
            $http_query = http_build_query(array('s'=>$s,'batch'=>$batch,'course'=>$course));
            $url = base_url('institute/student_listing?'.$http_query);
			session()->set('stu_list_url', $url, 300);
		}else if(session()->has('stu_list_url')){
			$url = session('stu_list_url');
		}
		return redirect()->to($url);
    }
	public function student_listing(){
		$data['page_title']="Students Listing";
		$data['count_list'] = $this->insmanagemodel->get_count_student_list();
		$data['coursess'] = $this->commonmodel->getAllRecord('tbl_course_franchise');
		$data['batches'] = $this->commonmodel->getAllRecord('tbl_insbatch');
		$data['student_list'] = $this->insmanagemodel->get_students_list();
        // echo '<pre>'; print_r($data['student_list']); exit;
        return view('admin/ins_adm_manage/students_index', $data);
	}
    public function search_reset(){
		if(session()->has('stu_list_url')){
			session()->remove('stu_list_url');
		}
		return redirect()->to(base_url('institute/students'));
	}
    public function student_cu($id='', $id2='')
    {
        $data = [];
		if($this->request->getMethod() == 'post'){
			if(isset($_POST['form_submit']) && $_POST['form_submit'] == 'basic'){
				// print_r($_POST); exit; 
				$rules = [
                    'stu_name' => 'required',
                    'f_name' => 'required',
                    'm_name' => 'required',
                    'dob' => 'required',
                ];
                $validation = $this->validate($rules);
				if(!$validation){
                    $data['validation'] = $this->validator;
                }else{
					$post = array();
					if($_FILES['stu_image']['name'] != ''){
						if($img = $this->request->getFile('stu_image')){ 
							$imgname = $img->getName();
							if($img->isValid() && !$img->hasMoved()){
								$ext = explode('.',$imgname);
								$ext = end($ext);
								$newName = 'dp_stu'.time().'.'.$ext;
								$img->move('./public/assets/upload/images/',$newName);
								
								$post['stu_image'] = $newName;
							}
						}
                	}
					$post['stu_name']	    	= ucwords(ltrim($_POST['stu_name']));
					$post['f_name']				= ucwords(ltrim($_POST['f_name']));
					$post['m_name']				= ucwords(ltrim($_POST['m_name']));
					$post['dob']		    	= date('Y-m-d',strtotime($_POST['dob']));
					$post['age']		    	= $_POST['age'];
					$post['phone1']		    	= $_POST['phone1'];
					$post['phone2']		    	= $_POST['phone2'];
					//$data['email']		    	= $this->input->post('email');
					$post['co_address']		    = $_POST['co_address'];
					$post['p_address']		    = $_POST['p_address'];
					$qualification = $_POST['qualification'];
					if($qualification == 'other'){
						$qly_data['qualification'] = $_POST['other_qly'];
						$qly_data['status'] = '1';
						$qly_id = $this->commonmodel->insertRecord('tbl_qualification', $qly_data);
						$post['qualification'] = $qly_id;
					}else{
						$post['qualification'] = $_POST['qualification'];
					}
					$post['refrence'] 			= $_POST['refrence'];
					$post['active_tab'] 		= 1;
					$post['status'] 		    = $_POST['status'];
				}

			}
			if(isset($_POST['form_submit']) && $_POST['form_submit'] == 'coursefee'){
				$rules['stu_id'] = ['rules'=>'required','errors'=>['required'=>'You must save personal details & qualifications.']];
				if($_POST['course_type'] == 'R'){
					// echo '<pre>'; print_r($_POST); exit;
					// $rules = [
					// 	'stu_id' => ['rules'=>'required','errors'=>['required'=>'You must save personal details & qualifications.']],
					// 	'batch_id' => 'required',
						
					// 	'status' => 'required',
					// ];
					$rules['batch_id'] = ['rules'=> 'required'];
					$rules['status'] = ['rules'=> 'required'];
					if($_POST['is_change_fee'] == 'yes'){
						$rules['course_id'] = ['rules'=> 'required'];
						$rules['course_fee'] = ['rules'=> 'required'];
						$rules['upfront_payment'] = ['rules'=> 'required'];
						$rules['adm_date'] = ['rules'=> 'required'];
						if(!$id2){
							$rules['receipt_no'] = ['rules'=> 'required|is_unique[tbl_admissions_coursefee.receipt_no]','errors' => ['is_unique'=>'This receipt no already taken']];
						}else{
							$rules['receipt_no'] = ['rules'=> 'required'];
						}
					}
				
					$validation = $this->validate($rules);
					if(!$validation){
						$data['validation'] = $this->validator;
						//return view('admin/users/add_user',$this->data);
					}else{
						$post = [];
						$is_change_fee = 'NO';
						if($_POST['is_change_fee'] == 'yes'){
							if($_POST['course_id'] != $_POST['ini_course_id'] || 
								$_POST['course_fee'] != $_POST['ini_course_fee'] || 
								$_POST['adm_fee'] != $_POST['ini_adm_fee'] || 
								$_POST['upfront_payment'] != $_POST['ini_upfront_payment'] || 
								$_POST['payment_type'] != $_POST['ini_payment_type'] || 
								$_POST['total_installment'] != $_POST['ini_total_installment'] || 
								$_POST['ins_amount'] != $_POST['ini_ins_amount'] ||
								$_POST['fnf_amount'] != $_POST['ini_fnf_amount'] || 
								$_POST['receipt_no'] != $_POST['ini_receipt_no'] ||
								$_POST['adm_date'] != $_POST['ini_adm_date']) {
									$is_change_fee = 'YES';
							}
						}
						//echo '<pre>'; print_r($_POST); echo $is_change_fee; exit;
						$post['active_tab'] 		= 2;

						// $data['batch_id']		    = $this->input->post('batch_id');
						// $data['status']             = $this->input->post('status');
						$courseFeeData = array();
						if($is_change_fee == 'YES'){
							$courseFeeData['course_id'] = $_POST['course_id'];
							$courseFeeData['course_fee'] = $_POST['course_fee'];
							$courseFeeData['adm_fee'] = ($_POST['adm_fee'] != '')?$_POST['adm_fee']:0;
							$courseFeeData['total_fee'] = (int)$courseFeeData['course_fee'] + (int)$courseFeeData['adm_fee'];
							$courseFeeData['paid_amount'] = $_POST['upfront_payment'];
							$courseFeeData['dues_amount'] = (int)$courseFeeData['total_fee'] - (int)$courseFeeData['paid_amount'];
							$courseFeeData['adm_date']	= date('Y-m-d',strtotime($_POST['adm_date']));

							$courseFeeData['paid_date']	= date('Y-m-d',strtotime($_POST['adm_date']));

							$courseFeeData['payment_type'] = $_POST['payment_type'];
							if(isset($_POST['payment_type']) && $_POST['payment_type'] == 'installment'){
								$courseFeeData['paid_inst_no']	= 1;

								$tot_days_this_month = date('t',strtotime($_POST['adm_date']));
								$current_day = date('d',strtotime($_POST['adm_date']));
								if($current_day < 20){
									$balance_day = (int)$tot_days_this_month - (int)$current_day + 1;
								}else{
									$balance_day = (int)$tot_days_this_month + ((int)$tot_days_this_month - (int)$current_day) + 1;
								}
								$next_paid_date = date('Y-m-d', strtotime($_POST['adm_date'].' + '.$balance_day.' days'));
								$courseFeeData['next_paid_date']	= $next_paid_date;

								//$twenty_percent = (int)$_POST['course_fee'] * 20 / 100;
								//$current_payable = $twenty_percent + (int)$courseFeeData['adm_fee'];
								//$payable_amount = ((int)$current_payable - (int)$_POST['upfront_payment']) + (int)$_POST['ins_amount'];
								//$courseFeeData['payable_amount'] = $payable_amount;
								$courseFeeData['payable_amount'] = $_POST['ins_amount'];

								$courseFeeData['total_installment'] = $_POST['total_installment'];
								$courseFeeData['ins_amount'] 	= $_POST['ins_amount'];
							}else{
								$courseFeeData['paid_inst_no']	= 0;
								$courseFeeData['next_paid_date'] = '';
								$courseFeeData['payable_amount'] = 0;
								$courseFeeData['total_installment'] = 0;
								$courseFeeData['ins_amount'] 	= 0 ;
							}
							$courseFeeData['fnf_amount'] = $_POST['fnf_amount'];
							$courseFeeData['receipt_no'] = $_POST['receipt_no'];
						}
						$courseFeeData['course_type'] = $_POST['course_type'];
						$courseFeeData['stu_id'] = $id;
						$courseFeeData['batch_id'] = $_POST['batch_id'];
						$courseFeeData['update_by'] = session('user_id');
						$courseFeeData['status'] = $_POST['status'];

						if($id2){
							$courseFeeData['description'] = 'Course or Fee Update.';
							$courseFeeData['update_at'] = date('Y-m-d H:i:s');
							$cfUpdated = $this->commonmodel->updateRecord('tbl_admissions_coursefee', $courseFeeData, array('id'=>$id2));
							if($cfUpdated){
								$courseFeeData['is_change_fee'] = $is_change_fee;
								$curl_config = [
									'url' => ERP_BASE_API.'admissions_coursefee_cu/'.$id2,
									'method' => 'POST',
									'data' => $courseFeeData
								];
								$this->curl_executer($curl_config);
								unset($courseFeeData['is_change_fee']);
							}
						}else{
							$courseFeeData['description'] = 'Admission';
							$courseFeeData['added_at'] = date('Y-m-d H:i:s');
							$course_fee_id = $this->commonmodel->insertRecord('tbl_admissions_coursefee', $courseFeeData);
							if($course_fee_id){
								$courseFeeData['is_change_fee'] = $is_change_fee;
								$curl_config = [
									'url' => ERP_BASE_API.'admissions_coursefee_cu',
									'method' => 'POST',
									'data' => $courseFeeData
								];
								$this->curl_executer($curl_config);
								unset($courseFeeData['is_change_fee']);
							}
						}
						//insert log & paid installment
						if($is_change_fee == 'YES'){
							unset($courseFeeData['update_at']);
							unset($courseFeeData['course_type']);
							$courseFeeData['course_fee_id'] = (isset($course_fee_id))?$course_fee_id:$id2;
							$courseFeeData['added_at'] = date('Y-m-d H:i:s');
							$log_id = $this->commonmodel->insertRecord('tbl_admissions_log', $courseFeeData);
							if($log_id){
								$curl_config = [
									'url' => ERP_BASE_API.'insert_admissions_log',
									'method' => 'POST',
									'data' => $courseFeeData
								];
								$this->curl_executer($curl_config);
							}

							//insert paid installment
							$paidInstData['course_fee_id'] = (isset($course_fee_id))?$course_fee_id:$id2;
							$paidInstData['paid_amount'] = $_POST['upfront_payment'];
							$paidInstData['paid_date'] = date('Y-m-d',strtotime($_POST['adm_date']));
							$paidInstData['receipt_no'] = $_POST['receipt_no'];
							$paidInstData['description'] = $courseFeeData['description'];
							$paidInstData['added_by'] = session('user_id');
							$paidInstData['added_at'] = date('Y-m-d H:i:s');
							if($id2){
								if($this->commonmodel->updateRecord('tbl_adms_paid_inst', $paidInstData, array('course_fee_id'=>$id2))){
									$curl_config = [
										'url' => ERP_BASE_API.'adms_paid_inst_cu/'.$id2,
										'method' => 'POST',
										'data' => $paidInstData
									];
									$this->curl_executer($curl_config);
								}
							}else{
								if($this->commonmodel->insertRecord('tbl_adms_paid_inst', $paidInstData)){
									$curl_config = [
										'url' => ERP_BASE_API.'adms_paid_inst_cu/',
										'method' => 'POST',
										'data' => $paidInstData
									];
									$this->curl_executer($curl_config);
								}
							}
						}

					}
				} //end regular course
				if($_POST['course_type'] == 'NR'){
					$rules['course_id2'] = ['rules'=> 'required','errors'=>['required'=>'Please select any one course.']];
					$rules['course_fee2'] = ['rules'=> 'required','errors'=>['required'=>'Please provide course fee.']];
					$rules['upfront_payment2'] = ['rules'=> 'required','errors'=>['required'=>'Please provide upfront payment.']];
					$rules['adm_date2'] = ['rules'=> 'required','errors'=>['required'=>'Date is required.']];
					if(!$id2){
						$rules['receipt_no2'] = ['rules'=>'required|is_unique[tbl_admissions_coursefee.receipt_no]','errors' => ['required'=>'Please provide receipt no.','is_unique'=>'This receipt no already taken']];
					}else{
						$rules['receipt_no2'] = ['rules'=> 'required','errors'=>['required'=>'Please provide receipt no.']];
					}
					$rules['status'] = ['rules'=> 'required'];
					$validation = $this->validate($rules);
					if(!$validation){
						$data['validation'] = $this->validator;
					}else{
						// echo '<pre>'; print_r($_POST); exit;
						$post['active_tab'] 		= 2;

						$courseFeeData = array();
						$courseFeeData['course_type'] = $_POST['course_type'];
						$courseFeeData['stu_id'] = $id;
						$courseFeeData['batch_id'] = 0;
						$courseFeeData['course_id'] = $_POST['course_id2'];
						$courseFeeData['course_fee'] = $_POST['course_fee2'];

						$courseFeeData['adm_fee'] = 0;
						$courseFeeData['dis_amount'] = 0;

						$courseFeeData['total_fee'] = $_POST['course_fee2'];
						$courseFeeData['paid_amount'] = $_POST['upfront_payment2'];

						$courseFeeData['dues_amount'] = (int)$courseFeeData['total_fee'] - (int)$courseFeeData['paid_amount'];
						$courseFeeData['adm_date']	= date('Y-m-d',strtotime($_POST['adm_date2']));
						$courseFeeData['paid_date']	= date('Y-m-d',strtotime($_POST['adm_date2']));

						$courseFeeData['paid_inst_no']	= 0;
						$courseFeeData['next_paid_date'] = '';
						$courseFeeData['payable_amount'] = 0;
						$courseFeeData['payment_type'] = 'fnf';
						$courseFeeData['total_installment'] = 0;
						$courseFeeData['ins_amount'] 	= 0 ;
						
						$courseFeeData['fnf_amount'] = $_POST['course_fee2'];
						$courseFeeData['receipt_no'] = $_POST['receipt_no2'];
						$courseFeeData['update_by'] = session('user_id');
						$courseFeeData['is_change_fee'] = 'no';
						$courseFeeData['status'] = $_POST['status'];
						if($id2){
							$courseFeeData['description'] = 'Course or Fee Update.';
							$courseFeeData['update_at'] = date('Y-m-d H:i:s');
							$updated = $this->commonmodel->updateRecord('tbl_admissions_coursefee', $courseFeeData, array('id'=>$id2));
							if($updated){
								$courseFeeData['is_NR'] = true;
								$curl_config = [
									'url' => ERP_BASE_API.'admissions_coursefee_cu/'.$id2,
									'method' => 'POST',
									'data' => $courseFeeData
								];
								$this->curl_executer($curl_config);
								unset($courseFeeData['is_NR']);
							}
						}else{
							$courseFeeData['description'] = 'Admission as non-regular student';
							$courseFeeData['added_at'] = date('Y-m-d H:i:s');
							$course_fee_id = $this->commonmodel->insertRecord('tbl_admissions_coursefee', $courseFeeData);
							if($course_fee_id){
								$courseFeeData['is_NR'] = true;
								$curl_config = [
									'url' => ERP_BASE_API.'admissions_coursefee_cu/',
									'method' => 'POST',
									'data' => $courseFeeData
								];
								$this->curl_executer($curl_config);
								unset($courseFeeData['is_NR']);
							}
						}
						if(isset($updated) || $course_fee_id){
							unset($courseFeeData['update_at']);
							unset($courseFeeData['course_type']);
							unset($courseFeeData['is_change_fee']);
							$courseFeeData['course_fee_id'] = (isset($course_fee_id))?$course_fee_id:$id2;
							$courseFeeData['added_at'] = date('Y-m-d H:i:s');
							$log_id = $this->commonmodel->insertRecord('tbl_admissions_log', $courseFeeData);
							if($log_id){
								$curl_config = [
									'url' => ERP_BASE_API.'insert_admissions_log',
									'method' => 'POST',
									'data' => $courseFeeData
								];
								$this->curl_executer($curl_config);
							}

							//insert paid installment
							$paidInstData['course_fee_id'] = (isset($course_fee_id))?$course_fee_id:$id2;
							$paidInstData['paid_amount'] = $_POST['upfront_payment2'];
							$paidInstData['paid_date'] = date('Y-m-d',strtotime($_POST['adm_date2']));
							$paidInstData['receipt_no'] = $_POST['receipt_no2'];
							$paidInstData['description'] = $courseFeeData['description'];
							$paidInstData['added_by'] = session('user_id');
							$paidInstData['added_at'] = date('Y-m-d H:i:s');
							if($id2){
								if($this->commonmodel->updateRecord('tbl_adms_paid_inst', $paidInstData, array('course_fee_id'=>$id2))){
									$curl_config = [
										'url' => ERP_BASE_API.'adms_paid_inst_cu/'.$id2,
										'method' => 'POST',
										'data' => $paidInstData
									];
									$this->curl_executer($curl_config);
								}
							}else{
								if($this->commonmodel->insertRecord('tbl_adms_paid_inst', $paidInstData)){
									$curl_config = [
										'url' => ERP_BASE_API.'adms_paid_inst_cu/',
										'method' => 'POST',
										'data' => $paidInstData
									];
									$this->curl_executer($curl_config);
								}
							}
						}
					}

				}
			}
			if(isset($post) && !empty($post)){
				if(!$id){
					$post['adm_by']           = session('user_id');
					$post['added_at']         = date('Y-m-d H:i:s');
					$inserted = $this->commonmodel->insertRecord('tbl_admissions', $post);
					
					if($inserted){
						session()->setFlashdata(['message'=>'Student added successfuly', 'type'=>'success']);
						$curl_config = [
							'url' => ERP_BASE_API.'student_cu',
							'method' => 'POST',
							'data' => $post
						];
						$this->curl_executer($curl_config);

						$id = $inserted;
						$stu_padded_id = str_pad($id, 4, '0', STR_PAD_LEFT);
						$stu_roll_no = date('Y').date('m').$stu_padded_id;
						//generate registration no
						do{
							$code = mt_rand(10000000, 99999999);
							$is_exist = $this->insmanagemodel->is_exist_code($code);
						}while($is_exist);
						$stu_reg_no = 'CBR'.$code;
						$this->commonmodel->insertRecord('tbl_random_code', ['code'=>$code]);
						$updata['stu_roll_no'] = $stu_roll_no;
						$updata['stu_reg_no'] = $stu_reg_no;
						$this->commonmodel->updateRecord('tbl_admissions', $updata, ['stu_id'=>$id]);
						$curl_config = [
							'url' => ERP_BASE_API.'student_update_registration/'.$id,
							'method' => 'POST',
							'data' => $updata
						];
						$this->curl_executer($curl_config);
					}else{
						session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
					}
					
				}else{
					//$data['update_by']              = $x['id'];
					$post['update_at']              = date('Y-m-d H:i:s');
					$updated = $this->commonmodel->updateRecord('tbl_admissions', $post, array('stu_id'=>$id));
					if($updated){
						session()->setFlashdata(['message'=>'Student update successfuly', 'type'=>'success']);
						$curl_config = [
							'url' => ERP_BASE_API.'student_cu/'.$id,
							'method' => 'POST',
							'data' => $post
						];
						$this->curl_executer($curl_config);
						// echo $res; exit;
					}else{
						session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
					}
				}

				if($id && $id2){
					return redirect()->to('/institute/student_cu/'.$id.'/'.$id2);
				}else if($id){
					return redirect()->to('/institute/student_cu/'.$id);
				}else{
					return redirect()->to('/institute/students');
				}
			}
		}
		if($id){
			$data['student'] = $this->insmanagemodel->get_students_list($id);
			$data['courseList'] = $this->insmanagemodel->get_students_course_list($id);
		}
		if($id2){
			$data['singleCourse'] = $this->insmanagemodel->get_one_admissions_coursefee($id2);
			$data['courseDtls'] = $this->commonmodel->getOneRecord($this->coursefranchiseTbl,['cid'=>$data['singleCourse']->course_id]);
			// echo $this->db->last_query(); exit;
			// print_r($this->data['singleCourse']); exit;
		}
		$data['qualifications'] = $this->commonmodel->getAllRecord('tbl_qualification',['status'=>'1']);
		$data['coursess'] = $this->commonmodel->getAllRecordOrderByDesc($this->coursefranchiseTbl,['status'=>1],['cid','DESC']);
		$data['batches'] = $this->commonmodel->getAllRecord('tbl_insbatch',['status'=>1]);
		$data['settings'] = $this->commonmodel->getOneRecord('tbl_setting',['id'=>1]);
		
        return view('admin/ins_adm_manage/student_cu', $data);
    }
	public function get_course_details(){
		if($this->request->getMethod() == 'post'){
			// echo 'hi'; exit;
			$data = array();
			$course_id = ($_POST['course_id'] != '')?$_POST['course_id']:0;
			$course_details = $this->commonmodel->getOneRecord($this->coursefranchiseTbl, array('cid'=>$course_id));
			if(!empty($course_details) && isset($course_details->cid)){
				$data['course_details'] = $course_details;
			}else{
				$data['error'] = 'Something went wrong';
			}
			echo json_encode($data);
		}else{
			return redirect()->to('/institute/students');
		}

	}
	public function update_activetab(){
		if($this->request->getMethod() == 'post'){
			$stu_id = $_POST['stu_id'];
			$tabno = $_POST['tabno'];
			$this->commonmodel->updateRecord('tbl_admissions', ['active_tab'=>$tabno], array('stu_id'=>$stu_id));
			echo 'done';
			exit;
		}
		return redirect()->to('/institute/students');
	}
	public function student_view($id = false){
		if($this->request->getMethod() == 'post'){
			$course_fee_id = $_POST['course_fee_id'];
			if($_POST['submit'] == 'changeCourse'){
				
				$batch_id = $_POST['batch_id'];
				$course_id = $_POST['course_id'];
				$course_fee = $_POST['course_fee'];
				$adms_course_fee_data = $this->commonmodel->getOneRecord('tbl_admissions_coursefee', array('id'=>$course_fee_id));
				$course = $this->commonmodel->getOneRecord('tbl_course_franchise', array('cid'=>$course_id));
				$update_data = array();
				if($adms_course_fee_data->batch_id != $batch_id){
					$update_data['batch_id'] = $batch_id;
				}
				if($adms_course_fee_data->course_id != $course_id || $adms_course_fee_data->course_fee != $course_fee){
					$update_data['course_id'] = $course_id;
					$update_data['course_fee'] = $course_fee;
					$total_fee = (int)$course_fee + (int)$adms_course_fee_data->adm_fee;
					$update_data['total_fee'] = $total_fee;
					$dues_amount = (int)$total_fee - (int)$adms_course_fee_data->paid_amount;
					$update_data['dues_amount'] = $dues_amount;
					$update_data['fnf_amount'] = $dues_amount;
					if($adms_course_fee_data->payment_type == 'installment'){
						$total_installment = (int)$course->course_duration - 1;
						$tot_due_inst = $total_installment - (int)$adms_course_fee_data->paid_inst_no + 1;
						$ins_amount = round((int)$dues_amount / $tot_due_inst);
						$update_data['payable_amount'] = $ins_amount;
						$update_data['total_installment'] = $total_installment;
						$update_data['ins_amount'] = $ins_amount;
					}else{
						$update_data['payable_amount'] = 0;
						$update_data['total_installment'] = 0;
						$update_data['ins_amount'] = 0;
					}
				}
				
			}
			if($_POST['submit'] == 'changeStatus'){
				$course_cat = $_POST['course_cat'];
				if($course_cat == 'P'){
					$update_data['cert_issue_date'] = date('Y-m-d h:i:s',strtotime($_POST['cert_issue_date']));
				}
				$status = $_POST['status'];
				$update_data['status'] = $status;
			}
			if($_POST['submit'] == 'giveDiscount'){
				// $course_fee_id = $_POST['course_fee_id'];
				$disAmount = $_POST['disAmount'];
				$description = $_POST['description'];
				// print_r($_POST); exit;
				
				$adms_course_fee_data = $this->commonmodel->getOneRecord('tbl_admissions_coursefee', array('id'=>$course_fee_id));
				$update_data['dis_amount'] = (int)$adms_course_fee_data->dis_amount + (int)$disAmount;
				$total_fee = (int)$adms_course_fee_data->total_fee - (int)$disAmount;
				$update_data['total_fee'] = $total_fee;
				$dues_amount = (int)$total_fee - (int)$adms_course_fee_data->paid_amount;
				$update_data['dues_amount'] = $dues_amount;
				$update_data['fnf_amount'] = $dues_amount;
				if($adms_course_fee_data->payment_type == 'installment'){
					$total_installment = (int)$adms_course_fee_data->total_installment;
					$tot_due_inst = $total_installment - (int)$adms_course_fee_data->paid_inst_no + 1;
					$ins_amount = round((int)$dues_amount / $tot_due_inst);
					$update_data['payable_amount'] = $ins_amount;
					$update_data['total_installment'] = $total_installment;
					$update_data['ins_amount'] = $ins_amount;
				}else{
					$update_data['payable_amount'] = 0;
					$update_data['total_installment'] = 0;
					$update_data['ins_amount'] = 0;
				}
				$update_data['description'] = $description;
			}
			if($_POST['submit'] == 'cancelCourse'){
				// print_r($_POST); exit;
				$stu_id = $_POST['stu_id'];
				$student = $this->insmanagemodel->get_students_list($stu_id);

				if($student->beneficiary_name != $_POST['beneficiary_name'] || $student->beneficiary_mob_no != $_POST['beneficiary_mob_no'] || $student->bank_name != $_POST['bank_name'] || $student->branch_name != $_POST['branch_name'] || $student->bank_ac_no != $_POST['bank_ac_no'] || $student->ifsc_code != $_POST['ifsc_code']){
					$admdata['beneficiary_name']	    = $this->request->getPost('beneficiary_name');
					$admdata['beneficiary_mob_no']		= $this->request->getPost('beneficiary_mob_no');
					$admdata['bank_name']		    	= $this->request->getPost('bank_name');
					$admdata['branch_name']		    	= $this->request->getPost('branch_name');
					$admdata['bank_ac_no']		    	= $this->request->getPost('bank_ac_no');
					$admdata['ifsc_code']		    	= $this->request->getPost('ifsc_code');
				}
				$admdata['cancelation_date']		= date('Y-m-d H:i:s',strtotime($this->request->getPost('cancelation_date').' '.date('H:i:s')));
				if($this->commonmodel->updateRecord('tbl_admissions', $admdata, array('stu_id'=>$stu_id))){
					$curl_config = [
						'url' => ERP_BASE_API.'update_admissions_cancelation/'.$stu_id,
						'method' => 'POST',
						'data' => $admdata
					];
					$this->curl_executer($curl_config);
				}

				$update_data['status'] = 3;
			}
			if($_POST['submit'] == 'editReceipt'){
				// print_r($_POST); exit;
				$validation = \Config\Services::validation();
				if($_POST['receipt_no_o'] != $_POST['receipt_no']){
					$validation->setRule('receipt_no','Receipt No','is_unique[tbl_adms_paid_inst.receipt_no]');
				}else{
					$validation->setRule('receipt_no','Receipt No','required');
				}
				if(!$validation->withRequest($this->request)->run()){
					session()->setFlashdata(['message'=>display_error($validation, 'receipt_no'),'type'=>'danger']);
					return redirect()->to('/institute/student_view/'.$id);
				}else{
					$inst_id = $_POST['inst_id'];
					$paid_amount = $_POST['paid_amount'];
					$paid_amount_o = $_POST['paid_amount_o'];
					$receipt_no = $_POST['receipt_no'];
					$receipt_no_o = $_POST['receipt_no_o'];
					
					$paid_inst_data = array();
					if($receipt_no_o != $receipt_no){
						$paid_inst_data['receipt_no'] = $receipt_no;
						$update_data['receipt_no'] 		= $receipt_no;
						$update_data['description'] 	= 'Receipt no changed.';
					}
					if($paid_amount_o != $paid_amount){
						$paid_inst_data['paid_amount'] = $paid_amount;

						$adms_course_fee_data = $this->commonmodel->getOneRecord('tbl_admissions_coursefee', array('id'=>$course_fee_id));
						$amount = (int)$paid_amount - (int)$paid_amount_o;
						$paid_amount = (int)$adms_course_fee_data->paid_amount + (int)$amount;
						$update_data['paid_amount'] = $paid_amount;
						$dues_amount = (int)$adms_course_fee_data->total_fee - (int)$paid_amount;
						$update_data['dues_amount'] = $dues_amount;
						$payable_amount = (int)$adms_course_fee_data->payable_amount - (int)$amount;
						$update_data['payable_amount'] = $payable_amount;
						$update_data['description'] 	= 'Paid amount changed.';
					}
					
					if(!empty($paid_inst_data)){
						$paid_inst_data['added_by'] = session('user_id');
						$paid_inst_data['added_at'] = date('Y-m-d H:i:s');
						if($this->commonmodel->updateRecord('tbl_adms_paid_inst', $paid_inst_data, array('inst_id'=>$inst_id))){
							$curl_config = [
								'url' => ERP_BASE_API.'update_adms_paid_inst/'.$inst_id,
								'method' => 'POST',
								'data' => $paid_inst_data
							];
							$this->curl_executer($curl_config);
						}
					}
					// print_r($_POST); exit;
				}
			}
			if(!empty($update_data)){
				$update_data['update_by'] = session('user_id');
				$update_data['update_at'] = date('Y-m-d H:i:s');
				if($this->commonmodel->updateRecord('tbl_admissions_coursefee', $update_data, array('id'=>$course_fee_id))){
					$update_data['submit'] = $_POST['submit'];
					$curl_config = [
						'url' => ERP_BASE_API.'update_coursefee/'.$course_fee_id,
						'method' => 'POST',
						'data' => $update_data
					];
					$this->curl_executer($curl_config);
					unset($update_data['submit']);
				}
				//insert log
				$this->insert_adm_log($course_fee_id);
				session()->setFlashdata(['message'=>'Student update successfuly', 'type'=>'success']);
			}else{
				session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
			}
			return redirect()->to('institute/student_view/'.$id);
		}
		$data['page_title']="Students Details";
		$data['student'] = $this->insmanagemodel->get_students_list($id);
		$data['courseList'] = $this->insmanagemodel->get_students_course_list($id);
		$data['coursess'] = $this->commonmodel->getAllRecord('tbl_course_franchise',['status'=>1]);
		$data['batches'] = $this->commonmodel->getAllRecord('tbl_insbatch',['status'=>1]);
		$data['fee_log'] = $this->insmanagemodel->get_paid_installment_log_details($id);
		//$this->data['student_fee_log'] = $this->common->get_all_record('tbl_institution_fee','',['stu_id'=>$id]);
		// echo '<pre>'; print_r($data['courseList']); exit;
		return view('admin/ins_adm_manage/student_view', $data);
	}
    public function insert_adm_log($course_fee_id){
		$adms_log_data = $this->commonmodel->getAllRecordRowArray('tbl_admissions_coursefee', array('id'=>$course_fee_id));
		$adms_log_data['course_fee_id'] = $adms_log_data['id'];
		unset($adms_log_data['id']);
		unset($adms_log_data['course_type']);
		unset($adms_log_data['is_change_fee']);
		unset($adms_log_data['update_at']);
		unset(
				$adms_log_data['module_marks'],
				$adms_log_data['grade'],
				$adms_log_data['percentage'],
				$adms_log_data['tot_fm'],
				$adms_log_data['tot_mo'],
				$adms_log_data['cert_issue_date'],
				$adms_log_data['cert_no'],
			);
		$adms_log_data['added_at'] = date('Y-m-d H:i:s');
		// print_r($adms_log_data); exit;
		if($this->commonmodel->insertRecord('tbl_admissions_log', $adms_log_data)){
			$curl_config = [
				'url' => ERP_BASE_API.'insert_admissions_log',
				'method' => 'POST',
				'data' => $adms_log_data
			];
			$this->curl_executer($curl_config);
			return true;
		}
	}
	public function resume_course($id, $stu_id){
		
        $updated = $this->commonmodel->updateRecord('tbl_admissions_coursefee',['status'=> 1], array('id'=>$id));
		if($updated){
			$curl_config = [
				'url' => ERP_BASE_API.'update_coursefee/'.$id,
				'method' => 'POST',
				'data' => ['status'=>1,'submit'=>'resumeCourse']
			];
			$this->curl_executer($curl_config);
			$this->insert_adm_log($id);
			$msg='Admission return from cancelation Successfuly!';

			$this->session->setFlashdata(['message'=>$msg, 'type'=>'success']);
		}
		else{
			$err='Something went wrong!';

			$this->session->setFlashdata(['message'=>$err, 'type'=>'danger']);
		}
		
		return redirect()->to('institute/student_view/'.$stu_id);
	}
	public function fee_deposite(){
		
		if($this->request->getMethod() == 'post'){
			$stu_id = $_POST['stu_id'];
			$course_fee_id = $_POST['course_fee_id'];
			$amount = $_POST['amount'];
			$receipt_no = $_POST['receipt_no'];
			$paid_date = date('Y-m-d',strtotime($_POST['paid_date']));
			// $this->form_validation->set_rules('receipt_no','Receipt No','is_unique[tbl_adms_paid_inst.receipt_no]');
			$rules['receipt_no'] = ['rules'=> 'required|is_unique[tbl_adms_paid_inst.receipt_no]'];
			$validation = $this->validate($rules);
			if(!$validation){
				session()->setFlashdata(['message'=>'This receipt no already taken', 'type'=>'danger']);
			}else{
				// print_r($_POST); exit;
				$adms_course_fee_data = $this->commonmodel->getOneRecord('tbl_admissions_coursefee', array('id'=>$course_fee_id));
				$due_date = $adms_course_fee_data->next_paid_date;
				$adms_coursefee_data = array();
				$paid_amount = (int)$adms_course_fee_data->paid_amount + (int)$amount;
				$adms_coursefee_data['paid_amount'] = $paid_amount;
				$dues_amount = (int)$adms_course_fee_data->total_fee - (int)$paid_amount;
				$adms_coursefee_data['dues_amount'] = $dues_amount;
				$adms_coursefee_data['paid_date'] = $paid_date;
				if($adms_course_fee_data->paid_inst_no < $adms_course_fee_data->total_installment){
					$paid_inst_no = (int)$adms_course_fee_data->paid_inst_no + 1;
					$payable_amount = (int)$adms_course_fee_data->payable_amount - (int)$amount + (int)$adms_course_fee_data->ins_amount;
					$next_paid_date = date('Y-m-d', strtotime($adms_course_fee_data->next_paid_date.' + 1 month'));
				}else{
					$paid_inst_no = (int)$adms_course_fee_data->paid_inst_no;
					$payable_amount = (int)$adms_course_fee_data->payable_amount - (int)$amount;
					$next_paid_date = date('Y-m-d', strtotime($adms_course_fee_data->next_paid_date));
				}
				$adms_coursefee_data['paid_inst_no'] 	= $paid_inst_no;
				$adms_coursefee_data['next_paid_date'] 	= $next_paid_date;
				$adms_coursefee_data['payable_amount'] 	= $payable_amount;
				$adms_coursefee_data['receipt_no'] 		= $receipt_no;
				$adms_coursefee_data['update_by'] 		= session('user_id');
				$adms_coursefee_data['is_change_fee'] 	= 'no';
				$adms_coursefee_data['update_at'] 		= date('Y-m-d H:i:s');
				
				$description = $paid_inst_no.' installment';
				$adms_coursefee_data['description'] 	= $description;
				if($this->commonmodel->updateRecord('tbl_admissions_coursefee', $adms_coursefee_data, array('id'=>$course_fee_id))){
					$adms_coursefee_data['submit'] = 'fee_deposite';
					$curl_config = [
						'url' => ERP_BASE_API.'update_coursefee/'.$course_fee_id,
						'method' => 'POST',
						'data' => $adms_coursefee_data
					];
					$this->curl_executer($curl_config);
					unset($adms_coursefee_data['submit']);
				}

				//insert log
				$adms_log_data = $this->commonmodel->getAllRecordRowArray('tbl_admissions_coursefee', array('id'=>$course_fee_id));
				$adms_log_data['course_fee_id'] = $adms_log_data['id'];
				unset($adms_log_data['id']);
				unset($adms_log_data['is_change_fee']);
				unset($adms_log_data['update_at']);
				unset($adms_log_data['course_type'],$adms_log_data['module_marks'],$adms_log_data['grade'],$adms_log_data['percentage'],$adms_log_data['tot_fm'],$adms_log_data['tot_mo'],$adms_log_data['cert_issue_date'],$adms_log_data['cert_no']);
				$adms_log_data['added_at'] = date('Y-m-d H:i:s');
				if($this->commonmodel->insertRecord('tbl_admissions_log', $adms_log_data)){
					$curl_config = [
						'url' => ERP_BASE_API.'insert_admissions_log',
						'method' => 'POST',
						'data' => $adms_log_data
					];
					$this->curl_executer($curl_config);
				}

				//insert paid installment
				$ins_fee_data['course_fee_id'] 		= $course_fee_id;
				$ins_fee_data['paid_amount'] 		= $amount;
				$ins_fee_data['paid_date'] 			= $paid_date;
				$ins_fee_data['due_date'] 			= $due_date;
				$ins_fee_data['receipt_no'] 		= $receipt_no;
				$ins_fee_data['description'] 		= $description;
				$ins_fee_data['added_by'] 			= session('user_id');
				$ins_fee_data['added_at'] 			= date('Y-m-d H:i:s');
				if($this->commonmodel->insertRecord('tbl_adms_paid_inst', $ins_fee_data)){
					$curl_config = [
						'url' => ERP_BASE_API.'insert_adms_paid_inst',
						'method' => 'POST',
						'data' => $ins_fee_data
					];
					$this->curl_executer($curl_config);
					session()->setFlashdata(['message'=>'Fee deposite successfully','type'=>'success']);
				}else{
					session()->setFlashdata(['message'=>'Fee not deposite! Please try again','type'=>'danger']);
				}
			}
			
			return redirect()->to('institute/student_view/'.$stu_id);
		}else{
			return redirect()->to('institute/students');
		}
	}
	

	/*********************************************Cancel Admission********************************** */
	public function cancel_admission($id){
		date_default_timezone_set('Asia/Kolkata');
		/*if($this->input->method() == 'post'){
			//print_r($_POST); exit; 
			
			$this->form_validation->set_rules('beneficiary_name','Beneficiary Name','required');
			$this->form_validation->set_rules('beneficiary_mob_no','Beneficiary Mobile No','required|is_natural|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('bank_name','Bank Name','required');
			$this->form_validation->set_rules('branch_name','Branch Name','required');
			$this->form_validation->set_rules('bank_ac_no','Bank Ac No','required');
			$this->form_validation->set_rules('ifsc_code','IFSC Code','required');
			$this->form_validation->set_rules('cancelation_date','Cancelation Date','required');
			
			$this->form_validation->set_error_delimiters('<div class="text-danger px-4">','</div>');
			if($this->form_validation->run()){
				//echo '<pre>'; print_r($_POST); echo $is_change_fee; exit;
				$data = array();
				/*if($_FILES['stu_image']['name'] != ''){
					$ext = explode(".", $_FILES['stu_image']['name']);
					$filename = 'dp_stu'.time().'.'.end($ext);
					$config['file_name'] = $filename; 
					$config['upload_path'] = './assets/uploads/students/';
					$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg|pdf';
					
					$this->upload->initialize($config);
					$this->upload->do_upload('stu_image');
					
					$data['stu_image'] = $filename;
					
				}*
				
				$data['beneficiary_name']	    = $this->input->post('beneficiary_name');
				$data['beneficiary_mob_no']		= $this->input->post('beneficiary_mob_no');
				$data['bank_name']		    	= $this->input->post('bank_name');
				$data['branch_name']		    = $this->input->post('branch_name');
				$data['bank_ac_no']		    	= $this->input->post('bank_ac_no');
				$data['ifsc_code']		    	= $this->input->post('ifsc_code');
				
				$data['cancelation_date']		= date('Y-m-d H:i:s',strtotime($this->input->post('cancelation_date').' '.date('H:i:s')));
				$data['status']             	= '3';

				$updated = $this->common->update_record('tbl_admissions', $data, array('stu_id'=>$id));
				
				if($updated) {
					$this->session->set_flashdata('msg','Bank details updated successfully.');
				}else{
					$this->session->set_flashdata('err','Something went wrong');
				}
				
				return redirect($_POST['http_referer']);
			}
		}*/
		
		$data['page_title'] = "Cancel Admission";
		$data['student'] = $this->insmanagemodel->get_cancel_students_list($id);
		// $template->admin_render('institute/students/cancel_admission', $this->data);
		return view('admin/ins_adm_manage/cancel_admission', $data);
	}
	public function admission_cancelation_list(){
		$data['page_title']="Students Admission Cancelation";
		$data['cancel_student_list'] = $this->insmanagemodel->get_cancel_students_list();
		$data['canceled_student_list'] = $this->insmanagemodel->get_canceled_students_list();
		$data['count_list'] = $this->insmanagemodel->get_count_student_list();
		$data['coursess'] = $this->commonmodel->getAllRecord($this->coursefranchiseTbl);
		$data['batches'] = $this->commonmodel->getAllRecord('tbl_insbatch');
		// echo '<pre>'; print_r ($data['batches']); exit;
		return view('admin/ins_adm_manage/admission_cancelation_list', $data);
	}
	public function re_admission($id){
		
        $updated = $this->commonmodel->updateRecord('tbl_admissions_coursefee',['status'=> 1], array('id'=>$id));
		if($updated){
			$curl_config = [
				'url' => ERP_BASE_API.'update_coursefee/'.$id,
				'method' => 'POST',
				'data' => ['status'=>1,'submit'=>'resumeCourse']
			];
			$this->curl_executer($curl_config);
			$msg='Admission return from cancelation Successfuly!';
			session()->setFlashdata(['message'=>$msg,'type'=>'success']);
		}
		else{
			session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
		}
		
		return redirect('institute/admission_cancelation_list');
	}
	public function cancel_admission_success(){
		if($this->request->getMethod() == 'post'){
			date_default_timezone_set('Asia/Kolkata');
			// $x = $this->session->userdata('loginitems');
			$id = $_POST['id'];
			$stu_id = $_POST['stu_id'];
			$courseFeeData = $this->commonmodel->getOneRecord('tbl_admissions_coursefee', array('id'=>$id));
			$cancData = array();
			$cancData['stu_id'] = $stu_id;
			$cancData['course_id'] = $courseFeeData->course_id;
			$cancData['batch_id'] = $courseFeeData->batch_id;
			$cancData['course_fee'] = $courseFeeData->course_fee;
			$cancData['adm_fee'] = $courseFeeData->adm_fee;
			$cancData['dis_amount'] = $courseFeeData->dis_amount;
			$cancData['total_fee'] = $courseFeeData->total_fee;
			$cancData['paid_amount'] = $courseFeeData->paid_amount;
			$cancData['adm_date'] = $courseFeeData->adm_date;
			$cancData['return_amount'] = $courseFeeData->paid_amount;
			$cancData['cancelation_date'] = $_POST['cancelation_date'];
			$cancData['amount_return_date'] = date('Y-m-d H:i:s',strtotime($_POST['amount_return_date'].' '.date('H:i:s')));
			$cancData['return_confirm_by'] = session('user_id');
			$cancData['added_at'] = date('Y-m-d H:i:s');
			$inserted = $this->commonmodel->insertRecord('tbl_admissions_canceled', $cancData);

			$isDel = $this->commonmodel->deleteRecord('tbl_admissions_coursefee', array('id'=>$id));
			$this->commonmodel->deleteRecord('tbl_adms_paid_inst', array('course_fee_id'=>$id));
			$this->commonmodel->deleteRecord('tbl_admissions_log', array('course_fee_id'=>$id));
			if($isDel){
				$curl_config = [
					'url' => ERP_BASE_API.'del_canceled_student',
					'method' => 'POST',
					'data' => ['id'=>$id]
				];
				$this->curl_executer($curl_config);
			}
			$another_course = $this->commonmodel->getAllRecordCount('tbl_admissions_coursefee',array('stu_id'=>$stu_id));
			//update admission table
			if($another_course < 1){
				$studata['status'] = 3;
				if($this->commonmodel->updateRecord('tbl_admissions', $studata, array('stu_id'=>$stu_id))){
					$studata['submit'] = 'cancelAdm';
					$curl_config = [
						'url' => ERP_BASE_API.'student_cu/'.$stu_id,
						'method' => 'POST',
						'data' => $studata
					];
					$this->curl_executer($curl_config);
					unset($studata['submit']);
				}
			}
			if($inserted){
				$curl_config = [
					'url' => ERP_BASE_API.'insert_admissions_canceled',
					'method' => 'POST',
					'data' => $cancData
				];
				$this->curl_executer($curl_config);
				session()->setFlashdata(['message'=>'Payment return confirmed successfully.','type'=>'success']);
			}else{
				session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
			}
			return redirect('institute/admission_cancelation_list');
		}
		return redirect('institute/students');
	}
	public function canceled_students_view($id){
		$data['page_title']="Canceled Students Details";
		$data['student'] = $this->insmanagemodel->get_canceled_students_list($id);
		//$this->data['fee_log'] = $this->institute->get_paid_installment_log_details($id);
		//$this->data['student_fee_log'] = $this->common->get_all_record('tbl_institution_fee','',['stu_id'=>$id]);
		return view('admin/ins_adm_manage/canceled_students_view', $data);
	}
	public function payment_receipt()
    {
		$url = base_url('institute/payment_receipt_listing');
		if(isset($_GET['date']) || isset($_GET['dateto']) || isset($_GET['batch']) || isset($_GET['course'])){
			$date = (isset($_GET['date']) && $_GET['date'] != '')?date('Y-m-d',strtotime($_GET['date'])):'';
			$dateto = (isset($_GET['dateto']) && $_GET['dateto'] != '')?date('Y-m-d',strtotime($_GET['dateto'])):'';
			$batch = (isset($_GET['batch']))?$_GET['batch']:'';
			$course = (isset($_GET['course']))?$_GET['course']:'';
			//$project_id = (isset($_GET['project_id']))?$_GET['project_id']:'';
			//$created_by = (isset($_GET['created_by']))?$_GET['created_by']:'';
			//$taskemail = (isset($_GET['taskemail']))?$_GET['taskemail']:'';
            $http_query = http_build_query(array('date'=>$date,'dateto'=>$dateto,'batch'=>$batch,'course'=>$course));
            $url = base_url('institute/payment_receipt_listing?'.$http_query);
			session()->set('fee_collect_url', $url, 300);
		}else if(session()->has('fee_collect_url')){
			$url = session('fee_collect_url');
		}
		return redirect()->to($url);
    }
	public function payment_receipt_listing(){
		$data['page_title']="Fee Collection Report";
		$data['coursess'] = $this->commonmodel->getAllRecord($this->coursefranchiseTbl);
		$data['batches'] = $this->commonmodel->getAllRecord('tbl_insbatch');
		$data['feereport_list'] = $this->insmanagemodel->get_feereport_list();
		return view('admin/ins_adm_manage/feereport_list', $data);
	}
	public function reset_fee_collect_url(){
		if(session()->has('fee_collect_url')){
			session()->remove('fee_collect_url');
		}
		$date = date('Y-m-1');
		$dateto = date('Y-m-d');
		$http_query = http_build_query(array('date'=>$date, 'dateto'=>$dateto));
		return redirect()->to(base_url('/institute/payment_receipt?'.$http_query));
	}

	public function pending_amount()
    {
		$url = base_url('institute/pending_amount_listing');
		if(isset($_GET['s']) || isset($_GET['batch']) || isset($_GET['course'])){
			$s = (isset($_GET['s']) && $_GET['s'] != '')?$_GET['s']:'';
			//$dateto = (isset($_GET['dateto']) && $_GET['dateto'] != '')?date('Y-m-d',strtotime($_GET['dateto'])):'';
			$batch = (isset($_GET['batch']))?$_GET['batch']:'';
			$course = (isset($_GET['course']))?$_GET['course']:'';
			//$project_id = (isset($_GET['project_id']))?$_GET['project_id']:'';
			//$created_by = (isset($_GET['created_by']))?$_GET['created_by']:'';
			//$taskemail = (isset($_GET['taskemail']))?$_GET['taskemail']:'';
            $http_query = http_build_query(array('s'=>$s, 'batch'=>$batch,'course'=>$course));
            $url = base_url('institute/pending_amount_listing?'.$http_query);
			session()->set('stu_pay_url', $url, 300);
		}else if(session()->has('stu_pay_url')){
			$url = session()->userdata('stu_pay_url');
		}
		return redirect()->to($url);
    }
	public function pending_amount_listing(){
		if(date('d') < 30 && !session()->has('is_update_stu_ins_log')){
		}
		$this->update_stu_installment_log();
		
		$data['page_title']="Student Payment Report";
		// $data['count_list'] = $this->insmanagemodel->get_count_stupayreport_list();
		$data['coursess'] = $this->commonmodel->getAllRecord('tbl_course_franchise');
		$data['batches'] = $this->commonmodel->getAllRecord('tbl_insbatch');
		$data['stupayreport_list'] = $this->insmanagemodel->get_stupayreport_list();
		// echo '<pre>'; print_r($data['stupayreport_list']); exit;
		return view('admin/ins_adm_manage/stupayreport_list', $data);

	}
	public function payment_report_export(){
		//remove previous files
		helper('filesystem');
		$map = directory_map("./public/assets/excel_file/");
		foreach($map as $filename){
			unlink('./public/assets/excel_file/'.$filename);
		}

		$stupayreport_list = $this->insmanagemodel->get_stupayreport_list();
		if(!empty($stupayreport_list)){
			// echo '<pre>'; print_r($stupayreport_list); exit;
			$fileName = 'Payment_Report_'.time().'.xlsx'; 

			$spreadsheet = new Spreadsheet();
			$spreadsheet->getActiveSheet()->mergeCells("A1:K1");
			$spreadsheet->getActiveSheet()->setCellValue("A1", 'Payment Report');
			$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);
			$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
			$spreadsheet->getActiveSheet()->getStyle("A2:K2")->getFont()->setBold(true);
			
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->setCellValue('A2', 'Hello World !');
			$sheet->setCellValue('A2', 'Due Date');
			$sheet->setCellValue('B2', 'Student\'s Name');
			$sheet->setCellValue('C2', 'Roll No');
			$sheet->setCellValue('D2', 'Batch Name');
			$sheet->setCellValue('E2', 'Course Name');
			$sheet->setCellValue('F2', 'Inst.Amount/ Inst.No');
			$sheet->setCellValue('G2', 'Payable Amount');
			$sheet->setCellValue('H2', 'Paid Amount');
			$sheet->setCellValue('I2', 'Receipt No');
			$sheet->setCellValue('J2', 'Payment Date');
			$sheet->setCellValue('K2', 'Signature');
			$rows = 3;
			foreach ($stupayreport_list as $list){
				$sheet->setCellValue('A'.$rows, date('M-Y',strtotime($list->next_paid_date)));
				$sheet->setCellValue('B'.$rows, $list->stu_name);
				$sheet->setCellValue('C'.$rows, $list->stu_roll_no);
				$sheet->setCellValue('D'.$rows, $list->batch_name);
				$sheet->setCellValue('E'.$rows, $list->c_f_name);
				$sheet->setCellValue('F'.$rows, $list->ins_amount.'/'.$list->paid_inst_no.' / '.$list->total_installment);
				$sheet->setCellValue('G'.$rows, $list->payable_amount);
				$sheet->setCellValue('H'.$rows, '');
				$sheet->setCellValue('I'.$rows, '');
				$sheet->setCellValue('J'.$rows, '');
				$sheet->setCellValue('K'.$rows, '');
				$rows++;
			}
			$rows--;
			//setting alignment
			$spreadsheet->getActiveSheet()->getStyle("A1:K".$rows)->getAlignment()->setHorizontal('center');
			$spreadsheet->getActiveSheet()->getStyle("A1:K".$rows)->getAlignment()->setVertical('center');
			$spreadsheet->getActiveSheet()->getStyle("A1:K".$rows)->getAlignment()->setWrapText(true);
			//setting row height
			for($i=1; $i<=$rows; $i++) {
				$spreadsheet->getActiveSheet()->getRowDimension($i)->setRowHeight(34);
			}
			//setting column weight
			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(9.43);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(12);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(10.86);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(14.71);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13.29);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(12);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(12);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(12);
			$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(12);
			$writer = new Xlsx($spreadsheet);
			$writer->save("./public/assets/excel_file/".$fileName);
			header("Content-Type: application/vnd.ms-excel");
			return $this->response->download(ROOTPATH."/public/assets/excel_file/".$fileName, null);
        	exit;
		}else{
			session()->setFlashdata(['message'=>'Something went wrong!.','type'=>'danger']);
			return redirect()->to(base_url('institute/pending_amount_listing'));
		}
	}

	public function update_stu_installment_log(){
		// $x = $this->session->userdata('loginitems');
		// echo date('Y-m-d', strtotime("first day of -1 month")).'<br>'; 
		// echo date('Y-m-d', strtotime("first day of last month")).'<br>';
		// $date = date_create("first day of -1 month")->format('Y-m-d');
		$date =  date('Y-m-d', strtotime(date('Y-m-d')." -1 month"));
		// echo $date;
		// exit;
		
        $student_list = $this->insmanagemodel->get_premium_student($date);
		// echo '<pre>'; print_r($student_list); exit;
        if(!empty($student_list)){
            foreach($student_list as $list){
                // $ins_log_data = $this->institute->get_previous_month_not_paid_instalment_record($list->stu_id);
                //echo '<pre>'; print_r($ins_log_data); exit;
				$update_data = array();
				if($list->paid_inst_no < $list->total_installment){
					$paid_inst_no = (int)$list->paid_inst_no + 1;
					$update_data['paid_inst_no'] = $paid_inst_no;
					$next_paid_date = date('Y-m-d', strtotime($list->next_paid_date.' + 1 month'));
					$update_data['next_paid_date'] = $next_paid_date;
					$payable_amount = (int)$list->payable_amount + (int)$list->ins_amount;
					$update_data['payable_amount'] = $payable_amount;

					$positionArr = ['st','nd','rd','th','th','th','th','th','th','th','th','th'];
					$description = $paid_inst_no.$positionArr[$paid_inst_no - 1].' installment';
					$update_data['description'] = $description;
					$update_data['update_by'] = session('user_id');
					$update_data['is_change_fee'] = 'no';
					$update_data['update_at'] = date('Y-m-d H:i:s');
					if($this->commonmodel->updateRecord('tbl_admissions_coursefee', $update_data, array('id'=>$list->id))){
						$update_data['submit'] = 'updateInstallment';
						$curl_config = [
							'url' => ERP_BASE_API.'update_coursefee/'.$list->id,
							'method' => 'POST',
							'data' => $update_data
						];
						$this->curl_executer($curl_config);
						unset($update_data['submit']);
					}
					
					// $this->common->update_record('tbl_admissions', ['is_change_fee'=>'no'],['stu_id'=>$list->stu_id]);
					$this->insert_adm_log($list->id);
				}
            }
        }
		session()->set('is_update_stu_ins_log',true);
    }
	public function reset_stu_pay_url(){
		if(session()->has('stu_pay_url')){
			session()->remove('stu_pay_url');
		}
		return redirect()->to(base_url('/institute/pending_amount'));
	}
	public function installment_payment($id = null){
        if($id){
			if($this->request->getMethod() == 'post'){
				
				$validation = $this->validate([
					'amount'=>'required|numeric|is_natural_no_zero',
					'receipt_no'=>'required|is_natural_no_zero|is_unique[tbl_adms_paid_inst.receipt_no]',
				]);
				if(!$validation){
					$data['validation'] = $this->validator;
					//return view('admin/users/add_user',$this->data);
				}else{
					// print_r($_POST); exit;
					$id = $_POST['id'];
					$amount = $_POST['amount'];
					$receipt_no = $_POST['receipt_no'];
					$paid_date = date('Y-m-d', strtotime($_POST['paid_date']));
					$adms_course_fee_data = $this->commonmodel->getOneRecord('tbl_admissions_coursefee', array('id'=>$id));
					$update_data = array();
					$paid_amount = (int)$adms_course_fee_data->paid_amount + (int)$amount;
					$update_data['paid_amount'] = $paid_amount;
					$dues_amount = (int)$adms_course_fee_data->total_fee - (int)$paid_amount;
					$update_data['dues_amount'] = $dues_amount;
					$update_data['paid_date'] = $paid_date;
					$payable_amount = (int)$adms_course_fee_data->payable_amount - (int)$amount;
					$update_data['payable_amount'] 	= $payable_amount;
					$update_data['receipt_no'] 		= $receipt_no;
					$description 					= $adms_course_fee_data->description;
					$update_data['description']		= $description;
					$update_data['update_by'] 		= session('user_id');
					$update_data['is_change_fee'] 	= 'no';
					$update_data['update_at'] 		= date('Y-m-d H:i:s');
					if($this->commonmodel->updateRecord('tbl_admissions_coursefee', $update_data, array('id'=>$id))){
						$update_data['submit'] = 'fee_deposite';
						$curl_config = [
							'url' => ERP_BASE_API.'update_coursefee/'.$id,
							'method' => 'POST',
							'data' => $update_data
						];
						$this->curl_executer($curl_config);
						unset($update_data['submit']);
					}

					$this->insert_adm_log($id);

					//insert paid installment
					$ins_fee_data['course_fee_id'] 		= $id;
					$ins_fee_data['paid_amount'] 		= $amount;
					$ins_fee_data['due_date'] 			= $adms_course_fee_data->next_paid_date;
					$ins_fee_data['paid_date'] 			= $paid_date;
					$ins_fee_data['receipt_no'] 		= $receipt_no;
					$ins_fee_data['description'] 		= $description;
					$ins_fee_data['added_by'] 			= session('user_id');
					$ins_fee_data['added_at'] 			= date('Y-m-d H:i:s');
					if($this->commonmodel->insertRecord('tbl_adms_paid_inst', $ins_fee_data)){
						$curl_config = [
							'url' => ERP_BASE_API.'insert_adms_paid_inst',
							'method' => 'POST',
							'data' => $ins_fee_data
						];
						$this->curl_executer($curl_config);
						session()->setFlashdata(['message'=>'Fee deposite successfully','type'=>'success']);
					}else{
						session()->setFlashdata(['message'=>'Fee not deposite! Please try again','type'=>'danger']);
					}
					return redirect()->to(base_url('institute/installment_payment/'.$id));
				}
			}
            $data['page_title']="Installment Payment";
            $data['student'] = $this->insmanagemodel->get_one_coursefee($id);
			$data['fee_log'] = $this->insmanagemodel->get_paid_installment($id);
            return view('admin/ins_adm_manage/installment_payment', $data);
        }else{
            return redirect(base_url('institute/pending_amount'));
        }
		
    }
	public function whatsapp_mark_unmark($stu_id=null){
		//echo $stu_id;
		$student = $this->commonmodel->getOneRecord('tbl_admissions', ['stu_id'=>$stu_id]);
		if($student->is_whatsapp_ph1){
			$update_data['is_whatsapp_ph1'] = 0;
		}else{
			$update_data['is_whatsapp_ph1'] = 1;
		}
		if($this->commonmodel->updateRecord('tbl_admissions',$update_data,['stu_id'=>$stu_id])){
			session()->setFlashdata(['message'=>'Marking success!.','type'=>'success']);
		}else{
			session()->setFlashdata(['message'=>'Something went wrong!.','type'=>'danger']);
		}
		return redirect()->to(base_url('institute/pending_amount_listing'));
	}
	public function completed_students(){
		$data['page_title']="Completed Student";
		if($this->request->getMethod() == 'post'){
			if($_POST['submit'] == 'changeStatus'){
				$id = $_POST['id'];
				$stu_id = $this->commonmodel->getOneRecord('tbl_admissions_coursefee', ['id'=>$id])->stu_id;
				$status = $_POST['status'];
				if($this->commonmodel->updateRecord('tbl_admissions_coursefee',['status'=>$status],['id'=>$id])){
					session()->setFlashdata(['message'=>'Status changed success!.','type'=>'success']);
				}else{
					session()->setFlashdata(['message'=>'Something went wrong!.','type'=>'danger']);
				}
				return redirect()->to(base_url('institute/student_view/'.$stu_id));

			}
		}
		$data['count_list'] = $this->commonmodel->getAllRecordCount('tbl_admissions_coursefee',['status'=>2]);
		$data['coursess'] = $this->commonmodel->getAllRecord('tbl_course_franchise');
		$data['batches'] = $this->commonmodel->getAllRecord('tbl_insbatch');
		$data['student_list'] = $this->insmanagemodel->get_completed_students_list();
        // echo '<pre>'; print_r($data['student_list']); exit;
        return view('admin/ins_adm_manage/completed_student', $data);
	}
	public function marksheet_cu($id){
		$courseDtls = $this->insmanagemodel->get_completed_students_list($id);
		if(!empty($courseDtls)){
			$courseId = $courseDtls->course_id;
			$modules = $this->commonmodel->getAllRecord('tbl_module',['cid'=>$courseId]);
		
			if($this->request->getMethod() === 'post'){
				$rules['mo.0'] = [
                    'rules'=>'required',
                    'errors'=>['required'=>'Please enter marks obtained.']
                ];
                $rules['cert_issue_date'] = [
                    'rules'=>'required',
                    'errors'=>['required'=>'Please provide certificate issue date.']
                ];
				$validation = $this->validate($rules);
				if(!$validation){
					$data['validation'] = $this->validator; 
				}else{
					// print_r($_POST); exit;
					$updated = null;
					if(isset($_POST['mo']) && !empty($_POST['mo'])){
						$tot_fm = 0;
						$tot_mo = 0;
						if(!empty($modules)){
							$module_marks = array();
							foreach($modules as $i=>$list){
								if($_POST['mo'][$i] != ''){
									$module_marks[] = array(
										'id' => $list->id,
										'module_name' => $list->module_name,
										'fm' => $list->full_marks,
										'mo' => $_POST['mo'][$i],
									);
									if($courseDtls->course_cat == 'C'){
										$tot_fm += $list->full_marks;
										$tot_mo += $_POST['mo'][$i];
									}
								}
							}
						}
						
						
						$stuUpdateData['module_marks'] = json_encode($module_marks);
						if($courseDtls->course_cat == 'C'){
							$percentage = round(($tot_mo * 100) / $tot_fm, 2);
							// echo $percentage;
							$gradeData = $this->commonmodel->getOneRecord('tbl_grade',['marks_from <='=>$percentage, 'marks_to >='=>$percentage]);
							$grade = $gradeData->grade;
							// print_r($gradeData); exit;
							$stuUpdateData['grade'] = $grade;
							$stuUpdateData['percentage'] = $percentage;
							$stuUpdateData['tot_fm'] = $tot_fm;
							$stuUpdateData['tot_mo'] = $tot_mo;
						}
						$stuUpdateData['cert_issue_date'] = date('Y-m-d H:i:s');
						$updated = $this->commonmodel->updateRecord('tbl_admissions_coursefee', $stuUpdateData, ['id '=>$id]);
					}
					if($updated){
						session()->setFlashdata(['message'=>'Marks Uploaded','type'=>'success']);
					}else{
						session()->setFlashdata(['message'=>'Something went wrong!.','type'=>'danger']);
					}
					return redirect()->to(base_url('institute/completed_students'));

				}
			}
			
			$data['modules'] = $modules;
			$data['courseDtls'] = $courseDtls;
			// echo '<pre>'; print_r($courseDtls); exit;
			return view('admin/ins_adm_manage/marksheet_cu', $data);
		}else{
			session()->setFlashdata(['message'=>'Course not exists!.','type'=>'danger']);
			return redirect()->to(base_url('institute/completed_students'));
		}
		
	}
	public function generate_certificate(){
		if($this->request->getMethod() == 'post'){
			$id = $_POST['id'];
			if($id){
				$mpdfController = new MpdfController();
				$courseDtls = $this->insmanagemodel->get_completed_students_list($id);
				if(!empty($courseDtls) && $courseDtls->cert_no != ''){
					// $regNo = $certLog->reg_no;
					$certNo = $courseDtls->cert_no;
					// $insertLogFlag = 0;
				}else{
					// $totalCert = count($this->commonmodel->getAllRecord('tbl_cert_log'));
					/*do{
						$No1 = mt_rand(10000, 99999);
						$is_exist = $this->commonmodel->getAllRecordCount($this->randomcodeTbl,['code'=>$No1]);
					} while($is_exist);
					$this->commonmodel->insertRecord($this->randomcodeTbl,['code'=>$No1]);*/
					do{
						$No2 = mt_rand(10000, 99999);
						$is_exist = $this->commonmodel->getAllRecordCount($this->randomcodeTbl,['code'=>$No2]);
					} while($is_exist);
					$this->commonmodel->insertRecord($this->randomcodeTbl,['code'=>$No2]);

					// $regNo = session('cert_prefix').'R'.$member_code.$No1;
					// $certNo = session('cert_prefix').'C'.$member_code.$No2;
					// $regNo = $member_code.$No1;
					$certNo = 'CBC'.$No2;
					// $insertLogFlag = 1;
				}
				$admCourseFeeData = array();
				$admCourseFeeData['cert_no'] = $certNo;
				if($courseDtls->course_cat == 'P' || $courseDtls->course_cat == 'F'){
					$grade = $this->insmanagemodel->getLastGrade();
					$admCourseFeeData['grade'] = $grade;
				}
				$this->commonmodel->updateRecord('tbl_admissions_coursefee', $admCourseFeeData, ['id'=>$id]);
				$courseDtls = $this->insmanagemodel->get_completed_students_list($id);

				if($courseDtls->course_cat == 'C'){
					$mpdfController->create_cb_certificate_pdf($courseDtls, $certNo);
					//generate marksheet
					$generated = $mpdfController->create_cb_marksheet_pdf($courseDtls, $certNo);
				}elseif($courseDtls->course_cat == 'T'){
					$generated = $mpdfController->create_cb_typing_certificate_pdf($courseDtls, $certNo);
				}elseif($courseDtls->course_cat == 'P' || $courseDtls->course_cat == 'F'){
					$generated = $mpdfController->create_cb_certificate_pdf($courseDtls, $certNo);
				}else{
					$generated = 0;
				}

				if($generated){
					$admCourseFeeData = array();
					$admCourseFeeData['status'] = 4;
					$updated = $this->commonmodel->updateRecord('tbl_admissions_coursefee', $admCourseFeeData, ['id'=>$id]);

					// $certLogData = array();
					// $certLogData['frst_id'] = $frStuDtls->frst_id;
					// $certLogData['reg_no'] = $frStuDtls->reg_no;
					// $certLogData['cert_no'] = $certNo;
					// $certLogData['down_time'] = 0;
					// $certLogData['cert_dtls'] = json_encode($frStuDtls);
					// if($insertLogFlag){
					// 	$certLogData['added_at'] = date('Y-m-d H:i:s');
					// 	$this->commonmodel->insertRecord($this->certlogTbl, $certLogData);
					// }else{
					// 	$certLogData['update_at'] = date('Y-m-d H:i:s');
					// 	$this->commonmodel->updateRecord($this->certlogTbl, $certLogData, ['frst_id'=>$frst_id]);
					// }
					session()->setFlashdata(['message'=>'Certificate generated successfully!', 'type'=>'success']);
					$result['res'] = true;
				}else{
					session()->setFlashdata(['message'=>'Certificate not generated', 'type'=>'danger']);
					$result['res'] = false;
				}

				echo json_encode($result); exit;
			}
		}else{
			return redirect()->to(base_url());
		}
	}
	public function universityinfo_cu($id){
		$data = array();
        $uniDtls = $this->commonmodel->getOneRecord('tbl_cb_uni_student', ['cf_id'=>$id]);
		$courseDtls = $this->commonmodel->getOneRecord('tbl_admissions_coursefee', ['id'=>$id]);
		$status = (isset($courseDtls->status) && $courseDtls->status == 4)?4:2;
        $uni_id = $uniDtls->uni_id ?? 0;
        if($this->request->getMethod() == 'post'){
            $post = $studata = array();
            // print_r($_POST); exit;
			$validation = $this->validate([
				'u_name'=>'required',
				'u_regno'=>'required',
				'u_rollno'=>'required',
				'cert_no'=>'required',
				// 'paid_amount'=>'is_natural',
				// 'receipt_no'=>'required',
				'uni_doc'=>[
					//'rules'=>'uploaded[image]|max_size[image,50]|ext_in[image,png,jpg,jpeg,bmp,gif]',
					'rules'=>'max_size[uni_doc,1048576]|ext_in[uni_doc,pdf]',
					'errors'=>[
					//'uploaded'=>'Image is required.',
					'max_size'=>'File must not have size more than 10 MB in length.',
					'ext_in'=>'File must have extension with pdf.',
					]
				],
				'cert_issue_date'=>'required',
				'status'=>'required'
			]);
			if(!$validation){
				$data['validation'] = $this->validator;
				//return view('admin/cms/add_edit_cms', $this->data);
			}else{
				
				if($_FILES['uni_doc']['name'] != ''){
					if($img = $this->request->getFile('uni_doc')){ 
						$imgname = $img->getName();
						if($img->isValid() && !$img->hasMoved()){
							$ext = explode('.',$imgname);
							$ext = end($ext);
							$newName = $_POST['cert_no'].'.'.$ext;
							$img->move('./public/assets/pdf/',$newName);
							
							$post['uni_doc'] = $newName;
						}
					}
				}
				$post['cf_id'] = $id;
				$post['u_name'] = $_POST['u_name'];
				$post['u_regno'] = $_POST['u_regno'];
				$post['u_rollno'] = $_POST['u_rollno'];
				$post['session'] = $_POST['session'];
                $post['cert_no'] = $_POST['cert_no'];

				$studata['cert_issue_date'] = date('Y-m-d',strtotime($_POST['cert_issue_date']));
				$studata['status'] = $_POST['status'];
                $studata['cert_no'] = $_POST['cert_no'];

				if(!$uni_id){
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_cb_uni_student', $post);
                    if($inserted){
                        session()->setFlashdata(['message'=>'University details added successfuly','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }else{
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_cb_uni_student', $post, ['uni_id'=>$uni_id]);
                    if($updated){
                        session()->setFlashdata(['message'=>'University details Updated Successfully','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }
                if(!empty($studata)){
                    $this->commonmodel->updateRecord('tbl_admissions_coursefee',$studata, ['id'=>$id]);
                }
                return redirect()->to(base_url('institute/certified_students'));
			}
            
        }
        $data['uniDtls'] = $uniDtls;
        $data['student'] = $this->insmanagemodel->get_completed_students_list($id, $status);
        // echo '<pre>';print_r($data['student']); exit;
        return view('admin/ins_adm_manage/add_edit_universityinfo', $data);
	}
	public function update_uni_ajax(){
		if($this->request->getMethod() == 'post'){
			// print_r($_POST); exit;
			$uni_id = $_POST['uni_id'];
			$post['cf_id'] = $_POST['course_fee_id'];
			$post['u_name'] = $_POST['u_name'];
			$post['session'] = $_POST['session'];
			$post['u_rollno'] = $_POST['u_rollno'];
			if(!$uni_id){
				$post['added_at'] = date('Y-m-d H:i:s');
				$inserted = $this->commonmodel->insertRecord('tbl_cb_uni_student', $post);
				if($inserted){
					session()->setFlashdata(['message'=>'University details added successfuly','type'=>'success']);
				}else{
					session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
				}
			}else{
				$post['update_at'] = date('Y-m-d H:i:s');
				$updated = $this->commonmodel->updateRecord('tbl_cb_uni_student', $post, ['uni_id'=>$uni_id]);
				if($updated){
					session()->setFlashdata(['message'=>'University details Updated Successfully','type'=>'success']);
				}else{
					session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
				}
			}
			return redirect()->to(base_url('institute/student_view/'.$_POST['stu_id']));
		}else{
			return redirect()->to(base_url('institute/student_listing'));
		}
	}
	public function certified_students(){
		$data['page_title']="Certified Student";
		$data['count_list'] = $this->commonmodel->getAllRecordCount('tbl_admissions_coursefee',['status'=>4]);
		$data['coursess'] = $this->commonmodel->getAllRecord('tbl_course_franchise');
		$data['batches'] = $this->commonmodel->getAllRecord('tbl_insbatch');
		$data['student_list'] = $this->insmanagemodel->get_completed_students_list('', 4);
        // echo '<pre>'; print_r($data['student_list']); exit;
        return view('admin/ins_adm_manage/certified_students', $data);
	}
	public function cancel_cert($id){
		$data = $this->insmanagemodel->get_completed_students_list($id, 4);
		if(!empty($data)){
			$fileName = $data->cert_no.'.pdf';
			if(file_exists(ROOTPATH."public/assets/pdf/".$fileName)){
				unlink(ROOTPATH."public/assets/pdf/".$fileName);
			}
			if($data->course_cat == 'C'){
				$fileName = $data->cert_no.'M.pdf';
				if(file_exists(ROOTPATH."public/assets/pdf/".$fileName)){
					unlink(ROOTPATH."public/assets/pdf/".$fileName);
				}
			}
			$updateData['status'] = 2;
			$updated = $this->commonmodel->updateRecord('tbl_admissions_coursefee',$updateData,['id'=>$id]);
			if($updated){
				session()->setFlashdata(['message'=>'Certificate Canceled!.','type'=>'success']);
			}else{
				session()->setFlashdata(['message'=>'Something went wrong!.','type'=>'danger']);
			}
		}
		return redirect()->to(base_url('institute/completed_students'));
	}
	public function student_i_card($stu_ids){
		$stu_idsArr = json_decode(base64_decode($stu_ids));
		$data['student_list'] =  $this->insmanagemodel->get_student_basic_details($stu_idsArr);
		// echo '<pre>'; print_r($data['student_list']); exit;
        return view('admin/ins_adm_manage/student_i_card', $data);
	}

	//for developer
	public function testcbcert(){
		$mpdfController = new MpdfController();
		$courseDtls = $this->insmanagemodel->get_completed_students_list(2,4);
		// print_r($courseDtls); exit;
		$mpdfController->create_cb_test_pdf($courseDtls);
	}
	public function testcbmarksheet(){
		$mpdfController = new MpdfController();
		$courseDtls = $this->insmanagemodel->get_completed_students_list(2,4);
		// print_r($courseDtls); exit;
		$mpdfController->create_cb_marksheet_test_pdf($courseDtls);
	}
	public function testtypecert(){
		$mpdfController = new MpdfController();
		$courseDtls = $this->insmanagemodel->get_completed_students_list(5);
		$mpdfController->create_cb_typing_test_pdf($courseDtls);
	}
	

	function curl_executer($config){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $config['url'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $config['method'],
		  CURLOPT_POSTFIELDS => $config['data'],
		  CURLOPT_HTTPHEADER => array(
			'ERP-API-KEY: erp@#9_56$24',
			'Cookie: ci_session=13bd3fef47e1d5d0cdeddc6fc36989386898d9dc'
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		return $response;
	}
	public function testapi(){
		$curl_config = [
			'url' => "https://erp.webpanelsolutions.com/api/example/employee",
			'method' => 'GET',
			'data' => []
		];
		$res = $this->curl_executer($curl_config);
		echo $res;
	}
	/*public function update_course(){ // for developer
		$courses = $this->commonmodel->getAllRecord('tbl_courses_of_erp');
		
		$data = [];
		foreach($courses as $list){
			$data = [];
			$data['c_name'] = $list->course_name;
			$data['course_duration'] = $list->duration;
			$data['course_cat'] = 'C';
			$data['c_f_name'] = $list->course_name;
			$data['course_fee'] = $list->course_fee;
			$data['status'] = 1;
			$data['added_at'] = date('Y-m-d H:i:s');
			$this->commonmodel->insertRecord('tbl_course_franchise', $data);
		}
		$courses = $this->commonmodel->getAllRecord('tbl_course_franchise');
		echo '<pre>'; print_r($courses); exit;
	}*/
	
}