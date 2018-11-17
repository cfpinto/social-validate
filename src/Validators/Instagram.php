<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 17/11/2018
 * Time: 18:08
 */

namespace SocialValidate\Validators;

/**
 * Class Instagram
 *
 * @package SocialValidate\Validators
 */
class Instagram extends AbstractValidator
{
    /** inline {@inheritdoc} */
    protected $patterns = '~/p/([A-Za-z0-9-_]+)/?$~i';

    /** inline {@inheritdoc} */
    public function normalizeUrl(string $url): string
    {
        $parts = explode('?', $url);
        
        return $parts[0];
    }

}