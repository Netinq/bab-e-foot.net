<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Goal;
use App\Models\Stat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $uuid = Auth::id();
        $user = User::where('id', $uuid)->first();
        $stat = Stat::where('player_id', $uuid)->first();
        $qr = QrCode::size(500)->generate(route('qr', $uuid));

        $games = Game::where('player_1', $uuid)->orWhere('player_2', $uuid)->get();
        foreach ($games as $game) {
            $player_1 = $game->player_1;
            $player_2 = $game->player_2;
            $game->goals = Goal::where('game_id', $game->id)->where('player_id', $uuid)->count();
            if ($player_1 == $uuid) $enemy_goals = Goal::where('game_id', $game->id)->where('player_id', $player_2)->count();
            else $enemy_goals = Goal::where('game_id', $game->id)->where('player_id', $player_1)->count();
            if ($player_1 == $uuid) $game->enemy_name = User::where('id', $player_2)->first()->username;
            else $enemy_goals = $game->enemy_name = User::where('id', $player_1)->first()->username;
            $game->win = $game->goals > $enemy_goals ? true : false;
        }

        return view('profil.index', compact('qr', 'user', 'stat', 'games'));
    }
}
