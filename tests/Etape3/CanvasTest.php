<?php

declare(strict_types=1);

use Shapes\Canvas;
use Shapes\Circle;
use Shapes\Line;
use Shapes\Point;
use Shapes\Rectangle;

it('a une taille et un fond blanc par défaut', function (): void {
    $canvas = new Canvas(500, 300);

    expect($canvas->width())->toBe(500.0)
        ->and($canvas->height())->toBe(300.0)
        ->and($canvas->background())->toBe('#FFFFFF');
})->group('etape-3');

it('accepte un fond personnalisé', function (): void {
    expect((new Canvas(10, 10, '#00ffff'))->background())->toBe('#00FFFF');
})->group('etape-3');

it('naît vide', function (): void {
    $canvas = new Canvas(100, 100);

    expect($canvas->shapes())->toBeArray()->toBeEmpty()
        ->and($canvas->isEmpty())->toBeTrue();
})->group('etape-3');

it('accumule les formes qu\'on lui ajoute', function (): void {
    $canvas = new Canvas(100, 100);
    $rectangle = new Rectangle(new Point(0, 0), 10, 10);

    $canvas->add($rectangle);
    expect($canvas->shapes())->toHaveCount(1)
        ->and($canvas->shapes()[0])->toBe($rectangle)
        ->and($canvas->isEmpty())->toBeFalse();

    $canvas->add(new Circle(new Point(5, 5), 3));
    expect($canvas->shapes())->toHaveCount(2);
})->group('etape-3');

it('refuse ce qui n\'est pas une forme', function (): void {
    $canvas = new Canvas(100, 100);

    $canvas->add(new Point(0, 0));
})->throws(TypeError::class)->group('etape-3');

it('additionne les aires de toutes ses formes', function (): void {
    $canvas = new Canvas(100, 100);
    $canvas->add(new Rectangle(new Point(0, 0), 4, 5));
    $canvas->add(new Rectangle(new Point(0, 0), 2, 10));
    $canvas->add(new Line(new Point(0, 0), new Point(50, 50)));

    expect($canvas->totalArea())->toBe(40.0);
})->group('etape-3');

it('refuse une taille nulle ou négative', function (float $width, float $height): void {
    new Canvas($width, $height);
})->with([[0, 100], [100, 0], [-10, 100]])
    ->throws(InvalidArgumentException::class)
    ->group('etape-3');
