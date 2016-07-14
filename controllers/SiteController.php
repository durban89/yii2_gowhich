<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

/*公钥 */             
define('PUBLICPEM_PATH', '/Users/durban126/nodejs/qeeniao-wap-web/app/test/data/jiufu/test/9fwlc_public.pem');
/*私钥 */             
define('PRIVATEPEM_PATH', '/Users/durban126/nodejs/qeeniao-wap-web/app/test/data/jiufu/test/9f_KDJZ_private.pem');

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
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
    public static function loadJsonByUAP($p_url,$p_postData=null,$p_method='post'){
        // 加密请求参数
        
        $secretData = W2RSA::rsaEncrypt($p_postData,PUBLICPEM_PATH);
        // 加密签名
        $secretSign = W2RSA::rsaSign(base64_decode($secretData),PRIVATEPEM_PATH);

        // 请求接口
        $resultInfo = W2Web::loadJsonByUrl($p_url,$p_method,http_build_query(array('data' => $secretData,'sign' => $secretSign)));

        // 解密接口返回数据
        $resultData = W2RSA::rsaDecrypt($resultInfo['data'],PRIVATEPEM_PATH);
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
    public function rsaEncrypt($content, $public_key) {
        $priKey = file_get_contents($public_key);
        $res = openssl_get_publickey($priKey);
        //把需要加密的内容，按128位拆开加密
        $result  = '';
        for($i = 0; $i < ((strlen($content) - strlen($content)%117)/117+1); $i++  ) {
            $data = mb_strcut($content, $i*117, 117, 'utf-8');
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
    public function rsaSign($data, $private_key) {
        $priKey = file_get_contents($private_key);
        $res = openssl_get_privatekey($priKey);
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
    public function rsaVerify($data, $ali_public_key, $sign)  {
        $pubKey = file_get_contents($ali_public_key);
        $res = openssl_get_publickey($pubKey);
        $result = (bool)openssl_verify($data, base64_decode($sign), $res);
        openssl_free_key($res);
        return $result;
    }
    /**
     * RSA解密
     * @param $content 需要解密的内容，密文
     * @param $private_key 商户私钥文件路径 或 密钥内容本身
     * return 解密后内容，明文
     */
    public function rsaDecrypt($content, $private_key) {
        $priKey = file_get_contents($private_key);
        $res = openssl_get_privatekey($priKey);
        // var_dump($priKey);
        // var_dump($res);exit();
        //用base64将内容还原成二进制
        $content = base64_decode($content);
        //把需要解密的内容，按128位拆开解密
        $result  = '';
        for($i = 0; $i < strlen($content)/128; $i++  ) {
            $data = substr($content, $i * 128, 128);
            openssl_private_decrypt($data, $decrypt, $res);
            $result .= $decrypt;
        }
        openssl_free_key($res);
        return $result;
    }


    public function actionIndex()
    {   
        $postData = array(
            'inputCharset'=>'1',
            'version'=>'1.0',
            'channelId'=>'1037'
        );
        //加密
        echo json_encode($postData);
        echo "<br />";
        $secretData = $this->rsaEncrypt(json_encode($postData), PUBLICPEM_PATH);
        echo 'secretData = '.$secretData;
        echo "<br />";
        // 签名
        $secretSign = $this->rsaSign(base64_decode($secretData), PRIVATEPEM_PATH);
        echo 'secretSign = '.$secretSign;
        echo "<br />";
        $data = array(
            'data'=>$secretData,
            'sign'=>$secretSign
        );

        var_dump($data);
        echo "<br />";
        $getUrl = "http://123.57.152.189:8895/wlcapi/general2/KDJZ/productInfo.html?".http_build_query(array('data' => $secretData,'sign' => $secretSign));
        $postUrl = "http://123.57.152.189:8895/wlcapi/general2/KDJZ/productInfo.html";
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把这行注释掉的话，就会直接输出  
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('data' => $secretData,'sign' => $secretSign)));
        $result=curl_exec($ch);  
        curl_close($ch);
        echo "<br />";
        var_dump($result);

        $result = json_decode($result, true);

        // $resultInfo = ($p_url,$p_method,http_build_query(array('data' => $secretData,'sign' => $secretSign));
        
        echo "<br />";

        //这个是验签的
        $veifyRes =  $this->rsaVerify(base64_decode($result['data']),PUBLICPEM_PATH,$result['sign']);
        var_dump($veifyRes);
        echo "<br />";
        $decryptData = $this->rsaDecrypt("d6jDboPO2hPg43Bp8ouuZ1+Ez1PmATKQlE5OHOGU41WjsFWukqvxhH+YhLJdN3SnBZzRB2E+FzC7ZV5WuuJulSzyWuseTKLvG0t3rXgK4zyWcqRACHwz05EhMftEwHqjZxweV7X+vk+m/kjFvikKUJP5/LpiHE2wRDk4IuruAzpTo9Y/KQJYoYOUemo1RrFSDfkoPEwqLtf2EvK/E9tGAkfG4arY/+QrPtc6PVjaTRv3F2m8bLPkR+kn2zr1JR4z6mkjnq3YJ2/KkcDSHJ2ZoK+N846JJXNBBz1wj3MU57ZD0ghqU4lIzkRJUGqTt5BZA2TzlkmRRQm6b7FfRQRNEg==", PRIVATEPEM_PATH);
        var_dump('decryptData = ',$decryptData);
        echo "<br />";

        // return $this->render('index');
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
