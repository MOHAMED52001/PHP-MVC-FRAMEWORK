<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQURIED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public array $err = [];

    public function loadData($body)
    {
        foreach ($body as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    abstract public function rules(): array;

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->$attribute;
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (is_array($rule)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQURIED  && !$value) {
                    $this->addErrors($attribute, self::RULE_REQURIED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_input(INPUT_POST, $value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrors($attribute, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrors($attribute, self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MATCH && $value != $rule['match']) {
                    $this->addErrors($attribute, self::RULE_MATCH, $rule);
                }
            }
        }

        return empty($this->err);
    }



    public function addErrors(string $attr, string $rule, $params = [])
    {
        $msg = $this->errorMessage()[$rule] ?? '';

        foreach ($params as $key => $value) {
            $msg = str_replace("{{$key}}", $value, $msg);
        }

        $this->err[$attr][] = $msg;
    }



    public function errorMessage()
    {
        return [
            self::RULE_REQURIED => 'This Field Is Required',
            self::RULE_EMAIL => 'This In Not A Valid Email Address',
            self::RULE_MIN => 'The Minimum Length Must Be {min}',
            self::RULE_MAX => 'The Maximum Length Must Be {max}',
            self::RULE_MATCH => 'This Field Must Match The {match}'
        ];
    }
}
