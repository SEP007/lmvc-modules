[![Build Status](https://travis-ci.org/sep007/lmvc-modules.png)](https://travis-ci.org/[sep007]/[lmvc-modules])
[![Coverage Status](https://coveralls.io/repos/SEP007/lmvc-modules/badge.png)](https://coveralls.io/r/SEP007/lmvc-modules)
[![Dependency Status](https://www.versioneye.com/user/projects/52602e95632bac7cb6000036/badge.png)](https://www.versioneye.com/user/projects/52602e95632bac7cb6000036)

# lmvc-modules

LMVC-Modules are easy-to-use extensions to the 'scandio/lmvc'-framework

## Form module

Easily create validator classes extending the *AbstractForm* base class while defining validator-functions and error-messages.

[Readme](lib/Scandio/lmvc/modules/form)

## Mustache module

Compiles mustache templates and provides a simple integration into LMVC's views.

[Readme](lib/Scandio/lmvc/modules/mustache)

## Security module

Protects resources provided by controllers using custom security principals (e.g. Ldap or Json) as gateways.

[Readme](lib/Scandio/lmvc/modules/security)

## Snippets module

Allows easy snippets integration in views for e.g. rendering of prepared Html-components such as tables, checkboxes, etc. Moreover, directories can be registered to load more custom snippets from various sources.

[Readme](lib/Scandio/lmvc/modules/snippets)

## Asset pipeline module

Facilitates asset requesting, concatenation and minification of Javascript, CSS, Sass and Less sources. In addition, easily integrates into lmvc and its views.

[Readme](lib/Scandio/lmvc/modules/assetpipeline)

## Registration module

Allows for user registration in the application. Currently uses a database but could easily be extended to persist registrations in LDAP or maybe even config.json.

[Readme](lib/Scandio/lmvc/modules/registration)

## Html-tag module

Module simplifying Html-tag generation in views. Abstracts string handling and templating while being a more tailored snippet component.

[Readme](lib/Scandio/lmvc/modules/htmltag)

## Upload module

Module handling uploads of various types. Currently only supports image uploads but will hopefully contain a bigger set of types in the near future.

[Readme](lib/Scandio/lmvc/modules/upload)

## Session module

Module abtracting from php's session handling. It allows getting, setting, merging and replacing its values without actually touching the $_SESSION variable.

[Readme](lib/Scandio/lmvc/modules/session)