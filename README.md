# Anunatak: WordPress Plugin Boilerplate

Yes, another boilerplate for creating WordPress plugins. This is a lightweight alternative for cases where you just need a starting point for creating your awesome plugins.

## Getting started

First, you'll want to do a series of case-sensitive string replacements (in this order)

1. `anunaboilerplate_`: The function prefix.
2. `ANUNABOILERPLATE`: Alle constants are prefixed with this.
3. `Anunaboilerplate_`: Class prefix.
4. `anunaboilerplate`: Text-domain

## Autoloading

The boilerplate comes with a simple autoloader (from the `lib/`-folder), which follows this naming convention `{PLUGIN}_{MODULE/MODULE TYPE}_{MODULE}`.

The first is the name of the plugin (e.g. `Anunabuilder`), the second one is the name of the module (e.g. `Scripts`) or a module group (e.g. `Types`), and the third is only required if the the second one is set.

### Examples

`Anunaboilerplate_Scripts` will be autoloaded from `lib/scripts.php`
`Anunaboilerplate_Types_Book` will be autoloaded from `lib/types/book.php`

## The basics

Anunaboilerplate works somewhat like a container, although a really basic one. All plugin files are modules (see the Autoloading section), and are loaded through our `lib/plugin.php` file.

This class injects itself into every module loaded via the `loadModules()`-method, so you can access other modules throughout your plugin.

Register any new module you create in the same method. See the scripts module for an example.
