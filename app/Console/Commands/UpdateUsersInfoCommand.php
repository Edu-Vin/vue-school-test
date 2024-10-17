<?php

namespace App\Console\Commands;

use App\Entities\Users\UserEntity;
use Illuminate\Console\Command;

class UpdateUsersInfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update users info to new random information';

    private $defaultTimeZones = ["CET", "CST", "GMT+1"];



    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        UserEntity::chunk(300, function ($users) {
            foreach ($users as $user) {
                echo $user->firstname;
                $user->update([
                    'firstname' => fake()->firstName(),
                    'lastname' => fake()->lastName(),
                    'time_zone' => fake()->randomElement($this->defaultTimeZones)
                ]);
            }
        });

        return Command::SUCCESS;
    }
}
