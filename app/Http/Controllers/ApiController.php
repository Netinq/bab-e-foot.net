<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Goal;
use App\Models\Stat;
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
        $game->playtime = $data['playtime'];
        $game->save();

        foreach ($data['player_1']['goals'] as $key) {
            $goal = new Goal();
            $goal->player_id = $player1->id;
            $goal->game_id = $game->id;
            $goal->goat_at = $key;
            $goal->save();
        }
        foreach ($data['player_2']['goals'] as $key) {
            $goal = new Goal();
            $goal->player_id = $player1->id;
            $goal->game_id = $game->id;
            $goal->goat_at = $key;
            $goal->save();
        }

        $this->stat($player1, $data, 'player_1');
        $this->stat($player2,$data, 'player_2');
    }

    private function stat($player, $data, $player_string)
    {
        $stat = Stat::where('player_id', $player->id)->first();
        $stat = $stat != null ? $stat : new Stat();
        $stat->player_id = $player->id;
        $stat->playtime = $stat->playtime == null ? $data['playtime'] : $stat->playtime + $data['playtime'];
        $stat->goals = $stat->goals == null ? $data[$player_string]['total_goals']  : $stat->goals + $data[$player_string]['total_goals'];
        $stat->points = ($data[$player_string]['total_goals']*2) + ($data['playtime']*1.5);
        $stat->party_played = $stat->party_played == null ? 1 : $stat->party_played + 1;
        if (Game::where($player_string, $player->id)
            ->orWhere('player_2', $player->id)
            ->where('place_id', $data['place_id'])->count() <= 1) {
            $stat->places_visited = $stat->places_visited == null ? 1 : $stat->places_visited + 1;
        }
        $stat->save();
    }
}
