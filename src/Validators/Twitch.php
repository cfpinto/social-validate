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
    protected array $patterns = [
        "~twitch\.tv/videos/([0-9]+)~i",
        "~twitch\.tv/([0-9]+)~i",
    ];

    protected array $patternMaps = [
        ['type' => 'video', 'id' => 1],
        ['type' => 'channel', 'id' => 1],
    ];
}
