<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <title><?=(isset($exam_sch->exam_name))?$exam_sch->exam_name:'Professional Examination'?></title>
  </head>
  <body>
    <?php if($section == 1){ ?>
    <div class="container">
        <div class="text-center my-4">
            <div class="my-4">
                <img src="<?=base_url('public/assets/images/career-logo.png')?>" alt="logo" width="150px" height="100px">
            </div>
            <h1 class="my-4"><?=$exam_sch->exam_name?></h1>
            <h2 class="text-danger">Your Examination will be start after...</h2>
            <h1 id="time">00:00:00</h1>
        </div>
    </div>
    <?php }elseif($section == 2){ ?>
        <div class="container">
            
            <div class="text-center my-4">
                <div class="my-4">
                    <img src="<?=base_url('public/assets/images/career-logo.png')?>" alt="logo" width="150px" height="100px">
                </div>
                <h1 class="my-4"><?=$exam_sch->exam_name?></h1>
            </div>
            <div class="card py-4">
                <div class="card-title">
                    <h2 class="text-center">Login</h2>
                    <?php echo session()->getFlashdata('message'); ?>
                </div>
                <div class="card-body">
                    <form action="<?=current_url();?>" method="post">
                        <?=csrf_field();?>
                        <input type="hidden" name="exsch_id" value="<?=$exam_sch->id ?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Registration No.</label>
                                    <input type="text" class="form-control" name="reg_no" id="reg_no" value="<?=set_value('reg_no')?>">
                                    <small class="text-danger"><?php echo isset($validation) ? $validation->showError('reg_no') : ''; ?> </small>
                                </div>
                                <div class="form-group">
                                    <label for="">DOB.</label>
                                    <input type="date" class="form-control" name="dob" id="dob" value="<?=set_value('dob')?>">
                                    <small class="text-danger"><?php echo isset($validation) ? $validation->showError('dob') : ''; ?> </small>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <!-- <button type="button" class="btn btn-primary proceedBtn">Proceed</button> -->
                </div>
            </div>
        </div>
    <?php }elseif($section == 3){ ?>
        <div class="container">
            <nav class="navbar navbar-light bg-primary">
                <div class="container-fluid text-light">
                    <a class="navbar-brand text-light"><?=strtoupper($exam_sch->exam_name)?></a>
                    <h1 class="" id="time">00:00:00</h1>
                </div>
            </nav>
            <div class="card py-4">
                <div class="card-title">
                    <h2>परीक्षा निर्देश:</h2>
                </div>
                <div class="card-body">
                    <p>instruction-1</p>
                    <p>instruction-2</p>
                    <p>instruction-3</p>
                    <p>instruction-4</p>
                    <p>instruction-5</p>
                    <p>instruction-6</p>
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-primary" onclick="proceed();">Proceed</button>
                    <?php if(session()->has('examinee_id')){ 
                        $param = session('examinee_id').'-'.session('exsch_id').'-'.session('dh_id'); ?>
                    <a href="<?=base_url('pro-examination-exit/'.base64url_encode($param))?>" class="btn btn-danger" onclick="return confirm('Are u sure want to exit examination?');">Exit</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php /*
            if(session()->has('examinee_id')){
                $loginItemArray = ['examinee_id','exsch_id','dh_id','exam_url','examineelogin'];
                session()->remove($loginItemArray);
                //session()->destroy();
            } */
        ?>

    <?php } ?>
    <?php /*
        $h = date('h',strtotime($clock));
        $m = date('i',strtotime($clock));
        $s = date('s',strtotime($clock));
        // echo $h.':'.$m.':'.$s; exit;
    */ ?>
    <!-- alert modal -->
    <div class="modal fade" id="alertModal" aria-hidden="true" aria-labelledby="alertModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header bg-danger ">
                <h5 class="modal-title text-light" id="alertModalLabel">Alert</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center text-danger">
                <p>Your exam will be start after...</p>
                <p id="time2" class="fs-2 fw-bold">00:00:00</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <script>
        var span = document.getElementById('time');
        var span2 = document.getElementById('time2');
        var s = <?=$s?>;
        var m = <?=$m?>;
        var h = <?=$h?>;
        var tot_sec = <?=$total_sec?>;
        var intVal = null;
    </script>
    <?php if($section == 1){ ?>
    <script>
        function time() {
            s--;
            if(s < 1){
                m--;
                s = 59;
            }
            if(m < 1){
                h--;
                m = 59;
            }
            tot_sec--;
            if(tot_sec <= 900){
                window.location.reload();
            }
            span.textContent = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
        }
        setInterval(time, 1000);
    </script>
    <?php } ?>
    <?php if($section == 3){ ?>
    <script>
        function time() {
            if((tot_sec < 1) || (s == 0 && m == 0)){
                span.textContent = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
                span2.textContent = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
                window.location.href = '<?=$url?>';
                clearInterval(intVal);
                return false;
            }
           
            if(s < 1 && m >= 1){
                m--;
                s = 59;
            }
            span.textContent = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
            span2.textContent = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
            s--;
            tot_sec--;
        }
        $(document).ready(function(){
            intVal = setInterval(time, 1000);
        });
        
    </script>
    <script>
        function proceed(){
            if(tot_sec > 1){
                $("#alertModal").modal('show');
            }else{
                window.location.href = '<?=$url?>';
            }
        }
    </script>
    <?php } ?>
    <?php /*<script type="text/javascript" language="javascript">
        $(document).ready(function(){
            $(document).bind("contextmenu",function(e){
                e.preventDefault();
            });
        });
    </script> */ ?>
  

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>