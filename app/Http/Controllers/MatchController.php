<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Match;

class MatchController extends Controller
{

	
    public function import() {
    	$accounts = Account::all();

    	echo(var_dump($accounts));

    	return;
/*
    	$base_url = "https://na1.api.riotgames.com/lol/match/v3/matchlists/by-account/[account_id]?endIndex=49&api_key=" . env("RIOT_GAMES_API_KEY");

    	$cnt = 0;
    	$match_cnt = 0;

    	foreach($accounts as $account) {

    		echo(str_replace("[account_id]", $account->account_id, $base_url);
    		break;

    		$json = file_get_contents(str_replace("[account_id]", $account->account_id, $base_url));
			$arr = json_decode($json,TRUE);

			foreach($arr["matches"] as $match) {
				$match = new Match;

				$match->gameId = $match["gameId"];
				$match->champion = $match["champion"];
				$match->queue = $match["queue"];
				$match->season = $match["season"];
				$match->timestamp = $match["timestamp"];
				$match->role = $match["role"];
				$match->lane = $match["lane"];

				$match->save();

				$match_cnt += 1;
				Log::info($match_cnt . ", Finished account id:" . $match["gameId"]);

			}

			$cnt += 1;
			Log::info($cnt . ", Finished account id:" . $account->account_id);
			sleep(3);


    		break;
    	}

    	return;
/*
    	$base_url = "https://na1.api.riotgames.com/lol/match/v3/matchlists/by-account/[account_id]?endIndex=49&api_key=" . env("RIOT_GAMES_API_KEY");


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
*/
    }
}
