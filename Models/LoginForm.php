<?php


namespace App\Models;


use App\Core\Application;
use App\Core\Debug;
use App\Core\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'l\'adresse email entré est incorrect');
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'le mot de passe entré est incorrect');
            return false;
        }
       // Debug::varDump(true, $user);

        return Application::$app->login($user);
    }
}