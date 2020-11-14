<?
class users
{
	protected $user;
	protected $pass;
	protected $main_page;
	protected $login_page;
	protected $salt_pass;
	protected $XOR_pass;

	public function __construct()  {
		session_start(); // начинаем сессию
		//if(!isset($_SESSION['user']['authorized']))
		//{
			//$_SESSION['user']['authorized'] = 0;
		//} else {
			//$_SESSION['user'] = array();
		
		//}
		$_SESSION['session']['name'] = session_name();
		$_SESSION['session']['id'] = session_id();
		$this->salt_pass = 'fDy5jM9YBWPYQVD'; 
		$this->XOR_pass = 'T${qFI~r%lx0#uKjnLP'; 



		$this->main_page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].'/inventory/';
		$this->login_page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].'/inventory/user/login/';
	}

	public function authorized($login=0)
	{
		//$_SESSION['user']['authorized'] = 1;
		//$_SESSION['user']['authorized'] = 0;
		//if($_SESSION['user']['authorized'] ) return 1;
		//if(isset($_SESSION['user']['authorized'])) return 1;
		//if($_SESSION['user']['authorized']) return true;
		//$this->login(1,1);
		

		//$this->get_cookie('u_login');
	//$this->get_cookie('u_pass');
	//$this->get_cookie('u_sum');


		//if($this->get_XOR_user($_SESSION['user']['login'], $_SESSION['user']['pass'])) $_SESSION['user']['authorized'] = 1;
		//if($this->get_XOR_summ()) $_SESSION['user']['authorized'] = 1;
		if($this->get_XOR_summ()) $_SESSION['user']['authorized'] = 1;
		if($login==0 && (!$this->get_cookie('u_login')) && (!$this->get_cookie('u_pass')))  $_SESSION['user']['authorized'] = 0;
		if(isset($_SESSION['user']) && ($_SESSION['user']['authorized'])) return true;


		//if($this->get_cookie('user_authorized')) 


		//if($_SESSION['user']['authorized']) return true;
		return false;
	}

	public function login($user, $pass)
	{
		//session_start(); // начинаем сессию
		//$_SESSION['user']['authorized'] = true;

		$pass = base64_encode(pack('H*',md5(utf8_encode($pass))));;



		//$this->set_cookie('user_authorized', 1);
		$this->set_XOR_summ($user, $pass);
		$_SESSION['user']['login'] = $user;
		$_SESSION['user']['pass'] = $pass;
		$_SESSION['user']['authorized'] = 1;
		//echo $user;
		//echo $pass;
		//$this->user = $user;
		//$this->pass = $pass;
		//$this->mainpage();
	}

	public function logout()
	{
		//$_SESSION['user'] = array();
		session_start(); // начинаем сессию
		session_destroy();
		//$_SESSION['user']['authorized'] = false;
		$this->del_cookie('u_login');
		$this->del_cookie('u_pass');
		$this->del_cookie('u_sum');
		//$this->del_cookie('user_authorized');
		//$_SESSION['user']['authorized'] = 0;
		unset($_SESSION['user']);
		unset($_SESSION['session']);
		//$this->loginpage();
	}



	

	public function mainpage()
	{
		header('Location: '. $this->main_page);
		exit();
	}


	public function loginpage()
	{
		header('Location: '. $this->login_page);
		exit();
	}


	public function set_session($key, $value)  {
		$_SESSION[$key]=$value;
	}
  
    public function get_session($key)  {
		$value = $_SESSION[$key];
		return $value;
	}


	public function check_session($key)  {
  		if (isset($_SESSION[$key])) return 1;
		return 0;
	}

	public function del_session($key)  {
		unset($_SESSION[$key]);
	}



	public function set_cookie($key, $value, $time=0)
	{
		if($time==0) $time = 3600;
		return setcookie($key,$value,time()+$time, "/");
	}

		public function get_cookie($key)
		{
			if (isset($_COOKIE[$key])) return $_COOKIE[$key];
			return false;
		}

	public function del_cookie($key)
	{
		//return setcookie($key,"", 0);
		//unset($_COOKIE[$key]); 
    	setcookie($key, null, -1, '/'); 
	}


public function set_XOR_summ ( $login, $pass )  {
	
	//$this->XOR_pass;
	
	//$random_1 = rand(0,100000);
	//$random_2 = date( "dYmdYmd");
	//$random_3 = rand(0,100000);
	//$random = $random_1 . $random_2 . $random_3;
	//$random=base64_encode(pack('H*',sha1(md5(utf8_encode($random)))));
	//$random=base64_encode(pack('H*',md5(utf8_encode($random))));
	$login_XOR = $this->__XOR_Encode ( $login, $this->XOR_pass );
	$pass_XOR = $this->__XOR_Encode ( $pass, $this->XOR_pass);
	$summ_XOR = $this->__XOR_Encode ( $login_XOR , $pass_XOR);
	$this->set_cookie('u_login', $login_XOR);
	$this->set_cookie('u_pass', $pass_XOR);
	$this->set_cookie('u_sum', $summ_XOR);
	//SetCookie("SoCol_xQ_pass", $pass_XOR,  time() + 60 * 60 * 24 * 365, "/");
	//SetCookie("SoCol_xQ_user", $login_XOR,  time() + 60 * 60 * 24 * 365, "/");
	//$pass_XOR_opt =$this-> __XOR_EncodeStatic ( $random, $__XOR_pass );
	//SetCookie("SoCol_xQ_data", $pass_XOR_opt,  time() + 60 * 60 * 24 * 365, "/");
	//SetCookie("SoCol_xQ_data", $pass_XOR_opt,  time() + 60 * 60 * 24 * 365, "/", $_SERVER['HTTP_HOST']);
}





