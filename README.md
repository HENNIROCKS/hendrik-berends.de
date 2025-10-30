# Made with Kirby and :heart:

-- WORK IN PROGRESS --

This is the main repository for my own personal website. The website is made with Kirby and features my own settings and styles through a number of plugins.

**Pleae note**: This repository does neither contain the `kirby/` folder for running the CMS nor any `site/plugins/` except my own. Those others are defined in the `composer.json`. Please be aware that also no `content/` is provided.

## Setting (up) a theme

My theme plugins depend on an additonal plugin `hb-commons`. Add the theme used to the Kirby config file.

```php
// site/config.php
'activeTheme' => 'hennirocks/hb-theme-123',
```

```txt
//site/plugins
plugins/
└─── hb-commons
│    └─── index.php
│
└─── hb-theme-123
     └─── index.php
```

A theme may include NPM packages: Make sure to check a theme's `package.json` and install `node_modules` if in doubt.

## Roadmap

-   [ ] Repository
    -   [ ] :electric_plug: Add plugins `hb-commons` and `hb-theme-*` as submodules
    -   [ ] :clipboard: Update README
-   [ ] Kirby
    -   [ ] :thinking: Eventually scrap alternative `index.php` setup
-   [ ] Plugins
    -   [ ] :framed_picture: Add thumbs and sourcesets
    -   [ ] :broom: Clean up mess
        -   [ ] :broom: Check SCSS handling
        -   [ ] :broom: Check BEM structure
        -   [ ] :broom: Check empty alt attributes
        -   [ ] :broom: Check missing title attributes
        -   [ ] :broom: Check role attributes, if necessary
        -   [ ] :broom: Check proper (modern) handling of content data and fallbacks in snippets, templates etc.
        -   [ ] :broom: Check all notes and docs
    -   [ ] :artist: Create new mockup graphic for each theme README
    -   [ ] :rocket: Make sure plugin `hb-commons` is required and loaded before a theme
        -   [ ] :thinking: Eventually use `activeTheme` config option for setting the active theme instead of renaming theme folders
    -   [ ] :rocket: Add Vite for handling styles and for generating individual template stylesheets
        -   [ ] :thinking: Eventually scrap SCSS for CSS by using PostCSS
    -   [ ] :speaking_head: Eventually add languages: english and lower german

Possibly more to follow :eyes:
