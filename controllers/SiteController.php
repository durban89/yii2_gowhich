<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * 发送请求玖富接口,返回Json
     * @param  [type] $p_url      [请求地址]
     * @param  string $p_method   [提交方式]
     * @param  [type] $p_postData [参数]
     * @return array Json 数组
     */
    public static function loadJsonByUAP($p_url, $p_postData = null, $p_method = 'post')
    {
        // 加密请求参数

        $secretData = W2RSA::rsaEncrypt($p_postData, PUBLICPEM_PATH);
        // 加密签名
        $secretSign = W2RSA::rsaSign(base64_decode($secretData), PRIVATEPEM_PATH);

        // 请求接口
        $resultInfo = W2Web::loadJsonByUrl($p_url, $p_method, http_build_query(array('data' => $secretData, 'sign' => $secretSign)));

        // 解密接口返回数据
        $resultData = W2RSA::rsaDecrypt($resultInfo['data'], PRIVATEPEM_PATH);
        // 对json格式的字符串进行转换成数组
        $resultData = self::getArrayFromJosonFormatString($resultData);

        return $resultData;
    }
    /**
     * RSA加密
     * @param $content 需要加密的内容
     * @param $public_key 商户公钥文件路径 或 密钥内容本身
     * return 加密后内容，明文
     */
    public function rsaEncrypt($content, $public_key)
    {
        $priKey = file_get_contents($public_key);
        $res    = openssl_get_publickey($priKey);
        //把需要加密的内容，按128位拆开加密
        $result = '';
        for ($i = 0; $i < ((strlen($content) - strlen($content) % 117) / 117 + 1); $i++) {
            $data = mb_strcut($content, $i * 117, 117, 'utf-8');
            openssl_public_encrypt($data, $encrypted, $res);
            $result .= $encrypted;
        }
        openssl_free_key($res);
        //用base64将二进制编码
        $result = base64_encode($result);
        return $result;
    }
    /**
     * RSA签名
     * @param $data 待签名数据
     * @param $private_key 商户私钥文件路径 或 密钥内容本身
     * return 签名结果
     */
    public function rsaSign($data, $private_key)
    {
        $priKey = file_get_contents($private_key);
        $res    = openssl_get_privatekey($priKey);
        openssl_sign($data, $sign, $res);
        openssl_free_key($res);
        //base64编码
        $sign = base64_encode($sign);
        return $sign;
    }
    /**
     * RSA验签
     * @param $data 待签名数据
     * @param $ali_public_key 支付宝的公钥文件路径 或 密钥内容本身
     * @param $sign 要校对的的签名结果
     * return 验证结果
     */
    public function rsaVerify($data, $ali_public_key, $sign)
    {
        $pubKey = file_get_contents($ali_public_key);
        $res    = openssl_get_publickey($pubKey);
        $result = (bool) openssl_verify($data, base64_decode($sign), $res);
        openssl_free_key($res);
        return $result;
    }
    /**
     * RSA解密
     * @param $content 需要解密的内容，密文
     * @param $private_key 商户私钥文件路径 或 密钥内容本身
     * return 解密后内容，明文
     */
    public function rsaDecrypt($content, $private_key)
    {
        $priKey = file_get_contents($private_key);
        $res    = openssl_get_privatekey($priKey);
        // var_dump($priKey);
        // var_dump($res);exit();
        //用base64将内容还原成二进制
        $content = base64_decode($content);
        //把需要解密的内容，按128位拆开解密
        $result = '';
        for ($i = 0; $i < strlen($content) / 128; $i++) {
            $data = substr($content, $i * 128, 128);
            openssl_private_decrypt($data, $decrypt, $res);
            $result .= $decrypt;
        }
        openssl_free_key($res);
        return $result;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * base 64 string 压缩文件 转 pdf 并解压 pdf文件
     * @return [type] [description]
     */
    public function actionPdf()
    {
        $pdf_base64 = BASE64_DATA_PATH;
        //Get File content from txt file
        $pdf_base64_handler = fopen($pdf_base64, 'r');
        $pdf_content        = fread($pdf_base64_handler, filesize($pdf_base64));
        fclose($pdf_base64_handler);
        //Decode pdf content
        $pdf_decoded = base64_decode($pdf_content);
        //Write data back to pdf file
        $pdf = fopen(PDF_FILE_PATH, 'w');
        fwrite($pdf, $pdf_decoded);
        //close output file
        fclose($pdf);

        // This input should be from somewhere else, hard-coded in this example
        $file_name = PDF_FILE_PATH;

        // Raising this value may increase performance
        $buffer_size   = 4096; // read 4kb at a time
        $out_file_name = str_replace('.gz', '', $file_name);

        // Open our files (in binary mode)
        $file     = gzopen($file_name, 'rb');
        $out_file = fopen($out_file_name, 'wb');

        // Keep repeating until the end of the input file
        while (!gzeof($file)) {
            // Read buffer-size bytes
            // Both fwrite and gzread and binary-safe
            fwrite($out_file, gzread($file, $buffer_size));
        }

        // Files are done, close files
        fclose($out_file);
        gzclose($file);

        // $base64Data = file_get_contents(BASE64_DATA_PATH);
        // $data = base64_decode($base64Data);
        // file_put_contents(PDF_FILE_PATH,$data);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
