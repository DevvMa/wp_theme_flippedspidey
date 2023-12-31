=== Image Regenerate & Select Crop ===
Contributors: Iulia Cazan
Tags: image optimization, crop, regenerate, cleanup, sub-sizes details, custom sub-sizes, wp-cli, image placeholder, bulk regenerate, bulk cleanup, raw cleanup
Requires at least: not tested
Tested up to: 6.4
Stable tag: 7.3.3
Requires PHP: 7.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate Link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JJA37EHZXWUTJ

== Description ==
The plugin allows managing advanced settings for images, overriding the native medium and large crop options, and registering new custom image sizes. The plugin appends two custom buttons that allow you to regenerate and crop the images, and provides details about the image sub-sizes registered in the application and the status of each associated file. The plugin also appends a sub-menu to "Settings" which allows you to configure the plugin for global or particular post-type attached images and to enable the developer mode for debugging, if necessary. The most recent details of the plugin features are available at https://iuliacazan.ro/image-regenerate-select-crop/.

The "Details/Options" button will open a lightbox where you can see all the image sizes registered in the application and details about the status of each sub-size of that image. If one of the sub-sizes files has not been found, you will see more details about this and, if possible, the option to manually generate this (for example the image size width and height are compatible with the original image). For the image sizes that are of "crop" type, you will be able to re-crop in one click the image using a specific portion of the original image: left/top, center/top, right/top, left/center, center/center, right/center, left/bottom, center/bottom, right/bottom. The preview of the result is shown right away, so you can re-crop if necessary.

The "Regenerate" button allows you to regenerate in one click all the image sizes for that specific image. This is really useful when during development you registered various image sizes and the already uploaded images are "left behind".

The plugin does not require any additional code, it appends two custom buttons that will be shown on the "Edit Media" page and on the "Edit Post" and "Edit Page" where there is a featured image. This works also for custom post types. Also, it can be used in different resolutions and responsive layouts.

== Installation ==
* Upload `Image Regenerate & Select Crop` to the `/wp-content/plugins/` directory of your application
* Login as Admin
* Activate the plugin through the 'Plugins' menu in WordPress

== Hooks ==
image_regenerate_select_crop_button, sirsc_doing_sirsc, sirsc_action_after_image_delete, sirsc_attachment_images_ready, sirsc_attachment_images_processed, sirsc_image_file_deleted, sirsc_image_processed, sirsc_custom_upload_rule, sirsc_computed_metadata_after_upload, sirsc_filter_remove_update_info, sirsc_filter_remove_top_info, sirsc_seo_file_renamed

== Demo ==
https://youtu.be/3hRSXMx3dcU

== Screenshots ==
1. The most recent view of the image info, with details and links for the original file and all the generated images.
2. Extra details about the registered and not registered image sizes and all the generated files with the option to delete individual files. The extra info is available in the lightbox, at the bottom of the list.
3. Example of advanced custom rules based on the posts where the images will be uploaded (and how to temporarily suppress the rules without removing these).
4. The general setting view with options to regenerate all images for a specific size, cleanup, general crop position, quality loss, etc.
5. Example of settings that override the crop of native image sizes and create/remove custom image sizes created with the plugin.
6. Example of the details and regenerate buttons in the media listing view for each of the attachments, to allow direct access to these functionalities.
7. Example of the details and regenerate buttons for the featured image of a post.
8. Example of the details and regenerate buttons available in the WooCommerce product gallery.


== Frequently Asked Questions ==

= How to use the plugin wp-cli commands? =

The list of wp-cli commands available with this plugin can be checked by running this command in your terminal:
`wp sirsc --help`. This will show you a list of the available subcommands and their current description in terms of purpose, arguments types, and order:

* `cleanup`
-- arguments order and types: (int)site_id (string)post_type (string)size_name (int)parent_id
-- the command targets images based on the relations with the specified post type, perhaps a parent, and performs the sub-sizes cleanup for all or the specified sub-sizes (delimited with a comma)

* `rawcleanup`
-- arguments order and types: (int)site_id (string)post_type (int)parent_id
-- the command targets images based on the relations with the specified post type and perhaps a parent and performs the raw cleanup for all the files, except for the full/original sub-size

