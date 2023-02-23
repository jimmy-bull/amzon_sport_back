<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Big;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Team;
use App\Models\FollowingSystem;
use App\Models\NotificationToken;
use App\Models\Notification;
use App\Models\Teammember;
use App\Http\Controllers\SqlRAws;
use App\Models\phone;
use App\Models\PostTable;

class Interaction extends Controller
{
    public function checkme(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $getEmail =  User::where('remember_token', "=", $request->token)->value("email");
            return  $getEmail;
        } else {
            return 'not connected';
        }
    }

    public function searchFriends(Request $request)
    {
        $lat = $request->lat;
        $long = $request->long;
        $sport = [];
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $sport__ = Team::where('email', "=",  User::where('remember_token', "=", $request->token)->value('email'))->select('sport_name')->get();
            foreach ($sport__ as $key => $value) {
                array_push($sport, $value->sport_name);
            }
        } else {
            return 'not connected';
        }
        $getEmail =  User::where('remember_token', "=", $request->token)->value("email");
        $firstSearch = [];
        // $secondSearch = [];
        //LA RECHERCHE SE FERA QUE SIL'UUTILISATEUR A DEJA CRÉÉ UNE EQUIPE AVEC UN SPORT. ON LE MONTRERA QUE LES RESULTAT LE CONCERNANT:
        //c'EST A DIRE QUE LES RESULTAT EN FONCTION DE SON SPORT
        $firstSearch = DB::table(DB::raw("(SELECT *, ST_Distance_Sphere(POINT(" . $long . "," . $lat . "), location) as
                distance FROM users WHERE email != '" . $getEmail . "' ) AS users"))
            ->join('teams', function ($join) use ($sport) {
                // $join->on('users.email', '=', 'teams.email')->whereIn("teams.sport_name", $sport);
                if (count($sport) > 0) {
                    $join->on('users.email', '=', 'teams.email')->whereIn("teams.sport_name", $sport);
                } else {
                    $join->on('users.email', '=', 'teams.email');
                }
            })
            ->leftJoin('users__profile__photos', 'users.email', '=', 'users__profile__photos.email')
            ->leftjoin("team_rates", "teams.team_name", "=", "team_rates.team_rated_name")
            ->select([
                'users.city',
                "users__profile__photos.image",
                'users.name',
                'users.lastname',
                "users.email",
                "users.speudo",
                "users.longitude",
                "users.latitude",
                DB::raw("SUM(punctuality) as punctuality_count"),
                DB::raw("SUM(fair_play) as fair_play_count"),
                DB::raw("SUM(fair_play + punctuality) as punctuality_fair_play_count"),
                "users.id",
                "users.distance",
                "teams.sport_name"
            ])->orderBy('distance')
            ->orderBy(DB::raw("punctuality_fair_play_count"), "desc")
            ->groupBy(
                [
                    "users.city",
                    "users__profile__photos.image",
                    'users.name',
                    'users.lastname',
                    "users.email",
                    "users.speudo",
                    "teams.sport_name"
                ]
            )
            ->skip($request->page)->take(10)
            ->get();
        return  $firstSearch;


        // else if (count($sport) == 0) {
        //     return "veuillez ajouter un sport afin de pouvoir faire une recherche.";
        //     // AU CAS OU Y'A PAS DE SPORT CRÉÉ PAR L'UTILISQTEUR:
        //     // SELECT MOI TOUT LES ELEMENTS LES PLUS PROCHE DE MOI ET ORDONNÉ LES EN FONCTION DE LEURS RATE
        //     // $firstSearch = DB::table(DB::raw("(SELECT *, ST_Distance_Sphere(POINT(" . $long . "," . $lat . "), location) as
        //     // distance FROM users WHERE email !='" . $getEmail  . "'ORDER BY distance  asc LIMIT " . $request->page . ",10) AS users "))
        //     //     ->leftJoin('users__profile__photos', 'users.email', '=', 'users__profile__photos.email')
        //     //     ->leftjoin('teams', 'users.email', '=', 'teams.email')
        //     //     ->leftjoin("team_rates", "teams.team_name", "=", "team_rates.team_rated_name")
        //     //     ->select([
        //     //         'users.city',
        //     //         "users__profile__photos.image",
        //     //         'users.name',
        //     //         'users.lastname',
        //     //         "users.email",
        //     //         "users.speudo",
        //     //         "users.longitude",
        //     //         "users.latitude",
        //     //         DB::raw("SUM(fair_play) as fair_play_count"),
        //     //         DB::raw("SUM(punctuality) as punctuality_count"),
        //     //         "users.id",
        //     //         "users.distance",
        //     //         DB::raw("SUM(fair_play + punctuality) as punctuality_fair_play_count"),
        //     //     ])
        //     //     ->orderBy("users.distance")
        //     //     ->orderBy(DB::raw("punctuality_fair_play_count"), "desc")
        //     //     ->groupBy(
        //     //         [
        //     //             "users.city",
        //     //             "users__profile__photos.image",
        //     //             'users.name',
        //     //             'users.lastname',
        //     //             "users.email",
        //     //             "users.speudo",
        //     //         ]
        //     //     )
        //     //     ->get();
        // }
    }
    public function searchTeams(Request $request)
    {
        // $arr = array(112, 21, 130, 140, 2, 42); //  [21,112,130,140,2,42];  [21,112,130,2,140,42], [21,112,130,2,42,140]
        // for ($i = 0; $i < count($arr) - 1; $i++) {
        //     for ($j = 0; $j < count($arr) - 1; $j++) {
        //         if ($arr[$j] > $arr[$j + 1]) {
        //             $temp = $arr[$j + 1];
        //             $arr[$j + 1] = $arr[$j];
        //             $arr[$j] = $temp;
        //         }
        //     }
        // }
        // return;
        // return ($arr);

        $lat = $request->lat;
        $long = $request->long;
        $sport = [];
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $sport__ = Team::where('email', "=",  User::where('remember_token', "=", $request->token)->value('email'))->select('sport_name')->get();
            foreach ($sport__ as $key => $value) {
                array_push($sport, $value->sport_name);
            }
        } else {
            return "not connected";
        }
        $getEmail =  User::where('remember_token', "=", $request->token)->value("email");

        $firstSearch = DB::table(DB::raw("(SELECT *, ST_Distance_Sphere(POINT(" . $long . "," . $lat . "), location) as
            distance FROM users WHERE email != '" . $getEmail . "' ) AS users"))
            ->join('teams', function ($join) use ($sport) {
                if (count($sport) > 0) {
                    $join->on('users.email', '=', 'teams.email')->whereIn("teams.sport_name", $sport);
                } else {
                    $join->on('users.email', '=', 'teams.email');
                }
            })
            ->leftjoin("team_rates", "teams.team_name", "=", "team_rates.team_rated_name")
            ->select(
                [
                    'teams.logo',
                    'teams.team_name',
                    "teams.sport_name",
                    "teams.id",
                    'teams.cover',
                    "teams.city",
                    'teams.email',
                    "distance",
                    DB::raw("SUM(punctuality) as punctuality_count"),
                    DB::raw("SUM(fair_play) as fair_play_count"),
                    DB::raw("SUM(fair_play + punctuality) as punctuality_fair_play_count"),
                ]
            )
            ->groupBy(
                [
                    'teams.logo',
                    'teams.team_name',
                    "teams.sport_name",
                    "teams.id",
                    'teams.cover',
                    "teams.city",
                    'teams.email',
                ]
            )
            ->orderBy('distance')
            ->orderBy(DB::raw("punctuality_fair_play_count"), "desc")
            ->skip($request->page)->take(10)
            ->get();
        return    $firstSearch;
        // } else if (count($sport) == 0) {
        //     return "veuillez ajouter un sport afin de pouvoir faire une recherche";
        // }
    }
    public function searchWithInputWithlocation(Request $request)
    {
        $lat = $request->lat;
        $long = $request->long;
        $getEmail =  User::where('remember_token', "=", $request->token)->value("email");

        $sport = [];
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            if (count(json_decode($request->sport)) == 0) {
                $sport__ = Team::where('email', "=",  User::where('remember_token', "=", $request->token)->value('email'))->select('sport_name')->get();
                foreach ($sport__ as $key => $value) {
                    array_push($sport, $value->sport_name);
                }
            } else {
                $sport = json_decode($request->sport);
            }
        } else {
            return 'not connected';
        }
        $string = $request->q;
        $users = [];
        /// LA RECHERCHE SE FERA SELEMENT EN FONCTION DU SPORT QUE L'UTILISATEUR A CRÉÉ, 
        //  SI L'UTILISATEUR N'AS PAS SPORT ON LUI DEMAND DE CRÉÉ UN SPORT, AU MOIN
        if ($request->maxkm == 0) {
            $users = DB::table(DB::raw("(SELECT *, ST_Distance_Sphere(POINT(" . $long . "," . $lat . "), location) as
                distance FROM users  WHERE email != '" . $getEmail . "') AS users"))
                ->leftJoin('users__profile__photos', 'users.email', '=', 'users__profile__photos.email')
                ->join('teams', function ($join) use ($sport) {
                    // $join->on('users.email', '=', 'teams.email')->whereIn("teams.sport_name", $sport);
                    if (count($sport) > 0) {
                        $join->on('users.email', '=', 'teams.email')->whereIn("teams.sport_name", $sport);
                    } else {
                        $join->on('users.email', '=', 'teams.email');
                    }
                })
                ->leftjoin("team_rates", "teams.team_name", "=", "team_rates.team_rated_name")
                ->where('name_lastname', "LIKE", "%" . $string . "%")
                ->orWhere('speudo', "LIKE", "%" . $string . "%")
                ->select(
                    [
                        'users.city',
                        "users__profile__photos.image",
                        'users.name',
                        'users.lastname',
                        "users.email",
                        "users.speudo",
                        DB::raw("ST_X(location) as longitude"),
                        DB::raw("ST_Y(location) as latitude"),
                        "users.name_lastname",
                        "teams.sport_name",
                        DB::raw("SUM(punctuality) as punctuality_count"),
                        DB::raw("SUM(fair_play) as fair_play_count"),
                        DB::raw("SUM(fair_play + punctuality) as punctuality_fair_play_count"),
                        "distance"
                    ]
                )
                ->groupBy(
                    [
                        "users.city",
                        "users__profile__photos.image",
                        'users.name',
                        'users.lastname',
                        "users.email",
                        "users.speudo",
                        "teams.sport_name",
                    ]
                )
                ->orderBy('distance')
                ->orderBy(DB::raw("punctuality_fair_play_count"), "desc")
                ->skip($request->page)->take(10)
                ->get();
        } else if ($request->maxkm > 0) {
            $users = DB::table(DB::raw("(SELECT *, ST_Distance_Sphere(POINT(" . $long . "," . $lat . "), location) as
                distance FROM users  WHERE email != '" . $getEmail . "'  HAVING distance <=" . $request->maxkm . " ) AS users"))
                ->join('teams', function ($join) use ($sport) {
                    // $join->on('users.email', '=', 'teams.email')->whereIn("teams.sport_name", $sport);
                    if (count($sport) > 0) {
                        $join->on('users.email', '=', 'teams.email')->whereIn("teams.sport_name", $sport);
                    } else {
                        $join->on('users.email', '=', 'teams.email');
                    }
                })
                ->leftJoin('users__profile__photos', 'users.email', '=', 'users__profile__photos.email')
                ->leftjoin("team_rates", "teams.team_name", "=", "team_rates.team_rated_name")
                ->where('name_lastname', "LIKE", "%" . $string . "%")
                ->orWhere('speudo', "LIKE", "%" . $string . "%")

                ->select([
                    'users.city',
                    "users__profile__photos.image",
                    'users.name',
                    'users.lastname',
                    "users.email",
                    "users.speudo",
                    DB::raw("ST_X(location) as longitude"),
                    DB::raw("ST_Y(location) as latitude"),
                    DB::raw("SUM(punctuality) as punctuality_count"),
                    DB::raw("SUM(fair_play) as fair_play_count"),
                    DB::raw("SUM(fair_play + punctuality) as punctuality_fair_play_count"),
                    "users.id",
                    "users.distance",
                    "teams.sport_name",
                    "users.name_lastname",
                    "distance"
                ])->orderBy('distance')
                ->orderBy(DB::raw("punctuality_fair_play_count"), "desc")
                ->groupBy(
                    [
                        "users.city",
                        "users__profile__photos.image",
                        'users.name',
                        'users.lastname',
                        "users.email",
                        "users.speudo",
                        "teams.sport_name"
                    ]
                )
                ->skip($request->page)->take((10))
                ->get();
        }


        return $users;
    }
    public function searchTeamsWithInput(Request $request)
    {
        $lat = $request->lat;
        $long = $request->long;
        $sport = [];
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            if (count(json_decode($request->sport)) == 0) {
                $sport__ = Team::where('email', "=",  User::where('remember_token', "=", $request->token)->value('email'))->select('sport_name')->get();
                foreach ($sport__ as $key => $value) {
                    array_push($sport, $value->sport_name);
                }
            } else {
                $sport = json_decode($request->sport);
            }
        } else {
            return 'not connected';
        }
        $getEmail =  User::where('remember_token', "=", $request->token)->value("email");
        $string = $request->q;
        $users = [];
        // $sport = json_decode($request->sport);

        if ($request->maxkm == 0) {
            $users = DB::table(DB::raw("(SELECT *, ST_Distance_Sphere(POINT(" . $long . "," . $lat . "), location) as
                distance FROM users WHERE email != '" . $getEmail . "' ) AS users"))
                ->join('teams', function ($join) use ($sport) {
                    // $join->on('users.email', '=', 'teams.email')->whereIn("teams.sport_name", $sport);
                    if (count($sport) > 0) {
                        $join->on('users.email', '=', 'teams.email')->whereIn("teams.sport_name", $sport);
                    } else {
                        $join->on('users.email', '=', 'teams.email');
                    }
                })
                ->leftjoin("team_rates", "teams.team_name", "=", "team_rates.team_rated_name")
                ->where('teams.team_name', "LIKE", "%" . $string . "%")
                ->select(
                    [
                        'teams.logo',
                        'teams.team_name',
                        "teams.sport_name",
                        "teams.id",
                        'teams.cover',
                        "teams.city",
                        'teams.email',
                        "distance",
                        DB::raw("SUM(punctuality) as punctuality_count"),
                        DB::raw("SUM(fair_play) as fair_play_count"),
                        DB::raw("SUM(fair_play + punctuality) as punctuality_fair_play_count"),
                    ]
                )
                ->groupBy(
                    [
                        'teams.logo',
                        'teams.team_name',
                        "teams.sport_name",
                        "teams.id",
                        'teams.cover',
                        "teams.city",
                        'teams.email',
                    ]
                )
                ->orderBy('distance')
                ->orderBy(DB::raw("punctuality_fair_play_count"), "desc")
                ->skip($request->page)->take(10)
                ->get();
        } else if ($request->maxkm > 0) {
            $users = DB::table(DB::raw("(SELECT *, ST_Distance_Sphere(POINT(" . $long . "," . $lat . "), location) as
                distance FROM users  WHERE email != '" . $getEmail . "'  HAVING distance <=" . $request->maxkm . " ) AS users"))
                ->join('teams', function ($join) use ($sport) {
                    // $join->on('users.email', '=', 'teams.email')->whereIn("teams.sport_name", $sport);
                    if (count($sport) > 0) {
                        $join->on('users.email', '=', 'teams.email')->whereIn("teams.sport_name", $sport);
                    } else {
                        $join->on('users.email', '=', 'teams.email');
                    }
                })
                ->leftjoin("team_rates", "teams.team_name", "=", "team_rates.team_rated_name")
                ->where('teams.team_name', "LIKE", "%" . $string . "%")
                ->select(
                    [
                        'teams.logo',
                        'teams.team_name',
                        "teams.sport_name",
                        "teams.id",
                        'teams.cover',
                        "teams.city",
                        'teams.email',
                        "distance",
                        DB::raw("SUM(punctuality) as punctuality_count"),
                        DB::raw("SUM(fair_play) as fair_play_count"),
                        DB::raw("SUM(fair_play + punctuality) as punctuality_fair_play_count"),
                    ]
                )
                ->groupBy(
                    [
                        'teams.logo',
                        'teams.team_name',
                        "teams.sport_name",
                        "teams.id",
                        'teams.cover',
                        "teams.city",
                        'teams.email',
                    ]
                )
                ->orderBy('distance')
                ->orderBy(DB::raw("punctuality_fair_play_count"), "desc")
                ->skip($request->page)->take(10)
                ->get();
        }
        return $users;
    }

    public function followingSystem_insert(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {

            $mail =  User::where('remember_token', "=", $request->token)->value('email');

            $check = FollowingSystem::where('thefollower', "=", $mail)->where('thefollowed', "=", $request->email)->count();

            if ($check == 1) {
                $checkSub =  FollowingSystem::where('thefollower', "=", $mail)->where('thefollowed', "=", $request->email)->value("thefollowingState");
                if ($checkSub == "isfollowing") {
                    FollowingSystem::where('thefollower', "=", $mail)->where('thefollowed', "=", $request->email)
                        ->update(['thefollowingState' => "isunfollowed"]);
                    return "isunfollowed";
                } else {
                    FollowingSystem::where('thefollower', "=", $mail)->where('thefollowed', "=", $request->email)
                        ->update(['thefollowingState' => "isfollowing"]);
                    return "isfollowing";
                }
            } else if ($check == 0) {
                $followingSystem =  new FollowingSystem();
                $followingSystem->thefollower = $mail;
                $followingSystem->thefollowed = $request->email;
                $followingSystem->thefollowingState = "isfollowing";
                $followingSystem->save();
                return "isfollowing";
            }
        }
    }



    public function followingSystem_check(Request $request) // CHECK IF I'M ALREADY FOLLWING OR NOT A CURRENT USER
    {
        $mail =  User::where('remember_token', "=", $request->token)->value('email');
        $checkSub =  FollowingSystem::where('thefollower', "=", $mail)->where('thefollowed', "=", $request->email)->value("thefollowingState");
        if ($checkSub == "isfollowing") {
            return 'isfollowing';
        } else {
            return 'isunfollowed';
        }
    }

    public function followingSystem_check_2(Request $request)  // CHECK IF A CURRENT USER IS ALREADY FOLLWING ME OR NOT
    {
        $mail =  User::where('remember_token', "=", $request->token)->value('email');
        $checkSub =  FollowingSystem::where('thefollower', "=",  $request->email)->where('thefollowed', "=", $mail)->value("thefollowingState");
        if ($checkSub == "isfollowing") {
            return 'isfollowing_2';
        } else {
            return 'isunfollowed';
        }
    }
    public function adnotif(Request $request)
    {
        $mail =  User::where('remember_token', "=", $request->token)->value('email');
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        $checkifNotifExist  = NotificationToken::where('token', "=", $request->notifToken)->count();
        if ($checkfirst > 0) {
            if ($checkifNotifExist > 0) {
                NotificationToken::where('token', "=", $request->notifToken)->update(["email" => $mail]);
            }
            $check_exist = NotificationToken::where('email', "=", $mail)->where('token', "=", $request->notifToken)->count();
            if ($check_exist == 0) {
                $notif = new NotificationToken();
                $notif->email =  $mail;
                $notif->token =  $request->notifToken;
                $notif->save();
                return "added";
            }
        }
    }
    public function getNotifTokens(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();

        if ($checkfirst > 0) {
            return NotificationToken::where('email', "=", $request->email)->get();
        }
    }
    public function addRealtimeNotif(Request $request)
    { // return $request->message;
        // Notification 0-10 $request->page
        // return $request->who;
        // $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        // if ($checkfirst > 0) {
        $realtimeNotif = new Notification();
        $realtimeNotif->message = trim($request->message);
        $realtimeNotif->notification_actions = trim($request->notification_actions);
        $realtimeNotif->email = trim($request->who);
        $realtimeNotif->who_sent_notification = trim($request->who_sent);
        $realtimeNotif->state = "unreaded"; // 
        $realtimeNotif->save();

        if (trim($request->notification_actions) == "integration_actions") {
            //  UPDATE teammembers with notifications_id depending on 
            Teammember::where('id', "=",  $request->teammembers_id)->update(['notifications_id' => $realtimeNotif->id]);
            return [$realtimeNotif->id,  Notification::where('email', "=", $request->who)
                ->where('state', '=', "unreaded")
                ->orderBy("id", 'desc')->count()];
        } else {
            return  Notification::where('email', "=", $request->who)
                ->where('state', '=', "unreaded")
                ->orderBy("id", 'desc')->count();
        }
        //   ->skip(0)->take(10)

        // }  integration_actions 

        // return 'not connected';
    }
    public function getRealtimeNotif(Request $request)
    {
        //0-10 $request->page
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $mail =  User::where('remember_token', "=", $request->token)->value('email');
            return  Notification::Leftjoin("users__profile__photos", "notifications.who_sent_notification", "=", "users__profile__photos.email")
                ->Leftjoin("users", "notifications.who_sent_notification", "=", "users.email")
                ->where('notifications.email', "=", $mail)
                ->skip($request->page)->take(10)->select(
                    'users__profile__photos.image',
                    "users.name",
                    "users.lastname",
                    "notifications.message",
                    "notifications.created_at",
                    "notifications.notification_actions",
                    "users.email"
                )->orderBy("notifications.id", 'desc')->get();
        }
        return 'not connected';
    }
    public function getRealtimeNotif_count(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            return  Notification::where('email', "=",  User::where('remember_token', "=", $request->token)->value('email'))
                ->where('state', '=', "unreaded")
                ->orderBy("id", 'desc')->count();
        }
        return 'not connected';
    }
    public function getCurrentUsermail(Request $request)
    {
        return  User::where('remember_token', "=", $request->token)->value('email');
    }

    public function markNotifasreaded(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $mail =  User::where('remember_token', "=", $request->token)->value('email');
            Notification::where('email', "=", $mail)->update(['state' => "readed"]);
            return  Notification::where('email', "=",  User::where('remember_token', "=", $request->token)->value('email'))
                ->where('state', '=', "unreaded")
                ->orderBy("id", 'desc')->count();
        }
        return 'not connected';
    }
}

 // wherei['foot',"tennis']; 
  /*---------------------------------------------------------------*/
        /*
    Titre : Calcul la distance entre 2 points en km                                                                       
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=1091
    Auteur           : sheppy1                                                                                            
    Website auteur   : https://lejournalabrasif.fr/qwanturank-concours-seo-qwant/                                         
    Date édition     : 05 Aout 2019                                                                                       
    Date mise à jour : 16 Aout 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
*/
        /*---------------------------------------------------------------*/

// function distance($lat1, $lng1, $lat2, $lng2, $miles = false)
// {
//     $pi80 = M_PI / 180;
//     $lat1 *= $pi80;
//     $lng1 *= $pi80;
//     $lat2 *= $pi80;
//     $lng2 *= $pi80;

//     $r = 6372.797; // rayon moyen de la Terre en km
//     $dlat = $lat2 - $lat1;
//     $dlng = $lng2 - $lng1;

//     $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
//     // return $a;
//     $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
//     $km = $r * $c;

//     return ($miles ? ($km * 0.621371192) : $km);
// }
//echo  distance(45.7698747385, 4.82857516905, 49.1850251668, -0.370004009634) . ' CAEN LYON <br/><br/>';

// echo  distance(45.7698747385, 4.82857516905, 49.2074415651, -0.330690059361) . ' lyon herou <br/><br/>';

// echo  distance(45.7698747385, 3.0429756448, 48.862834158, 2.33616696102) . ' PARIS lyon <br/><br/>';