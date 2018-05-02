<?php  
	// 若 $_COOKIE["member"] 不存在，表示尚未登入或註冊
	if(!isset($_COOKIE["member"])){
	
	    // 若 $_POST["member"] and $_POST["password"] 存在，表示來自於登入或註冊頁面
	    if(isset($_POST["member"]) and isset($_POST["password"])){
		    $member = $_POST["member"];
			$password = $_POST["password"];
			$mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");
			$sql = "SELECT `member`
			        FROM `users` 
				    WHERE `users`.`member` = ? AND `users`.`password` = ?";
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param('ss',$member, $password);
			$stmt->execute();
			$stmt->bind_result($name);
			$stmt->fetch();
			
			// 判斷帳號密碼是否存在
			if($name != null){
			    $during = 40*24*60*60;	// 40天(若以3/26起算，5/3會自動消失)
				// 帳號密碼存在
			    setcookie('member', $member, time() + $during);
			    setcookie('password', $password, time() + $during);
				getCards($member);
			}else{
			
			    // 帳號密碼不存在
				echo "<center><h1>您尚未登入或註冊</h1></center>";
			}
		}else{
		
		    // 若 $_POST["member"] and $_POST["password"] 不存在，表示尚未登入或註冊
		    echo "<center><h1>您尚未登入或註冊</h1></center>";
		}
	}else{
	
	    // $_COOKIE["member"] 存在
	    $member = $_COOKIE['member'];
	    getCards($member);
	}
	
	function getCards($member){
	
	    // 取得卡片
	    $mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");
		$sql = "SELECT * FROM cards 
				WHERE `cards`.`member` = ?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('s',$member);
		$stmt->execute();
		$num = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
		$name = array("001", "002", "003", "004", "005", "006", "007", "008", "009", "1001", "1002");
		$stmt->bind_result($member, $num[0], $num[1], $num[2], $num[3], $num[4], $num[5], $num[6], $num[7], $num[8], $num[9], $num[10]);
		
		// 讀取資料
		$result = $stmt->fetch();
		$array = array();
		for($c = 0; $c < count($num); $c++){
		    for($n = 0; $n < $num[$c]; $n++){
			    array_push($array, $name[$c]);
			}		    
		}
		$add = 3 - (count($array) % 3);
		if($add != 3){
		    for($i = 0; $i < $add; $i++){
		        array_push($array, "000");
		    }
		}
		
		// head
		echo "<head>";
		    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
		echo "</head>";
		
		// 遊戲公告
		$aaa = "https://www.facebook.com/groups/NTPU1949/permalink/1664058423684290/";
		echo "<center><br><h1>遊戲公告：<a href=\"$aaa\" target=\"_blank\"> ~點擊檢視遊戲公告~ </a></h1><br><br></center>";
		
		// 產生表格
		echo "<center><table style=\"width:99%; padding:5px;\"  rules=\"all\">";
		for($i = 0; $i < count($array); $i += 3){
		    echo "<tr>";
		    for($n = $i; $n < $i + 3; $n++){
			    echo "<td style=\"width:33%;\">";
			    if($array[$n] != "000"){
				    //echo "<a href=\"card$array[$n].html\"><img src=\"photo/card$array[$n].png\" style=\"width:100%;\"></a>";
					echo "<a href=\"card.php?number=$array[$n]\"><img src=\"photo/card$array[$n].png\" style=\"width:100%;\"></a>";							
				}else{
				    echo "<img src=\"photo/card$array[$n].png\" style=\"width:100%;\">";
				}
                echo "</td>";			    
			}
			echo "</tr>";
		}
        echo "</table></center>";		
	}
?>