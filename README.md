# Fossdroid Core

Fossdroid Core is a web frontend of [F-Droid](https://f-droid.org): an alternative software repository comprising only free, open source software for Android.

This repo is the open source version of [Fossdroid.com](https://fossdroid.com).

## Screenshots

![Homepage](/screenshot_1.png?raw=true "Homepage")
![App details](/screenshot_2.png?raw=true "App details")

## Requirements

* PHP >=5.6 or PHP 7
* GD >= 2.0 and/or Imagick >= 2.0 and/or Gmagick >= 1.0

## Installing

1. Clone repo
2. Create database
3. Install dependencies and change the "melodycode_fossdroid.local_path_icons" attribute:
    ```
    composer update
    ```
4. Create schema:
    ```
    php app/console doctrine:schema:create
    ```
5. Sync:
    ```
    php app/console fossdroid:sync
    ```

## Why "Core"?

Because this repo contains all the code of [Fossdroid.com](https://fossdroid.com) except:

* Scraping engine that download screenshots from another source
* Popularity data

## Authors

* **Daniele Simonin** - [Melodycode.com](https://melodycode.com)

## License

This project is licensed under the terms of the [MIT license](LICENSE).
