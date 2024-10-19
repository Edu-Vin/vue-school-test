<?php

namespace App\Console\Commands;

use App\Contracts\Users\UserInterface;
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
        $this->userInterface->updateUsersWithRandomInfo();
        return Command::SUCCESS;
    }
}
