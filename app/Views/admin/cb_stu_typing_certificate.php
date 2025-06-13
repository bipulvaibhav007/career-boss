<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Certificate</title>
    </head>
    <body>
        <div style="width: 1050px; height: 850px; margin: 0 auto; background: url('<?=$cert_bg?>');background-repeat: no-repeat;background-size: 100%;">
        <div style="margin-top: 40px;margin-left: 40px;font-family: 'Khand', sans-serif;letter-spacing: 0.8px;font-size: 16px;">&nbsp;</div>
            <div style="display: inline-block;margin-top: 173px;margin-left: 210px;font-family: 'Khand', sans-serif;letter-spacing: 0.8px;font-size: 16px;"><?=($courseDtls->cert_no != '')?$courseDtls->cert_no:'N/A'?></div>
            <div style="margin-top: -27px;margin-left: 805px;font-family: 'Khand', sans-serif;letter-spacing: 0.8px;font-size: 16px;"><?=date('d-M-Y',strtotime($courseDtls->cert_issue_date))?></div>

            <div style="margin-top: 59px;margin-left: 465px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=strtoupper($courseDtls->stu_name)?></div>

            <div style="margin-top: 18px;margin-left: 273px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=strtoupper($courseDtls->f_name)?></div>
            <div style="margin-top: -18px;margin-left: 718px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$courseDtls->stu_reg_no?></div>

            <div style="margin-top: 18px;margin-left: 480px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$courseDtls->c_f_name?></div>

            <div style="margin-top: 18px;margin-left: 265px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$courseDtls->course_duration?> Months</div>
            <?php if($courseDtls->module_marks != ''){
                $module_marks = json_decode($courseDtls->module_marks); ?>
            
            <div style="margin-top: -18px;margin-left: 592px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$module_marks[0]->mo?> WPM</div>
            <div style="margin-top: -18px;margin-left: 835px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$module_marks[1]->mo?> WPM</div>
            <?php } ?>
            <?php /* <div style="margin-top: 16px;margin-left: 310px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$courseDtls->center_name.' ('.$courseDtls->member_code.'), '.$courseDtls->center_address?></div> */ ?>
        
            <div style="margin-top: 54px;margin-left: 300px;"><img style="width: 60px;height: 60px;" src="<?=$profile?>" alt=""></div>
        </div> 
    </body>
</html>