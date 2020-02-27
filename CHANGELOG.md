# Changelog

## [1.1.0] - 2020-02-27

### Added

- Added `UnpublishButton` which allows pages to be "unpublished" (disabling them)
- Added localization support

### Changed

- Refactored code
- Updated packages

## [1.0.3] - 2020-02-18

### Fixed

- Fixed a bug, where draft publishing was trying to save fields that were appended.

## [1.0.2] - 2020-02-11

### Fixed

- Fixed a bug, where publishing a draft without a parent resource didn't redirect.

## [1.0.1] - 2020-01-09

### Added

- bool validation to `->draftsEnabled()` option

## [1.0.0] - 2020-01-09

### Added

- Artisan command to create migration for the field
- new DraftButton field to create, discard and publish drafts
- new PublishedField field to show the status of resources (either published or draft)

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

[1.1.0]: https://github.com/optimistdigital/nova-drafts/releases/tag/1.0.2...1.1.0
[1.0.2]: https://github.com/optimistdigital/nova-drafts/releases/tag/1.0.1...1.0.2
[1.0.1]: https://github.com/optimistdigital/nova-drafts/releases/tag/1.0.0...1.0.1
[1.0.0]: https://github.com/optimistdigital/nova-drafts/releases/tag/1.0.0
