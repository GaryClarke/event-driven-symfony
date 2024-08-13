<?php

declare(strict_types=1);

namespace App\Tests\Unit\Utils;

use App\Utils\ArrayFilter;
use PHPUnit\Framework\TestCase;

class ArrayFilterTest extends TestCase
{
    public function testRemoveEmptyKeysRecursively(): void
    {
        // ARRANGE
        $array = [
            'key1' => [
                'a' => 'not-null',
                'b' => null, // !
                'c' => [
                    'd' => 'not-null',
                    'e' => null, // !
                    'f' => '' // !
                ]
            ],
            'key2' => [
                'a' => 'not-null',
                'b' => [
                    'c' => null, // !
                    'd' => [
                        'f' => 'not-null',
                        'g' => null, // !
                    ]
                ],
                'e' => '' // !
            ]
        ];

        // ACT
        ArrayFilter::removeEmptyKeysRecursively($array);

        // ASSERT
        $this->assertSame([
            'key1' => [
                'a' => 'not-null',
                'c' => [
                    'd' => 'not-null'
                ]
            ],
            'key2' => [
                'a' => 'not-null',
                'b' => [
                    'd' => [
                        'f' => 'not-null'
                    ]
                ]
            ]
        ], $array);
    }
}