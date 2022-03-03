<?php

namespace SocialValidate\Test\Validators;

use SocialValidate\Validators\LinkType;
use SocialValidate\Validators\Twitter;

class TwitterTest extends AbstractValidatorTest
{
    protected function setUp(): void
    {
        $this->validator = new Twitter();
    }

    public function isValidProvider(): array
    {
        return [
            ['https://twitter.com/', false],
            ['https://twitter.com/user-name/status/1', true],
            ['https://twitter.com/user-name/moments/1', true],
            ['https://twitter.com/user-name', true],
        ];
    }

    public function splitProvider(): array
    {
        return [
            ['https://twitter.com/user-name/status/1', (new LinkType(true, '1', 'status'))->toJson()],
            ['https://twitter.com/user-name/moments/1', (new LinkType(true, '1', 'moments'))->toJson()],
            ['https://twitter.com/user-name', (new LinkType(true, 'user-name', 'profile'))->toJson()],
        ];
    }

    /**
     * @skip
     */
    public function normalizeUrlProvider(): array
    {
        return [
            ['https://twitter.com/#!user-name/status/1', 'https://twitter.com/user-name/status/1'],
            ['https://twitter.com/#!user-name/moments/1', 'https://twitter.com/user-name/moments/1'],
            ['https://twitter.com/user-name/moment/1', 'https://twitter.com/user-name/moment/1'],
        ];
    }
}
