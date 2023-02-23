<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AskGame;
use Carbon\Carbon;

class SqlRAws extends Controller
{
    //TO GET RANGE OF EACH TEAM DEPENDING ON THE SEASON , 
    public static function getTeamRange($team, $sport_name)
    {
        // $startDate  = Carbon::createFromDate($years, $firstBetween)->format('Y-m');
        // $endDate  = Carbon::createFromDate($years, $secondBetween)->format('Y-m');
        // if ($firstBetween == 11) {
        //     $endDate  = Carbon::createFromDate($years + 1, $secondBetween)->format('Y-m');

        // $years,  $firstBetween, $secondBetween
        // }

        return  DB::select(DB::raw("SELECT * FROM (SELECT
        winner_team as team,
        RANK() OVER(
            ORDER BY
                (table2.winnings_count - table1.defeats_count) DESC
        ) AS ranking,
        (table2.winnings_count - table1.defeats_count) as difference
    FROM
        (
            SELECT
                looser_team,
                COUNT(game_id) as defeats_count
            FROM
                defeats
                
                INNER JOIN teams ON defeats.looser_team = teams.team_name
                WHERE teams.sport_name = '{$sport_name}'
            GROUP BY
                looser_team
        ) as table1
        INNER JOIN (
            SELECT
                winner_team,
                COUNT(game_id) as winnings_count
            FROM
                winnings
                INNER JOIN teams ON winnings.winner_team = teams.team_name
                WHERE teams.sport_name = '{$sport_name}'
            GROUP BY
                winner_team
        ) as table2 

        ON table1.looser_team = table2.winner_team 
    ORDER BY
        (table2.winnings_count - table1.defeats_count) DESC) as bigTAble  WHERE team='{$team}'"));
    }
    //  
    public static function palmares_fuction($team, $years, $page, $firstBetween, $secondBetween)
    {
        $startDate  = Carbon::createFromDate($years, $firstBetween)->format('Y-m');
        $endDate  = Carbon::createFromDate($years, $secondBetween)->format('Y-m');
        if ($firstBetween >= 11) {
            $startDate  = Carbon::createFromDate($years - 1, $firstBetween)->format('Y-m');
            $endDate  = Carbon::createFromDate($years, $secondBetween)->format('Y-m');
        }

        $team_of_asker = AskGame::leftJoin('teams', "ask_games.team_of_asker", '=', "teams.team_name")
            ->where('ask_games.team_of_asker', '=',  $team)
            ->where('ask_games.status', "=", 'finish')
            ->whereBetween("date_of_game", [$startDate, $endDate])
            ->leftJoin('winnings', "ask_games.id", '=', "winnings.game_id")
            ->leftJoin('defeats', "ask_games.id", '=', "defeats.game_id")
            ->leftJoin('draws', "ask_games.id", '=', "draws.game_id")
            ->select([
                'winnings.score as winningsScore', "defeats.score as defeatsScore", "draws.score as drawsScore",
                "ask_games.id", "ask_games.place_of_game", 'ask_games.hours_of_game',
                "ask_games.date_of_game", "winnings.winner_team", "winnings.winner_team", "defeats.looser_team",  'ask_games.status', "teams.sport_name"
            ])
            ->get()->unique()->skip($page)->take(10);

        return  $team_of_asker;
        // [en fonction des saison: hiver ete printemp  de chaque année
        // nombre de match jouer, [nombre de victoire, nombre de defaites, nombre de match null]
        // la liste des match]
        //Année
        // hiver | printemp | été === topbar in react native 

        // nombre de match jouer
        // 30 victore 2 defaite 16 match null ==== faire des cercle
        // acccordions des liste de match

        //printemps == 02 à 05 == est egale a 2 ou est inferieur a 5               [2,3,4] = printemps  = p
        //ete == 05-08 == est egale a 5 ou est inferieur a 8                       [5,6,7]  = ete = e
        //automne == 08-11 = est egale à 8 ou est inferieur a 11                   [8,9,10] = automne = a
        //hiver == 11-02 == est egale 11 ou est inferieur a 2 ou est egale a 12    [11,12,1] = hiver = h
    }
    public static function palmares_fuction_who_was_asked($team, $years, $page, $firstBetween, $secondBetween)
    {
        $startDate  = Carbon::createFromDate($years, $firstBetween)->format('Y-m');
        $endDate  = Carbon::createFromDate($years, $secondBetween)->format('Y-m');
        if ($firstBetween == 11) {
            $endDate  = Carbon::createFromDate($years + 1, $secondBetween)->format('Y-m');
        }
        return $who_was_asked = AskGame::leftJoin('teams', "ask_games.team_of_who_was_asked", '=', "teams.team_name")
            ->where('ask_games.team_of_who_was_asked', '=',  $team)
            ->where('ask_games.status', "=", 'finish')
            ->whereBetween("date_of_game",  [$startDate, $endDate])
            ->leftJoin('winnings', "ask_games.id", '=', "winnings.game_id")
            ->leftJoin('defeats', "ask_games.id", '=', "defeats.game_id")
            ->leftJoin('draws', "ask_games.id", '=', "draws.game_id")
            ->select([
                'winnings.score as winningsScore', "defeats.score as defeatsScore", "draws.score as drawsScore",
                "ask_games.id", "ask_games.place_of_game", 'ask_games.hours_of_game',
                "ask_games.date_of_game", "winnings.winner_team", "winnings.winner_team", "defeats.looser_team",  'ask_games.status', "teams.sport_name"
            ])
            ->get()->unique()->skip($page)->take(10);
        return $who_was_asked;
    }
    public static function distance($lat, $long) // NB: I'm not using the method again just keept it in case.
    {         //  ->orderBy(DB::raw(SqlRAws::distance($lat, $long)))->get()->groupBy("city")->skip($request->page)->take(10);
        // ->orderBy(DB::raw(SqlRAws::distance($lat, $long)))->get()->groupBy("city")->skip($request->page)->take(10);
        return 'ABS( 
            (2 * atan2( sqrt(  (  sin( (  (latitude * (3.1415926535898 /  180)) - ' . ($lat * (3.1415926535898 / 180)) . ') / 2) * 
            sin( ( (latitude * (3.1415926535898 /  180)) - ' . ($lat * (3.1415926535898 / 180)) . ') / 2)  + cos(latitude * (3.1415926535898 /  180) ) *  ' . cos($lat * (3.1415926535898 / 180)) . '
             *  sin( ( (longitude * (3.1415926535898 /  180)) - ' . ($long * (3.1415926535898 / 180)) . ') / 2)  
             *  sin( ( (longitude * (3.1415926535898 /  180)) - ' . ($long * (3.1415926535898 / 180)) . ') / 2)  )),
            sqrt(1 - (  sin( (  (latitude * (3.1415926535898 /  180)) - ' . ($lat * (3.1415926535898 / 180)) . ') / 2) * 
            sin( ( (latitude * (3.1415926535898 /  180)) - ' . ($lat * (3.1415926535898 / 180)) . ') / 2)  + cos(latitude * (3.1415926535898 /  180)) *  ' . cos($lat * (3.1415926535898 / 180)) . '
           *  sin( ( (longitude * (3.1415926535898 /  180)) - ' . ($long * (3.1415926535898 / 180)) . ') / 2)  
          *  sin( ( (longitude * (3.1415926535898 /  180)) - ' . ($long * (3.1415926535898 / 180)) . ') / 2)  
          )) )) * 6372.797 )';

        // this calcul is base on this function:
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
    }



