<?php

namespace App\Rules;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class IsValidPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Determine if the Length Validation Rule passes.
     *
     * @var boolean
     */
    public $lengthPasses = true;

    /**
     * Determine if the Uppercase Validation Rule passes.
     *
     * @var boolean
     */
    public $uppercasePasses = true;

    /**
     * Determine if the Numeric Validation Rule passes.
     *
     * @var boolean
     */
    public $numericPasses = true;

    /**
     * Determine if the Special Character Validation Rule passes.
     *
     * @var boolean
     */
    public $specialCharacterPasses = true;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->lengthPasses = (Str::length($value) >= 8);
        $this->uppercasePasses = (Str::lower($value) !== $value);
        $this->numericPasses = ((bool)preg_match('/[0-9]/', $value));
        $this->specialCharacterPasses = ((bool)preg_match('/[^A-Za-z0-9]/', $value));

        return ($this->lengthPasses && $this->uppercasePasses && $this->numericPasses && $this->specialCharacterPasses);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        /* return 'The validation error message.'; */
        switch (true) {
            case !$this->uppercasePasses
                && $this->numericPasses
                && $this->specialCharacterPasses:
                return 'Le :attribute doit comporter au moins 8 caractères et contenir au moins 1 caractère majuscule.';

            case !$this->numericPasses
                && $this->uppercasePasses
                && $this->specialCharacterPasses:
                return 'Le :attribute doit comporter au moins 8 caractères et contenir au moins 1 chiffre.';

            case !$this->specialCharacterPasses
                && $this->uppercasePasses
                && $this->numericPasses:
                return 'Le :attribute doit comporter au moins 8 caractères et contenir au moins 1 caractère spécial.';

            case !$this->uppercasePasses
                && !$this->numericPasses
                && $this->specialCharacterPasses:
                return 'Le :attribute doit comporter au moins 8 caractères et contenir au moins 1 caractère majuscule et 1 chiffre.';

            case !$this->uppercasePasses
                && !$this->specialCharacterPasses
                && $this->numericPasses:
                return 'Le :attribute doit comporter au moins 8 caractères et contenir au moins 1 caractère majuscule et 1 caractère spécial.';

            case !$this->uppercasePasses
                && !$this->numericPasses
                && !$this->specialCharacterPasses:
                return 'Le :attribute doit comporter au moins 8 caractères et contenir au moins 1 caractère majuscule, 1 chiffre et 1 caractère spécial.';

            default:
                return 'Le :attribute doit comporter au moins 8 caractères.';
        }
    }
}
