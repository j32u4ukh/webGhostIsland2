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

    // 若無 $_GET['item'] ，表示為無效QRcode
    if(!isset($_GET['item'])){
	    echo "<center><font>為無效QRcode</font></center>";
	}else{
	
	    // 判斷有無帳號
	    if(!isset($_COOKIE['member'])){
			/*$item = $_GET['item'];
			echo "<form method=\"post\" action=\"webPromptIOS.php\">
					<font>帳號：<input type=\"text\" name=\"member\" class=\"tit\"></font><br><br>
					<font>商品編號：<input type=\"text\" name=\"item\" class=\"tit\" value=\"$item\"></font><br><br>
					<input type=\"submit\" value=\"送出\" class=\"tit\">
				</form><br>";*/
			
		    // 無帳號，產生廣告，讓消費者去註冊
		    echo "<a href=\"../webGhostIsland2\"><img src=\"photo/Ghost_Island_2.png\" width=\"100%\"></a>";
		}else{
		    // 有效QRcode
			$item = $_GET['item'];
			$member = $_COOKIE['member'];
			echo "<br><br><br>";
			echo "<center><font>你好 $member</font><br>";
			echo "<font>感謝您的消費~</font></center><br><br>";		
			
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
			echo "<center><h1>已獲得一張咒語卡</h1><br><br>";
			echo "<form method=\"post\" action=\"../webGhostIsland2/\">";
				echo "<input type=\"submit\" value=\"確認\"  style=\"width:180px; height:60px; font-size:30px;\">";
			echo "</form></center>";
		}
	}
?>