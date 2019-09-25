<?php

namespace Everestmx\BelongsToManyField\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class ArrayRules.
 */
class ArrayRules implements Rule
{
    /**
     * @var array
     */
    public $rules = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $rules)
    {
        array_push($rules, 'array');
        $this->rules = $rules;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $input = [$attribute => json_decode($value, true)];
        $this->rules = [$attribute => $this->rules];
        $validator = \Validator::make($input, $this->rules, $this->messages($attribute));
        $this->message = $validator->errors()->get($attribute);

        return $validator->passes();
    }
}
