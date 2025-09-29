Features Implemented :
- Create, edit, delete tasks (CRUD).
-Toggle task status between pending / completed (toggleStatus).
- Validation
- Display validation errors in Blade views.
- Index page lists all tasks (completed / pending) with action buttons (edit / delete / toggle).
- Used Laravel UI for authentication scaffolding and Blade templates.
- Reusable partial form for create/edit to avoid duplication.
- Used Eloquent ORM instead of raw queries.
- Pagination to display tasks.
- Search to filter tasks by title
- Added due_date field with highlighting for overdue tasks.
- Implemented logging as a background action when task status is changed.
- Added Seeder for test data.
 
Requirements to Run :
#  Install Composer dependencies
composer install

#  Install NPM dependencies
npm install && npm run dev

#  Install Laravel UI package
composer require laravel/ui

#  Generate UI scaffolding (Bootstrap + Auth)
php artisan ui bootstrap --auth

#  Rebuild frontend assets
npm install && npm run dev

#  Run migrations and seeders
php artisan migrate --seed


  
