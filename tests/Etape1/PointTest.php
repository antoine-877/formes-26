<?php

declare(strict_types=1);

use Shapes\Point;

it('retient ses deux coordonnées', function (): void {
    $point = new Point(3, 4);

    expect($point->x)->toBe(3.0)
        ->and($point->y)->toBe(4.0);
})->group('etape-1');

it('accepte des coordonnées décimales et négatives', function (): void {
    $point = new Point(-2.5, 0.75);

    expect($point->x)->toBe(-2.5)
        ->and($point->y)->toBe(0.75);
})->group('etape-1');

it('est immuable : on ne peut pas réécrire une coordonnée', function (): void {
    $point = new Point(0, 0);

    $point->x = 10;
})->throws(Error::class)->group('etape-1');

it('ne se déplace pas : translate() rend un nouveau point', function (): void {
    $origin = new Point(1, 1);
    $moved = $origin->translate(4, -1);

    expect($moved)->toBeInstanceOf(Point::class)
        ->and($moved->x)->toBe(5.0)
        ->and($moved->y)->toBe(0.0)
        ->and($origin->x)->toBe(1.0)
        ->and($origin->y)->toBe(1.0)
        ->and($moved)->not->toBe($origin);
})->group('etape-1');

it('calcule la distance entre deux points', function (): void {
    $a = new Point(0, 0);
    $b = new Point(3, 4);

    expect($a->distanceTo($b))->toBe(5.0)
        ->and($b->distanceTo($a))->toBe(5.0)
        ->and($a->distanceTo($a))->toBe(0.0);
})->group('etape-1');

it('compare deux points par leurs coordonnées', function (): void {
    $a = new Point(2, 7);
    $b = new Point(2, 7);
    $c = new Point(2, 8);

    expect($a->equals($b))->toBeTrue()
        ->and($a->equals($c))->toBeFalse()
        ->and($a)->not->toBe($b);
})->group('etape-1');

it('se raconte en texte', function (): void {
    expect((string) new Point(10, -3))->toBe('(10, -3)');
})->group('etape-1');
