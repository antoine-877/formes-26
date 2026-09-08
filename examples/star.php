<?php

declare(strict_types=1);

/**
 * Le rendu final de l'atelier : une étoile jaune sur fond bleu nuit.
 *
 * Lancez-le avec :
 *     php examples/star.php
 *
 * Il écrit examples/star.svg — ouvrez le fichier dans un navigateur.
 */

require __DIR__.'/../vendor/autoload.php';

use Shapes\Canvas;
use Shapes\Circle;
use Shapes\Point;
use Shapes\Polygon;
use Shapes\Renderers\SvgRenderer;

$canvas = new Canvas(500, 500, '#0B1B3A');

// La lune, derrière l'étoile : elle est ajoutée d'abord, donc dessinée en dessous.
$canvas->add(new Circle(new Point(420, 80), 40, '#F4F1DE'));

// L'étoile : dix sommets, alternance pointe / creux.
$canvas->add(new Polygon([
    new Point(250, 0),
    new Point(300, 200),
    new Point(500, 200),
    new Point(350, 300),
    new Point(400, 500),
    new Point(250, 350),
    new Point(100, 500),
    new Point(150, 300),
    new Point(0, 200),
    new Point(200, 200),
], '#FFD23F'));

$renderer = new SvgRenderer($canvas);
$path = __DIR__.'/star.svg';
$renderer->save($path);

printf("Étoile écrite dans %s (%d formes, aire totale : %.0f px²).%s",
    $path,
    count($canvas->shapes()),
    $canvas->totalArea(),
    PHP_EOL,
);
