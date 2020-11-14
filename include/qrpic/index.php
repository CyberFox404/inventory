<?
	if(isset($_GET['d']))
	{
		$data = $_GET['d'];
		$qrlinkform = "https://chart.googleapis.com/chart?cht=qr&chl=rhpn=%s&chs=100x100&chld=L|0";
		$qrlink = sprintf($qrlinkform, $data);	
		$img = "qrcode/" . $data.'.png';
		if (!file_exists($img)) file_put_contents($img, file_get_contents($qrlink));
		if(isset($_GET['e']))
		{
			echo 1;
		} else {
			header("Content-type: image/png");
			echo file_get_contents($img);
		}
	}
?>