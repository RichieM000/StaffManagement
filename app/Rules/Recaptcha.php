<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Anhskohbo\NoCaptcha\Rules\NoCaptcha as NoCaptchaRule;

class Recaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        return (new NoCaptchaRule())->passes($attribute, $value);
    }

    public function message()
    {
        return 'Failed to validate ReCaptcha.';
    }
}