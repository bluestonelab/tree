# About Tree

[![Run tests](https://github.com/bluestonelab/tree/actions/workflows/run_tests.yml/badge.svg)](https://github.com/bluestonelab/tree/actions/workflows/run_tests.yml)
[![Latest Stable Version](https://poser.pugx.org/bluestone/tree/v/stable)](https://packagist.org/packages/bluestone/tree)

## Installation

This package requires `php:^8.1`.  
You can install it via composer:
```bash
composer require bluestone/tree
```

## Usage

Tree instance need items to forge the expected data structure.

### How to forge a tree with array as items ?

By default, a tree expect `id` and `parentId` fields in give items like this :

```php
use Bluestone\Tree\Tree;

$items = [
    ['id' => 1, 'parentId' => null, 'username' => 'Robert'],
    ['id' => 2, 'parentId' => 1, 'username' => 'John'],
    ['id' => 3, 'parentId' => 1, 'username' => 'Jane'],
];

$tree = new Tree($items);

// Get Robert's children
$robert = $tree->getNodeById(1); // Return the node representing Robert
$robert->username; // Robert
$robert->getChildren(); // Return an array containing John & Jane

// Get Jane's parent
$jane = $tree->getNodeById(3);
$jane->getParent(); // Return Robert's node
```

### How to forge a tree with custom fields ?

You can customize the `parentKey` and the `primaryKey` like this :

```php
use Bluestone\Tree\Tree;

$items = [
    [
        'uuid' => 'b08f82b9-e8cc-44fb-b99a-4929bfcf02a4', 
        'parentUuid' => null, 
        'username' => 'Robert',
    ],
    [
        'uuid' => 'eaaf3215-17ba-4779-b444-d4a8203f1096', 
        'parentUuid' => 'b08f82b9-e8cc-44fb-b99a-4929bfcf02a4', 
        'username' => 'John',
    ],
];

$tree = new Tree($items, 'parentUuid', 'uuid');
```

### How to serialize a tree to json ?

```php
use Bluestone\Tree\Tree;

$items = [
    ['id' => 1, 'parentId' => null, 'name' => 'Chicken'],
    ['id' => 2, 'parentId' => 1, 'name' => 'Egg'],
];

$tree = new Tree($items);

$json = json_encode($tree);
```

The result of the `json_encode` is a string with contains :

```json
{
    "primaryKey": "id",
    "parentKey": "parentId",
    "nodes": [
        {"id": 1, "parentId": null, "name": "Chicken"},
        {"id": 2, "parentId": 1, "name": "Egg"}
    ]
}
```

### How to forge a tree with object as items ?

You can pass object as items with expected `id` and `parentId` public property like this :

```php
use Tests\Artifacts\Person;
use Bluestone\Tree\Tree;

$items = [
    new Person(1, null, 'Chicken'),
    new Person(2, 1, 'Egg'),
];

$tree = new Tree($items);

$chicken = $tree->getNodeById(1);
$chicken->name; // Chicken
$chicken->getChildren(); // Return Egg's node
```

## Contributing

Tree is an open source project under MIT License and is open for contributions.
