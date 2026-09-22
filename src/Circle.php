<?php

declare(strict_types=1);

namespace Shapes;

/**
 * ÉTAPE 2 — Un cercle : un centre et un rayon.
 *
 * Constructeur attendu : `new Circle(Point $center, float $radius, string $color = '#000000')`.
 * Doit exposer `public readonly Point $center` et `public readonly float $radius`
 * (promotion de constructeur). Un rayon nul ou négatif lève
 * `\InvalidArgumentException` : la validation vit dans le corps du constructeur.
 * N'oubliez pas d'appeler `parent::__construct($color)`.
 */
final class Circle extends Shape
{
    public readonly point $center;
    public readonly float $radius;
    

    // TODO : promouvoir `$center` et `$radius` en `public readonly`, valider le rayon.
    public function __construct(Point $center, float $radius, string $color = self::DEFAULT_COLOR)
    {
        $this->center  = $center;
        $this->radius = $radius;
        parent::__construct($color);

        if($radius <=0){
            throw new \InvalidArgumentException(
                'Le rayon doit être strictement positif.'
            );
        }
    }    

    public function diameter(): float
    {
        return ($this->radius*2);
    }

    /** TODO : π × r². La constante `M_PI` existe déjà en PHP. */
    public function area(): float
    {
        return (M_PI * $this->radius**2);
    }
}
