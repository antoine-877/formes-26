<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 2 — Ce que toutes les formes ont en commun : une couleur, et une aire.
 *
 * La classe est `abstract` : `new Shape('#FF0000')` doit être impossible.
 * Une forme sans forme, ça n'existe pas.
 *
 * Le constructeur reçoit la couleur (`#RRGGBB`), la valide et la met en
 * majuscules. Une couleur invalide lève `\InvalidArgumentException`.
 *
 * Indice pour la validation : `preg_match('/^#[0-9A-Fa-f]{6}$/', $color)`.
 */
abstract class Shape
{
    public const string DEFAULT_COLOR = '#000000';

    // TODO : le constructeur, avec `protected string $color = self::DEFAULT_COLOR`
    // en promotion, la validation, et la normalisation en majuscules.

    public function color(): string
    {
        throw new \LogicException('À implémenter');
    }

    /**
     * Pas de corps : chaque forme calcule son aire à sa façon.
     * Une méthode abstraite est une obligation faite aux enfants.
     */
    abstract public function area(): float;
}
