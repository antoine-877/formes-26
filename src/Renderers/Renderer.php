<?php

declare(strict_types=1);

namespace Shapes\Renderers;

/**
 * Le contrat de tout ce qui sait transformer un Canvas en fichier.
 *
 * Aucune ligne de code ici : une interface dit CE QU'ON PEUT FAIRE,
 * pas comment.
 */
interface Renderer
{
    /** Rend le dessin sous forme de chaîne (texte SVG, données binaires JPG…). */
    public function render(): string;

    /** Écrit le résultat de render() dans un fichier. */
    public function save(string $path): void;
}
