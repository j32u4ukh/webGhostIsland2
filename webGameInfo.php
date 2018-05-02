<html>
    <head>
	    <title>遊戲介紹</title>
		<meta charset="utf-8">
		<style>
		    body{
				background-color:#3abefa;
			}
		    #table{
			    background-color:#ff7700; 
			    border:3px #caAC55 solid; 
			    padding:5px;
			}
			#cardInfo{
			    width:90%;
				height:100%;
				border:5px groove #AAF78C;
				background-color:#ff7700;
			}
			img{
			    width:100%;
			}
			.images{
			    width:37.5%;
			}
			.setsumei{
			    width:62.5%;
				background-color:#3abefa;
			}
			.H{
			    font-weight:bold;
				font-size:0.618cm;
			}
			.T{
			    font-size:0.618cm;
			}
			#storeIntro{
			    width:100px;
			}
			.text{
			    font-size:0.5cm;
			}
			span{
			    font-weight:bold;
				color:#ff0101;
			}
		</style>
	</head>
	<body>
	
	    <!--Introduction of Ghost Island 2-->
	    <center>
		    <font class="H">Ghost Island 2 遊戲介紹</font>
			<p class="T">這是一個以鬼島日常為主題的卡片搶奪遊戲，</p>
			<p class="T">玩家每次消費後都可以讀取相對應的QRcode，</p>
			<p class="T">將獲得一張咒語卡，用來搶奪其他玩家的卡片，</p>
			<p class="T">蒐集到下列所有卡片的人，<span>將贈予一組實體卡片</span></p>
			<p class="T"><span>，作為破關獎勵。遊戲自即日起到4/30止~</span></p>
			<hr><hr>
		</center>
		
		<!--Introduction of Cards-->
        <center><table id="cardInfo">
		    <tr>
			    <td class="images"><img src="photo/001.png"></td>
				<td class="setsumei">
				    <font class="H">NO.001 邊緣人</font><br><br>
					<font class="T">我在哪裡，哪裡就是邊邊...</font>	
				</td>
			</tr>
			<tr>
			    <td class="images"><img src="photo/002.png"></td>
				<td class="setsumei">
				    <font class="H">NO.002 我家小孩很乖</font><br><br>
					<font class="T">我家小孩很乖，一定是朋友帶壞他的。</font>
				</td>
			</tr>
			<tr>
			    <td class="images"><img src="photo/003.png"></td>
				<td class="setsumei">
				    <font class="H">NO.003 只喜歡好學生</font><br><br>
					<font class="T">小杉真厲害，這次又考100分了。</font><br>
					<font class="T">還有那個誰，自己把考卷拿回去。</font><br>
				</td>
			</tr>
			<tr>
			    <td class="images"><img src="photo/004.png"></td>
				<td class="setsumei">
				    <font class="H">NO.004 無風無雨的颱風假</font><br><br>
					<font class="T">颱風假看電影~ 超爽der~</font>
				</td>
			</tr>
			<tr>
			    <td class="images"><img src="photo/005.png"></td>
				<td class="setsumei">
					<font class="H">NO.005 我媽覺得冷</font><br><br>
					<font class="T">請相信你的孩子有足夠的能力判斷冷熱 (´･_･`)</font>
				</td>
			</tr>
			<tr>
			    <td class="images"><img src="photo/006.png"></td>
				<td class="setsumei">
				    <font class="H">NO.006 累得要死的工具人</font><br><br>
					<font class="T">工具人服務表：</font>
					<ul>
					    <li><font class="T">修電腦</font></li>
						<li><font class="T">買早餐</font></li>
						<li><font class="T">接送服務</font></li>
					</ul>
				</td>
			</tr>
			<tr>
			    <td class="images"><img src="photo/007.png"></td>
				<td class="setsumei">
				    <font class="H">NO.007 英文門檻</font><br><br>
					<font class="T">啊都給你說就好啦╮(╯_╰)╭</font>
				</td>
			</tr>
			<tr>
			    <td class="images"><img src="photo/unKnowCard.png"></td>
				<td class="setsumei">
				    <font class="H">NO.008 ???</font><br><br>
					<font class="T">??????</font>
				</td>
			</tr>
			<tr>
			    <td class="images"><img src="photo/unKnowCard.png"></td>
				<td class="setsumei">
				    <font class="H">NO.009 ???</font><br><br>
					<font class="T">??????</font>
				</td>
			</tr>
		</table><br><hr><hr>
		
	    <!--Introduction of Stroes-->
	    <form method="post" action="webGameInfo.php">  
		    <font class="H">我的學校有哪些商品參加這次遊戲呢～？</font><br><br>
            <select name="school" id="storeIntro" style="height:30px; width:200px;" class="text">
				<!--Stroes-下拉式選單-->
				<?php
				    echo "<option value=0 class=\"text\">請選擇學校</option>";
					$mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");					
					$sql = "SELECT DISTINCT `school` FROM `items`";
					$result = $mysqli->query($sql);
					while($read = $result->fetch_array()){
					    $sel = $read[0];
						echo "<option value=$sel class=\"text\">$sel</option>";
					}
				?>		
			</select>	
			<input type="submit" value="Search" style="height:30px;" class="text">
		</form></center>
    <?php
	
	    // 表格開始
		echo "<center><table width=\"80%\"  rules=\"all\">";
			echo "<tr style=\"background-color:#58cc24;\">";
				echo "<th><font class=\"text\">商品</font></th>";
				echo "<th><font class=\"text\">店名</font></th>";
				echo "<th><font class=\"text\">學校</font></th>";
			echo "</tr>";
		
		// 判斷學校的POST請求，若無則印出全部		
		if(isset($_POST["school"])){
		    $school = $_POST["school"];
			if($school === "0"){
			    printAll();
			}else{
			    $mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");	
			$sql = "SELECT `school`, `store`, `merchandise` 
					FROM `items`
					WHERE `school` = ?";
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param('s',$school);
			$stmt->execute();
			$stmt->bind_result($school, $store, $merchandise);
				
			// 取得並印出資料
			while($stmt->fetch()){
				echo "<tr bgcolor=#ffd700>";
					echo("<td><font class=\"text\">$merchandise</font></td>");
					echo("<td><font class=\"text\">$store</font></td>");
					echo("<td><font class=\"text\">$school</font></td>");
				echo "</tr>";		
			}
			}
		}else{
            printAll();
		}
 		echo "</table></center><br><br><br><br><br><br><br><br><br><br><br><br><br><br><hr>";
		
		function printAll(){
		    $mysqli = new mysqli("localhost", "id3329834_j32u4ukh", "19931018", "id3329834_test");		
			$sql = "SELECT *
					FROM `items`";
			$result = $mysqli->query($sql);
			while($read = $result->fetch_array()){
				echo "<tr bgcolor=#ffd700>";			
					$merchandise = $read[3];	
					$store = $read[2];
					$school = $read[1];			
					echo("<td><font class=\"text\">$merchandise</font></td>");
					echo("<td><font class=\"text\">$store</font></td>");
					echo("<td><font class=\"text\">$school</font></td>");
				echo "</tr>";
			}
		}
	?>
	</body>
</html>