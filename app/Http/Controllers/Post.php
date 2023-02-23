<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\ImageVideoTable;
use App\Models\PostTable;
use App\Models\FollowingSystem;
use App\Models\like;
use Illuminate\Support\Facades\Storage;
use App\Models\sub_comments_table;
use App\Models\Team;
use App\Models\draw;
use App\Models\CommentLike;
use App\Models\SubCommentsLikes;
use Illuminate\Support\Facades\DB;

class Post extends Controller
{
    public function add_post(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $id = User::where('remember_token', "=", $request->token)->value("id");
            $post = new PostTable();
            $post->title = $request->title;
            $post->user_id = $id;
            $post->who_can_see = $request->who_can_see;
            $post->status = $request->status;
            $post->save();
            foreach ($request->file('images') as $key => $file) {
                if (
                    $file->extension() == "mp4" || $file->extension() == "flv" ||
                    $file->extension() == "m3u8" || $file->extension() == "ts" || $file->extension() == "3gp"
                    || $file->extension() == "mov" || $file->extension() == "avi" || $file->extension() == "wmv"
                ) {
                    $image_tables = new  ImageVideoTable();
                    $image_tables->post_id = $post->id;
                    $image_tables->type = "video";
                    $image_tables->link = $file->store('public/post_images_videos');
                    $image_tables->save();
                } else {
                    $image_tables = new  ImageVideoTable();
                    $image_tables->post_id = $post->id;
                    $image_tables->type = "image";
                    $image_tables->link = $file->store('public/post_images_videos');
                    $image_tables->save();
                }
            }
            return json_encode('good');

            // $team->logo = $request->file('logo')->store('public/teams_photos');
            // $team->cover = $request->file('cover')->store('public/teams_photos');
            // $team->city = $request->city;
            // return $request->file;
            // return $post->id;
            // status = online,deleted,
        }
        return json_encode('Vous devez vous reconnecter.');
    }

    public function getPost(Request $request)
    {
        $newTable = [];
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            if ($request->who == "me") {
                $user_id = User::where('remember_token', "=", $request->token)->select('id')->get();
            } else {
                $user_id = User::where('email', "=", $request->who)->select('id')->get();
            }

            $i = 0;
            $fromDB =  PostTable::join('image_video_tables', "post_tables.id", "=", "image_video_tables.post_id")
                ->join('users', "post_tables.user_id", "=", "users.id")
                ->join('users__profile__photos', "users__profile__photos.email", "=", "users.email")
                ->where('post_tables.user_id', "=",  $user_id[0]->id)->get()->groupBy("post_id");
            foreach ($fromDB as $key => $value) {
                $images = [];
                $customObj = new \stdClass();
                $customObj->id = $key;
                $countLikes =  like::where('post_id', "=", $key)->count();
                $customObj->likes = $countLikes;
                $countComments =  Comment::where('post_id', "=", $key)->count();
                $customObj->comments = $countComments;
                $commentsDate = PostTable::where('id', "=", $key)->select("created_at")->get();
                $customObj->date = $commentsDate[0]->created_at;
                $meLikes =  like::where('post_id', "=", $key)->where('who_liked_id', "=", $user_id[0]->id)->count();
                if ($meLikes > 0) {
                    $customObj->meLikes = true;
                } else {
                    $customObj->meLikes = false;
                }

                foreach ($fromDB[$key] as $key__ => $value__) {
                    $imagesObj = new \stdClass();
                    $imagesObj->image = $value__->link;
                    $imagesObj->id = $i;
                    if (Storage::disk('public')->exists(explode("public", $value__->link)[1])) {
                        $img_size = getimagesize(storage_path('app/' . $value__->link));
                    } else {
                        $img_size = false;
                    }
                    if ($img_size != false) {
                        $imagesObj->imageDimension = intval($img_size["0"])  / intval($img_size["1"]);
                    } else {
                        $imagesObj->imageDimension = false;
                    }
                    array_push($images, $imagesObj);
                    $customObj->images = $images;
                    $customObj->description = $value__->title;
                    $customObj->postType = "regular";
                    $customObj->city = $value__->city;
                    $customObj->country = $value__->country;
                    $customObj->posterName = $value__->lastname . " " . $value__->name;
                    $customObj->posterImage = $value__->image;
                    $i++;
                }
                $i = 0;
                array_push($newTable, $customObj);
            }
            return   $newTable;
        }
    }


    public function getPost_Id(Request $request)
    {
        $newTable = [];
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            if ($request->who == "me") {
                $user_id = User::where('remember_token', "=", $request->token)->select('id')->get();
            } else {
                $user_id = User::where('email', "=", $request->who)->select('id')->get();
            }

            $i = 0;
            $fromDB =  PostTable::join('image_video_tables', "post_tables.id", "=", "image_video_tables.post_id")
                ->join('users', "post_tables.user_id", "=", "users.id")
                ->join('users__profile__photos', "users__profile__photos.email", "=", "users.email")
                ->where('post_tables.id', "=",  $request->id)->get()->groupBy("post_id");
            foreach ($fromDB as $key => $value) {
                $images = [];
                $customObj = new \stdClass();
                $customObj->id = $key;
                $countLikes =  like::where('post_id', "=", $key)->count();
                $customObj->likes = $countLikes;
                $countComments =  Comment::where('post_id', "=", $key)->count();
                $customObj->comments = $countComments;
                $commentsDate = PostTable::where('id', "=", $key)->select("created_at")->get();
                $customObj->date = $commentsDate[0]->created_at;
                $meLikes =  like::where('post_id', "=", $key)->where('who_liked_id', "=", $user_id[0]->id)->count();
                if ($meLikes > 0) {
                    $customObj->meLikes = true;
                } else {
                    $customObj->meLikes = false;
                }

                foreach ($fromDB[$key] as $key__ => $value__) {
                    $imagesObj = new \stdClass();
                    $imagesObj->image = $value__->link;
                    $imagesObj->id = $i;
                    if (Storage::disk('public')->exists(explode("public", $value__->link)[1])) {
                        $img_size = getimagesize(storage_path('app/' . $value__->link));
                    } else {
                        $img_size = false;
                    }
                    if ($img_size != false) {
                        $imagesObj->imageDimension = intval($img_size["0"])  / intval($img_size["1"]);
                    } else {
                        $imagesObj->imageDimension = false;
                    }
                    array_push($images, $imagesObj);
                    $customObj->images = $images;
                    $customObj->description = $value__->title;
                    $customObj->postType = "regular";
                    $customObj->city = $value__->city;
                    $customObj->country = $value__->country;
                    $customObj->posterName = $value__->lastname . " " . $value__->name;
                    $customObj->posterImage = $value__->image;
                    $i++;
                }
                $i = 0;
                array_push($newTable, $customObj);
            }
            return   $newTable;
        }
    }

    public function getPostONfield(Request $request)
    {
        $newTable = [];
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        $i = 0;
        $unique_objects = [];

        if ($checkfirst > 0) {
            //  return 'jimmy';
            //REcupere les post de ceux que je suis sur l'application
            $user_id = User::where('remember_token', "=", $request->token)->select('id')->get();
            $email = User::where('remember_token', "=", $request->token)->select('email')->get();
            $fromDB = DB::table(DB::raw("(SELECT * FROM post_tables limit 10) AS t1"))
                ->select(
                    't1.*',
                    'following_systems.*',
                    'following_systems.*',
                    'users__profile__photos.*',
                    'image_video_tables.*',
                    'users.*',
                    'winnings.score as winningsScore',
                    'defeats.score as defeatsScore',
                    'draws.score as drawsScore',
                    'ask_games.id',
                    'ask_games.place_of_game',
                    'ask_games.hours_of_game',
                    'ask_games.date_of_game',
                    'winnings.winner_team',
                    'winnings.winner_team',
                    'defeats.looser_team',
                    't1.created_at as post_tables_created_at',
                    'ask_games.status',
                    'teams.sport_name',
                    't1.id as post_tables_id'
                )
                ->leftJoin('image_video_tables', 't1.id', '=', 'image_video_tables.post_id')
                ->leftJoin('users', 't1.user_id', '=', 'users.id')
                ->leftJoin('users__profile__photos', 'users__profile__photos.email', '=', 'users.email')
                ->join('following_systems', 'users.email', '=', 'following_systems.thefollowed')
                ->leftJoin('ask_games', 'ask_games.id', '=', 't1.title')
                ->leftJoin('winnings', 't1.title', '=', 'winnings.game_id')
                ->leftJoin('defeats', 't1.title', '=', 'defeats.game_id')
                ->leftJoin('draws', 't1.title', '=', 'draws.game_id')
                ->leftJoin('teams', 'ask_games.team_of_asker', '=', 'teams.team_name')
                ->where('thefollower', '=', $email[0]->email)
                ->where('thefollowingState', '=',  "isfollowing")
                ->orderByDesc('post_tables_created_at')
                // ->skip($request->page)->take(10)
                ->get()->groupBy('post_tables_id');
        //     return dd($fromDB);
            foreach ($fromDB as $key => $value) {
                $images = [];
                if ($value[0]->type == null) {
                    $unique_objects = [];
                    foreach ($value as $obj) {
                        if (!array_key_exists(intval($obj->title), $unique_objects)) {
                            $unique_objects[intval($obj->title)] = $obj;
                        }
                    }
                    //  return dd($unique_objects;
                    //  return $unique_objects;
                    foreach ($unique_objects as $key => $value) {
                        if ($value->drawsScore == null) {
                            foreach ([$value] as $value__) {
                                $customObj = new \stdClass();
                                $customObj->id = $value__->post_tables_id;
                                $customObj->score1 = $value__->winningsScore;
                                $customObj->score2 = $value__->defeatsScore;
                                $customObj->date_ = $value__->date_of_game;
                                $customObj->hour = $value__->hours_of_game;
                                $customObj->sport = $value__->sport_name;
                                $customObj->place_of_game = $value__->place_of_game;
                                $customObj->equipe1 = $value__->winner_team;
                                $customObj->equipe2 = $value__->looser_team;
                                $logo1 =  Team::where('team_name', "=", $value__->winner_team)->select('logo')->get();
                                $customObj->logo1 =  $logo1[0]->logo;
                                $logo2 =  Team::where('team_name', "=", $value__->looser_team)->select('logo')->get();
                                $customObj->logo2 =  $logo2[0]->logo;
                                $customObj->postType = "automatique";
                                $customObj->description = "Ce match a eu lieu à " . $value__->place_of_game;
                                $countLikes =  like::where('post_id', "=", $value__->post_tables_id)->count();
                                $customObj->likes = $countLikes;

                                /************************ */
                                $getGlobalPOstableIDs = PostTable::where('title', "=", $value__->title)->select('id')->get();
                                $getGlobalPOstableIDsTable = [];
                                foreach ($getGlobalPOstableIDs  as  $valueIDS) {
                                    array_push($getGlobalPOstableIDsTable, $valueIDS->id);
                                }

                                $getCommentID =  Comment::whereIn('post_id', $getGlobalPOstableIDsTable)->select('id')->get();
                                $idCommentsTable = [];
                                foreach ($getCommentID as $key => $value) {
                                    array_push($idCommentsTable, $value->id);
                                }
                                $countComments =  Comment::whereIn('post_id', $getGlobalPOstableIDsTable)->count() +  sub_comments_table::whereIn('main_comment_id', $idCommentsTable)->count();
                                $customObj->comments = $countComments;
                                /** */
                                /************************ */

                                $meLikes =  like::where('post_id', "=",  $value__->post_tables_id)->where('who_liked_id', "=", $user_id[0]->id)->count();
                                if ($meLikes > 0) {
                                    $customObj->meLikes = true;
                                } else {
                                    $customObj->meLikes = false;
                                }
                                $customObj->posterImage = $value__->image;
                                $commentsDate = PostTable::where('id', "=", $value__->post_tables_id)->select("created_at")->get();
                                $customObj->date = $commentsDate[0]->created_at;
                            }
                        } else {
                            $customObj = new \stdClass();
                            foreach ([$value] as $value__) {
                                $customObj = new \stdClass();
                                $customObj->id = $value__->post_tables_id;
                                $customObj->score1 = $value__->drawsScore;
                                $customObj->score2 = $value__->drawsScore;
                                $customObj->date_ = $value__->date_of_game;
                                $customObj->hour = $value__->hours_of_game;
                                $customObj->sport = $value__->sport_name;
                                $customObj->place_of_game = $value__->place_of_game;
                                $draws__ = draw::where('game_id', "=", $value__->id)->select('*')->get();
                                $customObj->equipe1 = $draws__[0]->team;
                                $customObj->equipe2 = $draws__[1]->team;
                                $logo1 =  Team::where('team_name', "=",  $draws__[0]->team)->select('logo')->get();
                                $customObj->logo1 =  $logo1[0]->logo;
                                $logo2 =  Team::where('team_name', "=", $draws__[1]->team)->select('logo')->get();
                                $customObj->logo2 =  $logo2[0]->logo;
                                $customObj->postType = "automatique";
                                $customObj->description = "Ce match a eu lieu à " . $value__->place_of_game;
                                $countLikes =  like::where('post_id', "=", $value__->post_tables_id)->count();
                                $customObj->likes = $countLikes;

                                /************************ */
                                $getGlobalPOstableIDs = PostTable::where('title', "=", $value__->title)->select('id')->get();
                                $getGlobalPOstableIDsTable = [];
                                foreach ($getGlobalPOstableIDs  as  $valueIDS) {
                                    array_push($getGlobalPOstableIDsTable, $valueIDS->id);
                                }

                                $getCommentID =  Comment::whereIn('post_id', $getGlobalPOstableIDsTable)->select('id')->get();
                                $idCommentsTable = [];
                                foreach ($getCommentID as $key => $value) {
                                    array_push($idCommentsTable, $value->id);
                                }
                                $countComments =  Comment::whereIn('post_id', $getGlobalPOstableIDsTable)->count() +  sub_comments_table::whereIn('main_comment_id', $idCommentsTable)->count();
                                $customObj->comments = $countComments;
                                /** */
                                /************************ */

                                $meLikes =  like::where('post_id', "=",  $value__->post_tables_id)->where('who_liked_id', "=", $user_id[0]->id)->count();
                                if ($meLikes > 0) {
                                    $customObj->meLikes = true;
                                } else {
                                    $customObj->meLikes = false;
                                }
                                $customObj->posterImage = $value__->image;

                                $commentsDate = PostTable::where('id', "=", $value__->post_tables_id)->select("created_at")->get();
                                $customObj->date = $commentsDate[0]->created_at;
                            }
                        }
                        array_push($newTable, $customObj);
                    }
                } else if ($value[0]->type != null) {

                    $customObj = new \stdClass();
                    $customObj->id = $key;
                    $countLikes =  like::where('post_id', "=", $key)->count();
                    $customObj->likes = $countLikes;

                    /************************ */
                    $getCommentID =  Comment::where('post_id', "=", $key)->select('id')->get();
                    $idCommentsTable = [];
                    foreach ($getCommentID as  $valueO) {
                        array_push($idCommentsTable, $valueO->id);
                    }
                    $countComments =  Comment::where('post_id', "=", $key)->count() +  sub_comments_table::whereIn('main_comment_id', $idCommentsTable)->count();
                    $customObj->comments = $countComments;
                    /************************ */

                    $commentsDate = PostTable::where('id', "=", $key)->select("created_at")->get();
                    $customObj->date = $commentsDate[0]->created_at;

                    $meLikes =  like::where('post_id', "=", $key)->where('who_liked_id', "=", $user_id[0]->id)->count();
                    if ($meLikes > 0) {
                        $customObj->meLikes = true;
                    } else {
                        $customObj->meLikes = false;
                    }

                    foreach ($fromDB[$key] as $key__ => $value__) {
                        $imagesObj = new \stdClass();
                        $imagesObj->image = $value__->link;
                        $imagesObj->id = $i;

                        if (Storage::disk('public')->exists(explode("public", $value__->link)[1])) {
                            $img_size = getimagesize(storage_path('app/' . $value__->link));
                        } else {
                            $img_size = false;
                        }

                        if ($img_size != false) {
                            $imagesObj->imageDimension = intval($img_size["0"])  / intval($img_size["1"]);
                        } else {
                            $imagesObj->imageDimension = false;
                        }
                        array_push($images, $imagesObj);
                        $customObj->images = $images;
                        $customObj->description = $value__->title;
                        $customObj->postType = "regular";
                        $customObj->city = $value__->city;
                        $customObj->country = $value__->country;
                        $customObj->posterName = $value__->lastname . " " . $value__->name;
                        $customObj->posterImage = $value__->image;
                        $customObj->email = $value__->email;

                        $i++;
                    }
                    $i = 0;
                    array_push($newTable, $customObj);
                }
            }
            return   $newTable;
        }
        return "not connected";
    }


    public function addLikes(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $user_id = User::where('remember_token', "=", $request->token)->select('id')->get();
            $checklikes =  like::where('who_liked_id', "=", $user_id[0]->id)->where('post_id', "=", $request->post_id)->count();
            if ($checklikes  > 0) {
                like::where('who_liked_id', "=", $user_id[0]->id)->where('post_id', "=", $request->post_id)->delete();
                echo "vous venez de dislikez ce post";
            } else {
                $likes = new like();
                $likes->post_id =  $request->post_id;
                $likes->who_liked_id =  $user_id[0]->id;
                $likes->save();
                echo "vous venez de likez ce post";
            }
        }
    }

    public function addComments(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $user_id = User::where('remember_token', "=", $request->token)->select('id')->get();
            $comments = new Comment();
            $comments->post_id =  $request->post_id;
            $comments->comment =  $request->comment;
            $comments->who_commented_id =  $user_id[0]->id;
            $comments->save();
            return "good";
        } else {
            return "not connected";
        }
    }

    public function addSubComments(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            // if ($request->position == 'first') {
            $user_id = User::where('remember_token', "=", $request->token)->select('id')->get();
            $subcomments = new sub_comments_table();
            $subcomments->comments = $request->comment;
            $subcomments->who_commented_id = $user_id[0]->id;
            $subcomments->main_comment_id = $request->main_comment_id;
            $subcomments->comment_id = 0;
            $subcomments->save();
            // sub_comments_table::where('id', "=", $subcomments->id)->update(["comment_id" => $subcomments->id]);
            // }
            return 'good';
        } else {
            return "not connected";
        }
    }

    public function addSubComments_sub(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $user_id = User::where('remember_token', "=", $request->token)->select('id')->get();
            $subcomments = new sub_comments_table();
            $subcomments->comments = $request->comment;
            $subcomments->who_commented_id = $user_id[0]->id;
            $subcomments->main_comment_id = $request->main_comment_id;
            $subcomments->comment_id = $request->comment_id;
            $subcomments->save();
        } else {
            return "not connected";
        }
    }

    public function getLikesAndCommentsCount(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $countLikes =  like::where('post_id', "=", $request->id)->count();
            $getCommentID =  Comment::where('post_id', "=", $request->id)->select('id')->get();
            $user_id = User::where('remember_token', "=", $request->token)->select('id')->get();
            $idCommentsTable = [];
            foreach ($getCommentID as  $valueO) {
                array_push($idCommentsTable, $valueO->id);
            }
            $countComments =  Comment::where('post_id', "=", $request->id)->count() +  sub_comments_table::whereIn('main_comment_id', $idCommentsTable)->count();
            $meLikes =  like::where('post_id', "=", $request->id)->where('who_liked_id', "=", $user_id[0]->id)->count();
            $meLikesState = null;
            if ($meLikes > 0) {
                $meLikesState = true;
            } else {
                $meLikesState = false;
            }
            $table = [$countLikes, $countComments, $meLikesState];
            return $table;
        } else {
            return "not connected";
        }
    }

    public function getComments(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $getMainComments = null;
            $user_id = User::where('remember_token', "=", $request->token)->select('id')->get();
            if ($request->postType == 'automatique') {
                $postyIDTitle =   PostTable::where('id', "=", $request->post_id)->select('title')->get();
                $postyIDTitleTable = PostTable::where('title', "=", $postyIDTitle[0]->title)->select('id')->get();
                $ids = [];
                foreach ($postyIDTitleTable as $value) {
                    array_push($ids, $value->id);
                }
                $getMainComments =  Comment::join('users', "users.id", "=", "comments.who_commented_id")
                    ->join('users__profile__photos', "users__profile__photos.email", "=", "users.email")
                    ->whereIn('post_id',   $ids)->select(["comment", "image", "post_id", "comments.created_at", "users.name", "users.lastname", "comments.id"])
                    ->skip($request->page)->take(10)->get();
            } else {
                $getMainComments =  Comment::join('users', "users.id", "=", "comments.who_commented_id")
                    ->join('users__profile__photos', "users__profile__photos.email", "=", "users.email")
                    ->where('post_id', "=", $request->post_id)->select(["comment", "image", "post_id", "comments.created_at", "users.name", "users.lastname", "comments.id"])
                    ->skip($request->page)->take(10)->get();
            }
            $newTable = [];
            foreach ($getMainComments  as $key => $value) {
                $count = sub_comments_table::where('main_comment_id', '=', $value->id)->count();
                $customObj = new \stdClass();
                $customObj->totalSubComment = $count;
                $customObj->comment =  $value->comment;
                $customObj->image =  $value->image;
                $customObj->post_id =  $value->post_id;
                $customObj->created_at =  $value->created_at;
                $customObj->name =  $value->name;
                $customObj->lastname =  $value->lastname;
                $customObj->id =  $value->id;
                $meLikes = CommentLike::where('comment_id', "=", $value->id)->where('who_liked_id', "=", $user_id[0]->id)->count();
                if ($meLikes > 0) {
                    $customObj->meLikes = true;
                } else {
                    $customObj->meLikes = false;
                }
                $customObj->countLikes =  CommentLike::where('comment_id', "=", $value->id)->count();
                array_push($newTable, $customObj);
            }
            return  $newTable;
        } else {
            return "not connected";
        }
    }

    public function loadSubComments(Request $request) // Load first subComments of main comments
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        $user_id = User::where('remember_token', "=", $request->token)->select('id')->get();
        if ($checkfirst > 0) {
            $comments =  sub_comments_table::join('users', "users.id", "=", "sub_comments_tables.who_commented_id")
                ->join('users__profile__photos', "users__profile__photos.email", "=", "users.email")
                // ->whereRaw('comment_id = 0')
                ->where('main_comment_id', "=", $request->main_comment_id)->select(["comments", "image",  "sub_comments_tables.created_at", "users.name", "users.lastname", "sub_comments_tables.id"])->get();
            $newTable = [];
            foreach ($comments  as $key => $value) {
                $count = sub_comments_table::where('comment_id', '=', $value->id)->count();
                $customObj = new \stdClass();
                $customObj->totalSubComment = $count;
                $customObj->comment =  $value->comments;
                $customObj->image =  $value->image;
                $customObj->created_at =  $value->created_at;
                $customObj->name =  $value->name;
                $customObj->lastname =  $value->lastname;
                $customObj->id =  $value->id;

                $meLikes = SubCommentsLikes::where('comment_id', "=", $value->id)->where('who_liked_id', "=", $user_id[0]->id)->count();
                if ($meLikes > 0) {
                    $customObj->meLikes = true;
                } else {
                    $customObj->meLikes = false;
                }
                $customObj->countLikes =  SubCommentsLikes::where('comment_id', "=", $value->id)->count();
                array_push($newTable, $customObj);
            }
            return  $newTable;
        } else {
            return "not connected";
        }
    }

    // public function loadSubComments_sub(Request $request) // Load first subComments of main comments
    // {
    //     $comments =  sub_comments_table::join('users', "users.id", "=", "sub_comments_tables.who_commented_id")
    //         ->join('users__profile__photos', "users__profile__photos.email", "=", "users.email")
    //         ->where('comment_id', "=", $request->comment_id)->select(["comments", "image",  "sub_comments_tables.created_at", "users.name", "users.lastname", "sub_comments_tables.id"])->get();

    //     $newTable = [];
    //     foreach ($comments  as $key => $value) {
    //         $count = sub_comments_table::where('comment_id', '=', $value->id)->count();
    //         $customObj = new \stdClass();
    //         $customObj->totalSubComment = $count;
    //         $customObj->comment =  $value->comments;
    //         $customObj->image =  $value->image;
    //         // $customObj->post_id =  $value->post_id;
    //         $customObj->created_at =  $value->created_at;
    //         $customObj->name =  $value->name;
    //         $customObj->lastname =  $value->lastname;
    //         $customObj->id =  $value->id;
    //         array_push($newTable, $customObj);
    //     }
    //     return  $newTable;
    // }

    public function addCommentsLikes(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $user_id = User::where('remember_token', "=", $request->token)->select('id')->get();
            $checklikes =  CommentLike::where('who_liked_id', "=", $user_id[0]->id)->where('comment_id', "=", $request->comment_id)->count();
            if ($checklikes  > 0) {
                CommentLike::where('who_liked_id', "=", $user_id[0]->id)->where('comment_id', "=", $request->comment_id)->delete();
                echo "vous venez de dislikez ce commentaire";
            } else {
                $likes = new CommentLike();
                $likes->comment_id =  $request->comment_id;
                $likes->who_liked_id =  $user_id[0]->id;
                $likes->save();
                echo "vous venez de likez ce commentaire";
            }
        }
    }

    public function addSubCommentsLikes(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->token)->count();
        if ($checkfirst > 0) {
            $user_id = User::where('remember_token', "=", $request->token)->select('id')->get();
            $checklikes =  SubCommentsLikes::where('who_liked_id', "=", $user_id[0]->id)->where('comment_id', "=", $request->comment_id)->count();
            if ($checklikes  > 0) {
                SubCommentsLikes::where('who_liked_id', "=", $user_id[0]->id)->where('comment_id', "=", $request->comment_id)->delete();
                echo "vous venez de dislikez ce sous commentaire";
            } else {
                $likes = new SubCommentsLikes();
                $likes->main_comment_id =  $request->main_comment_id; // id
                $likes->comment_id =  $request->comment_id; // currentID
                $likes->who_liked_id =  $user_id[0]->id;
                $likes->save();
                echo "vous venez de likez ce sous commentaire";
            }
        }
    }
}
