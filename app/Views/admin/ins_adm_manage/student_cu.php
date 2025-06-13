<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between my-3">
        <h1 class="h3 mb-0 text-gray-800"><?= isset($student)?'Edit Student ':'Add Student';echo (isset($student))?'('.$student->stu_name.')':''; ?></h1>
        <?php /*if(is_privilege(29,2)){ ?>
            <a href="<?=base_url('institute/student_cu')?>" class="btn btn-primary">Add Students</a>
        <?php }*/ ?>
    </div>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <div class="card mb-1">
        <div class="card-body">
            <nav>
                <?php $active1 = $showactive1 = $active2 = $showactive2 = '';
                if(isset($student) && $student->active_tab == 2){
                    $active2 = 'active';
                    $showactive2 = 'show active';
                }else{
                    $active1 = 'active';
                    $showactive1 = 'show active';
                }
                ?>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link <?=$active1?>" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" <?=(isset($student))?'onclick="update_activetab('.$student->stu_id.',1)"':''?> >Personal Details & Qualification</a>
                    <a class="nav-item nav-link <?=$active2?>" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" <?=(isset($student))?'onclick="update_activetab('.$student->stu_id.',2)"':''?>>Fee Details & Others</a>
                
                </div>
            </nav>
            
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade <?=$showactive1?>" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <form class="user" method="post" action="<?=current_url();?>" enctype="multipart/form-data">
                <?=csrf_field()?>
                <input type="hidden" name="form_submit" value="basic">
                
                <h3 class="py-2">I. Personal Details:</h3>
                <p class="text-danger">* Fields are mandatory:</p>
                <div class="form-group row">
                    <label for="stu_image" class="col-sm-2 mb-3 mb-sm-0">Student's Photo:</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" id="stu_image" placeholder="Student's Photo" name="stu_image" >
                        
                    </div>
                    <?php if(isset($student) && $student->stu_image != ''){ ?>
                    <div class="col-sm-6">
                        <img src="<?=base_url('public/assets/upload/images/'.$student->stu_image)?>" alt="image" width="100px;" height="80px;">
                    </div>
                    <?php } ?>
                </div>
                <div class="form-group row">
                    <label for="stu_name" class="col-sm-2 mb-3 mb-sm-0">Student's Name:<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="stu_name" placeholder="Student's Name" name="stu_name" value="<?=set_value('stu_name',isset($student)?$student->stu_name:''); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'stu_name') : '' ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="f_name" class="col-sm-2 mb-3 mb-sm-0">Father's Name:<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="f_name" placeholder="Father's Name" name="f_name" value="<?=set_value('f_name',isset($student)?$student->f_name:''); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'f_name') : '' ?></span>
                    </div>
                    <label for="m_name" class="col-sm-2 mb-3 mb-sm-0">Mother's Name:<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="m_name" placeholder="Mother's Name" name="m_name" value="<?=set_value('m_name',isset($student)?$student->m_name:''); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'm_name') : '' ?></span>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="dob" class="col-sm-2 mb-3 mb-sm-0">DOB:<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="dob" placeholder="DOB" name="dob" value="<?=set_value('dob',isset($student)?date('d/m/Y',strtotime($student->dob)):''); ?>" autocomplete="off">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dob') : '' ?></span>
                    </div>
                
                    <label for="age" class="col-sm-2 mb-3 mb-sm-0">Age:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="age" placeholder="Age" name="age" value="<?=set_value('age',isset($student)?$student->age:''); ?>" readonly>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone1" class="col-sm-2 mb-3 mb-sm-0">Mobile:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="phone1" placeholder="Mobile" name="phone1" value="<?=set_value('phone1',isset($student)?$student->phone1:''); ?>">
                        
                    </div>
                    <label for="phone2" class="col-sm-2 mb-3 mb-sm-0">Alternative Mobile:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="phone2" placeholder="Alternative Mobile" name="phone2" value="<?=set_value('phone2',isset($student)?$student->phone2:''); ?>">
                        
                    </div>
                </div>
                <?php /* <div class="form-group row">
                    <label for="email" class="col-sm-2 mb-3 mb-sm-0">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?=set_value('email',isset($student)?$student->email:''); ?>">
                        <?php  echo form_error('email');  ?>
                    </div>
                    
                </div> */ ?>
                <div class="form-group row">
                    <label for="co_address" class="col-sm-2 mb-3 mb-sm-0">Co Address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="co_address" placeholder="Correspondence Address" name="co_address" value="<?=set_value('co_address',isset($student)?$student->co_address:''); ?>">
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="p_address" class="col-sm-2 mb-3 mb-sm-0">P Address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="p_address" placeholder="Permanent Address" name="p_address" value="<?=set_value('p_address',isset($student)?$student->p_address:''); ?>">
                        
                    </div>
                </div>
                <h3 class="py-2"> II. Qualification:</h3>
                <div class="form-group row">
                    <label for="qualification" class="col-sm-2 mb-3 mb-sm-0">Last Qualification:</label>
                    <div class="col-sm-10">
                        <select name="qualification" id="qualification" class="form-control">
                        <option value="">Select Qualification</option>
                        <?php if(!empty($qualifications)){
                            foreach($qualifications as $list){ 
                            $true = (isset($student) && $student->qualification == $list->qly_id)?true:''?>
                            <option value="<?=$list->qly_id?>" <?=set_select('qualification',$list->qly_id,$true)?>><?=$list->qualification?></option>
                        <?php }
                        } ?>
                        <option value="other">Other</option>
                        </select>
                        
                        
                    </div>
                </div>
                <div class="form-group row" style="display:none;" id="other_qly">
                    <label for="other_qly" class="col-sm-2 mb-3 mb-sm-0">Other Qualification: </label> 
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="other_qly" value="" placeholder="Enter Other Qualification">
                    </div>    
                </div>
                <div class="form-group row">
                    <label for="refrence" class="col-sm-2 mb-3 mb-sm-0">Refrence (if is): </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="refrence" placeholder="Refrence" name="refrence" value="<?=set_value('refrence',isset($student)?$student->refrence:''); ?>" autocomplete="off">
                    </div>
                </div>
                <h3 class="py-2"> III. Status:</h3>
                <div class="form-group row">
                    <label for="image" class="col-sm-2 mb-3 mb-sm-0">Status:<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" checked >
                        <label class="form-check-label" for="exampleRadios1">
                        Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0" <?=set_radio('status',0,(isset($student) && $student->status==0)?TRUE:'') ?>>
                        <label class="form-check-label" for="exampleRadios2">
                        InActive
                        </label>
                    </div>
                    
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="Reset" class="btn btn-secondary">Reset</button>
                <a href="<?=base_url('institute/students') ?>" class="btn btn-warning">Cancel</a>
                </form>

                </div> <!-- End Home Tab -->

                <div class="tab-pane fade <?=$showactive2?>" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="card">
                    <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3>Course List</h3>
                        <div>
                        <?php if(isset($student->stu_id)){ ?>
                        <a href="<?=base_url('institute/student_cu/'.$student->stu_id)?>" class="btn btn-warning btn-sm">Reset</a>
                        <a href="<?=base_url('institute/student_view/'.$student->stu_id)?>" class="btn btn-info btn-sm">View</a>
                        <?php } ?>
                        <a href="<?=base_url('/institute/students')?>" class="btn btn-primary btn-sm">Back</a>
                        </div>
                    </div>
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered table-responsive">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Batch No</th>
                            <th scope="col">Course</th>
                            <th scope="col">Course Fee</th>
                            <th scope="col">Admission Fee</th>
                            <th scope="col">Total Fee</th>
                            <th scope="col">Total Paid</th>
                            <th scope="col">Total Dues</th>
                            <th scope="col">Payment Type</th>
                            <th scope="col">Total Installment</th>
                            <th scope="col">Installment Amount</th>
                            <!-- <th scope="col">Receipt No</th>
                            <th scope="col">Description</th> -->
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($courseList)){ $sn = 1;
                            foreach($courseList as $list){ ?>
                            <tr>
                                <td><?=$sn++; ?></td>
                                <td><?=date('d-m-Y',strtotime($list->added_at))?></td>
                                <td><?=($list->course_type == 'NR')?'<span class="badge badge-danger">Non-Regular</span>':$list->batch_name?></td>
                                <td><?=strtoupper($list->c_f_name)?></td>
                                <td><?=$list->course_fee?></td>
                                <td><?=$list->adm_fee?></td>
                                <td><?=$list->total_fee?></td>
                                <td><?=$list->paid_amount?></td>
                                <td><?=$list->dues_amount?></td>
                                <td><?=$list->payment_type?></td>
                                <td><?=$list->total_installment?></td>
                                <td><?=$list->ins_amount?></td>
                                <!-- <td><?=$list->receipt_no?></td>
                                <td><?=$list->description?></td> -->
                                
                                <td><?=get_student_status($list->status)?></td>
                                <td>
                                <?php if($list->status != 2 && $list->status != 4){ ?>
                                <a href="<?=base_url('institute/student_cu/'.$student->stu_id.'/'.$list->id)?>" title="edit"><i class="fas fa-edit"></i></a>
                                <?php } ?>
                                </td>
                            </tr>
                        <?php }
                        }else{
                            echo '<tr><td colspan="14" class="text-danger text-center">No Course</td></tr>';
                        } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <h3 class="py-2"> I. <?=(isset($singleCourse))?'Edit':'Add'?> Course Details:</h3>
                <p class="text-danger">* Fields are mandatory:</p>
                <form class="user" method="post" action="<?=current_url();?>" enctype="multipart/form-data">
                  <?=csrf_field(); ?>
                <input type="hidden" name="form_submit" value="coursefee">
                <div class="form-group row">
                  <div class="col-md-6">
                    <input type="hidden" name="stu_id" value="<?=set_value('stu_id',(isset($student->stu_id))?$student->stu_id:'')?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'stu_id') : '' ?></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="course_type" class="col-sm-2 mb-3 mb-sm-0">Course Type: <span class="text-danger">*</span></label>
                  <div class="col-sm-4">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="course_type" id="course_type1" value="R" checked>
                      <label class="form-check-label" for="course_type1">Regular </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="course_type" id="course_type2" value="NR" <?=((isset($singleCourse) && $singleCourse->course_type == 'NR') || (isset($_POST['course_type']) && $_POST['course_type'] == 'NR'))?'checked':'';?>>
                      <label class="form-check-label" for="course_type2">Non-Regular</label>
                    </div>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_type') : '' ?></span>
                  </div>
                </div>
                <div style="<?=((isset($singleCourse) && $singleCourse->course_type == 'NR') || (isset($_POST['course_type']) && $_POST['course_type'] == 'NR'))?'display:none':'';?>"id="rDiv"> <!-- for Regular course -->

                  <div class="form-group row">
                      <label for="batch_id" class="col-sm-2 mb-3 mb-sm-0">Batch: <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                          <select name="batch_id" id="batch_id" class="form-control">
                          <option value="">Select Batch</option>
                          <?php if(!empty($batches)){
                              foreach($batches as $list){ 
                              $true = (isset($singleCourse) && $singleCourse->batch_id == $list->batch_id)?true:'' ?>
                              <option value="<?=$list->batch_id?>" <?=set_select('batch_id',$list->batch_id,$true)?>><?=$list->batch_name?></option>
                          <?php }
                          } ?>
                          </select>
                          <span class="text-danger"><?= isset($validation) ? display_error($validation, 'batch_id') : '' ?></span>
                      </div>
                  </div>

                  <?php if(!isset($singleCourse) || (isset($singleCourse) && $singleCourse->is_change_fee == 'yes')){ ?>
                  <div class="form-group row">
                      <label for="course_id" class="col-sm-2 mb-3 mb-sm-0">Course: <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                          <select name="course_id" id="course_id" class="form-control">
                          <option value="">Select course</option>
                          <?php if(!empty($coursess)){
                              foreach($coursess as $list){ 
                              $selected = (isset($singleCourse) && $singleCourse->course_id == $list->cid)?'selected':''?>
                              <option value="<?=$list->cid?>" <?=$selected?>><?=$list->c_f_name?></option>
                          <?php }
                          } ?>
                          </select>
                          <input type="hidden" name="ini_course_id" value="<?=(isset($singleCourse))?$singleCourse->course_id:''?>">
                          <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_id') : '' ?></span>
                          
                      </div>
                  </div>
                  
                  <div class="form-group row">
                      <label for="course_fee" class="col-sm-2 mb-3 mb-sm-0">Course Fee: <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                      <input type="text" name="course_fee" id="course_fee" class="form-control" value="<?=(isset($singleCourse))?$singleCourse->course_fee:set_value('course_fee')?>">
                      
                      <input type="hidden" name="ini_course_fee" value="<?=(isset($singleCourse))?$singleCourse->course_fee:''?>">
                      <span class="text-danger" id="course_fee_error"><?= isset($validation) ? display_error($validation, 'course_fee') : '' ?></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="adm_fee" class="col-sm-2 mb-3 mb-sm-0">Admission Fee: </label>
                      <div class="col-sm-4">
                      <input type="text" name="adm_fee" id="adm_fee" class="form-control" value="<?=(isset($singleCourse) && $singleCourse->adm_fee != '')?$singleCourse->adm_fee:$settings->course_adm_fee?>">
                      <!-- <span><strong id="adm_fee"></strong></span> -->
                      <input type="hidden" name="ini_adm_fee" value="<?=(isset($singleCourse))?$singleCourse->adm_fee:''?>">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="upfront_payment" class="col-sm-2 mb-3 mb-sm-0">Upfront Payment: <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                      <input type="text" class="form-control" name="upfront_payment" id="upfront_payment" value="<?=(isset($singleCourse))?$singleCourse->paid_amount:set_value('upfront_payment')?>">
                      
                      <input type="hidden" name="ini_upfront_payment" value="<?=(isset($singleCourse))?$singleCourse->paid_amount:''?>">
                      <span class="text-danger"><?= isset($validation) ? display_error($validation, 'upfront_payment') : '' ?></span>
                      </div>
                  </div>
                
                  <?php $checked1 = $checked2 = '';
                  if(isset($singleCourse) && $singleCourse->payment_type == 'fnf'){
                      $checked1 = TRUE;
                  }
                  if(isset($singleCourse) && $singleCourse->payment_type == 'installment'){
                      $checked2 = TRUE;
                  } ?>
                  <div class="form-group row">
                      <label for="payment_type" class="col-sm-2 mb-3 mb-sm-0">Payment Type: </label>  
                      <div class="col-sm-4">
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment_type" id="fnf" value="fnf" <?=set_checkbox('payment_type','fnf',$checked1)?>>
                          <label class="form-check-label" for="fnf">
                          FNF-Balance Amount (<span id="fnf_amt"><?=(isset($singleCourse))?$singleCourse->fnf_amount:''?></span>)
                          </label>
                      </div>
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment_type" id="installment_radio" value="installment" <?=set_checkbox('payment_type','installment',$checked2)?>>
                          <label class="form-check-label" for="installment_radio"> 
                          <select name="total_installment" id="total_installment" class="form-control" <?=(isset($singleCourse) && $singleCourse->payment_type == 'fnf')?'disabled':''?>>
                              <option value="">Installment</option>
                              <?php if(isset($courseDtls)){
                              $course_duration = $courseDtls->course_duration;
                              $fnf_amount = $singleCourse->fnf_amount;
                              for($i = $course_duration-1; $i >= 1; $i--){
                                  $selected = ($i == $singleCourse->total_installment)?'selected':'';
                                  $ins_amount = $fnf_amount/$i; ?>
                                  <option value="<?=$i?>" <?=$selected?>><?=round($ins_amount).' X '.$i?></option>
                              <?php }
                              } ?>
                          </select>
                          <input type="hidden" name="ini_payment_type" value="<?=(isset($singleCourse))?$singleCourse->payment_type:''?>">
                          <input type="hidden" name="ini_total_installment" value="<?=(isset($singleCourse))?$singleCourse->total_installment:''?>">
                          </label>  
                          
                      </div>
                      </div>
                      <div class="col-sm-6" id="show_installment" style="<?=(isset($singleCourse) && $singleCourse->payment_type == 'fnf')?'display:none':''?>">
                      <p class="text-primary">Total Installment : <span id="ins_no"><?=(isset($singleCourse))?$singleCourse->total_installment:''?></span></p>
                      <p class="text-primary">Installment Amount : <span id="ins_amt"><?=(isset($singleCourse))?$singleCourse->ins_amount:''?></span></p>
                      <input type="hidden" name="ins_amount" value="<?=(isset($singleCourse))?$singleCourse->ins_amount:''?>" id="ins_amount">
                      <input type="hidden" name="ini_ins_amount" value="<?=(isset($singleCourse))?$singleCourse->ins_amount:''?>">
                      <input type="hidden" name="fnf_amount" value="<?=(isset($singleCourse))?$singleCourse->fnf_amount:''?>" id="fnf_amount">
                      <input type="hidden" name="ini_fnf_amount" value="<?=(isset($singleCourse))?$singleCourse->fnf_amount:''?>" >
                      </div>
                  </div>
                  
                  <div class="form-group row">
                      <label for="" class="col-sm-2 mb-3 mb-sm-0">Receipt No: <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                      <input type="text" class="form-control" name="receipt_no" value="<?=isset($singleCourse)?$singleCourse->receipt_no:set_value('receipt_no');?>" placeholder="Receipt No">
                      
                      <input type="hidden" name="ini_receipt_no" value="<?=isset($singleCourse)?$singleCourse->receipt_no:''; ?>">
                      <span class="text-danger"><?= isset($validation) ? display_error($validation, 'receipt_no') : '' ?></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="adm_date" class="col-sm-2 mb-3 mb-sm-0">Admission Date: <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="adm_date" placeholder="mm/dd/yy" name="adm_date" value="<?=set_value('adm_date',isset($singleCourse)?$singleCourse->adm_date:''); ?>" autocomplete="off">
                          
                          <input type="hidden" name="ini_adm_date" value="<?=isset($singleCourse)?$singleCourse->adm_date:''; ?>">
                          <span class="text-danger"><?= isset($validation) ? display_error($validation, 'adm_date') : '' ?></span>
                      </div>
                  </div>
                  <?php /* <div class="form-group row">
                      <label for="description" class="col-sm-2 mb-3 mb-sm-0">Comment about fee: </label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="description" placeholder="Comment about fee" name="description" value="<?=set_value('description',isset($singleCourse->description)?$singleCourse->description:''); ?>" autocomplete="off">
                          <?php  echo form_error('description');  ?>
                      </div>
                  </div> */ ?>
                  <?php } ?>
                  <?php if(isset($singleCourse) && $singleCourse->is_change_fee == 'no'){ ?>
                  <div class="form-group row">
                      <label for="course_id" class="col-sm-2 mb-3 mb-sm-0">Course: </label>
                      <div class="col-sm-4">
                          <p><?=(isset($singleCourse))?$singleCourse->c_f_name:''?></p>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="course_fee" class="col-sm-2 mb-3 mb-sm-0">Course Fee: </label>
                      <div class="col-sm-4">
                      <p><?=(isset($singleCourse))?$singleCourse->course_fee:''?></p>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="adm_fee" class="col-sm-2 mb-3 mb-sm-0">Admission Fee: </label>
                      <div class="col-sm-4">
                      <p><?=(isset($singleCourse))?$singleCourse->adm_fee:''?></p>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="upfront_payment" class="col-sm-2 mb-3 mb-sm-0">Upfront Payment: </label>
                      <div class="col-sm-4">
                      <p><?=(isset($singleCourse))?$singleCourse->paid_amount:''?></p>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="payment_type" class="col-sm-2 mb-3 mb-sm-0">Payment Type: </label>  
                      <div class="col-sm-4">
                      <p><?=(isset($singleCourse) && $singleCourse->payment_type == 'fnf')?'FNF':'Installment'?></p>
                      </div>
                  </div>

                  <?php if(isset($singleCourse) && $singleCourse->payment_type == 'fnf'){ ?>
                  <div class="form-group row">
                      <label for="fnf_amount" class="col-sm-2 mb-3 mb-sm-0">FNF Amount: </label>  
                      <div class="col-sm-4">
                      <p><?=(isset($singleCourse))?$singleCourse->fnf_amount:''?></p>
                      </div>
                  </div>
                  <?php }else{ ?>
                  <div class="form-group row">
                      <label for="total_installment" class="col-sm-2 mb-3 mb-sm-0">Total Installment: </label>  
                      <div class="col-sm-4">
                      <p><?=(isset($singleCourse))?$singleCourse->total_installment:''?></p>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="ins_amount" class="col-sm-2 mb-3 mb-sm-0">Installment Amount: </label>  
                      <div class="col-sm-4">
                      <p><?=(isset($singleCourse))?$singleCourse->ins_amount:''?></p>
                      </div>
                  </div>
                  <?php } ?>
                  <div class="form-group row">
                      <label for="" class="col-sm-2 mb-3 mb-sm-0">Receipt No: </label>
                      <div class="col-sm-4">
                      <p><?=(isset($singleCourse))?$singleCourse->receipt_no:''?></p>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="adm_date" class="col-sm-2 mb-3 mb-sm-0">Admission Date: </label>
                      <div class="col-sm-4">
                          <p><?=(isset($singleCourse))?date('d M-Y',strtotime($singleCourse->adm_date)):''?></p>
                      </div>
                  </div>
                  <?php } ?>
                </div> <!-- End for Regular course -->

                <div style="<?=((isset($singleCourse) && $singleCourse->course_type == 'NR') || (isset($_POST['course_type']) && $_POST['course_type'] == 'NR'))?'':'display:none';?>" id="nrDiv"><!-- for Non-Regular course -->
                  <div class="form-group row">
                      <label for="course_id2" class="col-sm-2 mb-3 mb-sm-0">Course: <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                          <select name="course_id2" id="course_id2" class="form-control">
                          <option value="">Select course</option>
                          <?php if(!empty($coursess)){
                              foreach($coursess as $list){ 
                              $selected = (isset($singleCourse) && $singleCourse->course_id == $list->cid)?'selected':''?>
                              <option value="<?=$list->cid?>" <?=$selected?>><?=$list->c_f_name?></option>
                          <?php }
                          } ?>
                          </select>
                          <?php /* <input type="hidden" name="ini_course_id" value="<?=(isset($singleCourse))?$singleCourse->course_id:''?>"> */ ?>
                          <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_id2') : '' ?></span>
                          
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="course_fee2" class="col-sm-2 mb-3 mb-sm-0">Course Fee: <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                      <input type="text" name="course_fee2" id="course_fee2" class="form-control" value="<?=(isset($singleCourse))?$singleCourse->course_fee:set_value('course_fee2')?>">
                      
                      <?php /* <input type="hidden" name="ini_course_fee" value="<?=(isset($singleCourse))?$singleCourse->course_fee:''?>"> */ ?>
                      <span class="text-danger" id="course_fee_error2"><?= isset($validation) ? display_error($validation, 'course_fee2') : '' ?></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="upfront_payment2" class="col-sm-2 mb-3 mb-sm-0">Upfront Payment: <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                      <input type="text" class="form-control" name="upfront_payment2" id="upfront_payment2" value="<?=(isset($singleCourse))?$singleCourse->paid_amount:set_value('upfront_payment2')?>">
                      
                      <?php /* <input type="hidden" name="ini_upfront_payment" value="<?=(isset($singleCourse))?$singleCourse->paid_amount:''?>"> */ ?>
                      <span class="text-danger"><?= isset($validation) ? display_error($validation, 'upfront_payment2') : '' ?></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="receipt_no2" class="col-sm-2 mb-3 mb-sm-0">Receipt No: <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                      <input type="text" class="form-control" name="receipt_no2" id="receipt_no2" value="<?=isset($singleCourse)?$singleCourse->receipt_no:set_value('receipt_no2');?>" placeholder="Receipt No">
                      
                      <?php /* <input type="hidden" name="ini_receipt_no" value="<?=isset($singleCourse)?$singleCourse->receipt_no:''; ?>"> */ ?>
                      <span class="text-danger"><?= isset($validation) ? display_error($validation, 'receipt_no2') : '' ?></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="adm_date2" class="col-sm-2 mb-3 mb-sm-0">Date: <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="adm_date2" placeholder="mm/dd/yy" name="adm_date2" value="<?=set_value('adm_date2',isset($singleCourse)?$singleCourse->adm_date:''); ?>" autocomplete="off">
                          
                          <?php /* <input type="hidden" name="ini_adm_date" value="<?=isset($singleCourse)?$singleCourse->adm_date:''; ?>"> */ ?>
                          <span class="text-danger"><?= isset($validation) ? display_error($validation, 'adm_date2') : '' ?></span>
                      </div>
                  </div>

                </div><!-- End for Non-Regular course -->

                <h3 class="py-2"> II. Course Status:</h3>
                <div class="form-group row">
                    <label for="image" class="col-sm-2 mb-3 mb-sm-0">Status:<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                        Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0" <?=set_radio('status',0,(isset($singleCourse) && $singleCourse->status==0)?TRUE:'') ?>>
                        <label class="form-check-label" for="exampleRadios2">
                        InActive
                        </label>
                    </div>
                    
                    </div>
                </div>
                <input type="hidden" name="is_change_fee" value="<?=(isset($singleCourse))?$singleCourse->is_change_fee:'yes'?>">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="Reset" class="btn btn-secondary">Reset</button>
                <a href="<?=base_url('institute/students') ?>" class="btn btn-warning">Cancel</a>
                </form>
                </div> <!-- End Profile Tab -->

                <!-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">Contact</div> -->

            </div>
        </div> <!-- End Card Body -->
      </div>
    </div>
  </div>
  <!---Container Fluid-->