* `regenerate`
-- arguments order and types: (int)site_id (string)post_type (string)size_name (int)parent_id
-- the command targets images based on the relations with the specified post type and perhaps a parent and performs the sub-sizes regeneration for all or the specified sub-sizes (delimited with a comma)

* `resetcleanup`
-- arguments order and types: (int)site_id (string)post_type (int)parent_id
-- the command targets images based on the relations with the specified post type and perhaps a parent, and performs the reset cleanup for all the sub-sizes, keeping the full/original + only the registered image sizes at the moment when the command runs

The commands can be used with two flags:

* `--verbose` - this attempts to give a detailed description of the execution
* `--force` - available for the cleanup command

= How to clean up images using wp-cli commands? =

To clean up all the sub-sizes for all the images in the project you can run a command like this: `wp sirsc cleanup 1 all all 0`.

– 1 = specifies the site/blog id in a multisite (set it to 1 in a single site install)
– all = the post type (set it to all if you want the execution to happen for all post types)
– all = the sub-size (set it to all if you want the execution to happen for all registered sub-sizes)
– 0 = attachment parent id (leave it to 0 if you want to execute for all of the attachments, not just for the attachments of a specific post)

If instead, you want to clean up only the medium sub-size, and let's say only for the pages, the command can be used like this: `wp sirsc cleanup 1 page medium 0`.

As you can see, depending on what you are aiming to clean up, you can combine the arguments.
If you are using the `--force` flag for the command, the targeted sub-size will be used for cleanup, even if it is not registered in the project anymore (left behind in the project by other themes or plugins that are no longer used).

= How to raw clean up images using wp-cli commands? =

To clean up all the sub-sizes for all the images in the project and start again with keeping only the full/original attachment file, you can run a command like this: `wp sirsc rawcleanup 1 all 0`.

– 1 = specifies the site/blog id in a multisite (set it to 1 in a single site install)
– all = the post type (set it to all if you want the execution to happen for all post types)
– 0 = attachment parent id (leave it to 0 if you want to execute for all of the attachments, not just for the attachments of a specific post)

= How to reset clean-up images using wp-cli commands? =

To clean up all the files and metadata for sub-sizes that are no longer registered on your site, you can run a command like this: `wp sirsc resetcleanup 1 all 0`.

– 1 = specifies the site/blog id in a multisite (set it to 1 in a single site install)
– all = the post type (set it to all if you want the execution to happen for all post types)
– 0 = attachment parent id (leave it to 0 if you want to execute for all of the attachments, not just for the attachments of a specific post)

= How to regenerate images using wp-cli commands? =

To regenerate all the sub-sizes for all the images in the project you can run a command like this: `wp sirsc regenerate 1 all all 0`.

– 1 = specifies the site/blog id in a multisite (set it to 1 in a single site install)
– all = the post type (set it to all if you want the execution to happen for all post types)
– all = the sub-size (set it to all if you want the execution to happen for all registered sub-sizes)
– 0 = attachment parent id (leave it to 0 if you want to execute for all of the attachments, not just for the attachments of a specific post)

If instead, you want to regenerate only the medium sub-size, and let's say only for the posts, the command can be used like this: `wp sirsc regenerate 1 post medium 0`.


== Changelog ==
= 7.3.3 =
* Adjusted the initial threshold to match better the portrait images
* Cleanup artefact images
* Fixed warnings for unidentified crop position

= 7.3.2 =
* Changed the path of the logs to use the uploads folder
* Fixed the final file name and output info for the forced original size

= 7.3.1 =
* Added extra random string to hashed log files names

= 7.3.0 =
* Tested up to 6.4
* Security updates - added the log index file and hashed log files names

= 7.2.5 =
* Fixed the error for WooCommerce product in Classic editor on site running Divi

= 7.2.4 =
* Tested up to 6.3.1
* Added and extra check for writable log folder to avoid code warnings (the core file system touch is not reliable to do the check)
* Refactored the image quality so that the images will create sub-sizes at the expected quality on upload too (to overcome the core lack of hooks for sub-sizes quality when processing uploads)
* Exposed all image sizes in the editor settings

= 7.2.3 =
* Fixed the option "bulk regenerate/cleanup execution starts from the most recent files" remaining auto selected

= 7.2.2 =
* Tested up to 6.3
* Minor styles updates

