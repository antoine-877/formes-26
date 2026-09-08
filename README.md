# formes-26 — Dessiner avec des objets

Atelier du **chapitre 7** du bloc POO (5XCOS). Vous allez construire une petite
bibliothèque de formes géométriques et un moteur de rendu qui transforme ces
objets en image SVG. À la fin, vous dessinerez une étoile — puis ce que vous
voulez.

Le squelette est fourni : toutes les classes existent, toutes les méthodes ont
leur signature, et chacune lève `LogicException('À implémenter')`. Les tests,
eux, sont **complets**. Votre travail : rendre les tests verts, étape par étape.

## Démarrer

```bash
# 1. Forkez ce repo sur GitHub, puis clonez VOTRE fork
git clone https://github.com/<votre-compte>/formes-26.git
cd formes-26

# 2. Installez les dépendances (PHP 8.3 minimum)
composer install

# 3. Lancez les tests : tout est rouge, c'est normal
composer test
```

Puis, étape par étape :

```bash
composer test:etape-1   # 12 tests
composer test:etape-2   # 23 tests
composer test:etape-3   # 17 tests
composer test:etape-4   # 10 tests
composer test:bonus     #  3 tests, ignorés si l'extension GD manque
```

Commitez et poussez à la fin de chaque étape. L'onglet **Actions** de votre fork
affiche un job par étape : quatre coches, vertes ou rouges.

## Les quatre étapes

| Étape | Vous écrivez | Ce que vous apprenez |
| --- | --- | --- |
| 1 | `Point`, `Line` | Objet, constructeur, promotion, `readonly`, immuabilité |
| 2 | `Shape`, `Circle`, `Rectangle` | Classe abstraite, héritage, `parent::__construct()` |
| 3 | `Canvas`, `Polygon` | Composition, tableau d'objets, polymorphisme |
| 4 | `SvgRenderer` | Interface, `implements`, `match(true)` + `instanceof` |
| Bonus | `JpgRenderer` | Composition plutôt qu'héritage, extension GD |

### Étape 1 — `Point` et `Line`

`Point` est une **valeur** : deux coordonnées, et rien qui change. Rendez la
classe `readonly` et déclarez `x` et `y` en promotion de constructeur.
`translate()` ne déplace donc rien : elle rend un nouveau point.

> Indice : `final readonly class Point implements \Stringable`, puis
> `public function __construct(public float $x, public float $y) {}`.

`Line` retient deux `Point` et une couleur (`#000000` par défaut, normalisée en
majuscules). Sa longueur ? `Point` sait déjà calculer une distance : servez-vous-en
au lieu de recopier la formule.

### Étape 2 — `Shape`, `Circle`, `Rectangle`

Un cercle et un rectangle ont deux choses en commun : une couleur, et le fait
d'avoir une aire. C'est exactement ce que contient la classe **abstraite**
`Shape`. `area()` y est déclarée sans corps : chaque enfant est obligé de
l'écrire.

Les constructeurs des enfants appellent `parent::__construct($color)`.

Puis **revenez sur `Line`** : elle aussi est une forme. Faites-la hériter de
`Shape`, supprimez sa couleur en double, et donnez-lui une `area()` qui rend
`0.0` — une ligne n'a pas de surface. C'est un vrai refactoring : les tests de
l'étape 1 doivent rester verts.

> Indice pour la couleur : `preg_match('/^#[0-9A-Fa-f]{6}$/', $color)`.

### Étape 3 — `Canvas` et `Polygon`

`Canvas` est la feuille de dessin : une taille, un fond, et une liste de formes.
Il **n'hérite pas** de `Shape` : un canvas n'est pas une forme, il en contient.

`totalArea()` additionne les aires de toutes les formes. Écrivez-la sans un seul
`if` ni `instanceof` : c'est le polymorphisme qui fait le travail.

`Polygon` reçoit un tableau de `Point` (trois minimum) et calcule son aire par la
formule du lacet.

> Indice : `array` ne dit pas ce qu'il contient. Vérifiez chaque élément avec
> `instanceof Point` et levez `InvalidArgumentException` sinon.

### Étape 4 — `SvgRenderer`

L'interface `Renderer` est fournie, lisez-la : deux méthodes, aucun code. Elle
dit ce qu'un moteur de rendu **doit savoir faire**, pas comment.

`SvgRenderer` reçoit le canvas dans son constructeur et produit le document SVG
en texte. Le format exact attendu est écrit en commentaire dans le fichier.

> Indice : `match (true) { $shape instanceof Line => …, … }` remplace une pile de
> `if`. Le cas `default` doit lever une exception : un renderer qui rencontre une
> forme inconnue doit le dire.

> Indice : `500.0` doit s'écrire `500` et non `500.00`. `number_format()` puis
> deux `rtrim()`.

Quand l'étape 4 est verte :

```bash
php examples/star.php
```

Ouvrez `examples/star.svg` dans votre navigateur. Puis modifiez le fichier :
dessinez ce que vous voulez et postez le résultat.

### Bonus — `JpgRenderer`

Nécessite l'extension **GD** (`php -m | grep gd`). Sans elle, les tests du groupe
`bonus` sont simplement ignorés.

Regardez sa signature : il n'hérite pas de `SvgRenderer`, il en **possède** un.
Un JPG n'« est pas » un SVG ; il se fabrique à partir d'un SVG.

## Rappel SVG

Un SVG est un fichier texte. Cinq balises suffisent ici :

```xml
<svg width="500" height="500" viewBox="0 0 500 500">
  <rect x="0" y="0" width="100" height="50" fill="#FF0000" />
  <circle cx="250" cy="250" r="80" fill="#00FF00" />
  <line x1="0" y1="0" x2="500" y2="500" stroke="#0000FF" stroke-width="1" />
  <polygon points="250,0 300,200 500,200" fill="#FFFF00" />
</svg>
```

Attention : l'origine `(0, 0)` est en **haut à gauche**, et l'axe Y descend.

## Aide

Bloqué plus de vingt minutes ? Demandez une piste. Le solutionnaire complet
existe et vous sera montré après un vrai essai, pas avant.
