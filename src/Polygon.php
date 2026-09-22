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
 * Les sommets sont exposés en `public readonly array $points`.
 */
final class Polygon extends Shape
{
    /** @var list<Point> Les sommets, dans l'ordre. */
    public readonly array $points;

    /** @param list<Point> $points */
    public function __construct(array $points, string $color = self::DEFAULT_COLOR)
    {
        parent::__construct($color);

        if (count($points) < 3) {
            throw new \InvalidArgumentException(
                'Le polygone doit comporter au moins 3 points.'
            );
        }

        foreach ($points as $point) {
            if (!$point instanceof Point) {
                throw new \InvalidArgumentException(
                    'Tous les éléments doivent être des Point.'
                );
            }
        }

        $this->points = $points;
    }

    public function pointCount(): int
    {
        return count($this->points);
    }

    /**
     * Formule du lacet (shoelace).
     */
    public function area(): float
    {
        $sum = 0.0;
        $count = $this->pointCount();

        for ($i = 0; $i < $count; $i++) {
            $next = ($i + 1) % $count;

            $sum += $this->points[$i]->x * $this->points[$next]->y
                - $this->points[$next]->x * $this->points[$i]->y;
        }

        return abs($sum) / 2;
    }
}
