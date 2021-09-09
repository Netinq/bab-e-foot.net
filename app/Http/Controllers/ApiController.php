<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function data(Request $request)
    {
        $data = request()->json()->all();
        $player1 = User::where('id', $data['player_1']['uuid'])->first();
        $player2 = User::where('id', $data['player_2']['uuid'])->first();
        $game = new Game();
        $game->player_1 = $player1->id;
        $game->player_2 = $player2->id;
        $game->place_id = $data['place_id'];
        $game->save();
    }
}