<!-- Modal -->
<div class="modal fade" id="changestatusModal" tabindex="-1" role="dialog" aria-labelledby="changestatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-light" id="changestatusModalLabel">Change Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=current_url();?>" method="post" >
        <?=csrf_field(); ?>
        <input type="hidden" name="ids" value="" id="ids">
        <input type="hidden" name="submit" value="changeStatus" id="changeStatus">
        <div class="modal-body">
          <!-- <div class="form-group row">
              <label for="stu_name" class="col-md-2">Name: </label>
              <div class="col-md-10">
                <p><strong id="stu_name"></strong></p>
              </div>
          </div> -->
          <div class="form-group row">
              <label for="status" class="col-md-2">Status: </label>
              <div class="col-md-10 ">
                <select name="status" id="status" class="form-control">
                  <option value="1" >Active</option>
                  <option value="0">Inactive</option>
                </select>
                <span class="text-danger" id="frst_statusErr"></span>
              </div>
          </div>
          <?php /* <div class="form-group row">
              <label for="stu_name" class="col-md-2">Description: </label>
              <div class="col-md-10 ">
                <input type="text" name="description" id="description" class="form-control" value="">
              </div>
          </div> */ ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#batch_id').multiselect({		
        nonSelectedText: 'Select Batch',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        buttonWidth: '100%',
        maxWidth: 650,
        maxHeight: 350,				
        });
        $('#course_id').multiselect({		
        nonSelectedText: 'Select Course',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        buttonWidth: '100%',
        maxWidth: 650,
        maxHeight: 350,				
        });
    });

    function update_activetab(stu_id, tabno){
        $.ajax({
        type: "POST",
        url: "<?=base_url('institute/update_activetab')?>",
        data: {stu_id:stu_id, tabno:tabno},
        success: function(res){
            console.log(res);
        }
        });
    }
