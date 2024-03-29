<?php

namespace SocialValidate\Test\Validators;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use SocialValidate\Validators\LinkType;
use SocialValidate\Validators\Youtube;

class YoutubeTest extends AbstractValidatorTest
{
    protected UuidFactory $uuidFactory;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->uuidFactory = new UuidFactory();
    }

    protected function setUp(): void
    {
        $this->validator = new Youtube();
    }

    public function isValidProvider(): array
    {
        return [
            ['https://www.youtube.com', false],
            ['https://www.youtube.com?v=' . $this->uuidFactory->uuid4(), true],
            ['https://www.youtube.com/channel/' . $this->uuidFactory->uuid4(), true],
            ['https://www.youtube.com/channel/channel-name', true],
            ['https://www.youtube.com/user/' . $this->uuidFactory->uuid4(), true],
            ['https://www.youtube.com/user/user-name', true],
        ];
    }

    public function splitProvider(): array
    {
        return [
            ['https://www.youtube.com?v=1', (new LinkType(true, '1', 'video'))->toJson()],
            ['https://www.youtube.com/channel/1', (new LinkType(true, '1', 'channel'))->toJson()],
            ['https://www.youtube.com/channel/channel-name', (new LinkType(true, 'channel-name', 'channel'))->toJson()],
            ['https://www.youtube.com/user/1', (new LinkType(true, '1', 'user'))->toJson()],
            ['https://www.youtube.com/user/user-name', (new LinkType(true, 'user-name', 'user'))->toJson()],
        ];
    }

    public function normalizeUrlProvider(): array
    {
        return [
            ['https://www.youtube.com/user/1', 'https://www.youtube.com/user/1'],
            ['https://www.youtube.com/channel/1', 'https://www.youtube.com/channel/1'],
            ['https://www.youtu.be/1', 'https://www.youtube.com/watch?v=1'],
            ['https://www.youtube.com/embed/1', 'https://www.youtube.com/watch?v=1'],
            ['https://www.youtube.com?v=1', 'https://www.youtube.com/watch?v=1'],
            ['https://www.youtube.com/watch?v=1', 'https://www.youtube.com/watch?v=1'],
        ];
    }
}
