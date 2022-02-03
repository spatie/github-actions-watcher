# A CLI tool to see the status of your GitHub Actions workflows in real time

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/github-actions-watcher.svg?style=flat-square)](https://packagist.org/packages/spatie/github-actions-watcher)
[![Tests](https://github.com/spatie/github-actions-watcher/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/spatie/github-actions-watcher/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/github-actions-watcher.svg?style=flat-square)](https://packagist.org/packages/spatie/github-actions-watcher)

Using this tool you can monitor the results of all your GitHub Actions. When installed, you can just execute `actions-watcher` to see all results.

By default, the watcher will use the git repo and branch of the directory it is launched in. It will keep polling and refreshing results until all workflows of your repo have been completed.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/github-actions-watcher.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/github-actions-watcher)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the tool via composer:

```bash
composer global require spatie/github-actions-watcher
```

## Usage

You can just execute the tool on your cli.

```bash
actions-watcher
```


By default, the watcher will use the git repo and branch of the directory it is launched in. It will keep polling and refreshing results until all workflows of your repo have been completed.

## Authenticating with GitHub

To see results of private repos, you must authenticate with GitHub. Even when working with public repos, we highly recommend authenticating, as you'll get higher rate limit when the tools communicates with GitHub.

You can authenticate with GitHub by executing this command:

```bash
actions-watcher login
```

After having completed the login flow, a token will be stored on your disk. At no point, Spatie can see any data of your repos or user.

To destroy the token on your hard disk, execute the `logout` command.

```
actions-watcher logout
```

## Single pass

If you don't want to poll for new results, but just want to see current results use the `--single-pass` option

```bash
actions-watcher --single-pass
```

## Using an alternative repo and/or branch

By default, the watcher will use the git repo and branch of the directory it is launched in. It will keep polling and refreshing results until all workflows of your repo have been completed. 

If you want to use another repo or branch, use the `--repo` and `--branch` flags.

```bash
actions-watcher --repo=your-organisation/your-repo-name --branch=other-branch
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

A big thank you to [Francisco Madeira](https://github.com/xiCO2k) for helping us with the layout of the screens.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
