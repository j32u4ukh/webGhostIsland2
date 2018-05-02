<?php
	if(isset($_GET['number'])){
		if($_GET['number'] == "1001"){
			$number = "card" . $_GET['number'];
			echo "<center><br><br>
				<table>
					<tr>
						<td><img src=\"photo/$number.png\"></td>
					</tr>
					<tr>
						<td><form method=\"post\" action=\"webTargets1001.php\">
							<center><input type=\"submit\" value=\"攻擊\" style=\"width:180px; height:60px; font-size:30px;\"></center>
						</form></td>
					</tr>
				</table>";
		}elseif($_GET['number'] == "1002"){
			$number = "card" . $_GET['number'];
			echo "<center><br><br>
				<table>
					<tr>
						<td><img src=\"photo/$number.png\"></td>
					</tr>
					<tr>
						<td><form method=\"post\" action=\"webTargets1002.php\">
							<center><input type=\"submit\" value=\"攻擊\" style=\"width:180px; height:60px; font-size:30px;\"></center>
						</form></td>
					</tr>
				</table>";
		}else{
			$number = "card" . $_GET['number'];
			echo "<center><br><br>";
			echo "<img src=\"photo/$number.png\">";
		}
	}
?>