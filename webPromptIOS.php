<head>
	<style>
		.tit{
			height:50px;
			line-height:50px;
			font-size:0.618cm; 
		}
		font{
		    font-size:1cm;
		}
	</style>
</head>
<?php
    if(isset($_POST["member"]) and isset($_POST["item"])){	
	   $item = $_POST['item'];
			$member = $_POST['member'];
			echo "<center><font>你好 $member</font><br>";
			echo "<font>消費了商品編號 $item </font></center>";		
			
			// 取得 $cost
			$mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");
			$sql = "SELECT cost 
				    FROM `items`
				    WHERE `items`.`item` = ?";
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param('s',$item);
			$stmt->execute();
			$stmt->bind_result($cost);
			$stmt->fetch();
			
			// 紀錄消費
			$mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");
			$sql = "INSERT INTO `shohiRecord` (`member`, `item`, `cost`, `time`) 
					VALUES (?, ?, ?, CURRENT_TIMESTAMP)";	
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param('sii',$member, $item, $cost);
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
			
			$number = rand(1, 3);
			$numToKey = array(
				1 => '1001',
				2 => '1002',
				3 => '1002');
			
			// 增加1張咒語卡
			$mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");
			$sql = "UPDATE `cards` SET `$numToKey[$number]` = ? 
					WHERE `cards`.`member` = ?";
			$update_to = $result[$numToKey[$number]] + 1;
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param('is',$update_to, $member);
			$stmt->execute();
			
			// 跳回首頁，避免重複給予卡片
			echo "<center><h2>已獲得一張卡片</h2>";
			echo "<form method=\"post\" action=\"../webGhostIsland2/\">";
				echo "<input type=\"submit\" value=\"確認\"  class=\"tit\">";
			echo "</form></center>";
	}
?>