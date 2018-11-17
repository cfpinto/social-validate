<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 17/11/2018
 * Time: 19:34
 */

namespace SocialValidate\Validators;

use Fleshgrinder\Validator\URL;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var URL
     */
    protected $urlValidator;

    /**
     * @var array|string
     */
    protected $patterns = '~will fail~';


    /**
     * AbstractValidator constructor.
     */
    final public function __construct()
    {
        $this->urlValidator = new URL();
    }

    /**
     * Normalizes a url.
     * This method should be overwritten by the
     * driver itself, if needed.
     *
     * @param string $url
     *
     * @return string
     */
    public function normalizeUrl(string $url): string
    {
        return $url;
    }

    /**
     * @param string $url
     *
     * @return bool
     */
    final public function isValid(string $url): bool
    {
        if (empty($this->patterns)) {
            throw new \RuntimeException('Invalid Regex validation pattern');
        }

        if (is_array($this->patterns)) {
            foreach ($this->patterns as $pattern) {
                if (preg_match($pattern, $url)) {
                    return true;
                }
            }

            return false;
        } else {
            return preg_match($this->patterns, $this->normalizeUrl($url));
        }
    }
}