<?php
namespace Library\Validate\Rules;

use App\Config;

use App\Models\Core;

use Core\Locale;
use Library\Validate\Rule;

class Captcha extends Rule
{
    /** @var string */
    protected $message;

    /**
     * Check $value is valid
     *
     * @param mixed $value
     * @return bool
     */

    public function __construct()
    {
        $this->message = Locale::get('core/pattern/captcha');
    }

    public function check($value): bool
    {
        return $this->captcha($value);
    }

    public function captcha($value) {
      try {

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = ['secret'   => Core::settings()->recaptcha_secretkey ?? null,
                 'response' => $value,
                 'remoteip' => $_SERVER['REMOTE_ADDR']];
                 
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data) 
            ]
        ];
    
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return json_decode($result)->success;
    }
    catch (Exception $e) {
        return null;
    }
  }
}
