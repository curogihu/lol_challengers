<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IngestedMatch;

class DetailedMatchInfoController extends Controller
{
	public function import() {

    	// あとでURLを別ファイルから読み込むようにする
    	$url = "https://na1.api.riotgames.com/lol/league/v3/challengerleagues/by-queue/RANKED_SOLO_5x5?api_key=" . env("RIOT_GAMES_API_KEY");
		$json = file_get_contents($url);
		$arr = json_decode($json,TRUE);

		if ($arr === NULL) {
		    return;

		}else{
			Champion::truncate();

		    foreach($arr['data'] as $key => $target_champion) {
		    	$champion = new Champion();

				$champion->id = $target_champion["id"];
				$champion->key = $target_champion["key"] ;
				$champion->name = $target_champion["name"];
				$champion->image_name = $target_champion["image"]["full"];

				$champion->save();
		    }
		}

		// return env("RIOT_GAMES_API_KEY");
	}
}
