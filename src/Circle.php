<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 2 — Un cercle : un centre et un rayon.
 *
 * Constructeur attendu : `new Circle(Point $center, float $radius, string $color = '#000000')`.
 * Un rayon nul ou négatif lève `\InvalidArgumentException`.
 * N'oubliez pas d'appeler `parent::__construct($color)`.
 */
final class Circle extends Shape
{
    // TODO : le constructeur.

    public function center(): Point
    {
        throw new \LogicException('À implémenter');
    }

    public function radius(): float
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
