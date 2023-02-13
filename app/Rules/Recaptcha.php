<?php

namespace App\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

class Recaptcha implements Rule
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
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $client = new Client();
            $response = $client->post(
                            'https://www.google.com/recaptcha/api/siteverify',
                            [
                                'form_params' => [
                                    'secret' => config('services.recaptcha.secret'),
                                    'response' => $value,
                                ]
                            ]
                        );
            $body = json_decode($response->getBody());
            return $body->success;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Captcha error! Silhakan tunggu beberapa saat atau hubungi pihak RSUD Kota Bogor';
    }
}
