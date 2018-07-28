<?php
namespace App\Http\Helpers;


class FuntionHelper
{

    //随机产生六位数密码Begin
    public static function randStr($len=6) {
        $chars='0123456789';
        mt_srand((double)microtime()*1000000*getmypid());
        $password="";
        while(strlen($password)<$len)
            $password.=substr($chars,(mt_rand()%strlen($chars)),1);
        return $password;
    }

    /**
     * generatge UUID
     * @return string
     */
    public static function generate_uuid(){
        $charId = md5(uniqid(rand(), true));
        $hyphen = chr(45);// "-"
        $uuid = substr($charId, 0, 8).$hyphen
            .substr($charId, 8, 4).$hyphen
            .substr($charId, 12, 4).$hyphen
            .substr($charId, 16, 4).$hyphen
            .substr($charId, 20, 12);
        return $uuid;
    }

    /**
     * 方糖 、 邮件监控
     * @param        $content
     * @param string $type email 邮件| 其他 方糖
     * @param string $user
     * @param string $title
     */
    public static function monitor($content, $type = '', $user = 'wangmaolin', $title='hashfish报警'){
        $ToolsRepository = new ToolsRepository();
        $ToolsRepository->sendFangTangMessage($user, $title, $content, $type);
    }


    /*
     * 邮箱判断
     * @param $email 邮箱
     * @return bool
     */
    public static function is_email($email, $base64_decode = false){
        $email = $base64_decode ? base64_decode($email) : $email;
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 手机号验证
     * @param $phone
     * @return bool
     */
    public static function is_phone($phone, $base64_decode = false)
    {
        $phone = $base64_decode ? base64_decode($phone) : $phone;
        if (preg_match("/^1[3456789]{1}\d{9}$/", $phone)) {
            return true;
        } else {
            return false;
        }
    }

    public static function is_chineseName($name)
    {
        $name = str_replace('.', '', $name);
        if (preg_match('/^([\xe4-\xe9][\x80-\xbf]{2}){2,}$/', $name)) {
            return true;
        } else {
            return false;
        }
    }


    /*对科学计数法表示的数字还原到小数表示*/
    public static function enum2str($num, $scale = 8)
    {
        if (false !== stripos($num, "e")) {
            $a = explode("e", strtolower($num));
            return bcmul($a[0], bcpow('10', $a[1], 30), $scale);
        } else {
            return $num;
        }
    }

    public static function array_value(array $arr, array $keys, $type = '', $callback = '')
    {
        if (empty($keys)) {
            return [];
        }
        $keys = array_flip($keys);
        if ($type == 'map') {
            $data = array_map(function ($v) use ($keys, $callback) {
                if (is_callable($callback)) {
                    $v = $callback($v);
                }
                return array_intersect_key($v, $keys);
            }, $arr);
        } else {
            $data = array_intersect_key($arr, $keys);
        }
        return $data;
    }

    /**
     * 获取随机浮点数
     * @param $min  number 最小值
     * @param $max  number 最大值
     * @param $num  number 小数位
     * @return string 浮点数
     */
    public static function randomFloat($min, $max, $num) {
        return bcadd($min, bcmul(bcdiv(mt_rand(), mt_getrandmax(), 2), bcsub($max, $min, 0), 2), $num);
    }

    /**
     * 获取下一页请求地址
     * @param        $Request
     * @param array  $data
     * @param string $total
     * @param int    $pageNum
     * @return string
     */
    public static function nextPage($Request, $data = [], $total = '', $pageNum = '')
    {
        $pageNum = empty($pageNum) ? Config::$PER_PAGE_NUM : $pageNum;
        $parm = $Request->all();
        $parm = empty($data) ? $parm : array_merge($data, $parm);
        if (array_key_exists('page', $parm) && is_numeric($parm['page'])) {
            $parm['page'] = intval($parm['page']) + 1;
        } else {
            $parm['page'] = 2;
        }
        $page = $parm['page'] - 1;
        if (is_numeric($total) && bcmul($page, $pageNum, 0) >= $total) {
            return '';
        }
        return $Request->getSchemeAndHttpHost() . $Request->getPathInfo() . '?' . http_build_query($parm);
    }

    public static function floatFormat($val)
    {
        if (false !== strpos($val, '.')){
            return rtrim(rtrim($val, '0'), '.');
        }
        return $val;
    }
}
