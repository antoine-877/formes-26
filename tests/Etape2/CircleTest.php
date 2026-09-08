<?php

declare(strict_types=1);

use Shapes\Circle;
use Shapes\Point;
use Shapes\Shape;

it('est une forme', function (): void {
    expect(new Circle(new Point(0, 0), 10))->toBeInstanceOf(Shape::class);
})->group('etape-2');

it('retient son centre et son rayon', function (): void {
    $center = new Point(50, 50);
    $circle = new Circle($center, 10);

    expect($circle->center())->toBe($center)
        ->and($circle->radius())->toBe(10.0)
        ->and($circle->diameter())->toBe(20.0)
        ->and($circle->color())->toBe('#000000');
})->group('etape-2');

it('calcule son aire', function (): void {
    expect((new Circle(new Point(0, 0), 1))->area())->toBe(M_PI)
        ->and(round((new Circle(new Point(0, 0), 10))->area(), 4))->toBe(314.1593);
})->group('etape-2');

it('refuse un rayon nul ou négatif', function (float $radius): void {
    new Circle(new Point(0, 0), $radius);
})->with([0, -1, -0.5])
    ->throws(InvalidArgumentException::class)
    ->group('etape-2');
