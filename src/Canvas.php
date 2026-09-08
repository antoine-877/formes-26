<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 3 — La feuille de dessin. Une taille, un fond, et une liste de formes.
 *
 * Constructeur attendu :
 * `new Canvas(float $width, float $height, string $background = '#FFFFFF')`.
 * Taille nulle ou négative, ou fond invalide : `\InvalidArgumentException`.
 *
 * Remarquez : `Canvas` n'hérite PAS de `Shape`. Un canvas n'est pas une forme,
 * il en contient. C'est de la composition, pas de l'héritage.
 */
final class Canvas
{
    /** @var list<Shape> */
    private array $shapes = [];

    // TODO : le constructeur.

    public function width(): float
    {
        throw new \LogicException('À implémenter');
    }

    public function height(): float
    {
        throw new \LogicException('À implémenter');
    }

    public function background(): string
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

    /** @return list<Shape> */
    public function shapes(): array
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
