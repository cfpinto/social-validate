<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 17/11/2018
 * Time: 18:07
 */

namespace SocialValidate\Validators;

/**
 * Class Youtube
 *
 * @package SocialValidate\Validators
 */
class Youtube extends AbstractValidator
{

    /** inline {@inheritdoc} */
    protected array $patterns = [
        '~www.youtube.com/?\?v=([a-z0-9_-]+)~i',
        '~www.youtube.com/(channel|user)/([^/]+)~i'
    ];

    protected array $patternMaps = [
        ['type' => 'video', 'id' => 1],
        ['type' => 1, 'id' => 2],
    ];

    /** inline {@inheritdoc} */
    public function normalizeUrl(string $url):string
    {
        if (preg_match('~(?:v=|youtu\.be/|youtube\.com/embed/)([a-z0-9_-]+)~i', $url, $matches)) {
            return 'https://www.youtube.com/watch?v=' . $matches[1];
        }

        $parts = explode('?', $url);

        return $parts[0];
    }
}
