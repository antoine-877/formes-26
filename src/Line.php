<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 1 — Un segment, défini par ses deux extrémités.
 *
 * Constructeur attendu : `new Line(Point $start, Point $end, string $color = '#000000')`.
 * Doit exposer `public readonly Point $start` et `public readonly Point $end`
 * (promotion de constructeur) : on lit `$line->start`, pas de `start()`.
 * La couleur est normalisée en majuscules (`#ff0000` devient `#FF0000`) et se
 * lit `$line->color`.
 *
 * 
 * ÉTAPE 2 — Vous reviendrez ici : `Line` devra hériter de `Shape`, perdre sa
 * propre couleur au profit de celle du parent, et implémenter `area()`.
 */
final class Line
{
    // TODO étape 1 : promouvoir `$start` et `$end` en `public readonly`, et garder
    //   la couleur dans une `public readonly string $color` validée et en majuscules.

    public readonly point $start;
    public readonly point $end;
    public string $color = '#000000';

    // TODO étape 2 : `extends Shape`, supprimer la couleur ici, et
    //   appeler `parent::__construct($color)`.
    public function __construct(Point $start, Point $end, string $color = '#000000')
    {
        $this->start  = $start;
        $this->end = $end;
        $this->color = strtoupper($color);
    }

    /** TODO : la longueur du segment. Point vous rend déjà ce service. */
    public function length(): float
    {
        return $this->start->distanceTo($this->end);
    }
}
