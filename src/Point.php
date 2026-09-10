<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 1 — Un point du plan : deux coordonnées, et rien d'autre.
 *
 * Un point est une valeur, pas un objet qui vit sa vie : une fois construit,
 * il ne change plus. Rendez la classe `readonly` et déclarez `x` et `y`
 * en promotion de constructeur (`public float $x`). Pas de `x()` ni de `y()` :
 * une propriété `readonly` se lit directement, `$point->x`.
 *
 * Indice : `final readonly class Point implements \Stringable`.
 */
final class Point
{
    // TODO : le constructeur. Deux paramètres promus, `public float $x` et
    // `public float $y`. Rien d'autre à écrire dans le corps.

    /**
     * TODO : rendre un NOUVEAU point décalé de $dx et $dy.
     * Attention : l'objet courant ne doit pas bouger.
     */
    public function translate(float $dx, float $dy): self
    {
        throw new \LogicException('À implémenter');
    }

    /** TODO : la distance euclidienne. Racine de (dx² + dy²). */
    public function distanceTo(self $other): float
    {
        throw new \LogicException('À implémenter');
    }

    /** TODO : deux points sont égaux s'ils ont les mêmes coordonnées. */
    public function equals(self $other): bool
    {
        throw new \LogicException('À implémenter');
    }

    /** TODO : rendre « (10, -3) ». */
    public function __toString(): string
    {
        throw new \LogicException('À implémenter');
    }
}
