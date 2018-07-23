<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Match;
use App\MatchInfo;
use App\Timeline;

class MatchInfoController extends Controller
{
    public function importMatchInfo() {
    	$matches = Match::all();

    	// echo(var_dump($accounts));
		$cnt = 0;
    	$match_cnt = 0;


    	$base_url = "https://na1.api.riotgames.com/lol/match/v3/matches/[game_id]?api_key=" . env("RIOT_GAMES_API_KEY");

    	// $team_info = array(100 => "", 200 => "");

    	foreach($matches as $target_match) {
    		$json = file_get_contents(str_replace("[game_id]", $target_match->gameId, $base_url));
			$arr = json_decode($json,TRUE);

			foreach($arr["teams"] as $team) {
				$team_info[$team["teamId"]] = $team["win"];
			}

			foreach($arr["participantIdentities"] as $participantIdenty) {
				$personal_info[$participantIdenty["participantId"]] = $participantIdenty["player"];
			}

			foreach($arr["participants"] as $participant) {
				$match_info = new MatchInfo;

				$match_info->gameId = $target_match->gameId;
				$match_info->participantId = $participant["participantId"];
				$match_info->championId = $participant["championId"];

				if($participant["spell1Id"] < $participant["spell2Id"]) {
					$match_info->spell1Id = $participant["spell1Id"];
					$match_info->spell2Id = $participant["spell2Id"];

				} else {
					$match_info->spell1Id = $participant["spell2Id"];
					$match_info->spell2Id = $participant["spell1Id"];
				}

				$match_info->role = $participant["timeline"]["role"];
				$match_info->lane = $participant["timeline"]["lane"];

				// 元々のAPIに設定されていない場合あり。
				// summonerIdの場合は、存在すらもないケースあり、条件分岐必要
				$match_info->accountId = $personal_info[$participant["participantId"]]["accountId"];
				$match_info->currentAccountId = $personal_info[$participant["participantId"]]["currentAccountId"];
				$match_info->summonerId = $personal_info[$participant["participantId"]]["summonerId"];
				$match_info->winFlag = $team_info[$participant["teamId"]];

				$match_info->save();
			}

			sleep(3);
    	}

    	return;
    }

    public function importMatchTimeline() {
    	$matches = Match::all();

    	// echo(var_dump($accounts));
		$cnt = 0;
    	$match_cnt = 0;


    	$base_url = "https://na1.api.riotgames.com/lol/match/v3/timelines/by-match/[game_id]?api_key=" . env("RIOT_GAMES_API_KEY");

    	// $team_info = array(100 => "", 200 => "");

    	// 長時間かかるので、実行時間の制限はなし
    	set_time_limit(0);

    	foreach($matches as $target_match) {
    		$json = file_get_contents(str_replace("[game_id]", $target_match->gameId, $base_url));
			$arr = json_decode($json,TRUE);

			foreach($arr["frames"] as $frame) {
				if(empty($frame["events"])) {
					continue;
				}

				foreach($frame["events"] as $event) {
					switch($event["type"]) {

						case "WARD_PLACED":
							$timeline = new Timeline;

							$timeline->gameId = $target_match->gameId;
							$timeline->type = $event["type"];
							$timeline->wardType = $event["wardType"];
							$timeline->participantId = $event["creatorId"];
							$timeline->timpstamp = $event["timestamp"];

							$timeline->save();
							break;

						case "ITEM_PURCHASED":
							$timeline = new Timeline;

							$timeline->gameId = $target_match->gameId;
							$timeline->type = $event["type"];
							$timeline->itemId	 = $event["itemId"];
							$timeline->participantId = $event["participantId"];
							$timeline->timpstamp = $event["timestamp"];

							$timeline->save();
							break;
					}
				}
    		}

    		sleep(3);
    	}

    	return;
    }
}
