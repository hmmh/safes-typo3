Start development
=================

Open a separate bash instance for a web server instance: 

    $ composer serve

The web page is provided over https://127.0.0.1:8080/ and use the generated document root "public".


Inject HTML (important!)
------------------------

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


Inject localization strings
---------------------------

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


New self-contained content elements
-----------------------------------

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

New modularized content elements
--------------------------------

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

New page element (Template)
---------------------------

```
<html xmlns:f="http://www.w3.org/1999/html" data-namespace-typo3-fluid="true">

    <f:layout name="Name of the layout without extension"/>

    <f:section name="Name of the section defined in Layout file">

        …

    </f:section>

</html>

```

The html-Tag is needed for required xml namespace (clean version), but it doesn't belongs to the html output rendering. 


New layout element
------------------

```
<html xmlns:f="http://www.w3.org/1999/html" data-namespace-typo3-fluid="true">

    …

    <f:render section="Name of the section"/>

    …

</html>

```

New section element (Partial)
-----------------------------

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