    public static function levenshtein_distance($a, $b)
    {
        $len_a = strlen($a);
        $len_b = strlen($b);

        if ($len_a === 0) {
            return $len_b;
        }

        if ($len_b === 0) {
            return $len_a;
        }

        $distance = array();
        for ($i = 0; $i <= $len_a; $i++) {
            $distance[$i][0] = $i;
        }

        for ($j = 0; $j <= $len_b; $j++) {
            $distance[0][$j] = $j;
        }

        for ($i = 1; $i <= $len_a; $i++) {
            for ($j = 1; $j <= $len_b; $j++) {
                if ($a[$i - 1] === $b[$j - 1]) {
                    $cost = 0;
                } else {
                    $cost = 1;
                }

                $distance[$i][$j] = min($distance[$i - 1][$j] + 1, $distance[$i][$j - 1] + 1, $distance[$i - 1][$j - 1] + $cost);
            }
        }

        return $distance[$len_a][$len_b];
    }

    public static function compare_characters($string, $array_of_strings)
    {
        $results = array();
        // $results["string"] = 'jimbull';

        foreach ($array_of_strings as $array_string) {
            $count = 0;
            $rank = 0;
            for ($i = 0; $i < strlen($string); $i++) {
                if (strpos($array_string, $string[$i]) !== false) {
                    // $count++;
                    $rank = strpos($array_string, $string[$i]);
                    $results[$array_string]["y'a quoi dans " . $string . " qui n'est pas dans " . $array_string][$string[$i] . $i] = $string[$i] . $rank;
                } else {
                    $count++;
                    $results[$array_string]["y'a quoi dans " . $string . " qui n'est pas dans " . $array_string]["sup_1"][$string[$i] . $i] = $count;
                }
            }

            for ($i = 0; $i < strlen($array_string); $i++) {
                if (strpos($string, $array_string[$i]) !== false) {
                    $rank = strpos($string, $array_string[$i]);
                    $results[$array_string]["y'a quoi dans " . $array_string . " qui n'est pas dans " . $string][$array_string[$i] . $i] = $array_string[$i] . $rank;
                } else {
                    $count++;
                    $results[$array_string]["y'a quoi dans " . $array_string . " qui n'est pas dans " . $string]["sup_2"][$array_string[$i] . $i] = $count;
                }
            }
        }

        //  arsort($results);
        // echo 'jimbull';

        return ($results);
    }
    // jimmybull = 22; jimmyjimmy = 9; angebulljimmy = 15; iimmbbuulljj" = 20;

