Useful View Helpers
===================

Repeat arrays
-------------

```
    <f:for each="{array}" as="content" key="keyName">
        {content.title}
        {keyName}
    </f:for>
```

Conditions
----------

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

(White-)Spaceless content
-------------------------

To guarantee a rendering content wo/ whitespaces in there, you can use following:

```
    <f:spaceless>
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

---

Have a look in `typo3-fluid/vendor/typo3fluid/fluid/src/ViewHelpers` or `webroot/typo3/sysext/fluid/Classes/ViewHelpers`.

Structured (sub folder) view helper can be used with:

```
    <f:format.raw>…</f:format.raw>
```

