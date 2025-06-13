<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<?php /*<script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>*/?>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Institution Batch </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Institute</a></li>
      <li class="breadcrumb-item" aria-current="page">batch_cu</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo (isset($cms))?'Edit ':'Add '; ?>Batch</h6>
        </div>
        <div class="card-body">
            <p class="text-danger">* Fields are mandatory:</p>
            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="batch_name" class="col-sm-2 mb-3 mb-sm-0">Batch Name:<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="batch_name" placeholder="Batch Name" name="batch_name" value="<?=set_value('batch_name',isset($batch)?$batch->batch_name:''); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'batch_name') : '' ?></span>
                    </div>
                    <label for="duration" class="col-sm-2 mb-3 mb-sm-0">Duration:<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                    <select name="duration" id="duration" class="form-control">
                        <option value="">Select One</option>
                        <?php for($i=1; $i<=12; $i++){
                        $true = (isset($batch) && $batch->duration == $i)?TRUE:'';
                        ?>
                        <option value="<?=$i?>" <?=set_select('duration', $i, $true)?>><?=($i==1)?$i.' Month':$i.' Months';?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'duration') : '' ?></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date_from" class="col-sm-2 mb-3 mb-sm-0">Date From:<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="date_from" placeholder="Date From" name="date_from" value="<?=set_value('date_from',isset($batch)?$batch->date_from:''); ?>" autocomplete="off">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'date_from') : '' ?></span>
                    </div>
                
                    <label for="date_to" class="col-sm-2 mb-3 mb-sm-0">Date To:<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="date_to" placeholder="Date To" name="date_to" value="<?=set_value('date_to',isset($batch)?$batch->date_to:''); ?>" autocomplete="off" readonly>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'date_to') : '' ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="time_from" class="col-sm-2 mb-3 mb-sm-0">Time From:<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <?php /* <input type="text" class="form-control" id="time_from" placeholder="Time From" name="time_from" value="<?=set_value('time_from',isset($batch)?$batch->time_from:''); ?>" autocomplete="off"> */ ?>
                        <select name="time_from" id="time_from" class="form-control">
                        <option value="">Select One</option>
                        <option value="08:00 AM" <?=set_select('time_from','08:00 AM', (isset($batch) && $batch->time_from == '08:00 AM')?true:'' )?>>08:00 AM</option>
                        <option value="09:00 AM" <?=set_select('time_from','09:00 AM', (isset($batch) && $batch->time_from == '09:00 AM')?true:'' )?>>09:00 AM</option>
                        <option value="10:00 AM" <?=set_select('time_from','10:00 AM', (isset($batch) && $batch->time_from == '10:00 AM')?true:'' )?>>10:00 AM</option>
                        <option value="11:00 AM" <?=set_select('time_from','11:00 AM', (isset($batch) && $batch->time_from == '11:00 AM')?true:'' )?>>11:00 AM</option>
                        <option value="12:00 PM" <?=set_select('time_from','12:00 PM', (isset($batch) && $batch->time_from == '12:00 PM')?true:'' )?>>12:00 PM</option>
                        <option value="01:00 PM" <?=set_select('time_from','01:00 PM', (isset($batch) && $batch->time_from == '01:00 PM')?true:'' )?>>01:00 PM</option>
                        <option value="02:00 PM" <?=set_select('time_from','02:00 PM', (isset($batch) && $batch->time_from == '02:00 PM')?true:'' )?>>02:00 PM</option>
                        <option value="03:00 PM" <?=set_select('time_from','03:00 PM', (isset($batch) && $batch->time_from == '03:00 PM')?true:'' )?>>03:00 PM</option>
                        <option value="04:00 PM" <?=set_select('time_from','04:00 PM', (isset($batch) && $batch->time_from == '04:00 PM')?true:'' )?>>04:00 PM</option>
                        <option value="05:00 PM" <?=set_select('time_from','05:00 PM', (isset($batch) && $batch->time_from == '05:00 PM')?true:'' )?>>05:00 PM</option>
                        </select>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'time_from') : '' ?></span>
                    </div>
                
                    <label for="time_to" class="col-sm-2 mb-3 mb-sm-0">Time To:<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <?php /* <input type="text" class="form-control" id="time_to" placeholder="Time To" name="time_to" value="<?=set_value('time_to',isset($batch)?$batch->time_to:''); ?>" autocomplete="off"> */ ?>
                        <select name="time_to" id="time_to" class="form-control">
                        <option value="">Select One</option>
                        <option value="09:00 AM" <?=set_select('time_to','09:00 AM', (isset($batch) && $batch->time_to == '09:00 AM')?true:'' )?>>09:00 AM</option>
                        <option value="10:00 AM" <?=set_select('time_to','10:00 AM', (isset($batch) && $batch->time_to == '10:00 AM')?true:'' )?>>10:00 AM</option>
                        <option value="11:00 AM" <?=set_select('time_to','11:00 AM', (isset($batch) && $batch->time_to == '11:00 AM')?true:'' )?>>11:00 AM</option>
                        <option value="12:00 PM" <?=set_select('time_to','12:00 PM', (isset($batch) && $batch->time_to == '12:00 PM')?true:'' )?>>12:00 PM</option>
                        <option value="01:00 PM" <?=set_select('time_to','01:00 PM', (isset($batch) && $batch->time_to == '01:00 PM')?true:'' )?>>01:00 PM</option>
                        <option value="02:00 PM" <?=set_select('time_to','02:00 PM', (isset($batch) && $batch->time_to == '02:00 PM')?true:'' )?>>02:00 PM</option>
                        <option value="03:00 PM" <?=set_select('time_to','03:00 PM', (isset($batch) && $batch->time_to == '03:00 PM')?true:'' )?>>03:00 PM</option>
                        <option value="04:00 PM" <?=set_select('time_to','04:00 PM', (isset($batch) && $batch->time_to == '04:00 PM')?true:'' )?>>04:00 PM</option>
                        <option value="05:00 PM" <?=set_select('time_to','05:00 PM', (isset($batch) && $batch->time_to == '05:00 PM')?true:'' )?>>05:00 PM</option>
                        <option value="06:00 PM" <?=set_select('time_to','06:00 PM', (isset($batch) && $batch->time_to == '06:00 PM')?true:'' )?>>06:00 PM</option>
                        <option value="07:00 PM" <?=set_select('time_to','07:00 PM', (isset($batch) && $batch->time_to == '07:00 PM')?true:'' )?>>07:00 PM</option>
                        </select> 
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'time_from') : '' ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stu_limit" class="col-sm-2 mb-3 mb-sm-0">Student Limit:<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="stu_limit" placeholder="Student Limit" name="stu_limit" value="<?=set_value('stu_limit',isset($batch)?$batch->stu_limit:''); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'stu_limit') : '' ?></span>
                    </div>
                </div>
        
                <div class="form-group row">
                    <label for="status" class="col-sm-2 mb-3 mb-sm-0">Status</label>
                    <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($batch->status) && $batch->status == 1)?true:'')?>> Active </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($batch->status) && $batch->status == 0)?true:'')?>> Inactive </label>
                    </div>
                    </div>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=base_url('institute/batch')?>" class="btn btn-warning">Cancel</a>
            </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->

  <script type="text/javascript">
  $=jQuery;
  $(function(){
      $("#date_from").datepicker({
        dateFormat: 'dd-MM-yy',
        todayHighlight: true,
      });
  });
  $(function(){
      $("#date_to").datepicker({
        dateFormat: 'dd-MM-yy',
        todayHighlight: true,
      });
  });

  $("#date_from").change(function(){
    var datefrom = $(this).val();
    var d = new Date(datefrom);
    var duration = $("#duration").val();
    if(duration == ''){
      alert("please select duration!");
    }else{
      d.setMonth(d.getMonth() + +duration);
      var newdate = new Date(d);
      day = newdate.getDate();
      month = newdate.getMonth() + 1;
      year = newdate.getFullYear();
      // This is British date format. See below for US.
      //calcval = (((day <= 9) ? "0" + day : day) + "/" + ((month <= 9) ? "0" + month : month) + "/" + year);
      var date_to = (year + "/" + ((month <= 9) ? "0" + month : month) + "/" + ((day <= 9) ? "0" + day : day));
      $("#date_to").val(date_to);
    }
  });
  $("#duration").change(function(){
    $("#date_from").val("");
    $("#date_to").val("");
  });
</script>
<?=$this->endSection()?>