<?php

namespace SocialValidate\Test\Validators;

use Ramsey\Uuid\Uuid;
use SocialValidate\Validators\Facebook;
use SocialValidate\Validators\LinkType;

class FacebookTest extends AbstractValidatorTest
{
    protected function setUp(): void
    {
        $this->validator = new Facebook();
    }

    public function isValidProvider(): array
    {
        return [
            ['https://facebook.com', false],
            ['https://facebook.com/' . Uuid::uuid4() . '/posts/' . Uuid::uuid4(), true],
            ['https://facebook.com/' . Uuid::uuid4() . '/activity/' . Uuid::uuid4(), true],
            ['https://facebook.com/' . Uuid::uuid4() . '/photos/' . Uuid::uuid4(), true],
            ['https://facebook.com/notes/' . Uuid::uuid4() . '/' . Uuid::uuid4() . '/' . Uuid::uuid4() . '/', true],
            ['https://facebook.com/photo.php?fbid=' . Uuid::uuid4(), true],
            ['https://facebook.com/photo.php?story_fbid=' . Uuid::uuid4(), true],
            ['https://facebook.com/permalink.php?fbid=' . Uuid::uuid4(), true],
            ['https://facebook.com/permalink.php?story_fbid=' . Uuid::uuid4(), true],
            ['https://facebook.com/photos/' . Uuid::uuid4(), true],
            ['https://facebook.com/questions/' . Uuid::uuid4(), true],
            ['https://facebook.com/media/set?set=' . Uuid::uuid4(), true],
            ['https://facebook.com/'. Uuid::uuid4() . '/videos/' . Uuid::uuid4(), true],
            ['https://facebook.com/video.php?id=' . Uuid::uuid4(), true],
            ['https://facebook.com/video.php?v=' . Uuid::uuid4(), true],
            ['https://facebook.com/pages/' . Uuid::uuid4(), true],
            ['https://facebook.com/' . Uuid::uuid4(), true],
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
