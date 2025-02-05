# Changelog
All notable changes to TypiCMS will be documented in this file.

## 1.5.7 - 2014

### Changed
- flexslider replaced by swiper

### Fixed
- Dryier template code for galleries

## 1.5.6 - 2014-10-16

### Changed
- .env like in Laravel 5

### Fixed
- Bug with files linked to galleries

## 1.5.5 - 2014-10-16

### Fixed
- Bug that prevents removing of galleries from a news or a page
- impossible to delete tags via /admin/tags
- Display bugs with TinyMCE skin

## 1.5.4 - 2014-10-13

### Added
- Tests for groups and users admin controllers.

### Changed
- Front office views for http errors extends master.blade.php.

### Fixed
- Bug with groups

## 1.5.3 - 2014-10-13

### Fixed
- Bug when editing a user.

## 1.5.2 - 2014-10-12

### Added
- Creation of a user during installation.

### Changed
- Admin sidebar items managed by each module.
- Better files upload system, with angular js.

## 1.5.1 - 2014-10-03

### Added
- Attachments can now be deleted

## 1.5.0 - 2014-11-29

### Changed
- bower_components back in its default place, please remove app/assets/components and run bower intall again.
- partners table: field 'logo' is now 'image'

### Added
- Angular JS for tables in admin
- Manual position for partners: field position:integer added
- Partners: fields homepage:boolean added 
- Field 'image' added to tables pages, news, categories, events, projects
- Field 'side' in menus table

### Removed
- removed 'title' field from menu_translations table
- removed 'rss_enabled' and 'comments_enabled' fields from 'pages' table

## 1.4.11 - 2014-09-07

### Added
- Gulp plugins : imagemin, autoprefixer, newer.
- Bootstrap 3.2.
- Code quality improved, now has SensioLabsInsight Platinum Medal

### Changed
- In admin interface, alerts are now on right bottom of screen.
- No more interface element in png format.

### Fixed
- Cache problem with galleries.

### Removed
- Gulp task 'all'.
- functions getIdFromSlug and getSlugFromId

## 1.4.10 - 2014-09-01

### Fixed
- missing bootstrap/environment.local.php.

## 1.4.9 - 2014-09-01

### Fixed
- Environment (bootstrap/environment.php or $_ENV('APP_ENVIRONMENT').
- Install command updated.

## 1.4.8 - 2014-08-31

### Added
- Sitemap generator.
- Classes for route filters: Public, Admin and Users.
- Cleaner layout on small screens for login/register/… form views.
- Back button in forms on admin side.
- Preview button on edit form.
- Admin UI enhanced on mobile.
- Scrutinizer code quality.

### Removed
- Method byUri is now getFirstByUri.
- Breadcrumb in admin.
- leroy-merlin-br/larasniffer.

## 1.4.7 - 2014-08-20

### Added
- New gulp task: all.
- Default gulp task now only launch watching of less/js files.
- CHANGELOG.md file.
- .doc, .xls and .ppt are uploadable.

### Deprecated
- Nothing.

### Removed
- Gulp-plumber removed.

### Fixed
- Nothing.
- Small changes in forms.

## 1.4.6 - 2014-08-19

### Added
- Categories can now be children of a menu item.
- Helpers class removed, it is now a simple helpers.php file.

### Deprecated
- Nothing.

### Removed
- Nothing.

### Fixed
- Way/Generators added to local providers

## 1.4.5 - 2014-08-14

### Added
- New relic code in app/start/global.php.
- small tag added to TinyMCE.
- docx, xlsx, pptx, ppsx et sldx are now uploadable.

### Deprecated
- Nothing.

### Removed
- syncGalleries method replaced by more generic syncRelations.

### Fixed
- Small css improvements
