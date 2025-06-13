<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Question</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">add-question</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <div class="card mb-4">
        <!-- <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Edit Franchise</h6>
        </div> -->
        <div class="card-body">
       
          <form autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="form-group row">
              <label for="course_ids" class="col-md-2">Select Course<span class="text-danger">*</span></label>
              <div class="col-md-10">
                <select name="course_ids[]" id="course_ids" class="form-control" multiple>
                  <?php if(!empty($courses)){
                      foreach($courses as $list){
                      $selected = '';
                      if(isset($ques) && $ques->course_ids != '') {
                        $course_idsArr = explode(',', $ques->course_ids);
                        if(in_array($list->cid, $course_idsArr)){
                          $selected = 'selected';
                        }
                      }elseif(isset($_POST['course_ids']) && !empty($_POST['course_ids']) && in_array($list->cid, $_POST['course_ids'])){
                        $selected = 'selected';
                      }
                  ?>
                          <option value="<?=$list->cid?>" <?=$selected?>><?=$list->c_name?></option>
                  <?php } } ?>
                </select>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_ids.*') : '' ?></span>  
              </div>
            </div>
            
            <div id="main-div">
              <div class="form-group row">
                <label for="q_title_en" class="col-md-2">Question Title (EN)<span class="text-danger">*</span></label>
                <div class="col-md-10">
                  <input type="text" name="q_title_en[0]" value="<?=set_value('q_title_en[0]', (isset($ques))?$ques->q_title_en:'')?>" id="q_title_en" class="form-control">
                  <span class="text-danger"><?= isset($validation) ? display_error($validation, 'q_title_en.0') : '' ?></span>  
                </div>
              </div>
              <div class="form-group row">
                <label for="q_title_hn" class="col-md-2">Question Title (HN)<span class="text-danger">*</span></label>
                <div class="col-md-10">
                  <input type="text" name="q_title_hn[0]" value="<?=set_value('q_title_hn[0]', (isset($ques))?$ques->q_title_hn:'')?>" id="q_title_hn" class="form-control">
                  <span class="text-danger"><?= isset($validation) ? display_error($validation, 'q_title_hn.0') : '' ?></span>  
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-2">
                  <label for="opt1" class="form-label">Options</label>
                </div>
                <div class="col-md-10 d-flex justify-content-between">
                  <label for="opt1" class="form-label mr-2">A.</label>
                  <input type="text" class="form-control " name="opt1[0]" value="<?=set_value('opt1[0]', (isset($ques))?$ques->opt1:'')?>" id="opt1">
                  <label for="opt1" class="form-label mx-2">B.</label>
                  <input type="text" class="form-control" name="opt2[0]" value="<?=set_value('opt2[0]', (isset($ques))?$ques->opt2:'')?>" id="opt2">
                  <label for="opt1" class="form-label mx-2">C.</label>
                  <input type="text" class="form-control" name="opt3[0]" value="<?=set_value('opt3[0]', (isset($ques))?$ques->opt3:'')?>" id="opt2">
                  <label for="opt1" class="form-label mx-2">D.</label>
                  <input type="text" class="form-control me-2" name="opt4[0]" value="<?=set_value('opt4[0]', (isset($ques))?$ques->opt4:'')?>" id="opt4">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-2">
                  <label for="c_ans" class="form-label">Currect Answer</label>
                </div>
                <div class="col-md-6">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="Opt1" name="c_ans[0]" value="A" <?=set_radio('c_ans[0]', 'A', (isset($ques) && $ques->c_ans == 'A')?TRUE:'')?>>
                    <label class="form-check-label" for="Opt1">A</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="Opt2" name="c_ans[0]" value="B" <?=set_radio('c_ans[0]', 'B',(isset($ques) && $ques->c_ans == 'B')?TRUE:'')?>>
                    <label class="form-check-label" for="Opt2">B</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="Opt3" name="c_ans[0]" value="C" <?=set_radio('c_ans[0]', 'C',(isset($ques) && $ques->c_ans == 'C')?TRUE:'')?>>
                    <label class="form-check-label" for="Opt3">C</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="Opt4" name="c_ans[0]" value="D" <?=set_radio('c_ans[0]', 'D',(isset($ques) && $ques->c_ans == 'D')?TRUE:'')?>>
                    <label class="form-check-label" for="Opt4">D</label>
                  </div>
                </div>

                <?php if(!isset($ques)){ ?>
                <div class="col-md-4 d-flex justify-content-end">
                  <button type="button" class="btn btn-info mr-2" onclick="add_section()">Add</button>
                </div>
                <?php } ?>
              </div>
              <hr class="bg-primary">
            </div>

            <div class="form-group row">
              <label for="status" class="col-md-2">Status<span class="text-danger">*</span></label>
              <div class="col-sm-10">
                <div class="custom-control custom-radio">
                  <input type="radio" id="status" name="status" value="1" class="custom-control-input" checked>
                  <label class="custom-control-label" for="status">Active</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="status2" name="status" value="0" class="custom-control-input" <?=set_radio('status','0',(isset($ques) && $ques->status < 1)?TRUE:'')?>>
                  <label class="custom-control-label" for="status2">Inactive</label>
                </div>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>  
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-info">Reset</button>
            <a href="<?=base_url('admin/question_bank')?>" class="btn btn-warning">Cancel</a>
          </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->
  
  <script>
    $('#course_ids').multiselect({		
      nonSelectedText: 'Select Courses',
      enableFiltering: true,
      enableCaseInsensitiveFiltering: true,
      includeSelectAllOption: true,
      buttonWidth: '100%',
      maxWidth: 650,
      maxHeight: 350,
      onDropdownShown : function(event) {
        setTimeout(function(){
            $('#course_ids').parent().find("button.multiselect-clear-filter").click();
            $('#course_ids').parent().find("input[type='search'].multiselect-search").focus();
        }, 100);
      }
    });

    var secno = <?=isset($n)?$n:2?>;
    var n = 1;
    function add_section(){
        
        var sectionHtml = '<div class="q_sec">'+
              '<div class="form-group row">'+
                '<label for="q_title_en'+secno+'" class="col-md-2">Question Title (EN)'+secno+'</label>'+
                '<div class="col-md-10">'+
                  '<input type="text" name="q_title_en['+n+']" value="" id="q_title_en'+secno+'" class="form-control">'+
                '</div>'+
              '</div>'+
              '<div class="form-group row">'+
                '<label for="q_title_hn'+secno+'" class="col-md-2">Question Title (HN)'+secno+'</label>'+
                '<div class="col-md-10">'+
                  '<input type="text" name="q_title_hn['+n+']" value="" id="q_title_hn'+secno+'" class="form-control">'+
                '</div>'+
              '</div>'+
              '<div class="form-group row">'+
                '<div class="col-md-2">'+
                  '<label for="" class="form-label">Options'+secno+'</label>'+
                '</div>'+
                '<div class="col-md-10 d-flex justify-content-between">'+
                  '<label for="opt1'+secno+'" class="form-label mr-2">A.</label>'+
                  '<input type="text" class="form-control " name="opt1['+n+']" value="" id="opt1'+secno+'">'+
                  '<label for="opt2'+secno+'" class="form-label mx-2">B.</label>'+
                  '<input type="text" class="form-control" name="opt2['+n+']" value="" id="opt2'+secno+'">'+
                  '<label for="opt3'+secno+'" class="form-label mx-2">C.</label>'+
                  '<input type="text" class="form-control" name="opt3['+n+']" value="" id="opt3'+secno+'">'+
                  '<label for="opt4'+secno+'" class="form-label mx-2">D.</label>'+
                  '<input type="text" class="form-control me-2" name="opt4['+n+']" value="" id="opt4'+secno+'">'+
                '</div>'+
              '</div>'+
              '<div class="form-group row">'+
                '<div class="col-md-2">'+
                  '<label for="" class="form-label">Currect Answer'+secno+'</label>'+
                '</div>'+
                '<div class="col-md-6">'+
                  '<div class="form-check form-check-inline">'+
                    '<input class="form-check-input" type="radio" id="c_ans1'+secno+'" name="c_ans['+n+']" value="A">'+
                    '<label class="form-check-label" for="c_ans1'+secno+'">A</label>'+
                  '</div>'+
                  '<div class="form-check form-check-inline">'+
                    '<input class="form-check-input" type="radio" id="c_ans2'+secno+'" name="c_ans['+n+']" value="B">'+
                    '<label class="form-check-label" for="c_ans2'+secno+'">B</label>'+
                  '</div>'+
                  '<div class="form-check form-check-inline">'+
                    '<input class="form-check-input" type="radio" id="c_ans3'+secno+'" name="c_ans['+n+']" value="C">'+
                    '<label class="form-check-label" for="c_ans3'+secno+'">C</label>'+
                  '</div>'+
                  '<div class="form-check form-check-inline">'+
                    '<input class="form-check-input" type="radio" id="c_ans4'+secno+'" name="c_ans['+n+']" value="D">'+
                    '<label class="form-check-label" for="c_ans4'+secno+'">D</label>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4 d-flex justify-content-end">'+
                  '<button type="button" class="btn btn-info mr-2" onclick="add_section()">Add</button>'+
                  '<button type="button" class="btn btn-danger mr-2 removesection" >Remove</button>'+
                '</div>'+
              '</div>'+
              '<hr class="bg-primary">'+
            '</div>';

        $("#main-div").append(sectionHtml);
        secno++;
        n++;
    }
    $("#main-div").on("click", ".removesection", function() {
        var isConfirmed = confirm("Are you sure?");
        if (isConfirmed) {
            $(this).closest(".q_sec").remove();
        }
    });
  </script>
    
<?=$this->endSection()?>