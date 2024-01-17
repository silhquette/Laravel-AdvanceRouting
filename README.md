# Laravel Routing – 4 Advanced Tips

Created by: 038_Muhammad Qiyam Bil Muzakki
Stack: Laravel, Php
Type: Best Practice

# ***Tip 1. `Route::get()` BEFORE `Route::resource()`***

For [Resource Controllers](https://laravel.com/docs/master/controllers#resource-controllers), this is one of the most common mistakes, see this example:

```php
Route::resource('photos', 'PhotoController');
Route::get('photos/popular', 'PhotoController@method');
```

The second route won’t be accurate, you know why? Because it will match `show()` method of `Route::resource()` ****which is `/photos/{id}`, which will assign “popular” as `$id` parameter.

So if you want to add any get/post route, in addition to Route::resource(), you need to put them BEFORE the resource. Like this:

```php
Route::get('photos/popular', 'PhotoController@method');
Route::resource('photos', 'PhotoController');
```

---

# *Tip 2. Group in Another Group*

We probably all know that we can [group routes](https://laravel.com/docs/master/routing#route-groups) with `Route::group()` and assign different `middlewares`/`prefixes` and other parameters, like public routes and logged-in routes.

But what if you need a certain set of rules for sub-groups of those groups?

A typical example: you need public routes and authenticated routes, but within the authenticated group, you need to separate administrators and managers from simple users.

So you can do this:

```php
Route::group(['middleware' => ['auth', 'throttle:60,1']], function() {
    
    // '/user/XXX' : In addition to "auth", this group will have middleware "user"
    Route::group(['middleware' => ['manager'], 'prefix' => 'manager'], function() {
        Route::resource('wishlist', WishlistController::class);
    });

    // '/admin/XXX' : This group won't have "user", but will have "auth" and "admin"
    Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function() {
        Route::resource('users', UserController::class);
    });
});
```

---

# *Tip 3. **API Routes – from V1 to V2***

Imagine you’re working with API-based project and you need to release a new version of this API. So older endpoints will stay at `api/[something]`, and for new version you would use `api/V2/[something]`.

The whole logic is in `app/Providers/RouteServiceProvider.php`:

```php
/**
 * Define your route model bindings, pattern filters, and other route configuration.
 */
public function boot(): void
{
    RateLimiter::for('api', function (Request $request) {
        return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
    });

    $this->routes(function () {
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));

        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    });
}
```

As you can see, API routes are registered in a separate function with prefix `api/`.

So, if you want to create V2 route group, you can create a separate `routes/api_v2.php` and do this:

```php
/**
 * Define your route model bindings, pattern filters, and other route configuration.
 */
public function boot(): void
{
    // ... rate militer

    $this->routes(function () {
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
        
        Route::middleware('api')
            ->prefix('api/v2')
            ->group(base_path('routes/api_v2.php'));

        // ... route for web
    });
}
```

---

# *Tip 4. **Rate Limiting – Global and for Guests/Users***

This also comes from [official documentation](https://laravel.com/docs/master/routing#rate-limiting), but with less-known details.

First, you can limit some URL to be called a maximum of 60 times per minute, with `throttle:60,1`.

```php
Route::middleware('auth:api', 'throttle:60,1')->group(function () {
    Route::get('/user', function () {
        //
    });
});
```

But did you know you can do it separately for public and for logged-in users?

```php
// maximum of 10 requests per minute for guests 60 for authenticated users
Route::middleware('throttle:10|60,1')->group(function () {
    //
});
```

Also, you can have a DB field `users.rate_limit` and limit the amount for specific user:

```php
Route::middleware('auth:api', 'throttle:rate_limit,1')->group(function () {
    Route::get('/user', function () {
        //
    });
});
```