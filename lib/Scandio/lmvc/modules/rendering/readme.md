# Rendering module (lmvc-modules)

This module's intention is to abstract from rendering with various templating languages in an `lmvc` application.
Depending on the application's configuration in its `config.json` it provides a homogenous API from lmvc's controllers.

In summary it allows even require various render modules in the `config.json` with a default which will be used
on any controller's `render($args)` call. Other render modules are accessable through their defined shorthand.

## Example `config.json`

```json
"rendering": {
   "default": {
      "namespace": "\\Scandio\\lmvc\\modules\\rendering\\handlers\\PlainHandler",
      "extension": "html"
   },
   "additionals": {
      "smarty" : {
          "namespace": "\\Scandio\\lmvc\\modules\\rendering\\handlers\\SmartyHandler",
          "extension": "smarty"
      },
      "json": {
          "namespace": "\\Scandio\\lmvc\\modules\\rendering\\handlers\\JsonHandler",
          "extension": null
      },
      "html": {
          "namespace": "\\Scandio\\lmvc\\modules\\rendering\\handlers\\HtmlHandler",
          "extension": null
      }
   }
}
```

## Using defined handlers

The `config.json` outlines a `default` handler and two `additionals` for *Json* and *Smarty* rendering. The default
renderer is made available by calling `static::render($args)` from a controller. Anyway, a call to `static::renderSmarty($args)`
will route the rendering to the Smarty handler (see the handle). The framework will automatically search the
correct view depending on controller name and action. Lastly, as rending json does not require an extension, the
module will only return a json-encoded version of the passed in `$args`.