= 7.2.1 =
* Forced release to fix the previous deployment issue

= 7.2.0 =
* Tested up to 6.2.2
* Security updates - limited the special features to only admins
* Added WP-CLI commands extensive details to the FAQ section of the plugin readme
* Added the info, regenerate, and cleanup buttons in the select/upload media dialog
* Fixed some warnings when using the reset cleanup command

= 7.1.0 =
* Tested up to 6.2
* Added the option to disable the verbose tracer log, hence, log only the main events
* Added the filter `sirsc_keep_scaled`, which allows preserving the scaled version
* Added new Elementor and WooCommerce post types to exclude lists
* Updated the wp-cli regenerate command to be in sync with the "regenerate only missing files" and "regenerate/cleanup only featured images" settings from the bulk actions
* Updated the wp-cli commands description, synopsis, and options details
* Fixed the admin menu overlay

= 7.0.1 =
* Fixed warnings when the initial metadata is incorrect (missing width or height) and bypassed summary
* Fixed the SVGs preview in the admin listing when the image metadata is missing width or height

= 7.0.0 =
* Tested up to 6.1.1
* WP 6.1.1 compatibility updates
* PHP 8 compatibility updates
* WooCommerce compatibility updates
* Added the custom images sizes to the editor images sizes (to make these available in the image and gallery core blocks when the sub-sizes are available)
* Added a small performance optimization for the custom advanced rules hook
* Added the options for separate custom rules for featured images
* Added the matched rule in the tracer log (for more details about generating sub-sizes and troubleshooting)
* Added two new filters, one for removing the update notification and one for removing the top notification
* Fixed the mime type warning on SVG upload
* Minor styles updates
* Dependencies updates
* Translations updates

= 6.2.2 =
* Tested up to 5.9.2
* Fixed crop typo in sub-sizes info.
* Bypassed placeholder for image sizes that do not have a width or height defined.
* Excluded new core post types from the list of image sizes' options.

= 6.2.1 =
* Tested up to 5.9
* Clear attachment cache before re-computing the object after the image regenerate

= 6.2.0 =
* Tested up to 5.8.2.
* Added placeholder fallback
* Change filter priority to apply earlier the available sizes
* Fix warnings for info not available in some of the core versions
* Fix warnings for estimated sizes missing width or height
* Attempt to bypass scaled sub-size naming
* Updated sizes filter for backward compatibility
* Limit the length of the logs
* Trace in the bulk log the WP-CLI command executions
* Styles adjustments (for Chromium)

= 6.1.0 =
* Tested up to 5.8.1.
* Added the wp-cli commands hints for the bulk features.
* Added the wp-cli command to rename files for SEO adon active.
* Added the new option that turns on/off the buttons from the media screen when switched to grid mode.

= 6.0.3 =
* Implemented fallback save for media settings as the native hook in 5.8 is not firing consistently.
* Updated the media settings UI
* Setup default bulk action in reverse for new installs

= 6.0.2 =
* Add back action when attachment gets deleted

= 6.0.1 =
* Fix medium large crop option update
* Added a close icon to the info lightbox (decorative only, the lightbox is closing on any click)
* Style adjustments for the enabled custom rules
* Fix cleanup button class typo

