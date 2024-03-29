<?php

namespace App\Http\Controllers;

use App\Mail\Looser;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use App\Models\AskGame;
use App\Models\Teammember;
use App\Models\Winning;
use App\Models\Defeat;
use App\Models\draw;
use stdClass;
use App\Models\TeamRate;
use App\Models\PostTable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SqlRAws;

class Teams extends Controller
{
    public function add_teams(Request $request)
    {
        // return json_encode($request->token);
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        $checkname =  Team::where('team_name', "=", $request->team_name)->count();
        $checksport =  Team::where('sport_name', "=", $request->sport_name)
            ->where('email', "=", User::where('remember_token', "=", $request->token)->value('email'))
            ->count();

        $checksum =  Team::where('email', "=",  User::where('remember_token', "=", $request->token)->value("email"))->count();

        $email =  User::where('remember_token', "=", $request->token)->select('email')->get();
        $teamMemebersCheck = Teammember::where('who_want_to_join', "=", $email[0]->email)->where('status', "!=", "declined")->where('status', "!=", "exit")->select("team_to_join")->get();
        $tableOfTeamcheck = [];
        foreach ($teamMemebersCheck  as $value) {
            array_push($tableOfTeamcheck, $value->team_to_join);
        }
        $checkSportIntegrated = Team::whereIn('team_name', $tableOfTeamcheck)->where('sport_name', "=", $request->sport_name)->select('sport_name')->count();
        if ($checkfirst > 0) {

            if ($checksum < 6) {
                if ($checkname == 0 &&  $checksport == 0 && $checkSportIntegrated == 0) {
                    $mail = User::where('remember_token', "=", $request->token)->value("email");
                    $team = new Team();
                    $team->email = $mail;
                    $team->team_name = $request->team_name;
                    $team->sport_name = $request->sport_name;
                    $team->logo = $request->logo;
                    $team->cover = $request->cover;
                    $team->city = $request->city;
                    $team->save();
                    return json_encode('good');
                }

                if ($checkname > 0) {
                    return   json_encode("Ce nom d'équipe a déja été choisir. Veuillez selectionner un autre nom.");
                }

                if ($checksport  > 0) {
                    return json_encode("Vous avez deja crée une equipe avec ce sport. Veuillez-en choisir un autre.");
                }
                if ($checkSportIntegrated > 0) {
                    return json_encode("Vous avez déjà rejoint une équipe avec le sport: "
                        . $request->sport_name .
                        ". Impossible d'être dans deux équipes du même sport.");
                }
            } else {
                return json_encode("Vous pouvez ajouter que six équipes maximum.");
            }
        }
        return json_encode('Vous devez vous reconnecter.');
        // return   $request->file('logo')->store('public/teams_photos');;
    }

    public function getTeams(Request $request) // getConnected user Teams
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();

