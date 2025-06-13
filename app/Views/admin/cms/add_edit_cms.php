<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">CMS</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">add_edit_cms</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo (isset($cms))?'Edit CMS':'Add CMS'; ?></h6>
        </div>
        <div class="card-body">
            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="page">Page Name</label>
                    <?php /* <input type="text" class="form-control" id="page" name="page" value="<?=set_value('page', (isset($cms->page))?$cms->page:''); ?>" placeholder="Page Name">*/ ?>
                    <select name="page" id="page" class="form-control">
                        <option value="">Select One</option>
                        <option value="pp" <?=(isset($cms->page) && $cms->page == 'pp')?'selected':''?>>Privacy Policy</option>
                        <option value="tc" <?=(isset($cms->page) && $cms->page == 'tc')?'selected':''?>>Terms of use</option>
                    </select>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'page') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?=set_value('title', (isset($cms->title))?$cms->title:''); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'title') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="short_desc">Short Description</label>
                    <input class="form-control" type="text" id="short_desc" name="short_desc" value="<?=(isset($cms->short_desc))?$cms->short_desc:set_value('short_desc'); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'short_desc') : '' ?></span>
                </div>
                <div class="row">
                    <?php if(isset($cms->cms_banner) && $cms->cms_banner != ''){ ?>
                        <div class="col-md-6">
                            <img src="<?=base_url('public/assets/upload/images/'.$cms->cms_banner) ?>" width="150px" height="80px" />
                        </div>
                    <?php } ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CMS Banner</label>
                            <input type="file" class="form-control" id="cms_banner" name="cms_banner">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cms_banner') : '' ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description1">Description1</label>
                    <textarea class="form-control" id="description1" name="description1" rows="10"><?=(isset($cms->description1))?$cms->description1:set_value('description1'); ?></textarea>
                    <script>
                        var oEdit1 = new InnovaEditor("oEdit1");					
                        oEdit1.width='100%';
                        oEdit1.height=400;			
                        oEdit1.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                        oEdit1.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                        oEdit1.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                        oEdit1.onSave = new Function("submitEditContentForm()");
                        oEdit1.REPLACE("description1");		
                        oEdit1.mode="XHTMLBody";
                    </script>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description1') : '' ?></span>
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($cms->status) && $cms->status == '1')?true:'')?>> Active </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($cms->status) && $cms->status == '0')?true:'')?>> Inactive </label>
                    </div>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=base_url('admin/cms')?>" class="btn btn-warning">Cancel</a>
            </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->
<?=$this->endSection()?>