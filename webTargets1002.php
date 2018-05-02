<head>
	<style>
		.tit{
			height:50px;
			line-height:50px;
			font-size:1cm; 
		}
		.iit{
		    width:200px; 
			height:50px;
			line-height:50px;
			font-size:1cm; 
		}
	</style>
</head>
<?php
    $mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");
	$sql = "SELECT * FROM cards 
	        ORDER BY `001` +`002` +`003` +`004` +`005` +`006` +`007` +`008` +`009` DESC
			LIMIT 5";
	$result = $mysqli->query($sql);
	
	$jumon = "1002";
	echo "<form method=\"post\" action=\"webTargets1002.php\">";
	while($read = $result->fetch_array()) {
		$target = $read[0];
		$info = $target . "擁有卡片種類為：";
		//$read[$i] = '';
		for($i = 1; $i < 10; $i++){
			if($read[$i] > 0){
				$info .= "$i ";
			}
		}
		echo "<font class=\"tit\"><input type=\"radio\" name=\"target\" value=\"$target\"  style=\"width:30px; height:30px;\">$info</font><br><br>";
	}
		echo "<br><br><input type=\"submit\" value=\"攻擊\" style=\"width:180px; height:60px; font-size:30px;\">";
	echo "</form>";
	
	// 處理攻擊
	if(isset($_POST['target'])){
	    $target = $_POST["target"];
		$member = $_COOKIE['member'];
		
		// 取得target卡片數量	
		$tResult = array();
		$sql = "SELECT * FROM cards 
				WHERE `cards`.`member` = ?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('s',$target);
		$stmt->execute();
		$stmt->bind_result($Target, $tResult[1], $tResult[2], $tResult[3], $tResult[4], $tResult[5], 
						   $tResult[6], $tResult[7], $tResult[8], $tResult[9], $tResult["1001"], $tResult["1002"]);
		$stmt->fetch();
		
		// 隨機減少1張target卡片數量
		$number = rand(1, 9);
		while($tResult[$number] == 0){
			$number = rand(1, 9);
		}
		$numToKey = array(
			1 => '001',
			2 => '002',
			3 => '003',
			4 => '004',
			5 => '005',
			6 => '006',
			7 => '007',
			8 => '008',
			9 => '009');
			
		// 第$number張卡片數量不為0 
		$mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");
		$sql = "UPDATE `cards` SET `$numToKey[$number]` = ? 
				WHERE `cards`.`member` = ?";
		$update_to = $tResult[$number] - 1;
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('is',$update_to,$target);
		$stmt->execute();
		
		// 取得自己卡片數量
		$mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");	
		$result = array();
		$sql = "SELECT * FROM cards 
				WHERE `cards`.`member` = ?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('s',$member);
		$stmt->execute();
		$stmt->bind_result($member, $result[1], $result[2], $result[3], $result[4], $result[5], 
						   $result[6], $result[7], $result[8], $result[9], $result["1001"], $result["1002"]);
		$stmt->fetch();	
		
		// 自己第$number張卡片數量+1(從target那裏搶來的)
		$mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");	
		$sql = "UPDATE `cards` SET `$numToKey[$number]` = ?, `$jumon` = ?
				WHERE `cards`.`member` = ?";
		$stmt = $mysqli->prepare($sql);
		$update_to = $result[$number] + 1;
		$updateJumon = $result[$jumon] - 1;
		$stmt->bind_param('iis', $update_to, $updateJumon, $member);
		$stmt->execute();
		
		// 跳回首頁，避免重複給予卡片
	    echo "<center><p class=\"tit\">已獲得一張卡片</p>";
		echo "<form method=\"post\" action=\"../webGhostIsland2/webBook.php\">";
			echo "<input type=\"submit\" value=\"確認\" style=\"width:180px; height:60px; font-size:30px;\">";
		echo "</form></center>";
	}
?>
