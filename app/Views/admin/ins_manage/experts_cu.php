<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Experts</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">experts_cu</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo (isset($expert))?'Edit Expert':'Add Expert'; ?></h6>
        </div>
        <div class="card-body">
            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?=set_value('name', (isset($expert->name))?$expert->name:''); ?>" placeholder="Name">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                </div>
                <div class="row">
                    <?php if(isset($expert->image) && $expert->image != ''){ ?>
                        <div class="col-md-6">
                            <img src="<?=base_url('public/assets/upload/images/'.$expert->image) ?>" width="150px" height="80px" />
                        </div>
                    <?php } ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'image') : '' ?></span>
                        </div>
                    </div>
                </div>
                <?php /*<div class="form-group">
                    <label for="banner_title">Banner Title</label>
                    <input type="text" class="form-control" id="banner_title" name="banner_title" value="<?=set_value('banner_title', (isset($expert->banner_title))?$expert->banner_title:''); ?>" placeholder="Banner Title">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'banner_title') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="banner_head">Banner Heading</label>
                    <input class="form-control" type="text" id="banner_head" name="banner_head" value="<?=(isset($expert->banner_head))?$expert->banner_head:set_value('banner_head'); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'banner_head') : '' ?></span>
                </div> */ ?>
                
                <div class="form-group">
                    <label for="short_desc">Short Description</label>
                    <textarea class="form-control" id="short_desc" name="short_desc" rows="4" placeholder="Short Description"><?=(isset($expert->short_desc))?$expert->short_desc:set_value('short_desc'); ?></textarea>
                    <?php /* <script>
                        var oEdit1 = new InnovaEditor("oEdit1");					
                        oEdit1.width='100%';
                        oEdit1.height=400;			
                        oEdit1.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                        oEdit1.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                        oEdit1.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                        oEdit1.onSave = new Function("submitEditContentForm()");
                        oEdit1.REPLACE("short_desc");		
                        oEdit1.mode="XHTMLBody";
                    </script> */ ?>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'short_desc') : '' ?></span>
                </div>
                
                <div class="form-group">
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
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=base_url('admin/experts')?>" class="btn btn-warning">Cancel</a>
            </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->
<?=$this->endSection()?>