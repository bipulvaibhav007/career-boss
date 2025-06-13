<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Course</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">add_edit_course</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo (isset($course))?'Update <span class="text-danger">'.$course->course_full_name.'</span>':'Add Course'; ?></h6>
        </div>
        <?php if(session()->getFlashdata('message') !== NULL){
            echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
        } ?>
        <div class="card-body">
            <?php $active1 = $showactive1 = $active2 = $showactive2 = 
                    $active3 = $showactive3 = $active4 = $showactive4 = 
                    $active5 = $showactive5 = $active6 = $showactive6 = 
                    $active7 = $showactive7 = $active8 = $showactive8 = 
                    $active9 = $showactive9 = $active10 = $showactive10 = 
                    $active11 = $showactive11 = '';
                if(isset($course) && $course->complete_tab == 1){
                    $active2 = 'active';
                    $showactive2 = 'show active';
                }else if(isset($course) && $course->complete_tab == 2){
                    $active3 = 'active';
                    $showactive3 = 'show active';
                }else if(isset($course) && $course->complete_tab == 3){
                    $active4 = 'active';
                    $showactive4 = 'show active';
                }else if(isset($course) && $course->complete_tab == 4){
                    $active5 = 'active';
                    $showactive5 = 'show active';
                }else if(isset($course) && $course->complete_tab == 5){
                    $active6 = 'active';
                    $showactive6 = 'show active';
                }else if(isset($course) && $course->complete_tab == 6){
                    $active7 = 'active';
                    $showactive7 = 'show active';
                }else if(isset($course) && $course->complete_tab == 7){
                    $active8 = 'active';
                    $showactive8 = 'show active';
                }else if(isset($course) && $course->complete_tab == 8){
                    $active9 = 'active';
                    $showactive9 = 'show active';
                }else if(isset($course) && $course->complete_tab == 9){
                    $active10 = 'active';
                    $showactive10 = 'show active';
                }else if(isset($course) && $course->complete_tab == 10){
                    $active11 = 'active';
                    $showactive11 = 'show active';
                }else{
                    $active1 = 'active';
                    $showactive1 = 'show active';
                }
            ?>
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link <?=$active1?>" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="basic" aria-selected="true">Basic</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$active2?>" id="tnd-tab" data-toggle="tab" href="#tnd" role="tab" aria-controls="tnd" aria-selected="false">Time & Duration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$active3?>" id="online-tab" data-toggle="tab" href="#online" role="tab" aria-controls="online" aria-selected="false">Online</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$active4?>" id="ofline-tab" data-toggle="tab" href="#ofline" role="tab" aria-controls="ofline" aria-selected="false">Ofline</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$active5?>" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false">About the Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$active6?>" id="key-feature-tab" data-toggle="tab" href="#key-feature" role="tab" aria-controls="key-feature" aria-selected="false">Key Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$active7?>" id="course-breakdown-tab" data-toggle="tab" href="#course-breakdown" role="tab" aria-controls="course-breakdown" aria-selected="false">Course Breakdown</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$active8?>" id="course-intro-tab" data-toggle="tab" href="#course-intro" role="tab" aria-controls="course-intro" aria-selected="false">Course Intro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$active9?>" id="faq-tab" data-toggle="tab" href="#faq" role="tab" aria-controls="faq" aria-selected="false">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$active10?>" id="stu-stories-tab" data-toggle="tab" href="#stu-stories" role="tab" aria-controls="stu-stories" aria-selected="false">Student Stories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$active11?>" id="publish-tab" data-toggle="tab" href="#publish" role="tab" aria-controls="publish" aria-selected="false">Publish</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false">For SEO</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade <?=$showactive1?>" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                    <?php /*<div class="form-group">
                        <label for="course_name">Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name" value="<?=set_value('course_name', (isset($course->course_name))?$course->course_name:''); ?>" placeholder="Course Name">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_name') : '' ?></span>
                    </div> */ ?>
                    <div class="form-group">
                        <label for="course_full_name">Course Full Name</label>
                        <input type="text" class="form-control" id="course_full_name" name="course_full_name" value="<?=set_value('course_full_name', (isset($course->course_full_name))?$course->course_full_name:''); ?>" >
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_full_name') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input type="text" class="form-control" id="url" name="url" value="<?=set_value('url', (isset($course))?$course->url:''); ?>" readonly>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'url') : '' ?></span>
                    </div>
                    <?php /* <div class="form-group">
                        <label for="ccat_id">Course Category</label>
                        <select name="ccat_id" id="ccat_id" class="form-control">
                            <option value="">Select Course Category</option>
                            <?php if(!empty($course_category)){
                                foreach($course_category as $list){ 
                                $true = (isset($course->ccat_id) && $course->ccat_id == $list->ccat_id)?true:''?>
                                <option value="<?=$list->ccat_id?>" <?=set_select('ccat_id',$list->ccat_id, $true)?>><?=$list->course_category_name?></option>

                            <?php }
                            } ?>
                        </select>
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'ccat_id') : '' ?></span>
                    </div> */ ?>
                    <div class="row">
                        <?php if(isset($course->image) && $course->image != ''){ ?>
                            <div class="col-md-6">
                                <img src="<?=base_url('public/assets/upload/images/'.$course->image) ?>" width="150px" height="80px" />
                            </div>
                        <?php } ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image (for Home Page)</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'image') : '' ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="short_description">Alt Text for Image</label>
                                <input type="text" class="form-control" name="img_alt" value="<?=set_value('img_alt', isset($course->img_alt)?$course->img_alt:'')?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title Text for Image</label>
                                <input type="text" class="form-control" name="img_title" value="<?=set_value('img_title', isset($course->img_title)?$course->img_title:'')?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <textarea name="short_description" id="short_description" cols="30" rows="4" class="form-control" ><?=set_value('short_description', isset($course->short_description)?$course->short_description:'')?></textarea>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'short_description') : '' ?></span>
                    </div>
                    <?php /* 
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?=set_value('meta_title', (isset($course->meta_title))?$course->meta_title:''); ?>" >
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'meta_title') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="meta_keyword">Meta Keyword</label>
                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="<?=set_value('meta_keyword', (isset($course->meta_keyword))?$course->meta_keyword:''); ?>" >
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'meta_keyword') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <input type="text" class="form-control" id="meta_description" name="meta_description" value="<?=set_value('meta_description', (isset($course->meta_description))?$course->meta_description:''); ?>" >
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'meta_description') : '' ?></span>
                    </div>
                    */ ?>
                    <?php /* <div class="form-group">
                        <label for="description">Course Overview</label>
                        <textarea name="description" id="description" cols="30" rows="4" class="form-control" ><?=set_value('description', isset($course->description)?$course->description:'')?></textarea>
                        <script>
                            var oEdit1 = new InnovaEditor("oEdit1");					
                            oEdit1.width='100%';
                            oEdit1.height=400;			
                            oEdit1.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                            oEdit1.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                            oEdit1.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                            oEdit1.onSave = new Function("submitEditContentForm()");
                            oEdit1.REPLACE("description");		
                            oEdit1.mode="XHTMLBody";
                        </script>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
                    </div> */ ?>
                    
                    <div class="row">
                        <?php if(isset($course->youtube_vlink_image) && $course->youtube_vlink_image != ''){ ?>
                            <div class="col-md-6">
                                <img src="<?=base_url('public/assets/upload/images/'.$course->youtube_vlink_image) ?>" width="150px" height="80px" />
                            </div>
                        <?php } ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Youtube Video Image (for course detail page)</label>
                                <input type="file" class="form-control" id="youtube_vlink_image" name="youtube_vlink_image">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'youtube_vlink_image') : '' ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="youtube_vlink">Youtube Link (if available)</label>
                        <input type="text" class="form-control" id="youtube_vlink" name="youtube_vlink" value="<?=set_value('youtube_vlink', (isset($course->youtube_vlink))?$course->youtube_vlink:''); ?>" >
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'youtube_vlink') : '' ?></span>
                    </div>

                    <input type="hidden" name="submit" value="basic">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                    <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                    </form>

                </div>

                <!-- syllabus tab -->
                <div class="tab-pane fade <?=$showactive2?>" id="tnd" role="tabpanel" aria-labelledby="tnd-tab">
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                    <div class="form-group row pt-2">
                        <div class="col-md-6">
                            <label for="custom_url">Url for section head (for course name)</label>
                            <input type="text" class="form-control" id="custom_url" name="custom_url" value="<?=set_value('custom_url', (isset($course->custom_url))?$course->custom_url:''); ?>" >
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'custom_url') : '' ?></span>
                        </div>
                    </div>
                    <p class="text-primary">Next Batch Start:</p>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="next_batch_line1">Line 1</label>
                            <input type="text" class="form-control" id="next_batch_line1" name="next_batch_line1" value="<?=set_value('next_batch_line1', (isset($course->next_batch_line1))?$course->next_batch_line1:''); ?>" >
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'next_batch_line1') : '' ?></span>
                        </div>
                        <div class="col-md-6">
                            <label for="next_batch_line2">Line 2</label>
                            <input type="text" class="form-control" id="next_batch_line2" name="next_batch_line2" value="<?=set_value('next_batch_line2', (isset($course->next_batch_line2))?$course->next_batch_line2:''); ?>" >
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'next_batch_line2') : '' ?></span>
                        </div>
                    </div>
                    <p class="text-primary">Program Duration:</p>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="prg_duration_line1">Line 1</label>
                            <input type="text" class="form-control" id="prg_duration_line1" name="prg_duration_line1" value="<?=set_value('prg_duration_line1', (isset($course->prg_duration_line1))?$course->prg_duration_line1:''); ?>" >
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'prg_duration_line1') : '' ?></span>
                        </div>
                        <div class="col-md-6">
                            <label for="prg_duration_line2">Line 2</label>
                            <input type="text" class="form-control" id="prg_duration_line2" name="prg_duration_line2" value="<?=set_value('prg_duration_line2', (isset($course->prg_duration_line2))?$course->prg_duration_line2:''); ?>" >
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'prg_duration_line2') : '' ?></span>
                        </div>
                    </div>
                    <p class="text-primary">Offline/Online Bootcamp:</p>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="bootcamp_line1">Line 1</label>
                            <input type="text" class="form-control" id="bootcamp_line1" name="bootcamp_line1" value="<?=set_value('bootcamp_line1', (isset($course->bootcamp_line1))?$course->bootcamp_line1:''); ?>" >
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'bootcamp_line1') : '' ?></span>
                        </div>
                        <div class="col-md-6">
                            <label for="bootcamp_line2">Line 2</label>
                            <input type="text" class="form-control" id="bootcamp_line2" name="bootcamp_line2" value="<?=set_value('bootcamp_line2', (isset($course->bootcamp_line2))?$course->bootcamp_line2:''); ?>" >
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'bootcamp_line2') : '' ?></span>
                        </div>
                    </div>

                    <input type="hidden" name="submit" value="tnd">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                    <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                    </form>
                </div>
                <!-- online tab -->
                <div class="tab-pane fade <?=$showactive3?>" id="online" role="tabpanel" aria-labelledby="online-tab">
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                    <?php if(isset($course) && $course->online != ''){
                        $onlineArr = json_decode($course->online);
                    }
                    ?>
                    <div class="form-group">
                        <label for="head1">Heading 1</label>
                        <input class="form-control" type="text" id="head1" name="head[0]" value="<?=(isset($onlineArr[0]))?$onlineArr[0]->head:set_value('head[0]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'head[0]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head1_dtls">Heading 1 Details </label>
                        <textarea name="dtls[0]" id="head1_dtls" cols="30" rows="6" class="form-control" ><?=(isset($onlineArr[0]))?$onlineArr[0]->dtls:set_value('dtls[0]')?></textarea>
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dtls[0]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head2">Heading 2</label>
                        <input class="form-control" type="text" id="head2" name="head[1]"  value="<?=(isset($onlineArr[1]))?$onlineArr[1]->head:set_value('head[1]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'head[1]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head2_dtls">Heading 2 Details </label>
                        <textarea name="dtls[1]" id="head2_dtls" cols="30" rows="6" class="form-control" ><?=(isset($onlineArr[1]))?$onlineArr[1]->dtls:set_value('dtls[1]')?></textarea>
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dtls[1]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head3">Heading 3</label>
                        <input class="form-control" type="text" id="head3" name="head[2]"  value="<?=(isset($onlineArr[2]))?$onlineArr[2]->head:set_value('head[2]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'head[2]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head3_dtls">Heading 3 Details </label>
                        <textarea name="dtls[2]" id="head3_dtls" cols="30" rows="6" class="form-control" ><?=(isset($onlineArr[2]))?$onlineArr[2]->dtls:set_value('dtls[2]')?></textarea>
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dtls[2]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head4">Heading 4</label>
                        <input class="form-control" type="text" id="head4" name="head[3]"  value="<?=(isset($onlineArr[3]))?$onlineArr[3]->head:set_value('head[3]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'head[3]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head4_dtls">Heading 4 Details </label>
                        <textarea name="dtls[3]" id="head4_dtls" cols="30" rows="6" class="form-control" ><?=(isset($onlineArr[3]))?$onlineArr[3]->dtls:set_value('dtls[3]')?></textarea>
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dtls[3]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head5">Heading 5</label>
                        <input class="form-control" type="text" id="head5" name="head[4]"  value="<?=(isset($onlineArr[4]))?$onlineArr[4]->head:set_value('head[4]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'head[4]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head5_dtls">Heading 5 Details </label>
                        <textarea name="dtls[4]" id="head5_dtls" cols="30" rows="6" class="form-control" ><?=(isset($onlineArr[4]))?$onlineArr[4]->dtls:set_value('dtls[4]')?></textarea>
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dtls[4]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="online_course_price">Online Course Price </label>
                        <input type="text" class="form-control" id="online_course_price" name="online_course_price" value="<?=set_value('online_course_price', (isset($course->online_course_price))?$course->online_course_price:''); ?>" >
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'online_course_price') : '' ?></span>
                    </div>
                    
                    <input type="hidden" name="submit" value="online">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                    <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                    </form>
                </div>
                <!-- ofline tab -->
                <div class="tab-pane fade <?=$showactive4?>" id="ofline" role="tabpanel" aria-labelledby="ofline-tab">
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                    <?php if(isset($course) && $course->ofline != ''){
                        $oflineArr = json_decode($course->ofline);
                        //print_r(explode(',',$syllabus[0]->syllabus));exit;
                    }
                    ?>
                    <div class="form-group">
                        <label for="head1">Heading 1</label>
                        <input class="form-control" type="text" id="head1" name="head[0]"  value="<?=(isset($oflineArr[0]))?$oflineArr[0]->head:set_value('head[0]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'head[0]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head1_dtls">Heading 1 Details </label>
                        <textarea name="dtls[0]" id="head1_dtls" cols="30" rows="6" class="form-control" ><?=(isset($oflineArr[0]))?$oflineArr[0]->dtls:set_value('dtls[0]')?></textarea>
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dtls[0]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head2">Heading 2</label>
                        <input class="form-control" type="text" id="head2" name="head[1]"  value="<?=(isset($oflineArr[1]))?$oflineArr[1]->head:set_value('head[1]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'head[1]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head2_dtls">Heading 2 Details </label>
                        <textarea name="dtls[1]" id="head2_dtls" cols="30" rows="6" class="form-control" ><?=(isset($oflineArr[1]))?$oflineArr[1]->dtls:set_value('dtls[1]')?></textarea>
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dtls[1]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head3">Heading 3</label>
                        <input class="form-control" type="text" id="head3" name="head[2]"  value="<?=(isset($oflineArr[2]))?$oflineArr[2]->head:set_value('head[2]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'head[2]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head3_dtls">Heading 3 Details </label>
                        <textarea name="dtls[2]" id="head3_dtls" cols="30" rows="6" class="form-control" ><?=(isset($oflineArr[2]))?$oflineArr[2]->dtls:set_value('dtls[2]')?></textarea>
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dtls[2]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head4">Heading 4</label>
                        <input class="form-control" type="text" id="head4" name="head[3]"  value="<?=(isset($oflineArr[3]))?$oflineArr[3]->head:set_value('head[3]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'head[3]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head4_dtls">Heading 4 Details </label>
                        <textarea name="dtls[3]" id="head4_dtls" cols="30" rows="6" class="form-control" ><?=(isset($oflineArr[3]))?$oflineArr[3]->dtls:set_value('dtls[3]')?></textarea>
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dtls[3]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head5">Heading 5</label>
                        <input class="form-control" type="text" id="head5" name="head[4]"  value="<?=(isset($oflineArr[4]))?$oflineArr[4]->head:set_value('head[4]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'head[4]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="head5_dtls">Heading 5 Details </label>
                        <textarea name="dtls[4]" id="head5_dtls" cols="30" rows="6" class="form-control" ><?=(isset($oflineArr[4]))?$oflineArr[4]->dtls:set_value('dtls[4]')?></textarea>
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dtls[4]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="ofline_course_price">Ofline Course Price </label>
                        <input type="text" class="form-control" id="ofline_course_price" name="ofline_course_price" value="<?=set_value('ofline_course_price', (isset($course->ofline_course_price))?$course->ofline_course_price:''); ?>" >
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'ofline_course_price') : '' ?></span>
                    </div>
                    
                    <input type="hidden" name="submit" value="ofline">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                    <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                    </form>
                </div>
                <!-- About the program tab -->
                <div class="tab-pane fade <?=$showactive5?>" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                    <?php if(isset($course) && $course->about_program != ''){
                        $about_programArr = json_decode($course->about_program);
                        //print_r(explode(',',$syllabus[0]->syllabus));exit;
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="about_title1">Title 1</label>
                                <input class="form-control" type="text" id="about_title1" name="about_title[0]"  value="<?=(isset($about_programArr[0]))?$about_programArr[0]->about_title:set_value('about_title[0]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'about_title[0]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="url1">Url 1</label>
                                <input class="form-control" type="text" id="url1" name="url[0]"  value="<?=(isset($about_programArr[0]->url))?$about_programArr[0]->url:set_value('url[0]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'url[0]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="about_desc1">Description 1</label>
                                <textarea name="about_desc[0]" id="about_desc1" cols="30" rows="10"  class="form-control"><?=(isset($about_programArr[0]))?$about_programArr[0]->about_desc:set_value('about_desc[0]'); ?></textarea>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'about_desc[0]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="about_img1">Image 1</label>
                                <input type="file" name="about_img[0]" class="form-control">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'about_img[0]') : '' ?></span>
                                <input type="hidden" name="old_about_img[0]" value="<?=(isset($about_programArr[0]))?$about_programArr[0]->about_img:''?>">
                            </div>
                            <?php if(isset($about_programArr[0])){ ?>
                                <div class="form-group">
                                    <img src="<?=base_url('public/assets/upload/images/'.$about_programArr[0]->about_img)?>" alt="img1" height="150px" width="300px">
                                </div>

                            <?php } ?>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="about_title2">Title 2</label>
                                <input class="form-control" type="text" id="about_title2" name="about_title[1]"  value="<?=(isset($about_programArr[1]))?$about_programArr[1]->about_title:set_value('about_title[1]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'about_title[1]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="url2">Url 2</label>
                                <input class="form-control" type="text" id="url2" name="url[1]"  value="<?=(isset($about_programArr[1]->url))?$about_programArr[1]->url:set_value('url[1]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'url[1]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="about_desc2">Description 2</label>
                                <textarea name="about_desc[1]" id="about_desc1" cols="30" rows="10"  class="form-control"><?=(isset($about_programArr[1]))?$about_programArr[1]->about_desc:set_value('about_desc[1]'); ?></textarea>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'about_desc[1]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="about_img2">Image 2</label>
                                <input type="file" name="about_img[1]" class="form-control">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'about_img[1]') : '' ?></span>
                                <input type="hidden" name="old_about_img[1]" value="<?=(isset($about_programArr[1]))?$about_programArr[1]->about_img:''?>">
                            </div>
                            <?php if(isset($about_programArr[1])){ ?>
                                <div class="form-group">
                                    <img src="<?=base_url('public/assets/upload/images/'.$about_programArr[1]->about_img)?>" alt="img2" height="150px" width="300px">
                                </div>

                            <?php } ?>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="about_title3">Title 3</label>
                                <input class="form-control" type="text" id="about_title3" name="about_title[2]"  value="<?=(isset($about_programArr[2]))?$about_programArr[2]->about_title:set_value('about_title[2]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'about_title[2]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="url3">Url 3</label>
                                <input class="form-control" type="text" id="url3" name="url[2]"  value="<?=(isset($about_programArr[2]->url))?$about_programArr[2]->url:set_value('url[2]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'url[2]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="about_desc3">Description 3</label>
                                <textarea name="about_desc[2]" id="about_desc3" cols="30" rows="10"  class="form-control"><?=(isset($about_programArr[2]))?$about_programArr[2]->about_desc:set_value('about_desc[2]'); ?></textarea>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'about_desc[2]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="about_img3">Image 3</label>
                                <input type="file" name="about_img[2]" class="form-control">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'about_img[2]') : '' ?></span>
                                <input type="hidden" name="old_about_img[2]" value="<?=(isset($about_programArr[2]))?$about_programArr[2]->about_img:''?>">
                            </div>
                            <?php if(isset($about_programArr[2])){ ?>
                                <div class="form-group">
                                    <img src="<?=base_url('public/assets/upload/images/'.$about_programArr[2]->about_img)?>" alt="img3" height="150px" width="300px">
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Course Overview</label>
                        <textarea name="description" id="description" cols="30" rows="4" class="form-control" ><?=set_value('description', isset($course->description)?$course->description:'')?></textarea>
                        <script>
                            var oEdit1 = new InnovaEditor("oEdit1");					
                            oEdit1.width='100%';
                            oEdit1.height=400;			
                            oEdit1.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                            oEdit1.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                            oEdit1.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                            oEdit1.onSave = new Function("submitEditContentForm()");
                            oEdit1.REPLACE("description");		
                            oEdit1.mode="XHTMLBody";
                        </script>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
                    </div>
                    
                    <input type="hidden" name="submit" value="about">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                    <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                    </form>
                </div>
                <div class="tab-pane fade <?=$showactive6?>" id="key-feature" role="tabpanel" aria-labelledby="key-feature-tab">
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                    <?php if(isset($course) && $course->key_features != ''){
                        $key_featureArr = json_decode($course->key_features);
                    }
                    ?>
                    <div class="form-group">
                        <label for="key_feature1">Key Features (line 1) </label>
                        <input class="form-control" type="text" id="key_feature1" name="key_feature[0]"  value="<?=(isset($key_featureArr[0]))?$key_featureArr[0]:set_value('key_feature[0]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'key_feature[0]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="key_feature2">Key Features (line 2) </label>
                        <input class="form-control" type="text" id="key_feature2" name="key_feature[1]"  value="<?=(isset($key_featureArr[1]))?$key_featureArr[1]:set_value('key_feature[1]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'key_feature[1]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="key_feature3">Key Features (line 3) </label>
                        <input class="form-control" type="text" id="key_feature3" name="key_feature[2]"  value="<?=(isset($key_featureArr[2]))?$key_featureArr[2]:set_value('key_feature[2]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'key_feature[2]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="key_feature4">Key Features (line 4) </label>
                        <input class="form-control" type="text" id="key_feature4" name="key_feature[3]"  value="<?=(isset($key_featureArr[3]))?$key_featureArr[3]:set_value('key_feature[3]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'key_feature[3]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="key_feature5">Key Features (line 5) </label>
                        <input class="form-control" type="text" id="key_feature5" name="key_feature[4]"  value="<?=(isset($key_featureArr[4]))?$key_featureArr[4]:set_value('key_feature[4]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'key_feature[4]') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="key_feature6">Key Features (line 6) </label>
                        <input class="form-control" type="text" id="key_feature6" name="key_feature[5]"  value="<?=(isset($key_featureArr[5]))?$key_featureArr[5]:set_value('key_feature[5]'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'key_feature[5]') : '' ?></span>
                    </div>
                    <input type="hidden" name="submit" value="key-feature">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                    <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                    </form>
                </div>
                <div class="tab-pane fade <?=$showactive7?>" id="course-breakdown" role="tabpanel" aria-labelledby="course-breakdown-tab">
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                    
                    <div class="form-group">
                        <label for="course_breakdown_desc">Description for course breakdown</label>
                        <textarea name="course_breakdown_desc" id="course_breakdown_desc" cols="30" rows="10" class="form-control" ><?=(isset($course) && $course->course_breakdown_desc != '')?$course->course_breakdown_desc:set_value('course_breakdown_desc'); ?></textarea>
                        
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_breakdown_desc') : '' ?></span>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="prg_duration_line_1">Duration </label>
                            <input class="form-control" type="text" id="prg_duration_line_1" name="prg_duration_line1"  value="<?=(isset($course) && $course->prg_duration_line1 != '')?$course->prg_duration_line1:set_value('prg_duration_line1'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'prg_duration_line1') : '' ?></span>
                        </div>   
                        <div class="col-sm-6">
                            <label for="live_class">Live Classes </label>
                            <input class="form-control" type="text" id="live_class" name="live_class"  value="<?=(isset($course) && $course->live_class != '')?$course->live_class:set_value('live_class'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'live_class') : '' ?></span>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="real_project">Real Project </label>
                            <input class="form-control" type="text" id="real_project" name="real_project"  value="<?=(isset($course) && $course->real_project != '')?$course->real_project:set_value('real_project'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'real_project') : '' ?></span>
                        </div>
                    
                        <div class="col-sm-6">
                            <label for="specializations">Specializations </label>
                            <input class="form-control" type="text" id="specializations" name="specializations" value="<?=(isset($course) && $course->specializations != '')?$course->specializations:set_value('specializations'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'specializations') : '' ?></span>
                        </div>
                        
                    </div>
                    <input type="hidden" name="submit" value="course-breakdown">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                    <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                    </form>
                </div>
                <div class="tab-pane fade <?=$showactive8?>" id="course-intro" role="tabpanel" aria-labelledby="course-intro-tab">
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <div id="course-content">
                                <?php if(isset($course) && $course->course_intro != ''){
                                    $course_intro = json_decode($course->course_intro);
                                }
                                if(isset($course_intro) && !empty($course_intro)){
                                $n = 1; $cistyle = '';
                                foreach($course_intro as $list){ 
                                if($n > 1){
                                    $cistyle = 'padding:10px';
                                } ?>
                                <div class="course-intro" style="<?=$cistyle?>">
                                    <div class="form-group">
                                        <label for="module_name">Module Name</label>
                                        <input type="text" name="module_name[]" value="<?=$list->module_name?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="module_duration">Module Duration</label>
                                        <?php /* <input type="text" name="module_duration[]" value="<?=$list->module_duration?>" class="form-control"> */?>
                                        <select name="module_duration[]" class="form-control">
                                            <option value="1 Week" <?=((strtolower($list->module_duration)) == (strtolower('1 Week')))?'selected':''?>>1 Week</option>
                                            <option value="2 Weeks" <?=((strtolower($list->module_duration)) == (strtolower('2 Weeks')))?'selected':''?>>2 Weeks</option>
                                            <option value="3 Weeks" <?=((strtolower($list->module_duration)) == (strtolower('3 Weeks')))?'selected':''?>>3 Weeks</option>
                                            <option value="4 Weeks" <?=((strtolower($list->module_duration)) == (strtolower('4 Weeks')))?'selected':''?>>4 Weeks</option>
                                            <option value="5 Weeks" <?=((strtolower($list->module_duration)) == (strtolower('5 Weeks')))?'selected':''?>>5 Weeks</option>
                                            <option value="6 Weeks" <?=((strtolower($list->module_duration)) == (strtolower('6 Weeks')))?'selected':''?>>6 Weeks</option>
                                            <option value="7 Weeks" <?=((strtolower($list->module_duration)) == (strtolower('7 Weeks')))?'selected':''?>>7 Weeks</option>
                                            <option value="8 Weeks" <?=((strtolower($list->module_duration)) == (strtolower('8 Weeks')))?'selected':''?>>8 Weeks</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="module_syllabus">Module Syllabus<span class="text-danger"> (Use comma (,) between two topic)</span></label>
                                        <textarea name="module_syllabus[]" id="module_syllabus" cols="30" rows="4" class="form-control"><?=$list->module_syllabus?></textarea>
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="addRow()" style="float:right; margin-left:10px;">Add</button>
                                    <?php if($n > 1){ ?>
                                    <button type="button" class="btn btn-warning" onclick="removeRow(this)" style="float:right">Remove</button>
                                    <?php } ?>
                                </div>
                                <?php $n++; } }else{ ?>
                                <div class="course-intro">
                                    <div class="form-group">
                                        <label for="module_name">Module Name</label>
                                        <input type="text" name="module_name[]" class="form-control">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="module_duration">Module Duration</label>
                                        <?php /* <input type="text" name="module_duration[]" class="form-control"> */ ?>
                                        <select name="module_duration[]" class="form-control">
                                            <option value="1 Week">1 Week</option>
                                            <option value="2 Weeks">2 Weeks</option>
                                            <option value="3 Weeks">3 Weeks</option>
                                            <option value="4 Weeks">4 Weeks</option>
                                            <option value="5 Weeks">5 Weeks</option>
                                            <option value="6 Weeks">6 Weeks</option>
                                            <option value="7 Weeks">7 Weeks</option>
                                            <option value="8 Weeks">8 Weeks</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="module_syllabus">Module Syllabus<span class="text-danger"> (Use comma (,) between two topic)</span></label>
                                        <textarea name="module_syllabus[]" id="module_syllabus" cols="30" rows="4" class="form-control"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="addRow()" style="float:right">Add</button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="submit" value="course-intro">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                    <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                    </form>
                </div>
                <div class="tab-pane fade <?=$showactive9?>" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <div id="faq-content">
                                <?php if(isset($course) && $course->faq != ''){
                                    $faq = json_decode($course->faq);
                                }
                                if(isset($faq) && !empty($faq)){
                                $n = 1; $cistyle = '';
                                foreach($faq as $list){ 
                                if($n > 1){
                                    $cistyle = 'padding:10px';
                                } ?>
                                <div class="faq" style="<?=$cistyle?>">
                                    <div class="form-group">
                                        <label for="faq_title">Faq Title</label>
                                        <input type="text" name="faq_title[]" value="<?=$list->faq_title?>" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="faq_desc">Faq Description</label>
                                        <textarea name="faq_desc[]" id="faq_desc" cols="30" rows="4" class="form-control"><?=$list->faq_desc?></textarea>
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="addFaqRow()" style="float:right; margin-left:10px;">Add</button>
                                    <?php if($n > 1){ ?>
                                    <button type="button" class="btn btn-warning" onclick="removeFaqRow(this)" style="float:right">Remove</button>
                                    <?php } ?>
                                </div>
                                <?php $n++; } }else{ ?>
                                <div class="faq">
                                    <div class="form-group">
                                        <label for="faq_title">Faq Title</label>
                                        <input type="text" name="faq_title[]" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="faq_desc">Faq Description</label>
                                        <textarea name="faq_desc[]" id="faq_desc" cols="30" rows="4" class="form-control"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="addFaqRow()" style="float:right">Add</button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="submit" value="faq">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                    <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                    </form>
                </div>
                <div class="tab-pane fade <?=$showactive10?>" id="stu-stories" role="tabpanel" aria-labelledby="stu-stories-tab">
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stu_stories_desc">Student Stories Description</label>
                                <textarea name="stu_stories_desc" id="stu_stories_desc" cols="30" rows="4" class="form-control"><?=(isset($course) && $course->stu_stories_desc != '')?$course->stu_stories_desc:set_value('stu_stories_desc')?></textarea>
                            </div>
                            <div id="stu-stories-content">
                                <?php if(isset($course) && $course->stu_stories != ''){
                                    $stu_stories = json_decode($course->stu_stories);
                                }
                                if(isset($stu_stories) && !empty($stu_stories)){
                                $n = 1; $cistyle = '';
                                foreach($stu_stories as $list){ 
                                if($n > 1){
                                    $cistyle = 'padding:10px';
                                } ?>
                                <div class="stu-stories" style="<?=$cistyle?>">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="faq_title">Photo</label>
                                            <input type="file" name="photo[]" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <img src="<?=base_url('public/assets/upload/images/'.$list->photo)?>" alt="Photo" width="150px" height="80px">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="v_link">Video Link</label>
                                        <input type="text" name="v_link[]" value="<?=$list->v_link?>" class="form-control">
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="addStuStoriesRow()" style="float:right; margin-left:10px;">Add</button>
                                    <?php if($n > 1){ ?>
                                    <button type="button" class="btn btn-warning" onclick="removeStuStoriesRow(this)" style="float:right">Remove</button>
                                    <?php } ?>
                                </div>
                                <?php $n++; } }else{ ?>
                                <div class="stu-stories">
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" name="photo[]" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="v_link">Video Link</label>
                                        <input type="text" name="v_link[]" value="" class="form-control">
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="addStuStoriesRow()" style="float:right">Add</button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="submit" value="stu-stories">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                    <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                    </form>
                </div>
                <div class="tab-pane fade <?=$showactive11?>" id="publish" role="tabpanel" aria-labelledby="publish-tab">
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                    <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="is_popular">Is Popular (Show on Home page?) </label>
                        <select name="is_popular" id="is_popular" class="form-control">
                            <option value="">Select One</option>
                            <option value="1" <?=set_select('is_popular', '1', (isset($course) && $course->is_popular == '1')?true:'')?>>Yes</option>
                            <option value="0" <?=set_select('is_popular', '0', (isset($course) && $course->is_popular == '0')?true:'')?>>No</option>
                        </select>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'is_popular') : '' ?></span>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="blog_status">Publish</label>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($course->status) && $course->status == 1)?true:'')?>> Yes </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($course->status) && $course->status == 0)?true:'')?>> No </label>
                        </div>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                    </div>
                    <input type="hidden" name="submit" value="publish">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                    <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                    </form>
                </div>
                <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                    <div class="form-group">
                        <label for="og_type">Og Type</label>
                        <input type="text" class="form-control" id="og_type" name="og_type" value="<?=set_value('og_type', (isset($course->og_type))?$course->og_type:''); ?>" >
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'og_type') : '' ?></span>
                    </div> 
                    <div class="form-group">
                        <label for="og_url">Og Url</label>
                        <input type="text" class="form-control" id="og_url" name="og_url" value="<?=set_value('og_url', (isset($course->og_url))?$course->og_url:''); ?>" >
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'og_url') : '' ?></span>
                    </div> 
                    <div class="form-group">
                        <label for="og_title">Og Title</label>
                        <input type="text" class="form-control" id="og_title" name="og_title" value="<?=set_value('og_title', (isset($course->og_title))?$course->og_title:''); ?>" >
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'og_title') : '' ?></span>
                    </div>
                    
                    <div class="row">
                        <?php if(isset($course->og_image) && $course->og_image != ''){ ?>
                            <div class="col-md-6">
                                <img src="<?=base_url('public/assets/upload/images/'.$course->og_image) ?>" width="150px" height="80px" />
                            </div>
                        <?php } ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Og Image</label>
                                <input type="file" class="form-control" id="og_image" name="og_image">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'og_image') : '' ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="og_site_name">Og Sitename</label>
                        <input type="text" class="form-control" id="og_site_name" name="og_site_name" value="<?=set_value('og_site_name', (isset($course->og_site_name))?$course->og_site_name:''); ?>" >
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'og_site_name') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="og_description">Og Description</label>
                        <textarea name="og_description" id="og_description" cols="30" rows="4" class="form-control" ><?=set_value('og_description', isset($course->og_description)?$course->og_description:'')?></textarea>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'og_description') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?=set_value('meta_title', (isset($course->meta_title))?$course->meta_title:''); ?>" >
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'meta_title') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="meta_keyword">Meta Keyword</label>
                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="<?=set_value('meta_keyword', (isset($course->meta_keyword))?$course->meta_keyword:''); ?>" >
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'meta_keyword') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <input type="text" class="form-control" id="meta_description" name="meta_description" value="<?=set_value('meta_description', (isset($course->meta_description))?$course->meta_description:''); ?>" >
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'meta_description') : '' ?></span>
                    </div>
                    <?php /* <div class="form-group">
                        <label for="description">Course Overview</label>
                        <textarea name="description" id="description" cols="30" rows="4" class="form-control" ><?=set_value('description', isset($course->description)?$course->description:'')?></textarea>
                        <script>
                            var oEdit1 = new InnovaEditor("oEdit1");					
                            oEdit1.width='100%';
                            oEdit1.height=400;			
                            oEdit1.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                            oEdit1.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                            oEdit1.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                            oEdit1.onSave = new Function("submitEditContentForm()");
                            oEdit1.REPLACE("description");		
                            oEdit1.mode="XHTMLBody";
                        </script>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
                    </div> */ ?>
                    

                    <input type="hidden" name="submit" value="seo">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                    <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                    </form>

                </div>
            </div>

        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->

