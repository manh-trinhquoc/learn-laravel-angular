# Dusk test
- web phải serve và reach được ở local với máy chạy test. giải pháp là chạy php artisan serve --port=80

- tsc --watch

## Design
   1. our application has: (page 206)
   - A home page, which we will call home page
A page of motorcycles, which we will call a bike-list page
A bike detail page, which we will call a bike-details page
A builders page, which we will call a builders-list page
A builder detail page, which we will call a builder-details page
A register page, which we will call a register-page page
A login page, which we will call a login-page page
A rating page, where users can vote on bikes
   2. So, what we still need to do in order to complete the backend of the application is as follows:
   - Create models for Builder, Item, Garage, and Rating
Create migration files for Builder, Item, Garage, and Rating
Seed the database
Create controllers for Bike, Builder, Item, Garage, and Rating
Apply the relationship between models
Use resources to represent relationships
Create a token-based authentication