# FreeWorldDict

An open source multilingual dictionary designed for worldlangs, written in PHP.

Originally designed for the Globasa wordland, this dictionary app is made to
cache a word list from Google Sheets as YAML files and serve definition pages
for each word. Currently, it also shows word lists, but this seems unnecessary.

It's design to have a primary language. The data is based around that language's word list. It is assumed that every word would appear in the word list only once. While it may have multiple definitions, those definitions are similar enough to each other to have a shodrt, concise definition.

The interface and the world list are designed to have multiple language translations to be useful to anyone wanting to use it as a translation dictionary. FreeWorldDict is designed for a constructed language (conlang) designed to operate as an international auxiliary language (auxlang / worldlang). However, it have very limited translations for the interface so far.

## Installation

You should be able to simply copy the root files anywhere on a file server. It requires PHP (probably 5+ but I haven't checked) and YAML support. The .htaccess handles routing for fancy URIs.

## Features
* Main index shows word list. [Example](http://demo.partialsolution.ca/globasa-dictionary/eng/)
  * Reverse word-lists for each language. [Example](http://demo.partialsolution.ca/globasa-dictionary/eng/eng-words)
  * Search function words &mdash; but only on word lists
* Each primary language word has it's own definition page. [Example](http://demo.partialsolution.ca/globasa-dictionary/eng/yukway)
  * Related words are shown under 'also see'. [Example](http://demo.partialsolution.ca/globasa-dictionary/eng/nini)
  * Reverse definition pages for each language also supported. [Example](http://demo.partialsolution.ca/globasa-dictionary/eng/eng-word/certain)
* Multilingual interface works, but is very basic. It's not using a sophisticated system, but there isn't much text to translate.
  * Both the language of the interface and the language of the definitions from the database will fall back to the default language from the current language, and then to an auxiliary language. Since the original word lists were written in English and I thought it best to show those than nothing, with an accompanying warning.

It's currently set to auto-update the CSV if you setup a cron job for it.

### Possible Future Features

* Tags for groups of words like regions (countries, cities, stuff on a geography text), ethnicities, languages or anything else you want: words related to family, sports, etc.
* Maybe AJAX for getting and showing a definition?
* Process the list at import rather than every request? Spit out multiple file format for easy access by PHP (YAML) and the JavaScript front end (JSON) with no processing of markdown or entry concatenation.

## How Requests are Processed

The root `index.php` does one thing: calls `src/request.php` which determines what to do and loads the appropriate word or words. The Word object writes to `$app->page->content` and related variables. These are all echoed when the template file is opened from the `templates/` folder.

## Demo

To see this app in action, check out http://demo.partialsolution.ca/globasa-dictionary/ on my demo subdomain.