# PHP Language Extensions (currently in BETA)

[![PHP versions: 8.0 to 8.2](https://img.shields.io/badge/php-8.0|8.1|8.2-blue.svg)](https://packagist.org/packages/dave-liddament/php-language-extensions)
[![Latest Stable Version](https://poser.pugx.org/dave-liddament/php-language-extensions/v/stable)](https://packagist.org/packages/dave-liddament/php-language-extensions)
[![License](https://poser.pugx.org/dave-liddament/php-language-extensions/license)](https://github.com/DaveLiddament/php-language-extensions/blob/main/LICENSE.md)
[![Total Downloads](https://poser.pugx.org/dave-liddament/php-language-extensions/downloads)](https://packagist.org/packages/dave-liddament/php-language-extensions/stats)

[![Continuous Integration](https://github.com/DaveLiddament/php-language-extensions/workflows/Full%20checks/badge.svg)](https://github.com/DaveLiddament/php-language-extensions/actions)
[![Psalm level 1](https://img.shields.io/badge/Psalm-max%20level-brightgreen.svg)](https://github.com/DaveLiddament/php-language-extensions/blob/main/psalm.xml)
[![PHPStan level 8](https://img.shields.io/badge/PHPStan-max%20level-brightgreen.svg)](https://github.com/DaveLiddament/php-language-extensions/blob/main/phpstan.neon)


This library provides [attributes](https://www.php.net/manual/en/language.attributes.overview.php) that are used by static analysers to enforce new language features. 
The intention, at least initially, is that these extra language features are enforced by static analysis tools (such as Psalm, PHPStan and, ideally, PhpStorm) and NOT at runtime.

**Language feature added:**
- [Friend](#friend)
- [NamespaceVisibility](#namespaceVisibility)
- [InjectableVersion](#injectableVersion)
- [Sealed](#sealed)
- [TestTag](#testtag)


### Contents

- [Installation](#installation)
  - [PHPStan](#phpstan)
  - [Psalm](#psalm)
- [New Language Features](#new-language-features)
  - [Friend](#friend)
  - [NamespaceVisibility](#namespaceVisibility)
  - [InjectableVersion](#injectableVersion)
  - [Sealed](#sealed)
  - [TestTag](#testtag)
  - Deprecated
    - [Package](#package) replace with [NamespaceVisibility](#namespaceVisibility)
    
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

If you're using PHPStan then use [this extension](https://github.com/DaveLiddament/phpstan-php-language-extensions) to enforce the rules.

```shell
composer require --dev dave-liddament/phpstan-php-language-extensions
```

### Psalm

Coming soon.




## New language features

## Friend

A method or class can supply via a `#[Friend]` attribute a list of classes. Only these classes can call the method.
This is loosely based on the C++ friend feature.

In the example below the `Person::__construct` method can only be called from `PersonBuilder`:

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
        $person = new Person(): // OK as PersonBuilder is allowed to call Person's construct method.
        // set up Person
        return $person;
    }
}


// ERROR Call to Person::__construct is not from PersonBuilder
$person = new Person();
```

**NOTES:**
- Multiple classes can be specified. E.g. `#[Friend(Foo::class, Bar::class)]`
- A class can have a `#[Friend]` attribute, classes listed here are applied to every method.
  ```php 
  #[Friend(Foo::class)]
  class Entity
  {
    public function ping(): void // ping has friend Bar
    {
    }
  }
  ```
- The `#[Friend]` attribute is additive. If a class and a method have the `#[Friend]` the method can be called from any of the classes listed. E.g. 
  ```php 
  #[Friend(Foo::class)]
  class Entity
  {
    #[Friend(Bar::class)] 
    public function pong(): void // pong has friends Foo and Bar
    {
    }
  }
  ```  
- This is currently limited to method calls (including `__construct`).



## NamespaceVisibility

The `#[NamespaceVisibility]` attribute acts as extra visibility modifier like `public`, `protected` and `private`. 
By default, the `#[NamespaceVisibility]` attribute limits the visibility of a class or method to only being accessible from in the same namespace, or sub namespace. 

Example applying `#[NamespaceVisibility]` to the `Telephone::ring` method:

```php
namespace Foo {

  class Telephone 
  {
    #[NamespaceVisibility]
    public function ring(): void
    {
    }
  }

  class Ringer
  {
    public function ring(Telephone $telephone): Person
    {
      $telephone->ring(); // OK calling Telephone::ring() from same namespace
    }
  }
}

namespace Foo\SubNamespace {

  use Foo\Telephone;
  
  class SubNamespaceRinger
  {
    public function ring(Telephone $telephone): Person
    {
      $telephone->ring(); // OK calling Telephone::ring() from sub namespace
    }
  }
}


namespace Bar {

  use Foo\Telephone;
  
  class DifferentNamespaceRinger
  {
    public function ring(Telephone $telephone): Person
    {
      $telephone->ring(); // ERROR calling Telephone::ring() from different namespace
    }
  }
}
```

The `#[NamespaceVisibility]` attribute has 2 optional arguments:

#### excludeSubNamespaces option

This is a boolean value. Its default value is false. 
If set to true then calls to methods from sub namespaces are not allowed.
E.g.

```php
namespace Foo {

  class Telephone 
  {
    #[NamespaceVisibility(excludeSubNamespaces: true)]
    public function ring(): void
    {
    }
  }

}

namespace Foo\SubNamespace {

  use Foo\Telephone;
  
  class SubNamespaceRinger
  {
    public function ring(Telephone $telephone): Person
    {
      $telephone->ring(); // ERROR - Not allowed to call Telephone::ring() from a sub namespace
    }
  }
}
```

#### namespace option

This is a string or null value. Its default value is null.
If it is set, then this is the namespace that you are allowed to call the method on.

In the example below you can only call `Telephone::ring` from the `Bar` namespace.


```php
namespace Foo {

  class Telephone 
  {
    #[NamespaceVisibility(namespace: "Bar")]
    public function ring(): void
    {
    }
  }
  
  class Ringer 
  {
    public function ring(Telephone $telephone): void
    {
      $telephone->ring(); // ERROR - Can only all Telephone::ring() from namespace Bar
    }
  }
}

namespace Bar {

  use Foo\Telephone;
  
  class AnotherRinger
  {
    public function ring(Telephone $telephone): void
    {
      $telephone->ring(); // OK - Allowed to call Telephone::ring() from namespace Bar
    }
  }
}
```

#### NamespaceVisibility on classes

If a class was the `#[NamespaceVisibility]` Attribute, then all its public methods are treated as Namespace visibility. 

E.g. 

```php
namespace Foo {

  #[NamespaceVisibility()]
  class Telephone 
  {
    public function ring(): void // This method has NamespaceVisibility
    { }
  }
}
```

If both the class and one of the class's methods has a `#[NamespaceVisibility]` attribute, then the method's attribute 
takes precedence.

```php
namespace Foo {

  #[NamespaceVisibility(namespace: 'Bar')]
  class Telephone 
  {
    #[NamespaceVisibility(namespace: 'Baz')]
    public function ring(): void // This method can only be called from the namespace Baz
    { }
  }
}
```


#### NOTES:

- If adding the `#[NamespaceVisibility]` to a method, this method MUST have public visibility.
- This is currently limited to method calls (including `__construct`).



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




## Sealed

This is inspired by the rejected [sealed classes RFC](https://wiki.php.net/rfc/sealed_classes)

The `#[Sealed]` attribute takes a list of classes or interfaces that can extend/implement the class/interface.

E.g.

```php

#[Sealed([Success::class, Failure::class])]
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
    - Assume all classes within a given namespace is test code. See [namespace config option](https://github.com/DaveLiddament/phpstan-php-language-extensions#exclude-checks-based-on-test-namespace).


## Deprecated Attributes

### Package (deprecated)

The `#[Package]` attribute acts like an extra visibility modifier like `public`, `protected` and `private`. It is inspired by Java's `package` visibility modifier.
The `#[Package]` attribute limits the visibility of a class or method to only being accessible from code in the same namespace. 

This has been replaced by the `#[NamespaceVisibility]` attribute. To upgrade replace:

`#[Package]` with `#[NamespaceVisibility(excludeSubNamespaces=true)]`


**NOTES:**

- If adding the `#[Package]` to a method, this method MUST have public visibility. 
- If a class is marked with `#[Package]` then all its public methods are treated as having package visibility. 
- This is currently limited to method calls (including `__construct`).  
- Namespaces must match exactly. E.g. a package level method in `Foo\Bar` is only accessible from `Foo\Bar`. It is not accessible from `Foo` or `Foo\Bar\Baz`




## Further examples

More detailed examples of how to use attributes is found in [examples](examples/).


## Contributing

See [Contributing](CONTRIBUTING.md).
