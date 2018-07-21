<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    public function import() {
    	// あとでURLを別ファイルから読み込むようにする
    	$url = "http://ddragon.leagueoflegends.com/cdn/6.24.1/data/ja_JP/item.json";
		$json = file_get_contents($url);
		$arr = json_decode($json,TRUE);

		if ($arr === NULL) {
		    return;

		}else{
			Item::truncate();

		    foreach($arr['data'] as $key => $target_item) {
		    	$item = new Item();

				$item->id = $key;
				$item->name = $target_item["name"] ;
				$item->price = $target_item["gold"]["total"];
				$item->image_name = $target_item["image"]["full"];

				$item->save();
		    }
		}
	}
}
