# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.1.1] - 2022-02-16
### Changed
- Updated "wp-coding-standards/wpcs" to ^2.3.
- Updated "phpcompatibility/phpcompatibility-wp" to ^2.1.
- Updated "dealerdirect/phpcodesniffer-composer-installer" to ^0.7.2.

## [0.1.0] - 2020-09-03
### Changed
- Renamed `WPEverest-Core.Commenting.CommentTagsSniff` to `WPEverest.Commenting.CommentTagsSniff`.
- Updated "wp-coding-standards/wpcs" to 2.3.0.
- Updated "dealerdirect/phpcodesniffer-composer-installer" to 0.7.0.

## [0.0.4] - 2020-02-06
### Changed
- Updated "wp-coding-standards/wpcs" to 2.2.0.
- Updated "phpcompatibility/phpcompatibility-wp" to 2.1.

## [0.0.3] - 2019-07-14
### Added
- White flag `evf_html_attributes()` on `WordPress.Security.EscapeOutput`.

## [0.0.2] - 2018-11-28
### Added
- `@access` tag is prohibited now.
- Updated "wp-coding-standards/wpcs" to version 1.2.
- Included "phpcompatibility/phpcompatibility-wp" as a dependency.
- Included "dealerdirect/phpcodesniffer-composer-installer" 0.5 as dependency.
- New custom message for `@category`.

### Changes
- Updated ruleset.xml with default validate and escape functions, also including default rules.

### Fixed
- Coding standards.

## 0.0.1 - 2017-12-21
### Added
- Initial code to throw warnings when using `@author`, `@category`, `@license` and `@copyright` tags.

[Unreleased]: https://github.com/wpeverest/wpeverest-sniffs/compare/0.1.0...HEAD
[0.1.0]: https://github.com/wpeverest/wpeverest-sniffs/compare/0.0.4...0.1.0
[0.0.4]: https://github.com/wpeverest/wpeverest-sniffs/compare/0.0.3...0.0.4
[0.0.3]: https://github.com/wpeverest/wpeverest-sniffs/compare/0.0.2...0.0.3
[0.0.2]: https://github.com/wpeverest/wpeverest-sniffs/compare/0.0.1...0.0.2
