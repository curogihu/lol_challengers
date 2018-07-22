<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Match;

class MatchController extends Controller
{


    public function import() {
    	$accounts = Account::all();

    	// echo(var_dump($accounts));
		$cnt = 0;
    	$match_cnt = 0;

    	$base_url = "https://na1.api.riotgames.com/lol/match/v3/matchlists/by-account/[account_id]?endIndex=49&api_key=" . env("RIOT_GAMES_API_KEY");


    	foreach($accounts as $account) {
    		// echo($account->account_id);
    		$json = file_get_contents(str_replace("[account_id]", $account->account_id, $base_url));
			$arr = json_decode($json,TRUE);

			// echo(var_dump($arr["matches"][0]));

			foreach($arr["matches"] as $target_match) {
				$match = new Match;

				$match->gameId = $target_match["gameId"];
				$match->champion = $target_match["champion"];
				$match->queue = $target_match["queue"];
				$match->season = $target_match["season"];
				$match->timestamp = $target_match["timestamp"];
				$match->role = $target_match["role"];
				$match->lane = $target_match["lane"];

				$match->save();
			}

			sleep(3);
    	}

    	return;
    }
}
