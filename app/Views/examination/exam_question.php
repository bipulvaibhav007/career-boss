<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <title><?=(isset($exschDtls->exam_name))?strtoupper($exschDtls->exam_name):'Professional Examination'?></title>
    <style>
        .loader {
            position: fixed;
            left: 50%;
            top: 50%;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid blue;
            border-right: 16px solid green;
            border-bottom: 16px solid red;
            width: 120px;
            height: 120px;
            z-index: 9999;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
  </head>
  <body>
    
        <?php $s = date('s',strtotime($examineeDtls->duration));
            $m = date('i',strtotime($examineeDtls->duration));
            $h = date('H',strtotime($examineeDtls->duration)); 
            $tot_sec = ($h*60*60) + ($m*60) + $s;
            // echo $tot_sec; exit;
            $id = $examineeDtls->id; ?>
        
        <div class="container">
            <nav class="navbar navbar-light bg-success">
                <div class="container-fluid text-light">
                    <div class="">
                        <a class="navbar-brand text-light"><?=strtoupper($examineeDtls->frstu_name)?></a>
                        <img src="<?=base_url('public/assets/upload/images/'.$examineeDtls->photo)?>" alt="photo" width="70px" height="70px">
                    </div>
                    <h1 class="" id="time">00:00:00</h1>
                </div>
            </nav>
            <?php if($examineeDtls->status == 1){ ?>
            <div class="card my-4 py-2 px-2">
                <div class="card-header d-flex justify-content-between">
                    <h2><?=strtoupper($exschDtls->exam_name)?></h2>
                    <span>Total Ques: <?=$exschDtls->tot_ques?></span>
                </div>
                <?php echo session()->getFlashdata('message'); ?>
                <form action="<?=current_url()?>" method="post" id="examPaper">
                <?=csrf_field(); ?>
                <input type="hidden" name="examinee_id" value="<?=$examineeDtls->id?>">
                <input type="hidden" name="tot_ques" value="<?=$exschDtls->tot_ques?>">
                <div class="card-body">
                    <?php 
                    $i = 0; $n = 1;
                    if($examineeDtls->ex_submit != ''){
                        $subQuestions = json_decode($examineeDtls->ex_submit);
                        foreach($subQuestions as $list){ ?>
                            <input type="hidden" name="qno[<?=$i?>]" value="<?=$list->qno?>">
                            <input type="hidden" name="c_ans[<?=$i?>]" value="<?=$list->c_ans?>">
                            <input type="hidden" name="q_title_en[<?=$i?>]" value="<?=$list->q_title_en?>">
                            <input type="hidden" name="q_title_hn[<?=$i?>]" value="<?=$list->q_title_hn?>">
                            <input type="hidden" name="opt1[<?=$i?>]" value="<?=$list->opt1?>">
                            <input type="hidden" name="opt2[<?=$i?>]" value="<?=$list->opt2?>">
                            <input type="hidden" name="opt3[<?=$i?>]" value="<?=$list->opt3?>">
                            <input type="hidden" name="opt4[<?=$i?>]" value="<?=$list->opt4?>">
                            <div class="card pb-2 px-2 mb-2">
                            <div class="form-group row">
                                <label for="" class="fs-5 fw-bold">Q.<?=$n.'. '. $list->q_title_en ?></label>
                                <div class="col-md-12 px-4 py-2 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="answer[<?=$i?>]" id="opt1<?=$i?>" value="A" <?=($list->answer == 'A')?'checked':''?>>
                                        <label class="form-check-label" for="opt1<?=$i?>"><?=$list->opt1?></label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="answer[<?=$i?>]" id="opt2<?=$i?>" value="B" <?=($list->answer == 'B')?'checked':''?>>
                                        <label class="form-check-label" for="opt2<?=$i?>"><?=$list->opt2?></label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="answer[<?=$i?>]" id="opt3<?=$i?>" value="C" <?=($list->answer == 'C')?'checked':''?>>
                                        <label class="form-check-label" for="opt3<?=$i?>"><?=$list->opt3?></label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="answer[<?=$i?>]" id="opt4<?=$i?>" value="D" <?=($list->answer == 'D')?'checked':''?>>
                                        <label class="form-check-label" for="opt4<?=$i?>"><?=$list->opt4?></label>
                                    </div>
                                </div>
                            </div>
                            </div>
                    <?php $i++; $n++;} } ?>
                    <?php if(!empty($questions)){ $k = $i;
                        foreach($questions as $list){ ?>
                            <input type="hidden" name="qno[<?=$k?>]" value="<?=$list->qno?>">
                            <input type="hidden" name="c_ans[<?=$k?>]" value="<?=$list->c_ans?>">
                            <input type="hidden" name="q_title_en[<?=$k?>]" value="<?=$list->q_title_en?>">
                            <input type="hidden" name="q_title_hn[<?=$k?>]" value="<?=$list->q_title_hn?>">
                            <input type="hidden" name="opt1[<?=$k?>]" value="<?=$list->opt1?>">
                            <input type="hidden" name="opt2[<?=$k?>]" value="<?=$list->opt2?>">
                            <input type="hidden" name="opt3[<?=$k?>]" value="<?=$list->opt3?>">
                            <input type="hidden" name="opt4[<?=$k?>]" value="<?=$list->opt4?>">
                            <div class="card pb-2 px-2 mb-2">
                            <div class="form-group row">
                                <label for="" class="fs-5 fw-bold">Q.<?=$n.'. '. $list->q_title_en ?></label>
                                <div class="col-md-12 px-4 py-2 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="answer[<?=$k?>]" id="opt1<?=$k?>" value="A">
                                        <label class="form-check-label" for="opt1<?=$k?>"><?=$list->opt1?></label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="answer[<?=$k?>]" id="opt2<?=$k?>" value="B">
                                        <label class="form-check-label" for="opt2<?=$k?>"><?=$list->opt2?></label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="answer[<?=$k?>]" id="opt3<?=$k?>" value="C">
                                        <label class="form-check-label" for="opt3<?=$k?>"><?=$list->opt3?></label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="answer[<?=$k?>]" id="opt4<?=$k?>" value="D">
                                        <label class="form-check-label" for="opt4<?=$k?>"><?=$list->opt4?></label>
                                    </div>
                                </div>
                            </div>

                            </div>
                    <?php $k++; $n++; } } 
                    if($examineeDtls->ex_submit == '' && empty($questions)){
                        echo '<p class="text-danger">Something Wrong!</p>';
                    } ?>
                </div>
                <?php if($examineeDtls->ex_submit != '' || !empty($questions)){ ?>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are u sure to submit your examination?');">Submit</button>
                    <?php if(session()->has('examinee_id')){ 
                        $param = session('examinee_id').'-'.session('exsch_id').'-'.session('dh_id'); ?>
                    <a href="<?=base_url('pro-examination-exit/'.base64url_encode($param))?>" class="btn btn-danger" onclick="return confirm('Are u sure want to exit examination?');">Exit</a>
                    <?php } ?>
                </div>
                <?php } ?>
                </form>
            </div>
            <?php }elseif($examineeDtls->status == 2){ ?>
                <div class="container">
                    <div class="alert alert-danger">
                        <h2>You have done your examination.</h2>
                    </div>
                </div>
            <?php }else{
                echo 
                '<div class="container">
                    <div class="alert alert-danger">
                        <h2>Some thing went wrong.</h2>
                    </div>
                </div>';
            } ?>
        </div>
        <div class="loader" id="loader" style="display:none;"></div>
            
        <?php /*
            if(session()->has('examinee_id')){
                $loginItemArray = ['examinee_id','exsch_id','dh_id','exam_url','examineelogin'];
                session()->remove($loginItemArray);
                //session()->destroy();
            }*/
        ?>

    <?php if($examineeDtls->status == 1){ ?>
    <script>
        var span = document.getElementById('time');
        var s = <?=$s?>;
        var m = <?=$m?>;
        var h = <?=$h?>;
        var id = <?=$id?>;
        var tot_sec = <?=$tot_sec?>;
        var intVal = null;
    
        function time() {
            if((tot_sec < 1) || (s == 0 && m == 0 && h == 0)){
                span.textContent = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
                $("#examPaper").submit();
                clearInterval(intVal);
                $("#loader").show();
                return false;
            }else{
                $.ajax({
                    type: 'POST',
                    url: '<?=base_url('examination/update_examinee_duration')?>',
                    data: {s:s, m:m, h:h, id:id},
                    success: function(res){
                        
                    }
                });
            }
            
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
    </script>
    <script>
        var $radioes = $('input[type=radio]');
        $radioes.click(function(){
            var frm = $("#examPaper");
            var formData = new FormData(frm[0]);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('examination/save_result') ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                //data: {name :name,email : email},
                success: function(res){
                    console.log(res);
                }
            });
        });
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