SAFES 4 TYPO3 - Stand-alone Front-end Stage for TYPO3
=====================================================

This is a skeleton for developing Fluid templates without a TYPO3 backend (or a virtual machine setup).

Index
-----

1. [Requirements](#requirement)
2. [Installation](#installation)
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

Depends on a already existing Frontend project! ;-)

The sub project for integrating frontend parts into fluid templates can be installed with:

    $ composer install

During the installation process, multiple symlinks are created to provide a working web page
(see "Directory structure"/public).
