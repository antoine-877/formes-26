<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 2 — Un cercle : un centre et un rayon.
 *
 * Constructeur attendu : `new Circle(Point $center, float $radius, string $color = '#000000')`.
 * Doit exposer `public readonly Point $center` et `public readonly float $radius`
 * (promotion de constructeur). Un rayon nul ou négatif lève
 * `\InvalidArgumentException` : la validation vit dans le corps du constructeur.
 * N'oubliez pas d'appeler `parent::__construct($color)`.
 */
final class Circle extends Shape
{
    // TODO : promouvoir `$center` et `$radius` en `public readonly`, valider le rayon.
    public function __construct(Point $center, float $radius, string $color = self::DEFAULT_COLOR)
    {
        throw new \LogicException('À implémenter');
    }

    public function diameter(): float
    {
        throw new \LogicException('À implémenter');
    }

    /** TODO : π × r². La constante `M_PI` existe déjà en PHP. */
    public function area(): float
    {
        throw new \LogicException('À implémenter');
    }
}
