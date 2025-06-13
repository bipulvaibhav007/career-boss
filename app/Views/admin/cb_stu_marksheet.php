<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marksheet</title>
    <link href="https://fonts.googleapis.com/css2?family=Khand:wght@300;400;500;600;700&amp;family=Poly:ital@0;1&amp;display=swap" rel="stylesheet">
</head>
<body>
    <div style="background-image: url('<?=$marksheet?>'); background-repeat: no-repeat; background-size: 100%; width: 760px; height: 1080px; margin: 0 auto;">
        
    <div class="stud-detail" style="padding-left: 220px; padding-top: 239px;">
        <div style="margin-top: 10px; font-family: 'Poly', sans-serif; font-size: 12px;text-transform: uppercase; color: #000000;letter-spacing: 0.8px;"><?=($courseDtls->cert_no != '') ?$courseDtls->cert_no: 'N/A'?></div>
        <div style="margin-top: -17px; margin-left: 404px; font-family: 'Poly', sans-serif; font-size: 12px;text-transform: uppercase; color: #000000;letter-spacing: 0.8px;"><?=date('d-M-Y',strtotime($courseDtls->cert_issue_date))?></div>
        <div style="margin-top: 10px; margin-left: 400px;"><img style="width: 70px;height: 70px;border: 1px solid red" src="<?=$profile?>" alt="profile"></div>
        <div style="margin-top: -75px; font-family: 'Poly', sans-serif; font-size: 12px;text-transform: uppercase; color: #000000;letter-spacing: 0.8px;"><?=$courseDtls->stu_reg_no?></div>
        <div style="margin-top: 8px; font-family: 'Poly', sans-serif; font-size: 12px;text-transform: uppercase; color: #000000;letter-spacing: 0.8px;"><?=ucwords($courseDtls->stu_name)?></div>
        <div style="margin-top: 6px; font-family: 'Poly', sans-serif; font-size: 12px;text-transform: uppercase; color: #000000;letter-spacing: 0.8px;"><?=ucwords($courseDtls->f_name)?></div>
        <div style="margin-top: 6px; font-family: 'Poly', sans-serif; font-size: 12px;text-transform: uppercase; color: #000000;letter-spacing: 0.8px;"><?=ucwords(($courseDtls->m_name != '') ? $courseDtls->m_name : 'N/A')?></div>
        <div style="margin-top: 6px; font-family: 'Poly', sans-serif; font-size: 12px;text-transform: uppercase; color: #000000;letter-spacing: 0.8px;"><?=date('d-m-Y',strtotime($courseDtls->dob))?></div>
        <div style="margin-top: 6px; font-family: 'Poly', sans-serif; font-size: 12px;text-transform: uppercase; color: #000000;letter-spacing: 0.8px;"><?=$courseDtls->c_f_name?></div>
        <div style="margin-top: 6px; font-family: 'Poly', sans-serif; font-size: 12px;text-transform: uppercase; color: #000000;letter-spacing: 0.8px;"><?=$courseDtls->course_duration?> Months</div>
        <?php /* 
            $centerName = ucwords($courseDtls->center_name.' ('.$courseDtls->member_code.'), '.$courseDtls->center_address);
        ?>
        <div style="margin-top: 6px; font-family: 'Poly', sans-serif; font-size: 12px;text-transform: uppercase; color: #000000;letter-spacing: 0.8px;"><?=$centerName?></div> */ ?>
    </div>

    <div class="marks-detail" style="margin-top: 58px;margin-left: 61px; height: 282px;">
        <?php if($courseDtls->module_marks != ''){
        $module_marks = json_decode($courseDtls->module_marks); $n = 1;
        foreach($module_marks as $m){ ?>
            <div style="padding-left: 10px;padding-top: 10px;font-family: 'Poly', sans-serif;font-size: 12px;text-transform: uppercase;color: #144993;letter-spacing: 0.8px;width: 330px;">M<?=$n.': '.$m->module_name?></div>
            <div style="font-family: 'Poly', sans-serif;font-size: 13px;text-transform: uppercase;color: #144993;letter-spacing: 0.8px;width: 148px;margin-left: 345px;text-align: center;margin-top: -20px;"><?=$m->fm?></div>
            <div style="font-family: 'Poly', sans-serif;font-size: 13px;text-transform: uppercase;color: #000000;letter-spacing: 0.8px;text-align: center;width: 146px;margin-top: -16px;margin-left: 492px;"><?=$m->mo?></div>
        <?php $n++; } } ?>

    </div>

    <div class="full-marks" style="padding-top: 14px;">
        <div style="margin-top: 0;font-family: 'Poly', sans-serif;font-size: 12px;text-transform: uppercase;color: #144993;letter-spacing: 0.8px;width: 148px;margin-left: 405px;text-align: center;"><?=$courseDtls->tot_fm?></div>
        <div style="font-family: 'Poly', sans-serif;font-size: 12px;text-transform: uppercase;color: #144993;letter-spacing: 0.8px;width: 148px;margin-left: 550px;text-align: center;margin-top: -14px;"><?=$courseDtls->tot_mo?></div>
    </div>
    <?php /*  
    <div class="results" style="margin-top: -30px;margin-left: 60px; height: 120px;">    
        <?php if(!empty($grades)){
        $count = count($grades);
        for($i=0; $i<$count; $i++){ ?>
            <div style="margin-top: 1px;margin-left: 20px;font-family: 'Poly', sans-serif;font-size: 10px;text-transform: uppercase;color: #000000;letter-spacing: 0.8px;"><?=$grades[$i]->grade?></div>
            <div style="margin-top: -12px;margin-left: 60px;font-family: 'Poly', sans-serif;font-size: 10px;text-transform: uppercase;color: #000000;letter-spacing: 0.8px;"><?=$grades[$i]->details?></div>
            <?php $i++; 
            if(isset($grades[$i]->grade)){?>
            <div style="margin-top: -12px;margin-left: 220px;font-family: 'Poly', sans-serif;font-size: 10px;text-transform: uppercase;color: #000000;letter-spacing: 0.8px;"><?=$grades[$i]->grade?></div>
            <div style="margin-top: -12px;margin-left: 260px;font-family: 'Poly', sans-serif;font-size: 10px;text-transform: uppercase;color: #000000;letter-spacing: 0.8px;"><?=$grades[$i]->details?></div>
        <?php } if($i == 20){break;}} } ?>
        
    </div> */ ?>

    <div class="grade" style="padding-top: 10px;">
        <Div style="font-family: 'Poly', sans-serif;font-size: 12px;text-transform: uppercase;color: #000000;letter-spacing: 0.8px;width: 148px;margin-left: 55px;text-align: center;"><?=$courseDtls->grade?></Div>
        <Div style="font-family: 'Poly', sans-serif;font-size: 12px;text-transform: uppercase;color: #000000;letter-spacing: 0.8px;width: 148px;margin-left: 602px;text-align: center;margin-top: -17px;"><?=$courseDtls->percentage?> %</Div> 
    </div>

    </div>
</body>
</html>