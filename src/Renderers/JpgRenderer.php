<?php

declare(strict_types=1);

namespace Shapes\Renderers;

use Shapes\Canvas;
use SVG\SVG;

/**
 * BONUS — La même image, en JPG. Nécessite l'extension GD.
 *
 * Constructeur attendu : `new JpgRenderer(Canvas $canvas, int $quality = 90)`.
 * Si GD manque, le constructeur lève `\RuntimeException`.
 *
 * Remarquez la signature : ce renderer n'hérite PAS de `SvgRenderer`, il en
 * POSSÈDE un. Un JPG n'« est pas » un SVG ; il se fabrique à partir d'un SVG.
 *
 * Indices :
 *   - `SVG\SVG::fromString($texteSvg)` (paquet meyfa/php-svg, déjà installé) ;
 *   - `->toRasterImage(int $width, int $height)` rend une image GD ;
 *   - `imagejpeg()` écrit dans la sortie standard : capturez-la avec
 *     `ob_start()` / `ob_get_clean()`.
 */
final class JpgRenderer implements Renderer
{
    // TODO : le constructeur, le contrôle de `extension_loaded('gd')`,
    // et le SvgRenderer interne.

    private SvgRenderer $svgRenderer;

    public function __construct(
        private Canvas $canvas,
        private int $quality = 90
    ) {
        if (!extension_loaded('gd')) {
            throw new \RuntimeException("L'extension GD est requise.");
        }

        $this->svgRenderer = new SvgRenderer($canvas);
    }
    /** TODO : rendre les octets du JPG (du binaire, pas du texte lisible). */
    public function render(): string
    {
        $svg = $this->svgRenderer->render();

        $image = SVG::fromString($svg);

        $rasterImage = $image->toRasterImage(
            (int) $this->canvas->width,
            (int) $this->canvas->height,
            $this->canvas->background
        );

        if (!$rasterImage instanceof \GdImage) {
            throw new \RuntimeException(
                'La rasterisation SVG n’a pas produit une image GD.'
            );
        }

        ob_start();

        imagejpeg($rasterImage, null, $this->quality);

        $jpg = ob_get_clean();

        if ($jpg === false) {
            throw new \RuntimeException('Impossible de générer le JPG.');
        }

        return $jpg;
    }

    public function save(string $path): void
    {
        file_put_contents($path, $this->render());
    }
}
