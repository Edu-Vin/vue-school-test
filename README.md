## About Project

This is for a Mid-level Laravel Developer test built with Laravel. The instruction mentioned here https://tinyurl.com/322ac4wc was implemented. 
 
## Implementation

- Repository design pattern was used.
- update-provider branch was created for the second part of the test as instructed

The implementation was not completed. Documentation for the API was not provided, so there was no way to know the URL for the batch update endpoint, header structure etc. In general, everything needed to update the external provider is complete. In the absence of the documentation, I implemented getting the necessary data to be updated and added a service boilerplate for updating the provider. By doing this it makes the work faster when the documentation is provided.

Another thing that was not clear is if a single attribute or all attributes of the user will be changing. Based on the setup mentioned at the begining of the instruction document I assumed that the name and timezone will be the one changing. 

I also assumed the duration for updating the users' info locally and also updating the provider.

In general, I believe the test is incomplete.

## Updating local DB and provider
```bash
php artisan users:update-info local

php artisan users:update-info provider
```
    
## Instalation

- Pull the repository
```bash
git clone https://github.com/Edu-Vin/vue-school-test.git
```
- Install App
```bash
composer intall

cp .env.example .env

php artisan key:generate

Update env file with right DB credentials.

php artisan migrate

```
- Run App
```bash
- Local

php artisan serve

```
- Seed Database
```
php artisan db:seed
```
