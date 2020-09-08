# Convert SVG to Fontawesome JS

Wandelt alle SVG Dateien im selben Verzeichnis in Fontawesome JS Dateien um.

## Verwendung

```
php convert.php
```

## Voraussetzungen

Die SVG Quelldateien müsssen wie folgt benannt sein:

```
prefix_datei_name.svg
```

#### Beispiel

Quelldatei:
```
z_mein_icon.svg
```

Generierte Icon Klasse:
```HTML
<span class="fa z-mein-icon"></span>
```

Generierte Icon Javascript Datei:

```
zMeinIcon.js
```

#### Einbindungsbeispiel

```Javascript
import { library, dom } from '@fortawesome/fontawesome-svg-core';

import { zMeinIcon } from '../icons/zMeinIcon';

library.add(
    zMeinIcon
);

dom.watch();
```
