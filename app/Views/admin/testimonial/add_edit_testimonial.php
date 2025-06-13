<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Testimonial</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">add_edit_testimonial</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo (isset($testimonial))?'Edit Testimonial':'Add Testimonial'; ?></h6>
        </div>
        <div class="card-body">
            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
                <div class="form-group">
                  <label for="type">Type</label>
                  <select name="type" id="type" class="form-control">
                    <option value="suc" <?=(isset($testimonial->type) && $testimonial->type == 'suc')?'selected':''?>>Success Stories</option>
                    <option value="stu" <?=(isset($testimonial->type) && $testimonial->type == 'stu')?'selected':''?>>Student Stories</option>
                  </select>
                  <span class="text-danger"><?= isset($validation) ? display_error($validation, 'type') : '' ?></span>
                </div>
                <div class="row">
                    <?php if(isset($testimonial->logo) && $testimonial->logo != ''){ ?>
                        <div class="col-md-6">
                            <img src="<?=base_url('public/assets/upload/images/'.$testimonial->logo) ?>" width="150px" height="80px" />
                        </div>
                    <?php } ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'logo') : '' ?></span>
                        </div>
                    </div>
                </div>
                <div id="success_stories" style="<?=(isset($testimonial->type) && $testimonial->type=='stu')?'display:none;':''?>">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" cols="50"><?=(isset($testimonial->description))?$testimonial->description:set_value('description'); ?></textarea>
                    <script>
                      var oEdit1 = new InnovaEditor("oEdit1");					
                      oEdit1.width='100%';
                      oEdit1.height=300;			
                      oEdit1.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                      oEdit1.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                      oEdit1.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                      oEdit1.onSave = new Function("submitEditContentForm()");
                      oEdit1.REPLACE("description");		
                      oEdit1.mode="XHTMLBody";
                    </script>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="name" >Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?=(isset($testimonial->name))?$testimonial->name:set_value('name'); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                </div>
                
                <div class="form-group">
                    <label for="post">Position</label>
                    <input type="text" class="form-control" id="post" name="post" value="<?=(isset($testimonial->post))?$testimonial->post:set_value('post'); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'post') : '' ?></span>
                </div>
                </div>
                <div id="student_stories" style="<?=(isset($testimonial->type) && $testimonial->type=='stu')?'':'display:none;'?>">
                <div class="form-group">
                  <label for="youtube_vlink">Youtube Video Link</label>
                  <input type="text" class="form-control" id="youtube_vlink" name="youtube_vlink" value="<?=(isset($testimonial->youtube_vlink))?$testimonial->youtube_vlink:set_value('youtube_vlink'); ?>">
                </div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($testimonial->status) && $testimonial->status == '1')?true:'')?>> Active </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($testimonial->status) && $testimonial->status == '0')?true:'')?>> Inactive </label>
                    </div>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=base_url('admin/testimonial')?>" class="btn btn-warning">Cancel</a>
            </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->
  <script>
    $("#type").change(function(){
      var type = $(this).val();
      if(type == 'stu'){
        $("#student_stories").show();
        $("#success_stories").hide();
      }else{
        $("#student_stories").hide();
        $("#success_stories").show();
      }
    });
  </script>
<?=$this->endSection()?>