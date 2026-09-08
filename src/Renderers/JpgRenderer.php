<?php

declare(strict_types=1);

namespace Shapes\Renderers;

use Shapes\Canvas;

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

    /** TODO : rendre les octets du JPG (du binaire, pas du texte lisible). */
    public function render(): string
    {
        throw new \LogicException('À implémenter');
    }

    public function save(string $path): void
    {
        throw new \LogicException('À implémenter');
    }
}
