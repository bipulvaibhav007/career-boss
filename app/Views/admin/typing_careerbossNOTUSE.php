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
            <div style="display: inline-block;margin-top: 16px;margin-left: 120px;font-family: 'Khand', sans-serif;letter-spacing: 0.8px;font-size: 16px;"><?=$courseDtls->cert_no?></div>
            <div style="display: inline-block; margin-top: -27px;margin-left: 887px;font-family: 'Khand', sans-serif;letter-spacing: 0.8px;font-size: 16px;"><?=date('d-M-Y',strtotime($courseDtls->cert_issue_date))?></div>

            <div style="margin-top: 251px;margin-left: 465px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=strtoupper($courseDtls->stu_name)?></div>

            <div style="margin-top: 23px;margin-left: 238px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=strtoupper($courseDtls->f_name)?></div>
            <div style="margin-top: -18px;margin-left: 705px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$courseDtls->stu_reg_no?></div>

            <div style="margin-top: 25px;margin-left: 452px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$courseDtls->c_f_name?></div>

            <div style="margin-top: 24px;margin-left: 265px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$courseDtls->course_duration?> Months</div>
            <?php if($courseDtls->module_marks != ''){
                $module_marks = json_decode($courseDtls->module_marks); ?>
            
            <div style="margin-top: -20px;margin-left: 592px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$module_marks[0]->mo?> WPM</div>
            <div style="margin-top: -15px;margin-left: 869px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$module_marks[1]->mo?> WPM</div>
            <?php } ?>
            <div style="margin-top: 20px;margin-left: 310px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;">Career Boss IT Professional Training Institute Ara</div>
        
            <div style="margin-top: 40px;margin-left: 90px;"><img style="width: 70px;height: 70px;" src="<?=$profile?>" alt=""></div>
        </div> 
    </body>
</html>