<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function expire(){
        if(!$_GET['weixin_key'] || !$_GET['sign']){
            $this->show('<style>.error{font-size: 300%;text-align: center;padding-top: 50px;margin-left: 10%;margin-right: 10%;line-height: 200%;}
</style><div class="error">当前连接已失效,请返回「四川大学飞扬俱乐部」微信,重新回复: 1 进入报修</div>');
            exit;
        }

        if((time()-intval(decode($_GET['sign'])))>=300){
            $this->show('<style>.error{font-size: 300%;text-align: center;padding-top: 50px;margin-left: 10%;margin-right: 10%;line-height: 200%;}
</style><div class="error">当前连接已失效,请返回「四川大学飞扬俱乐部」微信,重新回复: 1 进入报修</div>');
            exit;
        }

        $sign=md5('u_can_u_up'.$_GET['weixin_key']. 'xiaohua_is_baka' . intval(time()/300) .'dsgygb');
        $url=C('SUPER_URL').'?appid='.C('APP_ID').'&superid='.$_GET['weixin_key'].'&sign='.$sign;
        redirect($url);
    }
}