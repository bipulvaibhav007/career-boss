<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<?php /*<script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>*/?>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between my-3">
        <h1 class="h3 mb-0 text-gray-800">Student's I-Card</h1>
        <div class="">
            <a href="javascript:void(0)" class="btn btn-primary" onclick="printElem('i-card');">Print/Download</a>
            <a href="<?=base_url('institute/student_listing')?>" class="btn btn-warning">Back</a>
        </div>
    </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <?php /* <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo (isset($cms))?'Edit ':'Add '; ?>Batch</h6>
        </div> */ ?>
        <div class="card-body">
            <div id="i-card">
              <style>
                  .id-container {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 20px;
                    justify-content: center;
                    padding: 20px;
                  }
              
                  .id-card {
                    width: 245px;
                    height: 320px;
                    border: 2px solid #333;
                    border-radius: 10px;
                    padding: 10px;
                    text-align: center;
                    font-family: Arial, sans-serif;
                    background-color: #f0f0f0;
                    box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-start;
                    align-items: center;
                  }
              
                  .id-card h2 {
                    font-size: 18px;
                    margin: 5px 0 10px;
                    color: #003366;
                  }
              
                  .id-card img {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    object-fit: cover;
                    margin-bottom: 10px;
                    border: 2px solid #003366;
                  }
              
                  .id-details {
                    font-size: 14px;
                    text-align: left;
                    width: 100%;
                    padding: 0 5px;
                  }
              
                  .id-details p {
                    margin: 4px 0;
                  }
              </style>
 
              <div class="id-container">
                <?php if(!empty($student_list)){
                      foreach($student_list as $list){
                        if($list->stu_image != ''){
                            $image = $list->stu_image;
                        }else{
                            $image = 'dummy_stu.jpg';
                        }      
                    ?>
                <div class="id-card">
                  <h2>Career-Boss</h2>
                  <img src="<?=base_url('public/assets/upload/images/'.$image) ?>" alt="Student Image">
                  <div class="id-details">
                    <p><strong>Name:</strong> <?=strtoupper($list->stu_name)?></p>
                    <p><strong>Reg No:</strong> <?=strtoupper($list->stu_reg_no)?></p>
                    <p><strong>Roll No:</strong> <?=$list->stu_roll_no?></p>
                    <p><strong>DOB:</strong> <?=date('d-M-Y',strtotime($list->dob))?></p>
                  </div>
                </div>
                <?php } }else{
                      echo '<p class="text-center text-danger">No record for I-card</p>';
                    } ?>
                </div>
            </div>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->
  <script type="text/javascript">
    var invnumber = 'I-Card';
    function printElem(divId) {
        var content = document.getElementById(divId).innerHTML;
        var mywindow = window.open('', invnumber, 'height=600,width=800');

        mywindow.document.write('<html><head><title>' + invnumber + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus();
        mywindow.print();
        //mywindow.close();
        return true;
    }
    </script>
  <?php /* <script type="text/javascript">
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
</script> */ ?>
<?=$this->endSection()?>