public function get_XOR_summ()  {
	

	$cookie_login_XOR = $this->get_cookie('u_login');
	$cookie_pass_XOR = $this->get_cookie('u_pass');
	$cookie_XOR_summ = $this->get_cookie('u_sum');
//
	//$login_XOR = $this->__XOR_Encode ( $login, $this->XOR_pass );
	//$pass_XOR = $this->__XOR_Encode ( $pass, $this->XOR_pass);

	//$summ_XOR = $this->__XOR_Decode ( $login_XOR . $pass_XOR, $this->XOR_pass);
	$summ_XOR = $this->__XOR_Decode ( $cookie_XOR_summ , $cookie_pass_XOR);


	if($summ_XOR === $cookie_login_XOR) return true;

	return false;
	//$this->XOR_pass;
	
	//$random_1 = rand(0,100000);
	//$random_2 = date( "dYmdYmd");
	//$random_3 = rand(0,100000);
	//$random = $random_1 . $random_2 . $random_3;
	//$random=base64_encode(pack('H*',sha1(md5(utf8_encode($random)))));
	//$random=base64_encode(pack('H*',md5(utf8_encode($random))));
	//$login_XOR = $this->__XOR_Encode ( $login, $this->XOR_pass );
	//$pass_XOR = $this->__XOR_Encode ( $pass, $this->XOR_pass);
	//$this->set_cookie('u_login', $login_XOR);
	//$this->set_cookie('u_pass', $pass_XOR);
	//SetCookie("SoCol_xQ_pass", $pass_XOR,  time() + 60 * 60 * 24 * 365, "/");
	//SetCookie("SoCol_xQ_user", $login_XOR,  time() + 60 * 60 * 24 * 365, "/");
	//$pass_XOR_opt =$this-> __XOR_EncodeStatic ( $random, $__XOR_pass );
	//SetCookie("SoCol_xQ_data", $pass_XOR_opt,  time() + 60 * 60 * 24 * 365, "/");
	//SetCookie("SoCol_xQ_data", $pass_XOR_opt,  time() + 60 * 60 * 24 * 365, "/", $_SERVER['HTTP_HOST']);
}










public function set_XOR_user ( $login, $pass )  {
	
	//$this->XOR_pass;
	
	//$random_1 = rand(0,100000);
	//$random_2 = date( "dYmdYmd");
	//$random_3 = rand(0,100000);
	//$random = $random_1 . $random_2 . $random_3;
	//$random=base64_encode(pack('H*',sha1(md5(utf8_encode($random)))));
	//$random=base64_encode(pack('H*',md5(utf8_encode($random))));
	$login_XOR = $this->__XOR_Encode ( $login, $this->XOR_pass );
	$pass_XOR = $this->__XOR_Encode ( $pass, $this->XOR_pass);
	$this->set_cookie('u_login', $login_XOR);
	$this->set_cookie('u_pass', $pass_XOR);
	//SetCookie("SoCol_xQ_pass", $pass_XOR,  time() + 60 * 60 * 24 * 365, "/");
	//SetCookie("SoCol_xQ_user", $login_XOR,  time() + 60 * 60 * 24 * 365, "/");
	//$pass_XOR_opt =$this-> __XOR_EncodeStatic ( $random, $__XOR_pass );
	//SetCookie("SoCol_xQ_data", $pass_XOR_opt,  time() + 60 * 60 * 24 * 365, "/");
	//SetCookie("SoCol_xQ_data", $pass_XOR_opt,  time() + 60 * 60 * 24 * 365, "/", $_SERVER['HTTP_HOST']);
}


public function get_XOR_user ( $login, $pass )  {
	if(($this->get_XOR_login($login)) && ($this->get_XOR_pass($pass))) return true;
	return false;
}


public function get_XOR_login ($login)  {
	
	if ($this->get_cookie('u_login')) {
		$u_login = $this->__XOR_Decode ( $this->get_cookie('u_login'), $this->XOR_pass );
		if($login === $u_login) return true;
	}
	return false;
}


public function get_XOR_pass ($pass)  {
	
	if ($this->get_cookie('u_pass')) {
		$u_pass = $this->__XOR_Decode ( $this->get_cookie('u_pass'), $this->XOR_pass );
		if($pass === $u_pass) return true;
	}
	return false;
}



public function __XOR_Decode ( $text, $pass )  {
	$txt = $this->strcode(base64_decode($text), $pass);
	return $txt;
}

public function __XOR_Encode ( $text, $pass )  {
	$txt = base64_encode($this->strcode($text, $pass));
	return $txt;
}


private function strcode ( $str, $passw="" ) {
	$salt = "Dn8*#2n!9j";
	//$salt = date( "Y.m.d.Y.m");
	$len = strlen($str);
	$gamma = '';
	$n = $len>100 ? 8 : 2;
	while( strlen($gamma)<$len ) {
		$gamma .= substr(pack('H*', sha1($passw.$gamma.$salt)), 0, $n);
	}
   
   return $str^$gamma;
}
	




	

}

?>