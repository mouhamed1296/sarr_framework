<?php

namespace App\Models;

use App\Core\DbModel;

class User extends DbModel
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;

    public string $firstname;
    public string $lastname;
    public string $email;
    public int $status = self::STATUS_INACTIVE;
    public string $password;
    public string $passwordConfirm;

    /**
     * RegisterModel constructor.
     */
    public function __construct()
    {
        //constructor
    }

    public function tableName(): string
    {
        return 'users';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->status = self::STATUS_INACTIVE;
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $this->password = (is_string($hashedPassword)) ? $hashedPassword : '';
        return parent::save();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 16]],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status'];
    }
}
