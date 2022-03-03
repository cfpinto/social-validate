<?php

namespace SocialValidate\Test\Validators;

use PHPUnit\Framework\TestCase;
use SocialValidate\Validators\LinkType;

class LinkTypeTest extends TestCase
{
    /**
     * @dataProvider constructorProvider
     * @covers \SocialValidate\Validators\LinkType::__construct
     * @covers \SocialValidate\Validators\LinkType::__toString
     * @covers \SocialValidate\Validators\LinkType::toJson
     * @return void
     */
    public function testConstructor(bool $isValid, ?string $entityId, ?string $type, $expected)
    {
        $linkType = new LinkType($isValid, $entityId, $type);

        $this->assertEquals($expected, $linkType->toJson());
    }

    /**
     * @covers \SocialValidate\Validators\LinkType::__construct
     * @covers \SocialValidate\Validators\LinkType::__toString
     * @covers \SocialValidate\Validators\LinkType::toJson
     * @return void
     */
    public function testCanBeUsedAsString()
    {
        $str = (string)(new LinkType());

        $this->assertIsString($str);
    }

    /**
     * @covers \SocialValidate\Validators\LinkType::__construct
     * @covers \SocialValidate\Validators\LinkType::toJson
     * @return void
     */
    public function testCanBeEncodedToJsonString()
    {
        $json = (new LinkType())->toJson();

        $this->assertIsString($json);
        $this->assertEquals('{"isValid":false,"type":null,"id":null}', $json);
    }

    public function constructorProvider(): array
    {
        return [
            [true, '1', 'dash', '{"isValid":true,"type":"dash","id":"1"}'],
            [false, '1', 'dash', '{"isValid":false,"type":"dash","id":"1"}'],
            [true, null, null, '{"isValid":true,"type":null,"id":null}'],
            [false, null, null, '{"isValid":false,"type":null,"id":null}'],
            [false, '1', null, '{"isValid":false,"type":null,"id":"1"}'],
            [false, null, "dash", '{"isValid":false,"type":"dash","id":null}'],
        ];
    }
}
