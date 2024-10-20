<?php

namespace App\Console\Commands;

use App\Contracts\Users\UserInterface;
use Illuminate\Console\Command;

class UpdateUsersInfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-info {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Either update provider with users info or update users info with new random information locally.';

    protected UserInterface $userInterface;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserInterface $userInterface)
    {
        parent::__construct();
        $this->userInterface = $userInterface;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            match($this->argument('type')) {
                'local' => $this->userInterface->updateUsersWithRandomInfo(),
                'provider' => $this->userInterface->updateProviderWithUserInfo(),
            };
        } catch(\UnhandledMatchError $e) {
            $this->error('Invalid update environment!');
            return 0;
        }

        $this->info('Update completed successfully!');
        return 0;
    }
}
