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
     * @var array
     */
    protected $patterns = ['~will fail~'];

    /**
     * @var array
     */
    protected $patternMaps = ['fail', 0];

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
        return $this->split($url)->isValid;
    }

    /**
     * @param string $url
     *
     * @return \stdClass
     */
    final public function split(string $url): \stdClass
    {
        if (empty($this->patterns)) {
            throw new \RuntimeException('Invalid Regex validation pattern');
        }

        $result = new \stdClass();
        $result->isValid = false;
        $result->id = null;
        $result->type = null;

        $patterns = $this->patterns;
        $patternMaps = $this->patternMaps;

        if (!is_array($patterns)) {
            $patterns = [$patterns];
            $patternMaps = [$patternMaps];
        }

        foreach ($patterns as $idx => $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                $result->isValid = true;
                $result->id = $matches[$patternMaps[$idx]['id']];
                $result->type = is_numeric($patternMaps[$idx]['type']) ?
                    $matches[$patternMaps[$idx]['type']] :
                    $patternMaps[$idx]['type'];
                
                break;
            }
        }

        return $result;
    }
}
