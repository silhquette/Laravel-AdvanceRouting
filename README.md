# Laravel Routing – 8 Advanced Tips

Created by: 038_Muhammad Qiyam Bil Muzakki
Stack: Laravel, Php
Type: Best Practice

# ****Tip 1. `Route::get()` BEFORE `Route::resource()`**

For [Resource Controllers](https://laravel.com/docs/master/controllers#resource-controllers), this is one of the most common mistakes, see this example:

```php
Route::resource('photos', 'PhotoController');
Route::get('photos/popular', 'PhotoController@method');
```

The second route won’t be accurate, you know why? Because it will match **`show()`** method of **`Route::resource()`** which is **`/photos/{id}`**, which will assign “popular” as **`$id`** parameter.

So if you want to add any get/post route, in addition to Route::resource(), you need to put them BEFORE the resource. Like this:

```php
Route::get('photos/popular', 'PhotoController@method');
Route::resource('photos', 'PhotoController');
```

---

##