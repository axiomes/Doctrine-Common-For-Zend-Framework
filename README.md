# Doctrine Common, for Zend Framework 1.11.X

Some helpers to ease implementation of some [Doctrine Common](https://github.com/doctrine/common)'s features in Zend Framework 1.11.x

This was part of my [Doctrine ODM Zend Framework integration](https://github.com/axiomes/Doctrine-ODM-Zend-Framework-integration), but I decided to make it independent for easier re-use.

## Features
### What it does

- A simple way to setup class loading via Doctrine's ClassLoader
- A Doctrine compatible Zend_Cache frontend

## How to use it:

### Add plugin path(s) and lib auto loading before resources definition
Before resource definitions in your application.ini

    pluginpaths.Axiomes\Application\Resource\ = APPLICATION_PATH "/../library/Axiomes/Application/Resource/"

    autoloadernamespaces[] = "Axiomes"

### Set up the class Loader :

	resources.doctrineloader.classLoaderPath = LIBRARY_PATH "/vendor/doctrine-common/lib/Doctrine/Common/ClassLoader.php"
    resources.doctrineloader.namespaces.Doctrine\Common = LIBRARY_PATH "/vendor/doctrine-common/lib"

    // Example for Doctrine ODM
    resources.doctrineloader.namespaces.Doctrine\MongoDB = LIBRARY_PATH "/vendor/doctrine-mongodb/lib"
    resources.doctrineloader.namespaces.Doctrine\ODM\MongoDB = LIBRARY_PATH "/vendor/doctrine-odm-mongodb/lib"
    resources.doctrineloader.namespaces.Symfony\Components = LIBRARY_PATH "/vendor/symfony-components/lib"

## The Doctrine compatible Zend_Cache frontend : Axiomes_Cache_DoctrineCompatible

	//if you use the CacheManager resource plugin, add a Doctrine Compatible cache :
    resources.cacheManager.myMetadataCacheName.frontend.name = "Axiomes_Cache_DoctrineCompatible"
    resources.cacheManager.myMetadataCacheName.frontend.customBackendNaming = true
    --other frontend options and backend options--

    //exemple for Doctrine ODM metadata cache
    resources.odm.configuration.metadataCacheImpl = "myMetadataCacheName"
