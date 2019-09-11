SAFES 4 TYPO3 - Stand-alone Front-end Stage for TYPO3
=====================================================

This is a skeleton for developing Fluid templates without a TYPO3 backend (or a virtual machine setup).

Table of contents
-----------------

1. [Requirements](#requirement)
2. [Installation](#installation)
2. [Setup](#setup)
3. [Start development](Documentation/Development.md)
4. [Useful View Helpers](Documentation/ViewHelpers.md)
5. [Directory Structure](Documentation/Structure.md)


<a name="requirement">Requirements</a>
--------------------------------------

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

<a name="installation">Installation</a>
---------------------------------------

Simply require this package into your new sub-project:

    $ cd src_frontend
    $ mkdir src_html
    $ cd src_html
    $ composer init
    ...
    $ composer require hmmh/safes4typo3
    ...


<a name="setup">Setup</a>
-------------------------

Implements script entry in your `composer.json` for the help message after installation process to inform the
developer what are the next step:

    "scripts": {
        "post-install-cmd": [
            "HMMH\\SAFES\\DeveloperHelper::runSafes"
        ],
    }
