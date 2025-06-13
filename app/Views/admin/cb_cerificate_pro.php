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
            <div style="display: inline-block;margin-top: 173px;margin-left: 210px;font-family: 'Khand', sans-serif;letter-spacing: 0.8px;font-size: 16px;"><?=$frStuDtls->cert_no?></div>
            <div style="margin-top: -27px;margin-left: 805px;font-family: 'Khand', sans-serif;letter-spacing: 0.8px;font-size: 16px;"><?=date('d-M-Y',strtotime($frStuDtls->cert_issue_date))?></div>

            <div style="margin-top: 30px;margin-left: 400px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=ucwords($frStuDtls->frstu_name)?></div>

            <div style="margin-top: 12px;margin-left: 273px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=ucwords($frStuDtls->so_wo_do)?></div>
            <div style="margin-top: -18px;margin-left: 718px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$frStuDtls->reg_no?></div>

            <div style="margin-top: 12px;margin-left: 400px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$frStuDtls->c_f_name?></div>

            <div style="margin-top: 12px;margin-left: 670px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$frStuDtls->course_duration?> Months</div>
            <?php /*<div style="margin-top: -19px;margin-left: 828px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$frStuDtls->grade?></div> */ ?>

            <div style="margin-top: 45px;margin-left: 280px;font-family: 'Poly', sans-serif;font-weight: bold;letter-spacing: 0.8px;font-size: 14px;color: #081D39;"><?=$frStuDtls->center_name?></div>
        
            <div style="margin-top: 75px;margin-left: 280px;"><img style="width: 60px;height: 60px;" src="<?=$profile?>" alt=""></div>
        </div> 
    </body>
</html>