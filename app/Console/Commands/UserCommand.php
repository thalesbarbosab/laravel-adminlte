<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;

class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user
                            {--create : Create a new user manually}
                            {--factory : Create a user using factory}
                            {--show : Show user by ID}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is possible to create a new user and show data';

    protected User $user;

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
        $this->user = new User;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Factory
        if($this->option('factory'))
        {
            $this->factory();
        }
        // Create
        else if($this->option('create'))
        {
            $this->create();
        }
        // Show
        else if($this->option('show'))
        {
           $this->show();
        }
        // Nobody option is selected
        else{
            $this->warn('Plese select any option to use this command!');
        }
    }

    private function factory()
    {
        $this->info('Lets create a user factory, please set the question bellow.');
        $factory_count = (int) $this->ask('How many lines do you want to create?');
        if(is_integer($factory_count) && $factory_count > 0){
            if ($this->confirm("Do you wish to continue? Will be create $factory_count users!")) {
                $bar = $this->output->createProgressBar(1);
                $bar->start($factory_count);
                for ($i=0; $i < $factory_count; $i++) {
                    $this->user->factory(1)->create();
                    $bar->advance();
                }
                $bar->finish();
                $this->newLine(2);
                return $this->info("$factory_count user(s) created successfully!");
            }
        }else{
            return $this->warn('Please insert a integer value more than zero');
        }
    }

    private function create()
    {
        $this->info('Lets create a manually user, please set the questions bellow.');
        $this->newLine();
        $name = $this->ask('What is user name? (required)');
        // $status = $this->anticipate('What is user status? (required) (actived, inactived, pre_registred)', ['actived','inactived','pre_registred']);
        $status = $this->choice('What is user status? (required)', ['actived','inactived','pre_registred']);
        $profile = $this->choice('What is user profile? (required)', ['administrator','user']);
        $gender = $this->choice('What is user gender? (required)', ['male','female']);
        $email = $this->ask('What is user email? (required)' );
        $password = $this->secret('What is the user password? (required)');
        $data = [
            'name'=> $name,
            'status'=> $status,
            'profile'=> $profile,
            'gender'=> $gender,
            'email'=> $email,
            'password'=> bcrypt($password)
        ];
        $bar = $this->output->createProgressBar(1);
        $bar->start();
        $this->user->create($data);
        $bar->advance();
        $bar->finish();

        $this->newLine();

        return $this->info('User create successfully!');
    }

    private function show()
    {
        $id = $this->ask('What is user ID do you want to show?');
        if(is_numeric($id)){
            $user = $this->user->where('id',$id)->get(['id','name', 'email','status','gender','profile','created_at']);
            if($user->count() == 0){
                return $this->warn("Not found user with id: $id");
            }
            $user_array = $user->first()->toArray();
            $this->info("Found user with id $id, showing data bellow..");
            $this->table(
                ['ID','Name', 'Email','Status','Gender','Profile','Created At'],
                [$user_array]
            );
        }else{
            return $this->warn('The user ID informed is not valid');
        }
    }
}
