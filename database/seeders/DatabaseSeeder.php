<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Percent;
use App\Models\User;
use App\Models\branch;
use App\Models\Country;
use App\Models\PackageCategory;
use App\Models\WeightPrice;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
            branch::create([
                'street' => '22 mazoria',
                'city' => 'Addis Ababa',
                'state' => 'Addis Ababa',
                'country' => 'Ethiopia',
                'contact' => '+251955959',
                'Tot_package' => '10',
                'balance' => 10000,
                'Tot_commission' => 200,
                'email' => 'branch1@gmail.com',
                'started_date' => '2020-10-01',
                'branch_name' => 'Addis Ababa Branch',
            ]);
            branch::create([
                'street' => 'poly',
                'city' => 'Bahir Dar',
                'state' => 'Amhara',
                'country' => 'Ethiopia',
                'contact' => '+25166941',
                'Tot_package' => '20',
                'balance' => 20000,
                'Tot_commission' => 200,
                'email' => 'branch2@gmail.com',
                'started_date' => '2021-05-09',
                'branch_name' => 'Bahir Dar Branch',
            ]);
            branch::create([
                'street' => 'poly',
                'city' => 'Gonder',
                'state' => 'Amhara',
                'country' => 'Ethiopia',
                'contact' => '+25166941',
                'Tot_package' => '10',
                'balance' => 20000,
                'Tot_commission' => 200,
                'email' => 'branch2@gmail.com',
                'started_date' => '2021-05-09',
                'branch_name' => 'Gonder Branch',
            ]);
            branch::create([
                'street' => 'poly',
                'city' => 'Mekele',
                'state' => 'Amhara',
                'country' => 'Ethiopia',
                'contact' => '+25166941',
                'Tot_package' => '10',
                'balance' => 20000,
                'Tot_commission' => 200,
                'email' => 'branch2@gmail.com',
                'started_date' => '2021-05-09',
                'branch_name' => 'Mekele Branch',
            ]);
            branch::create([
                'street' => 'poly',
                'city' => 'Hawassa',
                'state' => 'Amhara',
                'country' => 'Ethiopia',
                'contact' => '+25166941',
                'Tot_package' => '10',
                'balance' => 50000,
                'Tot_commission' => 200,
                'email' => 'branch2@gmail.com',
                'started_date' => '2021-05-09',
                'branch_name' => 'Hawassa Branch',
            ]);
            branch::create([
                'street' => 'poly',
                'city' => 'Kombolcha',
                'state' => 'Amhara',
                'country' => 'Ethiopia',
                'contact' => '+25166941',
                'Tot_package' => '10',
                'balance' => 40000,
                'Tot_commission' => 200,
                'email' => 'branch2@gmail.com',
                'started_date' => '2021-05-09',
                'branch_name' => 'Kombolcha Branch',
            ]);
            branch::create([
                'street' => 'poly',
                'city' => 'Bonga',
                'state' => 'Amhara',
                'country' => 'Ethiopia',
                'contact' => '+25166941',
                'Tot_package' => '10',
                'balance' => 30000,
                'Tot_commission' => 200,
                'email' => 'branch2@gmail.com',
                'started_date' => '2021-05-09',
                'branch_name' => 'Debre Markos Branch',
            ]);
            branch::create([
                'street' => 'poly',
                'city' => 'Boditi',
                'state' => 'Amhara',
                'country' => 'Ethiopia',
                'contact' => '+25166941',
                'Tot_package' => '10',
                'balance' => 10000,
                'Tot_commission' => 200,
                'email' => 'branch2@gmail.com',
                'started_date' => '2021-05-09',
                'branch_name' => 'Boditi Branch',
            ]);
            branch::create([
                'street' => 'poly',
                'city' => 'Arba Minch',
                'state' => 'Amhara',
                'country' => 'Ethiopia',
                'contact' => '+25166941',
                'Tot_package' => '10',
                'balance' => 6000,
                'Tot_commission' => 200,
                'email' => 'branch2@gmail.com',
                'started_date' => '2021-05-09',
                'branch_name' => 'Arba Minch Branch',
            ]); 
            branch::create([
                'street' => 'poly',
                'city' => 'Dire Dawa',
                'state' => 'Amhara',
                'country' => 'Ethiopia',
                'contact' => '+25166941',
                'Tot_package' => '10',
                'balance' => 1000,
                'Tot_commission' => 200,
                'email' => 'branch2@gmail.com',
                'started_date' => '2021-05-09',
                'branch_name' => 'Dire Dawa Branch',
            ]);
           
            WeightPrice::create([
                'weight'=>'0-2',
                'rate'=>1,
            ]);
            WeightPrice::create([
                'weight'=>'2-5',
                'rate'=>1.5,
            ]);
            WeightPrice::create([
                'weight'=>'5-10',
                'rate'=>2,
            ]);
            WeightPrice::create([
                'weight'=>'10-15',
                'rate'=>2.5,
            ]);
           
            User::create([
                'branch_Id'=>1,
                'name'=>'nati',
                'email'=>'natiage@gmail.com',
                'password'=>'12345678',
                'status'=>'Admin',
            ]);
            User::create([
                'branch_Id'=>2,
                'name'=>'dagi',
                'email'=>'dagi@gmail.com',
                'password'=>'12345678',
                'status'=>'Admin',
            ]);
            Country::create([
                'fromBranchID'=>1,
                'toBranchID'=>2,
                'price'=>300,
            ]);
            Country::create([
                'fromBranchID'=>1,
                'toBranchID'=>3,
                'price'=>350,
            ]);
            Country::create([
                'fromBranchID'=>1,
                'toBranchID'=>4,
                'price'=>400,
            ]);
            Country::create([
                'fromBranchID'=>1,
                'toBranchID'=>5,
                'price'=>450,
            ]);
            Country::create([
                'fromBranchID'=>1,
                'toBranchID'=>6,
                'price'=>500,
            ]);
            Country::create([
            'fromBranchID'=>1,
            'toBranchID'=>7,
            'price'=>550,
        ]);
        Country::create([
            'fromBranchID'=>1,
            'toBranchID'=>9,
            'price'=>400,
        ]);
        Country::create([
            'fromBranchID'=>1,
            'toBranchID'=>10,
            'price'=>300,
        ]);
        Percent::create([
            'status'=>'collected',
            'percent'=>30,
        ]);
        Percent::create([
            'status'=>'delivered',
            'percent'=>20,
        ]);

    }
}
