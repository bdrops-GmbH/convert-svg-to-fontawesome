# Convert SVG to Fontawesome JS

Converts all SVG files in the same directory to Fontawesome Javascript & Typescript files.

## Usage

Put your SVG icons and the script in the same folder and run:

```
php convert.php
```

## Prerequisites

All SVG files have to be named in the following manner:

```
prefix_file_name.svg
```

#### Example

SVG source file:
```
z_my_icon.svg
```

Resulting icon CSS class:
```HTML
<span class="z fa-my-icon"></span>
```

Resulting icon Javascript file:

```
zMyIcon.js
```

#### Example use

```Javascript
import { library, dom } from '@fortawesome/fontawesome-svg-core';

import { zMyIcon } from './icons/zMyIcon';

library.add(
    zMyIcon
);

dom.watch();
```
