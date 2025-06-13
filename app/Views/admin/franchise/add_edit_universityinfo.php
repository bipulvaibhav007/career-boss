<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script> 
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Update University Info (<strong><?=$student->frstu_name?></strong>)</h1>
    <a href="<?=base_url('admin/franchise_view/'.$student->franchise_id)?>" class="btn btn-primary">Back</a>
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
          
            <div class="form-group row">
              <div class="col-md-6 my-1">
                <label class="mb-2">Student's Name: </label>
                <span><strong><?=ucwords($student->frstu_name)?></strong></span>
                <?php /* <input class="form-control" type="text" name="frstu_name" id="frstu_name" value="<?=set_value('frstu_name', (isset($student))?$student->frstu_name:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('frstu_name'):''?></span> */ ?>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Photo:</label>
                <img src="<?=base_url('public/assets/upload/images/'.$student->photo)?>" alt="student image" width="70px" height="60px">
               </div>
            </div>
            <hr style="border-color: red; border-width: 2px; border-style: dashed;">
            <p class="mt-2 text-primary">Before Completion:</p>
            <form autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="frst_id" value="<?=$student->frst_id?>">
            <input type="hidden" name="franchise_id" value="<?=$student->franchise_id?>">
            <input type="hidden" name="submit" value="before_comp">
            <div class="form-group row">
              <div class="col-md-6 my-1">
                <label class="mb-2">University Name:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="u_name" id="u_name" value="<?=set_value('u_name', (isset($uniDtls))?$uniDtls->u_name:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('u_name'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Session</label>
                <input  class="form-control" type="text" name="session" id="session" value="<?=set_value('session', (isset($uniDtls))?$uniDtls->session:''); ?>">
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Course Fee:</label>
                <input  class="form-control" type="text" name="course_fee" id="course_fee" value="<?=set_value('course_fee', (isset($uniDtls))?$uniDtls->course_fee:$student->course_fee); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('course_fee'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Paid Amount:</label>
                <input  class="form-control" type="text" name="paid_amount" id="paid_amount" value="<?=set_value('paid_amount', (isset($uniDtls))?$uniDtls->paid_amount:'0'); ?>">
                <input type="hidden" name="paid_amount_o" value="<?=isset($uniDtls)?$uniDtls->paid_amount:0?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('paid_amount'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Receipt No:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="receipt_no" id="receipt_no" value="<?=set_value('receipt_no', (isset($uniDtls))?$uniDtls->receipt_no:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('receipt_no'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">admission Date:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="adm_date" id="adm_date" value="<?=set_value('adm_date', (isset($uniDtls))?date('d-m-Y',strtotime($uniDtls->adm_date)):date('d-m-Y')); ?>" placeholder="DD-MM-YYYY">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('adm_date'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Upload Last Qualification Document (combind pdf):</label>
                <input  class="form-control" type="file" name="qly_doc" id="qly_doc" >
                <?php $warning = 'File Not Yet upload!';
                if(isset($uniDtls) && $uniDtls->qly_doc != ''){
                  $warning = "File uploaded.";
                }?>
                <span class="text-danger"><?=(isset($validation))?$validation->getError('qly_doc'):$warning?></span>
              </div>
              <div class="col-md-6 my-1"></div>
              <div class="col-md-6 my-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=base_url('admin/franchise_view/'.$frDtls->m_id)?>" class="btn btn-warning">Cancel</a>
              </div>
            </div>
            </form>
            <hr style="border-color: red; border-width: 2px; border-style: dashed;">
            <p class="mt-2 text-primary">After Completion:</p>
            <form autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="frst_id" value="<?=$student->frst_id?>">
            <input type="hidden" name="franchise_id" value="<?=$student->franchise_id?>">
            <input type="hidden" name="submit" value="after_comp">
            <input type="hidden" name="u_name" value="<?=(isset($uniDtls))?$uniDtls->u_name:''?>">
            <div class="form-group row">
              <div class="col-md-6 my-1">
                <label class="mb-2">University Reg No:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="u_regno" id="u_regno" value="<?=set_value('u_regno', (isset($uniDtls))?$uniDtls->u_regno:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('u_regno'):''?></span>
              </div>
              
              <div class="col-md-6 my-1">
                <label class="mb-2">University Roll No:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="u_rollno" id="u_rollno" value="<?=set_value('u_rollno', (isset($uniDtls))?$uniDtls->u_rollno:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('u_rollno'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Certificate No:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="cert_no" id="cert_no" value="<?=set_value('cert_no', (isset($uniDtls))?$uniDtls->cert_no:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('cert_no'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Upload University Certificate Copy (combind):</label>
                <input  class="form-control" type="file" name="uni_doc" id="uni_doc" >
                <?php $warning = 'File Not Yet upload!';
                if(isset($uniDtls) && $uniDtls->uni_doc != ''){
                  $warning = "File uploaded.";
                }?>
                <span class="text-danger"><?=(isset($validation))?$validation->getError('uni_doc'):$warning?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Status<span class="text-danger">*</span></label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="status4" value="3" <?=($student->status == 3)?'checked':''?>>
                  <label class="form-check-label" for="status4">
                    Completed
                  </label>
                </div>
                <span class="text-danger"><?=(isset($validation))?$validation->getError('status'):''?></span>
              </div>
              <div class="col-md-6 my-1"></div>

              <div class="col-md-6 my-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=base_url('admin/franchise_view/'.$frDtls->m_id)?>" class="btn btn-warning">Cancel</a>
              </div>
            </div>
            </form>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->

  <script type="text/javascript">
    /*function get_districs(){
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
    }*/
    $( function() {
        $("#adm_date").datepicker(
            {dateFormat: 'dd-mm-yy'}
        );
    });
  </script>

    
<?=$this->endSection()?>