# laravel-blade-directives
Laravel Blade directives to create forms with ease.

This package will allow you to create html forms related tags using Blade directives. It will take care of additional elements needed in most forms such as CSRF tokens, spoofing, validation errors, old values, and displaying values from the database with minimum effort. For simplicity purposes, from here on this package will be referred to as ttm-directives.

## Documentation

The official documentation for this package can be found [Here](https://tutortonym.com/packages/laravel/laravel-blade-directives).

## Compatibility

This package is compatible with Laravel 5.7 and above.

## Installation

You can install the package via composer:

```bash
composer require tutortonym/laravel-blade-directives
```

The package will automatically register itself and it will be ready to use.

## Available Directives
  
* @button(optional)
* @checkbox(optional)
* @email(optional)
* @endform
* @form(optional)
* @hidden(optional)
* @input(optional)
* @label(optional)
* @number(optional)
* @password(optional)
* @radio(optional)
* @select(optional)
* @textarea(optional)

More directives to be added in the upcoming versions.


## How to Use

All Blade directives are used on the views.

### @form(action)

In this example we are using the directive with the action option. The value given will be the
the name of a route in your project. This is how it should be used, however, you are not limited
to using route names. Look below for other url options.

* action = the route name for the form submission

```blade
@form(login)

@endform
```

The result will be a form with an action attribute pointing to a route name, a method of post and a csrf token field.

```html
<form action="http://url/to/your/login/page" method="POST">
  <input type="hidden" name="_token" value="##############">
</form>
```

## About TutorTonyM

I'm a developer from the United States who creates software and websites on a daily basis. I'm passionate about what
I do, and I like to share the knowledge I possess. I share my knowledge on different platforms such as
[YouTube.com/TutorTonyM](https://www.youtube.com/tutortonym) and [TutorTonyM.com](https://tutortonym.com/).
You can follow me on my social media @TutorTonyM on [Facebook](http://www.facebook.com/tutortonym), 
[Instagram](https://www.instagram.com/tutortonym), and [Twitter](https://www.twitter.com/tutortonym).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
