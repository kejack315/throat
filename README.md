# THROAT

Terrifyingly Huge Resource of Organised Acronyms and Terminology

*This in itself is a backcronym.*

## About THROAT


## Contributing

TBA

## Code of Conduct

TBA

## Security Vulnerabilities

TBA

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Notes
## Dev Environment

Presumptions:
- Windows 10+
- Laragon 6+ as the WAMP stack
- PHP 8.2+
- MariaDB 10+ / MySQL 8+
- NodeJS 18+
- Composer 2+
- ...


## Create new Laravel application
PC:
- open the Laragon application
- Start All
- Open the Laragon terminal
- ensure PHP and Composer installed and working:
```shell
php -v
```
```shell
composer -V
```
create database and user

db name: throat
db user: throat
db pass: acronym

CREATE USER 'throat'@'localhost' IDENTIFIED VIA mysql_native_password USING 'acronym';
GRANT USAGE ON *.* TO 'throat'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `throat`;
GRANT ALL PRIVILEGES ON `throat`.* TO 'throat'@'localhost';


create project

composer create-project laravel/laravel throat

cd throat

edit .env

change the db details to above.

create word types migration, model, controller, seeder, factory, etc

php artisan make:model WordType -as

Output of command:
```text
INFO  Model [...\throat\app/Models/WordType.php] created successfully.
INFO  Factory [...\throat\database/factories/WordTypeFactory.php] created successfully.
INFO  Migration [...\throat\database\migrations/2023_07_26_011248_create_word_types_table.php] created successfully.
INFO  Seeder [...\throat\database/seeders/WordTypeSeeder.php] created successfully.
INFO  Request [...\throat\app/Http/Requests/StoreWordTypeRequest.php] created successfully.
INFO  Request [...\throat\app/Http/Requests/UpdateWordTypeRequest.php] created successfully.
INFO  Controller [...\throat\app/Http/Controllers/WordTypeController.php] created successfully.
INFO  Policy [...\throat\app/Policies/WordTypePolicy.php] created successfully.
```

press SHIFT twice, start typing WordType and locate the migration (e.g. 2023_07_26_0111248_create_word_types_table.php )

Edit the migration to include

id (pk)
code (string, unique, 2 chars, not nullable)
name (string, unique, 32 chars, not nullable)

run migration using

php artisan migrate --step

this runs any new migrations, adding them to a step-by-step list in the databse. this allows rollback a step or more if
needed.

edit the WordType model and add the name and code to the fillables.

open the seeder for word types (Use `SHIFT`-`SHIFT` word, then find word type seeder)

Add the seeder code

edit the Database Seeder class and update


run the seeder


error?

```text
php artisan db:seed

   INFO  Seeding database.

  Database\Seeders\WordTypeSeeder .......................................................................................................... RUNNING

   Error

  Class "Database\Seeders\WordType" not found

  at database\seeders\WordTypeSeeder.php:52
     48▕
     49▕         ];
     50▕
     51▕         foreach ($seedTypes as $seedType) {
  ➜  52▕             WordType::create($seedType);
     53▕         }
     54▕
     55▕     }
     56▕ }

  1   vendor\laravel\framework\src\Illuminate\Container\BoundMethod.php:36
      Database\Seeders\WordTypeSeeder::run()

  2   vendor\laravel\framework\src\Illuminate\Container\Util.php:41
      Illuminate\Container\BoundMethod::Illuminate\Container\{closure}()

```

Need to Import the WordType model into the seeder.

---

exercise

create the terms table (php artisan...)

| field | ... | ... |
|-------|--------|------|
| term | string, 96 | required |
| word type | str, 2 | required, default Other |
| definition | text | required |
| url | string, 255 | required |
| added by | foreign key | from user table |

update the model to include these fields

## TO DO 30/8

If your THROAT repo is public, ensure you change it to be a PRIVATE repository.

- Reason: you will be submitting this small application as part of your portfolio of work.

### MongoDB University

The submission point for the MongoDB University proof of completion has been added to the Assessments Area.

### Laravel Exercise Steps Part I

With each of these exercises make sure you COMMIT and PUSH your code to your PRIVATE repository.

- a ⌨ means you should commit at this stage.


- Ensure the Model, Migration and Seeders for the following Models are created and function as expected:
    - User <-- GOTCHA! already part of the Laravel installation!
    - Word Type
    - Definition
    - Word
    - Rating
- Add the following Pivot Model & Migration
    - definition-rating
        - foreign id (definition id)
        - foreign id (rating id)
        - foreign id (user id)
        - rating value
    - artisan make:model DefinitionRating --migration
- ⌨
- Make sure you have the user seeder from Adrian's GitHub Repo.
    - https://github.com/AdyGCode/SaaS-23S2-Throat-II/blob/main/database/seeders/UserSeeder.php
- ⌨
- Create the VIEWS for the Word model
    - Create: Make sure you have a place to insert the definition for the word
    - Update: Do not have any way to edit the word definitions
    - Destroy: Ensure you check if the user wants to remove the word
    - Index: Show all the words and a count of the number of definitions eg. BBQ Initialism 7
    - Show: Show the word, and a list of the definitions (only the first 15 words for each definition)
- ⌨
- Create the ROUTES for the Word views
- Create the WordController METHODS
- TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST
- ⌨
- Create the Views for the Definition
- Create the ROUTEs for the Definition
- Create the Controller methods for the DefinitionController
- Add the relationship for Definition -- Word:
    - a definition belongs to one word
- TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST
- ⌨
- Ensure all Models have their relationships defined as needed
- ⌨

### Laravel Exercise Steps Part II

- Ensure you have completed Part I
- Add authentication to your solution (login/logout/register)
- ⌨
- Modify the navigation template to prevent any "authenticated data" being accessed (eg the logged-in username)
- ⌨
- Add protection for the user's added definitions, so they are only editable by the user who wrote them
- ⌨
-
- ..
- ⌨
