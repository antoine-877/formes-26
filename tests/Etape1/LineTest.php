<?php

declare(strict_types=1);

use Shapes\Line;
use Shapes\Point;

it('retient ses deux extrémités', function (): void {
    $start = new Point(0, 0);
    $end = new Point(10, 10);
    $line = new Line($start, $end);

    expect($line->start)->toBe($start)
        ->and($line->end)->toBe($end);
})->group('etape-1');

it('ne change pas d\'extrémités : elles sont readonly', function (): void {
    $line = new Line(new Point(0, 0), new Point(10, 10));

    $line->start = new Point(5, 5);
})->throws(Error::class)->group('etape-1');

it('est noire par défaut', function (): void {
    $line = new Line(new Point(0, 0), new Point(1, 1));

    expect($line->color)->toBe('#000000');
})->group('etape-1');

it('accepte une couleur et la normalise en majuscules', function (): void {
    $line = new Line(new Point(0, 0), new Point(1, 1), '#ff0000');

    expect($line->color)->toBe('#FF0000');
})->group('etape-1');

it('calcule sa longueur', function (): void {
    $line = new Line(new Point(1, 1), new Point(4, 5));

    expect($line->length())->toBe(5.0);
})->group('etape-1');

it('a une longueur nulle quand ses deux points sont confondus', function (): void {
    $line = new Line(new Point(2, 2), new Point(2, 2));

    expect($line->length())->toBe(0.0);
})->group('etape-1');
