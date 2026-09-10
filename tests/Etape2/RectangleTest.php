<?php

declare(strict_types=1);

use Shapes\Point;
use Shapes\Rectangle;
use Shapes\Shape;

it('est une forme', function (): void {
    expect(new Rectangle(new Point(0, 0), 10, 10))->toBeInstanceOf(Shape::class);
})->group('etape-2');

it('retient son origine, sa largeur et sa hauteur', function (): void {
    $origin = new Point(5, 8);
    $rectangle = new Rectangle($origin, 250, 400, '#ff0000');

    expect($rectangle->origin)->toBe($origin)
        ->and($rectangle->origin->x)->toBe(5.0)
        ->and($rectangle->width)->toBe(250.0)
        ->and($rectangle->height)->toBe(400.0)
        ->and($rectangle->color)->toBe('#FF0000');
})->group('etape-2');

it('ne change pas de dimensions : elles sont readonly', function (): void {
    $rectangle = new Rectangle(new Point(0, 0), 10, 10);

    $rectangle->width = 20;
})->throws(Error::class)->group('etape-2');

it('calcule son aire et son périmètre', function (): void {
    $rectangle = new Rectangle(new Point(0, 0), 4, 5);

    expect($rectangle->area())->toBe(20.0)
        ->and($rectangle->perimeter())->toBe(18.0);
})->group('etape-2');

it('refuse une dimension nulle ou négative', function (float $width, float $height): void {
    new Rectangle(new Point(0, 0), $width, $height);
})->with([[0, 10], [10, 0], [-1, 10], [10, -1]])
    ->throws(InvalidArgumentException::class)
    ->group('etape-2');
