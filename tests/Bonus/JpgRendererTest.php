<?php

declare(strict_types=1);

use Shapes\Canvas;
use Shapes\Point;
use Shapes\Polygon;
use Shapes\Renderers\JpgRenderer;
use Shapes\Renderers\Renderer;

beforeEach(function (): void {
    if (! extension_loaded('gd')) {
        $this->markTestSkipped("L'extension GD n'est pas installée.");
    }
});

it('respecte le contrat Renderer', function (): void {
    expect(new JpgRenderer(new Canvas(50, 50)))->toBeInstanceOf(Renderer::class);
})->group('bonus');

it('produit des octets JPEG', function (): void {
    $canvas = new Canvas(100, 100, '#00ff00');
    $canvas->add(new Polygon([
        new Point(50, 10),
        new Point(90, 90),
        new Point(10, 90),
    ], '#ffff00'));

    $bytes = (new JpgRenderer($canvas))->render();

    expect(bin2hex(substr($bytes, 0, 3)))->toBe('ffd8ff');
})->group('bonus');

it('écrit une étoile dans un fichier JPG', function (): void {
    $path = outputPath('test.jpg');
    if (file_exists($path)) {
        unlink($path);
    }

    $canvas = new Canvas(500, 500, '#00ff00');
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
    ], '#ffff00'));

    (new JpgRenderer($canvas))->save($path);

    expect($path)->toBeReadableFile();

    $size = getimagesize($path);
    expect($size)->not->toBeFalse()
        ->and($size[0])->toBe(500)
        ->and($size[1])->toBe(500)
        ->and($size[2])->toBe(IMAGETYPE_JPEG);
})->group('bonus');
