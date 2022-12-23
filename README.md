# PHP Language Extensions (currently in BETA)

[![PHP versions: 8.0 to 8.2](https://img.shields.io/badge/php-8.0|8.1|8.2-blue.svg)](https://packagist.org/packages/dave-liddament/php-language-extensions)
[![Latest Stable Version](https://poser.pugx.org/dave-liddament/php-language-extensions/v/stable)](https://packagist.org/packages/dave-liddament/php-language-extensions)
[![License](https://poser.pugx.org/dave-liddament/php-language-extensions/license)](https://github.com/DaveLiddament/php-language-extensions/blob/main/LICENSE.md)
[![Total Downloads](https://poser.pugx.org/dave-liddament/php-language-extensions/downloads)](https://packagist.org/packages/dave-liddament/php-language-extensions/stats)

[![Continuous Integration](https://github.com/DaveLiddament/php-language-extensions/workflows/Full%20checks/badge.svg)](https://github.com/DaveLiddament/php-language-extensions/actions)
[![Psalm level 1](https://img.shields.io/badge/Psalm-max%20level-brightgreen.svg)](https://github.com/DaveLiddament/php-language-extensions/blob/main/psalm.xml)
[![PHPStan level 8](https://img.shields.io/badge/PHPStan-max%20level-brightgreen.svg)](https://github.com/DaveLiddament/php-language-extensions/blob/main/phpstan.neon)



This library provides attributes for extending the PHP language (e.g. adding `package` visibility).
The intention, at least initially, is that these extra language features are enforced by static analysis tools (such as Psalm, PHPStan and, ideally, PhpStorm) and NOT at runtime.

**Language feature added:**
- [Friend](#friend)
- [InjectableVersion](#injectableVersion)
- [Package](#package) 
- [Sealed](#sealed)
- [TestTag](#testtag)


### Contents

- [Installation](#installation)
  - [PHPStan](#phpstan)
  - [Psalm](#psalm)
- [New Language Features](#new-language-features)
  - [Friend](#friend)
  - [InjectableVersion](#injectableVersion)
  - [Package](#package)
  - [Sealed](#sealed)
  - [TestTag](#testtag)
- [Further examples](#further-examples)
- [Contributing](#contributing)



## Installation

To make the attributes available for your codebase use:

```shell
composer require dave-liddament/php-language-extensions
```

NOTE: This only installs the attributes. A static analysis tool is used to enforce these language extensions. 
Use one of these:

### PHPStan

To use PHPStan to enforce package level visibility add [this extension](https://github.com/DaveLiddament/phpstan-php-language-extensions). 

```shell
composer require --dev dave-liddament/phpstan-php-language-extensions
```

### Psalm

Coming soon.




## New language features

## Package

The `#[Package]` attribute acts like an extra visibility modifier like `public`, `protected` and `private`. It is inspired by Java's `package` visibility modifier.
The `#[Package]` attribute limits the visibility of a class or method to only being accessible from code in the same namespace. 

Example applying `#[Package]` to methods:

```php
namespace Foo {

  class Person 
  {
    #[Package]
    public function __construct(
      private string $name;
    ) {
    }
    
    #[Package]
    public function updateName(string $name): void
    {
        $this->name = $name;
    }
    
    public function getName(): string
    {
       return $this->name;
    }
  }

  class PersonFactory
  {
    public static function create(string $name): Person
    {
      return new Person($name); // This is allowed
    }
  }
}

namespace Bar {

  class Demo 
  {
    public function allowed(): void 
    {
      // Code below is OK. Only calling public methods
      $jane = PersonBuilder::create("Jane");
      echo $jane->getName();
    }
  
    public function notAllowed1(Person $person): void
    {
      // ERROR with line below: `update` method has package visibility. It can only be called from the '`Foo` namespace.
      $person->updateName("Robert")
    }
  
    public function notAllowed2(): void
    {
      // ERROR with line below. Person's __construct method has package visibility. It can only be called by code in the `Foo` namespace.
      $jane = new Person(); 
    }
  }
}
```

Example applying `#[Package]` to classes:

```php
namespace Foo {

  #[Package]
  class Mailer 
  {
    public function sendMessage(string $message): void
    {
      // Some implementation
    } 
  }
}

namespace Bar {

  class PdfSender
  {
    public function __invoke(Mailer $mailer): void
    {
      // ERROR: The method Mailer::sendMessage is on a package level class. 
      $mailer->sendMessage("some message");
    }
  }

}
```

**NOTES:**

- If adding the `#[Package]` to a method, this method MUST have public visibility. 
- If a class is marked with `#[Package]` then all its public methods are treated as having package visibility. 
- This is currently limited to method calls (including `__construct`).  
- Namespaces must match exactly. E.g. a package level method in `Foo\Bar` is only accessible from `Foo\Bar`. It is not accessible from `Foo` or `Foo\Bar\Baz`


## Friend

A method or class can supply via a `#[Friend]` attribute a list of classes, they are friends with. Only their friend's classes may call the method.
Friendship is not reciprocated, e.g. if Dog makes Cat a friend, this does not mean that Cat considers Dog a friend. 
This is loosely based on C++ friend feature. 

Example:

```php

class Person
{
    #[Friend(PersonBuilder::class)]
    public function __construct()
    {
        // Some implementation
    }
}


class PersonBuilder
{
    public function build(): Person
    {
        $person = new Person(): // OK PersonBuilder is a friend of Person
        // set up Person
        return $person;
    }
}


// ERROR Call to Person::__construct is not from PersonBuilder
$person = new Person();

```

**NOTES:**
- Multiple friends can be specified. E.g. `#[Friend(Foo::class, Bar::class)]`
- A class can have a `#[Friend]` attribute. Friendship is additive. E.g.
  ```php 
  #[Friend(Foo::class)]
  class Entity
  {
    #[Friend(Bar::class)] 
    public function ping(): void // ping is friends with Foo and Bar
    {
    }
  }
  ```
- This is currently limited to method calls (including `__construct`).

## Sealed 

**This attribute is a work in progress**

This replicates the rejected [sealed classes RFC](https://wiki.php.net/rfc/sealed_classes)

The `#[Sealed]` attribute takes a list of classes or interfaces that can extend/implement the class/interface.

E.g. 

```php

#[Sealed(Success::class, Failure::class)]
abstract class Result {} // Result can only be extended by Success or Failure

// OK
class Success extends Result {}

// OK
class Failure extends Result {}

// ERROR AnotherClass is not allowed to extend Result
class AnotherClass extends Result {}
```

## TestTag

The `#[TestTag]` attribute is an idea borrowed from hardware testing. Methods marked with this attribute are only available to test code.

E.g.

```php
class Person {

    #[TestTag]
    public function setId(int $id) 
    {
      $this->id = $id;
    }
}


function updatePersonId(Person $person): void 
{
    $person->setId(10);  // ERROR - not test code.
}


class PersonTest 
{
    public function setup(): void
    {
        $person = new Person();
        $person->setId(10); // OK - This is test code.
    }
}
```

NOTES:
- Methods with the`#[TestTag]` MUST have public visibility.
- For determining what is "test code" see the relevant plugin. E.g. the [PHPStan extension](https://github.com/DaveLiddament/phpstan-php-language-extensions) can be setup to either:
  - Assume all classes that end `Test` is test code. See [className config option](https://github.com/DaveLiddament/phpstan-php-language-extensions#exclude-checks-on-class-names-ending-with-test).
  - Assume all classes within a namespace is test code. See [namespace config option](https://github.com/DaveLiddament/phpstan-php-language-extensions#exclude-checks-based-on-test-namespace).



## InjectableVersion

The `#[InjectableVersion]` is used in conjunction with dependency injection.
`#[InjectableVersion]` is applied to a class or interface. 
It denotes that it is this version and not any classes that implement/extend that should be used in the codebase.

E.g.

```php

#[InjectableVersion]
class PersonRepository {...} // This is the version that should be type hinted in constructors.

class DoctrinePersonRepository extends PersonRepository {...}

class PersonCreator {
    public function __construct(
        private PersonRepository $personRepository, // OK - using the injectable version
    )
}
class PersonUpdater {
    public function __construct(
        private DoctrinePersonRepository $personRepository, // ERROR - not using the InjectableVersion
    )
}
```

This also works for collections:

```php

#[InjectableVersion]
interface Validator {...} // This is the version that should be type hinted in constructors.

class NameValidator implements Validator {...}
class AddressValidator implements Validator {...}

class PersonValidator {
    /** @param Validator[] $validators */
    public function __construct(
        private array $validators, // OK - using the injectable version
    )
}
```

By default, only constructor arguments are checked. Most DI should be done via constructor injection. 

In cases where dependencies are injected by methods that aren't constructors, the method must be marked with a `#[CheckInjectableVersion]`:

```php

#[InjectableVersion]
interface Logger {...}

class FileLogger implements Logger {...}

class MyService 
{
    #[CheckInjectableVersion]
    public function setLogger(Logger $logger): void {} // OK - Injectable Version injected
    
    public function addLogger(FileLogger $logger): void {} // No issue raised because addLogger doesn't have the #[CheckInjectableVersion] attribute.
}

```



## Further examples

More detailed examples of how to use attributes is found in [examples](examples/).


## Contributing

See [Contributing](CONTRIBUTING.md).


## TODO

- [] Add examples for Sealed
