Directory structure
===================

Cache
-----

This folder contains all generated classes of Fluid template contexts.

Do not look in there. You have to ignore this folder.


Classes
-------

This folder contains necessary view helper classes for fluid templates.

- See "Start development"/"Inject images"
- See "Start development"/"Inject localization strings"


public
------

This is the public document root that will be accessed over the web service.

In order to find asset files necessary for the frontend, symlinks are made to the built-up PatternLab
directory:

- assets

- js

- styles

We need the index page from the root:

- index.html: There will be links to page template contexts.

We need the fluid controller script from the root:

- Page.php: There will be assignments for the whole template environment.


Resources
---------

This folder contains only private resources for several files:

For Localizations (for every fluid template file):

    _Localizations

For Layout (in use for Templates):

    Layouts

For Content elements, Components:

    Elements/Atoms
    Elements/Molecules
    Elements/Organisms

For Templates (Entry points, depends on a Layout):

    Templates
    
For Templates (Entry points, depends on a Layout):

    Pages


vendor
------

This folder contains all dependencies that need to be installed for a php application.

You can or should ignore this folder.
