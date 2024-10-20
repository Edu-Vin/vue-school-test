<?php

namespace App\Repositories\Users;

use App\Contracts\Users\UserInterface;
use App\Entities\Users\UserEntity;
use App\Repositories\BaseRepository;
use App\Services\NoName\NoName;
use Carbon\Carbon;
use Illuminate\Container\Container as App;

class UserRepository extends BaseRepository implements UserInterface {

    /**
     * Default timezones provided
     *
     * @var string[]
     */
    const defaultTimeZones = ["CET", "CST", "GMT+1"];

    private $provider;

    public function __construct(App $app, NoName $provider) {
        parent::__construct($app);
        $this->provider = $provider;
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
                    'last_info_update' => Carbon::now(),
                ]);
            }
        });
    }

    /**
     * Should be updated when api documentation is provided
     */
    public function updateProviderWithUserInfo(): void {
        $startTime = Carbon::now();
        $totalRequestsMade = 0;
        $this->model->where('last_info_update', Carbon::now()->startOfWeek()->format('Y-m-d'))->chunk(1000,
            function ($users) use (&$startTime, &$totalRequestsMade, &$totalUpdateMade) {
                $data = [
                    'batches' => [
                        'subscribers' => $users->map(function ($user) {
                            return [
                                'email' => $user->email,
                                'name' => $user->firstname . " " . $user->lastname,
                                'time_zone' => $user->time_zone,
                            ];
                        }),
                    ]
                ];

                if ($totalRequestsMade >= 50 && $startTime->diffInMinutes(Carbon::now()) < 60) {
                    // Sleep until an hour has passed
                    $sleepTime = 3600 - $startTime->diffInSeconds(Carbon::now());
                    sleep($sleepTime);
                    $startTime = Carbon::now();
                    $totalRequestsMade = 0;
                }

                if ($totalRequestsMade <= 50 && $startTime->diffInMinutes(Carbon::now()) >= 60) {
                    $startTime = Carbon::now();
                    $totalRequestsMade = 0;
                }

                $this->provider->updateUserBatch($data);
                $totalRequestsMade++;

            });
    }

    protected function getClass(): string
    {
        return UserEntity::class;
    }
}
