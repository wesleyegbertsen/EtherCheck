<?php

const ETHERSCAN_APIKEY = 'REPLACE_WITH_API_KEY';
const ETHERSCAN_APIURL = 'https://api.etherscan.io/api';
const POLONIEX_APIURL = 'https://poloniex.com/public?command=returnTicker';
const FIXER_APIURL = 'https://api.fixer.io/latest?base=USD&symbols=EUR';

header('Content-Type: application/json');

if (isset($_GET['address'])) {

	$etherScanApiBalanceUrl = ETHERSCAN_APIURL . '?module=account&action=balance&address=' . $_GET['address'] . '&tag=latest&apikey=' . ETHERSCAN_APIKEY;

	$etherScanJson = file_get_contents($etherScanApiBalanceUrl);
	$etherScanObj = json_decode($etherScanJson);

	$etherBalance = $etherScanObj->result / 1000000000000000000;
	
	$poloniexJson = file_get_contents(POLONIEX_APIURL);
	$poloniexObj = json_decode($poloniexJson);
	$etherDollarValue = $poloniexObj->USDT_ETH->last * $etherBalance;
	
	$fixerJson = file_get_contents(FIXER_APIURL);
	$fixerObj = json_decode($fixerJson);
	$dollarEuroValue = $etherDollarValue * $fixerObj->rates->EUR;
	
	$returnData = [
		'ether' =>
		[
			'balance' => $etherBalance,
			'value' => 
			[
				'euro' => 
				[
					'balance' => round($dollarEuroValue, 2),
					'rate' => round($poloniexObj->USDT_ETH->last * $fixerObj->rates->EUR, 2)
				],
				'dollar' =>
				[
					'balance' => round($etherDollarValue, 2),
					'rate' => round($poloniexObj->USDT_ETH->last, 2)
				]
			]
		]
	];
} else {
	$returnData = [ 'error' => 'Missing GET parameter: \'address\''];
}

echo json_encode($returnData);

?>
