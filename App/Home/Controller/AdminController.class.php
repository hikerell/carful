<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
	public function index(){
		if($_SESSION['admin'] ==''){
			$this->redirect('login');
		}
		$M = M('baby');
		$count = $M->where('ispass=0')->order('data desc')->count();
		$Page = new \Think\Page($count,6);
		$show = $Page->show();
		$data = $M->where('ispass=0')->order('data desc')->limit($Page->firstRow.','.$Page->listRows)->select();	
		$this->assign('page',$show);
		$this->assign('data',$data);
		$this->display();
	}
	
	public function code(){
		$Verify = new \Think\Verify();
		$Verify->imageH = 30;
		$Verify->fontSize = 15;
		$Verify->entry();
	}
	
	public function login(){
		$this->display();
	}
	
	public function AdminDoLogin(){
		$data['username'] = $_POST['username'];
		$data['password'] = $_POST['password'];
		$data['code'] = $_POST['code'];;
		$verify = new \Think\Verify();
		if( $verify->check($data[code], '') ){		
			if($data['username'] =="carful" && $data['password']=="cj5dyzm"){
				$_SESSION['admin']="1";
				$this->success('登录成功', __MODULE__.'/admin/index');
				}else{
				$this->error($password);
				}
		}else{
			$this->error('验证码错误');
			}
	}
	
	public function del(){
		$id = $_POST['id'];
		$M = M('baby');
		$c = $M->where('id=%d',$id)->delete();
		if($c){
			echo 1;
		}else{
			echo 2;
		}
	}
	
	public function pass(){
		$id = $_POST['id'];
		$M = M('baby');
		$data['ispass'] = 1;
		$c = $M->where('id=%d',$id)->save($data);
		if($c){
			echo 1;
		}else{
			echo 2;
		}
	}
}
?>