        if ($checkfirst > 0) {
            return Team::where('email', "=",  User::where('remember_token', "=", $request->token)->value('email'))->get();
        }
        return 'Vous devez vous reconnecter.';
    }

    public function getTeams__(Request $request) // getConnected profil opened team
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            return Team::where('email', "=",  $request->email)->get();
        }
        return 'Vous devez vous reconnecter.';
    }

    public function deleteTeam(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            return Team::where('email', "=",  User::where('remember_token', "=", $request->token)->value('email'))
                ->where('id', '=', $request->id)
                ->delete();
        }
        return 'Vous devez cous reconnecter.';
    }
    public function updatewithfiles()
    {
    }
    public function updatewithoutfiles(Request $request)
    {
        $checkname =  Team::where('team_name', "=", $request->team_name)->count();


        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        //return  $checkfirst;
        if ($checkfirst > 0) {
            if ($checkname == 0) {
                Team::where('email', "=",  User::where('remember_token', "=", $request->token)->value('email'))
                    ->where('id', '=', $request->id)->update(
                        [
                            'team_name' => $request->team_name,
                            'city' => $request->city
                        ]
                    );
                return "added";
            }

            if ($checkname > 0) {
                return "Ce nom d'équipe a déja été choisir. Veuillez selectionner un autre nom.";
            }
        }
        return 'Vous devez vous reconnecter.';
    }

    public function update_team_cover_image(Request $request)
    {
        $checkfirs =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirs > 0) {
            $image = $request->cover;
            // $image = $request->file('image')->store('public/profils_photos');
            Team::where('email', "=", User::where('remember_token', "=", $request->token)->value("email"))
                ->where("id", "=", $request->id)
                ->update([
                    "cover" =>   $image
                ]);
            return json_encode("updated");
        }

        return json_encode("'not added connection problem");
    }
    public function update_team_logo_image(Request $request)
    {
        $checkfirs =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirs > 0) {
            $image = $request->logo;
            // $image = $request->file('image')->store('public/profils_photos');
            Team::where('email', "=", User::where('remember_token', "=", $request->token)->value("email"))
                ->where("id", "=", $request->id)
                ->update([
                    "logo" =>   $image
                ]);
            return   json_encode("updated");
        }

        return json_encode("not added connection problem");
    }

    public function insertjson(Request $request)
    {
        // return json_decode($request->json);
        return $request->json;
    }



    public function checkTeamJoinedStatus(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $mail = User::where('remember_token', "=", $request->token)->value("email");
            return Teammember::where('who_want_to_join', '=', $mail)
                ->where('team_to_join_owner', '=',  $request->team_to_join_owner)
                ->where('team_to_join', '=',  $request->team_to_join)
                ->select('status')->get();
        }
        return 'Vous devez vous reconnecter.';
    }
    public function getteammembers(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $mail = User::where('remember_token', "=", $request->token)->value("email");
            return Teammember::where('teammembers.team_to_join_owner', '=',  $mail)
                ->where('teammembers.status', '=',  "pending")
                ->join('users__profile__photos', 'teammembers.who_want_to_join', '=', 'users__profile__photos.email')
                ->join('users', "teammembers.who_want_to_join", '=', 'users.email')
                ->join('notifications', "teammembers.notifications_id", '=', "notifications.id")
                ->where('notifications.notification_actions', '=',  'integration_actions')
                ->select([
                    "users__profile__photos.image", 'users.lastname', 'users.name', "teammembers.id", 'notifications.message', 'teammembers.status',
                    "teammembers.team_to_join", "teammembers.who_want_to_join"
                ])
                ->orderBy("id", 'desc')->get()->unique();
        }
        return 'Vous devez vous reconnecter.';
    }

    public function acceptemembers(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            Teammember::where("id", "=", $request->id)->update(["status" => "accepeted"]);
            return $request->id;
        }
        return 'Vous devez vous reconnecter.';
    }
    public function declinedmembers(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            Teammember::where("id", "=", $request->id)->update(["status" => "declined"]);
            return $request->id;
        }
        return 'Vous devez vous reconnecter.';
    }
    public function getTeamIntegrated(Request $request)
    {

        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        $mail =  User::where('remember_token', "=", $request->token)->value('email');
        if ($checkfirst > 0) {
            return Teammember::where('teammembers.who_want_to_join', '=',  $mail)
                //  ->where('teammembers.status', '=',  "pending")
                ->Where('teammembers.status', '=',  "accepeted")
                ->join('teams', "teammembers.team_to_join", '=', "teams.team_name")
                ->get()->unique();
        }
        return 'Vous devez vous reconnecter.';
    }
    public function joinATeam(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=",  trim($request->token))->count();
        if ($checkfirst > 0) {
            $getSport = Team::where('team_name', "=", $request->team_to_join)->select('sport_name')->get();
            $getemail =  User::where('remember_token', "=", $request->token)->select('email')->get();
            $countTeam = Team::where('email', "=",  $getemail[0]->email)->where('sport_name', "=", $getSport[0]->sport_name)->count();


            $teamMemebersCheck = Teammember::where('who_want_to_join', "=", $getemail[0]->email)->where('status', "!=", "declined")->where('status', "!=", "exit")->select("team_to_join")->get();
            $tableOfTeamcheck = [];
            foreach ($teamMemebersCheck  as $value) {
                array_push($tableOfTeamcheck, $value->team_to_join);
            }
            $checkSportIntegrated = Team::whereIn('team_name', $tableOfTeamcheck)->where('sport_name', "=",  $getSport[0]->sport_name)->select('sport_name')->count();


            if ($countTeam == 0 && $checkSportIntegrated == 0) {
                $mail = User::where('remember_token', "=",  trim($request->token))->value("email");
                $team = new Teammember();
                $team->team_to_join    =  trim($request->team_to_join);
                $team->who_want_to_join   = $mail;
                $team->team_to_join_owner    =  trim($request->team_to_join_owner);
                $team->notifications_id     =  trim($request->id);
                $team->save();
                return ['good', $team->id];
            }
            if ($checkSportIntegrated > 0) {
                return json_encode("Vous avez déjà rejoint une équipe avec le sport: "
                    . $getSport[0]->sport_name .
                    ". Impossible d'être dans deux équipes du même sport.");
            }
            if ($countTeam > 0) {
                return 'Vous avez déja créé une équipe du même sport que l\'équipe que vous souhaitez rejoindre.';
            }
        }
        return 'Vous devez vous reconnecter.';
    }

    // public function updateTeamNotifID(Request $request)
    // {
    //     ////////////
    // }


    public function askeforgame(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $mail = User::where('remember_token', "=", $request->token)->value("email");
            $checkifasked = AskGame::where('who_is_asking', "=", $mail)->where('who_was_asked', "=", $request->who_was_asked)
                ->where('team_of_asker', '=', $request->team_of_asker)
                ->where('team_of_who_was_asked', '=',  $request->team_of_who_was_asked)
                ->where('status', '=',  'pending')
                ->orWhere('status', '=',  'accepted')
                ->count(); // finish refused;

            $checkifasked_2 = AskGame::where('who_is_asking', "=", $request->who_was_asked)->where('who_was_asked', "=", $mail)
                ->where('team_of_asker', '=', $request->team_of_who_was_asked)
                ->where('team_of_who_was_asked', '=', $request->team_of_asker)
                ->where('status', '=',  'pending')
                ->orWhere('status', '=',  'accepted')
                ->count(); // finish refused;
            if ($checkifasked > 0) {
                return 'Vous avez déjà une demande de match en cours avec cette équipe.';
            } else if ($checkifasked_2 > 0) {
                return 'Vous avez déjà une demande de match en cours avec cette équipe.';
            } else {
                $team = new AskGame();
                $team->who_is_asking  = $mail;
                $team->who_was_asked  = $request->who_was_asked;
                $team->date_of_game     = $request->date_of_game;
                $team->hours_of_game  = $request->hours_of_game;
                $team->place_of_game  = $request->place_of_game;
                $team->team_of_asker   = $request->team_of_asker;
                $team->team_of_who_was_asked    = $request->team_of_who_was_asked;
                $team->save();
                return 'good';
            }
        }
        return 'Vous devez vous reconnecter.';
    }
    public function getAskGames(Request $request)
    {

        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        $mail =  User::where('remember_token', "=", $request->token)->value('email');
        if ($checkfirst > 0) {
            if ($request->status != "finish") {
                if ($request->status == "pending-score") {
                    $gameAsk = AskGame::where('ask_games.who_was_asked', '=',  $mail)
                        ->join('winnings', 'ask_games.id', '=', 'winnings.game_id')
                        ->where('ask_games.status', '=',  $request->status)
                        ->select([
                            "date_of_game", "hours_of_game", "place_of_game", "team_of_asker", "ask_games.id", "who_is_asking",
                            "who_was_asked", "ask_games.status", "team_of_who_was_asked", "winner_team", "winnings.score", "winnings.score_2"
                        ])
                        ->skip($request->page)->take(10)
                        ->get()->unique();

                    if (count($gameAsk) == 0) {
                        $gameAsk = AskGame::where('ask_games.who_was_asked', '=',  $mail)
                            ->join('draws', 'ask_games.id', '=', 'draws.game_id')
                            ->where('ask_games.status', '=',  $request->status)
                            ->select([
                                "date_of_game", "hours_of_game", "place_of_game", "team_of_asker", "ask_games.id", "who_is_asking",
                                "who_was_asked", "ask_games.status", "team_of_who_was_asked", "draws.team", "draws.score",
                            ])
                            ->skip($request->page)->take(10)
                            ->get()->unique();
                    }
                } else {
                    $gameAsk = AskGame::where('ask_games.who_was_asked', '=',  $mail)
                        ->where('ask_games.status', '=',  $request->status)
                        ->select(["date_of_game", "hours_of_game", "place_of_game", "team_of_asker", "id", "who_is_asking", "who_was_asked", "status", "team_of_who_was_asked"])
                        ->skip($request->page)->take(10)
                        ->get()->unique();
                }
                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->sport_name =  Team::where('team_name', "=", $gameAsk[$i]->team_of_who_was_asked)->select('sport_name')->get();
                }
                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->victory_count =  Winning::where('winner_team', "=", $gameAsk[$i]->team_of_asker)->where("status", "=", "accepted")->count();
                }
                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->draw_count =  draw::where('team', "=", $gameAsk[$i]->team_of_asker)->where("status", "=", "accepted")->count();
                }
                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->defeats_count =  Defeat::where('looser_team', "=", $gameAsk[$i]->team_of_asker)->where("status", "=", "accepted")->count();
                }

                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->team_of_asker_logo =  Team::where('team_name', "=", $gameAsk[$i]->team_of_asker)->select('logo')->get();
                }
                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->team_of_who_was_asked_logo =  Team::where('team_name', "=", $gameAsk[$i]->team_of_who_was_asked)->select('logo')->get();
                }

                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->members =  Teammember::where('team_to_join_owner', "=", $gameAsk[$i]->who_is_asking)
                        ->where('team_to_join', "=", $gameAsk[$i]->team_of_asker)
                        ->join('users', "teammembers.who_want_to_join", "=", "users.email")
                        ->join('users__profile__photos', "teammembers.who_want_to_join", "=", "users__profile__photos.email")
                        ->where('status', "=", "accepeted")->select(["image", "who_want_to_join"])->get();
                }
                return $gameAsk;
            } else if ($request->status == "finish") {
                $finish = AskGame::where('ask_games.status', "=", 'finish')
                    ->where('ask_games.who_was_asked', '=',  $mail)
                    ->leftJoin('teams', "ask_games.team_of_asker", '=', "teams.team_name")
                    ->leftJoin('winnings', "ask_games.id", '=', "winnings.game_id")
                    ->leftJoin('defeats', "ask_games.id", '=', "defeats.game_id")
                    ->leftJoin('draws', "ask_games.id", '=', "draws.game_id")
                    ->select([
                        'winnings.score as winningsScore', "defeats.score as defeatsScore", "draws.score as drawsScore",
                        "ask_games.id", "ask_games.place_of_game", 'ask_games.hours_of_game',
                        "ask_games.date_of_game", "winnings.winner_team", "winnings.winner_team", "defeats.looser_team", "teams.sport_name", 'ask_games.status'
                    ])
                    ->get()->unique();
                for ($i = 0; $i < count($finish); $i++) {
                    $finish[$i]->winner_logo =  Team::where('team_name', "=", $finish[$i]->winner_team)->select('logo')->get();
                }
                for ($i = 0; $i < count($finish); $i++) {
                    $finish[$i]->looser_logo =  Team::where('team_name', "=", $finish[$i]->looser_team)->select('logo')->get();
                }

                for ($i = 0; $i < count($finish); $i++) {
                    $finish[$i]->draws_teams =  draw::where('game_id', "=", $finish[$i]->id)->select('team')->get();
                }
                for ($i = 0; $i < count($finish); $i++) {
                    foreach ($finish[$i]->draws_teams as $key => $value) {
                        $finish[$i]->{"draws_team_logo_" . $key} =  Team::where('team_name', "=", $value->team)->select('logo')->get();
                    }
                }
                return  $finish;
            }
        }
        return 'Vous devez vous reconnecter.';
    }


    public function getMyAskGames(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        $mail =  User::where('remember_token', "=", $request->token)->value('email');
        if ($checkfirst > 0) {
            if ($request->status != "finish") {
                if ($request->status == "pending-score") {
                    $gameAsk = AskGame::where('ask_games.who_is_asking', '=',  $mail)
                        ->join('winnings', 'ask_games.id', '=', 'winnings.game_id')
                        ->where('ask_games.status', '=',  $request->status)
                        ->select([
                            "date_of_game", "hours_of_game", "place_of_game", "team_of_who_was_asked", "ask_games.id", "who_is_asking", "who_was_asked", "ask_games.status", 'team_of_asker',
                            "winner_team", "winnings.score", "winnings.score_2"
                        ])
                        ->skip($request->page)->take(10)
                        ->get()->unique();

                    if (count($gameAsk) == 0) {
                        $gameAsk = AskGame::where('ask_games.who_is_asking', '=',  $mail)
                            ->join('draws', 'ask_games.id', '=', 'draws.game_id')
                            ->where('ask_games.status', '=',  $request->status)
                            ->select([
                                "date_of_game", "hours_of_game", "place_of_game", "team_of_who_was_asked", "ask_games.id", "who_is_asking", "who_was_asked", "ask_games.status", 'team_of_asker',
                                "draws.team", "draws.score",
                            ])
                            ->skip($request->page)->take(10)
                            ->get()->unique();
                    }
                } else {
                    $gameAsk = AskGame::where('ask_games.who_is_asking', '=',  $mail)
                        ->where('ask_games.status', '=',  $request->status)
                        ->select(["date_of_game", "hours_of_game", "place_of_game", "team_of_who_was_asked", "id", "who_is_asking", "who_was_asked", "status", 'team_of_asker'])
                        ->skip($request->page)->take(10)
                        ->get()->unique();
                }
                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->sport_name =  Team::where('team_name', "=", $gameAsk[$i]->team_of_who_was_asked)->select('sport_name')->get();
                }

                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->victory_count =  Winning::where('winner_team', "=", $gameAsk[$i]->team_of_who_was_asked)->where("status", "=", "accepted")->count();
                }
                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->draw_count =  draw::where('team', "=", $gameAsk[$i]->team_of_who_was_asked)->where("status", "=", "accepted")->count();
                }
                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->defeats_count =  Defeat::where('looser_team', "=", $gameAsk[$i]->team_of_who_was_asked)->where("status", "=", "accepted")->count();
                }

                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->team_of_asker_logo =  Team::where('team_name', "=", $gameAsk[$i]->team_of_asker)->select('logo')->get();
                }
                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->team_of_who_was_asked_logo =  Team::where('team_name', "=", $gameAsk[$i]->team_of_who_was_asked)->select('logo')->get();
                }

                for ($i = 0; $i < count($gameAsk); $i++) {
                    $gameAsk[$i]->members =  Teammember::where('team_to_join_owner', "=", $gameAsk[$i]->who_was_asked)
                        ->where('team_to_join', "=", $gameAsk[$i]->team_of_who_was_asked)
                        ->join('users', "teammembers.who_want_to_join", "=", "users.email")
                        ->join('users__profile__photos', "teammembers.who_want_to_join", "=", "users__profile__photos.email")
                        ->where('status', "=", "accepeted")->select(["image", "who_want_to_join"])->get();
                }
                return $gameAsk;
            } else if ($request->status == "finish") {
                $finish = AskGame::where('ask_games.status', "=", 'finish')
                    ->where('ask_games.who_is_asking', '=',  $mail)
                    ->leftJoin('teams', "ask_games.team_of_asker", '=', "teams.team_name")
                    ->leftJoin('winnings', "ask_games.id", '=', "winnings.game_id")
                    ->leftJoin('defeats', "ask_games.id", '=', "defeats.game_id")
                    ->leftJoin('draws', "ask_games.id", '=', "draws.game_id")
                    ->select([
                        'winnings.score as winningsScore', "defeats.score as defeatsScore", "draws.score as drawsScore",
                        "ask_games.id", "ask_games.place_of_game", 'ask_games.hours_of_game',
                        "ask_games.date_of_game", "winnings.winner_team", "winnings.winner_team", "defeats.looser_team", "teams.sport_name", 'ask_games.status'
                    ])
                    ->get()->unique();
                for ($i = 0; $i < count($finish); $i++) {
                    $finish[$i]->winner_logo =  Team::where('team_name', "=", $finish[$i]->winner_team)->select('logo')->get();
                }
                for ($i = 0; $i < count($finish); $i++) {
                    $finish[$i]->looser_logo =  Team::where('team_name', "=", $finish[$i]->looser_team)->select('logo')->get();
                }

                for ($i = 0; $i < count($finish); $i++) {
                    $finish[$i]->draws_teams =  draw::where('game_id', "=", $finish[$i]->id)->select('team')->get();
                }
                for ($i = 0; $i < count($finish); $i++) {
                    foreach ($finish[$i]->draws_teams as $key => $value) {
                        $finish[$i]->{"draws_team_logo_" . $key} =  Team::where('team_name', "=", $value->team)->select('logo')->get();
                    }
                }
                return  $finish;
            }
        }
        return  'Vous devez vous reconnecter';
    }

    public function updateAskGames(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            AskGame::where('id', '=',  $request->id)->update([
                "date_of_game" => $request->date_of_game,
                "hours_of_game" => $request->hours_of_game,
                "place_of_game" => $request->place_of_game
            ]);
            return 'good';
        } else return "not connected";
    }

    public function accepteAskGames(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            AskGame::where('id', '=',  $request->id)->update([
                'status' => "accepted"
            ]);
            return 'good';
        } else return "not connected";
    }
    public function refuseAskGames(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            AskGame::where('id', '=',  $request->id)->update([
                'status' => "refused"
            ]);
            return 'good';
        } else return "not connected";
    }
    public function addTeamRates(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $checkrate =  TeamRate::where('game_id', "=", $request->game_id)->where('wichteamrated', '=', $request->wichteamrated)
                ->where('team_rated_name', '=', $request->team_rated_name)
                ->count();
            if ($checkrate > 0) {
                TeamRate::where('game_id', "=", $request->game_id)->update(["fair_play" =>  $request->fair_play, "punctuality" => $request->punctuality]);
                return 'good';
            } else {
                $teamRate = new TeamRate();
                $teamRate->wichteamrated = $request->wichteamrated;
                $teamRate->punctuality = $request->punctuality;
                $teamRate->fair_play  = $request->fair_play;
                $teamRate->teamrated  = 0;
                $teamRate->status = $request->status;
                $teamRate->team_rated_name = $request->team_rated_name;
                $teamRate->game_id = $request->game_id;
                $teamRate->save();
                return 'good';
            }
        } else return "not connected";
    }
    public function addWinner(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            Winning::where("game_id", '=', $request->game_id)->delete();
            // draw::where("game_id", '=', $request->game_id)->delete();
            $winning = new Winning();
            $winning->game_id =  $request->game_id;
            $winning->score = $request->score;
            $winning->winner_mail = $request->winner_mail;
            $winning->winner_team = $request->winner_team;
            $winning->score_2 = $request->score_2;
            $winning->status = $request->status;
            $winning->save();

            AskGame::where('id', "=", $request->game_id)->update(['status' => "pending-score"]);
            return 'good';
        } else return "not connected";
    }

    public function addLooser(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            // draw::where("game_id", '=', $request->game_id)->delete();
            Defeat::where("game_id", '=', $request->game_id)->delete();

            $defeat = new Defeat();
            $defeat->game_id =  $request->game_id;
            $defeat->score = $request->score;
            $defeat->looser_mail = $request->looser_mail;
            $defeat->looser_team = $request->looser_team;
            $defeat->score_2 = $request->score_2;
            $defeat->status = $request->status;
            $defeat->save();

            AskGame::where('id', "=", $request->game_id)->update(['status' => "pending-score"]);
            return 'good';
        } else return "not connected";
    }
    public function addDraw(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            draw::where("game_id", '=', $request->game_id)
                ->where("mail", '=', $request->mail)
                ->delete();
            Defeat::where("game_id", '=', $request->game_id)->delete();
            Winning::where("game_id", '=', $request->game_id)->delete();
            $draw = new draw();
            $draw->game_id =  $request->game_id;
            $draw->score = $request->score;
            $draw->mail = $request->mail;
            $draw->team = $request->team;
            $draw->status = $request->status;
            $draw->save();

            AskGame::where('id', "=", $request->game_id)->update(['status' => "pending-score"]);
            return 'good';
        } else return "not connected";
    }

    public function refuseScore(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            AskGame::where('id', "=", $request->game_id)->update(['status' => "accepted"]);
            return 'good';
        } else return "not connected";
    }

    public function accepteScore(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            AskGame::where('id', "=", $request->game_id)->update(['status' => "finish"]);
            Winning::where('game_id', "=", $request->game_id)->update(['status' => "accepted"]);
            Defeat::where('game_id', "=", $request->game_id)->update(['status' => "accepted"]);
            draw::where('game_id', "=", $request->game_id)->update(['status' => "accepted"]);
            $emails =  AskGame::where('id', "=", $request->game_id)->select(['who_is_asking', "who_was_asked"])->get();
            $ids = [];
            foreach ($emails  as  $value) {
                array_push($ids, User::where('email', "=", $value->who_is_asking)->value("id"), User::where('email', "=", $value->who_was_asked)->value("id"));
            }
            for ($i = 0; $i < count($ids); $i++) {
                $post = new PostTable();
                $post->title = $request->game_id;
                $post->user_id = $ids[$i];
                $post->who_can_see = "monde";
                $post->status = "online";
                $post->post_type = "automatique";
                $post->save();
            }
            return 'good';
        } else return "not connected";
    }

    public function getteammembers__onTeamPage(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $mail = User::where('remember_token', "=", $request->token)->value("email");
            return Teammember::where('teammembers.team_to_join_owner', '=',  $mail)
                ->where('teammembers.status', '=',  "accepeted")
                ->where('teammembers.team_to_join', '=',  $request->team_to_join)
                ->join('users__profile__photos', 'teammembers.who_want_to_join', '=', 'users__profile__photos.email')
                ->join('users', "teammembers.who_want_to_join", '=', 'users.email')
                ->select([
                    "users__profile__photos.image", 'users.lastname', 'users.name', "teammembers.id", 'teammembers.status',
                    "teammembers.team_to_join", "teammembers.who_want_to_join"
                ])
                ->orderBy("id", 'desc')->get()->unique();
        }
        return 'Vous devez vous reconnecter.';
    }

    public function getAVGOfTeamRates(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $sumPonctuality = TeamRate::where('team_rated_name', "=", $request->team)->selectRaw('sum(punctuality) as sum')->get("sum");
            $fair_play =  TeamRate::where('team_rated_name', "=", $request->team)->selectRaw('sum(fair_play) as sum')->get("sum");
            $table = [];
            if (ceil($fair_play->sum('sum') > 0 &&  TeamRate::where('team_rated_name', "=", $request->team)->count() > 0)) {
                $fair_playINtable = ceil($fair_play->sum('sum') / TeamRate::where('team_rated_name', "=", $request->team)->count());
            } else {
                $fair_playINtable = 0;
            }
            if (ceil($sumPonctuality->sum('sum') > 0 &&  TeamRate::where('team_rated_name', "=", $request->team)->count() > 0)) {
                $sumPonctualityIntable = ceil($sumPonctuality->sum('sum') / TeamRate::where('team_rated_name', "=", $request->team)->count());
            } else {
                $sumPonctualityIntable  = 0;
            }



            array_push($table, $sumPonctualityIntable,  $fair_playINtable);
            return  $table;
        }
        return 'not connected';
    }
    public function testTeam(Request $request)
    {
        // $range =  SqlRAws::getTeamRange($request->team, $request->sport_name, 2023, 2, 5);
        // foreach ($range  as $key => $value) {
        //     return $value->ranking;
        // }
    }
    public function palmares(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $finish = [];
            $team_of_asker = [];
            $who_was_asked = [];
            if ($request->season == 'h') {
                $team_of_asker = SqlRAws::palmares_fuction($request->team, $request->years, $request->page, 11, 2);
            } else if ($request->season == 'p') {
                $team_of_asker = SqlRAws::palmares_fuction($request->team, $request->years, $request->page, 2, 5);
            } else if ($request->season == 'e') {
                $team_of_asker = SqlRAws::palmares_fuction($request->team, $request->years, $request->page, 5, 8);
            } else if ($request->season == 'a') {
                $team_of_asker = SqlRAws::palmares_fuction($request->team, $request->years, $request->page, 8, 11);
            }
            if (count($team_of_asker) == 10) {

                foreach ($team_of_asker as $key => $value) {
                    array_push($finish, $value);
                }
                // array_push($finish, $team_of_asker);
            } else if (count($team_of_asker) < 10) {
                if ($request->season == 'h') {
                    $who_was_asked = SqlRAws::palmares_fuction_who_was_asked($request->team, $request->years, $request->page, 11, 2);
                } else if ($request->season == 'p') {
                    $who_was_asked = SqlRAws::palmares_fuction_who_was_asked($request->team, $request->years, $request->page, 2, 5);
                } else if ($request->season == 'e') {
                    $who_was_asked = SqlRAws::palmares_fuction_who_was_asked($request->team, $request->years, $request->page, 5, 8);
                } else if ($request->season == 'a') {
                    $who_was_asked = SqlRAws::palmares_fuction_who_was_asked($request->team, $request->years, $request->page, 8, 11);
                }
                foreach ($team_of_asker as $key => $value) {
                    array_push($finish, $value);
                }
                foreach ($who_was_asked as $key => $value) {
                    array_push($finish, $value);
                }
            }

            for ($i = 0; $i < count($finish); $i++) {
                $finish[$i]->winner_logo =  Team::where('team_name', "=", $finish[$i]->winner_team)->select('logo')->get();
            }
            for ($i = 0; $i < count($finish); $i++) {
                $finish[$i]->looser_logo =  Team::where('team_name', "=", $finish[$i]->looser_team)->select('logo')->get();
            }

            for ($i = 0; $i < count($finish); $i++) {
                $finish[$i]->draws_teams =  draw::where('game_id', "=", $finish[$i]->id)->select('team')->get();
            }
            for ($i = 0; $i < count($finish); $i++) {
                foreach ($finish[$i]->draws_teams as $key => $value) {
                    $finish[$i]->{"draws_team_logo_" . $key} =  Team::where('team_name', "=", $value->team)->select('logo')->get();
                }
            }


            $range = 0; // IF STAYS NULL THAT MEANS THAT THE TEAM DID NOT PLAY A GAME IN THE CURRENT SEASON 
            if (count($finish) > 0) {
                foreach (SqlRAws::getTeamRange($request->team, $finish[0]->sport_name)  as $key => $value) {
                    $range = $value->ranking; // GET USER RANGE DEPENDINF ON SPORT AND SEASON u107789930@access904851272.webspace-data.io
                }
            }






            $team_of_asker__ = AskGame::leftJoin('teams', "ask_games.team_of_asker", '=', "teams.team_name")
                ->where('ask_games.team_of_asker', '=',  $request->team)
                ->where('ask_games.status', "=", 'finish')
                ->whereRaw("YEAR(date_of_game) = " . $request->years)
                ->leftJoin('winnings', "ask_games.id", '=', "winnings.game_id")
                ->leftJoin('defeats', "ask_games.id", '=', "defeats.game_id")
                ->leftJoin('draws', "ask_games.id", '=', "draws.game_id")
                ->select([
                    'winnings.score as winningsScore', "defeats.score as defeatsScore", "draws.score as drawsScore",
                    "ask_games.id", "ask_games.place_of_game", 'ask_games.hours_of_game',
                    "ask_games.date_of_game", "winnings.winner_team", "winnings.winner_team", "defeats.looser_team",  'ask_games.status', "teams.sport_name"
                ])
                ->get()->unique();

            $who_was_asked__ = AskGame::leftJoin('teams', "ask_games.team_of_who_was_asked", '=', "teams.team_name")
                ->where('ask_games.team_of_who_was_asked', '=',  $request->team)
                ->where('ask_games.status', "=", 'finish')

                ->whereRaw("YEAR(date_of_game) = " . $request->years)
                ->leftJoin('winnings', "ask_games.id", '=', "winnings.game_id")
                ->leftJoin('defeats', "ask_games.id", '=', "defeats.game_id")
                ->leftJoin('draws', "ask_games.id", '=', "draws.game_id")
                ->select([
                    'winnings.score as winningsScore', "defeats.score as defeatsScore", "draws.score as drawsScore",
                    "ask_games.id", "ask_games.place_of_game", 'ask_games.hours_of_game',
                    "ask_games.date_of_game", "winnings.winner_team", "winnings.winner_team", "defeats.looser_team",  'ask_games.status', "teams.sport_name"
                ])
                ->get()->unique();

            $_bidSend = new stdClass();

            $allVictory = Winning::where('winner_team', "=", $request->team)->whereRaw("YEAR(created_at) = " . $request->years)->count(); // 
            $alldefeat = Defeat::where('looser_team', "=", $request->team)->whereRaw("YEAR(created_at) = " . $request->years)->count();
            $alldraws = draw::where('team', "=", $request->team)->whereRaw("YEAR(created_at) = " . $request->years)->count();

            $_bidSend->countGameTotal = count($who_was_asked__) +  count($team_of_asker__);
            $_bidSend->allVictory = $allVictory;

            $_bidSend->alldefeat = $alldefeat;
            $_bidSend->alldraws = $alldraws;
            $_bidSend->rang = $range;

            $_bidSend->gameList = $finish;
            return $_bidSend;
        }
        return 'Vous devez vous reconnecter.';
    }


    public function exitATeam(Request $request) // when a teamMEMBER decide to quit a team
    {
        $checkfirst =  User::where('remember_token', "=",  trim($request->token))->count();
        if ($checkfirst > 0) {
            $mail = User::where('remember_token', "=",  trim($request->token))->value("email");
            Teammember::where('who_want_to_join', "=", $mail)->where('team_to_join', "=", $request->team_to_join)->update(["status" => "exit"]);
            return 'good';
        }
        return 'Vous devez vous reconnecter.';  // STATUS exit;
    }

    public function removeFromTeam(Request $request) // when the owner of the team remove a member from his team
    {
        $checkfirst =  User::where('remember_token', "=",  trim($request->token))->count();
        if ($checkfirst > 0) {
            Teammember::where('who_want_to_join', "=", $request->who_want_to_join)->where('team_to_join', "=", $request->team_to_join)->update(["status" => "exit"]);
            return 'good';
        }
        return 'Vous devez vous reconnecter.';
    }
}



//game result victoty, defeat, draw, gameid

// defeat:  score,looser_mail, looser_team, gameid
// winning:  score, winner_team,  winner_mail,gameid

// draw: score, team, email, gameid


// finish, refused, accepted, pending, 

// finish = show score, and plus,
// refused = show that it was refused
// accepeted = show 