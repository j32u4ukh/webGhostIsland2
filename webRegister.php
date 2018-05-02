<html>
    <head>
	    <title>Register Page</title>
		<style>
			font, .tit{
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
	<body><center>
	    <font>《註冊》</font><br><br>
		<form method="post" action="webRegister.php">
			<font>帳號：<input type="text" name="member" class="iit"></font><br><br>
			<font>密碼：<input type="text" name="password" class="iit"></font><br><br>
			<input type="submit" value="送出" style="width:180px; height:60px; font-size:30px;">
		</form>
		<!--<br><font class="tit">建議帳號可取名為：學校名稱+綽號，例如北大毒Q。</font>
		<br><font class="tit">之後要搶卡片時就可以挑學校來攻擊啦XD</font><br>-->
		<br><br><br><br><br><font class="tit"><a href="webLogin.php">已有帳號？ 登入</a></font>
	
<?php
	if(isset($_POST["member"]) and isset($_POST["password"])){
	
	    // 判斷此帳號是否可以使用
	    $mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");
	    $member = $_POST["member"];
		$password = $_POST["password"];
		
		$sql = "SELECT member 
	            FROM cards 
			    WHERE `cards`.`member` = ?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('s',$member);
		$stmt->execute();
		$stmt->bind_result($name);
		$stmt->fetch();
		
		$response = array();
		if($name != null){
			echo "<br><br><font class=\"tit\">此帳號已有人使用，請重新整理頁面後再次嘗試~</font>"; 		
		}else{
		
		    // 可以使用則將資料加入 cards 和 users
			$mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");
			
			// array[9]：1001；array[10]：1002
			$array = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
			
			// 隨機贈送一張卡片
			$gift = rand(0, 6);	
			$array[$gift] += 1;
			$sql = "INSERT INTO `cards` (`member`, `001`, `002`, `003`, `004`, `005`, `006`, `007`, `008`, `009`, `1001`, `1002`) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";	
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param('siiiiiiiiiii',$member,$array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10]);
			$stmt->execute();
			
			$mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");
			$sql = "INSERT INTO `users` (`member`, `password`) 
					VALUES (?, ?)";	
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param('ss',$member,$password);
			$stmt->execute();
			
			echo "<br><br><font class=\"tit\">註冊成功，請再次登入~</font>";
		}
	}
?>
    </center></body>
</html>