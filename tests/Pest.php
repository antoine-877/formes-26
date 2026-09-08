<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Configuration Pest
|--------------------------------------------------------------------------
|
| Rien à modifier ici. Les tests sont rangés par étape : tests/Etape1,
| tests/Etape2, … et chaque test porte un groupe (`->group('etape-1')`).
| Pour ne lancer qu'une étape :
|
|     composer test:etape-1
|
*/

/** Dossier où les tests écrivent leurs fichiers de sortie (ignoré par git). */
function outputPath(string $filename): string
{
    $directory = __DIR__.'/output';

    if (! is_dir($directory)) {
        mkdir($directory, 0o777, true);
    }

    return $directory.'/'.$filename;
}
