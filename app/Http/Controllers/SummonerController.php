<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Summoner;
use App\Account;

class SummonerController extends Controller
{
    public function import() {
    	// return 111;
    	$url = "https://na1.api.riotgames.com/lol/league/v3/challengerleagues/by-queue/RANKED_SOLO_5x5?api_key=" . env("RIOT_GAMES_API_KEY");
		$json = file_get_contents($url);
		$arr = json_decode($json,TRUE);

		if ($arr === NULL) {
		    return;

		}else{
			// return var_dump($arr);

			Summoner::truncate();

		    foreach($arr['entries'] as $key => $target_summoner) {
		    	$summoner = new Summoner();

				$summoner->summoner_id = $target_summoner["playerOrTeamId"];
				$summoner->save();
		    }

		    return "finished";
		}
    }

    public function accountImport() {
    	// return var_dump(Summoner::all());

    	$summoners = Summoner::all();
    	$base_url = "https://na1.api.riotgames.com/lol/summoner/v3/summoners/[summoner_id]?api_key=". env("RIOT_GAMES_API_KEY");

    	$cnt = 0;
    	Account::truncate();

    	foreach($summoners as $summoner) {
    		// echo($summoner->summoner_id);
    		// echo("<br>");

    		$json = file_get_contents(str_replace("[summoner_id]", $summoner->summoner_id, $base_url));
			$arr = json_decode($json,TRUE);

			$account = new Account;
			$account->account_id = $arr["accountId"];
			$account->save();

			$cnt += 1;
			// Log::info($cnt . ", Finished summoner id:" . $summoner->summoner_id);
			sleep(3);
    	}

    	return;
    }
}
