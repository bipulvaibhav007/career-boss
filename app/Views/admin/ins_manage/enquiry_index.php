<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<?php $adminmodel = model('App\Models\Admin_model', false); 
  $getQuery = service('uri')->getQuery(); 
?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between my-3">
      <h1 class="h3 mb-0 text-gray-800">Contact (<?=$countAll?>)</h1>
      <?php /* <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">enquiry</li>
      </ol> */ ?>
      <div>
        <a class="btn btn-primary filter" href="javascript:void(0)">Filter</a>
        <!-- <a class="btn btn-primary filter" data-toggle="modal" data-target="#filterModal" href="javascript:void(0)">Filter</a> -->
        <a class="btn btn-outline-primary" data-toggle="modal" data-target="#BroadcastModal" href="#">Broadcast</a>
        <a class="btn btn-outline-primary"data-toggle="modal" data-target="#importModal" href="#">Import</a>
        <a class="btn btn-info" href="<?=base_url('admin/enquiry_cu')?>">Add Contact</a>
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Action
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <?php if(is_privilege(16,6) && isset($_GET['status']) && $_GET['page']){ ?>
            <!-- <a class="dropdown-item" href="<?=base_url('admin/enquiry_export_to_excel/'.$_GET['status'].'/'.$_GET['page'])?>">Export</a> -->
            <a class="dropdown-item" href="<?=base_url('admin/enquiry_export_to_excel?'.$getQuery)?>">Export</a>
          <?php } ?>
            <a class="dropdown-item" href="#">Import History</a>
            <a class="dropdown-item" href="#">Manage Tags</a>
        </div>
      </div>
    </div>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <div class="card mb-1">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <div class="row">
            <div class="col-md-12">
              <div class="newcnf">
                <a href="<?=base_url('admin/enquiry?status=1')?>" class="btn btn-outline-primary mr-1 d-inline-block <?=(isset($_GET['status']) && $_GET['status'] == 1)?'active':''?>">New (<?=$countNew?>)</a>
                <a href="<?=base_url('admin/enquiry?status=2')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 2)?'active':''?>">WhatsApp (<?=$countWhatsApp?>)</a>
                <a href="<?=base_url('admin/enquiry?status=7')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 7)?'active':''?>">Non-WhatsApp (<?=$countNonWhatsApp?>)</a>
                <a href="<?=base_url('admin/enquiry?status=3')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 3)?'active':''?>">Discussion (<?=$countDiscussion?>)</a>
                <a href="<?=base_url('admin/enquiry?status=4')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 4)?'active':''?>">Completed (<?=$countComp?>)</a>
                <a href="<?=base_url('admin/enquiry?status=5')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 5)?'active':''?>">Rejected (<?=$countReject?>)</a>
                <a href="<?=base_url('admin/enquiry?status=6')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 6)?'active':''?>">Follow-up (<?=$countFollowup?>)</a>
                <a href="<?=base_url('admin/enquiry?status=8')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 8)?'active':''?>">Do Online (<?=$countDoOnline?>)</a>
                <a href="<?=base_url('admin/enquiry?status=a')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 'a')?'active':''?>">All (<?=$countAll?>)</a>

              </div>
            </div>
            <div class="col-md-6 py-2">
              <div class="form-panel">
                <form class="d-flex" action="<?=base_url('admin/enquiry')?>" method="get">
                  <input type="hidden" name="status" value="a">
                  <input type="text" class="form-control mr-2 d-inline-block" name="search" value="<?=(isset($_GET['search']))?$_GET['search']:''?>" placeholder="Name & Mobile No" id="name">
                  <select name="course_for" id="course_for" class="form-control mr-2">
                    <option value="">Course For</option>
                    <?php if(!empty($courses)){
                      foreach($courses as $list){ ?>
                        <option value="<?=$list->course_id?>" <?=(isset($_GET['course_for']) && $_GET['course_for'] == $list->course_id)?'selected':''?>><?=$list->course_full_name?></option>
                    <?php } } ?>
                  </select>
                  <button type="submit" class="btn btn-primary mr-2">Search</button>
                  <a href="<?=base_url('admin/reset_enqurl')?>" class="btn btn-warning">Reset</a>
                </form>
              </div>
            </div>
            <div class="col-md-6 py-2">
              <?php /* if(is_privilege(16,6)){ ?>
              <a href="<?=base_url('admin/enquiry_export_to_excel/'.$_GET['status'].'/'.$_GET['page'])?>" class="btn btn-dark">Export to Excel</a>
              <?php } */?>
              <?php if(isset($_GET['status']) && $_GET['status'] == 2){ ?>
                <a href="<?=base_url('admin/send_whatsapp_message_to_enquiry/'.$_GET['page'])?>" class="btn btn-success" onclick="return confirm('Are you sure want to send WhatsApp message?')">Send<i class="fab fa-whatsapp-square" style="font-size:24px;color:red"></i>Message</a>
              <?php } ?>
              <?php /* if(is_privilege(16,2)){ ?>
              <a href="<?=base_url('admin/enquiry_cu')?>" class="btn btn-primary">Add Enquiry</a>
              <?php }*/ ?>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover" style="table-layout: fixed; width: 100%">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Candidate Name</th>
                    <th>Mobile No</th>
                    <th>Address</th>
                    <th>Course For</th>
                    <th>Ref. By</th>
                    <?php $status = (isset($_GET['status']))?$_GET['status']:'';
                    if($status == '2'){
                        echo '<th>WhatsApp Last Status</th>';
                    } ?>
                    <th>Tag</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($enquiry)){
                    $page = (isset($_GET['page']))?$_GET['page']:'';
                    if($page == 1){
                        $sn=1;
                    }else{
                        $sn = $limit * ($page-1) + 1;
                    }
                    foreach($enquiry as $list){ 
                    $statusArr = array();
                    $statusArr = explode(',', $list->status);
                    $status = (isset($_GET['status']))?$_GET['status']:'';
                    $statusTxt = '';
                    $stat = array();
                    if($status == 'a'){
                      if(in_array(1, $statusArr)){
                        $stat[] = '<span class="badge badge-primary">New</span>';
                      }
                      if(in_array(2, $statusArr)){
                        $stat[] = '<span class="badge badge-success">WhatsApp</span>';
                      }
                      if(in_array(3, $statusArr)){
                        $stat[] = '<span class="badge badge-dark">Discussion</span>';
                      }
                      if(in_array(4, $statusArr)){
                        $stat[] = '<span class="badge badge-success">Completed</span>';
                      }
                      if(in_array(5, $statusArr)){
                        $stat[] = '<span class="badge badge-danger">Rejected</span>';
                      }
                      if(in_array(6, $statusArr)){
                        $stat[] = '<span class="badge badge-info">Follow-up</span>';
                      }
                      if(in_array(7, $statusArr)){
                        $stat[] = '<span class="badge badge-primary">Non-WhatsApp</span>';
                      }
                      if(in_array(8, $statusArr)){
                        $stat[] = '<span class="badge badge-dark">Do Online</span>';
                      }
                      $statusTxt = implode(' ', $stat);

                    }else{
                      if($status == '1' && in_array(1, $statusArr)){
                        $statusTxt = '<span class="badge badge-primary ">New</span>';
                      }elseif($status == '2' && in_array(2, $statusArr)){
                        $statusTxt = '<span class="badge badge-success ">WhatsApp</span>';
                      }elseif($status == '3' && in_array(3, $statusArr)){
                        $statusTxt = '<span class="badge badge-dark ">Discussion</span>';
                      }elseif($status == '4' && in_array(4, $statusArr)){
                        $statusTxt = '<span class="badge badge-success ">Completed</span>';
                      }elseif($status == '5' && in_array(5, $statusArr)){
                        $statusTxt = '<span class="badge badge-danger ">Rejected</span>';
                      }elseif($status == '6' && in_array(6, $statusArr)){
                        $statusTxt = '<span class="badge badge-info ">Follow-up</span>';
                      }elseif($status == '7' && in_array(7, $statusArr)){
                        $statusTxt = '<span class="badge badge-primary ">Non-WhatsApp</span>';
                      }elseif($status == '8' && in_array(8, $statusArr)){
                        $statusTxt = '<span class="badge badge-dark ">Do Online</span>';
                      }
                    } 
                    ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><?=date('d-m-Y',strtotime($list->added_at))?></td>
                        <td><a href="<?= base_url('/admin/enquiry_view/'.$list->enq_id) ?>"><?=$list->c_name?></a></td>
                        <?php /*<td><span class="d-flex align-items-center"><?=(in_array(2, $statusArr))?'<i class="fab fa-whatsapp-square mr-2" style="font-size:24px;color:red"></i>':''?><a href="https://api.whatsapp.com/send/?phone=%2B91<?=$list->phone1?>&text=Hello%20<?=$list->c_name?>,%0A%0AWe%20have%20received%20your%20response.%20Our%20team%20will%20contact%20you%20soon.%0A%0AYou%20can%20explore%20our%20channels%20and%20please%20do%20like,%20follow%20and%20subscribe.%0Ahttps://instagram.com/careerbossinstitute%0Ahttps://facebook.com/careerbossinstitute%0Ahttps://youtube.com/@careerbossinstitute%0A%0AThank%20you%0ACareer%20Boss%20Team&app_absent=0" target="_blank" ><?=$list->phone1?></a></span></td> */ ?>
                        <td><span class="d-flex align-items-center"><?=(in_array(2, $statusArr))?'<i class="fab fa-whatsapp-square mr-2" style="font-size:24px;color:red"></i>':''?><a href="https://api.whatsapp.com/send/?phone=%2B91<?=$list->phone1?>&text=Greetings%20from%20Career%20Boss%20Institute,%0A%0ACareer%20Boss%20Institute%20ने%20अब%20आरा%20शहर%20में%20IT%20Professional%20Courses%20स्थापित%20किए%20हैं,%20जहाँ%20पर%20छात्र%20सिख%20कर%20100%%20गारंटी%20के%20साथ%20नौकरी%20पा%20सकते%20है%0A%0A*कोर्सेज%20नीचे%20दिए%20गए%20हैं:*%0A%0A1.%20Software%20Development%0A2.%20Digital%20Marketing%0A3.%20Web%20Development%0A4.%20Full%20Stack%20Development%0A5.%20Graphic%20Designing%0A6.%20Image%20and%20Video%20Editing%0A7.%20BCA%20Tuitions%20(%20All%20Semester%20)%0A8.%20DCA/ADCA/DTP%0A%0Aअधिक%20जानकारी%20के%20लिए%20कृपया%20हमारी%20वेबसाइट%20(https://career-boss.com/)%20पर%20जाएं।%0A%0Aआप%20हमारे%20चैनल%20देख%20सकते%20हैं%20और%20कृपया%20लाइक,%20फॉलो%20और%20सब्सक्राइब%20करें।%0Ahttps://instagram.com/careerbossinstitute%0Ahttps://facebook.com/careerbossinstitute%0Ahttps://youtube.com/@careerbossinstitute%0A%0Aधन्यवाद%0ACareer%20Boss%20Institute&app_absent=0" target="_blank" ><?=$list->phone1?></a></span></td>
                        <td style="word-wrap: break-word"><?=$list->address?></td>
                        <td>
                            <?=$list->course_full_name ?>
                        </td>
                        <td><?=($list->ref_by == 'other')?$list->refree_name:$list->ref_by?></td>
                        <?php
                            if($status == '2'){ ?>
                                <?php /* <td><?=($list->wh_msg_send_date != '0000-00-00 00:00:00')?date('d-M-Y',strtotime($list->wh_msg_send_date)):'--';?></td> */ ?>
                                <?php $lastWhStatus = $adminmodel->getLastWhatsAppStatus($list->phone1); 
                                if(!empty($lastWhStatus)){
                                  echo '<td>'.get_badge_wh_status($lastWhStatus->status).'<br>'.date('d-m-Y h:i A', strtotime($lastWhStatus->added_at)).'</td>';
                                }else{
                                  echo '<td>N/A</td>';
                                }
                                ?>
                        <?php } ?>
                        <td><?=$statusTxt?></td>
                        <td>
                            <?php if(is_privilege(16,3)){ ?>
                            <a href="<?= base_url('/admin/enquiry_cu/'.$list->enq_id) ?>" class="btn btn-outline-info btn-sm" role="button" title="Edit"><i class="fas fa-edit"></i></a>
                            <?php } ?>
                            <?php if(is_privilege(16,4)){ ?>
                            <a href="<?= base_url('/admin/enquiry_view/'.$list->enq_id) ?>" class="btn btn-outline-info btn-sm" role="button" title="View"><i class="fas fa-eye"></i></a>
                            <?php } ?>
                            <?php if(!in_array(2, $statusArr)){ 
                              if(is_privilege(16,7)){ ?>
                              <a href="<?=base_url('admin/set_enq_whatsapp_number/'.$list->enq_id.'/y')?>" class="btn btn-outline-warning btn-sm" role="button" title="WhatsApp Mark"><i class='fab fa-whatsapp-square' style='font-size:24px'></i></a>
                            <?php } }else if(in_array(2, $statusArr)){ 
                              if(is_privilege(16,8)){ ?>
                              <a href="<?=base_url('admin/set_enq_whatsapp_number/'.$list->enq_id.'/n')?>" class="btn btn-outline-warning btn-sm" role="button" title="WhatsApp UnMark"><i class='fab fa-whatsapp-square' style='font-size:24px'></i></a>
                            <?php } } ?>
                              <a href="<?=base_url('admin/set_non_whatsapp_number/'.$list->enq_id)?>" class="btn btn-outline-danger btn-sm" title="Non-WhatsApp"><img src="<?=base_url('public/assets/images/non-whatsapp.jpg');?>" width="25px" height="25px"></a>
                            <?php if(is_privilege(16,5)){ ?>
                            <a href="<?= base_url('/admin/delete_enquiry/'.$list->enq_id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info btn-sm" role="button" style="color:red" title="Delete"><i class="fas fa-trash"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } } else { ?>
                        <tr><td colspan="3">No Data Available</td></tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="8" class="text-center">
                      <?php if($count_current_enquiry > 0){
                        $total_page = ceil($count_current_enquiry / $limit);
                        $status = (isset($_GET['status']))?$_GET['status']:'';
                        $page = (isset($_GET['page']))?$_GET['page']:'';
                        $btn_limit = 5;
                        if($page != ''){
                          // echo ceil($page/$btn_limit).'--'; 
                          // echo floor($page/$btn_limit); 
                          // exit;
                          if(floor($page/$btn_limit) < 1){
                            $i_ = 1;
                          }else{
                            $i_ = floor($page/$btn_limit)*$btn_limit;
                          }
                          if($i_ > 1){
                            $f_URL = base_url('admin/enquiry?status='.$status.'&search=&page=1');
                            $pre_URL = base_url('admin/enquiry?status='.$status.'&search=&page='.$i_-1);
                            
                            echo '<a href="'.$f_URL.'" class="btn btn-outline-primary"><strong><<</strong></a>';
                            echo '<a href="'.$pre_URL.'" class="btn btn-outline-primary"><strong><</strong></a>';
                          }
                          for($i=$i_; $i<($i_+$btn_limit) && $i<=$total_page; $i++){ 
                            $cur_URL = base_url('admin/enquiry?status='.$status.'&search=&page='.$i);
                            $actv = ($page == $i)?'active':'';
                          ?>
                            <a href="<?=$cur_URL?>" class="btn btn-outline-primary <?=$actv?>"><?=$i?></a>

                      <?php }
                        if($page != $total_page && $i <= $total_page){
                            $next_URL = base_url('admin/enquiry?status='.$status.'&search=&page='.$i);
                            $l_URL = base_url('admin/enquiry?status='.$status.'&search=&page='.$total_page);
                            echo '<a href="'.$next_URL.'" class="btn btn-outline-primary"><strong>></strong></a>';
                            echo '<a href="'.$l_URL.'" class="btn btn-outline-primary"><strong>>></strong></a>';
                        }
                      
                      } } ?>
                    </td>
                  </tr>
                </tfoot>
             </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---Container Fluid-->

  <!-- Modal -->
  <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="<?=base_url('admin/change_enquiry_status'); ?>" method="post" onsubmit="return validatechangestatus();">
          <?=csrf_field(); ?>
          <input type="hidden" name="enq_id" id="enq_id" value="">
          <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="changeStatusModalLabel"> Change Status</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status[]" id="status" class="form-control" multiple>
                <option value="">Select Multiple</option>
                <option value="1">New</option>
                <option value="2">WhatsApp</option>
                <!-- <option value="3">Cancel</option>
                <option value="4">CNF</option>
                <option value="5">Appeared</option>
                <option value="7">Backlog</option> -->
              </select>
              <span class="text-danger" id="statusErr"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <!-- Modal -->
  <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content p-4">
        <div class="modal-headers d-flex justify-content-between ">
          <h4 class="modal-title" id="exampleModalLabel"><b>Contact Import</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="file-upload py-3 d-flex justify-content-between ">
          <div class="">
            <label for="formFile" class="form-label"><b>Upload File</b></label>
            <input class="form-control" type="file" id="formFile">
          </div>
          <div class="pt-4">
            <button type="button" class="btn btn-info px-4 mt-2">Submit</button>
          </div>
        </div>
        <p class="mb-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis, repellendus.</p>
      
        <!-- <div class="modal-footers ">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="BroadcastModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content p-4">
        <div class="modal-headers d-flex justify-content-between ">
          <h4 class="modal-title" id="exampleModalLabel"><b>Broadcast</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="file-upload  py-3 ">
        <div class="row pt-4">
          <div class="col-3 pt-2"><h5>Template Name</h5></div>
          <div class="form-group col-3">
            <input type="number" class="form-control border-secondary " id="exampleFormControlInput1">
          </div>
        </div>
        <div class=" row">
          <div class="col-3 "><h5>Template</h5></div>
          <div class="form-group col-3">
            <select class="form-control w-100" id="exampleFormControlSelect1">
              <option>Selected Name</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div>
        <div class="row pt-4">
          <div class="col-3 pt-2"><h5>No. of user</h5></div>
          <div class="form-group col-3">
            <input type="number" class="form-control border-secondary " id="exampleFormControlInput1">
          </div>
        </div>
        </div>
        <div class="">
          <button type="button" class="btn btn-info px-4 mt-2">Submit</button>
        </div>
      
        <!-- <div class="modal-footers ">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg " role="document">
      <div class="modal-content p-4">
        <div class="modal-headers d-flex justify-content-between">
          <h4 class="text-black"><b>Filter Contact</b></h4>
          <button type="button" class="close px-3 " data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="">
          <p class="text-danger" id="error"></p>
        </div>

        <form action="<?=base_url('admin/enquiry');?>" method="post" onsubmit="return validateFilter();" id="filtercontact">
          <?=csrf_field(); ?>
        <div class="py-2">
          <h6 class="text-black"><b>Last Seen</b>
            <button type="button" class="btn lsBtn"> 
              <i class="fa fa-times"></i>
            </button>
          </h6>
          
            <div class="row">
              <!-- <div class="col-6">
                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                  <label class="btn btn-secondary py-2 ">
                    <input class="form-control" type="radio" name="options" id="option1" checked> In 2 hr
                  </label>
                  <label class="btn btn-secondary py-2">
                    <input type="radio" name="options" id="option2"> This Week
                  </label>
                  <label class="btn btn-secondary py-2">
                    <input type="radio" name="options" id="option3"> This Month
                  </label>
                </div>
              </div> -->
              <div class="col-4">
                <!-- <div class="input-group"> -->
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="From" name="lsfromDate" value="" id="lsfromDate" autocomplete="off">
                </div>
                <!-- <div class="form-group">
                  <input type="text" class="form-control" id="">
                </div> -->
              </div>
              <div class="col-4">
                <div class="form-group">
                  <input type="text"  class="form-control" placeholder="To" name="lstoDate" value="" id="lstoDate" autocomplete="off">
                </div>
              </div>
            </div>
        </div>
        <div class="py-2">
          <h6 class="text-black"><b>Created At</b>
            <button type="button" class="btn caBtn"> 
              <i class="fa fa-times"></i>
            </button>
          </h6>
            <div class="row">
              <!-- <div class="col-6">
                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                  <label class="btn btn-secondary py-2 ">
                    <input class="form-control" type="radio" name="options" id="option1" checked> In 2 hr
                  </label>
                  <label class="btn btn-secondary py-2">
                    <input type="radio" name="options" id="option2"> This Week
                  </label>
                  <label class="btn btn-secondary py-2">
                    <input type="radio" name="options" id="option3"> This Month
                  </label>
                </div>
              </div> -->
              <div class="col-4">
                <!-- <div class="col-auto">
                  <label class="sr-only py-2 " for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2 ">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa-light fa-calendar"></i></div>
                    </div>
                    <input type="text" class="form-control py-2" id="inlineFormInputGroup" placeholder="From">
                  </div>
                </div> -->
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="From" name="cafromDate" value="" id="cafromDate" autocomplete="off">
                
                </div>
              </div>
              <div class="col-4">
               
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="To" name="catoDate" value="" id="catoDate" autocomplete="off">
                </div>
              </div>
            </div>
        </div>
        
        <div class="my-4">
          <h6 class="text-black"><b>Attribute</b></h6>
          <!-- row1 -->
          <?php $t_rows = 4;
          for($i=1; $i <= $t_rows; $i++){ ?>
          <div class="row pb-2">
            <div class="col-3">
              <select class="form-select w-100 p-2 border-2 rounded attribute" name="attribute[]" data-key="r<?=$i?>">
                <option value="" selected>Select Attribute</option>
                <option value="1">Tag</option>
                <option value="2">Name or Mobile No</option>
                <option value="3">Course For</option>
              </select>
            </div>
            <div class="col-3">
              <select class="form-select w-100 p-2 rounded" name="amsign[]">
                <option value="e" selected>Is equal to</option>
                <option value="ne">Is not equal to</option>
              </select>
            </div>
            <div class="col-3" id="info_r<?=$i?>">
              <span class="text-danger">Please select attribute!</span>
            </div>
            <div class="col-3" style="display:none;" id="tag_r<?=$i?>">
              <select class="form-select w-100 p-2 rounded " name="attrvalue1[]">
                <option value="1">New</option>
                <option value="2">WhatsApp</option>
                <option value="3">Discussion</option>
                <option value="4">Completed</option>
                <option value="5">Rejected</option>
                <option value="6">Follow-up</option>
                <option value="7">Non-WhatsApp</option>
                <option value="a">All</option>
              </select>
            </div>
            <div class="col-3" style="display:none;" id="name_r<?=$i?>">
                <input type="text" name="attrvalue2[]" id="" class="form-control" value="">
            </div>
            <div class="col-3" style="display:none;" id="course_r<?=$i?>">
              <select class="form-select w-100 p-2 rounded " name="attrvalue3[]">
                <?php if(!empty($courses)){
                  foreach($courses as $list){ ?>
                    <option value="<?=$list->course_id?>"><?=$list->course_full_name?></option>
                <?php }
                } ?>
              </select>
            </div>
            <?php if($i != $t_rows){ ?>
            <div class="col-2">
              <select class="form-select w-100 p-2 rounded " name="condition[]">
                <option value="and" selected>And</option>
                <option value="or">Or</option>
              </select>
            </div>
            <?php } ?>
            <!-- <div class="col-1">
              <button type="button" class="btn ">
                <i class="fa fa-times"></i>
              </button>
            </div> -->
          </div>
          <?php } ?>
          <!-- end row1 -->

        </div>
        <script>
          $(".attribute").change(function(){
            var attribute = $(this).val();
            var key = $(this).data("key");
            $("#info_"+key).hide();
            $("#tag_"+key).hide();
            $("#name_"+key).hide();
            $("#course_"+key).hide();
            if(attribute == 1){
              $("#tag_"+key).show();
            }else if(attribute == 2){
              $("#name_"+key).show();
            }else if(attribute == 3){
              $("#course_"+key).show();
            }else{
              $("#info_"+key).show();
            }
            // alert(attribute + key);
          });
          function validateFilter(){
            $("#error").html('');
            var lsfromDate = $("#lsfromDate").val();
            var lstoDate = $("#lstoDate").val();
            var cafromDate = $("#cafromDate").val();
            var catoDate = $("#catoDate").val();
            var attr = '';
            $(".attribute").each(function(){
              // alert($(this).val());
              
              if($(this).val() != ''){
                attr = $(this).val();
              }
            });
            if(lsfromDate == '' && lstoDate == '' && cafromDate == '' && catoDate == '' && attr == ''){
              $("#error").html('Please fill correct credentials!');
              return false;
            }
            return true;
          }
          
        </script>
       
        <div class="modal-footers justify-content-start">
          <button type="submit" class="btn btn-success" >Apply</button>
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
          <button type="button" class="btn btn-secondary clearAll" >Clear All</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
  <script>
    $(".filter").click(function(){
      $("#lsfromDate, #lstoDate, #cafromDate, #catoDate").val("");
      $("#error").html('');
      $("#filterModal").modal("show");
    });
    $(".lsBtn").click(function(){
      $("#lsfromDate").val("");
      $("#lstoDate").val("");
    });
    $(".caBtn").click(function(){
      $("#cafromDate").val("");
      $("#catoDate").val("");
    });
    $(function(){
      $("#lsfromDate").datepicker({
        dateFormat: 'dd-M-yy',
        todayHighlight: true,
      });
      $("#lstoDate").datepicker({
        dateFormat: 'dd-M-yy',
        todayHighlight: true,
      });
      $("#cafromDate").datepicker({
        dateFormat: 'dd-M-yy',
        todayHighlight: true,
      });
      $("#catoDate").datepicker({
        dateFormat: 'dd-M-yy',
        todayHighlight: true,
      });
    });

    $(".changeStatus").click(function(){
      var id = $(this).data("id");
      var status = $(this).data("status");
      //const statusArr = status.split(",");
      //alert(statusArr[0]);return 0;
      $("#enq_id").val(id);
      //alert(id);
      $("#changeStatusModal").modal("show");

    });
    function validatechangestatus(){
      var status = $("#status").val();
      if(status == ''){
        $("#statusErr").html("Please select status!");
        return false;
      }
      return true;
    }
    $(".clearAll").click(function(){
      // $('#filtercontact').find('input[type=text], select').each(function(){
      //   $(this).val('');
      // });
      $('#filtercontact')[0].reset();
    });
  </script>
<?=$this->endSection()?>
  