= 6.0.0 =
* Tested up to 5.8.
* General settings UI changes: accessibility, a better grouping of settings and options, separated and marked differently for clarity the settings that are global form the settings that can apply to images attached to the selected post type, sticky heading for the images sizes listing, spinners, mobile view update.
* Advanced rules UI changes: accessibility, better differentiation of the active and suppressed rules, sticky heading and save button, mobile view update.
* Added the new reset settings feature (resets the plugin settings without removing the custom registered image sizes).
* Added the new option to bulk regenerate/cleanup execution starting from the most recent files.
* Added the new option to turn on the custom debug log for monitoring the events and execution related to the regeneration and cleanup of images.
* Added the new option to execute bulk actions using the WordPress cron tasks instead of the default interface (regenerate and cleanup batches size too).
* Updated the bulk cleanup and bulk regenerate dialogs and buttons to differentiate when the cron tasks are enabled, also added the option to cancel all currently scheduled tasks that aim to regenerate or clean up the images (as a fallback option).
* Added the new debug tab with the bulk actions and tracer logs (options to clean up and refresh).
* Moved in debug tab the status/debug details (previously available in the Import/Export addon).
* Add-ons' thumbnail updates.
* Updated the export registered image sizes snippet to use boolean values for the crop parameter.
* Changes to expose the custom placeholders for each image size when the placeholders option is enabled (global or only missing) and the option to regenerate another file for each (helps when the random colors assigned do not provide enough contrast for troubleshooting).
* Add-ons' styles updates and the option to pause/resume bulk actions.
* Fix the counters for bulk actions (`thumbnail` vs `shop_thumbnail`).
* Code refactoring and updates for PHP's latest stable versions.
* Optimize the info lightbox, lazy loading of the embedded images, sticky heading for clarity, and mobile view update.
* Added in the info lightbox the option to clean up metadata for the images sizes that match the original (metadata optimization)
* Decouple the image size file deletion in the cases with multiple matched images' sizes (this will clean up metadata for additional image sizes that match the same filename, and will remove the file as well when the file matches only one size).
* Added auto-update preview on the page when the image size file is updated and is present on the current view.
* Added the individual image buttons in the media library view in the grid mode.
* Fix assets enqueue issue for usage with core versions >= 5.6.
* Completely decoupled the plugin from jQuery legacy code.

= 5.5 =
* Tested up to 5.5.1
* Added export snippet that allows transferring registered image sizes from the plugin
* Added image metadata fallback when the post meta is missing

= 5.4.4 =
* Tested up to 5.5
* Fix warnings, placeholder path, and font, a summary update on sub-size change in the info lightbox
* Change the threshold default quality on the forced original
* Assets update

= 5.4.3 =
* Tested up to 5.4.2
* Added the option to bulk regenerate/cleanup only featured images
* Fix the deprecated array and string offset access syntax with curly braces for PHP >= 7.4

= 5.4.2 =
* Added the raw clean up button in the media listing screen (this is available only when using the option to display the summary too).
* Added the option to display the summary of images generated for each attachment in the media listing screen that gets updated when other actions are performed in the image details lightbox, on regenerate and raw cleanup.
* Style updates for the small resolutions.

= 5.4.1 =
* Fixed the upscale for a square image.

= 5.4 =
* Tested up to 5.4
* Added the upscale option that allows to upscale images (with close original sizes to the expected crop) before applying a crop, when the perfect fit option is on.

= 5.3.5 =
* Added more details about the missing files in the image details lightbox, so that the files that are removed (from FTP or otherwise by third-party plugins, manual removal, etc.) are marked as missing files, even if these are still recorded in the database. Updated the alternative text over the delete icon to read "Cleanup the metadata" for clarity.
* Added the option to keep the plugin settings after the plugin is deactivated.
* Fix error on image upload when also using WP Offload Media plugin that is messing with the attachment metadata and triggers a WP_Error

= 5.3.4 =
* Fix warnings for previously missing settings.

= 5.3.3 =
* Added the option to filter and expose the image sizes available for the attachment display settings in the media dialog (any registered available size, even when there is no explicit filter applied).

= 5.3.2 =
* Added the option to regenerate only missing files, without overriding the existing ones.
* Added the cleanup log to summarize the cleanup errors at the end of the process.
* Fix the issue when using with WooCommerce and the crop position was not processed correctly, it was only selecting the center of the image, regardless of the expected crop position.
* Fix the raw cleanup.
* Fix ghost image sizes' settings.

= 5.3.1 =
* Tested up to 5.3.2.
* Added a new hook for integration with EWWW Image Optimizer plugin
* Readme updates

= 5.3 =
* Tested up to 5.3.
* Added a new option to override the featured image size in the meta box.
* Fixed the attachment display settings size options in the media screens when there are globally ignored and unavailable sizes.
* Added custom hooks for other plugins' integration.

= 5.2.1 =
* Bypass the fallback to the original metadata for smaller image sizes.
* Fix the crop option for medium and large (in some cases that was not saved properly).
* Display small buttons when using Gutenberg.
* Updated screenshots with the latest version options.

