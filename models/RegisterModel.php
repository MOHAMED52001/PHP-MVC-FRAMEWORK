<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{

    public string $fname;
    public string $lname;
    public string $email;
    public string $passwd;
    public string $cmpasswd;

    public  function rules(): array
    {
        return [
            'fname' => [self::RULE_REQURIED],
            'lname' => [self::RULE_REQURIED],
            'email' => [self::RULE_REQURIED, self::RULE_EMAIL],
            'passwd' => [self::RULE_REQURIED, [self::RULE_MIN, 'min' => 8]],
            'cmpasswd' => [self::RULE_REQURIED, [
                self::RULE_MATCH, 'match' => 'passwd'
            ]],
        ];
    }

    public function addAccount()
    {
    }
}
