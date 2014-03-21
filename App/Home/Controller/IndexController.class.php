<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
		$M = M('baby');
		$data = $M->select();
		foreach($data as $key=>$val){
			$P = M('praise');
			$data[$key]['praise'] = $P->where(array('bid'=>$val['id']))->count();
		}
		
		$this->assign('data',$data);
		$this->display();
	}
	
	public function publish(){
		$M = M('baby');
		$count = $M->order('id desc')->find();
		$this->assign('count',$count[id]+1);
		$this->display();
	}
	
	public function AddPublish(){
		$name = $_POST['name'];
		$tel = $_POST['tel'];
		$content = $_POST['content'];
		$pic = $_POST['pic'];
		foreach($pic as $key=>$val){
			$data['pic'.$key] = $val;
		}
		$data['name'] = $name;
		$data['tel'] = $tel;
		$data['content'] = $content;
		$M = M('baby');
		$M->add($data);
		//var_dump($data);
	}
	
	public function ajaxPraise(){
		$openid = $_POST['openid'];
		$id = $_POST['id'];
		$praise = M('praise');		
		$isPraise = $praise->where("bid=%d AND openid='%s'",array($id,$openid))->find();
		if(!$IsPraise){
			if(date("YDM", time()) != date("YDM", $isPraise['data'])){//同一天
				$data['openid'] = $openid;
				$data['bid'] = $id;
				$data['data'] = time();				
				if(!M('pinfo')->where("openid='%s'",$openid)->find()){//判断是否记录信息
					echo 1;
				}else{
					$praise->add($data);
					echo 2;
				}
			}else{
				echo 3;
			}
		}
	}
	
	public function ajaxAddUser(){
		$openid = $_POST['openid'];
		$id = $_POST['id'];
		$tel = $_POST['tel'];
		$U = M('pinfo');
		$data['openid'] = $openid;
		$data['tel'] = $tel;
		$U->add($data);
		$data1['openid'] = $openid;
		$data1['bid'] = $id;
		$data1['data'] = time();	
		M('praise')->add($data1);
	}
	public function show(){
		$code = $_POST['code'];
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxe60a7669dfb88b33&secret=d6974889e28435c692522c3e7bb356e8&code=".$code."&grant_type=authorization_code";
		$atjson=file_get_contents($url);
		$result=json_decode($atjson,true);
		if($_GET['id']){
			$id = $_GET['id'];
		}else{
			$id = $_GET['state'];
		}		
		$M = M('baby');
		$data = $M->where(array('id'=>$id))->find();
		$this->assign('data',$data);
		$this->assign('openid',$result['openid']);
		$this->display();
	}
}