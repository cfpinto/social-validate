<?php

namespace SocialValidate\Test\Validators;

use Ramsey\Uuid\Uuid;
use SocialValidate\Validators\LinkType;
use SocialValidate\Validators\Twitch;

class TwitchTest extends AbstractValidatorTest
{
    protected function setUp(): void
    {
        $this->validator = new Twitch();
    }

    public function isValidProvider(): array
    {
        return [
            ['twitch.tv/videos/1', true],
            ['twitch.tv/1', true],
            ['twitch.tv', false],
        ];
    }

    public function splitProvider(): array
    {
        return [
            ['https://twitch.tv/videos/1', (new LinkType(true, '1', 'video'))->toJson()],
            ['https://twitch.tv/1', (new LinkType(true, '1', 'channel'))->toJson()],
        ];
    }

    public function normalizeUrlProvider(): array
    {
        return [
            ['https://twitch.tv/1', 'https://twitch.tv/1'],
            ['https://twitch.tv/video/1', 'https://twitch.tv/video/1'],
        ];
    }
}
