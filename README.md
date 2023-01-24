Merger
=====

#### In the assessment of tasks, what matters most to us is architecture, reusability of implemented solutions and adherence to standards.
#### Don't waste time implementing additional mechanisms, e.g. caching or Laravel configuration. All you have to do is show us in the code (with a comment or a pseudo-facade) what your intention was.

---


Television content companies FOO, BAR and BAZ joined forces, resulting in a merger. The management board of the newly established company decided to create an application responsible for the integration of IT systems used by these companies. The aim of the integration is to make the functionality of all systems available to the clients of these three companies.

## Task 1

The first phase of the project concerns the authentication module.
Routing for the API is defined in the `routes/api.php` file.
The login endpoint is handled by the controller `app/Http/Controllers/AuthController.php`.
The `login()` method is responsible for


1. Authenticating the client in the company system where his account exists. The company the client belongs to is determined by the construction of his login. The FOO customer logins have the prefix **FOO**_, the BAR customer logins have the prefix **BAR**_, and the BAZ customer logins are preceded by the prefix **BAZ**_. For example, the login **FOO_123** is a valid login in the system of the FOO company. Logins **ABC_100**, **Foo_123** are invalid.
2. Creating JWT token in case of successful authentication. The token should contain the **user's login** and the **system** in which the authentication took place.
3. Returning the response in JSON format.
   Structure of response in case of success:
   ```
   {
      "status": "success",
      "token": <generated token>
   }
   ```

   Structure of response in case of failure:
   ```
   {
      "status": "failure"
   }
   ```

There are classes in the External directory for communication with systems companies.

`External/Foo/Auth/AuthWS.php` - class for authenticating clients FOO
`External/Bar/Auth/LoginService.php` - class for authenticating BAR
`External/Baz/Auth/Authenticator.php` - class for authenticating BAZ clients

--- 

#### Your task is to implement the method login. You can change the structure of files and directories freely, except for the External folder, which should be treated as an external library that cannot be modified.

---

### Sample tests

Request 1
```curl --location --request POST 'http://127.0.0.1:8000/api/login' \
--header 'Content-Type: text/plain' \
--data-raw '{
    "login": "test",
    "password": "foo-bar-baz"
}'
```

Response 1
```{"status":"failure"}```


Request 2
```
curl --location --request POST 'http://127.0.0.1:8000/api/login' \
--header 'Content-Type: text/plain' \
--data-raw '{
    "login": "FOO_1",
    "password": "foo-bar-baz"
}'
```

Response 2
```{"status":"success","token":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJsb2dpbiI6IkZPT18xIiwiY29udGV4dCI6IkZPTyIsImlhdCI6MTUxNjIzOTAyMn0.iOLIsd1TXyU53nrMGfjShXD7KSMz_lbaT256TQVYDz8"}```


## Task 2

Companies Foo, Bar and Baz are the suppliers of the footage. One of the goals of this app is to provide clients with access to all the material offered by the vendors.

In the files
```
`External/Bar/Movies/MovieService.php`
`External/Baz/Movies/MovieService.php`
`External/Foo/Movies/MovieService.php`
```
there are classes with the method `getTitles()` which returns a list of titles (in different format) for your system. No title belongs to more than one system.

---

#### `getTitles()` methods mentioned above should be treated as an external data source. Don't modify them!!!

---

There is a controller with the `getTitles()` method in the `app/Http/Controllers/MovieController.php`.
This method is responsible for:
1. Retrieving titles from Foo, Bar, Baz systems.
2. Combining the results.
3. Returning the results in a JSON response. Structure of the response in case of success:
   ```
   [
      "title 1",
      "title 2",
      "title 3"
   ]
   ```
   Structure of the response in case of failure:
   ```
   {
      "status": "failure"
   }
   ```

`MovieService` services are unstable. Occasionally a connection error occurs,
resulting in a `ServiceUnavailableException` being thrown. Provide request repetition
mechanism and result cache to relieve external systems and minimize the probability of failure.

### Notes
- If the downloading of titles from one or more systems fails in step (1), return an error message.


Tips
=========
1. `php artisan serve` allows you to run an application test server.
2. `composer require lcobucci/jwt` installs the library, which supports JWT.

