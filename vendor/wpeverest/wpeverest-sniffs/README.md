# WPEverst Sniffs

Collection of PHP_CodeSniffer sniffs for WPEverst Plugins.

## Installation

```php
composer require wpeverest/wpeverest-sniffs
```

## Usage

### Command line

```bash
./vendor/bin/phpcs --standard=WPEverst-Core <file>
```

### Config file

PHPCS config file:

```xml
<?xml version="1.0"?>
<ruleset name="WPEverst Coding Standards">
    <description>My projects ruleset.</description>

    <!-- Configs -->
    <config name="minimum_supported_wp_version" value="4.7" />
    <config name="testVersion" value="7.2-" />

    <!-- Rules -->
    <rule ref="WPEverst-Core" />

    <rule ref="WordPress.WP.I18n">
        <properties>
            <property name="text_domain" type="array" value="new-text-domain" />
        </properties>
    </rule>

    <rule ref="PHPCompatibility">
        <exclude-pattern>tests/</exclude-pattern>
    </rule>
</ruleset>
```


## Changelog

[See changelog for details](https://github.com/wpeverest/wpeverest-sniffs/blob/master/CHANGELOG.md)