</script>
<script type="text/javascript">
  $=jQuery;
  var course_duration = <?=(isset($courseDtls))?$courseDtls->course_duration:0?>;
  var fnf_bal = <?=(isset($student) && $student->fnf_amount != '')?$student->fnf_amount:0?>;
  
  // alert(adm_fee);
  $(function(){
      $("#dob").datepicker({
        dateFormat: 'mm/dd/yy',
        todayHighlight: true,
      });
  });
  $(function(){
      $("#adm_date, #adm_date2").datepicker({
        dateFormat: 'mm/dd/yy',
        todayHighlight: true,
      });
  });
  $(function(){
      $("#dob").change(function(){
        var dob = $("#dob").val();
        var dob = new Date(dob);
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#age').val(age);
      });
  });
 
  $("#qualification").change(function(){
    var qly = $("#qualification").val();
    if(qly == 'other'){
      $("#other_qly").show();
    }else{
      $("#other_qly").hide();
    }
  });

  $("#course_id").change(function(){
    var course_id = $(this).val();
    var adm_fee = $("#adm_fee").val();
    //$("#course_fee, #adm_fee, #total_fee, #ins_fee").html('loading...');
    $("#course_fee").val('');
    $("#course_fee_error").html('');
    if(course_id){
      $.ajax({
        type: 'post',
        url: '<?=base_url("institute/get_course_details");?>',
        data: {course_id:course_id},
        dataType: 'json',
        cache: 'false',
        success: function(result){
          console.log(result);
          if(result.course_details != undefined){
            $("#course_fee").val(result.course_details.course_fee);
            var course_fee = result.course_details.course_fee;
            var upfront_pay = ((parseInt(course_fee) * 20)/100) + parseInt(adm_fee);
            $("#upfront_payment").val(parseInt(upfront_pay));
            fnf_bal = parseInt(course_fee)+parseInt(adm_fee)-parseInt(upfront_pay);
            $("#fnf_amt").html(parseInt(fnf_bal));
            course_duration = parseInt(result.course_details.course_duration);
            let inshtml = '';
            for(var i = course_duration - 1; i >= 1; i--){
              var ins_amount = parseInt(fnf_bal)/i;
              inshtml = inshtml.concat('<option value="'+i+'">'+Math.round(ins_amount).toString()+' X '+i.toString()+'</option>');
            }
            $("#total_installment").html(inshtml);
            update_installment_text();
            //var installment = parseInt(fnf_bal)/parseInt(course_duration-1);
            //$("#ins_amt").html(parseInt(installment)+' X '+parseInt(course_duration-1));
            $("#fnf").prop('checked',true);
            $("#show_installment").hide();
            $("#total_installment").attr('disabled', true);
          }
          if(result.error != undefined){
            $("#course_fee_error").html(result.error);
            
          }
        }
      });
    }else{
      $("#course_fee_error").html('Please select course...');
      value_clear();
      //$("#upfront_payment").val('');
      //$("#fnf_amt").html('');
      //$("#ins_amt").html('');
      //$("#payable_amount").val('');
      //$("#fnf").prop('checked',false);
    }
  });
  $("#course_fee, #adm_fee").keyup(function(){
    var course_fee = $("#course_fee").val();
    var adm_fee = $("#adm_fee").val();
    if(adm_fee == ''){
      adm_fee = 0;
    }
    if(course_fee){
      var upfront_pay = ((parseInt(course_fee) * 20)/100) + parseInt(adm_fee);
      $("#upfront_payment").val(parseInt(upfront_pay));
      fnf_bal = parseInt(course_fee)+parseInt(adm_fee)-parseInt(upfront_pay);
      $("#fnf_amt").html(parseInt(fnf_bal));
      let inshtml = '';
      for(var i = course_duration - 1; i >= 1; i--){
        var ins_amount = parseInt(fnf_bal)/i;
        inshtml = inshtml.concat('<option value="'+i+'">'+Math.round(ins_amount).toString()+' X '+i.toString()+'</option>');
      }
      $("#total_installment").html(inshtml);
      $("#fnf").prop('checked',true);
      update_installment_text();
      $("#show_installment").hide();
      $("#total_installment").attr('disabled', true);
    }else{
      value_clear();
    }
  });
  $("#upfront_payment").keyup(function(){
    var course_id = $("#course_id").val();
    var adm_fee = $("#adm_fee").val();
    if(course_id){
        var upfront_pay = $(this).val();
        if(upfront_pay == ''){
          upfront_pay = 0;
        }
        var course_fee = $("#course_fee").val();
        fnf_bal = parseInt(course_fee)+parseInt(adm_fee)-parseInt(upfront_pay);
        $("#fnf_amt").html(parseInt(fnf_bal));
        let inshtml = '';
        for(var i = course_duration - 1; i >= 1; i--){
          var ins_amount = parseInt(fnf_bal)/i;
          inshtml = inshtml.concat('<option value="'+i+'">'+Math.round(ins_amount).toString()+' X '+i.toString()+'</option>');
        }
        $("#total_installment").html(inshtml);
        $("#fnf").prop('checked',true);
        update_installment_text();
        $("#show_installment").hide();
        $("#total_installment").attr('disabled', true);
    }else{
      $("#course_fee_error").html('Please select course...');
      $("#upfront_payment").val('');
    }
  });

  $('input[name=payment_type]').change(function(){
    var course_id = $("#course_id").val();
    if(course_id){
      var payment_type = $(this).val();
      if(payment_type == 'fnf'){
        $("#total_installment").attr('disabled', true);
        $("#show_installment").hide();
      }else{
        $("#total_installment").removeAttr('disabled');
        
        $("#show_installment").show();
      }
    }else{
      $("#course_fee_error").html('Please select course...');
      $('input[name=payment_type][value=fnf]').prop('checked', false);
      $('input[name=payment_type][value=installment]').prop('checked', false);
    }
  });
  $("#total_installment").change(function(){
    update_installment_text();
    //alert($(this).html());
  });

  function value_clear(){
    $("#upfront_payment").val('');
    $("#fnf_amt").html('');
    //$("#ins_amt").html('');
    $("#fnf").prop('checked',false);
  }
  function update_installment_text(){
    var total_installment = $("#total_installment").val();
    $("#ins_no").html(total_installment);
    var ins_amount = Math.round(parseFloat(parseInt(fnf_bal)/parseInt(total_installment)));
    $("#ins_amt").html(ins_amount);
    $("#ins_amount").val(ins_amount);
    $("#fnf_amount").val(fnf_bal);
  }
  //for non regular course
  $('input[name=course_type]').change(function(){
    var course_type = $(this).val();
    if(course_type == 'R'){
      $("#rDiv").show();
      $("#nrDiv").hide();
    }else{
      $("#nrDiv").show();
      $("#rDiv").hide();
    }
  });
  $("#course_id2").change(function(){
    var course_id = $(this).val();
    // var adm_fee = $("#adm_fee").val();
    //$("#course_fee, #adm_fee, #total_fee, #ins_fee").html('loading...');
    $("#course_fee2").val('');
    $("#course_fee_error2").html('');
    if(course_id){
      $.ajax({
        type: 'post',
        url: '<?=base_url("institute/get_course_details");?>',
        data: {course_id:course_id},
        dataType: 'json',
        cache: 'false',
        success: function(result){
          console.log(result);
          if(result.course_details != undefined){
            $("#course_fee2").val(result.course_details.course_fee);
            // var course_fee = result.course_details.course_fee;
            // var upfront_pay = ((parseInt(course_fee) * 20)/100) + parseInt(adm_fee);
            // $("#upfront_payment").val(parseInt(upfront_pay));
            // fnf_bal = parseInt(course_fee)+parseInt(adm_fee)-parseInt(upfront_pay);
            // $("#fnf_amt").html(parseInt(fnf_bal));
            // course_duration = parseInt(result.course_details.course_duration);
            // let inshtml = '';
            // for(var i = course_duration - 1; i >= 1; i--){
            //   var ins_amount = parseInt(fnf_bal)/i;
            //   inshtml = inshtml.concat('<option value="'+i+'">'+Math.round(ins_amount).toString()+' X '+i.toString()+'</option>');
            // }
            // $("#total_installment").html(inshtml);
            // update_installment_text();
            // //var installment = parseInt(fnf_bal)/parseInt(course_duration-1);
            // //$("#ins_amt").html(parseInt(installment)+' X '+parseInt(course_duration-1));
            // $("#fnf").prop('checked',true);
            // $("#show_installment").hide();
            // $("#total_installment").attr('disabled', true);
          }
          if(result.error != undefined){
            $("#course_fee_error2").html(result.error);
            
          }
        }
      });
    }else{
      $("#course_fee_error2").html('Please select course...');
      // value_clear();
      //$("#upfront_payment").val('');
      //$("#fnf_amt").html('');
      //$("#ins_amt").html('');
      //$("#payable_amount").val('');
      //$("#fnf").prop('checked',false);
    }
  });
</script>

<?=$this->endSection()?>
  