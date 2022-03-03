<?php

namespace SocialValidate\Test;

use PHPUnit\Framework\TestCase;
use SocialValidate\Validator;
use SocialValidate\Validators\Facebook;
use SocialValidate\Validators\Instagram;
use SocialValidate\Validators\Twitch;
use SocialValidate\Validators\Twitter;
use SocialValidate\Validators\ValidatorInterface;
use SocialValidate\Validators\Youtube;

class ValidatorTest extends TestCase
{
    /**
     * @covers
     * @return void
     */
    public function testItCanGetAnExistingDriver()
    {
        $validator = new Validator(['facebook' => Facebook::class]);

        $this->assertInstanceOf(Facebook::class, $validator->driver('facebook'));
    }

    /**
     * @covers
     * @return void
     */
    public function testItThrowsExceptionWhenDriverDoesNotExists()
    {
        $validator = new Validator(['facebook' => Facebook::class]);

        $this->expectException(\RuntimeException::class);
        $validator->driver('instagram');
    }

    /**
     * @covers
     * @dataProvider itDetectsCorrectDriverDataProvider
     * @return void
     */
    public function testItDetectsCorrectDriver(string $url, ?string $expected)
    {
        $drivers = [
            'facebook' => Facebook::class,
            'twitch' => Twitch::class,
            'twitter' => Twitter::class,
            'instagram' => Instagram::class,
            'youtube' => Youtube::class,
        ];
        $validator = new Validator($drivers);
        $this->assertEquals($expected, $validator->guess($url));
    }

    public function itDetectsCorrectDriverDataProvider(): array
    {
        return [
            ['youtube.com', null],
            ['facebook.com', null],
            ['twitter.com', null],
            ['twitch.tv.com', null],
            ['instagram.com', null],
            ['instagram.com/p/1', 'instagram'],
            ['instagram.com/pages/1', 'instagram'],
            ['instagram.com/gram-user', 'instagram'],
            ['twitch.tv/videos/1', 'twitch'],
            ['twitch.tv/1', 'twitch'],
            ['twitter.com/user/status/1', 'twitter'],
            ['twitter.com/user/moments/1', 'twitter'],
            ['twitter.com/user-name', 'twitter'],
            ['https://www.youtube.com?v=1', 'youtube'],
            ['https://www.youtube.com/channel/1', 'youtube'],
            ['https://www.youtube.com/channel/channel-name', 'youtube'],
            ['https://www.youtube.com/user/1', 'youtube'],
            ['https://www.youtube.com/user/user-name', 'youtube'],
            ['https://facebook.com/1/posts/2', 'facebook'],
            ['https://facebook.com/1/activity/2', 'facebook'],
            ['https://facebook.com/1/photos/2', 'facebook'],
            ['https://facebook.com/notes/1/2/3/', 'facebook'],
            ['https://facebook.com/photo.php?fbid=2', 'facebook'],
            ['https://facebook.com/photo.php?story_fbid=2', 'facebook'],
            ['https://facebook.com/permalink.php?fbid=2', 'facebook'],
            ['https://facebook.com/permalink.php?story_fbid=2', 'facebook'],
            ['https://facebook.com/photos/2', 'facebook'],
            ['https://facebook.com/questions/2', 'facebook'],
            ['https://facebook.com/media/set?set=2', 'facebook'],
            ['https://facebook.com/1/videos/2', 'facebook'],
            ['https://facebook.com/video.php?id=2', 'facebook'],
            ['https://facebook.com/video.php?v=2', 'facebook'],
            ['https://facebook.com/pages/2', 'facebook'],
            ['https://facebook.com/2', 'facebook'],
        ];
    }
}
