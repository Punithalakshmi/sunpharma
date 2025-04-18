# Changelog

All notable changes to this library will be documented in this file.

This project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [v1.3.5](https://github.com/NexusPHP/tachycardia/compare/v1.3.4...v1.3.5) - 2021-11-02

- Update build workflow
- Use custom fixers
- Update to phpstan 1.0
- Change branch alias

## [v1.3.4](https://github.com/NexusPHP/tachycardia/compare/v1.3.3...v1.3.4) - 2021-06-19

- Change parent namespace to "Nexus"
- Drop `phpstan/phpstan-strict-rules` but retain some strict features
- Force `@covers` annotations in phpunit and php-cs-fixer configs
- Update code styles from `nexusphp/cs-config` v3.2.0

## [v1.3.3](https://github.com/NexusPHP/tachycardia/compare/v1.3.2...v1.3.3) - 2021-06-01

- Updated code style reversal for `native_constant_invocation`

## [v1.3.2](https://github.com/NexusPHP/tachycardia/compare/v1.3.1...v1.3.2) - 2021-06-01

- Mark as draft the contents generated by the automated release script
- Update to new code styles from `nexusphp/cs-config`

## [v1.3.1](https://github.com/NexusPHP/tachycardia/compare/v1.3.0...v1.3.1) - 2021-05-07

- Updated `friendsofphp/php-cs-fixer` to v3.0.0 Constitution
- Bump `nexusphp/cs-config` to ^3.0
- Github Actions annotations are enabled for all PHP versions in testing

## [v1.3.0](https://github.com/NexusPHP/tachycardia/compare/v1.2.0...v1.3.0) - 2021-04-15

- Documentation has now moved to the `docs/` folder ([cf88213](https://github.com/NexusPHP/tachycardia/commit/cf88213630b0f825e6d6e24764284d72699169f0))
- It is now possible to limit execution times to the time of the actual tests excluding hooks ([\#8](https://github.com/NexusPHP/tachycardia/issues/8))
- Made data name optional on `TestCase::getTestName` ([82a8957](https://github.com/NexusPHP/tachycardia/commit/82a8957068f0aa7d3250c6b6f7ce13d10a73af03))
- Fixed PSR4 names of several classes ([2212423](https://github.com/NexusPHP/tachycardia/commit/221242342e1644fecd6a596ba57f77097fe52c22))

## [v1.2.0](https://github.com/NexusPHP/tachycardia/commpare/v1.1.1...v1.2.0) - 2021-04-01

- Added `Parser` and `TestCase` util classes ([24949f1](https://github.com/NexusPHP/tachycardia/commit/24949f1b9e916f9fe2a49dd10ac41a1c4b2f9d83), [4342500](https://github.com/NexusPHP/tachycardia/commit/43425004816f6799e8620649a2a62917c6f562f1))
- Refactored `Tachycardia` and moved `GithubMonitor` as a util class ([ae2f920](https://github.com/NexusPHP/tachycardia/commit/ae2f92055c3b0070c55bf262d09d57ff3780f997))
- Fixed custom time limits not respected in data providers ([\#7](https://github.com/NexusPHP/tachycardia/issues/7), [f9750f6](https://github.com/NexusPHP/tachycardia/commit/f9750f6fac13213649a72f90e58f2e28d9b1ac6d))

## [v1.1.1](https://github.com/NexusPHP/tachycardia/compare/v1.1.0...v1.1.1) - 2021-03-28

- Fixed misplaced sections in README ([ec868d5](https://github.com/NexusPHP/tachycardia/commit/ec868d5d22e6dbc7a117cf1672acadbd3a524e94))

## [v1.1.0](https://github.com/NexusPHP/tachycardia/compare/v1.0.0...v1.1.0) - 2021-03-27

- Fixed correct line number rendering in Github Actions ([\#3](https://github.com/NexusPHP/tachycardia/pull/3))
- Fixed initial release date ([\#4](https://github.com/NexusPHP/tachycardia/pull/4))
- Added ability to supply class-level time limit annotations ([\#5](https://github.com/NexusPHP/tachycardia/pull/5))
- Added ability to disable time limits on a per-class or per-method level ([\#6](https://github.com/NexusPHP/tachycardia/pull/6))

## [v1.0.0](https://github.com/NexusPHP/tachycardia/releases/tag/v1.0.0) - 2021-03-21

Initial release.

Core classes:
- `Nexus\PHPUnit\Extension\GitHubMonitor` - Accessory class to print warnings in Github Actions.
- `Nexus\PHPUnit\Extension\Tachycardia` - The actual PHPUnit extension.
