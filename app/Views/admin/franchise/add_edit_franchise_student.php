<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script> 
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Add Student</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">add_edit_franchise_student</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <?php if(session()->getFlashdata('message') !== NULL){
      echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
  } ?>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <!-- <h6 class="m-0 font-weight-bold text-primary">Edit Franchise</h6> -->
          <p class="text-danger">*Fields are mandatory.</p>
            
        </div>
        <div class="card-body">
          
          <form autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <?= form_hidden('is_cert', (isset($student))?$student->is_cert:''); ?>
            <div class="form-group row">
              <div class="col-md-6 ">
                  <div class="form-group my-1">
                      <label class="mb-2">Student Type:<span class="text-danger">*</span></label>
                      <select name="stu_type" id="stu_type" class="form-control">
                          <option value="NR" <?=set_select('stu_type','NR',(isset($student) && $student->stu_type == 'NR')?TRUE:'')?>>Non-Regular</option>
                          <option value="R" <?=set_select('stu_type','R',(isset($student) && $student->stu_type == 'R')?TRUE:'')?>>Regular</option>
                      </select>
                  </div>
              </div>
              <script>
                  $("#stu_type").change(function(){
                      var stu_type = $(this).val();
                      if(stu_type == 'R'){
                          $("#marks_dtls").hide();
                      }else{
                          $("#marks_dtls").show();
                      }
                  });
              </script>
              <div class="col-md-6"></div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Course For:<span class="text-danger">*</span></label>
                <select name="frcourse_id" id="frcourse_id" class="form-control" onchange="fill_course_duration();"> 
                  <?php /* <select name="frcourse_id" id="frcourse_id" class="form-control">*/ ?>
                    <option value="">Select One</option>
                    <?php if(!empty($courses)){
                        foreach($courses as $list){ 
                        $true = ((isset($student) && $student->frcourse_id == $list->cid)?TRUE:'')        
                    ?>
                        <option value="<?=$list->cid?>" data-course_duration="<?=$list->course_duration?>" <?=set_select('frcourse_id', $list->cid, $true)?>><?=$list->c_name.' - '.$list->c_f_name.''?></option>
                    <?php }
                    } ?>
                </select>
                <span class="text-danger"><?=(isset($validation))?$validation->getError('frcourse_id'):''?></span> 
              </div>

              <div class="col-md-6 my-1">
                <label class="mb-2">Course Duration: (In Months) </label>
                <input type="text" class="form-control" name="course_duration" value="<?=set_value('course_duration', isset($student)?$student->course_duration:'')?>" id="course_duration" placeholder="Select course" readonly> 
              </div>
            
              <div class="col-md-6 my-1">
                <label class="mb-2">Student's Name:<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="frstu_name" id="frstu_name" value="<?=set_value('frstu_name', (isset($student))?$student->frstu_name:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('frstu_name'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Photo:<span class="text-danger">*</span></label>
                <input  class="form-control" type="file" name="photo" id="photo" >
                <span class="text-danger"><?=(isset($validation))?$validation->getError('photo'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">SO/WO/DO:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="so_wo_do" id="so_wo_do" value="<?=set_value('so_wo_do', (isset($student))?$student->so_wo_do:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('so_wo_do'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Mother's Name:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="mother_name" id="mother_name" value="<?=set_value('mother_name', (isset($student))?$student->mother_name:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('mother_name'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Gender:<span class="text-danger">*</span></label>
                <select name="gender" id="gender" class="form-control">
                    <option value="">Select One</option>
                    <option value="male" <?=set_select('gender', 'male', (isset($student) && $student->gender == 'male')?TRUE:'')?>>Male</option>
                    <option value="female" <?=set_select('gender', 'female', (isset($student) && $student->gender == 'female')?TRUE:'')?>>Female</option>
                </select>
                <span class="text-danger"><?=(isset($validation))?$validation->getError('gender'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Marital Status:</label>
                <select name="marital_status" id="marital_status" class="form-control">
                    <option value="">Select One</option>
                    <option value="married" <?=set_select('marital_status', 'married', (isset($student) && $student->marital_status == 'married')?TRUE:'')?>>Married</option>
                    <option value="unmarried" <?=set_select('marital_status', 'unmarried', (isset($student) && $student->marital_status == 'unmarried')?TRUE:'')?>>Unmarried</option>
                </select>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">DOB:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="dob" id="dob" value="<?=set_value('dob', (isset($student))?date('d-m-Y',strtotime($student->dob)):''); ?>" placeholder="DD-MM-YYYY">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('dob'):''?></span>
              </div>
                               
              <div class="col-md-6 my-1">
                <label class="mb-2">Parent Occupation:</label>
                <input  class="form-control" type="text" name="parents_occupation" id="parents_occupation" value="<?=set_value('parents_occupation', (isset($student))?$student->parents_occupation:''); ?>">
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Experience(if any):</label>
                <input  class="form-control" type="text" name="candidates_exp" id="candidates_exp" value="<?=set_value('candidates_exp', (isset($student))?$student->candidates_exp:''); ?>">
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Mobile No:</label>
                <input  class="form-control" type="text" name="phone" id="phone" value="<?=set_value('phone', (isset($student))?$student->phone:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('phone'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Alt Mobile No:</label>
                <input  class="form-control" type="text" name="alt_phone" id="alt_phone" value="<?=set_value('alt_phone', (isset($student))?$student->alt_phone:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('alt_phone'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Email:</label>
                <input  class="form-control" type="email" name="email" id="email" value="<?=set_value('email', (isset($student))?$student->email:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('email'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Address:</label>
                <input  class="form-control" type="text" name="full_address" id="full_address" value="<?=set_value('full_address', (isset($student))?$student->full_address:''); ?>">
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">State:</label>
                <select name="state" id="state" class="form-control" onchange="get_districs();">
                    <option value="">Select One</option>
                    <?php if(!empty($states)){
                        foreach($states as $list){ 
                            $sel = '';
                            if((isset($student) && $student->state == $list->id) || (isset($_POST['state']) && $_POST['state'] == $list->id)){
                                $sel = 'selected';
                            }
                            echo '<option value="'.$list->id.'" '.$sel.'>'.$list->name.'</option>';
                        }
                    } ?>
                    
                </select>
              </div>
              <div class="col-md-4 my-1">
                <label class="mb-2">District:</label>
                <select name="district" id="district" class="form-control">
                    <option value="">Select One</option>
                    <?php if(!empty($districts)){
                        foreach($districts as $list){ 
                            $sel = '';
                            if((isset($student) && $student->district == $list->id) || (isset($_POST['district']) && $_POST['district'] == $list->id)){
                                $sel = 'selected';
                            }
                            echo '<option value="'.$list->id.'" '.$sel.'>'.$list->city.'</option>';
                        }
                    } ?>
                    
                </select>
              </div>
              <div class="col-md-4 my-1">
                <label class="mb-2">Pincode:</label>
                <input  class="form-control" type="text" name="pincode" id="pincode" value="<?=set_value('pincode', (isset($student))?$student->pincode:''); ?>">
              </div>
              
              <div class="col-md-4 my-1">
                <label class="mb-2">Aadhar No:</label>
                <input class="form-control" type="text" name="aadhar_no" id="aadhar_no" value="<?=set_value('aadhar_no', (isset($student))?$student->aadhar_no:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('aadhar_no'):''?></span>
              </div>
              <?php /*<div class="form-group row">
                <label for="status" class="col-md-2">Status<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <div class="custom-control custom-radio">
                    <input type="radio" id="status" name="status" value="1" class="custom-control-input" <?=set_radio('status', 1)?>>
                    <label class="custom-control-label" for="status">Active</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="status2" name="status" value="0" class="custom-control-input" <?=set_radio('status', 0)?>>
                    <label class="custom-control-label" for="status2">Inactive</label>
                  </div>
                  <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>  
                </div>
              </div>*/ ?>
            </div> <!--End form-group row-->
            <?php $style = '';
              if((isset($_POST['stu_type']) && $_POST['stu_type'] == 'R') || (isset($student) && $student->stu_type == 'R')){
                $style = 'display:none';
              }
              if(isset($student) && $student->stu_type == 'R' && $student->is_cert == 'yes'){
                $style = '';
              }
            ?>
            <div class="row" id="marks_dtls" style="<?=$style?>">
              <div class="col-md-6 my-1">
                <label class="mb-2">Certificate issue date:<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="cert_issue_date" id="cert_issue_date" value="<?=set_value('cert_issue_date', (isset($student) && $student->cert_issue_date != '0000-00-00')?date('d-m-Y',strtotime($student->cert_issue_date)):''); ?>" placeholder="DD-MM-YYYY">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('cert_issue_date'):''?></span>
              </div>
              <?php 
              $moduleStyle = '';
              if((isset($student) && $student->course_cat == 'P') || (isset($student) && $student->course_cat == 'F') || (isset($course) && $course->course_cat == 'P') || (isset($course) && $course->course_cat == 'F')){ 
                  $moduleStyle = 'display:none';
              } ?>
              <div class="col-md-12 my-2" >
                  <table class="table" id="modules" style="<?=$moduleStyle?>">
                      <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">Module Name</th>
                              <?php if((isset($student) && $student->course_cat == 'C') || (isset($course) && $course->course_cat == 'C')){ ?>
                                  <th scope="col">Full Marks</th>
                                  <th scope="col">Marks Obtained</th>
                              <?php }else{ ?>
                                  <th scope="col">Speed (WPM)</th>
                              <?php } ?>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                              $moData = [];
                              if(isset($student) && $student->module_marks != '') {
                                  $moData = json_decode($student->module_marks);
                              }
                              if(isset($modules)){
                              if(!empty($modules)){
                                  $sn = 1;
                                  foreach($modules as $i=>$list){ 
                                  $mo = '';
                                  if(isset($moData[$i]) && $moData[$i]->id == $list->id){
                                      $mo = $moData[$i]->mo;
                                  }
                                  ?>
                                  <tr>
                                          <td><?=$sn++?></td>
                                          <td><?=$list->module_name?></td>
                                          <?php if((isset($student) && $student->course_cat == 'C') || (isset($course) && $course->course_cat == 'C')){ ?>
                                              <td><?=$list->full_marks?></td>
                                          <?php } ?>
                                          <td>
                                              <div class="form-group">
                                                  <input type="hidden" name="module_name[<?=$i?>]" value="<?=$list->module_name?>">
                                                  <input type="hidden" name="fm[<?=$i?>]" value="<?=$list->full_marks?>">
                                                  <input type="hidden" name="id[<?=$i?>]" value="<?=$list->id?>">
                                                  <input type="text" name="mo[<?=$i?>]" value="<?=set_value('mo['.$i.']', $mo)?>" id="mo<?=$i?>" class="form-control">
                                              </div>
                                              <?php if($i < 1){ ?>
                                                  <span class="text-danger"><?=(isset($validation))?$validation->getError('mo.'.$i):''?></span>
                                              <?php } ?>
                                          </td>
                                      </tr>
                              <?php }
                              }else{
                                  $error = (isset($validation))?$validation->getError('mo.0'):'';
                                  echo '<tr ><td colspan="4" class="text-danger text-center">Module not available. Please contact administrator.<br>';
                                  echo '<span class="text-danger">'.$error.'</span></td></tr>';
                              }

                          }else{
                              echo '<tr ><td colspan="4" class="text-danger text-center">Please Select Course</td></tr>';
                          } ?>
                      </tbody>
                  </table>
              </div>
              
            </div>
            <div class="row">
              <div class="col-md-6 my-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=base_url('admin/franchise_view/'.$frDtls->m_id)?>" class="btn btn-warning">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->

  <script type="text/javascript">
    function get_districs(){
        var stateId = $("#state").val();
        if(stateId){
            $.ajax({
                type: 'post',
                url: "<?=base_url('/get_districts')?>",
                data: {stateId : stateId},
                success: function(res){
                    console.log(res);
                    $("#district").html(res);
                }
            });
        }
    }
    function fill_course_duration(){
        var course_duration = $("#frcourse_id :selected").data("course_duration");
        var cid = $("#frcourse_id :selected").val();
        if(cid){
            $.ajax({
                type: 'post',
                url: "<?=base_url('/get_module_html')?>",
                data: {cid : cid},
                success: function(res){
                    console.log(res);
                    $("#modules").show();
                    $("#modules").html(res);
                    
                }
            });
        }
        $("#course_duration").val(course_duration);
    }
    $( function() {
        $("#dob,#cert_issue_date").datepicker(
            {dateFormat: 'dd-mm-yy'}
        );
    });
  </script>

    
<?=$this->endSection()?>