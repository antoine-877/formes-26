<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 2 — Un rectangle : son coin supérieur gauche, une largeur, une hauteur.
 *
 * Constructeur attendu :
 * `new Rectangle(Point $origin, float $width, float $height, string $color = '#000000')`.
 * Doit exposer `public readonly Point $origin`, `public readonly float $width`
 * et `public readonly float $height` (promotion de constructeur).
 * Une dimension nulle ou négative lève `\InvalidArgumentException`.
 */
final class Rectangle extends Shape
{
    // TODO : promouvoir les trois propriétés en `public readonly`, valider les dimensions.
    public function __construct(Point $origin, float $width, float $height, string $color = self::DEFAULT_COLOR)
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
