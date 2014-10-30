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
		"site"=>"SnapDeal",
		"url"=>"http://www.snapdeal.com/product/nokia-lumia-630-dual-sim/1457636194"
	],
	[
		"site"=>"Flipkart (Mobile Site)",
		"url"=>"http://m.flipkart.com/nokia-lumia-630-dual-sim/p/itmeyfptbgf9gv6s?pid=MOBDW52BHNVSGFFS",
	],
	[
		"site"=>"SnapDeal (Mobile Site)",
		"url"=>"http://m.snapdeal.com/product/nokia-lumia-630-dual-sim/1457636194"
	]
];

foreach($list as $item){
	echo "Site : ".$item["site"]." URL : ".$item["url"]." Price : ".getPrice($item["url"])."\n";
}
?>
