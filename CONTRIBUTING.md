# Contributing

- [New Attributes](#new-attributes)
- [Updating Existing Attributes](#updating-existing-attributes-or-examples)
- [General](#general)
  - [versioning](#versioning)
  - [examples](#examples)
  - [pre commit](#pre-commit)
  - [updating static analysis plugins](#updating-static-analysis-plugins)

## New Attributes

Prior to creating a new Attribute please raise an issue in github outlining desired functionality. 
Any proposed functionality MUST be able to be analysed by static analysis.

### Check list for creating new attributes

- Create Attribute definition. Add in [src](src) directory.
- Update README
  - Add description to the [New language features](README.md#new-language-features) section of `README.md`
  - Update [contents](README.md#contents) section of `README.md`
- Add examples
  - Create new directory in [examples](examples) directory.
  - Add examples of usages that show both correct usage and where static analysis should find errors. See [examples](#examples)
- Run pre commit checks. See [pre commit actions](#pre-commit)
- If you have the relevant knowledge add new rules for the static analysis tools. See [updating static analysis plugins](#updating-static-analysis-plugins)


## Updating existing attributes (or examples)

Updates to attributes (e.g. bug fixes, or extending functionality) are welcome. 

### Checklist 

- If required update description in the [New language features](README.md#new-language-features) section of `README.md`
- Update/add examples. See [examples](#examples)
- Run pre commit checks. See [pre commit actions](#pre-commit)
- If you have the relevant knowledge add new rules for the static analysis tools. See [updating static analysis plugins](#updating-static-analysis-plugins)


## General

### Versioning

This project follows semver. 

### Examples

The examples act as test cases for the Attributes. The examples MUST cover examples of both examples of issues that should be found by static analysis and where there are no issues.

The examples MUST be placed in the correct directory: `examples/<attribute name>`. 
E.g. the `#[friend]` attribute examples MUST be in the `examples/friend` directory.

Each example file MUST be prefixed with the attribute name. E.g. `friendOnClass.php`.
Each example MUST have a unique namespace. This is the name of the file, optionally with a number suffix.
E.g. the file `friendOnClass` can have namespaces `FriendOnClass`, `FriendOnClass1`, `FriendOnClass2`, etc.

If code in the example is showing an error that should be found by static analysis the line must end with `// ERROR <reason>`.
See 5th line in code snippet below:

```php
class Updater
{
    public function updater(Person $person): void
    {
        $person->updateName(); // ERROR: Updater is not a Friend of Person
    }
}

```

To explicitly state where code is correct, add the following to the end of the line: `// OK <reason>`
See 10th line in code snippet below:

```php
class Person
{
    #[Friend(FriendUpdater::class)]
    public function updateName(): void
    {
    }

    public function update(): void
    {
        $this->updateName(); // OK: Method calls on same class is always allowed
    }
}
```


### Pre commit 

Prior to committing code please run the following:

```shell
composer cs-fix   # This fixes any coding style issues
composer ci       # This runs all the validation that is run by github actions. 
```

### Updating static analysis plugins

If your contribution has created or updated an Attribute or a file in [examples](examples) then the static analysis extensions/plugins will also need updating.
The current known implementations are:
- [PHPStan](https://github.com/DaveLiddament/phpstan-php-language-extension)
- [Psalm](https://github.com/DaveLiddament/psalm-php-language-extension)

If you have the relevant knowledge please make the updates to the appropriate repo. If you don't then please create an issue on the static analysis plugin's repo with details of that needs updating.

Any updates to files in the [examples](examples) directory in this repository will need copying to the relevant static analysis's implementation repository in its `tests\data` directory. 
