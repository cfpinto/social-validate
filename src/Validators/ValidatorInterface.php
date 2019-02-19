<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 17/11/2018
 * Time: 18:04
 */

namespace SocialValidate\Validators;


interface ValidatorInterface
{
    /**
     * @param string|null $url
     *
     * @return bool
     */
    public function isValid(string $url): bool;
    public function normalizeUrl(string $url): string;
    public function split(string $url): \stdClass;
}