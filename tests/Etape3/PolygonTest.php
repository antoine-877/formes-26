<?php

declare(strict_types=1);

use Shapes\Point;
use Shapes\Polygon;
use Shapes\Shape;

it('est une forme', function (): void {
    $polygon = new Polygon([new Point(0, 0), new Point(0, 1), new Point(1, 1)]);

    expect($polygon)->toBeInstanceOf(Shape::class);
})->group('etape-3');

it('retient ses sommets dans l\'ordre', function (): void {
    $points = [new Point(0, 0), new Point(0, 10), new Point(10, 10), new Point(10, 0)];
    $polygon = new Polygon($points, '#00ff00');

    expect($polygon->points())->toHaveCount(4)
        ->and($polygon->pointCount())->toBe(4)
        ->and($polygon->points()[0])->toBe($points[0])
        ->and($polygon->points()[3])->toBe($points[3])
        ->and($polygon->color())->toBe('#00FF00');
})->group('etape-3');

it('accepte un triangle', function (): void {
    $polygon = new Polygon([new Point(0, 0), new Point(4, 0), new Point(0, 3)]);

    expect($polygon->pointCount())->toBe(3)
        ->and($polygon->area())->toBe(6.0);
})->group('etape-3');

it('calcule l\'aire d\'un carré', function (): void {
    $polygon = new Polygon([
        new Point(0, 0),
        new Point(10, 0),
        new Point(10, 10),
        new Point(0, 10),
    ]);

    expect($polygon->area())->toBe(100.0);
})->group('etape-3');

it('refuse moins de trois sommets', function (array $points): void {
    new Polygon($points);
})->with([
    'aucun' => [[]],
    'un' => [[new Point(0, 0)]],
    'deux' => [[new Point(0, 0), new Point(1, 1)]],
])->throws(InvalidArgumentException::class)
    ->group('etape-3');

it('refuse autre chose que des Point', function (): void {
    new Polygon([new Point(0, 0), new Point(1, 1), 'pas un point']);
})->throws(InvalidArgumentException::class)->group('etape-3');
