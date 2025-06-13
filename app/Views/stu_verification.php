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
        <h2 class="text-center">Student Verification</h2>
    </div>
    <div class="container">
        <form class="w-50 mx-auto" action="<?=current_url();?>" method="get">
            <div class="row">
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="no" id="no" value="<?=(isset($_GET['no']))?$_GET['no']:''?>" placeholder="Certificate No/ Registration No" required>
                </div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="<?=base_url('/student-verification')?>" class="btn btn-warning">Reset</a>
                </div>
            </div>
        </form>
        <?php if(isset($_GET['no'])){ ?>
        <div class="my-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 mx-2">Student Verification</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if(!empty($results)){ //print_r($results); exit; ?>
                        <div class="col-8">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th width="200px" scope="row">Student Name</th>
                                        <td><?=strtoupper($results->frstu_name)?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" scope="row">SO/WO/DO</th>
                                        <td><?=strtoupper($results->so_wo_do)?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" scope="row">Mother's Name</th>
                                        <td><?=strtoupper($results->mother_name)?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" scope="row">DOB</th>
                                        <td ><?=date('d-M-Y',strtotime($results->dob))?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" scope="row">Course</th>
                                        <td class="course"><?=strtoupper($results->c_f_name)?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" scope="row">Course Duration</th>
                                        <td><?=strtoupper($results->course_duration.' Months')?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" scope="row">Reg No</th>
                                        <td ><?=$results->reg_no?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" scope="row">Study Center</th>
                                        <td class="course"><?=strtoupper($results->center_name.' ('.$results->member_code.'), '.$results->center_address)?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-4">
                            <img src="<?=base_url('public/assets/upload/images/'.$results->photo)?>" alt="Photo" width="200px" height="200px" class="rounded mx-auto d-block">
                        </div>
                        <?php }elseif(!empty($cbStudentsDtls)){ ?>
                        <div class="col-8">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th width="200px" scope="row">Student Name</th>
                                        <td><?=strtoupper($cbStudentsDtls->stu_name)?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" scope="row">SO/WO/DO</th>
                                        <td><?=strtoupper($cbStudentsDtls->f_name)?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" scope="row">Mother's Name</th>
                                        <td><?=strtoupper($cbStudentsDtls->m_name)?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" scope="row">DOB</th>
                                        <td ><?=date('d-M-Y',strtotime($cbStudentsDtls->dob))?></td>
                                    </tr>
                                    <?php /*<tr>
                                        <th width="200px" scope="row">Course</th>
                                        <td class="course"><?=strtoupper($results->c_f_name)?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" scope="row">Course Duration</th>
                                        <td><?=strtoupper($results->course_duration.' Months')?></td>
                                    </tr> */ ?>
                                    <tr>
                                        <th width="200px" scope="row">Reg No</th>
                                        <td ><?=$cbStudentsDtls->stu_reg_no?></td>
                                    </tr>
                                    <tr>
                                        <th width="200px" scope="row">Study Center</th>
                                        <td class="course">Career Boss IT Professional Training Institute Ara</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-4">
                            <img src="<?=base_url('public/assets/upload/images/'.$cbStudentsDtls->stu_image)?>" alt="Photo" width="200px" height="200px" class="rounded mx-auto d-block">
                        </div>
                        <?php if(!empty($stuCourses)){ ?>
                        <div class="col-md-12 mt-4">
                            <table class="table">
                                <thead>
                                    <tr class="table-dark">
                                        <th>#</th>
                                        <th>Course Name</th>
                                        <th>Duration</th>
                                        <th>Course From</th>
                                        <th>Course To</th>
                                        <th>Cert No</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $sn=1; foreach($stuCourses as $list){ ?>
                                    <tr>
                                        <td><?=$sn++;?></td>
                                        <td><?=$list->c_f_name?></td>
                                        <td><?=$list->course_duration.' Months'?></td>
                                        <td><?=date('d M, Y',strtotime($list->adm_date))?></td>
                                        <td><?=date('d M, Y',strtotime($list->adm_date.' + '.$list->course_duration.'months'))?></td>
                                        <td><?=$list->cert_no ?? 'N/A'?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php }else{
                            echo '<div class="col-md-12 mt-4">
                                <p class="text-danger text-center">No admission in any course</p>
                            </div>';
                        } ?>
                        <?php }else{ ?>
                            <div class="col-md-12">
                                <p class="text-danger text-center">No data available</p>
                            </div>
                        <?php } ?>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</div>