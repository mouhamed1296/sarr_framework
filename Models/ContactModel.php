<?php

namespace App\Models;

use App\Core\Model;

class ContactModel extends Model
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $message = '';

    /**
     * ContactModel constructor.
     */
    public function __construct()
    {
        //constructor
    }

    /**
     * contact process the contact information
     *
     *
     */
    public function contact()
    {
        echo 'Sending Message';
        //return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 2],
                [self::RULE_MAX, 'max' => 20]
            ],
            'lastname' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 2],
                [self::RULE_MAX, 'max' => 20]
            ],
            'email' => [
                self::RULE_REQUIRED, self::RULE_EMAIL,
                [self::RULE_MIN, 'min' => 8],
                [self::RULE_MAX, 'max' => 30]
            ],
            'message' => [self::RULE_REQUIRED]
        ];
    }
}
