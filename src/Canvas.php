<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 3 — La feuille de dessin. Une taille, un fond, et une liste de formes.
 *
 * Constructeur attendu :
 * `new Canvas(float $width, float $height, string $background = '#FFFFFF')`.
 * Doit exposer `public readonly float $width`, `public readonly float $height`
 * et `public readonly string $background` (normalisé en majuscules).
 * Taille nulle ou négative, ou fond invalide : `\InvalidArgumentException`.
 *
 * La liste des formes est `public private(set)` : tout le monde la lit
 * (`$canvas->shapes`), seul `add()` l'écrit.
 *
 * Remarquez : `Canvas` n'hérite PAS de `Shape`. Un canvas n'est pas une forme,
 * il en contient. C'est de la composition, pas de l'héritage.
 */
final class Canvas
{
    /** @var list<Shape> */
    public private(set) array $shapes = [];

    /** TODO : `public readonly string $background;` déclarée ici, remplie par le constructeur. */

    // TODO : promouvoir `$width` et `$height` en `public readonly`, valider,
    // puis `$this->background = strtoupper($background);`.
    public function __construct(float $width, float $height, string $background = '#FFFFFF')
    {
        throw new \LogicException('À implémenter');
    }

    /**
     * TODO : ajouter la forme à la liste.
     *
     * Le type du paramètre suffit à refuser un `Point` : PHP lève un `TypeError`
     * tout seul, vous n'avez aucun `if` à écrire.
     */
    public function add(Shape $shape): void
    {
        throw new \LogicException('À implémenter');
    }

    public function isEmpty(): bool
    {
        throw new \LogicException('À implémenter');
    }

    /**
     * TODO : la somme des aires de toutes les formes.
     *
     * C'est le polymorphisme : vous appelez `area()` sans jamais demander
     * « et toi, tu es quoi ? ». Aucun `if`, aucun `instanceof`.
     */
    public function totalArea(): float
    {
        throw new \LogicException('À implémenter');
    }
}
