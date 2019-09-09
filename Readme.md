SAFES 4 TYPO3 - Stand-alone Front-end Stage for TYPO3
=====================================================

This is a skeleton for developing Fluid templates without a TYPO3 backend (or a virtual machine setup).


Requirements
------------

**PHP 7.1**

__macOS 10.12 <= 10.13:__

brew:

    $ brew install php@7.1
    $ brew install composer

MacPorts:

    $ sudo port install php71
    $ sudo port install php71-openssl php71-zip

Then: Following the instruction on https://getcomposer.org/download/

__macOS >= 10.14 (Mojave):__

brew:

    $ brew install composer

MacPorts

Following the instruction on https://getcomposer.org/download/

__Windows:__

Following the instruction on https://windows.php.net/download#php-7.1
Then: Following the instruction on https://getcomposer.org/download/

---

**Multiple PHP version:**

Have a look here: https://github.com/phpbrew/phpbrew


Installation
------------

Depends on a already existing Frontend project! ;-)

The sub project for integrating frontend parts into fluid templates can be installed with:

    $ composer install

During the installation process, multiple symlinks are created to provide a working web page
(see "Directory structure"/public).


Start development
-----------------

Create a new bash instance for a web server instance: 

    $ composer serve

The web page is provided over https://127.0.0.1:8080/ and use the generated document root "public".


**Inject HTML (important!)**

This is a view helper for defining a injecting assignment or elements in which HTML elements are expected:
 
For assignments (short hand):
```
    {content -> f:format.raw()}
```

For elements:
```
    <f:format.raw>
        {content}
    </f:format.raw>
```

That can be content elements in TYPO3 or assignments (data properties) with HTML included like RTE.

In Fluid Templates, all content will be escaped. For HTML you have to define areas where escaping should not happen.


**Inject localization strings**

This is a translate view helper to simulate a localization injection:

```
    <f:translate key="Name of the translation key" />
```

You can create additional localization keys in `Resources/_Localizations/Frontend.xml`:

```
    <trans-unit id="name of the translate key">
        <source>localized string</source>
    </trans-unit> 
```


**(White-)Spaceless content**

To guarantee a rendering content wo/ whitespaces in there, you can use following:

```
    <f:spaceles>
        <h1>
            <f:if condition="{anything}">
                <f:then>
                    This
                </f:then>
    
                <f:else>
                    That
                </f:else>
            </f:if>
        </h1>
    </f:spaceless>
```
 

**New self-contained content elements**

Place new content elements in "Resources/Elements/Molecules" or "Resources/Elements/Organisms" (with required wrapped html tag).

```
<html xmlns:f="http://www.w3.org/1999/html" data-namespace-typo3-fluid="true">

    …

</html>
```

The html-Tag is needed for required xml namespace (clean version), but it doesn't belongs to the html output rendering. 

The content elements can be used both in Fluid-Template-files ('Resources/Templates') and
in Partial files by view helpers:

```
    <f:render partial="Name of the partial without extension" arguments="{_all}" />
```

**New modularized content elements**

Place new atomic design elements in "Resources/Elements/Atoms" or "Resources/Elements/Molecules" or "Resources/Elements/Organisms" (with required wrapped html tag).

```
<html xmlns:f="http://www.w3.org/1999/html" data-namespace-typo3-fluid="true">

    …

   <f:spaceless>
       <h1>
           <f:if condition="{content -> isEmpty()}">
                <f:then>
                   {content -> f:format.raw()}
                </f:then>
                
                <f:else>
                   <f:translate key="headline" />
                </f:else>
            </f:if>
       </h1>
   </f:spaceless>

    …

</html>
```

Usage in Pages or Template partials:
```
    <f:render partial="Name of the partial without extension" contentAs="content">
    
        …

    </f:render>
```

**New page element (Template)**

```
<html xmlns:f="http://www.w3.org/1999/html" data-namespace-typo3-fluid="true">

    <f:layout name="Name of the layout without extension"/>

    <f:section name="Name of the section defined in Layout file">

        …

    </f:section>

</html>

```

The html-Tag is needed for required xml namespace (clean version), but it doesn't belongs to the html output rendering. 


**New layout element**

```
<html xmlns:f="http://www.w3.org/1999/html" data-namespace-typo3-fluid="true">

    …

    <f:render section="Name of the section"/>

    …

</html>

```

**New section element (Partial)**

```
<html xmlns:f="http://www.w3.org/1999/html" data-namespace-typo3-fluid="true">

    <f:section name="Name of section I defined in Partial file">

        …

    </f:section>
    
    <f:section name="Name of section II defined in Partial file">

        …

    </f:section>

</html>

```

The html-Tag is needed for required xml namespace (clean version), but it doesn't belongs to the html output rendering. 

Usage with template fluid file:
```
    <f:render partial="Name of the partial without extension" section="Name of section I" />
```

Usage if section definition are inside the fluid file:
```
    <f:render section="Name of section I" />
```




Useful View Helpers
-------------------

JSON:
```
    {
        "1": { title: "A" },
        "2": { title: "B" },
        "3": { title: "C" },
        "4": { title: "D" }
    }
```

Fluid:
```
    <f:for each="{array}" as="content" key="keyName">
        {content.title}
        {keyName}
    </f:for>
```

```
    <f:if condition="{value} == 123">
        
        …
    
    </f:if>

    <f:if condition="{value}">
        <f:then>
        
            …
        
        </f:then>
        <f:else>
        
            …
        
        </f:else>
    </f:if>
```

Have a look in `typo3-fluid/vendor/typo3fluid/fluid/src/ViewHelpers` or `webroot/typo3/sysext/fluid/Classes/ViewHelpers`.

Structured view helper can be used with:

```
    <f:format.raw>…</f:format.raw>
```


Directory structure
-------------------

**Cache**

This folder contains all generated classes of Fluid template contexts.

Do not look in there. You have to ignore this folder.


**Classes**

This folder contains necessary view helper classes for fluid templates.

- See "Start development"/"Inject images"
- See "Start development"/"Inject localization strings"


**public**

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


**Resources**

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


**vendor**

This folder contains all dependencies that need to be installed for a php application.

You can or should ignore this folder.