= 5.2 =
* Tested up to 5.3-RC2.
* Integration with EWWW Image Optimizer plugin to allow the sync of ignored image sizes.
* Save the general setting without refreshing the page.
* Added the reset to the default quality loss setting.
* Created three new action hooks: sirsc_image_processed (parameters: $attachment_id, $image_size), sirsc_attachment_images_processed (parameter: $metadata, $attachment_id), sirsc_image_file_deleted (parameters: $attachment_id, $file).
* Added the option to show small buttons in the media screen.
* Added two new cleanup options, one that allows for the removal of unused files from older image sizes, and one for raw cleanup that keeps only the original/full file. PLEASE NOTE: BOTH NEW CLEANUP TYPES ARE RECOMMENDED FOR COMMAND LINE USE (`resetcleanup` & `rawcleanup`). USE THESE AT YOUR OWN RISK.
* Notify other scripts when processing by defining the DOING_SIRSC constant.
* Added the functionality that will attempt to regenerate metadata and sub-sizes when the upload failed but the file got uploaded but no metadata or sub-sizes were done. This is triggered when opening the image details lightbox.
* Added the functionality that attempts to fix the broken metadata by matching the generated files with the expected image sizes.
* Added extra details in the image details lightbox about each image associated with an attachment and the status of the image size and the option to delete individually.

= 5.0.1 =
* Fix notifications loaded too soon.

= 5.0 =
* Changes to allow direct access to the features from the main menu.
* Separate current features and allow access from the menu to general settings, advanced rules, media settings custom options, additional sizes, and features manager.
* Added support for the new extensions: Import/Export, Images SEO, Uploads Folder Info, and Uploads Inspector.
* Added general settings new option that allows to turn off/on the WooCommerce background thumbnails regenerate.
* New option to resume the regenerate process from the settings page for each of the image sizes.
* Introduced the features manager that allows to turn on/off additional functionality related to the plugin
* Support for Import/Export extension (free) that allows replicating quickly the settings from one environment to another.
* Support for Images SEO extension (yearly license) that allows to rename the image files and override the attachments' attributes based on the settings.
* Support for Uploads Folder Info extension (yearly license) that allows you to see details about your application uploads folder.
* Support for Uploads Inspector extension (yearly license) that allows you to analyze the files from your uploads folder (even the orphaned files).

= 4.8 =
* Tested up to 5.2.2 version.
* Assess and capture background errors.
* Added support for future WooCommerce product gallery hook.
* Added the new unavailable option for image sizes.
* Added the new option to disable the generation of imperfect match image sizes.
* Styles update.
* Toggle the cleanup button.
* Regenerate for the imperfect image sizes from the individual image info lightbox.
* Added the regenerate log.
* Added error and success info details during the regeneration and cleanup process.
* Simplified paths output.
* Minor speed-up of bulk processing.
* Hide by default the info and regenerate buttons when using Gutenberg and no image set.

= 4.7.4 =
* Fix warnings for updating custom image sizes when both width and height are not provided.
* Tested up to 5.2 version.

= 4.7.3 =
* Fix the missing checkbox column in the media listing screen

= 4.7.2 =
* Added custom image sizes in the Attachment Display Settings > Size dropdown available in the native WordPress media screen (only the image sizes that are not marked for global ignore in the settings, and these for which the image was generated will become available).

= 4.7.1 =
* Added missing changes for scale quality.

= 4.7 =
* Added a custom column in the media listing with the options to see details and regenerate.
* Added the option to set custom quality for images directly when regenerating from the details lightbox.

= 4.6.1 =
* Expose the native medium-large hidden sub-size
* Add a delete option for generated images that are smaller than the expected size.

= 4.6 =
* Translation fix for the button used with the Gutenberg block
* Added targeted delete option in the lightbox for each image size generated for an image
* Link the media settings (medium and large crop option + define new custom image sizes) in the plugin settings page.

= 4.5 =
* Tested up to 5.1.1 version
* Comment out the buttons' action that is no longer necessary for WP >= 5.1.

= 4.4 =
* Tested up to 5.0.1 version
* New settings for crop option of the native medium and large images
* New options for registering custom image sizes from the UI
* Gutenberg support for the featured image buttons that allow to see details and regenerate.

= 4.3 =
* Tested up to 4.9.8 version
* New WP-CLI command to clean up everything except for the full-size image, if you want to clean up and start over
* New WP-CLI command flags to force the removal of image sizes that are not registered in the application anymore
* Configurable custom rules and a new hook added so that you can create programmatically more complex rules
* Changes to the info view to that include links to the original and the generated images
* Styling updates
* Added translation source file and RO translation included

