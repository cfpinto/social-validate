<?php

namespace SocialValidate\Test\Validators;

use Ramsey\Uuid\Uuid;
use SocialValidate\Validators\Instagram;
use SocialValidate\Validators\LinkType;

class InstagramTest extends AbstractValidatorTest
{
    protected function setUp(): void
    {
        $this->validator = new Instagram();
    }

    public function isValidProvider(): array
    {
        return [
            ['https://instagram.com/', false],
            ['https://instagram.com/p/' . Uuid::uuid4(), true],
            ['https://instagram.com/pages/' . Uuid::uuid4(), true],
            ['https://instagram.com/' . Uuid::uuid4(), true],
        ];
    }

    public function splitProvider(): array
    {
        return [
            ['https://instagram.com/p/1', (new LinkType(true, '1', 'post'))->toJson()],
            ['https://instagram.com/pages/1', (new LinkType(true, '1', 'page'))->toJson()],
            ['https://instagram.com/1', (new LinkType(true, '1', 'page'))->toJson()],
        ];
    }

    public function normalizeUrlProvider(): array
    {
        return [
            ['http://instagram', 'http://instagram'],
            ['http://instagram/1', 'http://instagram/1'],
            ['http://instagram/1?a=1', 'http://instagram/1'],
        ];
    }
}
