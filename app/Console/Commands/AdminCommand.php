<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminCommand extends Command
{

    protected $signature = 'create:admin';

    protected $description = 'Create Admin';

    protected function askValid($question, $field, $rules)
    {
        $value = $this->ask($question);

        if ($message = $this->validateInput($rules, $field, $value)) {
            $this->error($message);

            return $this->askValid($question, $field, $rules);
        }

        return $value;
    }

    protected function validateInput($rules, $fieldName, $value): ?string
    {
        $validator = Validator::make(
            [
                $fieldName => $value
            ],
            [
                $fieldName => $rules
            ]);

        return $validator->fails() ? $validator->errors()->first($fieldName) : null;
    }

    public function handle()
    {
        $name = $this->askValid('Enter Your Name', 'name', ['required', 'string']);
        $phone = $this->askValid('Enter Your Phone', 'phone', ['required', 'string']);
        $email = $this->askValid('Enter Your Email', 'email', ['required', 'string', 'unique:users,email']);
        $password = $this->secret('Enter Your Password');


        $data = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'password' => Hash::make($password),
        ];


        User::create($data);

        $this->info('Your Super account Created');

        return Command::SUCCESS;
    }
}
