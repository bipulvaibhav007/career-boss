<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Thank You for Choosing Us</h1>
    <p>Dear <?=$name??''?>,</p>
    <p>Thanks again for submit your details:</p>
    <?=$message ?? ''?>
    <table>
        <tfoot>
                <tr>
                    <td style="text-align: center;background-color: #f1f1f1;padding:15px;font-family: 'Lato', sans-serif;"><p>
                        <b>Thanks & Regards</b><br>career-boss.com</p>
                    </td>
                </tr>
        </tfoot>
    </table>
</body>
</html>