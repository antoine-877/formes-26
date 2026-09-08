<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 1 — Un segment, défini par ses deux extrémités.
 *
 * Constructeur attendu : `new Line(Point $start, Point $end, string $color = '#000000')`.
 * La couleur est normalisée en majuscules (`#ff0000` devient `#FF0000`).
 *
 * ÉTAPE 2 — Vous reviendrez ici : `Line` devra hériter de `Shape`, perdre sa
 * propre couleur au profit de celle du parent, et implémenter `area()`.
 */
final class Line
{
    // TODO étape 1 : le constructeur (promotion + `readonly` sur les deux points).
    // TODO étape 2 : `extends Shape`, et `parent::__construct($color)`.

    public function start(): Point
    {
        throw new \LogicException('À implémenter');
    }

    public function end(): Point
    {
        throw new \LogicException('À implémenter');
    }

    public function color(): string
    {
        throw new \LogicException('À implémenter');
    }

    /** TODO : la longueur du segment. Point vous rend déjà ce service. */
    public function length(): float
    {
        throw new \LogicException('À implémenter');
    }
}
