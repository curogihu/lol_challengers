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
    }
}
