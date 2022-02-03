# Changelog

## [1.1.6] - 2022-02-03

### Changed

- Updated packages

## [1.1.5] - 2022-02-03

### Changed

- Updated packages

## [1.1.4] - 2021-02-22

### Changed

- Fixed migration command syntax error for SQLITE (Thanks to [jhonatasfender](https://github.com/jhonatasfender))

### Added

- CreateDraft command will now notify user if he already has `draft_parent_id` column in designated table.

## [1.1.3] - 2021-01-06

### Changed

- Dependency security update
- **HasDrafts** for model to simplify usage.

## [1.1.2] - 2020-05-25

### Changed

- Dependency security update

## [1.1.1] - 2020-05-25

### Changed

- Fixed unpublish button not re-setting the `preview_token` (thanks to [@Landish](https://github.com/Landish))
- Updated packages

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
