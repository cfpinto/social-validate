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
    protected array $patterns = [
        '~instagram.com/p/([A-Za-z0-9-_.]+)/?$~i',
        '~instagram.com/pages/([A-Za-z0-9-_.]+)/?$~i',
        '~instagram.com/([A-Za-z0-9-_.]+)/?$~i',
    ];

    protected array $patternMaps = [
        ['type' => 'post', 'id' => 1],
        ['type' => 'page', 'id' => 1],
        ['type' => 'page', 'id' => 1],
    ];

    /** inline {@inheritdoc} */
    public function normalizeUrl(string $url): string
    {
        $parts = explode('?', $url);

        return $parts[0];
    }

}
