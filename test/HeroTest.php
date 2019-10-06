<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class HeroTest extends TestCase
{
    public function testHeroFindID(): void
    {
        $this->assertInstanceOf(
            Hero::class,
            Hero::__construct([
                'id' => 100,
                'name' => 'Elvis',
                'experience' => 300.2,
                'level' => 10,
                'health' => 100,
                'strength' => 70,
                'defence' => 50,
                'speed' => 20,
                'luck' => 20.8,
            ])
        );
    }

    public function testInvalidID(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Hero::getAttributes(null);
    }

    public function testHeroID(): void
    {
        $this->assertEquals(
            1,
            Email::getAttributes(1)
        );
    }
}