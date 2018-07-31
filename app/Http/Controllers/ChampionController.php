<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Champion;
use DB;

class ChampionController extends Controller
{
    public function import() {
    	// あとでURLを別ファイルから読み込むようにする
    	$url = "http://ddragon.leagueoflegends.com/cdn/6.24.1/data/ja_JP/champion.json";
		$json = file_get_contents($url);
		$arr = json_decode($json,TRUE);

		if ($arr === NULL) {
		    return;

		}else{
			Champion::truncate();

		    foreach($arr['data'] as $key => $target_champion) {
		    	$champion = new Champion();

				$champion->id = mb_strtolower($target_champion["id"]);
				$champion->key = $target_champion["key"];
				$champion->name = $target_champion["name"];
				$champion->image_name = $target_champion["image"]["full"];

				$champion->save();
		    }
		}
	}

    public function show() {
    	// $champions = Champion::all();

    	// $champions = Champion::orderBy('name')->get();

    	$champions = DB::table('champions')
    				->join('available_champions', 'champions.key', '=', 'available_champions.champion_id')
    				->select('champions.*')
    				->orderby('champions.name')
    				->get();

    	return view('index', compact('champions'));
    }
}
