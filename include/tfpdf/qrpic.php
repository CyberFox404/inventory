<?
	if(isset($_GET['d']))
	{
		$data = isset($_GET['d']);
		$qrlinkform = "https://chart.googleapis.com/chart?cht=qr&chl=rhpn=%s&chs=100x100&chld=L|0";
		$qrlink = sprintf($qrlinkform, $data);
		header("Content-type: image/png");
		echo file_get_contents($qrlink);
	}
?>