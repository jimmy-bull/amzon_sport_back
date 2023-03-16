<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'created_at' => '2023-02-17 13:34:33',
                'email' => 'jbull635@gmail.com',
                'id' => 716,
            'message' => 'thetrackmonster Jordan vous a envoyé(é) une demande de match !',
                'notification_actions' => 'GameAsked_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:50:41',
                'who_sent_notification' => 'thetrackmonster@gmail.com',
            ),
            1 => 
            array (
                'created_at' => '2023-02-17 13:34:47',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 717,
                'message' => 'Real Team a acceptée votre demande de match',
                'notification_actions' => 'GameAsked_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:49:07',
                'who_sent_notification' => 'jbull635@gmail.com',
            ),
            2 => 
            array (
                'created_at' => '2023-02-17 13:35:08',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 718,
                'message' => 'Real Team viens d\'entré le score du match qui s\'est déroulé à Babi.Score du match: 4-2 pour Real Team',
                'notification_actions' => 'GameAsked_actions_score',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:49:07',
                'who_sent_notification' => 'jbull635@gmail.com',
            ),
            3 => 
            array (
                'created_at' => '2023-02-17 13:35:15',
                'email' => 'jbull635@gmail.com',
                'id' => 719,
            'message' => 'Monster foot a refusée de valider le score que vous avez rentré(e) pour le match qui c\'est deroulé à Babi',
                'notification_actions' => 'GameAsked_actions_score_finish',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:50:41',
                'who_sent_notification' => 'thetrackmonster@gmail.com',
            ),
            4 => 
            array (
                'created_at' => '2023-02-17 13:35:54',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 720,
                'message' => 'Real Team viens d\'entré le score du match qui s\'est déroulé à Babi. Score du match: 3-3. Match null!',
                'notification_actions' => 'GameAsked_actions_score',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:49:07',
                'who_sent_notification' => 'jbull635@gmail.com',
            ),
            5 => 
            array (
                'created_at' => '2023-02-17 13:36:03',
                'email' => 'jbull635@gmail.com',
                'id' => 721,
                'message' => 'Monster footViens valider le score du match qui ces deroulé a Babi',
                'notification_actions' => 'GameAsked_actions_score_finish',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:50:41',
                'who_sent_notification' => 'thetrackmonster@gmail.com',
            ),
            6 => 
            array (
                'created_at' => '2023-02-17 13:36:48',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 722,
            'message' => 'jimmy Bull a commencé(e) a vous suivre ! Vous pouvez commencer à discuter ou encore à organiser des compétitions !',
                'notification_actions' => 'follow_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:49:07',
                'who_sent_notification' => 'jbull635@gmail.com',
            ),
            7 => 
            array (
                'created_at' => '2023-02-17 13:36:53',
                'email' => 'jbull635@gmail.com',
                'id' => 723,
            'message' => 'thetrackmonster Jordan a commencé(e) a vous suivre ! Vous pouvez commencer à discuter ou encore à organiser des compétitions !',
                'notification_actions' => 'follow_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:50:41',
                'who_sent_notification' => 'thetrackmonster@gmail.com',
            ),
            8 => 
            array (
                'created_at' => '2023-03-15 18:38:27',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 724,
            'message' => 'Jimmy Bull vous a envoyé(é) une demande de match !',
                'notification_actions' => 'GameAsked_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:49:07',
                'who_sent_notification' => 'jbull635@gmail.com',
            ),
            9 => 
            array (
                'created_at' => '2023-03-15 18:38:55',
                'email' => 'jbull635@gmail.com',
                'id' => 725,
                'message' => 'Trackfoot a acceptée votre demande de match',
                'notification_actions' => 'GameAsked_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:50:41',
                'who_sent_notification' => 'thetrackmonster@gmail.com',
            ),
            10 => 
            array (
                'created_at' => '2023-03-15 18:39:34',
                'email' => 'jbull635@gmail.com',
                'id' => 726,
                'message' => 'Trackfoot viens d\'entré le score du match qui s\'est déroulé à Paris . Score du match: 2-3 pour Real Team',
                'notification_actions' => 'GameAsked_actions_score',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:50:41',
                'who_sent_notification' => 'thetrackmonster@gmail.com',
            ),
            11 => 
            array (
                'created_at' => '2023-03-15 18:39:40',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 727,
            'message' => 'Real Team a refusée de valider le score que vous avez rentré(e) pour le match qui c\'est deroulé à Paris',
                'notification_actions' => 'GameAsked_actions_score_finish',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:49:07',
                'who_sent_notification' => 'jbull635@gmail.com',
            ),
            12 => 
            array (
                'created_at' => '2023-03-15 18:40:07',
                'email' => 'jbull635@gmail.com',
                'id' => 728,
                'message' => 'Trackfoot viens d\'entré le score du match qui s\'est déroulé à Paris . Score du match: 3-3. Match null!',
                'notification_actions' => 'GameAsked_actions_score',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:50:41',
                'who_sent_notification' => 'thetrackmonster@gmail.com',
            ),
            13 => 
            array (
                'created_at' => '2023-03-15 18:40:16',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 729,
                'message' => 'Real TeamViens valider le score du match qui ces deroulé a Paris',
                'notification_actions' => 'GameAsked_actions_score_finish',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:49:07',
                'who_sent_notification' => 'jbull635@gmail.com',
            ),
            14 => 
            array (
                'created_at' => '2023-03-15 18:43:38',
                'email' => 'jbull635@gmail.com',
                'id' => 730,
            'message' => 'Jimmy Bully vous a envoyé(é) une demande de match !',
                'notification_actions' => 'GameAsked_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:50:41',
                'who_sent_notification' => 'thetrackmonster@gmail.com',
            ),
            15 => 
            array (
                'created_at' => '2023-03-15 18:43:47',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 731,
                'message' => 'Real Team a acceptée votre demande de match',
                'notification_actions' => 'GameAsked_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:49:07',
                'who_sent_notification' => 'jbull635@gmail.com',
            ),
            16 => 
            array (
                'created_at' => '2023-03-15 18:44:10',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 732,
                'message' => 'Real Team viens d\'entré le score du match qui s\'est déroulé à Caen. Score du match: 2-3 pour Trackfoot',
                'notification_actions' => 'GameAsked_actions_score',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:49:07',
                'who_sent_notification' => 'jbull635@gmail.com',
            ),
            17 => 
            array (
                'created_at' => '2023-03-15 18:44:25',
                'email' => 'jbull635@gmail.com',
                'id' => 733,
                'message' => 'TrackfootViens valider le score du match qui ces deroulé a Caen',
                'notification_actions' => 'GameAsked_actions_score_finish',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:50:41',
                'who_sent_notification' => 'thetrackmonster@gmail.com',
            ),
            18 => 
            array (
                'created_at' => '2023-03-15 19:32:29',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 734,
            'message' => 'Jimmy Bull a commencé(e) a vous suivre ! Vous pouvez commencer à discuter ou encore à organiser des compétitions !',
                'notification_actions' => 'follow_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:49:07',
                'who_sent_notification' => 'jbull635@gmail.com',
            ),
            19 => 
            array (
                'created_at' => '2023-03-15 20:43:19',
                'email' => 'jbull635@gmail.com',
                'id' => 735,
                'message' => 'Jimmy Bully veut rejoindre votre équipe de Baseball!',
                'notification_actions' => 'integration_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:50:41',
                'who_sent_notification' => 'thetrackmonster@gmail.com',
            ),
            20 => 
            array (
                'created_at' => '2023-03-15 20:43:34',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 736,
            'message' => 'Jimmy Bull a accepté(e) votre demande d\'intégration dans son équipe Jimmybase!',
                'notification_actions' => 'no_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:49:07',
                'who_sent_notification' => 'jbull635@gmail.com',
            ),
            21 => 
            array (
                'created_at' => '2023-03-15 20:48:59',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 737,
            'message' => 'Jimmy Bull a commencé(e) a vous suivre ! Vous pouvez commencer à discuter ou encore à organiser des compétitions !',
                'notification_actions' => 'follow_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:49:07',
                'who_sent_notification' => 'jbull635@gmail.com',
            ),
            22 => 
            array (
                'created_at' => '2023-03-15 20:50:38',
                'email' => 'jbull635@gmail.com',
                'id' => 738,
            'message' => 'Jimmy Bully a commencé(e) a vous suivre ! Vous pouvez commencer à discuter ou encore à organiser des compétitions !',
                'notification_actions' => 'follow_actions',
                'state' => 'readed',
                'updated_at' => '2023-03-15 20:50:41',
                'who_sent_notification' => 'thetrackmonster@gmail.com',
            ),
        ));
        
        
    }
}