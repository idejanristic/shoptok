# Description

This is a web application for a job competition.

## Installation

### Docker and Sail

1. Clone or download the repository
2. Go to the project directory and run `composer install`
3. Create `.env` file by copying the `.env.example`. You may use the command to do that `cp .env.example .env`
4. Update the database name and credentials in `.env` file
5. Run the command `sail up -d` (consider adding this to your alias: `alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'`)
7. Run the command `sail artisan key:generate`
6. Run the command `sail artisan migrate`
8. Link storage directory: `sail artisan storage:link`
9. Run the command `sail npm install`
10. Run the command `sail npm run dev`
11. Since Sail is already up, you can just visit http://localhost:8080

## License

[MIT license](https://opensource.org/licenses/MIT).
