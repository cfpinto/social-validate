<?php

namespace SocialValidate\Test\Validators;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use SocialValidate\Validators\Facebook;
use SocialValidate\Validators\LinkType;

class FacebookTest extends AbstractValidatorTest
{
    protected UuidFactory $uuidFactory;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->uuidFactory = new UuidFactory();
    }

    protected function setUp(): void
    {
        $this->validator = new Facebook();
    }

    public function isValidProvider(): array
    {
        return [
            ['https://facebook.com', false],
            ['https://facebook.com/' . $this->uuidFactory->uuid4() . '/posts/' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/' . $this->uuidFactory->uuid4() . '/activity/' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/' . $this->uuidFactory->uuid4() . '/photos/' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/notes/' . $this->uuidFactory->uuid4() . '/' . $this->uuidFactory->uuid4() . '/' . $this->uuidFactory->uuid4() . '/', true],
            ['https://facebook.com/photo.php?fbid=' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/photo.php?story_fbid=' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/permalink.php?fbid=' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/permalink.php?story_fbid=' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/photos/' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/questions/' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/media/set?set=' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/'. $this->uuidFactory->uuid4() . '/videos/' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/video.php?id=' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/video.php?v=' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/pages/' . $this->uuidFactory->uuid4(), true],
            ['https://facebook.com/' . $this->uuidFactory->uuid4(), true],
        ];
    }

    public function splitProvider(): array
    {
        return [
            ['https://facebook.com/1/posts/2', (new LinkType(true, '2', 'posts'))->toJson()],
            ['https://facebook.com/1/activity/2', (new LinkType(true, '2', 'activity'))->toJson()],
            ['https://facebook.com/1/photos/2', (new LinkType(true, '2', 'photos'))->toJson()],
            ['https://facebook.com/notes/1/2/3/', (new LinkType(true, '3', 'notes'))->toJson()],
            ['https://facebook.com/photo.php?fbid=2', (new LinkType(true, '2', 'photo'))->toJson()],
            ['https://facebook.com/photo.php?story_fbid=2', (new LinkType(true, '2', 'photo'))->toJson()],
            ['https://facebook.com/permalink.php?fbid=2', (new LinkType(true, '2', 'permalink'))->toJson()],
            ['https://facebook.com/permalink.php?story_fbid=2', (new LinkType(true, '2', 'permalink'))->toJson()],
            ['https://facebook.com/photos/2', (new LinkType(true, '2', 'photos'))->toJson()],
            ['https://facebook.com/questions/2', (new LinkType(true, '2', 'questions'))->toJson()],
            ['https://facebook.com/media/set?set=2', (new LinkType(true, '2', 'media_set'))->toJson()],
            ['https://facebook.com/1/videos/2', (new LinkType(true, '2', 'videos'))->toJson()],
            ['https://facebook.com/video.php?id=2', (new LinkType(true, '2', 'videos'))->toJson()],
            ['https://facebook.com/video.php?v=2', (new LinkType(true, '2', 'videos'))->toJson()],
            ['https://facebook.com/pages/2', (new LinkType(true, '2', 'pages'))->toJson()],
            ['https://facebook.com/2', (new LinkType(true, '2', 'profile'))->toJson()],
        ];
    }

    public function normalizeUrlProvider(): array
    {
        return [
            ['https://facebook.com/photo/sjhkhkhaskl', 'https://facebook.com/photo/sjhkhkhaskl']
        ];
    }
}
