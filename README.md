# MicroTranslator

_Current Version: **0.0.1**_

[![Build Status](https://travis-ci.org/marcotroisi/microtranslator.svg?branch=master)](https://travis-ci.org/marcotroisi/microtranslator)

A PHP Microservice for managing Translations in your application. You can set it up anywhere in your stack 
and use it to *upload* and *download* translations.

***

# Introduction

MicroTranslator is written in PHP, and currently uses MongoDB as its storage engine. For more details, feel free to head over
the [article on Marco Troisi's blog](http://www.marcotroisi.com/an-example-of-a-microservice/). The source code is being released 
under the **MIT Licence**, which means you are free to reuse, modify and even sell your work based on it. If you do any of the above 
listed actions, please consider [following its creator on Twitter](http://www.twitter.com/marcotroisi) as a way to say **thanks**!

# Usage

## Show all available locales

To see all locales available (e.g. en_GB, de_DE, af_ZA, etc.), just fire up the following request:

    GET /locale
    
and you will get a nice JSON response that looks like this:

```json
{"items":
    [{
        "_id":{"$id":"552384e6e02f4fe237c925d0"},
        "locale":"de_DE"
    }, 
    {
        "_id":{"$id":"552384e6e02f4fe237c925d1"},
        "locale":"en_GB"
    }],
    "count":2
}
```

As you can see, the response will normally have an `items` section, with the actual result, and a `count` value, which will always
represent the integer number of results.

## Show all terms for a given locale

In order to see all the terms (available, translated words) for a given locale (e.g. de_DE), just do:

    GET /translation?locale=de_DE
    
The result will be something like this:

```json
{"items":
    [{
        "Good morning":"Guten Tag"
    },
    {
        "Hello":"Hallo"
    }],
    "total":2
}
```

At the moment, *en_GB* is the default locale, in case you don't specify your `locale` parameter.

## Show a single term for a given locale

In order to see only one term (e.g. "Good morning") for a given locale (e.g. it_IT), you can call:

    GET /translation/Good+morning?locale=it_IT
    
The result will be:

```json
{"items":
    [{
        "Good morning":"Buongiorno"
    }],
    "total":1
}
```

## Insert/Update a term for a given locale

To insert a new term, or update an existing one, use the following:

    POST /translation/Good+morning?locale=es_ES
    
with POST parameter `translation` (e.g. `{ translation: Buenas Dias"}`) 
    
The result will be a `true` or `false` value, based on the success of the operation.

# Future

As you may have noticed, there is still work necessary in order for MicroTranslator to get where it should. In the future, that's 
what it will feature:

- Authentication
- Docker integration
- A frontend UI for adding/updating terms (on a separate repository)
- Some other interesting things!

# Questions?

Please send me an email at hello@marcotroisi.com in order to ask your questions about MicroTranslator.

# Ideas? Found a bug?

Feel free to open a Github issue or even to fork and create a Pull Request.
