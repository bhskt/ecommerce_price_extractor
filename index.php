<?php
require "get_price.php";

$list=[
	[
		"site"=>"Flipkart",
		"url"=>"http://www.flipkart.com/nokia-lumia-630-dual-sim/p/itmeyfptbgf9gv6s",
	],
	[
		"site"=>"ShopClues",
		"url"=>"http://www.shopclues.com/nokia-lumia-630-dual-sim-2.html"
	],
	[
		"site"=>"Amazon.in",
		"url"=>"http://www.amazon.in/Nokia-Lumia-630-Black-Dual/dp/B00KD8B6GG"
	],
	[
		"site"=>"SnapDeal",
		"url"=>"http://www.snapdeal.com/product/nokia-lumia-630-dual-sim/1457636194"
	]
];

foreach($list as $item){
	echo "Site : ".$item["site"]." URL : ".$item["url"]." Price : ".getPrice($item["url"])."\n";
}
?>
