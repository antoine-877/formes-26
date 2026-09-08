<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 2 — Un rectangle : son coin supérieur gauche, une largeur, une hauteur.
 *
 * Constructeur attendu :
 * `new Rectangle(Point $origin, float $width, float $height, string $color = '#000000')`.
 * Une dimension nulle ou négative lève `\InvalidArgumentException`.
 */
final class Rectangle extends Shape
{
    // TODO : le constructeur.

    public function origin(): Point
    {
        throw new \LogicException('À implémenter');
    }

    public function width(): float
    {
        throw new \LogicException('À implémenter');
    }

    public function height(): float
    {
        throw new \LogicException('À implémenter');
    }

    /** TODO : 2 × (largeur + hauteur). */
    public function perimeter(): float
    {
        throw new \LogicException('À implémenter');
    }

    public function area(): float
    {
        throw new \LogicException('À implémenter');
    }
}
