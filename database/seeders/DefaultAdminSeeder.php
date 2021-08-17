<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Contracts\Hashing\Hasher as Hash;

class DefaultAdminSeeder extends Seeder
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    private $model;

    /**
     * @var Hash
     */
    private $hash;

    public function __construct()
    {
        $this->model = resolve(User::class);
        $this->hash = resolve(Hash::class);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =[
                "name" => 'Admin',
                "email" => 'admin@poll.com',
                "password" => $this->hash->make('Poll123'),
                "user_type" => 'admin'
            ];
        $item=$this->model->create($user);
        $item->assignRole('Admin');
    }
}
