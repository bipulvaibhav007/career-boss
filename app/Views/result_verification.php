<style>
    .franchise-section{
        /* padding-top: 50px; */
        width: 100%;
        min-height: 500px;
        /* color: white; */
        /* background-color: DodgerBlue; */
        /* text-align: center; */
    }
</style>
<div class="franchise-section">
    <div class="banner-stripe">
        <h2 class="text-center">Result Verification</h2>
    </div>
    <div class="container">
        <form class="w-50 mx-auto" action="<?=current_url();?>" method="get">
            <div class="row">
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="cert_no" id="cert_no" value="<?=(isset($_GET['cert_no']))?$_GET['cert_no']:''?>" placeholder="Certificate No" required>
                </div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="<?=base_url('/result-verification')?>" class="btn btn-warning">Reset</a>
                </div>
            </div>
        </form>
        <?php if(isset($_GET['cert_no'])){ 
        $commonData = [];
        if(!empty($results)){
            $commonData = [
                'stu_name' => $results->frstu_name,
                'so_wo_do' => $results->so_wo_do,
                'course' => $results->c_f_name,
                'c_duration' => $results->course_duration.' Months',
                'reg_no' => $results->reg_no,
                'cert_no' => $results->cert_no,
                'issue_date' => date('d-m-Y',strtotime($results->cert_issue_date)),
                'course_cat' => $results->course_cat,
                'module_marks' => $results->module_marks,
                'tot_fm' => $results->tot_fm,
                'tot_mo' => $results->tot_mo,
            ];
        }elseif(!empty($cbStudentsDtls)){
            $commonData = [
                'stu_name' => $cbStudentsDtls->stu_name,
                'so_wo_do' => $cbStudentsDtls->f_name,
                'course' => $cbStudentsDtls->c_f_name,
                'c_duration' => $cbStudentsDtls->course_duration.' Months',
                'reg_no' => $cbStudentsDtls->stu_reg_no,
                'cert_no' => $cbStudentsDtls->cert_no,
                'issue_date' => date('d-m-Y',strtotime($cbStudentsDtls->cert_issue_date)),
                'course_cat' => $cbStudentsDtls->course_cat,
                'module_marks' => $cbStudentsDtls->module_marks,
                'tot_fm' => $cbStudentsDtls->tot_fm,
                'tot_mo' => $cbStudentsDtls->tot_mo,
            ];
        }
            
        ?>
        <div class="my-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 mx-2">Result Verification</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-borderless mb-0">
                        
                        <tbody>
                            <?php if(!empty($commonData)){ ?>
                            <tr>
                                <th width="200px" scope="row">Student Name</th>
                                <td><?=$commonData['stu_name']?></td>
                                <th width="200px" scope="row">SO/WO/DO</th>
                                <td><?=$commonData['so_wo_do']?></td>
                            </tr>
                            
                            <tr>
                                <th width="200px" scope="row">Course</th>
                                <td ><?=$commonData['course']?></td>
                                <th width="200px" scope="row">Course Duration</th>
                                <td ><?=$commonData['c_duration']?></td>
                            </tr>
                            <tr>
                                <th width="200px" scope="row">Reg No</th>
                                <td ><?=$commonData['reg_no']?></td>
                                <th width="200px" scope="row">Cert No</th>
                                <td ><?=$commonData['cert_no']?></td>
                            </tr>
                            
                            <tr>
                                <th width="200px" scope="row">Issue Date</th>
                                <td colspan="3"><?=date('d-m-Y',strtotime($commonData['issue_date']))?></td>
                            </tr>
                            <?php if($commonData['course_cat'] == 'C'){ ?>
                            <tr>
                                <th width="200px" scope="row" colspan="4">Marks Details</th>
                            </tr>
                            <tr>
                                <th width="200px" scope="row">#</th>
                                <th scope="row">Module Name</th>
                                <th width="200px" scope="row">Full Marks</th>
                                <th scope="row">Marks Obtained</th>
                            </tr>
                            <?php if($commonData['module_marks'] != ''){
                                $marks = json_decode($commonData['module_marks']);
                                if(!empty($marks)){
                                    $n = 1;
                                    foreach($marks as $m){ ?>
                                        <tr>
                                            <td><?=$n++; ?></td>
                                            <td><?=$m->module_name; ?></td>
                                            <td><?=$m->fm; ?></td>
                                            <td><?=$m->mo; ?></td>
                                        </tr>
                                <?php }
                                    echo '<tr>
                                        <th scope="row" colspan="2">Total</th>
                                        <th scope="row">'.$commonData['tot_fm'].'</th>
                                        <th scope="row">'.$commonData['tot_mo'].'</th>
                                    </tr>';
                                } 
                            } } ?>
                            <?php }else{
                                echo '<tr><td class="text-danger text-center">No data available</td></tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</div>