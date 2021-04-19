# Worldlang Dict

An open source multilingual dictionary designed for worldlangs, written in PHP.

Originally designed for the Globasa wordlang, this dictionary app is made to
cache a word list CSV from Google Sheets in YAML and serve definition pages
for each word. Currently, it also shows word lists, but this seems unnecessary.

It's design to have a primary language. The data is based around that language's
word list. It is assumed that every word would appear in the word list only
once. While it may have multiple definitions, those definitions are similar
enough to each other to have a short, concise definition.

The interface and the world list are designed to have multiple language
translations to be useful to anyone wanting to use it as a translation
dictionary. WorldlangDict is designed for a constructed language (conlang)
designed to operate as an international auxiliary language (auxlang /
worldlang). However, it have very limited translations for the interface so far.

## Installation

You should be able to simply copy the root files anywhere on a file server. It
requires PHP (probably 5+ but I haven't checked) and YAML support. The .htaccess
handles routing for fancy URIs. both `/index.php` and `/update.php` should
__not__ be writable by group.

It's currently set to auto-update the CSV if you setup a cron job for it.

## Demo

To see this app in action, check out http://menalar.globasa.net/eng/
