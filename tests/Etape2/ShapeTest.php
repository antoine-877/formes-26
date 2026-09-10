<?php

declare(strict_types=1);

use Shapes\Circle;
use Shapes\Line;
use Shapes\Point;
use Shapes\Rectangle;
use Shapes\Shape;

it('est abstraite : on ne peut pas l\'instancier', function (): void {
    expect((new ReflectionClass(Shape::class))->isAbstract())->toBeTrue();
})->group('etape-2');

it('impose area() à ses enfants', function (): void {
    $method = new ReflectionMethod(Shape::class, 'area');

    expect($method->isAbstract())->toBeTrue()
        ->and((string) $method->getReturnType())->toBe('float');
})->group('etape-2');

it('est le parent de toutes les formes, ligne comprise', function (): void {
    $shapes = [
        new Line(new Point(0, 0), new Point(1, 1)),
        new Circle(new Point(0, 0), 1),
        new Rectangle(new Point(0, 0), 1, 1),
    ];

    foreach ($shapes as $shape) {
        expect($shape)->toBeInstanceOf(Shape::class);
    }
})->group('etape-2');

it('donne la même couleur par défaut à toutes les formes', function (): void {
    expect((new Circle(new Point(0, 0), 5))->color)->toBe('#000000')
        ->and((new Rectangle(new Point(0, 0), 5, 5))->color)->toBe('#000000');
})->group('etape-2');

it('ne change pas de couleur : elle est readonly', function (): void {
    $circle = new Circle(new Point(0, 0), 5);

    $circle->color = '#FF0000';
})->throws(Error::class)->group('etape-2');

it('refuse une couleur qui n\'est pas un hexadécimal à six chiffres', function (string $color): void {
    new Circle(new Point(0, 0), 5, $color);
})->with(['rouge', '#FFF', '000000', '#GGGGGG', ''])
    ->throws(InvalidArgumentException::class)
    ->group('etape-2');

it('permet de calculer une aire sans savoir quelle forme on tient', function (): void {
    /** @var list<Shape> $shapes */
    $shapes = [
        new Rectangle(new Point(0, 0), 4, 5),
        new Line(new Point(0, 0), new Point(9, 9)),
    ];

    $total = 0.0;
    foreach ($shapes as $shape) {
        $total += $shape->area();
    }

    expect($total)->toBe(20.0);
})->group('etape-2');
