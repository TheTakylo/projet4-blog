<?php

namespace Framework\Helpers\Captcha;


use Framework\Session\SessionManager;

class Captcha
{

    /** @var SessionManager $sessionManager */
    private $sessionManager;

    /** @var string $captchaText */
    private $captchaText;

    public function __construct()
    {
        $this->sessionManager = new SessionManager();
    }

    public function generate()
    {
        $this->initialize();

        return $this->captchaText;
    }

    public function validate(int $response): bool
    {
        return $this->getCaptchaResult() === (int)$response;
    }

    private function initialize()
    {
        $firstNumber = rand(1, 10);
        $secondNumber = rand(1, 10);

        switch (rand(0, 1)) {
            case 0:
                $this->setCaptchaResult($firstNumber + $secondNumber);
                $this->captchaText = "{$firstNumber} + {$secondNumber}";
                break;
            case 1:
                $this->setCaptchaResult($firstNumber - $secondNumber);
                $this->captchaText = "{$firstNumber} - {$secondNumber}";
                break;
        }
    }

    private function setCaptchaResult(int $captchaResult)
    {
        $this->sessionManager->set('CAPTCHA.CAPTCHA_RESULT', $captchaResult);
    }

    private function getCaptchaResult(): int
    {
        return $this->sessionManager->get('CAPTCHA.CAPTCHA_RESULT');
    }

}