<?php



class SentryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        DB::table('groups')->delete();
        DB::table('users_groups')->delete();

        Sentry::getUserProvider()->create(array(
            'email'       => 'admin@wirednest.com',
            'password'    => "1234",
            'first_name'  => 'Admin',
            'last_name'   => 'Wirednest',
            'activated'   => 1,
        ));
        Sentry::getUserProvider()->create(array(
            'email'       => 'reseller@wirednest.com',
            'password'    => "1234",
            'first_name'  => 'Reseller',
            'last_name'   => 'Wirednest',
            'activated'   => 1,
        ));
        Sentry::getUserProvider()->create(array(
            'email'       => 'user@wirednest.com',
            'password'    => "1234",
            'first_name'  => 'User',
            'last_name'   => 'Wirednest',
            'activated'   => 1,
        ));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Admin',
            'permissions' => array(
                'admin' => 1,
                'reseller' => 1,
                'users' => 1
            ),
        ));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Reseller',
            'permissions' => array(
                'reseller' => 1
            ),
        ));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'User',
            'permissions' => array(
                'users' => 1
            ),
        ));

        // Assign user permissions
        $adminUser  = Sentry::getUserProvider()->findByLogin('admin@wirednest.com');
        $adminGroup = Sentry::getGroupProvider()->findByName('Admin');
        $adminUser->addGroup($adminGroup);
    }

}