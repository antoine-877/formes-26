<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 3 — Une ligne brisée fermée : trois sommets au minimum.
 *
 * Constructeur attendu : `new Polygon(array $points, string $color = '#000000')`.
 * Moins de trois sommets, ou un élément qui n'est pas un `Point` :
 * `\InvalidArgumentException`.
 *
 * Les sommets sont exposés en `public readonly array $points` : on lit
 * `$polygon->points`, pas de `points()`. `pointCount()` reste une méthode.
 *
 * Le type `array` de PHP ne dit pas ce qu'il contient : c'est à vous de
 * vérifier, avec `instanceof`.
 */
final class Polygon extends Shape
{
    /** @var list<Point> Les sommets, dans l'ordre. */
    public readonly array $points;

    /** @param list<Point> $points */
    public function __construct(array $points, string $color = self::DEFAULT_COLOR)
    {
        throw new \LogicException('À implémenter');
    }

    public function pointCount(): int
    {
        throw new \LogicException('À implémenter');
    }

    /**
     * TODO : la formule du lacet (shoelace).
     *
     * On parcourt les sommets deux par deux, en bouclant du dernier au premier
     * (`($i + 1) % $count`), on additionne `x_i × y_suivant - x_suivant × y_i`,
     * et l'aire vaut la valeur absolue de la somme divisée par 2.
     */
    public function area(): float
    {
        throw new \LogicException('À implémenter');
    }
}
