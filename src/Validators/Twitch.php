<?php
/**
 * Created by PhpStorm.
 * User: jonatajoaquim
 * Date: 05/02/2019
 * Time: 11:50
 */

namespace SocialValidate\Validators;


class Twitch extends AbstractValidator
{
    protected $patterns = "~twitch\.tv/(videos)/([0-9]+)~i";

    public function normalizeUrl(string $url): string
    {
        if (preg_match('~twitch\.tv/(videos)/([0-9]+)~i', $url, $matches)) {
            return 'https://twitch.tv/' . $matches['1'] . '/' . $matches['2'];
        }

        return $url;
    }
}