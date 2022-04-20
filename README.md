# PHP Language Extensions (currently in BETA)

This library provides attributes for extending the PHP language (e.g. adding `package` visibility).
The intention, at least initially, is that these extra language features are enforced by static analysis tools (such as Psalm, PHPStan and, ideally, PhpStorm) and NOT at runtime.

**Language feature added:**
- [package](#package) 
- [friend](#friend)
- [sealed](#sealed)


### Contents

- [Installation](#installation)
  - [PHPStan](#phpstan)
  - [Psalm](#psalm)
- [New Language Features](#new-language-features)
  - [package](#package)
  - [friend](#friend)
  - [sealed](#sealed)
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

To use PHPStan to enforce package level visibility add [this extension](https://github.com/DaveLiddament/phpstan-php-language-extension). 

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

namepace Bar {

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
- If a class is marked with `#[Package]` then all its public methods are treated as having protected visibility. 
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

** This attribute is a work in progress **

This replicates the rejected [sealed classes RFC](https://wiki.php.net/rfc/sealed_classes)

The `#[sealed]` attribute takes a list of classes or interfaces that can extend/implement the class/interface.

E.g. 

```php

#[sealed([Success::class, Failure::class])]
abstract class Result {} // Result can only be extended by Success or Failure

// OK
class Success extends Result {}

// OK
class Failure extends Result {}

// ERROR AnotherClass is not allowed to extend Result
class AnotherClass extends Result {}
```

## Further examples

More detailed examples of how to use attributes is found in [examples](examples/).


## Contributing

See [Contributing](CONTRIBUTING.md).


## TODO

- [] Add examples for Sealed
