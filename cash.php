<?php
$money = isset($_GET['money']) ?  (float)$_GET['money'] : '';
$months = isset($_GET['months']) ?  (int)$_GET['months'] : 3;
$borrowRate = isset($_GET['borrowRate']) ?  (float)$_GET['borrowRate'] : '';
$lendRate = isset($_GET['lendRate']) ?  (float)$_GET['lendRate'] : '';

//月还款利息
$monthRepaymentInterestMoney = round(($money * $borrowRate / 100), 3);

//分期总利息
$repaymentInterestTotalMoney = round(($monthRepaymentInterestMoney * $months), 2);

//分期还款本金
$monthRepaymentPrincipalMoney = round(($money / $months),2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>现金借入用于p2p投资计算</title>
</head>
<style type="text/css">
	h1 {  font-size: 12px;  font-weight: normal  }
	body>div {  margin: 0 auto  }
	div {  text-align: left  }
	body {  color: #333;  text-align: center;  font: 12px "微软雅黑";  }
	ul, ol, li {  list-style-type: none;  vertical-align: 0  }
	a {  outline-style: none;  color: #535353;  text-decoration: none  }
	a:hover {  color: #D40000;  text-decoration: none  }
	.clear {  height: 0;  overflow: hidden;  clear: both  }
	.button {  display: inline-block;  zoom: 1;  *display: inline;  vertical-align: baseline;  margin: 0 2px;  outline: none;  cursor: pointer;  text-align: center;  text-decoration: none;  font: 14px/100% Arial, Helvetica, sans-serif;  padding: 0.25em 0.6em 0.3em;  text-shadow: 0 1px 1px rgba(0, 0, 0, .3);  -webkit-border-radius: .5em;  -moz-border-radius: .5em;  border-radius: .5em;  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .2);  -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .2);  box-shadow: 0 1px 2px rgba(0, 0, 0, .2);  }
	.kePublic {  padding: 5px 0;  }
	.keBottom {  color: #FFF;  padding-top: 25px;  line-height: 28px;  text-align: center;  font-family: '微软雅黑';  background: url(../images/bodyBg2.jpg) repeat-x top left;  padding-bottom: 25px  }
	.keTxtP {  font-size: 16px;  color: #ffffff;  }
	.keUrl {  color: #FFF;  font-size: 30px;  }
	.keUrl:hover {  text-decoration: underline;  color: #FFF;  }
	.mKeBanner, .mKeBanner div {  text-align: center;  }
	.keTitle {  height: 100px;  line-height: 100px;  font-size: 30px;  font-family: '微软雅黑';  color: #FFF;  text-align: center;  background-color: black;  font-weight: normal;  }
	.tipRed{  color:red;  }
	.inputParam {  margin: 15px 0 0px 20px;  position: relative;  font-size:13px;  }
	.inputParam input {  margin-right: 5px;  width: 85px;  }
	.inputParam select {  margin-right: 10px;  width: 52px;  }
	.chenkbox {  float: left;  margin: 10px 0 0 20px;  width: 40%;  position: relative;  }
	table {  width: 100%;  border-collapse: collapse;  border-spacing: 0;  table-layout: fixed;  background-color: #fff;  }
	th {  background: #ebf3f0;  font-size: 13px;  color: #000002;  height: 25px;  }
	th, td {  text-align: center;  border: 1px solid #dcdbdb;  padding: 8px 10px;  }
	.end {  text-align:left;  }
</style>

<body class="keBody">
	<h1 class="keTitle">现金借入用于p2p投资计算</h1>
<div class="kePublic">
	<div class="inputParam">
		现金借入金额：<input name="money" id="money" value="<?php echo $money;?>" />
		借入月费率：<input name="borrowRate" id="borrowRate" value="<?php echo $borrowRate;?>"  />%
		借出年费率：<input name="lendRate" id="lendRate" value="<?php echo $lendRate;?>" />%
		期数：<select name="months" id="months">
			<option value=3 <?php if($months == 3) echo 'selected';?>>3</option>
			<option value=6 <?php if($months == 6) echo 'selected';?>>6</option>
			<option value=12 <?php if($months == 12) echo 'selected';?>>12</option>
			<option value=18 <?php if($months == 18) echo 'selected';?>>18</option>
			<option value=24 <?php if($months == 24) echo 'selected';?>>24</option>
			<option value=36 <?php if($months == 36) echo 'selected';?>>36</option>
		</select>
		<button class="button" onclick="cashCount();">提交</button>
	</div>
	<div class="inputParam">
		<span class="tipRed">*</span> 1、不考虑现金分期投资p2p是否合法 2、不考虑p2p的风险 3、纯计算现金分期的利息
	</div>

	<div class="chenkbox">
		<table id="tableSort">
			<tr>
				<th colspan =4> 现金分期（本金/手续费平摊）</th>
			</tr>
			<tr>
				<td> 期数 </td>
				<td> 本金（￥）</td>
				<td> 当期利息相当于（￥）</td>
				<td> 当期费率相当于（%）</td>
			</tr>
			<?php
			for($i=1;$i<=$months;$i++){
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $monthRepaymentPrincipalMoney;?></td>
					<td><?php echo $monthRepaymentInterestMoney;?></td>
					<td><?php echo $borrowRate;?></td>
				</tr>
				<?php
			}
			?>
			<tr>
				<td> 小计 </td>
				<td> <?php echo $money;?> </td>
				<td> <?php echo $repaymentInterestTotalMoney;?> </td>
				<td>年费率 <?php echo $borrowRate*12;?> </td>
			</tr>
		</table>
	</div>

	<div class="chenkbox">
		<table id="tableSort">
			<tr>
				<th colspan =4> p2p投资（等额本息/到期返本）</th>
			</tr>
			<tr>
				<td> 期数 </td>
				<td> 本金（￥） </td>
				<td> 当期利息（￥） </td>
				<td> 利息年费率（%）</td>
			</tr>
			<?php
			$P2PInterestTotalMoney = 0;
			for($i=1;$i<=$months;$i++){
				$monthInterestMoney = round(($money * $lendRate /100 /12) , 2 );
				$P2PInterestTotalMoney += $monthInterestMoney;
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $money;?></td>
					<td><?php echo $monthInterestMoney;?></td>
					<td><?php echo $lendRate;?></td>
				</tr>
				<?php
			}
			?>
			<tr>
				<td> 小计 </td>
				<td> -- </td>
				<td> <?php echo $P2PInterestTotalMoney;?> </td>
				<td> -- </td>
			</tr>
		</table>
	</div>

	<div class="chenkbox">
		<table id="tableSort">
			<tr>
				<th colspan =4> 用现金分期的钱投资p2p（等额本息/到期返本）</th>
			</tr>
			<tr>
				<td> 期数 </td>
				<td> 本金（￥） </td>
				<td> 当期利息（￥） </td>
				<td> 利息年费率（%）</td>
			</tr>
			<?php
			$monthMoney = $money;
			$repaymentInterestTotalMoney2 = 0;
			for($i=1;$i<=$months;$i++){
				if($i>1) $monthMoney -= $monthRepaymentPrincipalMoney;
				$monthRepaymentInterestMoney2 = round(($monthMoney * $lendRate /100 /12) , 2 );
				$repaymentInterestTotalMoney2 += $monthRepaymentInterestMoney2;
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $monthMoney;?></td>
					<td><?php echo $monthRepaymentInterestMoney2;?></td>
					<td><?php echo $lendRate;?></td>
				</tr>
				<?php
			}
			?>
			<tr>
				<td> 小计 </td>
				<td> --</td>
				<td> <?php echo $repaymentInterestTotalMoney2;?> </td>
				<td> -- </td>
			</tr>
		</table>
	</div>

	<div class="chenkbox">
		<table id="tableSort">
			<tr>
				<th colspan =4> p2p分期投资（等额本息/到期返本）</th>
			</tr>
			<tr>
				<td> 期数 </td>
				<td> 本金（￥） </td>
				<td> 当期利息（￥） </td>
				<td> 利息年费率（%）</td>
			</tr>
			<?php
			$monthMoney = 0;
			$repaymentInterestTotalMoney3 = 0;
			for($i=1;$i<=$months;$i++){
				if($i>1) $monthMoney += $monthRepaymentPrincipalMoney;
				$monthRepaymentInterestMoney3 = round(($monthMoney * $lendRate /100 /12) , 2 );
				$repaymentInterestTotalMoney3 += $monthRepaymentInterestMoney3;
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $monthMoney;?></td>
					<td><?php echo $monthRepaymentInterestMoney3;?></td>
					<td><?php echo $lendRate;?></td>
				</tr>
				<?php
			}
			?>
			<tr>
				<td> 小计 </td>
				<td> --</td>
				<td> <?php echo $repaymentInterestTotalMoney3;?> </td>
				<td> -- </td>
			</tr>
		</table>
	</div>

	<div class="chenkbox">
		<table class="end">
			<tr>
				<td colspan =4 >
					p2p投资收益：<?php echo $P2PInterestTotalMoney;?>&nbsp;&nbsp;&nbsp;

					现金分期手续费： <?php echo $repaymentInterestTotalMoney;?>&nbsp;&nbsp;

					p2p分期投资收益： <?php echo $repaymentInterestTotalMoney3;?>&nbsp;&nbsp;<br>

					现金分期投资p2p比p2p分期投资多收益（p2p投资收益 - 现金分期手续费 - p2p分期投资收益）：
					<?php echo $P2PInterestTotalMoney - $repaymentInterestTotalMoney - $repaymentInterestTotalMoney3; ?>
				</td>
			</tr>
		</table>
	</div>
</div>

<script>
	function cashCount(){
		var money = document.getElementById("money").value;
		var months = document.getElementById("months").value;
		var borrowRate = document.getElementById("borrowRate").value;
		var lendRate = document.getElementById("lendRate").value;
		if(isNaN(money) || isNaN(borrowRate) || isNaN(lendRate) ||isNaN(months)) {
			alert('现金金额输入错误');
			return false;
		}
		location.href="/cash.php?money="+money+"&months="+months+"&borrowRate="+borrowRate+"&lendRate="+lendRate;
	}
</script>
</body></html>