= 4.2.2 =
* Tested up to 4.9.2 version
* Added Imagick support and fallback for placeholders
* Added progress to WP-CLI commands

= 4.2.1 =
* Fix static warning, fix access to the direct wp-admin folder instead of login

= 4.2 =
* Tested up to 4.8.3 version
* Add the image quality option for each image size, display the quality settings and the file size in the image details overlay
* Preserve the selected crop position for the image size in the image details overlay
* Fix multisite warning on switching the blog when using the WP-CLI commands

= 4.1 =
* Tested up to 4.8 version
* Fix the missing button for 4.8

= 4.0 =
* Tested up to 4.6.1 version
* Update the image buttons to work with WP >= 4.6 new hooks parameters
* Changes for the image buttons backward compatibility (core versions less than 4.6)

= 3.3 =
* Tested up to 4.4.2 version
* Cleanup
* Fix typo
* Fix element position in the edit media screen

= 3.2 =
* Tested up to 4.3.1 version

= 3.1 =
* Add * in front of options that have settings applied.

= 3.0 =
* Add the forced original resize execution for already uploaded images when using the regenerate option (this will not just resize the images for the selected image size but will also alter the original images).

= 2.0 =
* Add the default crop configuration for each image size.
* And the WP-CLI extension.

== Upgrade Notice ==
None

== License ==
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

