
<html>
    <head>
	    <title>Ghost Island 2</title>
		<meta charset="utf-8">
		<style type="text/css">
			body{
			    background-color:#3abefa;
			}
		    table{
			    width:100%;
				height:100%;
				border:5px groove #AAF78C;
			}
			th, td{
			    border:5px groove #33FA8C;
			}
			th a{
			    display: block;
			}
		    .navigation{
			    background-color:#55FF55;
				margin:10px 10px 10px 10px;
			}
			#myFrame{
			    width:100%;
				height:100%;
				background-color:#3abefa;
			}
			.NavigationWord{
			    font-size:0.618cm;
			}
		</style>
	</head>
	<body>
	    <table>
		    <tr height="90%">
			    <td colspan="4">
				<?php
					if(isset($_COOKIE['member'])){
						$SRC = "webBook.php";
					}else{
						$SRC = "webGameInfo.php";
					}
					$myFrame = "myFrame";
					echo "<iframe name=$myFrame id=$myFrame src=$SRC>";
		                echo "很抱歉，您的瀏覽器不支援浮動框架，所以無法顯示此框架的內容！";
                    echo "</iframe>";
				?>
				</td>
			</tr>
		    <tr height="10%">
			    <th class="navigation">
				    <a href="webGameInfo.php" target="myFrame"><font class="NavigationWord">遊 戲 介 紹</font></a>
				</th>
				<th class="navigation">
				    <a href="webBook.php" target="myFrame"><font class="NavigationWord">集 卡 簿</font></a>
				</th>
				<th class="navigation">
				    <a href="webTask.html" target="myFrame"><font class="NavigationWord">任 務</font></a>
				</th>
				<th class="navigation">
				    <a href="webRegister.php" target="myFrame"><font class="NavigationWord">註 冊 / 登 入</font></a>
				</th>
			</tr>
		</table>
	</body>
</html>