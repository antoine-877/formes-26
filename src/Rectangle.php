<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 2 — Un rectangle : son coin supérieur gauche, une largeur, une hauteur.
 *
 * Constructeur attendu :
 * `new Rectangle(Point $origin, float $width, float $height, string $color = '#000000')`.
 * Doit exposer `public readonly Point $origin`, `public readonly float $width`
 * et `public readonly float $height` (promotion de constructeur).
 * Une dimension nulle ou négative lève `\InvalidArgumentException`.
 */
final class Rectangle extends Shape
{
    public readonly Point $origin;
    public readonly float $width;
    public readonly float $height;


    // TODO : promouvoir les trois propriétés en `public readonly`, valider les dimensions.
    public function __construct(Point $origin, float $width, float $height, string $color = self::DEFAULT_COLOR)
    {
        $this->origin  = $origin;
        $this->width = $width;
        $this->height = $height;
        parent::__construct($color);

        if ($width <= 0 || $height <= 0) {
            throw new \InvalidArgumentException(
                'La dimmension doit être strictement positif.'
            );
        }}

    /** TODO : 2 × (largeur + hauteur). */
    public function perimeter(): float
    {
        return ($this->width + $this->height)*2;
    }

    public function area(): float
    {
        return ($this->width * $this->height);
    }
}