== Version history ==
7.3.3 - Adjusted the initial threshold to match better the portrait images; cleanup artefact images; fixed warnings for unidentified crop position
7.3.2 - Changed the path of the logs to use the uploads folder; fixed the final file name and output info for the forced original size
7.3.1 - Added extra random string to hashed log files names
7.3.0 - Tested up to 6.4; security updates - added the log index file and hashed log files names
7.2.5 - Fixed the error for WooCommerce product in Classic editor on site running Divi
7.2.4 - Tested up to 6.3.1; fixed log warnings for not writable folder; fixed the sub-size quality on upload; exposed all image sizes in the editor settings
7.2.3 - Fixed the option "bulk regenerate/cleanup execution starts from the most recent files" remaining auto selected
7.2.2 - Tested up to 6.3; minor styles updates
7.2.1 - Forced release to fix the previous deployment issue
7.2.0 - Tested up to 6.2.2; security updates - limited the special features to only admins; added WP-CLI commands extensive details to the FAQ section of the plugin readme; added the info, regenerate, and cleanup buttons in the select/upload media dialog; fixed some warnings when using the reset cleanup command
7.1.0 - Tested up to 6.2; added the option to disable the verbose tracer log; added the filter `sirsc_keep_scaled`; updated the exclude post types lists; updated the wp-cli regenerate command to be in sync with the "regenerate only missing files" and "regenerate/cleanup only featured images" settings from the bulk actions; updated the wp-cli commands description, synopsis, and options details; fixed the admin menu overlay
7.0.1 - Fixed warnings when the initial metadata is incorrect (missing width or height) and bypass summary, fixed the SVGs preview in admin listing
7.0.0 - Tested up to 6.1.1, WP 6.1.1/PHP 8/WooCommerce compatibility updates, added the custom images sizes to the editor images sizes, small performance optimization for the custom advanced rules hook, added custom rules for featured images, trace the matched rule, notification and top info filter, fixed the mime type warning on SVG upload, dependencies/translations/styles updates
6.2.2 - Tested up to 5.9.2, fixed crop typo, bypass placeholder for no width or height, excluded new core post types
6.2.1 - Tested up to 5.9, clear attachment cache before re-computing the object after the image regenerate
6.2.0 - Tested up to 5.8.2, placeholder fallback, change filter priority to apply earlier the available sizes, fix warnings for info not available in some of the core versions, fix warnings for estimated sizes missing width or height, attempt to bypass scaled size naming, updated sizes filter for backward compatibility, logs length limit, log the WP-CLI command executions, styles adjustments
6.1.0 - Tested up to 5.8.1, add wp-cli commands hints for the bulk features, the new wp-cli command to rename files for SEO adon active, a new option that turns on/off the buttons from the media screen when switched to grid mode.
6.0.3 - Implemented a save fallback for media settings, updated the media settings UI, default bulk action in reverse for new installs
6.0.2 - Add back action when attachment gets deleted
6.0.1 - Fix medium large crop option update, added the close icon to the info lightbox, style adjustments for the enabled custom rules, fix cleanup button class typo
6.0.0 - Tested up to 5.8, general settings UI changes, new reset settings feature, new option to bulk regenerate/cleanup execution starting from the most recent files, new option to turn on the custom debug log, new option to execute bulk actions using the WordPress cron tasks, new debug tab, expose the custom placeholders, fix the counters, optimized the info lightbox, decouple image size file deletion for multiple matched images sizes, auto-update preview, added buttons in the media library view in the grid mode, fix assets enqueue for >= 5.6, completely decoupled from jQuery
5.5 - Tested up to 5.5.1, added export image sizes snippet, added image metadata fallback if missing
5.4.4 - Tested up to 5.5, fix warnings, placeholder path and font, a summary update on sub-size change, change the threshold default quality on forced original, assets update
5.4.3 - Tested up to 5.4.2, regenerate/cleanup only featured images, fix the deprecated array and string offset for PHP >= 7.4
5.4.2 - Added raw cleanup button and the option to display the summary in the media listing screen, style updates for small resolutions.
5.4.1 - Fixed the upscale for a square image
5.4 - Tested up to 5.4, upscale option for the perfect fit crop.
5.3.5 - Added more details about the removed files in the image details lightbox, keep plugin settings after deactivation, and fix errors when also using the WP Offload Media plugin.
5.3.4 - Fix warnings for previously missing settings.
5.3.3 - Forced expose the image sizes for the attachment display settings in the media dialog.
5.3.2 - Regenerate only missing files, clean up log, fix the crop position issue when using with WooCommerce, fix the raw cleanup, and fix ghost image sizes.
5.3.1 - Tested up to 5.3.2, new hook for integration with EWWW Image Optimizer plugin.
5.3 - Tested up to 5.3, overridden the featured image size in the meta box, fix the attachment display settings size options in the media screens, and custom hooks for other plugins integration.
5.2.1 - Bypass the fallback to original metadata, fix the crop option save, small buttons when using Gutenberg, new screenshots
5.2 - Tested up to 5.3-RC2, integration with EWWW Image Optimizer, save general setting without refresh, reset to default quality, new action hooks, show small buttons, two new cleanup options, define DOING_SIRSC, attempt to regenerate metadata and sub-sizes, attempts to fix the broken metadata, extra details in the image details lightbox.
5.0.1 - Fix notifications loaded too soon.
5.0 - Features direct access from the main menu, separate current features, new option to turn off/on the WooCommerce background thumbnails regenerate, new option to resume the regenerate process, support for the new extensions: Import/Export, Images SEO, Uploads Folder Info, Uploads Inspector.
4.8 - Tested up to 5.2.2 version, assess and capture background errors, support for future WooCommerce product gallery hook, new unavailable option, new option to disable generation of imperfect match image sizes, styles update, toggle the cleanup button, regenerate log, error and success info, simplified paths, minor speed-up of bulk processing, hide by default the info and regenerate buttons when using Gutenberg and no image set.
4.7.4 - Fix warnings for updating custom image sizes, tested up to 5.2 version.
4.7.3 - Fix the missing checkbox column in the media listing screen.
4.7.2 - Added custom image sizes in the Attachment Display Settings > Size dropdown available in the native WordPress media screen.
4.7.1 - Added missing changes for scale quality.
4.7 - New custom column in media listing with the options to see details and regenerate, new option to set custom quality for images directly when regenerating from the details lightbox.
4.6.1 - Expose the native medium large hidden size, and add a delete option for generated images that are smaller than the expected size.
4.6 - Translation fix, added targeted delete option in the lightbox for each image size generated for an image, link the media settings in the plugin settings page.
4.5 - Tested up to 5.1.1 version, comment out the buttons' action that is no longer necessary for WP >= 5.1.
4.4 - Tested up to 5.0.1 version, new settings for crop option of the native medium and large images, new options for registering custom image sizes from the UI, Gutenberg support for the featured image buttons that allow to see details and regenerate.
4.3 - Tested up to 4.9.8 version, new WP-CLI command and flags, configurable custom rules and new hook for more complex rules, links to the images from the info view, styling updates, translations
4.2.2 - Tested up to 4.9.2 version, added Imagick support and fallback for placeholders, added progress to WP-CLI commands
4.2.1 - Fix static warning, fix direct access to the wp-admin folder instead of login
4.2 - Tested up to 4.8.3 version, add the image quality option for each image size, display the quality settings and the file size in the image details overlay, preserve the selected crop position for the image size in the image details overlay, dix multisite warning on switching the blog when using the WP-CLI commands
4.1 - Tested up to 4.8 version, fix the missing button for 4.8 in the edit post screen
4.0 - Tested up to 4.6.1 version, update the image buttons to work with WP >= 4.6 new hooks parameters, changes for the image buttons backward compatibility (core versions less than 4.6)
3.3 - Tested up to 4.4.2 version, code cleanup, fix typo, fix element position in edit media screen
3.0 - Forced original resize for already uploaded images when using the regenerate option.
2.0 - Default crop configuration and WP-CLI extension.
1.0 - Prototype.

