<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use Mpdf\Mpdf;
// use App\Controllers\MpdfController;
class Examination extends BaseController
{
    public $exammodel;
    public $commonmodel;
    public $session;
    public $studentsFranchiseTbl;
    public function __construct()
    {
        date_default_timezone_set('Asia/Kolkata');
        $this->exammodel = model('App\Models\Examination_model', false);
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->studentsFranchiseTbl = 'tbl_students_franchise';
        // $this->gradeTbl = 'tbl_grade_'.session('db_suffix');
        // $this->moduleTbl = 'tbl_module_'.session('db_suffix');
        // $this->certlogTbl = 'tbl_cert_log_'.session('db_suffix');
        // $this->randomcodeTbl = 'tbl_random_code_'.session('db_suffix');
        // $this->coursefranchiseTbl = 'tbl_course_franchise_'.session('db_suffix');
        // $this->data['title'] = 'Admin-Users';
        // $this->adminmodel = model('App\Models\Admin_model', false);
        // $this->membermodel = model('App\Models\Member_model', false);
        // $this->mpdf = new Mpdf();
    }
    public function examination($id){
        $esid = explode('-',base64url_decode($id))[0];
        $exam_sch = $this->exammodel->get_exam_schedule($esid);
        if(!empty($exam_sch)){
            date_default_timezone_set('Asia/Kolkata');
            $exam_date_time_in_sec = strtotime(date('Y-m-d H:i:s', strtotime($exam_sch->date.' '.$exam_sch->time_from)));
            $current_date_time_in_sec = strtotime(date('Y-m-d H:i:s'));
            $total_sec = $exam_date_time_in_sec - $current_date_time_in_sec;

            $exam_date_time = date('Y-m-d H:i:s', strtotime($exam_sch->date.' '.$exam_sch->time_from));
            $current_date_time = date('Y-m-d H:i:s');
            $dt1 = date_create("$exam_date_time");
            $dt2 = date_create("$current_date_time");
            $interval = date_diff($dt2, $dt1);
            $data = array();
            $data['total_sec'] = $total_sec;
            if($total_sec >= 1){
                $d = $interval->d;
                $h = $interval->h;
                if($d >= 1){
                    $h = (24*$d) + $h;
                }
                $data['h'] = $h;
                $data['m'] = $interval->i;
                $data['s'] = $interval->s;
            }else{
                $data['h'] = 0;
                $data['m'] = 0;
                $data['s'] = 0;
            }

            // echo $exam_date_time.'--'.$current_date_time.'<br>'; 
            // exit;
            
            // echo date('Y-m-d H:i:s',$current_date_time); exit;
            
            // echo ("Difference in hours is:");
            // echo $interval->h.':';
            // echo $interval->i.':';
            // echo $interval->s;
            // echo "\n<br/>"; 
            // exit;
            // $msec = $exam_date_time - $current_date_time;
            // $hours = floor($msec / (60*60*60));
            // $minutes = floor(($msec - ($hours*60*60)) / 60);
            // $seconds = ($msec - ($hours*60*60) - ($minutes*60)) % 60;
            // $total_min = floor($msec / 60);
            // $total_min = floor($msec % 60);
            
            
            // echo $total_min; exit;
            if($total_sec >= 900){
                $data['exam_sch'] = $exam_sch;
                $data['section'] = 1;
            }elseif(!session()->has('examinee_id')){
                if($this->request->getMethod() === 'post'){
                    $validation = $this->validate([
                        'reg_no'=>[
                            'rules'=>'required|is_not_unique['.$this->studentsFranchiseTbl.'.reg_no]',
                            'errors'=>[
                                'required'=>'Please provide Reg No',
                                'is_not_unique'=>'This Reg.No is not registered on this system'
                            ]
                            ],
                        'dob'=>[
                            'rules'=>'required',
                            'errors'=>[
                                'required'=>'Please provide DOB',
                            ]
                        ]
                    ]);
                    if(!$validation){
                        $data['validation'] = $this->validator;
                    }else{
                        $exsch_id = $this->request->getPost('exsch_id');
                        $reg_no = $this->request->getPost('reg_no');
                        $dob = $this->request->getPost('dob');
                        $examinee = $this->exammodel->get_examinee($exsch_id,$reg_no, $dob);
                        if(empty($examinee)){
                            session()->setFlashdata('message','<div class="alert alert-danger">Incorrect Reg.No or DOB!</div>');
                            return redirect()->to(current_url())->withInput(); 
                        }elseif($examinee->status == 2){
                            session()->setFlashdata('message','<div class="alert alert-danger">You have done your examination.</div>');
                            return redirect()->to(current_url())->withInput();
                        }else{
                            $param = $examinee->id.'-'.$examinee->exsch_id;
                            $sessionData = array(
                                'examinee_id' => $examinee->id,
                                'exsch_id' => $examinee->exsch_id,
                                'exam_url'=> base_url('pro-examination-begin/'.base64url_encode($param)),
                                'back_url' => $exam_sch->exam_url,
                                'examineelogin' => true,
                            );
                            session()->set($sessionData);
                            if($examinee->status < 1){
                                $this->commonmodel->updateRecord('tbl_examinee',['status'=>1],['id'=>$examinee->id]);
                            }
                            return redirect()->to(current_url());
                        }
                    }
                }
                $data['section'] = 2;
                $data['exam_sch'] = $exam_sch;
            }elseif(session()->has('examinee_id') && $total_sec >= 1 && $total_sec <= 900){
                $data['section'] = 3;
                $data['exam_sch'] = $exam_sch;
                $data['url'] = session('exam_url');
            }elseif(session()->has('examinee_id') && $total_sec < 1){
                return redirect()->to(session('exam_url'));
            }else{
                return redirect()->to('/404');
            }

            return view('examination/first_page', $data);
            
        }else{
            return redirect()->to('/404');
        }
    }
    public function examination_begin($param){
        if(session()->has('examineelogin') && session()->has('examinee_id')){
            $param = explode('-',base64url_decode($param));
            if(session('examinee_id') == $param[0] && session('exsch_id') == $param[1]){
                $examinee_id = session('examinee_id');
                $exsch_id = session('exsch_id');
                $examineeDtls = $this->exammodel->get_examinee_full_details($examinee_id, $exsch_id);
                $exschDtls = $this->commonmodel->getOneRecord('tbl_exam_schedule',['id'=>$exsch_id]);

                $existQues = '';
                if($examineeDtls->ex_submit != ''){
                    $subQuestions = json_decode($examineeDtls->ex_submit);
                    $existQues = implode(',',(array_column($subQuestions, 'qno')));
                }
                $ques_limit = $exschDtls->tot_ques - ($examineeDtls->true_ans + $examineeDtls->false_ans);
                $questions = $this->exammodel->get_questions($exschDtls->course_ids, $ques_limit, $existQues);
                // echo '<pre>'; print_r($questions); exit;
                $data['examineeDtls'] = $examineeDtls;
                $data['exschDtls'] = $exschDtls;
                $data['questions'] = $questions;
                if($this->request->getMethod() === 'post'){
                    $updateData = array();
                    if(isset($_POST['answer']) && !empty($_POST['answer'])){
                        $examinee_id = $_POST['examinee_id'];
                        $tot_ques = $_POST['tot_ques'];
                        $ex_submit = array();
                        $n = $true = $false = $result = 0;
                        foreach($_POST['answer'] as $k=>$ans){
                            $ex_submit[$n]['qno'] = $_POST['qno'][$k];
                            $ex_submit[$n]['q_title_en'] = $_POST['q_title_en'][$k];
                            $ex_submit[$n]['q_title_hn'] = $_POST['q_title_hn'][$k];
                            $ex_submit[$n]['opt1'] = $_POST['opt1'][$k];
                            $ex_submit[$n]['opt2'] = $_POST['opt2'][$k];
                            $ex_submit[$n]['opt3'] = $_POST['opt3'][$k];
                            $ex_submit[$n]['opt4'] = $_POST['opt4'][$k];
                            $ex_submit[$n]['c_ans'] = $_POST['c_ans'][$k];
                            $ex_submit[$n]['answer'] = $_POST['answer'][$k];

                            if($_POST['c_ans'][$k] == $_POST['answer'][$k]){
                                $true++;
                                $ex_submit[$n]['remark'] = 'TRUE';
                            }else{
                                $false++;
                                $ex_submit[$n]['remark'] = 'FALSE';
                            }
                            $n++;
                        }
                        if($true){
                            $result = ($true*100)/$tot_ques;
                        }
                        $updateData['status'] = 2;
                        $updateData['ex_submit'] = json_encode($ex_submit);
                        $updateData['true_ans'] = $true;
                        $updateData['false_ans'] = $false;
                        $updateData['result'] = $result;
                        $updateData['update_at'] = date('Y-m-d H:i:s');
                    }else{
                        $updateData['status'] = 2;
                        $updateData['update_at'] = date('Y-m-d H:i:s');
                    }
                    $update = $this->commonmodel->updateRecord('tbl_examinee',$updateData, ['id'=>$examinee_id]);
                    if($update){
                        $loginItemArray = ['examinee_id','exsch_id','exam_url','back_url','examineelogin'];
                        session()->remove($loginItemArray);
                        session()->setFlashdata('message','<div class="alert alert-danger">You have done your examination.</div>');
                    }else{
                        session()->setFlashdata('message','<div class="alert alert-danger">Something went wrong!</div>');
                    }
                    return redirect()->to($exschDtls->exam_url);
                }
                return view('examination/exam_question', $data);
            }else{
                return redirect()->to('/404');
            }

        }else{
            return redirect()->to('/404');
        }
    }
    public function examination_exit($param){
        $param = explode('-',base64url_decode($param));
        $back_url = session('back_url');
        if(session('examinee_id') == $param[0] && session('exsch_id') == $param[1] ){
            $loginItemArray = ['examinee_id','exsch_id','exam_url','back_url','examineelogin'];
            session()->remove($loginItemArray);
            return redirect()->to($back_url);
        }else{
            return redirect()->to('/404');
        }
    }
    public function update_examinee_duration(){
        if($this->request->getMethod() === 'post'){
            $id = $_POST['id'];
            $h = $_POST['h'];
            $m = $_POST['m'];
            $s = $_POST['s'];
            $duration = date('H:i:s',strtotime($h.':'.$m.':'.$s));
            $this->commonmodel->updateRecord('tbl_examinee', ['duration'=>$duration], ['id'=>$id]);
            exit;
        }
    }
    public function save_result(){
        if($this->request->getMethod() === 'post'){
            if(isset($_POST['answer']) && !empty($_POST['answer'])){
                $examinee_id = $_POST['examinee_id'];
                $tot_ques = $_POST['tot_ques'];
                $ex_submit = $updateData = array();
                $n = $true = $false = $result = 0;
                foreach($_POST['answer'] as $k=>$ans){
                    $ex_submit[$n]['qno'] = $_POST['qno'][$k];
                    $ex_submit[$n]['q_title_en'] = $_POST['q_title_en'][$k];
                    $ex_submit[$n]['q_title_hn'] = $_POST['q_title_hn'][$k];
                    $ex_submit[$n]['opt1'] = $_POST['opt1'][$k];
                    $ex_submit[$n]['opt2'] = $_POST['opt2'][$k];
                    $ex_submit[$n]['opt3'] = $_POST['opt3'][$k];
                    $ex_submit[$n]['opt4'] = $_POST['opt4'][$k];
                    $ex_submit[$n]['c_ans'] = $_POST['c_ans'][$k];
                    $ex_submit[$n]['answer'] = $_POST['answer'][$k];

                    if($_POST['c_ans'][$k] == $_POST['answer'][$k]){
                        $true++;
                        $ex_submit[$n]['remark'] = 'TRUE';
                    }else{
                        $false++;
                        $ex_submit[$n]['remark'] = 'FALSE';
                    }
                    $n++;
                }
                if($true){
                    $result = ($true*100)/$tot_ques;
                }
                // $updateData['status'] = 2;
                $updateData['ex_submit'] = json_encode($ex_submit);
                $updateData['true_ans'] = $true;
                $updateData['false_ans'] = $false;
                $updateData['result'] = $result;
                // $updateData['update_at'] = date('Y-m-d H:i:s');
                $update = $this->commonmodel->updateRecord('tbl_examinee',$updateData, ['id'=>$examinee_id]);
                if($update){
                    $res['update'] = 'true';
                }else{
                    $res['update'] = 'false';
                }
                echo json_encode($res);
            }
        }
    }
}
    // $today = strtotime(date('Y-m-d H:i:s'));
    // $update = strtotime(date('Y-m-d H:i:s', strtotime($t2->added_at)));
    // $time = ($today-$update);
    // $days = floor($time / (24*60*60));
    // $hours = floor(($time - ($days*24*60*60)) / (60*60));
    // $minutes = floor(($time - ($days*24*60*60)-($hours*60*60)) / 60);
    // $seconds = ($time - ($days*24*60*60) - ($hours*60*60) - ($minutes*60)) % 60;
    // $timeText = '';
    // if($days > 0){
    //     $timeText = $days.' day';
    // }else if($hours > 0){
    //     $timeText = $hours.' Hour';
    // }else if($minutes > 0){
    //     $timeText = $minutes.' Minute';
    // }else{
    //     $timeText = $seconds.' Seconds';
    // }