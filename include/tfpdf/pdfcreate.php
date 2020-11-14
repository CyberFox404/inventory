<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/fs.php'); 
require('tfpdf.php');

class PDF extends tFPDF
{
	function simple($data, $x = 95, $y = 34, $margins = 10)
	{
		$qrlinkform = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'] . "/inventory/include/qrpic/?d=%s"; 





		$arrCount = count($data);
		$col = 20;
		$row = 30;
		$curNum = 0;
		$lenghtshift_y = $margins;

		for ($a = 0; $a < $row; $a++)
		{
			
			$lenghtshift_x = $margins;
			$this->SetY($lenghtshift_y, false);
			$lastY = $this->GetY();

			for ($b = 0; $b < $col; $b++)
			{
				$lastX = $this->GetX();

				$qrlink = sprintf($qrlinkform, $data[$curNum][1]);
				$this->Image($qrlink,$lenghtshift_x + 5 ,$lenghtshift_y + 5, -100, -100, 'PNG');
	
				$this->Cell($x,0,"",1);

				$this->SetX($lenghtshift_x);
				$this->Cell(0,$y,"",1);

				$text_start = 5;
				$text_shift = 5;
				$text_pos = $text_start;

				$this->SetFontSize(12);
				$this->SetX($lenghtshift_x+35);
				$this->SetY($lenghtshift_y+$text_pos, false);
				//$text = "343202620110000002";
				$text = $data[$curNum][0];
				$this->Cell(5,5,$text,0);

				$text_shift = 10;
				$text_pos += $text_shift;
				$text_shift = 5;

				$this->SetFontSize(8);
				$this->SetX($lenghtshift_x+35);
				$this->SetY($lenghtshift_y+$text_pos, false);
				//$text = "PC-wgdAiyNAIA";
				$text = $data[$curNum][1];
				$this->Cell(5,5,$text,0);

				$text_pos += $text_shift;

				$this->SetX($lenghtshift_x+35);
				$this->SetY($lenghtshift_y+$text_pos, false);
				$text = $data[$curNum][2];
				$this->Cell(5,5,$text,0);

				$text_pos += $text_shift;

				$this->SetX($lenghtshift_x+35);
				$this->SetY($lenghtshift_y+$text_pos, false);
				$text = $data[$curNum][3];
				$this->MultiCell( 58, 5, $text);

				$this->SetX($lastX);
				$this->SetY($lastY, false);

				$lenghtshift_x += $x;

				$curNum++;

				if ($curNum >= $arrCount) break;
				if($lenghtshift_x+$x > 200) break;
			}

			if ($curNum >= $arrCount)
			{
				if($arrCount % 2 != 0)
				{
					$this->Cell($x,0,"",1);
					$this->SetX($lenghtshift_x);
					$this->Cell(0,$y,"",1);
				}
				break;
			}

			$lenghtshift_y += $y;

			$this->Ln();
			if($lenghtshift_y > 270)
			{
				$curNum = 0;
				$lenghtshift_y = $margins;

			}
		}
	}
}


if (isset($_POST))
{ 
	if (is_file($pdfname)) unlink($pdfname);

	$count = count($_POST);

	$pdf = new PDF('P','mm','A4');
	$pdf->SetAutoPageBreak(true, 30);
	//$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
	$pdf->SetFont('DejaVu','',12);

	$data = array( );

	for($i=0; $i<$count; $i++)
	{		
		$dataid = apianswer('get.inventoryiddata={"id":"'.$_POST[$i].'"}')["data"];

		$prep = array();

		$prep[] = $dataid['inventory_number'];
		$prep[] = $dataid['inner_number'];
		$dataval = apianswer('get.findval={"table":"type","id":"' . $dataid['type'] . '"}')["data"]["name"];
		$prep[] = $dataval;
		$prep[] = $dataid['model'];

		$data[] = $prep;
	}

	$pdf->simple($data);
	$pdf->Output($pdfname, 'F');
	echo 1;
}

?>