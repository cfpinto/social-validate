<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 17/11/2018
 * Time: 18:08
 */

namespace SocialValidate\Validators;

/**
 * Class Facebook
 *
 * @package SocialValidate\Validators
 */
class Facebook extends AbstractValidator
{
    protected $patterns = [
        '~facebook\.com/(?:[^/]+)/(?:posts|activity|photos)/(?:[^/]+)/?~i',
        '~facebook\.com/notes/(?:[^/]+)/(?:[^/]+)/(?:[^/]+)/?~i',
        '~facebook\.com/(?:photo|permalink)\.php\?(?:(story_)?fbid)=(?:[^ ]+)~i',
        '~facebook\.com/(?:photos|questions)/(?:[^/ ]+)/?~i',
        '~facebook\.com/media/set/?\?set=(?:[^/ ]+)~i',
        '~facebook\.com/(?:[^/]+)/videos/(?:[^/]+)/?~i',
        '~facebook\.com/video\.php\?(?:id|v)=(?:[^ ]+)~i',
    ];
}