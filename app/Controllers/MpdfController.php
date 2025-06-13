<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use Mpdf\Mpdf;

class MpdfController extends BaseController
{
    public $commonmodel;
    public $adminmodel;
    public $session;
    // public $membermodel;
    // public $mpdf;
    public function __construct()
    {
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->adminmodel = model('App\Models\Admin_model', false);
        // $this->mpdf = new Mpdf();
    }

    /*****************************CERTIFICATE************************ */
    public function create_certificate_pdf($frStuDtls, $certNo)
    {
        $html = '';
        $html = $this->get_certificate_html($frStuDtls);
        $name = $certNo . '.pdf';
        return $this->createPdf($html, $pdfName=$name, $pageOrient='L');
        /*$mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $mpdf->AddPage('L');
        $mpdf->WriteHTML($html);
        $pdfContent = $mpdf->Output('', 'S'); //s-save
        // $this->mpdf->Output('test', 'I'); // I-explore

        $pdfPath = './public/assets/pdf/' . $name;

        return file_put_contents($pdfPath, $pdfContent);*/
    }
    
    public function get_certificate_html($frStuDtls)
    {
        // $cert_bg = base_url('public/assets/cert_images/certificate3.jpg');
        if($frStuDtls->course_cat == 'C'){
            $cert_bg = base_url('public/assets/cert_images/Certificate_yellow.png');
        }else{
            $cert_bg = base_url('public/assets/cert_images/fr_certificate_yellow_pro.png');
        }
        $photo = base_url('public/assets/cert_images/student-prof.png');
        $profile = base_url('public/assets/upload/images/' . $frStuDtls->photo);
        // $mcaLogo = base_url('public/assets/cert_images/MCA-logo.png');
        // $logo = base_url('public/assets/cert_images/Logo.png');
        // $iso = base_url('public/assets/cert_images/iso.png');
        // $scanner = base_url('public/assets/cert_images/scanner.png');
        // $bharat = base_url('public/assets/cert_images/bharat.png');

        $data['cert_bg'] = $this->createimage($cert_bg);
        $data['photo'] = $this->createimage($photo);
        $data['profile'] = $this->createimage($profile);
        // $data['mcaLogo'] = $this->createimage($mcaLogo);
        // $data['logo'] = $this->createimage($logo);
        // $data['iso'] = $this->createimage($iso);
        // $data['scanner'] = $this->createimage($scanner);
        // $data['bharat'] = $this->createimage($bharat);
        $data['frStuDtls'] = $frStuDtls;
        if($frStuDtls->course_cat == 'C'){
            $result = view('admin/cb_cerificate', $data);
        }else{
            $result = view('admin/cb_cerificate_pro', $data);
        }
        
        return $result;
    }
    public function create_typing_certificate_pdf($frStuDtls, $certNo)
    {
        $html = '';
        $html = $this->get_typing_certificate_html($frStuDtls);
        $name = $certNo . '.pdf';
        return $this->createPdf($html, $pdfName=$name, $pageOrient='L');
        
    }
    public function get_typing_certificate_html($frStuDtls){
        $cert_bg = base_url('public/assets/cert_images/typing_cert_yellow.png');
        $profile = base_url('public/assets/upload/images/' . $frStuDtls->photo);
        $data['cert_bg'] = $this->createimage($cert_bg);
        $data['profile'] = $this->createimage($profile);
        $data['frStuDtls'] = $frStuDtls;
        $result = view('admin/typing_cerificate', $data);
        return $result;
    }
    /*****************************CERTIFICATE END / MARKSHEET START************************ */
    public function create_marksheet_pdf($frStuDtls, $certNo)
    {
        $html = '';
        $html = $this->get_marksheet_html($frStuDtls);
        $name = $certNo . 'M.pdf';
        $this->createPdf($html, $pdfName=$name, $pageOrient='P');
        return 1;
        /*$mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->AddPage('P');
        $mpdf->WriteHTML($html);
        $pdfContent = $mpdf->Output('', 'S');
        // $this->mpdf->Output('test', 'I');

        $pdfPath = './public/assets/pdf/' . $name;

        return file_put_contents($pdfPath, $pdfContent);*/

    }
    public function get_marksheet_html($frStuDtls)
    {
        $marksheet = base_url('public/assets/cert_images/marksheet_yellow.png');
        // $mcaLogo = base_url('public/assets/cert_images/MCA-logo.png');
        // $logo = base_url('public/assets/cert_images/Logo.png');
        // $iso = base_url('public/assets/cert_images/iso.png');
        $profile = base_url('public/assets/upload/images/' . $frStuDtls->photo);
        // $scanner = base_url('public/assets/cert_images/scanner.png');
        // $bharat = base_url('public/assets/cert_images/bharat.png');
        $grades = $this->commonmodel->getAllRecordOrderByDesc('tbl_grade', ['marks_to >' => 1, 'grade !=' => '', 'details !=' => ''], ['id', 'DESC']);
        // $stu_marks = ($frStuDtls->module_marks != '')?json_decode($frStuDtls->module_marks):[];

        $data['marksheet'] = $this->createimage($marksheet);
        // $data['mcaLogo'] = $this->createimage($mcaLogo);
        // $data['logo'] = $this->createimage($logo);
        // $data['iso'] = $this->createimage($iso);
        $data['profile'] = $this->createimage($profile);
        // $data['scanner'] = $this->createimage($scanner);
        // $data['bharat'] = $this->createimage($bharat);
        $data['frStuDtls'] = $frStuDtls;
        $data['grades'] = $grades;
        // $data['stu_marks'] = $stu_marks;

        $result = view('admin/marksheet_careerboss', $data);
        return $result;
    }
    public function createimage($image)
    {
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $image = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $image;
    }
    public function createPdf($html, $pdfName, $pageOrient){
        ini_set('memory_limit', '1500000M');
        ini_set("pcre.backtrack_limit", "8000000");
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new Mpdf([
            'fontdata' => $fontData + [
                'dancingscript' => [
                    'R' => 'DancingScript-SemiBold.ttf',
                    'I' => 'DancingScript-SemiBold.ttf',
                ],
                'poly' => [
                    'R' => 'Poly-Regular.ttf',
                    'I' => 'Poly-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-Regular.ttf',
                    'I' => 'Khand-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-SemiBold.ttf',
                    'I' => 'Khand-SemiBold.ttf',
                ],
            ],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 6,
            'margin_bottom' => 0,
        ]);
        $mpdf->AddPage($pageOrient);
        $mpdf->WriteHTML($html);
        $pdfContent = $mpdf->Output('', 'S');
        // $mpdf->Output('cb-certificate.pdf', 'I');exit;

        $pdfPath = './public/assets/pdf/' . $pdfName;

        return file_put_contents($pdfPath, $pdfContent);
    }
    /************************************************************************************************************* */
    public function create_test_pdf($frStuDtls)
    {
        // $html = $this->get_marksheet_html($frStuDtls);
        ini_set('memory_limit', '1500000M');
        ini_set("pcre.backtrack_limit", "8000000");
        $html = $this->get_certificate_html($frStuDtls);
        // echo $html; exit;
        $name = 'testM' . time() . '.pdf';
       // return $this->createPdf($html, $pdfName=$name, $pageOrient='P');

        // $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        // $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        // ini_set("pcre.backtrack_limit", "5000000");

        $mpdf = new Mpdf([
            'fontdata' => $fontData + [
                'dancingscript' => [
                    'R' => 'DancingScript-SemiBold.ttf',
                    'I' => 'DancingScript-SemiBold.ttf',
                ],
                'poly' => [
                    'R' => 'Poly-Regular.ttf',
                    'I' => 'Poly-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-Regular.ttf',
                    'I' => 'Khand-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-SemiBold.ttf',
                    'I' => 'Khand-SemiBold.ttf',
                ],
            ],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 6,
            'margin_bottom' => 0,
        ]);
        $mpdf->AddPage('L');
        $mpdf->WriteHTML($html);
        // $pdfContent = $this->mpdf->Output('', 'S');
        $mpdf->Output('cb-certificate.pdf', 'I');exit;

        $pdfPath = './public/assets/pdf/' . $name;

        return file_put_contents($pdfPath, $pdfContent);
    }
    public function create_marksheet_test_pdf($frStuDtls)
    {
        // $html = $this->get_marksheet_html($frStuDtls);
        ini_set('memory_limit', '1500000M');
        ini_set("pcre.backtrack_limit", "8000000");
        $html = $this->get_marksheet_html($frStuDtls);
        $name = 'testM' . time() . '.pdf';
       // return $this->createPdf($html, $pdfName=$name, $pageOrient='P');

        // $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        // $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        // ini_set("pcre.backtrack_limit", "5000000");

        $mpdf = new Mpdf([
            'fontdata' => $fontData + [
                'dancingscript' => [
                    'R' => 'DancingScript-SemiBold.ttf',
                    'I' => 'DancingScript-SemiBold.ttf',
                ],
                'poly' => [
                    'R' => 'Poly-Regular.ttf',
                    'I' => 'Poly-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-Regular.ttf',
                    'I' => 'Khand-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-SemiBold.ttf',
                    'I' => 'Khand-SemiBold.ttf',
                ],
            ],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 6,
            'margin_bottom' => 0,
        ]);
        $mpdf->AddPage('P');
        $mpdf->WriteHTML($html);
        // $pdfContent = $this->mpdf->Output('', 'S');
        $mpdf->Output('cb-certificate.pdf', 'I');exit;

        $pdfPath = './public/assets/pdf/' . $name;

        return file_put_contents($pdfPath, $pdfContent);
    }
    public function create_typing_test_pdf($frStuDtls)
    {
        // $html = $this->get_marksheet_html($frStuDtls);
        ini_set('memory_limit', '1500000M');
        ini_set("pcre.backtrack_limit", "8000000");
        $html = $this->get_typing_certificate_html($frStuDtls);
        $name = 'testM' . time() . '.pdf';
       // return $this->createPdf($html, $pdfName=$name, $pageOrient='P');

        // $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        // $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        // ini_set("pcre.backtrack_limit", "5000000");

        $mpdf = new Mpdf([
            'fontdata' => $fontData + [
                'dancingscript' => [
                    'R' => 'DancingScript-SemiBold.ttf',
                    'I' => 'DancingScript-SemiBold.ttf',
                ],
                'poly' => [
                    'R' => 'Poly-Regular.ttf',
                    'I' => 'Poly-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-Regular.ttf',
                    'I' => 'Khand-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-SemiBold.ttf',
                    'I' => 'Khand-SemiBold.ttf',
                ],
            ],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 6,
            'margin_bottom' => 0,
        ]);
        $mpdf->AddPage('L');
        $mpdf->WriteHTML($html);
        // $pdfContent = $this->mpdf->Output('', 'S');
        $mpdf->Output('cb-certificate.pdf', 'I');exit;

        $pdfPath = './public/assets/pdf/' . $name;

        return file_put_contents($pdfPath, $pdfContent);
    }
    /*************************************Create CB certificate******************************** */
    public function create_cb_certificate_pdf($courseDtls, $certNo)
    {
        $html = '';
        $html = $this->get_cb_certificate_html($courseDtls);
        $name = $certNo . '.pdf';
        return $this->createPdf($html, $pdfName=$name, $pageOrient='L');
       
    }
    public function get_cb_certificate_html($courseDtls)
    {
        if($courseDtls->course_cat == 'C'){
            $cert_bg = base_url('public/assets/cert_images/Certificate_red.png'); // for change
        }else{
            $cert_bg = base_url('public/assets/cert_images/Certificate_red_pro.png');
        }
        $photo = base_url('public/assets/cert_images/student-prof.png');
        $profile = base_url('public/assets/upload/images/' . $courseDtls->stu_image);
        
        $data['cert_bg'] = $this->createimage($cert_bg);
        $data['photo'] = $this->createimage($photo);
        $data['profile'] = $this->createimage($profile);
        
        $data['courseDtls'] = $courseDtls;
        // $result = view('admin/cb_cert', $data);
        if($courseDtls->course_cat == 'C'){
            $result = view('admin/cb_stu_certificate', $data); // for change
        }else{
            $result = view('admin/cb_stu_certificate_pro', $data);
        }
        return $result;
    }
    public function create_cb_marksheet_pdf($courseDtls, $certNo)
    {
        $html = '';
        $html = $this->get_cb_marksheet_html($courseDtls);
        $name = $certNo . 'M.pdf';
        $this->createPdf($html, $pdfName=$name, $pageOrient='P');
        return 1;

    }
    public function get_cb_marksheet_html($courseDtls)
    {
        $marksheet = base_url('public/assets/cert_images/marksheet_red.png');
        $profile = base_url('public/assets/upload/images/' . $courseDtls->stu_image);
        $grades = $this->commonmodel->getAllRecordOrderByDesc('tbl_grade', ['marks_to >' => 1, 'grade !=' => '', 'details !=' => ''], ['id', 'DESC']);

        $data['marksheet'] = $this->createimage($marksheet);
        $data['profile'] = $this->createimage($profile);
        $data['courseDtls'] = $courseDtls;
        $data['grades'] = $grades;

        // $result = view('admin/cb_marksheet', $data);
        $result = view('admin/cb_stu_marksheet', $data);
        return $result;
    }
    public function create_cb_typing_certificate_pdf($courseDtls, $certNo)
    {
        $html = '';
        $html = $this->get_cb_typing_certificate_html($courseDtls);
        $name = $certNo . '.pdf';
        return $this->createPdf($html, $pdfName=$name, $pageOrient='L');
        
    }
    public function get_cb_typing_certificate_html($courseDtls){
        $cert_bg = base_url('public/assets/cert_images/typing_cert_red.png');
        $profile = base_url('public/assets/upload/images/' . $courseDtls->stu_image);
        $data['cert_bg'] = $this->createimage($cert_bg);
        $data['profile'] = $this->createimage($profile);
        $data['courseDtls'] = $courseDtls;
        $result = view('admin/cb_stu_typing_certificate', $data);
        return $result;
    }
    public function create_cb_test_pdf($courseDtls)
    {
        // $html = $this->get_marksheet_html($frStuDtls);
        ini_set('memory_limit', '1500000M');
        ini_set("pcre.backtrack_limit", "8000000");
        $html = $this->get_cb_certificate_html($courseDtls);
        $name = 'testM' . time() . '.pdf';
       // return $this->createPdf($html, $pdfName=$name, $pageOrient='P');

        // $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        // $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        // ini_set("pcre.backtrack_limit", "5000000");

        $mpdf = new Mpdf([
            'fontdata' => $fontData + [
                'dancingscript' => [
                    'R' => 'DancingScript-SemiBold.ttf',
                    'I' => 'DancingScript-SemiBold.ttf',
                ],
                'poly' => [
                    'R' => 'Poly-Regular.ttf',
                    'I' => 'Poly-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-Regular.ttf',
                    'I' => 'Khand-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-SemiBold.ttf',
                    'I' => 'Khand-SemiBold.ttf',
                ],
            ],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 6,
            'margin_bottom' => 0,
        ]);
        $mpdf->AddPage('L');
        $mpdf->WriteHTML($html);
        // $pdfContent = $this->mpdf->Output('', 'S');
        $mpdf->Output('cb-certificate.pdf', 'I');exit;

        $pdfPath = './public/assets/pdf/' . $name;

        return file_put_contents($pdfPath, $pdfContent);
    }
    public function create_cb_marksheet_test_pdf($courseDtls)
    {
        // $html = $this->get_marksheet_html($frStuDtls);
        ini_set('memory_limit', '1500000M');
        ini_set("pcre.backtrack_limit", "8000000");
        $html = $this->get_cb_marksheet_html($courseDtls);
        $name = 'testM' . time() . '.pdf';
       // return $this->createPdf($html, $pdfName=$name, $pageOrient='P');

        // $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        // $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        // ini_set("pcre.backtrack_limit", "5000000");

        $mpdf = new Mpdf([
            'fontdata' => $fontData + [
                'dancingscript' => [
                    'R' => 'DancingScript-SemiBold.ttf',
                    'I' => 'DancingScript-SemiBold.ttf',
                ],
                'poly' => [
                    'R' => 'Poly-Regular.ttf',
                    'I' => 'Poly-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-Regular.ttf',
                    'I' => 'Khand-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-SemiBold.ttf',
                    'I' => 'Khand-SemiBold.ttf',
                ],
            ],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 6,
            'margin_bottom' => 0,
        ]);
        $mpdf->AddPage('P');
        $mpdf->WriteHTML($html);
        // $pdfContent = $this->mpdf->Output('', 'S');
        $mpdf->Output('cb-certificate.pdf', 'I');exit;

        $pdfPath = './public/assets/pdf/' . $name;

        return file_put_contents($pdfPath, $pdfContent);
    }
    public function create_cb_typing_test_pdf($courseDtls)
    {
        // $html = $this->get_marksheet_html($frStuDtls);
        ini_set('memory_limit', '1500000M');
        ini_set("pcre.backtrack_limit", "8000000");
        $html = $this->get_cb_typing_certificate_html($courseDtls);
        $name = 'testM' . time() . '.pdf';
       // return $this->createPdf($html, $pdfName=$name, $pageOrient='P');

        // $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        // $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        // ini_set("pcre.backtrack_limit", "5000000");

        $mpdf = new Mpdf([
            'fontdata' => $fontData + [
                'dancingscript' => [
                    'R' => 'DancingScript-SemiBold.ttf',
                    'I' => 'DancingScript-SemiBold.ttf',
                ],
                'poly' => [
                    'R' => 'Poly-Regular.ttf',
                    'I' => 'Poly-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-Regular.ttf',
                    'I' => 'Khand-Regular.ttf',
                ],
                'khand' => [
                    'R' => 'Khand-SemiBold.ttf',
                    'I' => 'Khand-SemiBold.ttf',
                ],
            ],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 6,
            'margin_bottom' => 0,
        ]);
        $mpdf->AddPage('L');
        $mpdf->WriteHTML($html);
        // $pdfContent = $this->mpdf->Output('', 'S');
        $mpdf->Output('cb-certificate.pdf', 'I');exit;

        $pdfPath = './public/assets/pdf/' . $name;

        return file_put_contents($pdfPath, $pdfContent);
    }
}