<script>
    $("body").on("keyup","#course_full_name", function(event){	
        var urlval = $(this).val();
        var newurl = urlval.replace(/[_\s]/g, '-').replace(/[^a-z0-9-\s]/gi, '');
        $('#url').val(newurl.toLowerCase());
    });
    function addStuStoriesRow(){
        document.querySelector('#stu-stories-content').insertAdjacentHTML('beforeend','<div class="stu-stories"><div class="form-group"><label for="photo">Photo</label><input type="file" name="photo[]" class="form-control"></div><div class="form-group"><label for="v_link">Video Link</label><input type="text" name="v_link[]" value="" class="form-control"></div><button type="button" class="btn btn-success" onclick="addStuStoriesRow()" style="float:right; margin-left:10px;">Add</button><button type="button" class="btn btn-warning" onclick="removeStuStoriesRow(this);" style="float:right">Remove</button></div></div>')
    }
    function removeStuStoriesRow(input) {
        input.parentNode.remove()
    }

    function addFaqRow () {
        //alert('hi'); return 0;
        document.querySelector('#faq-content').insertAdjacentHTML('beforeend','<div class="faq" style="padding:10px"><div class="form-group"><label for="faq_title">Faq Title</label><input type="text" name="faq_title[]" class="form-control"></div><div class="form-group"><label for="faq_desc">Faq Description</label><textarea name="faq_desc[]" id="faq_desc" cols="30" rows="4" class="form-control"></textarea></div><button type="button" class="btn btn-success" onclick="addFaqRow()" style="float:right; margin-left:10px;">Add</button><button type="button" class="btn btn-warning" onclick="removeFaqRow(this);" style="float:right">Remove</button></div>')
    }
    function removeFaqRow (input) {
        input.parentNode.remove()
    }
    
    function addRow () {
        //alert('hi'); return 0;
        document.querySelector('#course-content').insertAdjacentHTML('beforeend','<div class="course-intro" style="padding:10px"><div class="form-group"><label for="module_name">Module Name</label><input type="text" name="module_name[]" class="form-control"></div><div class="form-group"><label for="module_duration">Module Duration</label><select name="module_duration[]" class="form-control"><option value="1 Week">1 Week</option><option value="2 Weeks">2 Weeks</option><option value="3 Weeks">3 Weeks</option><option value="4 Weeks">4 Weeks</option><option value="5 Weeks">5 Weeks</option><option value="6 Weeks">6 Weeks</option><option value="7 Weeks">7 Weeks</option><option value="8 Weeks">8 Weeks</option></select></div><div class="form-group"><label for="module_syllabus">Module Syllabus<span class="text-danger"> (Use comma (,) between two topic)</span></label><textarea name="module_syllabus[]" id="module_syllabus" cols="30" rows="4" class="form-control"></textarea></div><button type="button" class="btn btn-success" onclick="addRow()" style="float:right; margin-left:10px;">Add</button><button type="button" class="btn btn-warning" onclick="removeRow(this);" style="float:right">Remove</button></div>')
    }
    function removeRow (input) {
        input.parentNode.remove()
    }
</script>
<?=$this->endSection()?>