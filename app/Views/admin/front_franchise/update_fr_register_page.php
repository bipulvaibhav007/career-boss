<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>

<script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Update About Us Page</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">update_about_us</li>
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
          <h6 class="m-0 font-weight-bold text-primary">Banner Section</h6>
        </div>
        <div class="card-body">
            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <?= form_hidden('submit','sec1'); ?>
                <?= form_hidden('id', (isset($sec1->id))?$sec1->id:''); ?>
                
                <?php /* <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3">Is Show Section?</label>
                        <div class="col-sm-3 form-check">
                            <input class="form-check-input" type="checkbox" name="is_show_sec1" id="is_show_sec1" value="1" <?=(isset($sec1->is_show_sec1) && $sec1->is_show_sec1 == 1)?'checked':''?>>
                            <label class="form-check-label" for="is_show_sec1"></label>
                        </div>
                    </div>
                </div> */ ?>
                <div class="form-group">
                    <label for="title_1">Title-1</label>
                    <input type="text" class="form-control" id="title_1" name="title_1" value="<?=set_value('title_1', (isset($sec1->title_1))?$sec1->title_1:''); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'title_1') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="title_2">Title-2</label>
                    <input type="text" class="form-control" id="title_2" name="title_2" value="<?=set_value('title_2', (isset($sec1->title_2))?$sec1->title_2:''); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'title_2') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="banner_content">Banner-Content</label>
                    <textarea class="form-control" id="banner_content" name="banner_content" rows="3"><?=set_value('banner_content', (isset($sec1->banner_content))?$sec1->banner_content:''); ?></textarea>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'banner_content') : '' ?></span>
                </div>
                <div class="row">
                    <?php if(isset($sec1->banner_image) && $sec1->banner_image != ''){ ?>
                        <div class="col-md-6">
                            <img src="<?=base_url('public/assets/upload/images/'.$sec1->banner_image) ?>" width="150px" height="80px" />
                        </div>
                    <?php } ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Image</label>
                            <input type="file" class="form-control" id="banner_image" name="banner_image">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'banner_image') : '' ?></span>
                        </div>
                    </div>
                </div>
                
                
                <?php /*<div class="row">
                    
                    
                </div>
                <div class="form-group">
                    <label for="banner_title">Banner Title</label>
                    <input type="text" class="form-control" id="banner_title" name="banner_title" value="<?=set_value('banner_title', (isset($expert->banner_title))?$expert->banner_title:''); ?>" placeholder="Banner Title">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'banner_title') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="banner_head">Banner Heading</label>
                    <input class="form-control" type="text" id="banner_head" name="banner_head" value="<?=(isset($expert->banner_head))?$expert->banner_head:set_value('banner_head'); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'banner_head') : '' ?></span>
                </div> */ ?>
                
                <?php /* <div class="form-group">
                    <label for="short_desc">Short Description</label>
                    <textarea class="form-control" id="short_desc" name="short_desc" rows="4" placeholder="Short Description"><?=(isset($expert->short_desc))?$expert->short_desc:set_value('short_desc'); ?></textarea>
                    <script>
                        var oEdit1 = new InnovaEditor("oEdit1");					
                        oEdit1.width='100%';
                        oEdit1.height=400;			
                        oEdit1.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                        oEdit1.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                        oEdit1.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                        oEdit1.onSave = new Function("submitEditContentForm()");
                        oEdit1.REPLACE("short_desc");		
                        oEdit1.mode="XHTMLBody";
                    </script>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'short_desc') : '' ?></span>
                </div> */ ?>
                
                <?php /* <div class="form-group">
                    <label for="status">Status</label>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($expert->status) && $expert->status == '1')?true:'')?>> Active </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($expert->status) && $expert->status == '0')?true:'')?>> Inactive </label>
                    </div>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                </div> */ ?>
                <?php if(is_privilege(29,2)){ ?>
                <button type="submit" class="btn btn-primary me-2 my-2">Update</button>
                <?php } ?>
                <?php /* <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=base_url('admin/experts')?>" class="btn btn-warning">Cancel</a> */ ?>
            </form>
        </div>
      </div><!-- end card -->
        
        <div class="card mb-4">
            <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Section-2</h6>
            </div>
            <div class="card-body">
                <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <?= form_hidden('submit','sec2'); ?>
                <?= form_hidden('id', (isset($sec1->id))?$sec1->id:''); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-3">Is Show Section?</label>
                            <div class="col-sm-9 form-check">
                                <input class="form-check-input" type="checkbox" name="is_show_sec2" id="is_show_sec2" value="1" <?=(isset($sec1->is_show_sec2) && $sec1->is_show_sec2 == 1)?'checked':''?>>
                                <label class="form-check-label" for="is_show_sec2"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php if(isset($sec1->sec2_image) && $sec1->sec2_image != ''){ ?>
                        <img src="<?=base_url('public/assets/upload/images/'.$sec1->sec2_image) ?>" width="150px" height="80px" />
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Section-2 Image</label>
                            <input type="file" class="form-control" id="sec2_image" name="sec2_image">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'sec2_image') : '' ?></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                    <div class="row"> 
                        <div class="col-md-4">
                            <h6 class="text-primary"><strong>Why Choose Us?</strong></h6>
                            <div class="form-group">
                                <!-- <label for="col1_t1">Col-1 Text-1</label> -->
                                <textarea name="why_choose_us" id="why_choose_us" class="form-control" rows="4"><?=set_value('why_choose_us', (isset($sec1->why_choose_us))?$sec1->why_choose_us:''); ?></textarea>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-primary"><strong>Comprehensive Training</strong></h6>
                            <div class="form-group">
                                <!-- <label for="col2_t1">Col-2 Text-1</label> -->
                                <textarea name="comp_training" id="comp_training" class="form-control" rows="4"><?=set_value('comp_training', (isset($sec1->comp_training))?$sec1->comp_training:''); ?></textarea>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-primary"><strong>Ongoing Support</strong></h6>
                            <div class="form-group">
                                <!-- <label for="col3_t1">Col-3 Text-1</label> -->
                                <textarea name="ongo_support" id="ongo_support" class="form-control" rows="4"><?=set_value('ongo_support', (isset($sec1->ongo_support))?$sec1->ongo_support:''); ?></textarea>
                            </div>
                            
                        </div>
                    </div>
                    </div>
                    <?php /* <div class="col-md-12">
                        <div class="form-group">
                            <label>Section-2 Content</label>
                            <textarea name="sec2_content" id="sec2_content" class="form-control"><?=set_value('sec2_content', (isset($sec1->sec2_content))?$sec1->sec2_content:''); ?></textarea>
                            <script>
                                var oEdit1 = new InnovaEditor("oEdit1");					
                                oEdit1.width='100%';
                                oEdit1.height=400;			
                                oEdit1.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                                oEdit1.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                                oEdit1.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                                oEdit1.onSave = new Function("submitEditContentForm()");
                                oEdit1.REPLACE("sec2_content");		
                                oEdit1.mode="XHTMLBody";
                            </script>
                        </div>
                    </div> */ ?>
                </div>
                <?php if(is_privilege(29,2)){ ?>
                <button type="submit" class="btn btn-primary me-2 my-2">Update</button>
                <?php } ?>
                </form>

            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Our Franchise Benefits</h6>
            </div>
            <div class="card-body">
                <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <?= form_hidden('submit','sec3'); ?>
                    <?= form_hidden('id', (isset($sec1->id))?$sec1->id:''); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3">Is Show Section?</label>
                                <div class="col-sm-3 form-check">
                                    <input class="form-check-input" type="checkbox" name="is_show_sec3" id="is_show_sec3" value="1" <?=(isset($sec1->is_show_sec3) && $sec1->is_show_sec3 == 1)?'checked':''?>>
                                    <label class="form-check-label" for="is_show_sec3"></label>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($sec1->center_image) && $sec1->center_image != ''){ ?>
                            <div class="col-md-6">
                                <img src="<?=base_url('public/assets/upload/images/'.$sec1->center_image) ?>" width="150px" height="80px" />
                            </div>
                        <?php } ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Center Image</label>
                                <input type="file" class="form-control" id="center_image" name="center_image">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'center_image') : '' ?></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="card bg-warning text-white my-2 p-2">
                                        <div class="form-group">
                                            <label for="title1">Title-1</label>
                                            <input type="text" name="title1" id="title1" class="form-control" value="<?=set_value('title1', (isset($sec1->title1))?$sec1->title1:''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="text1">Text-1</label>
                                            <input type="text" name="text1" id="text1" class="form-control" value="<?=set_value('text1', (isset($sec1->text1))?$sec1->text1:''); ?>">
                                        </div>
                                        
                                    </div>
                                    <div class="card bg-primary text-white my-2 p-2">
                                        <div class="form-group">
                                            <label for="title2">Title-2</label>
                                            <input type="text" name="title2" id="title2" class="form-control" value="<?=set_value('title2', (isset($sec1->title2))?$sec1->title2:''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="text2">Text-2</label>
                                            <input type="text" name="text2" id="text2" class="form-control" value="<?=set_value('text2', (isset($sec1->text2))?$sec1->text2:''); ?>">
                                        </div>
                                        
                                    </div>
                                    <div class="card bg-warning text-white my-2 p-2">
                                        <div class="form-group">
                                            <label for="title3">Title-3</label>
                                            <input type="text" name="title3" id="title3" class="form-control" value="<?=set_value('title3', (isset($sec1->title3))?$sec1->title3:''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="text3">Text-3</label>
                                            <input type="text" name="text3" id="text3" class="form-control" value="<?=set_value('text3', (isset($sec1->text3))?$sec1->text3:''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-primary text-white my-2 p-2">
                                        <div class="form-group">
                                            <label for="title4">Title-4</label>
                                            <input type="text" name="title4" id="title4" class="form-control" value="<?=set_value('title4', (isset($sec1->title4))?$sec1->title4:''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="text4">Text-4</label>
                                            <input type="text" name="text4" id="text4" class="form-control" value="<?=set_value('text4', (isset($sec1->text4))?$sec1->text4:''); ?>">
                                        </div>
                                    </div>
                                    <div class="card bg-warning text-white my-2 p-2">
                                        <div class="form-group">
                                            <label for="title5">Title-5</label>
                                            <input type="text" name="title5" id="title5" class="form-control" value="<?=set_value('title5', (isset($sec1->title5))?$sec1->title5:''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="text5">Text-5</label>
                                            <input type="text" name="text5" id="text5" class="form-control" value="<?=set_value('text5', (isset($sec1->text5))?$sec1->text5:''); ?>">
                                        </div>
                                    </div>
                                    <div class="card bg-primary text-white my-2 p-2">
                                        <div class="form-group">
                                            <label for="title6">Title-6</label>
                                            <input type="text" name="title6" id="title6" class="form-control" value="<?=set_value('title6', (isset($sec1->title6))?$sec1->title6:''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="text6">Text-6</label>
                                            <input type="text" name="text6" id="text6" class="form-control" value="<?=set_value('text6', (isset($sec1->text6))?$sec1->text6:''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="franchise">FRANCHISEES</label>
                                        <input type="text" name="franchise" id="franchise" class="form-control" value="<?=set_value('franchise', (isset($sec1->franchise))?$sec1->franchise:''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="yearsrd">YEARS R&D</label>
                                        <input type="text" name="yearsrd" id="yearsrd" class="form-control" value="<?=set_value('yearsrd', (isset($sec1->yearsrd))?$sec1->yearsrd:''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="seminars">SEMINARS</label>
                                        <input type="text" name="seminars" id="seminars" class="form-control" value="<?=set_value('seminars', (isset($sec1->seminars))?$sec1->seminars:''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="audience">AUDIENCE TRAINED</label>
                                        <input type="text" name="audience" id="audience" class="form-control" value="<?=set_value('audience', (isset($sec1->audience))?$sec1->audience:''); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(is_privilege(29,2)){ ?>
                        <button type="submit" class="btn btn-primary me-2 my-2">Update</button>
                    <?php } ?>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Explore the other franchise experience</h6>
            </div>
            <div class="card-body">
                <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <?= form_hidden('submit','sec4'); ?>
                    <?= form_hidden('id', (isset($sec1->id))?$sec1->id:''); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3">Is Show Section?</label>
                                <div class="col-sm-3 form-check">
                                    <input class="form-check-input" type="checkbox" name="is_show_sec4" id="is_show_sec4" value="1" <?=(isset($sec1->is_show_sec4) && $sec1->is_show_sec4 == 1)?'checked':''?>>
                                    <label class="form-check-label" for="is_show_sec4"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6 class="text-primary"><strong>Franchise-1</strong></h6>
                                <div class="form-group">
                                    <label for="f1dtl">Details</label>
                                    <textarea name="f1dtl" id="f1dtl" class="form-control" rows="4"><?=set_value('f1dtl', (isset($sec1->f1dtl))?$sec1->f1dtl:''); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="f1photo">Photo</label>
                                    <input type="file" name="f1photo" id="f1photo" class="form-control">
                                </div>
                                <?php if(isset($sec1->f1photo) && $sec1->f1photo != ''){ ?>
                                    <div class="form-group">
                                        <img src="<?=base_url('public/assets/upload/images/'.$sec1->f1photo) ?>" width="100px" height="100px" />
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="f1name">Name</label>
                                    <input type="text" name="f1name" id="f1name" class="form-control" value="<?=(isset($sec1))?$sec1->f1name:''?>">
                                </div>
                                <div class="form-group">
                                    <label for="f1ocp">Occupation</label>
                                    <input type="text" name="f1ocp" id="f1ocp" class="form-control" value="<?=(isset($sec1))?$sec1->f1ocp:''?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6 class="text-primary"><strong>Franchise-2</strong></h6>
                                <div class="form-group">
                                    <label for="f2dtl">Details</label>
                                    <textarea name="f2dtl" id="f2dtl" class="form-control" rows="4"><?=set_value('f2dtl', (isset($sec1->f2dtl))?$sec1->f2dtl:''); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="f2photo">Photo</label>
                                    <input type="file" name="f2photo" id="f2photo" class="form-control">
                                </div>
                                <?php if(isset($sec1->f2photo) && $sec1->f2photo != ''){ ?>
                                    <div class="form-group">
                                        <img src="<?=base_url('public/assets/upload/images/'.$sec1->f2photo) ?>" width="100px" height="100px" />
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="f2name">Name</label>
                                    <input type="text" name="f2name" id="f2name" class="form-control" value="<?=(isset($sec1))?$sec1->f2name:''?>">
                                </div>
                                <div class="form-group">
                                    <label for="f2ocp">Occupation</label>
                                    <input type="text" name="f2ocp" id="f2ocp" class="form-control" value="<?=(isset($sec1))?$sec1->f2ocp:''?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6 class="text-primary"><strong>Franchise-3</strong></h6>
                                <div class="form-group">
                                    <label for="f3dtl">Details</label>
                                    <textarea name="f3dtl" id="f3dtl" class="form-control" rows="4"><?=set_value('f3dtl', (isset($sec1->f3dtl))?$sec1->f3dtl:''); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="f3photo">Photo</label>
                                    <input type="file" name="f3photo" id="f3photo" class="form-control">
                                </div>
                                <?php if(isset($sec1->f3photo) && $sec1->f3photo != ''){ ?>
                                    <div class="form-group">
                                        <img src="<?=base_url('public/assets/upload/images/'.$sec1->f3photo) ?>" width="100px" height="100px" />
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="f3name">Name</label>
                                    <input type="text" name="f3name" id="f3name" class="form-control" value="<?=(isset($sec1))?$sec1->f3name:''?>">
                                </div>
                                <div class="form-group">
                                    <label for="f3ocp">Occupation</label>
                                    <input type="text" name="f3ocp" id="f3ocp" class="form-control" value="<?=(isset($sec1))?$sec1->f3ocp:''?>">
                                </div>
                            </div>
                        </div>
                        <?php if(is_privilege(29,2)){ ?>
                        <button type="submit" class="btn btn-primary me-2 my-2">Update</button>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- end column -->
  </div><!-- end row -->
<?=$this->endSection()?>