    // jimmyjimmy; jimmybull; angebulljimmy; iimmbbuulljj;

    /**
     * jimbull = distance(1) - nombre de fois (7) = -7; 7*0;
     * jimmybull = distance (10 + 7) - nombre de fois (8)  ; 7*1;
     *  sattaKoffi = distance (8 + 63) - nombre de fois(1);  nombre total(7) * nombre de lettre qui ne sont pas dedans(9) = 63
     *  jimmyjimmy = distance(22 + 14) - nombre de fois(8) ;  7 * 2;
     *  angebulljimmy = (38 + 28) - nombre de fois(8); 7 * 4;
     * iimmbbuulljj = (36 + 7) - nombre(12); 7*1
     * bull = (11) - 4 = -15;
     * jimmy  = (1 + 7) - 4 = 4
     */

    //  distance = 0;  nombre de fois = 7;

    //jimbull = -7; jimmybull = 9;  sattaKoffi =70;  jimmyjimmy = 28;  angebulljimmy = 58; iimmbbuulljj = 31;


    // jimbull = -6; bull = -15; jimmy = 4; jimmybull = 9;  jimmyjimmy = 28; iimmbbuulljj = 31; angebulljimmy = 58; sattaKoffi = 70;


    // 
    /**
     * LE CALCUL = (SUM(postionX - positionY) + (lengthSearch * ))
     */

    /**
     * [0,1,2,3] jimmyy
     * [b,u,l,l]
     * [0,1,2,3,4,5,6]
     * [j,i,m,b,u,l,l]                           [nombre d'echec, distance, nombre de reussite]; base distance = [0,0];  [j,i,m,b,u,l,l] = [0,1,2,3,4,5,6]
     * 
     * bull = 3 (24); = 27                       [3,24,8] =  [nombre d'echec, distance, nombre de reussite]; = 19 = 0,75 + 6 -(2) = 4,75
     * jimmy = 5 (1);   = 6                      [5,1,7] = [nombre d'echec, distance, nombre de reussite]; = 1 + 0,2 - (1,4) = 0,2
     * jimbull = 0 (0);  = 0                     [0,0,7] = [nombre d'echec, distance, nombre de reussite]; = 1
     * 
     * sattaKoffij= 14 (36); = 50;               [14,36,4] = [nombre d'echec, distance, nombre de reussite]; = 
     *                                           46; (chaque lettre en moyenne doivent parcouri 4,18 fois) 1,27, 0,36  = 3,27 + 1,27 - (0,36) = 4,18
     * 
     *  jimmybull = 1 (17); = 18;                [1,18,15] = [nombre d'echec, distance, nombre de reussite];
     * jimmyjimmy = 6 (26); =32;                 [6,32,11] = [nombre d'echec, distance, nombre de reussite];
     * angebulljimmy = 5 (65); = 70;             [5,70,15] = [nombre d'echec, distance, nombre de reussite];
     * iimmbbuulljj = 0 (57); = 57               [0,57,19] = [nombre d'echec, distance, nombre de reussite]; 48; 4,75  = 0 + 1,58 - (4,75)   =3,17
     * jimbullpppppppp = 8 (3) = 11;             [8,3,14] = [nombre d'echec, distance, nombre de reussite]; 0,53 + 0,2 - (0,93) = 0,2
     * 
     * jimbull (0); jimmy(6);jimbullpppppppp(11);jimmybull(18); bull (27);jimmyjimmy (32); sattaKoffij (50); iimmbbuulljj (57); angebulljimmy(70)
     */
    public static function searchEngine($string, $array_of_strings)
    {
        $results = array();
        $stringLenth = strlen($string);
    }
}
