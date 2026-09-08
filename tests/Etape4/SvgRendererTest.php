<?php

declare(strict_types=1);

use Shapes\Canvas;
use Shapes\Circle;
use Shapes\Line;
use Shapes\Point;
use Shapes\Polygon;
use Shapes\Rectangle;
use Shapes\Renderers\Renderer;
use Shapes\Renderers\SvgRenderer;

it('respecte le contrat Renderer', function (): void {
    $renderer = new SvgRenderer(new Canvas(100, 100));

    expect($renderer)->toBeInstanceOf(Renderer::class);
})->group('etape-4');

it('ouvre un document SVG à la taille du canvas', function (): void {
    $svg = (new SvgRenderer(new Canvas(500, 300)))->render();

    expect($svg)->toStartWith('<?xml version="1.0" encoding="UTF-8"?>')
        ->and($svg)->toContain('xmlns="http://www.w3.org/2000/svg"')
        ->and($svg)->toContain('width="500"')
        ->and($svg)->toContain('height="300"')
        ->and($svg)->toContain('viewBox="0 0 500 300"')
        ->and(trim($svg))->toEndWith('</svg>');
})->group('etape-4');

it('peint le fond du canvas avant tout le reste', function (): void {
    $svg = (new SvgRenderer(new Canvas(500, 500, '#00ffff')))->render();

    expect($svg)->toContain('<rect x="0" y="0" width="500" height="500" fill="#00FFFF" />');
})->group('etape-4');

it('écrit les nombres sans décimales inutiles', function (): void {
    $canvas = new Canvas(500, 500);
    $canvas->add(new Circle(new Point(250, 250), 12.5));

    expect((new SvgRenderer($canvas))->render())
        ->toContain('<circle cx="250" cy="250" r="12.5" fill="#000000" />');
})->group('etape-4');

it('dessine une ligne', function (): void {
    $canvas = new Canvas(500, 500);
    $canvas->add(new Line(new Point(1, 1), new Point(1, 500), '#0000ff'));

    expect((new SvgRenderer($canvas))->render())
        ->toContain('<line x1="1" y1="1" x2="1" y2="500" stroke="#0000FF" stroke-width="1" />');
})->group('etape-4');

it('dessine un rectangle', function (): void {
    $canvas = new Canvas(500, 500);
    $canvas->add(new Rectangle(new Point(50, 50), 250, 400, '#ff0000'));

    expect((new SvgRenderer($canvas))->render())
        ->toContain('<rect x="50" y="50" width="250" height="400" fill="#FF0000" />');
})->group('etape-4');

it('dessine un polygone', function (): void {
    $canvas = new Canvas(500, 500);
    $canvas->add(new Polygon([
        new Point(1, 1),
        new Point(1, 500),
        new Point(500, 500),
    ], '#ff0000'));

    expect((new SvgRenderer($canvas))->render())
        ->toContain('<polygon points="1,1 1,500 500,500" fill="#FF0000" />');
})->group('etape-4');

it('dessine les formes dans l\'ordre où elles ont été ajoutées', function (): void {
    $canvas = new Canvas(500, 500);
    $canvas->add(new Rectangle(new Point(0, 0), 100, 100, '#ff0000'));
    $canvas->add(new Circle(new Point(50, 50), 10, '#00ff00'));

    $svg = (new SvgRenderer($canvas))->render();

    expect(strpos($svg, '#FF0000'))->toBeLessThan(strpos($svg, '#00FF00'));
})->group('etape-4');

it('dessine une étoile jaune', function (): void {
    $canvas = new Canvas(500, 500);
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
    ], '#FFFF00'));

    expect((new SvgRenderer($canvas))->render())->toContain(
        '<polygon points="250,0 300,200 500,200 350,300 400,500 250,350 100,500 150,300 0,200 200,200" fill="#FFFF00" />'
    );
})->group('etape-4');

it('écrit le SVG dans un fichier', function (): void {
    $path = outputPath('test.svg');
    if (file_exists($path)) {
        unlink($path);
    }

    $canvas = new Canvas(200, 200, '#eeeeee');
    $canvas->add(new Circle(new Point(100, 100), 50, '#ff0000'));
    $renderer = new SvgRenderer($canvas);
    $renderer->save($path);

    expect($path)->toBeReadableFile()
        ->and(file_get_contents($path))->toBe($renderer->render());
})->group('etape-4');