== Custom Actions ==
If you want to display the custom buttons in your plugins, you can use the custom action with $attachmentId parameter as the image post->ID you want the button for. Usage example : do_action( 'image_regenerate_select_crop_button', $attachmentId );

== Images Placeholders Developer Mode ==
This option allows you to display placeholders for front-side images called programmatically (that are not embedded in content with their src, but retrieved with the wp_get_attachment_image_src, and the other related WP native functions). If there is no placeholder set, then the default behavior would be to display the full-size image instead of the missing image size.
If you activate the "force global" option, all the images on the front side that are related to posts will be replaced with the placeholders that mention the image size required. This is useful for debugging, to quickly identify the image sizes used for each layout.
If you activate the "only missing images" option, all the images on the front side that are related to posts and do not have the requested image size generated will be replaced with the placeholders that mention the image size required. This is useful for showing smaller images instead of full-size images.

== Global Ignore ==
This option allows you to exclude globally from the application some of the image sizes that are registered through various plugins and themes' options, but you don't need these in your application at all (these are just stored in your folders and database but not used). By excluding these, unnecessary image sizes will not be generated at all.

== Hide Preview ==
This option allows you to exclude from the "Image Regenerate & Select Crop Settings" lightbox the details and options for the selected image sizes. This is useful when you want to restrict from other users the functionality of crop or resize for particular image sizes.

== Force Original ==
This option means that the original image will be scaled to a max width or a max height specified by the image size you select. This might be useful if you do not use the original image in any of the layouts at the full-size, and this might save some storage space.
Leave "nothing selected" to keep the original image as what you upload.

== Cleanup All ==
This option allows you to clean up all the image sizes you already have in the application but you don't use these at all. Please be careful, once you click to remove the selected image size, the action is irreversible, the images generated will be deleted from your folders and database records.

== Regenerate All ==
This option allows you to regenerate all the images for the selected sub-sizes. Please be careful, once you click to regenerate the selected image size, the action is irreversible, the images already generated will be overwritten.

== Default Crop ==
This option allows you to set a default crop position for the images generated for a particular image suz-size. This default option will be used when you chose to regenerate an individual image or all of these and also when a new image is uploaded.

== WP-CLI Usage ==
The available methods are "regenerate" and "cleanup". The arguments for both methods are the site id (1 for a single site install, or if you are using the plugin in the multi-site environment then you should specify the site id), the post type (post, page, or one of your custom post types), image size name (thumbnail, medium, etc.).

However, if you do not know all the options you have you can simply start by running the command "sirsc regenerate 1" and for each argument that is not mentioned the plugin will present the list of available values.
If you want to regenerate the images for only one post, then the 4th argument can be passed and this should be the post ID.

So, for example, if I would want to regenerate just the thumbnails for a post with the ID = 7, my command would be

* sirsc regenerate 1 post thumbnail 7

If I would want to regenerate just the medium images for a post with the id 7, my command would be

* sirsc regenerate 1 post medium 7

You can regenerate all images sizes for all the pages like this:

* sirsc regenerate 1 page all

Or, you can regenerate all images sizes for the page with the ID = 3 type like this:

* sirsc regenerate 1 page all 3

The cleanup command works with the parameters exact order and types as the regenerate one.
