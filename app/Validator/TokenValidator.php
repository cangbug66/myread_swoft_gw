<?php
namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Pattern;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class TokenValidator
 * @package App\Validator
 * @Validator(name="tokenValidator")
 */
class TokenValidator{
    /**
     * @var string
     * @IsString()
     * @Pattern(regex="/^[a-zA-Z]\w{5,19}$/",message="username error")
     */
    protected $username;

    /**
     * @var string
     * @IsString()
     * @Pattern(regex="/^.{6,18}$/",message="userpwd error")
     */
    protected $userpwd;
}