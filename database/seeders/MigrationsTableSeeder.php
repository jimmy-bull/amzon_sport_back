<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'batch' => 1,
                'id' => 1,
                'migration' => '2014_10_12_000000_create_users_table',
            ),
            1 => 
            array (
                'batch' => 2,
                'id' => 5,
                'migration' => '2022_05_30_104918_add_more_field_to_users_table',
            ),
            2 => 
            array (
                'batch' => 3,
                'id' => 6,
                'migration' => '2022_05_31_110258_add_migration_for__post_table',
            ),
            3 => 
            array (
                'batch' => 4,
                'id' => 7,
                'migration' => '2022_05_31_110944_create_testusers_table',
            ),
            4 => 
            array (
                'batch' => 5,
                'id' => 8,
                'migration' => '2022_05_31_115218_create_myposts_table',
            ),
            5 => 
            array (
                'batch' => 6,
                'id' => 9,
                'migration' => '2022_05_31_133909_create_posts_table',
            ),
            6 => 
            array (
                'batch' => 0,
                'id' => 10,
                'migration' => '2022_06_23_165236_create_failed_jobs_table',
            ),
            7 => 
            array (
                'batch' => 0,
                'id' => 11,
                'migration' => '2022_06_23_165236_create_myposts_table',
            ),
            8 => 
            array (
                'batch' => 0,
                'id' => 12,
                'migration' => '2022_06_23_165236_create_password_resets_table',
            ),
            9 => 
            array (
                'batch' => 0,
                'id' => 13,
                'migration' => '2022_06_23_165236_create_personal_access_tokens_table',
            ),
            10 => 
            array (
                'batch' => 0,
                'id' => 14,
                'migration' => '2022_06_23_165236_create_Post_table',
            ),
            11 => 
            array (
                'batch' => 0,
                'id' => 15,
                'migration' => '2022_06_23_165236_create_posts_table',
            ),
            12 => 
            array (
                'batch' => 0,
                'id' => 16,
                'migration' => '2022_06_23_165236_create_testusers_table',
            ),
            13 => 
            array (
                'batch' => 0,
                'id' => 17,
                'migration' => '2022_06_23_165236_create_users_table',
            ),
            14 => 
            array (
                'batch' => 7,
                'id' => 102,
                'migration' => '0000_00_00_000000_create_websockets_statistics_entries_table',
            ),
            15 => 
            array (
                'batch' => 7,
                'id' => 103,
                'migration' => '2014_10_12_100000_create_password_resets_table',
            ),
            16 => 
            array (
                'batch' => 7,
                'id' => 104,
                'migration' => '2019_08_19_000000_create_failed_jobs_table',
            ),
            17 => 
            array (
                'batch' => 7,
                'id' => 105,
                'migration' => '2019_12_14_000001_create_personal_access_tokens_table',
            ),
            18 => 
            array (
                'batch' => 7,
                'id' => 106,
                'migration' => '2022_03_22_101130_create_bid_data_table',
            ),
            19 => 
            array (
                'batch' => 7,
                'id' => 107,
                'migration' => '2022_03_25_185913_create_attrs_table',
            ),
            20 => 
            array (
                'batch' => 7,
                'id' => 108,
                'migration' => '2022_04_04_114047_create_favoris_table',
            ),
            21 => 
            array (
                'batch' => 7,
                'id' => 109,
                'migration' => '2022_04_10_180250_create_category_attributes_table',
            ),
            22 => 
            array (
                'batch' => 7,
                'id' => 110,
                'migration' => '2022_04_12_184156_create_attribute_ways_table',
            ),
            23 => 
            array (
                'batch' => 7,
                'id' => 111,
                'migration' => '2022_04_15_142335_create_estimations_table',
            ),
            24 => 
            array (
                'batch' => 7,
                'id' => 112,
                'migration' => '2022_04_18_065656_create_categories_table',
            ),
            25 => 
            array (
                'batch' => 7,
                'id' => 113,
                'migration' => '2022_04_18_071142_create_media_table',
            ),
            26 => 
            array (
                'batch' => 7,
                'id' => 114,
                'migration' => '2022_04_18_071531_create_details_table',
            ),
            27 => 
            array (
                'batch' => 7,
                'id' => 115,
                'migration' => '2022_04_18_071955_create_main_products_table',
            ),
            28 => 
            array (
                'batch' => 7,
                'id' => 116,
                'migration' => '2022_04_19_074023_add_user_email_to_main_products_table',
            ),
            29 => 
            array (
                'batch' => 7,
                'id' => 117,
                'migration' => '2022_04_21_141822_add_status_to_main_products_table',
            ),
            30 => 
            array (
                'batch' => 7,
                'id' => 118,
                'migration' => '2022_04_22_152624_create_auction_dates_table',
            ),
            31 => 
            array (
                'batch' => 7,
                'id' => 119,
                'migration' => '2022_04_22_220132_add_article_id_to_auction_dates',
            ),
            32 => 
            array (
                'batch' => 7,
                'id' => 120,
                'migration' => '2022_04_30_092920_create_bid_augmentations_table',
            ),
            33 => 
            array (
                'batch' => 7,
                'id' => 121,
                'migration' => '2022_05_12_135229_create_details_descs_table',
            ),
            34 => 
            array (
                'batch' => 7,
                'id' => 122,
                'migration' => '2022_05_25_083415_create_verifications_table',
            ),
            35 => 
            array (
                'batch' => 7,
                'id' => 123,
                'migration' => '2022_05_25_094142_change_verification_code_end_to_timestamp_in_verifications_table',
            ),
            36 => 
            array (
                'batch' => 7,
                'id' => 124,
                'migration' => '2022_05_25_094652_change_description_to_text_in_main_products_table',
            ),
            37 => 
            array (
                'batch' => 7,
                'id' => 125,
                'migration' => '2022_05_26_165916_change_verification_code_column_in_verifications_table',
            ),
            38 => 
            array (
                'batch' => 7,
                'id' => 126,
                'migration' => '2022_06_12_123239_create_user_status_products_table',
            ),
            39 => 
            array (
                'batch' => 7,
                'id' => 127,
                'migration' => '2022_06_16_082204_create_user_status_product_losts_table',
            ),
            40 => 
            array (
                'batch' => 7,
                'id' => 128,
                'migration' => '2022_06_16_083751_create_article_solds_table',
            ),
            41 => 
            array (
                'batch' => 7,
                'id' => 129,
                'migration' => '2022_06_16_084850_create_article_losts_table',
            ),
            42 => 
            array (
                'batch' => 8,
                'id' => 130,
                'migration' => '2022_06_26_124949_create_users__profile__photos_table',
            ),
            43 => 
            array (
                'batch' => 9,
                'id' => 131,
                'migration' => '2022_06_27_184707_create_teams_table',
            ),
            44 => 
            array (
                'batch' => 10,
                'id' => 132,
                'migration' => '2022_07_01_123857_add_more_column_to_users_table',
            ),
            45 => 
            array (
                'batch' => 11,
                'id' => 133,
                'migration' => '2022_07_08_133651_create_testing_tables_table',
            ),
            46 => 
            array (
                'batch' => 12,
                'id' => 134,
                'migration' => '2022_07_08_140502_create_bigs_table',
            ),
            47 => 
            array (
                'batch' => 13,
                'id' => 135,
                'migration' => '2022_07_21_103422_create_following_systems_table',
            ),
            48 => 
            array (
                'batch' => 14,
                'id' => 136,
                'migration' => '2022_07_21_110525_create_notifications_table',
            ),
            49 => 
            array (
                'batch' => 15,
                'id' => 137,
                'migration' => '2022_07_28_111225_create_notification_tokens_table',
            ),
            50 => 
            array (
                'batch' => 16,
                'id' => 138,
                'migration' => '2022_07_30_175635_add_notification_state',
            ),
            51 => 
            array (
                'batch' => 17,
                'id' => 139,
                'migration' => '2022_08_20_103545_add_wo_sent_notification_column',
            ),
            52 => 
            array (
                'batch' => 18,
                'id' => 140,
                'migration' => '2022_08_24_141913_create_ask_games_table',
            ),
            53 => 
            array (
                'batch' => 19,
                'id' => 141,
                'migration' => '2022_08_25_120607_create_teammembers_table',
            ),
            54 => 
            array (
                'batch' => 20,
                'id' => 142,
                'migration' => '2022_08_26_182221_add_foreign_key_to_teammembers_table',
            ),
            55 => 
            array (
                'batch' => 20,
                'id' => 143,
                'migration' => '2022_08_31_102838_add_status_to_ask_games_table',
            ),
            56 => 
            array (
                'batch' => 21,
                'id' => 144,
                'migration' => '2022_09_01_070313_create_defeats_table',
            ),
            57 => 
            array (
                'batch' => 22,
                'id' => 145,
                'migration' => '2022_09_01_070829_create_winnings_table',
            ),
            58 => 
            array (
                'batch' => 23,
                'id' => 146,
                'migration' => '2022_09_01_072355_create_draws_table',
            ),
            59 => 
            array (
                'batch' => 24,
                'id' => 147,
                'migration' => '2022_09_01_103445_add_score_2_column_to_winnings_table',
            ),
            60 => 
            array (
                'batch' => 25,
                'id' => 148,
                'migration' => '2022_09_03_103326_add_score_2_column_to_defeats_table',
            ),
            61 => 
            array (
                'batch' => 26,
                'id' => 149,
                'migration' => '2022_09_20_133631_create_team_rates_table',
            ),
            62 => 
            array (
                'batch' => 27,
                'id' => 150,
                'migration' => '2022_09_21_085257_add_status_column_to_team_rates_table',
            ),
            63 => 
            array (
                'batch' => 28,
                'id' => 151,
                'migration' => '2022_09_21_091153_add_teamrated_name_column_to_team_rates_table',
            ),
            64 => 
            array (
                'batch' => 29,
                'id' => 152,
                'migration' => '2022_09_21_092705_add_status_column_to_winning_table',
            ),
            65 => 
            array (
                'batch' => 30,
                'id' => 153,
                'migration' => '2022_09_21_092958_add_status_column_to_defeats_table',
            ),
            66 => 
            array (
                'batch' => 31,
                'id' => 154,
                'migration' => '2022_09_21_095147_add_status_column_to_draws_table',
            ),
            67 => 
            array (
                'batch' => 32,
                'id' => 155,
                'migration' => '2022_09_24_121247_add_game_id_column_to_team_rate_table',
            ),
            68 => 
            array (
                'batch' => 33,
                'id' => 156,
                'migration' => '2022_09_24_121520_add_foreign_game_id_column_to_team_rate_table',
            ),
            69 => 
            array (
                'batch' => 34,
                'id' => 157,
                'migration' => '2022_09_24_121850_add_foreign_game_id_2_column_to_team_rate_table',
            ),
            70 => 
            array (
                'batch' => 35,
                'id' => 158,
                'migration' => '2022_09_24_122019_add_foreign_game_id_3_column_to_team_rate_table',
            ),
            71 => 
            array (
                'batch' => 36,
                'id' => 159,
                'migration' => '2022_10_08_103849_create_post_tables_table',
            ),
            72 => 
            array (
                'batch' => 37,
                'id' => 160,
                'migration' => '2022_10_08_104611_create_image_video_tables_table',
            ),
            73 => 
            array (
                'batch' => 38,
                'id' => 161,
                'migration' => '2022_10_08_120425_create_comments_table',
            ),
            74 => 
            array (
                'batch' => 38,
                'id' => 162,
                'migration' => '2022_10_08_120815_change_post_tables_title_column_to_long_text_table',
            ),
            75 => 
            array (
                'batch' => 39,
                'id' => 163,
                'migration' => '2022_10_08_121522_create_likes_table',
            ),
            76 => 
            array (
                'batch' => 40,
                'id' => 164,
                'migration' => '2022_12_06_103106_create_subcomments_table',
            ),
            77 => 
            array (
                'batch' => 41,
                'id' => 165,
                'migration' => '2022_12_06_105526_add_main_comment_column_to_subcomments_table',
            ),
            78 => 
            array (
                'batch' => 42,
                'id' => 166,
                'migration' => '2022_12_06_202800_create_sub_comment_tables_table',
            ),
            79 => 
            array (
                'batch' => 43,
                'id' => 167,
                'migration' => '2022_12_06_205211_create_sub_comments_tables_table',
            ),
            80 => 
            array (
                'batch' => 44,
                'id' => 168,
                'migration' => '2022_12_19_114628_add_post_type_column_to_post_tables_table',
            ),
            81 => 
            array (
                'batch' => 45,
                'id' => 169,
                'migration' => '2022_12_22_123104_create_comment_likes_table',
            ),
            82 => 
            array (
                'batch' => 46,
                'id' => 170,
                'migration' => '2022_12_22_134901_create_sub_comments_likes_table',
            ),
            83 => 
            array (
                'batch' => 47,
                'id' => 171,
                'migration' => '2022_12_22_142558_add_comment_id_column_to_sub_comments_likes_table',
            ),
            84 => 
            array (
                'batch' => 0,
                'id' => 172,
                'migration' => '2023_01_21_132925_create_article_losts_table',
            ),
            85 => 
            array (
                'batch' => 0,
                'id' => 173,
                'migration' => '2023_01_21_132925_create_article_solds_table',
            ),
            86 => 
            array (
                'batch' => 0,
                'id' => 174,
                'migration' => '2023_01_21_132925_create_ask_games_table',
            ),
            87 => 
            array (
                'batch' => 0,
                'id' => 175,
                'migration' => '2023_01_21_132925_create_attribute_ways_table',
            ),
            88 => 
            array (
                'batch' => 0,
                'id' => 176,
                'migration' => '2023_01_21_132925_create_attrs_table',
            ),
            89 => 
            array (
                'batch' => 0,
                'id' => 177,
                'migration' => '2023_01_21_132925_create_auction_dates_table',
            ),
            90 => 
            array (
                'batch' => 0,
                'id' => 178,
                'migration' => '2023_01_21_132925_create_bid_augmentations_table',
            ),
            91 => 
            array (
                'batch' => 0,
                'id' => 179,
                'migration' => '2023_01_21_132925_create_bid_data_table',
            ),
            92 => 
            array (
                'batch' => 0,
                'id' => 180,
                'migration' => '2023_01_21_132925_create_bigs_table',
            ),
            93 => 
            array (
                'batch' => 0,
                'id' => 181,
                'migration' => '2023_01_21_132925_create_categories_table',
            ),
            94 => 
            array (
                'batch' => 0,
                'id' => 182,
                'migration' => '2023_01_21_132925_create_category_attributes_table',
            ),
            95 => 
            array (
                'batch' => 0,
                'id' => 183,
                'migration' => '2023_01_21_132925_create_comment_likes_table',
            ),
            96 => 
            array (
                'batch' => 0,
                'id' => 184,
                'migration' => '2023_01_21_132925_create_comments_table',
            ),
            97 => 
            array (
                'batch' => 0,
                'id' => 185,
                'migration' => '2023_01_21_132925_create_defeats_table',
            ),
            98 => 
            array (
                'batch' => 0,
                'id' => 186,
                'migration' => '2023_01_21_132925_create_details_table',
            ),
            99 => 
            array (
                'batch' => 0,
                'id' => 187,
                'migration' => '2023_01_21_132925_create_details_descs_table',
            ),
            100 => 
            array (
                'batch' => 0,
                'id' => 188,
                'migration' => '2023_01_21_132925_create_draws_table',
            ),
            101 => 
            array (
                'batch' => 0,
                'id' => 189,
                'migration' => '2023_01_21_132925_create_estimations_table',
            ),
            102 => 
            array (
                'batch' => 0,
                'id' => 190,
                'migration' => '2023_01_21_132925_create_failed_jobs_table',
            ),
            103 => 
            array (
                'batch' => 0,
                'id' => 191,
                'migration' => '2023_01_21_132925_create_favoris_table',
            ),
            104 => 
            array (
                'batch' => 0,
                'id' => 192,
                'migration' => '2023_01_21_132925_create_following_systems_table',
            ),
            105 => 
            array (
                'batch' => 0,
                'id' => 193,
                'migration' => '2023_01_21_132925_create_image_video_tables_table',
            ),
            106 => 
            array (
                'batch' => 0,
                'id' => 194,
                'migration' => '2023_01_21_132925_create_likes_table',
            ),
            107 => 
            array (
                'batch' => 0,
                'id' => 195,
                'migration' => '2023_01_21_132925_create_main_products_table',
            ),
            108 => 
            array (
                'batch' => 0,
                'id' => 196,
                'migration' => '2023_01_21_132925_create_media_table',
            ),
            109 => 
            array (
                'batch' => 0,
                'id' => 197,
                'migration' => '2023_01_21_132925_create_myposts_table',
            ),
            110 => 
            array (
                'batch' => 0,
                'id' => 198,
                'migration' => '2023_01_21_132925_create_notification_tokens_table',
            ),
            111 => 
            array (
                'batch' => 0,
                'id' => 199,
                'migration' => '2023_01_21_132925_create_notifications_table',
            ),
            112 => 
            array (
                'batch' => 0,
                'id' => 200,
                'migration' => '2023_01_21_132925_create_password_resets_table',
            ),
            113 => 
            array (
                'batch' => 0,
                'id' => 201,
                'migration' => '2023_01_21_132925_create_personal_access_tokens_table',
            ),
            114 => 
            array (
                'batch' => 0,
                'id' => 202,
                'migration' => '2023_01_21_132925_create_Post_table',
            ),
            115 => 
            array (
                'batch' => 0,
                'id' => 203,
                'migration' => '2023_01_21_132925_create_post_tables_table',
            ),
            116 => 
            array (
                'batch' => 0,
                'id' => 204,
                'migration' => '2023_01_21_132925_create_posts_table',
            ),
            117 => 
            array (
                'batch' => 0,
                'id' => 205,
                'migration' => '2023_01_21_132925_create_sub_comments_likes_table',
            ),
            118 => 
            array (
                'batch' => 0,
                'id' => 206,
                'migration' => '2023_01_21_132925_create_sub_comments_tables_table',
            ),
            119 => 
            array (
                'batch' => 0,
                'id' => 207,
                'migration' => '2023_01_21_132925_create_subcomments_table',
            ),
            120 => 
            array (
                'batch' => 0,
                'id' => 208,
                'migration' => '2023_01_21_132925_create_team_rates_table',
            ),
            121 => 
            array (
                'batch' => 0,
                'id' => 209,
                'migration' => '2023_01_21_132925_create_teammembers_table',
            ),
            122 => 
            array (
                'batch' => 0,
                'id' => 210,
                'migration' => '2023_01_21_132925_create_teams_table',
            ),
            123 => 
            array (
                'batch' => 0,
                'id' => 211,
                'migration' => '2023_01_21_132925_create_testing_tables_table',
            ),
            124 => 
            array (
                'batch' => 0,
                'id' => 212,
                'migration' => '2023_01_21_132925_create_testusers_table',
            ),
            125 => 
            array (
                'batch' => 0,
                'id' => 213,
                'migration' => '2023_01_21_132925_create_user_status_product_losts_table',
            ),
            126 => 
            array (
                'batch' => 0,
                'id' => 214,
                'migration' => '2023_01_21_132925_create_user_status_products_table',
            ),
            127 => 
            array (
                'batch' => 0,
                'id' => 215,
                'migration' => '2023_01_21_132925_create_users_table',
            ),
            128 => 
            array (
                'batch' => 0,
                'id' => 216,
                'migration' => '2023_01_21_132925_create_users__profile__photos_table',
            ),
            129 => 
            array (
                'batch' => 0,
                'id' => 217,
                'migration' => '2023_01_21_132925_create_verifications_table',
            ),
            130 => 
            array (
                'batch' => 0,
                'id' => 218,
                'migration' => '2023_01_21_132925_create_websockets_statistics_entries_table',
            ),
            131 => 
            array (
                'batch' => 0,
                'id' => 219,
                'migration' => '2023_01_21_132925_create_winnings_table',
            ),
            132 => 
            array (
                'batch' => 0,
                'id' => 220,
                'migration' => '2023_01_21_132926_add_foreign_keys_to_comment_likes_table',
            ),
            133 => 
            array (
                'batch' => 0,
                'id' => 221,
                'migration' => '2023_01_21_132926_add_foreign_keys_to_comments_table',
            ),
            134 => 
            array (
                'batch' => 0,
                'id' => 222,
                'migration' => '2023_01_21_132926_add_foreign_keys_to_defeats_table',
            ),
            135 => 
            array (
                'batch' => 0,
                'id' => 223,
                'migration' => '2023_01_21_132926_add_foreign_keys_to_draws_table',
            ),
            136 => 
            array (
                'batch' => 0,
                'id' => 224,
                'migration' => '2023_01_21_132926_add_foreign_keys_to_image_video_tables_table',
            ),
            137 => 
            array (
                'batch' => 0,
                'id' => 225,
                'migration' => '2023_01_21_132926_add_foreign_keys_to_likes_table',
            ),
            138 => 
            array (
                'batch' => 0,
                'id' => 226,
                'migration' => '2023_01_21_132926_add_foreign_keys_to_post_tables_table',
            ),
            139 => 
            array (
                'batch' => 0,
                'id' => 227,
                'migration' => '2023_01_21_132926_add_foreign_keys_to_sub_comments_likes_table',
            ),
            140 => 
            array (
                'batch' => 0,
                'id' => 228,
                'migration' => '2023_01_21_132926_add_foreign_keys_to_sub_comments_tables_table',
            ),
            141 => 
            array (
                'batch' => 0,
                'id' => 229,
                'migration' => '2023_01_21_132926_add_foreign_keys_to_subcomments_table',
            ),
            142 => 
            array (
                'batch' => 0,
                'id' => 230,
                'migration' => '2023_01_21_132926_add_foreign_keys_to_team_rates_table',
            ),
            143 => 
            array (
                'batch' => 0,
                'id' => 231,
                'migration' => '2023_01_21_132926_add_foreign_keys_to_winnings_table',
            ),
            144 => 
            array (
                'batch' => 0,
                'id' => 232,
                'migration' => '2023_01_21_133136_create_article_losts_table',
            ),
            145 => 
            array (
                'batch' => 0,
                'id' => 233,
                'migration' => '2023_01_21_133136_create_article_solds_table',
            ),
            146 => 
            array (
                'batch' => 0,
                'id' => 234,
                'migration' => '2023_01_21_133136_create_ask_games_table',
            ),
            147 => 
            array (
                'batch' => 0,
                'id' => 235,
                'migration' => '2023_01_21_133136_create_attribute_ways_table',
            ),
            148 => 
            array (
                'batch' => 0,
                'id' => 236,
                'migration' => '2023_01_21_133136_create_attrs_table',
            ),
            149 => 
            array (
                'batch' => 0,
                'id' => 237,
                'migration' => '2023_01_21_133136_create_auction_dates_table',
            ),
            150 => 
            array (
                'batch' => 0,
                'id' => 238,
                'migration' => '2023_01_21_133136_create_bid_augmentations_table',
            ),
            151 => 
            array (
                'batch' => 0,
                'id' => 239,
                'migration' => '2023_01_21_133136_create_bid_data_table',
            ),
            152 => 
            array (
                'batch' => 0,
                'id' => 240,
                'migration' => '2023_01_21_133136_create_bigs_table',
            ),
            153 => 
            array (
                'batch' => 0,
                'id' => 241,
                'migration' => '2023_01_21_133136_create_categories_table',
            ),
            154 => 
            array (
                'batch' => 0,
                'id' => 242,
                'migration' => '2023_01_21_133136_create_category_attributes_table',
            ),
            155 => 
            array (
                'batch' => 0,
                'id' => 243,
                'migration' => '2023_01_21_133136_create_comment_likes_table',
            ),
            156 => 
            array (
                'batch' => 0,
                'id' => 244,
                'migration' => '2023_01_21_133136_create_comments_table',
            ),
            157 => 
            array (
                'batch' => 0,
                'id' => 245,
                'migration' => '2023_01_21_133136_create_defeats_table',
            ),
            158 => 
            array (
                'batch' => 0,
                'id' => 246,
                'migration' => '2023_01_21_133136_create_details_table',
            ),
            159 => 
            array (
                'batch' => 0,
                'id' => 247,
                'migration' => '2023_01_21_133136_create_details_descs_table',
            ),
            160 => 
            array (
                'batch' => 0,
                'id' => 248,
                'migration' => '2023_01_21_133136_create_draws_table',
            ),
            161 => 
            array (
                'batch' => 0,
                'id' => 249,
                'migration' => '2023_01_21_133136_create_estimations_table',
            ),
            162 => 
            array (
                'batch' => 0,
                'id' => 250,
                'migration' => '2023_01_21_133136_create_failed_jobs_table',
            ),
            163 => 
            array (
                'batch' => 0,
                'id' => 251,
                'migration' => '2023_01_21_133136_create_favoris_table',
            ),
            164 => 
            array (
                'batch' => 0,
                'id' => 252,
                'migration' => '2023_01_21_133136_create_following_systems_table',
            ),
            165 => 
            array (
                'batch' => 0,
                'id' => 253,
                'migration' => '2023_01_21_133136_create_image_video_tables_table',
            ),
            166 => 
            array (
                'batch' => 0,
                'id' => 254,
                'migration' => '2023_01_21_133136_create_likes_table',
            ),
            167 => 
            array (
                'batch' => 0,
                'id' => 255,
                'migration' => '2023_01_21_133136_create_main_products_table',
            ),
            168 => 
            array (
                'batch' => 0,
                'id' => 256,
                'migration' => '2023_01_21_133136_create_media_table',
            ),
            169 => 
            array (
                'batch' => 0,
                'id' => 257,
                'migration' => '2023_01_21_133136_create_myposts_table',
            ),
            170 => 
            array (
                'batch' => 0,
                'id' => 258,
                'migration' => '2023_01_21_133136_create_notification_tokens_table',
            ),
            171 => 
            array (
                'batch' => 0,
                'id' => 259,
                'migration' => '2023_01_21_133136_create_notifications_table',
            ),
            172 => 
            array (
                'batch' => 0,
                'id' => 260,
                'migration' => '2023_01_21_133136_create_password_resets_table',
            ),
            173 => 
            array (
                'batch' => 0,
                'id' => 261,
                'migration' => '2023_01_21_133136_create_personal_access_tokens_table',
            ),
            174 => 
            array (
                'batch' => 0,
                'id' => 262,
                'migration' => '2023_01_21_133136_create_Post_table',
            ),
            175 => 
            array (
                'batch' => 0,
                'id' => 263,
                'migration' => '2023_01_21_133136_create_post_tables_table',
            ),
            176 => 
            array (
                'batch' => 0,
                'id' => 264,
                'migration' => '2023_01_21_133136_create_posts_table',
            ),
            177 => 
            array (
                'batch' => 0,
                'id' => 265,
                'migration' => '2023_01_21_133136_create_sub_comments_likes_table',
            ),
            178 => 
            array (
                'batch' => 0,
                'id' => 266,
                'migration' => '2023_01_21_133136_create_sub_comments_tables_table',
            ),
            179 => 
            array (
                'batch' => 0,
                'id' => 267,
                'migration' => '2023_01_21_133136_create_subcomments_table',
            ),
            180 => 
            array (
                'batch' => 0,
                'id' => 268,
                'migration' => '2023_01_21_133136_create_team_rates_table',
            ),
            181 => 
            array (
                'batch' => 0,
                'id' => 269,
                'migration' => '2023_01_21_133136_create_teammembers_table',
            ),
            182 => 
            array (
                'batch' => 0,
                'id' => 270,
                'migration' => '2023_01_21_133136_create_teams_table',
            ),
            183 => 
            array (
                'batch' => 0,
                'id' => 271,
                'migration' => '2023_01_21_133136_create_testing_tables_table',
            ),
            184 => 
            array (
                'batch' => 0,
                'id' => 272,
                'migration' => '2023_01_21_133136_create_testusers_table',
            ),
            185 => 
            array (
                'batch' => 0,
                'id' => 273,
                'migration' => '2023_01_21_133136_create_user_status_product_losts_table',
            ),
            186 => 
            array (
                'batch' => 0,
                'id' => 274,
                'migration' => '2023_01_21_133136_create_user_status_products_table',
            ),
            187 => 
            array (
                'batch' => 0,
                'id' => 275,
                'migration' => '2023_01_21_133136_create_users_table',
            ),
            188 => 
            array (
                'batch' => 0,
                'id' => 276,
                'migration' => '2023_01_21_133136_create_users__profile__photos_table',
            ),
            189 => 
            array (
                'batch' => 0,
                'id' => 277,
                'migration' => '2023_01_21_133136_create_verifications_table',
            ),
            190 => 
            array (
                'batch' => 0,
                'id' => 278,
                'migration' => '2023_01_21_133136_create_websockets_statistics_entries_table',
            ),
            191 => 
            array (
                'batch' => 0,
                'id' => 279,
                'migration' => '2023_01_21_133136_create_winnings_table',
            ),
            192 => 
            array (
                'batch' => 0,
                'id' => 280,
                'migration' => '2023_01_21_133137_add_foreign_keys_to_comment_likes_table',
            ),
            193 => 
            array (
                'batch' => 0,
                'id' => 281,
                'migration' => '2023_01_21_133137_add_foreign_keys_to_comments_table',
            ),
            194 => 
            array (
                'batch' => 0,
                'id' => 282,
                'migration' => '2023_01_21_133137_add_foreign_keys_to_defeats_table',
            ),
            195 => 
            array (
                'batch' => 0,
                'id' => 283,
                'migration' => '2023_01_21_133137_add_foreign_keys_to_draws_table',
            ),
            196 => 
            array (
                'batch' => 0,
                'id' => 284,
                'migration' => '2023_01_21_133137_add_foreign_keys_to_image_video_tables_table',
            ),
            197 => 
            array (
                'batch' => 0,
                'id' => 285,
                'migration' => '2023_01_21_133137_add_foreign_keys_to_likes_table',
            ),
            198 => 
            array (
                'batch' => 0,
                'id' => 286,
                'migration' => '2023_01_21_133137_add_foreign_keys_to_post_tables_table',
            ),
            199 => 
            array (
                'batch' => 0,
                'id' => 287,
                'migration' => '2023_01_21_133137_add_foreign_keys_to_sub_comments_likes_table',
            ),
            200 => 
            array (
                'batch' => 0,
                'id' => 288,
                'migration' => '2023_01_21_133137_add_foreign_keys_to_sub_comments_tables_table',
            ),
            201 => 
            array (
                'batch' => 0,
                'id' => 289,
                'migration' => '2023_01_21_133137_add_foreign_keys_to_subcomments_table',
            ),
            202 => 
            array (
                'batch' => 0,
                'id' => 290,
                'migration' => '2023_01_21_133137_add_foreign_keys_to_team_rates_table',
            ),
            203 => 
            array (
                'batch' => 0,
                'id' => 291,
                'migration' => '2023_01_21_133137_add_foreign_keys_to_winnings_table',
            ),
        ));
        
        
    }
}