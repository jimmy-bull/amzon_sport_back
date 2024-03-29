<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(UsersProfilePhotosTableSeeder::class);
        $this->call(FollowingSystemsTableSeeder::class);
        $this->call(PostTablesTableSeeder::class);
        $this->call(ImageVideoTablesTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(AskGamesTableSeeder::class);
        $this->call(WinningsTableSeeder::class);
        $this->call(DefeatsTableSeeder::class);
        $this->call(DrawsTableSeeder::class);
        $this->call(TeammembersTableSeeder::class);
        $this->call(TeamRatesTableSeeder::class);


        $this->call(PasswordResetsTableSeeder::class);
        $this->call(PersonalAccessTokensTableSeeder::class);
        $this->call(FavorisTableSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
        $this->call(VerificationsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(LikesTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(MypostsTableSeeder::class);
        $this->call(NotificationTokensTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(TestingTablesTableSeeder::class);
        $this->call(TestusersTableSeeder::class);
        $this->call(WebsocketsStatisticsEntriesTableSeeder::class);
        $this->call(CommentLikesTableSeeder::class);
        $this->call(SubcommentsTableSeeder::class);
        $this->call(SubCommentsTablesTableSeeder::class);
        $this->call(SubCommentsLikesTableSeeder::class);
        $this->call(UserStatusProductsTableSeeder::class);
        $this->call(UserStatusProductLostsTableSeeder::class);
        $this->call(BigsTableSeeder::class);
        $this->call(ArticleLostsTableSeeder::class);
        $this->call(ArticleSoldsTableSeeder::class);
        $this->call(AttrsTableSeeder::class);
        $this->call(AuctionDatesTableSeeder::class);
        $this->call(BidAugmentationsTableSeeder::class);
        $this->call(BidDataTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CategoryAttributesTableSeeder::class);
        $this->call(DetailsTableSeeder::class);
        $this->call(DetailsDescsTableSeeder::class);
        $this->call(EstimationsTableSeeder::class);
        $this->call(MainProductsTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(PhonesTableSeeder::class);
        $this->call(RoleUsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
    }
}
