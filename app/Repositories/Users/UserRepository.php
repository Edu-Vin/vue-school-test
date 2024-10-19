<?php

namespace App\Repositories\Users;

use App\Contracts\Users\UserInterface;
use App\Entities\Users\UserEntity;
use App\Repositories\BaseRepository;
use Illuminate\Container\Container as App;

class UserRepository extends BaseRepository implements UserInterface {

    /**
     * Default timezones provided
     *
     * @var string[]
     */
    const defaultTimeZones = ["CET", "CST", "GMT+1"];

    public function __construct(App $app) {
        parent::__construct($app);
    }

    /**
     * Update all users with new random info
     */
    public function updateUsersWithRandomInfo(): void {
        $this->model->chunk(500, function ($users) {
            foreach ($users as $user) {
                $user->update([
                    'firstname' => fake()->firstName(),
                    'lastname' => fake()->lastName(),
                    'time_zone' => fake()->randomElement(self::defaultTimeZones),
                ]);
            }
        });
    }


    protected function getClass(): string
    {
        return UserEntity::class;
    }
}
