<?php

namespace App\Console\Commands;

use App\Models\Package;
use App\Models\User;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class RegisterPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:package {userId} {packageId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registers a package to a user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userId = $this->argument('userId');
        $packageId = $this->argument('packageId');

        $user = User::findOrFail($userId);
        $package = Package::findOrFail($packageId);


        if (($package->limit > $package->registrations->count())) {
            $user->registrations()->attach($packageId, ['uuid' => Uuid::uuid4()->toString()]);
            $this->info("Package {$package->name} has been successfully registered to user {$user->name}.");
        } else {
            $this->error("The package {$package->name} is not available.");
        }

        return 0;
    }
}
