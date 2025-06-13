
<?php /*echo session('token'); exit;*/?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2 col-md-3 sidebar" >
        <div class="side-navbar flex-wrap flex-column" id="sidebar">
          <!-- <nav class="navbar  navbar-field top-navbar hidbutton  ">
            <a class="btn border-1" id="open-menu-btn"><i class="fa-solid fa-xmark text-white"></i></a>
          </nav>
          <div class="logo-sidebar text-center pb-3">
            <a href="#" class="nav-links">
              <img alt="" src="<?=base_url('public/assets/images/side-bar-logo.png')?>">
            </a>
          </div> -->

          <?php echo view('member/student/stu_sidebar'); ?>

        </div>
      </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-11 rightPart ">
      <div class="main-boxx">
        <div class="p-1 container">
          <!-- Top Nav -->
          <nav class="navbar top-navbar navbar-light px-5">
            <a class="btn border-0" id="menu-btn"><i class="bx bx-menu"></i></a>
          </nav>
          <!--End Top Nav -->
          <div class="earn-boxxx">
            <div class="d-flex justify-content-between">
              <h3 class="side-head pt-4">Quiz Started</h3>
              <div class="">
                <a href="<?=base_url('quiz')?>" class="btn btn-primary">Back</a>
              </div>
            </div>
            <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
              <div class="alert alert-danger">
                  <?php echo session()->getFlashdata('alert_error'); ?>
              </div>
            <?php } //echo '<pre>'; print_r($subjects); exit;?>
            <div class="row pt-2">
                <div class="offset-md-3 col-md-6 pt-4">
                
                  <div class="card">
                    <?php if(!empty($quiz_ques)){
                      $tot_ques = sizeof($quiz_ques);
                      // echo '<pre>'; print_r($quiz_ques); 
                      // echo sizeof($quiz_ques); 
                      // exit;
                    $n = 0; $qno = 1;?>
                    <form action="<?=current_url()?>" method="post" id="examForm">
                      <?=csrf_field(); ?>
                    <div class="card-header">
                      <div class="d-flex justify-content-between">
                        <h2>Q.No <span id="qno"><?=$qno?></span> of <?=$tot_ques ?></h2>
                        <h2 class="text-end" id="time">00:00:00</h2>
                      </div>
                    </div>
                    <div class="card-body py-4">
                      <div class="row">
                        <?php foreach($quiz_ques as $k=>$list){ ?>
                        <div class="" id="q-card<?=$k?>" style="<?=($k<1)?'':'display:none'?>">
                        <input type="hidden" name="set_id" value="<?=$list->set_id?>">
                        <input type="hidden" name="q_ids[<?=$n?>]" value="<?=$list->_id?>">
                        <div class="col-md-12 mb-2">
                          <div class="card" >
                            <div class="card-header">
                              <h3 class="card-title"><?=$list->question ?></h3>
                            </div>
                            <div class="card-body">
                              <ul class="list-group list-group-flush">
                                <?php if(!empty($list->options)){
                                foreach($list->options as $l=>$li){ $l++; ?>
                                <li class="list-group-item">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="given_ans[<?=$n?>]" id="opt<?=$k.$l?>" value="<?=$l?>" >
                                    <label class="form-check-label" for="opt<?=$k.$l?>">
                                      <?=$li->option ?>
                                    </label>
                                  </div>
                                </li>
                                <?php if($li->correct){
                                  echo '<input type="hidden" name="correct_ans['.$n.']" value="'.$l.'">';
                                } ?>
                                <?php } $n++; } ?>
                                <!-- <li class="list-group-item">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                      Default radio
                                    </label>
                                  </div>
                                </li> -->
                              </ul>
                            </div>
                            <?php if($tot_ques == 1){
                              $preBtnStyle = $nextBtnStyle = 'display:none';
                            }elseif($k<1){
                              $preBtnStyle = 'display:none';
                              $nextBtnStyle = '';
                            } ?>
                            <div class="card-footer text-center">
                                <button type="button" class="btn btn-primary mx-2" style="<?=$preBtnStyle?>" id="prev-btn<?=$k?>" onclick="show_hide_question(<?=$k?>,<?=$k-1?>,<?=$qno-1?>)">Prev</button>
                                <button type="button" class="btn btn-primary" style="<?=$nextBtnStyle?>" id="next-btn<?=$k?>" onclick="show_hide_question(<?=$k?>,<?=$k+1?>,<?=$qno+1?>)">Next</button>
                            </div>
                          </div>
                        </div>
                        </div>
                        <?php $qno++; } ?>

                      </div>
                    </div>
                    <div class="card-footer text-end">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                    <?php }else{ ?>
                      <div class="card-body">
                        <p class="text-danger">No Exam Question!</p>
                      </div>
                    <?php } ?>
                  </div>
                </div>

            </div>

          </div>
        </div>
      </div>
    </main>
  </div>
    <!-- </div>
  </div> -->
  
  <style>
    .sub-img{
      width: 50px;
      height: 50px;
    }
  </style>

  <script>
    var span = document.getElementById('time');
    var h = 0;
    var m = <?=$time?>;
    var s = 0;
    var tot_sec = <?=$tot_sec?>;

    function time() {
      if((tot_sec < 1) || (s == 0 && m == 0 && h == 0)){
          span.textContent = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
          $("#examForm").submit();
          clearInterval(intVal);
          // $("#loader").show();
          return false;
      }
      /*else{
          $.ajax({
              type: 'POST',
              url: '<?=base_url('examination/update_examinee_duration')?>',
              data: {s:s, m:m, h:h, id:id},
              success: function(res){
                  
              }
          });
      }*/
      
      if(s < 1){
          m--;
          s = 59;
      }
      if(m < 1 && h > 1){
          h--;
          m = 59;
      }
      span.textContent = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
      s--;
      tot_sec--;
    }

    $(document).ready(function(){
        intVal = setInterval(time, 1000);
    });

    var tot_ques = <?=$tot_ques??0?>;
    /* ck = current key*/
    function show_hide_question(ck, k, qno){
      $("#next-btn"+ck).hide();
      $("#prev-btn"+ck).hide();
      $("#q-card"+ck).hide();
      $("#q-card"+k).show();
      $("#qno").html(qno);
    
      if(qno >= 2 && qno < tot_ques){
        $("#next-btn"+k).show();
        $("#prev-btn"+k).show();
      }else if(qno == 1){
        $("#next-btn"+k).show();
        $("#prev-btn"+k).hide();
      }else if(qno == tot_ques){
        $("#next-btn"+k).hide();
        $("#prev-btn"+k).show();
      }
    }
    
  </script>
  