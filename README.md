# Digital Plankton Test

The following app is an assessment test application for Digital Plankton 

# Content

Using Laravel/Passport, the following functionalities are available
- Register User, register an user providing email, name, password and password_confirmation, return a personal access token.
- Login User, get a personal access token providing email and password.
- Return <strong>current user engine</strong>, return the user information (no password), a Bearer Token is required.
- Notification CRUD, a set of endpoint for retrieve, create, update and delete notification belong to the user, a Bearer Token is required for each action.
- Endpoint for retrieve 10 articles from Wikipedia API, a Bearer Token is required
- Command notification:clear for mark all unread notifications as read for all users.
- Command notification:delete for delete all read notification for all users.
- Seeder for create 100 users.
- In the folder Postmanfile there is a Postman file for import.

# Notes

- Used wikipedia articles api instead Yelp, in order to do the test quickly.
- The code might needs an additional refactoring, to meet SOLID principles.
- Need install Laravel/Passport and run the migration and install command. [Laravel Passport Documentation](https://laravel.com/docs/8.x/passport)
- Only one <strong>test unit</strong> was created. 

# Postman file content

The post man file contain a set of endpoints to test the app.

- Auth folder contains two endpoints
    - Register use for create a new user into the application.
    - Login use for login the user name created in the previous endpoint.
- Notification folder contains the CRUD endpoints for notifications (need the Bearer token of the previous call)
    - GetNotifications: return all notification for the current user.
    - Create Notification: Create a notification
    - Update Notification: Update a notification, is checking that the notification belong to the user.
    - Get Notification: Retrieve all info of a specific notification, is checking that the notification belong to the user.
    - Delete Notification: Delete a notification, is checking that the notification belong to the user.
- Get User Details Request: return the user info of the current user
- WikipediaGetArticles: return 10 articles of terms "usa", a Bearer token is required.

# Code content

## Services
- NotificationService: Used for create, store, update Notifications, has a Contract bind in the AppServiceProvider
- TokenService: Used to create a token and store it, has a Contract bind in the AppServiceProvider
- UserRegisterService: Service for register a user, has a Contract bind in the AppServiceProdiver

## Controllers
- AuthUserController: Contains the login and register actions.
- NotificationController: Contains the CRUD actions for Notification
- UserController: Contains the action to get the User details.
- WikipediaController: Contains the action to retrieve 10 wikipedia articles.

## Middleware
- ForceJsonResponse: Middleware to return all response as Json format
- JsonApiMiddleware: Middleware for check request (json payload) transform to array of params, in order to validate json payloads

## Requests
- CreateNotificationRequest: Contains the rules validation for create a notification
- LoginRequest: Contains the rules validations for Login a User
- RegisterRequest: Contains the rules validation for Register a User
- UpdateNotificationRequest: Contains the rules validation for Update a Notification

## Resources
- NotificationResource: Transformer for return Notification as json response
- TokenResource: Transformer for return Tokens as json response
- UserResource: Transformer for return User as json response

## Models
- Notification: Notification Model 
- User: User Model

## Providers
- WikipediaServiceProvider: Provider for bind Contracts to implementations for the Wikipedia Package

## Seeder
- UserDeeder: create 100 users fake in the db.

## Migrations:
- 2020_09_29_220354_create_notifications_table: migration for create notification table


## Package Wikipedia 

The wikipedia package contains several classes for retrieve articles from the Wikipedia Api, depends of the Guzzle Client Class.
- WikipediaApiClient: Service that reach Wikipedia Api, depends of Guzzle Client, has a contract IWikipediaApiClient
- WikipediaResponseParser: Service that parse the response of the WikipediaApiClient, has a contract IWikiperdiaResponseParser, used in the WikipediaService
- WikipediaRequest: Model class used for WikipediaService, that represent the request to Wikipedia Api, has a contract IWikipediaRequest, used in the WikipediaService
- WikipediaService: Service that contains high level retrieve articles for Wikipedia Api, has a contract IWikipediaService







