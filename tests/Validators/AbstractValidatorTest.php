<?php

namespace SocialValidate\Test\Validators;

use PHPUnit\Framework\TestCase;
use SocialValidate\Validators\ValidatorInterface;

abstract class AbstractValidatorTest extends TestCase
{
    public ValidatorInterface $validator;

    /**
     * @dataProvider isValidProvider
     * @covers \SocialValidate\Validators\AbstractValidator
     * @covers \SocialValidate\Validators\Facebook
     * @covers \SocialValidate\Validators\Instagram
     * @covers \SocialValidate\Validators\Twitch
     * @covers \SocialValidate\Validators\Twitter
     * @covers \SocialValidate\Validators\Youtube
     * @covers \SocialValidate\Validators\LinkType
     * @param string $url
     * @param bool $expectedValue
     * @return void
     */
    final public function testIsValid(string $url, bool $expectedValue)
    {
        $this->assertEquals($expectedValue, $this->validator->isValid($url));
    }

    /**
     * @dataProvider splitProvider
     * @covers \SocialValidate\Validators\AbstractValidator
     * @covers \SocialValidate\Validators\Facebook
     * @covers \SocialValidate\Validators\Instagram
     * @covers \SocialValidate\Validators\Twitch
     * @covers \SocialValidate\Validators\Twitter
     * @covers \SocialValidate\Validators\Youtube
     * @covers \SocialValidate\Validators\LinkType
     * @param string $url
     * @param string $expectedJson
     * @return void
     */
    final public function testSplit(string $url, string $expectedJson)
    {
        $this->assertEquals($expectedJson, $this->validator->split($url)->toJson());
    }

    /**
     * @dataProvider normalizeUrlProvider
     * @covers \SocialValidate\Validators\AbstractValidator
     * @covers \SocialValidate\Validators\Facebook
     * @covers \SocialValidate\Validators\Instagram
     * @covers \SocialValidate\Validators\Twitch
     * @covers \SocialValidate\Validators\Twitter
     * @covers \SocialValidate\Validators\Youtube
     * @param $url
     * @param $expectedUrl
     * @return void
     */
    final public function testNormalizeUrl($url, $expectedUrl)
    {
        $this->assertEquals($expectedUrl, $this->validator->normalizeUrl($url));
    }

    abstract public function isValidProvider(): array;

    abstract public function splitProvider(): array;

    abstract public function normalizeUrlProvider(): array;
}
