<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Validator;

class PostUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:user {id} {comments} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates user comments';

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
        $input = [
            'id' => $this->argument('id'),
            'comments' => $this->argument('comments'),
            'password' => $this->argument('password'),
        ];
        
        $this->info("Checking command parameters");

        $validator = Validator::make($input, [
            'id' => 'required|numeric',
            'comments' => 'required',
            'password' => 'required',
        ],[
            'id.required' => 'Missing key/value for id',
            'id.numeric' => 'Invalid id',
            'comments.required' => 'Missing key/value for comments',
            'password.required' => 'Missing key/value for password',
        ]);
        if($validator->fails()){
            $this->info("Incomplete form fields.\nErrors:".$validator->messages()->toJson());
            return 0;
        }

        if ($input['password'] != env('APP_PASSWORD')) {
            $this->info("Invalid password.");
            return 0;
        }

        $user = User::find($input['id']);
        $user->comments .= "\n". $input['comments'];
        $user->save(); 
        $this->info("Command executed successfully");
        return 1;
    }
}
