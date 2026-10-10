# Changelog

<a name="unreleased"></a>
## Unreleased

### 🐛 Bug Fixes

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/2309e446da8c71ea7afe86d4889c6998e0dd8542"><code>2309e44</code></a> <b>attributes:</b> 🐛 return attribute value if exists in attrs</summary>

  > - Ensure that the attribute value is returned from the attrs array if it exists.
  > - This change improves the reliability of attribute retrieval in the Attributes class.

  </details>

### Other changes

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/142dc115562559ec1f34d40c46daf5efbaac07cc"><code>142dc11</code></a> <b>documentation:</b> ⬆️ Update Flarum theme dependencies</summary>

  > Update Bootstrap and jQuery versions in the Flarum theme for the documentation.  This ensures compatibility with the latest versions and resolves potential conflicts.
  >
  > - Updated Bootstrap to ^5.3.3
  > - Updated jQuery to ^3.7.1
  > - Updated related Babel and Webpack dependencies

  </details>

<a name="3.3"></a>
## [3.3](https://github.com/maicol07/flarum-sso-php-plugin/compare/3.2...3.3)

> Released on March 22, 2024

### ✨ Features

- [`8f621a4`](https://github.com/maicol07/flarum-sso-php-plugin/commit/8f621a48fc195fa2e33b9f49fe1a523742d7435b) ✨ Added dirty attributes and relationship handling

### 🐛 Bug Fixes

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/bf452dd254cb511f76faed39f4bcc43daa08b7c5"><code>bf452dd</code></a> Upgrade bootstrap from 4.6.0 to 4.6.2</summary>

  > Snyk has created this PR to upgrade bootstrap from 4.6.0 to 4.6.2.
  >
  > See this package in npm:
  > https://www.npmjs.com/package/bootstrap
  >
  > See this project in Snyk:
  > https://app.snyk.io/org/maicol07/project/14ec3470-1b32-45eb-bbcd-6750c6ff2cb5?utm_source=github&utm_medium=referral&page=upgrade-pr

  </details>
- [`90f8508`](https://github.com/maicol07/flarum-sso-php-plugin/commit/90f8508eea6f44a025bee9bdd729bf9004fc778f) Property getters
- [`fff512b`](https://github.com/maicol07/flarum-sso-php-plugin/commit/fff512ba6c3ee250d61f2754ca78333f854f8d57) Fix dirty cleaning after fetch
- [`145302c`](https://github.com/maicol07/flarum-sso-php-plugin/commit/145302cb83366d108df8386f4063c8c4526777d7) Groups not using dirty relationship

### ♻️ Code Refactoring

- [`a3fea6a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/a3fea6a2e1e5044dff36e8837edb8bcfe53fc6bb) 🎨 Formatted code

### 👷 Building scripts changes

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/95973f671eb3715d227e6d7f8e74a0d36844c44f"><code>95973f6</code></a> <b>deps:</b> Bump ajv in &#x2F;documentation&#x2F;themes&#x2F;flarum</summary>

  > Bumps [ajv](https://github.com/ajv-validator/ajv) from 6.5.4 to 6.12.6.
  > - [Release notes](https://github.com/ajv-validator/ajv/releases)
  > - [Commits](https://github.com/ajv-validator/ajv/compare/v6.5.4...v6.12.6)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: ajv
  >   dependency-type: indirect
  > ...

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/0d9e28dab8271d10e0f594456a3419bc3e45f257"><code>0d9e28d</code></a> <b>deps:</b> Bump minimist in &#x2F;documentation&#x2F;themes&#x2F;flarum</summary>

  > Bumps [minimist](https://github.com/minimistjs/minimist) from 1.2.0 to 1.2.8.
  > - [Changelog](https://github.com/minimistjs/minimist/blob/main/CHANGELOG.md)
  > - [Commits](https://github.com/minimistjs/minimist/compare/v1.2.0...v1.2.8)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: minimist
  >   dependency-type: indirect
  > ...

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/5f952afdee74b6ce0f237ad0f112da34fe1ebf78"><code>5f952af</code></a> <b>deps:</b> Bump decode-uri-component in &#x2F;documentation&#x2F;themes&#x2F;flarum</summary>

  > Bumps [decode-uri-component](https://github.com/SamVerschueren/decode-uri-component) from 0.2.0 to 0.2.2.
  > - [Release notes](https://github.com/SamVerschueren/decode-uri-component/releases)
  > - [Commits](https://github.com/SamVerschueren/decode-uri-component/compare/v0.2.0...v0.2.2)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: decode-uri-component
  >   dependency-type: indirect
  > ...

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/8a38263e5bb724064ec665854220a22b83517fc2"><code>8a38263</code></a> <b>deps-dev:</b> Bump y18n in &#x2F;documentation&#x2F;themes&#x2F;flarum</summary>

  > Bumps [y18n](https://github.com/yargs/y18n) from 3.2.1 to 3.2.2.
  > - [Release notes](https://github.com/yargs/y18n/releases)
  > - [Changelog](https://github.com/yargs/y18n/blob/master/CHANGELOG.md)
  > - [Commits](https://github.com/yargs/y18n/commits)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: y18n
  >   dependency-type: indirect
  > ...

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/1946557c3dfd9b860af7559e2f0fc9924e514c10"><code>1946557</code></a> <b>deps-dev:</b> Bump elliptic in &#x2F;documentation&#x2F;themes&#x2F;flarum</summary>

  > Bumps [elliptic](https://github.com/indutny/elliptic) from 6.5.3 to 6.5.4.
  > - [Commits](https://github.com/indutny/elliptic/compare/v6.5.3...v6.5.4)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: elliptic
  >   dependency-type: indirect
  > ...

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/5b4369b9fe67a6a0e41ddec3d0b68fd36b3b5718"><code>5b4369b</code></a> <b>deps:</b> Bump decompress and image-webpack-loader</summary>

  > Bumps [decompress](https://github.com/kevva/decompress) to 4.2.1 and updates ancestor dependency [image-webpack-loader](https://github.com/tcoopman/image-webpack-loader). These dependencies need to be updated together.
  >
  >
  > Updates `decompress` from 3.0.0 to 4.2.1
  > - [Release notes](https://github.com/kevva/decompress/releases)
  > - [Commits](https://github.com/kevva/decompress/compare/v3.0.0...v4.2.1)
  >
  > Updates `image-webpack-loader` from 4.3.1 to 4.6.0
  > - [Changelog](https://github.com/tcoopman/image-webpack-loader/blob/master/CHANGELOG.md)
  > - [Commits](https://github.com/tcoopman/image-webpack-loader/compare/v4.3.1...v4.6.0)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: decompress
  >   dependency-type: indirect
  > - dependency-name: image-webpack-loader
  >   dependency-type: direct:development
  > ...

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/5b7367dd9bef611285ff2522b65fd01c3b302a18"><code>5b7367d</code></a> <b>deps:</b> Bump terser in &#x2F;documentation&#x2F;themes&#x2F;flarum</summary>

  > Bumps [terser](https://github.com/terser/terser) from 4.8.0 to 4.8.1.
  > - [Release notes](https://github.com/terser/terser/releases)
  > - [Changelog](https://github.com/terser/terser/blob/master/CHANGELOG.md)
  > - [Commits](https://github.com/terser/terser/compare/v4.8.0...v4.8.1)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: terser
  >   dependency-type: indirect
  > ...

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/f1e6c7b2e2cf13a6d14bfd55c6f0ea5904e3a7f3"><code>f1e6c7b</code></a> <b>deps:</b> Bump loader-utils in &#x2F;documentation&#x2F;themes&#x2F;flarum</summary>

  > Bumps [loader-utils](https://github.com/webpack/loader-utils) from 1.1.0 to 1.4.2.
  > - [Release notes](https://github.com/webpack/loader-utils/releases)
  > - [Changelog](https://github.com/webpack/loader-utils/blob/v1.4.2/CHANGELOG.md)
  > - [Commits](https://github.com/webpack/loader-utils/compare/v1.1.0...v1.4.2)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: loader-utils
  >   dependency-type: indirect
  > ...

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/832bd11e9a5e4dfabe0605f6405f17286a727dfb"><code>832bd11</code></a> <b>deps:</b> Bump nth-check, image-webpack-loader and optimize-css-assets-webpack-plugin</summary>

  > Bumps [nth-check](https://github.com/fb55/nth-check) to 2.1.1 and updates ancestor dependencies [nth-check](https://github.com/fb55/nth-check), [image-webpack-loader](https://github.com/tcoopman/image-webpack-loader) and [optimize-css-assets-webpack-plugin](https://github.com/NMFR/optimize-css-assets-webpack-plugin). These dependencies need to be updated together.
  >
  >
  > Updates `nth-check` from 1.0.2 to 2.1.1
  > - [Release notes](https://github.com/fb55/nth-check/releases)
  > - [Commits](https://github.com/fb55/nth-check/compare/v1.0.2...v2.1.1)
  >
  > Updates `image-webpack-loader` from 4.3.1 to 8.1.0
  > - [Release notes](https://github.com/tcoopman/image-webpack-loader/releases)
  > - [Changelog](https://github.com/tcoopman/image-webpack-loader/blob/master/CHANGELOG.md)
  > - [Commits](https://github.com/tcoopman/image-webpack-loader/compare/v4.3.1...v8.1.0)
  >
  > Updates `optimize-css-assets-webpack-plugin` from 5.0.4 to 6.0.1
  > - [Release notes](https://github.com/NMFR/optimize-css-assets-webpack-plugin/releases)
  > - [Commits](https://github.com/NMFR/optimize-css-assets-webpack-plugin/compare/v5.0.4...v6.0.1)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: nth-check
  >   dependency-type: indirect
  > - dependency-name: image-webpack-loader
  >   dependency-type: direct:development
  > - dependency-name: optimize-css-assets-webpack-plugin
  >   dependency-type: direct:development
  > ...

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/ce16614a12d2f213622365600c12b2ac4d041f3f"><code>ce16614</code></a> <b>deps:</b> Bump lodash in &#x2F;documentation&#x2F;themes&#x2F;flarum</summary>

  > Bumps [lodash](https://github.com/lodash/lodash) from 4.17.19 to 4.17.21.
  > - [Release notes](https://github.com/lodash/lodash/releases)
  > - [Commits](https://github.com/lodash/lodash/compare/4.17.19...4.17.21)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: lodash
  >   dependency-type: indirect
  > ...

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/f87db8e549e8183f06abbb76aeeecb18efed665c"><code>f87db8e</code></a> <b>deps:</b> Bump postcss and css-loader in &#x2F;documentation&#x2F;themes&#x2F;flarum</summary>

  > Bumps [postcss](https://github.com/postcss/postcss) to 8.4.31 and updates ancestor dependency [css-loader](https://github.com/webpack-contrib/css-loader). These dependencies need to be updated together.
  >
  >
  > Updates `postcss` from 7.0.4 to 8.4.31
  > - [Release notes](https://github.com/postcss/postcss/releases)
  > - [Changelog](https://github.com/postcss/postcss/blob/main/CHANGELOG.md)
  > - [Commits](https://github.com/postcss/postcss/compare/7.0.4...8.4.31)
  >
  > Updates `css-loader` from 1.0.0 to 6.8.1
  > - [Release notes](https://github.com/webpack-contrib/css-loader/releases)
  > - [Changelog](https://github.com/webpack-contrib/css-loader/blob/master/CHANGELOG.md)
  > - [Commits](https://github.com/webpack-contrib/css-loader/compare/v1.0.0...v6.8.1)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: postcss
  >   dependency-type: indirect
  > - dependency-name: css-loader
  >   dependency-type: direct:development
  > ...

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/c95a58c7a178edde6a8237abd4e6c3f59ee1b8fa"><code>c95a58c</code></a> <b>deps-dev:</b> Bump @babel&#x2F;traverse in &#x2F;documentation&#x2F;themes&#x2F;flarum</summary>

  > Bumps [@babel/traverse](https://github.com/babel/babel/tree/HEAD/packages/babel-traverse) from 7.11.5 to 7.23.2.
  > - [Release notes](https://github.com/babel/babel/releases)
  > - [Changelog](https://github.com/babel/babel/blob/main/CHANGELOG.md)
  > - [Commits](https://github.com/babel/babel/commits/v7.23.2/packages/babel-traverse)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: "@babel/traverse"
  >   dependency-type: indirect
  > ...

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/7a28953845ec3787e3b79542169bb42d271813d6"><code>7a28953</code></a> <b>deps-dev:</b> Bump browserify-sign in &#x2F;documentation&#x2F;themes&#x2F;flarum</summary>

  > Bumps [browserify-sign](https://github.com/crypto-browserify/browserify-sign) from 4.2.1 to 4.2.2.
  > - [Changelog](https://github.com/browserify/browserify-sign/blob/main/CHANGELOG.md)
  > - [Commits](https://github.com/crypto-browserify/browserify-sign/compare/v4.2.1...v4.2.2)
  >
  > ---
  > updated-dependencies:
  > - dependency-name: browserify-sign
  >   dependency-type: indirect
  > ...

  </details>

### Other changes

- [`acc919d`](https://github.com/maicol07/flarum-sso-php-plugin/commit/acc919d6ef5f7051b3fc8d4329fdf03a6d06c029) IDE files

### 🔀 Pull Requests

- [`3b5f2d7`](https://github.com/maicol07/flarum-sso-php-plugin/commit/3b5f2d7c9dd28a1031376414bfc71b977ce82c0c) Merge pull request #36 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/ajv-6.12.6
- [`8ff38f9`](https://github.com/maicol07/flarum-sso-php-plugin/commit/8ff38f900d3361a0344a302ee8fdfc482803644f) Merge pull request #34 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/minimist-1.2.8
- [`39d2013`](https://github.com/maicol07/flarum-sso-php-plugin/commit/39d20134754a8116d13f0444b938be659686698b) Merge pull request #33 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/decode-uri-component-0.2.2
- [`bcf5123`](https://github.com/maicol07/flarum-sso-php-plugin/commit/bcf512311def7e5e69a7288dbadb5301cb701d13) Merge pull request #37 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/y18n-3.2.2
- [`ea2b3dc`](https://github.com/maicol07/flarum-sso-php-plugin/commit/ea2b3dcfac8d18a3e7288e250bcce4d044523bee) Merge pull request #26 from maicol07/snyk-upgrade-2e775a410d9724445f7b8df4ad15c7c2
- [`8ec2870`](https://github.com/maicol07/flarum-sso-php-plugin/commit/8ec2870f2f038aad19f84fe5f09b0db4f15d07bb) Merge pull request #38 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/elliptic-6.5.4
- [`3544da4`](https://github.com/maicol07/flarum-sso-php-plugin/commit/3544da4f4e639abe5ac2caf6d130a6bc1b1af181) Merge pull request #39 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/decompress-and-image-webpack-loader-4.2.1
- [`1a4b4d9`](https://github.com/maicol07/flarum-sso-php-plugin/commit/1a4b4d9b596099713e5417a13fc30231fe1df502) Merge pull request #29 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/terser-4.8.1
- [`7a9f25b`](https://github.com/maicol07/flarum-sso-php-plugin/commit/7a9f25b4e8ed3a3206324fea5446da584dc45dcf) Merge pull request #35 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/loader-utils-1.4.2
- [`78a0308`](https://github.com/maicol07/flarum-sso-php-plugin/commit/78a030828ec08f3663525ef66c91313493dc2fed) Merge pull request #31 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/nth-check-and-image-webpack-loader-and-optimize-css-assets-webpack-plugin-2.1.1
- [`297e0ea`](https://github.com/maicol07/flarum-sso-php-plugin/commit/297e0ea6282c09e803ec3072d8eb3a14e973d992) Merge pull request #28 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/lodash-4.17.21
- [`569631b`](https://github.com/maicol07/flarum-sso-php-plugin/commit/569631b55407516a9b0e00298bed530a9de34647) Merge pull request #40 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/postcss-and-css-loader-8.4.31
- [`66ce4d1`](https://github.com/maicol07/flarum-sso-php-plugin/commit/66ce4d15f5ed60b96090a845584aec24e45bb1c3) Merge pull request #41 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/babel/traverse-7.23.2
- [`a4da357`](https://github.com/maicol07/flarum-sso-php-plugin/commit/a4da3572b13f022b970be69409878c8d29db546a) Merge pull request #42 from maicol07/dependabot/npm_and_yarn/documentation/themes/flarum/browserify-sign-4.2.2

<a name="3.2"></a>
## [3.2](https://github.com/maicol07/flarum-sso-php-plugin/compare/3.1...3.2)

> Released on August 26, 2023

### 🐛 Bug Fixes

- [`23e4847`](https://github.com/maicol07/flarum-sso-php-plugin/commit/23e4847b331b0e7337929a7abe05e563028ad972) Delete cookies when deleting a user
- [`8875750`](https://github.com/maicol07/flarum-sso-php-plugin/commit/887575059e4b38ca51896f45d73a8803330810bc) Allow dynamic properties on PHP 8.2

### ♻️ Code Refactoring

- [`3d4bb3c`](https://github.com/maicol07/flarum-sso-php-plugin/commit/3d4bb3c848f1289f6f161f463cd0890b4e896524) ♻️ General refactor

### Other changes

- [`5ca1bdd`](https://github.com/maicol07/flarum-sso-php-plugin/commit/5ca1bdd9b6bd7e71ee3185239ed43780564126cc) **deps:** Support Laravel 10
- [`0cce9e8`](https://github.com/maicol07/flarum-sso-php-plugin/commit/0cce9e83ed6ca0b9eb16d678c879f963e71cd6ac) **deps:** Added Laravel Pint
- [`cadd62a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/cadd62ae4266c645f674887865427e44b4e6846c) Upgraded to PHP 8.0
- [`09ab582`](https://github.com/maicol07/flarum-sso-php-plugin/commit/09ab58270cda5cff0eaba82dfe6ec4de79c482ac) Added rector

### 🔀 Pull Requests

- [`8018848`](https://github.com/maicol07/flarum-sso-php-plugin/commit/801884837d460bc217f2093d3e377385b3cba946) Merge pull request #32 from ipikles/master

### 💥 Breaking changes

- Upgraded to PHP 8.0

<a name="3.1"></a>
## [3.1](https://github.com/maicol07/flarum-sso-php-plugin/compare/3.0.1...3.1)

> Released on October 01, 2022

### ✨ Features

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/b923d5714300ef64b727acdd127d523b189585f8"><code>b923d57</code></a> ✨ Added ability to specify the cookie name prefix</summary>

  > - Standardized the PHPDoc

  </details>

### 🐛 Bug Fixes

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/282fc5c35b7ca5fb900b778b0cbb7f671379dac5"><code>282fc5c</code></a> Upgrade bootstrap from 4.5.2 to 4.6.0</summary>

  > Snyk has created this PR to upgrade bootstrap from 4.5.2 to 4.6.0.
  >
  > See this package in npm:
  > https://www.npmjs.com/package/bootstrap
  >
  > See this project in Snyk:
  > https://app.snyk.io/org/maicol07/project/14ec3470-1b32-45eb-bbcd-6750c6ff2cb5?utm_source=github&utm_medium=upgrade-pr

  </details>
- [`3aad2d5`](https://github.com/maicol07/flarum-sso-php-plugin/commit/3aad2d5d3d5db6905446f78246d4a81317befe67) Fix API docs action name
- [`fff7f46`](https://github.com/maicol07/flarum-sso-php-plugin/commit/fff7f46d1c46f4fc2635cf47e1088f7dd0047ae4) Fix API docs action config file path

### Other changes

- [`85938c3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/85938c3bfd24e21ef51152ee7f71fe5e69d0ef03) Don't allow new issues on Github
- [`d9a76dd`](https://github.com/maicol07/flarum-sso-php-plugin/commit/d9a76dd05711597b46d13d12beea06624ca57108) Delete issue template
- [`f3ed428`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f3ed4281601ddc232bb2cbb4beffc49e7765a533) **deps:** Support Laravel 9
- [`fcf2d86`](https://github.com/maicol07/flarum-sso-php-plugin/commit/fcf2d86afad76a72f1e2a92a2112c010650d58c5) 👷 Added changelog generator action
- [`f701ef4`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f701ef4b3d0f0dcf4a9d233e369f716010808569) 👷 Added API docs action

### 🔀 Pull Requests

- [`b79a144`](https://github.com/maicol07/flarum-sso-php-plugin/commit/b79a144400fbad53a55950d842eecb5a260f2394) Merge pull request #23 from maicol07/snyk-upgrade-de94e331fd0de516aa6ee2b157279c87

<a name="3.0.1"></a>
## [3.0.1](https://github.com/maicol07/flarum-sso-php-plugin/compare/3.0...3.0.1)

> Released on May 22, 2021

### 🐛 Bug Fixes

- [`0dd2465`](https://github.com/maicol07/flarum-sso-php-plugin/commit/0dd2465d90f093cb18f889dad55de8da552d6275) 🐛 Groups created even if they already exists in Flarum

### 📝 Docs changes

- [`30734d1`](https://github.com/maicol07/flarum-sso-php-plugin/commit/30734d1efbb81e514d776742c21f761096fc7460) 📝 Updated API Docs for 3.0.1

### 👷 Building scripts changes

- [`0ac8531`](https://github.com/maicol07/flarum-sso-php-plugin/commit/0ac8531615189675827f8d39f0316b42d04cb70b) **changelog:** 👷 Fixed changelog generation config

### Other changes

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/f3c9c505336bd5ccd5081170f2dfdc9fb9b44244"><code>f3c9c50</code></a> 🔥 Removed set_groups_admins as no more used</summary>

  > Implementation of this should be made by the user

  </details>

<a name="3.0"></a>
## [3.0](https://github.com/maicol07/flarum-sso-php-plugin/compare/2.0...3.0)

> Released on April 09, 2021

### ✨ Features

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/edd34eb1356fe28baf77c54be1b69b8cb0e2bcbe"><code>edd34eb</code></a> ✨ Initial attempt to beta16 compatibility</summary>

  > - BREAKING CHANGE: 💥 Replaced the `lifetime` setting with `remember`
  > - BREAKING CHANGE: 💥 Removed the `getLifeTimeSeconds` method
  > - BREAKING CHANGE: 💥 PHP 7.3 required
  > - WARNING! illuminate/support pinned to ^8 (removed support for Laravel 6 & 7)

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/5865c51d8ae57ace218d8c6648afd0612902d4ce"><code>5865c51</code></a> ✨ Changed `lifetime` to `remember`</summary>

  > Lifetime is deprecated in beta16.
  > Remember should be set to true when you want to login the user with a "Remember me" option.

  </details>
- [`613b5b5`](https://github.com/maicol07/flarum-sso-php-plugin/commit/613b5b5317a174b74199c28e94a4515fb992f4fa) ✨ Added Remember me checkbox to example + some visual improvements
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/99c059459d1f264fd4c15d6162a7fbcef697e2d8"><code>99c0594</code></a> 💥 ✨ 🚚 Moved Addons and Cookies features to traits</summary>

  > - Removed class cookie. Now all the necessary cookies are generated on the fly.
  > - Addons initialization in the constructor is moved to the initAddons() method in the Addons trait.
  > - Login: now the logout cookie is deleted (if it exists), the session token or remember token is created
  > - Logout: now the session token and remember token cookies are deleted (if they exist), a new logout cookie (flarum_logout) is created.
  >
  > New methods:
  > - setRememberCookie
  > - deleteRememberCookie
  > - setSessionTokenCookie
  > - deleteSessionTokenCookie
  > - setLogoutCookie
  > - deleteLogoutCookie
  > - generateCookie
  >
  > Renamed methods:
  > - addAddon is now loadAddon
  > - removeAddon is now unloadAddon
  >
  > Removed methods:
  > - setCookie
  >
  > BREAKING CHANGE

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/f152d950cb79ca9af033a232b02c6126f6aae89c"><code>f152d95</code></a> ✨ 💥 New user() method</summary>

  > - Replaces the current user object creation
  > - User property is now private. You can only access to the user via this method
  > - Improved examples

  </details>
- [`c0dc540`](https://github.com/maicol07/flarum-sso-php-plugin/commit/c0dc5403ee64a9e89140def8ba81167b1b0b74c4) ✨ Allow to change the remember property via the `isSessionRemembered` method
- [`d173cb1`](https://github.com/maicol07/flarum-sso-php-plugin/commit/d173cb1c2b6c5e048567f167a65d02e141456d5d) ✨ Addons can now specify what addons are required to be loaded before it

### 🐛 Bug Fixes

- [`6c262d8`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6c262d898f3ccc68ee20a93dbd0c12ebe4182236) 👽 Nickname attribute instead of display name

### 💄 UI & Style

- [`1b6448b`](https://github.com/maicol07/flarum-sso-php-plugin/commit/1b6448bd8f3a79c609e07c05ef8958735386ac4e) 💄 Minor example styling improvement

### ♻️ Code Refactoring

- [`6331b3c`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6331b3c2fc92746c85a6e2bb8a9c6b931eceb8f2) ♻️ General refactor
- [`a72432d`](https://github.com/maicol07/flarum-sso-php-plugin/commit/a72432d75f7b0b5c930fad708fcda143b0613347) ♻️ Refactor doctum.config.php
- [`e3c00de`](https://github.com/maicol07/flarum-sso-php-plugin/commit/e3c00dede0d2ee171e9a1a0d09a5dbcbf5601b40) ♻️ Refactor doctum.config.php
- [`7f5f752`](https://github.com/maicol07/flarum-sso-php-plugin/commit/7f5f752005d6645194a8445b0bdc7cb6e20453a6) ♻️ 🚚 Moved delete and update methods out of the basic trait

### 📝 Docs changes

- [`7b7cbb8`](https://github.com/maicol07/flarum-sso-php-plugin/commit/7b7cbb8d95eb4ec2c37b32ae98842cd8c1ad541f) 📝 PHPDoc fix
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/37ce682eadd9a4e2ee1fc24c3af49499909f8d06"><code>37ce682</code></a> 📝 Updated docs</summary>

  > Now using doctum with a modified version of the Flarum docs theme
  > - 🙈 Updated .gitignore

  </details>
- [`94a2a84`](https://github.com/maicol07/flarum-sso-php-plugin/commit/94a2a84d3e270190c2ad4d3adfe26dd9c26e700b) 📝 Updated docs
- [`2b2dcb3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/2b2dcb38b547443bfb73a72399fe4079a4ebd14b) 📝 Updated docs

### 👷 Building scripts changes

- [`56c12d7`](https://github.com/maicol07/flarum-sso-php-plugin/commit/56c12d729157c02c589ac78baa2ea00b4a3b5434) **changelog:** 👷 Added changelog

### 🔀 Pull Requests

- [`befa080`](https://github.com/maicol07/flarum-sso-php-plugin/commit/befa08099f3818c9c2e57ffec26a55c05ebd40ce) Merge pull request #9 from richstandbrook/patch-1

<a name="2.0"></a>
## [2.0](https://github.com/maicol07/flarum-sso-php-plugin/compare/1.2.2...2.0)

> Released on November 02, 2020

### ✨ Features

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/0027f3e7fa7716454ce454a7115603d50dacc785"><code>0027f3e</code></a> ✨ Hooks&#x2F;Addons system</summary>

  > This way it is possible to split features across modules.
  > The new Traits folders includes Basic features

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/264af5df64a9d0be9f8440d5086032097b55b0d4"><code>264af5d</code></a> ✨ New User class and properties classes</summary>

  > FILES
  > - Added a new User Class. This automatically fetch the user and initializes it with Flarum database info
  > - Added new Attributes and Relationships classes
  > BASIC TRAIT
  > - [BREAKING CHANGE] Bundled to the user class, not to Flarum one
  > - ♻️ General refactor
  > - 🚚 Moved the `getUsersList` function to the Flarum class
  > - 🚚 Moved the `getLifeTimeSeconds` to the Basic Trait
  > BUNDLED ADDONS
  > - [BREAKING CHANGE] Groups: 🔥 Removed `removeGroups()` function. Edit the User manually and then update him
  > - Groups: Groups now will be updated when using the `update()` function

  </details>
- [`b955432`](https://github.com/maicol07/flarum-sso-php-plugin/commit/b955432a06305f0a6875ea7c9bd22fed27afca92) ✨ Added missing default attributes
- [`31089ae`](https://github.com/maicol07/flarum-sso-php-plugin/commit/31089ae848eb9f7d2aa06349a58d3256f7df69e6) Support multiple arguments for hooks actions
- [`19fa6cc`](https://github.com/maicol07/flarum-sso-php-plugin/commit/19fa6cc6def4d5631c0078553f8f783c252907c1) Fetch user data from Flarum

### 🐛 Bug Fixes

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/50bc982f3880d8ae8578a436fb00ce3f5e1b17bc"><code>50bc982</code></a> 🐛 Redirect not working when no scheme was specified</summary>

  > Example before this fix:
  > example.com --> NOT WORKING
  > https://example.com --> WORKING
  >
  > After the fix:
  > example.com --> BECOMES https://example.com --> WORKING
  > https://example.com --> WORKING

  </details>
- [`be32b36`](https://github.com/maicol07/flarum-sso-php-plugin/commit/be32b36747fca430f1cb31ddb8a36f8c1bd17472) 🐛 Attributes and relationships not initialized
- [`ff7c262`](https://github.com/maicol07/flarum-sso-php-plugin/commit/ff7c26263b77a41b112cac33b3994303dc17af7f) ✏️ Typos
- [`daeaf04`](https://github.com/maicol07/flarum-sso-php-plugin/commit/daeaf04317c9a183e98e15be078bf08ec4b14a56) ✏️ Typos
- [`0d9c12e`](https://github.com/maicol07/flarum-sso-php-plugin/commit/0d9c12ea655a894ad35c09dc797bb4faf91b1aa6) Last commit fixes
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/cf2be127b5e5aa74fd2fad1f31cb50154b0690c4"><code>cf2be12</code></a> 🥅 Exception if user does not exists in Flarum</summary>

  > - Also added a new hook action

  </details>
- [`6ca94d3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6ca94d3bce7471f4f633a73b9ee620166f9f11c9) **deps:** 📌 Can't allow installations
- [`6ec4a91`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6ec4a916da70262c5afc88caf33e1a509a5194bc) **deps:** 📌 Can't allow installations
- [`5e99f70`](https://github.com/maicol07/flarum-sso-php-plugin/commit/5e99f70e54f8e23b86b2247b948b3b3ad3b88603) Replace methods
- [`1ce51e4`](https://github.com/maicol07/flarum-sso-php-plugin/commit/1ce51e4ec6e1260d78353a73aa8e96a99a17f955) 🐛 Warnings when username is null
- [`f913e74`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f913e74b5402482c2613dc329f189c5aab5c181f) Load namespaces in composer autoloader
- [`c6e6adb`](https://github.com/maicol07/flarum-sso-php-plugin/commit/c6e6adb56b8f9f46752dc0fbf9d3c6b5af355aa4) Groups don't get added to the user

### ⚡ Performance Improvements

- [`02a22f9`](https://github.com/maicol07/flarum-sso-php-plugin/commit/02a22f931fd6e5e687ccce6056177bdbcd3ceac6) ⚡️ Avoid unnecessary request

### ♻️ Code Refactoring

- [`7766209`](https://github.com/maicol07/flarum-sso-php-plugin/commit/7766209b532f6c80d027ec9271fa8c8c2950cf9d) :recycle: General refactor
- [`f31f07d`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f31f07d0d943b463da96c391480386e0dc4aa5c0) 🚚 Moved `setDomain()` method
- [`b2d029b`](https://github.com/maicol07/flarum-sso-php-plugin/commit/b2d029bc787f6e0d1239ef13786d86c0cdf11ab5) ♻️ Refactored comments

### 📝 Docs changes

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/96e99b34e6d0fc887d73ef84818ad40c90ccae24"><code>96e99b3</code></a> Updated example</summary>

  > - Added some HTML markup and CSS to examples
  > - Updated to new plugin features

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/197ebf0d82fd8555db77e8858f7a3d12ea715ae0"><code>197ebf0</code></a> Updated API Docs</summary>

  > - New design!
  > - Updated to the new features!

  </details>
- [`ff3558f`](https://github.com/maicol07/flarum-sso-php-plugin/commit/ff3558f73444717704e18745dcbf75bf6fac1e91) 📝 Updated docs
- [`0a4a97a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/0a4a97ae684e10509fb3cf78708d4fa051054889) Added env to example
- [`cc04d97`](https://github.com/maicol07/flarum-sso-php-plugin/commit/cc04d979c74d11141b7acb99780a494cc2afa36d) Added packages to every class
- [`6b5e92c`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6b5e92c2c4841a2f845e3cfd4ebc1626a62cf184) Updated API Docs
- [`7ed7e78`](https://github.com/maicol07/flarum-sso-php-plugin/commit/7ed7e78fb79a732d9ba1fbf56d1ff107e7b7506c) 📝 Updated docs and examples
- [`c5ffd73`](https://github.com/maicol07/flarum-sso-php-plugin/commit/c5ffd73ad7e91e870b490f4abeb4da83a804db24) 📝 Updated example to add groups
- [`5a764bc`](https://github.com/maicol07/flarum-sso-php-plugin/commit/5a764bc4a8ee669e188bd895c2863d6df734fbfe) Added missing docs

### Other changes

- [`5b568a8`](https://github.com/maicol07/flarum-sso-php-plugin/commit/5b568a88dcd819ecefeda74622e6b4427ea2f24c) 🚚 Renamed package
- [`6842ee6`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6842ee6bdc29430236c9d266e30302c962492c71) ✨ Added support for Laravel 8
- [`83f0b4a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/83f0b4abc029055dec7aeb8a582fcf3debaa18fd) Updated example
- [`f4d4f8e`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f4d4f8ee39f9c3c4e1f4d5258d3de1af9eda2f8f) Updated example
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/f0d9655dd9255a6a2ece97093a8eee81e4dea9df"><code>f0d9655</code></a> Updated example</summary>

  > - Added more ENV options

  </details>
- [`806582f`](https://github.com/maicol07/flarum-sso-php-plugin/commit/806582fb26df97a037dbdca7008c6ec0d902b40c) 🔥 Removed `setCookie()` function
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/63f72690c6586920458272056d7b29da31b0b1bb"><code>63f7269</code></a> 💥 Changed constructor parameters format</summary>

  > BREAKING CHANGE

  </details>
- [`f1964a1`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f1964a1aa58be72e942d46719dc1351c5ad3c625) 🏷️ Added type property
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/993e70b93308b6f3c5387ef3378dca92268cabd6"><code>993e70b</code></a> Allow null as username</summary>

  > For methods that don't involve user data such as `logout()`

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/8842c706298465f3fbe17f3b9c8ab7bbada4ce29"><code>8842c70</code></a> ♿️ Improvements to hooks</summary>

  > - fix: Hook can't be executed
  > - Added 1 filter

  </details>
- [`94b173f`](https://github.com/maicol07/flarum-sso-php-plugin/commit/94b173fd37a94bbd0405a5a2bfa16be81e8ccc7f) Improved cookie saving
- [`0a895d0`](https://github.com/maicol07/flarum-sso-php-plugin/commit/0a895d0af08e6c4f75c9e8377883ce3f4e872c86) Better error handling
- [`6821785`](https://github.com/maicol07/flarum-sso-php-plugin/commit/682178521fe8b32ecff9e54b694db965ab0e8114) 🚚 Moved function `logout()` to Flarum
- [`3315834`](https://github.com/maicol07/flarum-sso-php-plugin/commit/331583416243bf7245bac809c4022dd101c9bdc3) Return always a Collection
- [`73df168`](https://github.com/maicol07/flarum-sso-php-plugin/commit/73df1680ff266d56f654a01d550435d19817579f) Support for more than one filter in users list
- [`ac9a9be`](https://github.com/maicol07/flarum-sso-php-plugin/commit/ac9a9bef3e3dfbd0e16a747c6d1a2d7d5d691a4f) Changed to bool
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/6aee96a4c7684f791edf4ccb6990bafb6252e80b"><code>6aee96a</code></a> 🔥 Removed cookie removal</summary>

  > - Linked to 1ea3d15456e643f893cda609df2e6195f8352143
  > - Tracker issue: #FSSOE-1

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/b6accc998f51f2f1e689fc3005bc28a5c9f602b0"><code>b6accc9</code></a> Improvements to actions and filters</summary>

  > - Returns -1 if hook/filter does not exist
  > - Added login and register replacer

  </details>
- [`15a409a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/15a409ad3a16c7efa793c63ed9f861879ba0acbb) Updated composer.json
- [`a4481a3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/a4481a3780dac12b77d154e0002f45474782a9ba) Updated composer.json
- [`40b3924`](https://github.com/maicol07/flarum-sso-php-plugin/commit/40b3924383f9d17e769e8234ec37cc3da63fe402) Add username on init
- [`a676033`](https://github.com/maicol07/flarum-sso-php-plugin/commit/a6760336cfade7684054c890ebd92ad9210451b7) 📄 Wrong license
- [`23136fa`](https://github.com/maicol07/flarum-sso-php-plugin/commit/23136fa021b3c51c937e3e918cb69e6afba6e86e) Changed method visibility
- [`f9652ea`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f9652eaaac3c552177c45cee66e932e0d210cf31) 🚚 Moved cookie saving to its own method
- [`68df590`](https://github.com/maicol07/flarum-sso-php-plugin/commit/68df59024cab8469d33f5b95bf6b7e99f6a2cf54) Changed `addAddon` return and `setAddonAttributes`
- [`f01e4bb`](https://github.com/maicol07/flarum-sso-php-plugin/commit/f01e4bb0bf700adf167e52594868117f3ff22237) Improved group search
- [`ad50268`](https://github.com/maicol07/flarum-sso-php-plugin/commit/ad5026869c8e7ccc3db4eb0834372247324a2f9c) Improved ssl verification
- [`3ed03f1`](https://github.com/maicol07/flarum-sso-php-plugin/commit/3ed03f132397e1dd16f123b343f9e07895f7493d) Moved set_groups_admins to Groups addon
- [`8f81cc7`](https://github.com/maicol07/flarum-sso-php-plugin/commit/8f81cc71c8cc1a2acd8fbc6034753121cc87c18b) Moved set_groups_admins to Groups addon
- [`cc0864a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/cc0864a9ccfb04185fab3677631438ee80f8c0bf) Removed unused packages
- [`996b9db`](https://github.com/maicol07/flarum-sso-php-plugin/commit/996b9db534cff0ed548fbb9db6d03165061e6c6c) Fixed links

### 🔀 Pull Requests

- [`1cb4b3f`](https://github.com/maicol07/flarum-sso-php-plugin/commit/1cb4b3f7e06d021b635fcdc96c39eef8fd308488) Merge pull request #5 from maicol07/renovate/configure

### 💥 Breaking changes

- function removed
- return type
- changed option name and behaviour

<a name="1.2.2"></a>
## [1.2.2](https://github.com/maicol07/flarum-sso-php-plugin/compare/1.2.1...1.2.2)

> Released on August 27, 2020

### 🐛 Bug Fixes

- [`16f4e75`](https://github.com/maicol07/flarum-sso-php-plugin/commit/16f4e750d126454cd12f8a5aabc7c038a7dfd787) :pencil2:: Wrong version constraint

<a name="1.2.1"></a>
## [1.2.1](https://github.com/maicol07/flarum-sso-php-plugin/compare/1.2...1.2.1)

> Released on August 27, 2020

### 🐛 Bug Fixes

- [`5c394c9`](https://github.com/maicol07/flarum-sso-php-plugin/commit/5c394c93d991adfa7317803ac83ae2ac3b86ed46) :bug: Missing class error

### Other changes

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/714011b174303cae5befc357db793d9056bb647a"><code>714011b</code></a> <b>deps:</b> :arrow_up: Updated composer dependencies</summary>

  > Changelogs summary:
  >  
  >   - symfony/translation-contracts updated from v2.0.1 to v2.1.3
  >     See changes: https://github.com/symfony/translation-contracts/compare/v2.0.1...v2.1.3
  >     Release notes: https://github.com/symfony/translation-contracts/releases/tag/v2.1.3
  >  
  >   - symfony/polyfill-php80 installed in version v1.18.1
  >     Release notes: https://github.com/symfony/polyfill-php80/releases/tag/v1.18.1
  >  
  >   - symfony/polyfill-mbstring updated from v1.15.0 to v1.18.1
  >     See changes: https://github.com/symfony/polyfill-mbstring/compare/v1.15.0...v1.18.1
  >     Release notes: https://github.com/symfony/polyfill-mbstring/releases/tag/v1.18.1
  >  
  >   - symfony/translation updated from v5.0.7 to v5.1.3
  >     See changes: https://github.com/symfony/translation/compare/v5.0.7...v5.1.3
  >     Release notes: https://github.com/symfony/translation/releases/tag/v5.1.3
  >  
  >   - nesbot/carbon updated from 2.32.2 to 2.39.0
  >     See changes: https://github.com/briannesbitt/Carbon/compare/2.32.2...2.39.0
  >     Release notes: https://github.com/briannesbitt/Carbon/releases/tag/2.39.0
  >  
  >   - doctrine/inflector updated from 1.3.1 to 1.4.3
  >     See changes: https://github.com/doctrine/inflector/compare/1.3.1...1.4.3
  >     Release notes: https://github.com/doctrine/inflector/releases/tag/1.4.3
  >  
  >   - symfony/polyfill-php72 installed in version v1.18.1
  >     Release notes: https://github.com/symfony/polyfill-php72/releases/tag/v1.18.1
  >  
  >   - paragonie/random_compat installed in version v9.99.99
  >     Release notes: https://github.com/paragonie/random_compat/releases/tag/v9.99.99
  >  
  >   - symfony/polyfill-php70 installed in version v1.18.1
  >     Release notes: https://github.com/symfony/polyfill-php70/releases/tag/v1.18.1
  >  
  >   - symfony/polyfill-intl-normalizer installed in version v1.18.1
  >     Release notes: https://github.com/symfony/polyfill-intl-normalizer/releases/tag/v1.18.1
  >  
  >   - symfony/polyfill-intl-idn installed in version v1.18.1
  >     Release notes: https://github.com/symfony/polyfill-intl-idn/releases/tag/v1.18.1
  >  
  >   - guzzlehttp/guzzle updated from 6.5.2 to 6.5.5
  >     See changes: https://github.com/guzzle/guzzle/compare/6.5.2...6.5.5
  >     Release notes: https://github.com/guzzle/guzzle/releases/tag/6.5.5
  >  
  >   - flagrow/flarum-api-client updated from dev-master@c6faca2 to dev-master@08c300c
  >     See changes: https://github.com/flagrow/flarum-api-client/compare/maicol07:c6faca2...flagrow:08c300c
  >  
  >   - roave/security-advisories installed in version dev-master@89bed67

  </details>
- [`9df0685`](https://github.com/maicol07/flarum-sso-php-plugin/commit/9df0685f54bf5903ebfd1286cd67489ddddcb9c3) **deps:** Changed api client namespace

### 🔀 Pull Requests

- [`316760f`](https://github.com/maicol07/flarum-sso-php-plugin/commit/316760fb8e7c530ff1f6a434809c6e02812fe717) Merge pull request #4 from Scumi/master

<a name="1.2"></a>
## [1.2](https://github.com/maicol07/flarum-sso-php-plugin/compare/1.1.1...1.2)

> Released on April 22, 2020

### ✨ Features

- [`abe07d7`](https://github.com/maicol07/flarum-sso-php-plugin/commit/abe07d77820e23cf76d02f8c164b86dcd58af885) Disable setting groups to admins

### 🐛 Bug Fixes

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/c57421af59dd1dd04df5d728ae9358e8d0b602d1"><code>c57421a</code></a> User can&#x27;t login if his id &gt; 20</summary>

  > * Better getUserList method. Now is public
  > * Changed full parameter to filter (see API doc)

  </details>
- [`e44e552`](https://github.com/maicol07/flarum-sso-php-plugin/commit/e44e55208efd267bf349400b9cf886765fb9c634) Added missing class of previous commit
- [`9977f16`](https://github.com/maicol07/flarum-sso-php-plugin/commit/9977f16d9426644ad68f4745d2a511699804f743) User can't login if it's not an admin
- [`6a1a7ff`](https://github.com/maicol07/flarum-sso-php-plugin/commit/6a1a7ffb8db039e58545c4cbd9ead4a3fb98d2b4) Removing PRO key don't deactivate PRO features
- [`bd4ed25`](https://github.com/maicol07/flarum-sso-php-plugin/commit/bd4ed25d7a27cffb73c41fc9cec3d7d718a75e42) Set_groups_admins and update
- [`abcf173`](https://github.com/maicol07/flarum-sso-php-plugin/commit/abcf173f29aa931cf3710702a50ec13af20fe778) Groups were not deleted from user

### ⚡ Performance Improvements

- [`213eb2c`](https://github.com/maicol07/flarum-sso-php-plugin/commit/213eb2c041c4caaa479d23a6507974509e76fd5c) Optimized login times

### 💄 UI & Style

- [`ca1524a`](https://github.com/maicol07/flarum-sso-php-plugin/commit/ca1524a2b91934d720e23abcf1ac888cc04702a1) Rearranged code

<a name="1.1.1"></a>
## [1.1.1](https://github.com/maicol07/flarum-sso-php-plugin/compare/1.1...1.1.1)

> Released on April 20, 2020

### 🔀 Pull Requests

- [`a74be40`](https://github.com/maicol07/flarum-sso-php-plugin/commit/a74be40e8c8d43cf67648976a2745209410823ef) Merge pull request #1 from maicol07/imgbot

<a name="1.1"></a>
## [1.1](https://github.com/maicol07/flarum-sso-php-plugin/compare/1.0...1.1)

> Released on April 20, 2020

### ✨ Features

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/afdb5d1888895f113f72645e5e848c3bab0247fd"><code>afdb5d1</code></a> Groups setting on signup, update user</summary>

  > Includes a general code style refactor and some fixes for the setGroup features

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/f33e9c8c006892982b2155ed2db3a38da6ca53c7"><code>f33e9c8</code></a> Password reset</summary>

  > Includes general code style reformat and some  fixes for the pro login feature

  </details>

### 🐛 Bug Fixes

- [`8e55936`](https://github.com/maicol07/flarum-sso-php-plugin/commit/8e55936bce798185401d14c9f70d06955ee752a9) Fixed not_authenticated error
- [`01635c3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/01635c3ec321cffd1c5453651851b53fcbbfa4b3) #FSSOE-1

### Other changes

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/2167d47947628d0af6560887e263c5ae569275d6"><code>2167d47</code></a> Slug rename</summary>

  > Plugin slug has been renamed to sso-flarum.
  > Naming conventions from now on:
  > - Files: prefix-flarum-sso-suffix.ext
  > - Options names, ids or function names: prefix_flarum_sso_plugin_suffix
  > - Slugs, text domain and other slug-related strings: sso-flarum with eventually a prefix, suffix or extension

  </details>
- [`bfecf7b`](https://github.com/maicol07/flarum-sso-php-plugin/commit/bfecf7be1fb6ba16105bbfcbc926f2c48de81296) Fixed critical rename error
- [`06353e3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/06353e3165e867867abfdce447ce711275a11f28) Silenced error on login form

<a name="1.0"></a>
## 1.0

> Released on April 08, 2020

### ✨ Features

- [`30c2c61`](https://github.com/maicol07/flarum-sso-php-plugin/commit/30c2c619df9ab92628b3f4eab8cc8a72038b0c91) Addded insecure mode and groups setting

### Other changes

- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/08b25617e411f689f1c03bb8a60887eddac14b67"><code>08b2561</code></a> General refactor</summary>

  > - !!! PLUGIN NOW REQUIRES PHP 7+
  > - Plugin can now be installed with composer!
  > - Organized files in folders
  > - !!! Removed config.php. Configuration can now be set with class parameters
  > - New Cookie management
  > - Removed removeCookie method
  > - Improved README.md

  </details>
- [`4e67550`](https://github.com/maicol07/flarum-sso-php-plugin/commit/4e6755080dd9806cea90f63a2d5014c25dcf8fb8) Added namespace to Flarum class
- [`47eb6d3`](https://github.com/maicol07/flarum-sso-php-plugin/commit/47eb6d3ad1677371ef0bf71c1295d1f443bc9c9e) Better installation details
- [`54a0231`](https://github.com/maicol07/flarum-sso-php-plugin/commit/54a023106dab22fcece619f2b1a1c63d8589018d) New WordPress plugin
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/053b49ba2f958c1f8326611d79eef40eaff380ec"><code>053b49b</code></a> Release 1.0</summary>

  > - BREAKING CHANGE! PHP 7+ required
  > - BREAKING CHANGE! New request system: now using the great Flagrow API client
  > - New Cookie management: now using the awesome Cookie library by Delight-im
  > - New option: insecure mode (principally for local development, read in docs for more)
  > - Added groups settings for users: you can now set a group for a user and, if doesn't exists, it will be created!
  > - BREAKING CHANGE! Deleted sendRequest and get methods as no more used.
  > - Code and performance improvements
  > - Various fixes (see also the bug tracker)

  </details>
- <details><summary><a href="https://github.com/maicol07/flarum-sso-php-plugin/commit/2955fd991f1b8f142bdda0d0b75098ef208f0a5e"><code>2955fd9</code></a> Release 1.0</summary>

  > - Completely new WordPress plugin!
  > - Settings page
  > - PRO features (read more on docs)
  > - In the nearby future will be published in the WordPress Plugins Directory!

  </details>

### 💥 Breaking changes

- See description

