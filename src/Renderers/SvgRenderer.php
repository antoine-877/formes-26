<?php

declare(strict_types=1);

namespace Shapes\Renderers;

use Shapes\Canvas;
use Shapes\Shape;
use Shapes\Line;
use Shapes\Circle;
use Shapes\Rectangle;
use Shapes\Polygon;

/**
 * ÉTAPE 4 — Transforme un Canvas en document SVG, c'est-à-dire en texte.
 *
 * Le renderer reçoit le canvas dans son constructeur : il ne le fabrique pas,
 * il le regarde. `new SvgRenderer(Canvas $canvas)`.
 *
 * Le document attendu, ligne par ligne :
 *
 *   <?xml version="1.0" encoding="UTF-8"?>
 *   <svg xmlns="http://www.w3.org/2000/svg" width="500" height="500" viewBox="0 0 500 500">
 *     <rect x="0" y="0" width="500" height="500" fill="#FFFFFF" />
 *     … une balise par forme, dans l'ordre d'ajout, indentée de deux espaces …
 *   </svg>
 *
 * Les balises par forme :
 *   Line      <line x1="1" y1="1" x2="1" y2="500" stroke="#0000FF" stroke-width="1" />
 *   Circle    <circle cx="250" cy="250" r="150" fill="#00FF00" />
 *   Rectangle <rect x="50" y="50" width="250" height="400" fill="#FF0000" />
 *   Polygon   <polygon points="1,1 1,500 500,500" fill="#FF0000" />
 */
final class SvgRenderer implements Renderer
{
    // TODO : le constructeur (`private readonly Canvas $canvas`).

    public function __construct(private Canvas $canvas) {}

    public function render(): string
    {
        $shapes = "";
        foreach ($this->canvas->shapes as $shape) {
            $shapes .= $this->renderShape($shape);
        }

        return <<<SVG
    <?xml version="1.0" encoding="UTF-8"?>
        <svg xmlns="http://www.w3.org/2000/svg" width="{$this->canvas->width}"
        height="{$this->canvas->height}" viewBox="0 0 {$this->canvas->width} {$this->canvas->height}">
        <rect x="0" y="0" width="{$this->canvas->width}" height="{$this->canvas->height}" fill="{$this->canvas->background}" />
        $shapes
    </svg>
    SVG;
    }

    /** TODO : créer le dossier s'il n'existe pas, puis `file_put_contents()`. */
    public function save(string $path): void
    {
        $directory = dirname($path);

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents($path, $this->render());
    }

    /**
     * TODO : une forme, une balise.
     *
     * Indice : `match (true) { $shape instanceof Line => …, … }` évite une pile
     * de `if`. Le cas `default` doit lever `\InvalidArgumentException` : un
     * renderer qui ne connaît pas une forme doit le dire, pas dessiner du vide.
     */
    private function renderShape(Shape $shape): string
    {
        return match (true) {
            $shape instanceof Line => sprintf(
                '  <line x1="1" y1="1" x2="1" y2="500" stroke="#0000FF" stroke-width="1" />' . PHP_EOL,
                $this->number($shape->start->x),
                $this->number($shape->start->y),
                $this->number($shape->end->x),
                $this->number($shape->end->y),
                $shape->color,
            ),

            $shape instanceof Circle => sprintf(
                '  <circle cx="%s" cy="%s" r="%s" fill="%s" />' . PHP_EOL,
                $this->number($shape->center->x),
                $this->number($shape->center->y),
                $this->number($shape->radius),
                $shape->color
            ),

            $shape instanceof Rectangle => sprintf(
                '  <rect x="%s" y="%s" width="%s" height="%s" fill="%s" />' . PHP_EOL,
                $this->number($shape->origin->x),
                $this->number($shape->origin->y),
                $this->number($shape->width),
                $this->number($shape->height),
                $shape->color
            ),

            $shape instanceof Polygon => sprintf(
                '<polygon points="%s" fill="%s" />' . PHP_EOL,
                $this->getPolygonPoints($shape),
                $shape->color,
            ),

            default => throw new \InvalidArgumentException(
                'Forme non supportée : ' . $shape::class
            ),
        };
    }

    private function getPolygonPoints(Polygon $polygon): string
    {
        $points = '';

        foreach ($polygon->points as $point) {
            $points .= $point->x . ',' . $point->y . ' ';
        }

        return trim($points);
    }

    /**
     * TODO : 500.0 doit s'écrire « 500 » dans le SVG, pas « 500.00 »,
     * et 12.5 doit s'écrire « 12.5 ».
     *
     * Indice : `number_format()`, puis `rtrim()` deux fois.
     */
    private function number(float $value): string
    {
        return rtrim(
            rtrim(number_format($value, 2, '.', ''), '0'),
            '.'
        );
    }
}
