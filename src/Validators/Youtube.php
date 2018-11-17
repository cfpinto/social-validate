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
    protected $patterns = '~v=(?:[a-z0-9_-]+)~i';
    
    /** inline {@inheritdoc} */
    public function normalizeUrl(string $url):string 
    {
        if (preg_match('~(?:v=|youtu\.be/|youtube\.com/embed/)([a-z0-9_-]+)~i', $url, $matches)) {
            return 'http://www.youtube.com/watch?v=' . $matches[1];
        }
        
        return $url;
    }
}