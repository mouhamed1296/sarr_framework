<?php

namespace App\Core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public array $errors = [];

    /**
     * @param $data
     * @return void
     */
    public function loadData($data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @return array
     */
    abstract public function rules(): array;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addErrorForRule($attribute, self::RULE_MATCH);
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = Application::$app->db->pdo->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :$uniqueAttr");
                    $statement->bindValue(":$uniqueAttr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $attribute]);
                    }
                }
            }
            unset($value);
        }
        return empty($this->errors);
    }

    /**
     * @param string $attribute
     * @param string $rule
     * @param array $params
     * @return void
     */
    private function addErrorForRule(string $attribute, string $rule, $params = []): void
    {
        $message = $this->errorMessage()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = strtr($message, ["{{$key}}" => $value]);
        }
        $this->errors[$attribute][] = $message;
        unset($message);
    }
    public function addError(string $attribute, string $message): void
    {
        $this->errors[$attribute][] = $message;
    }


    /**
     * @return string[]
     */
    public function errorMessage(): array
    {
        return [
            self::RULE_REQUIRED => "Ce champ est requis",
            self::RULE_EMAIL => "Adresse email invalide",
            self::RULE_MIN => "Saisissez au minimum {min} caractères",
            self::RULE_MAX => "Saisissez au maximum {max} caractères",
            self::RULE_MATCH => "Les mots de passe ne correspondent pas",
            self::RULE_UNIQUE => "Un compte avec cet {field} existe déjà"
        ];
    }

    /**
     * hasError
     *
     * @param string $attribute
     *
     * @return array|bool
     */
    public function hasError(string $attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    /**
     * getFirstError
     *
     * @param string $attribute
     *
     * @return string|bool
     */
    public function getFirstError(string $attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}
