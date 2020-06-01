# laravel-blade-directives
Laravel blade directives to create forms with ease.

This package will help you create html form tags with Blade directievs for easy creation.

## Compatibility

This package is compatible with Laravel 5.7 and above.

## Installation

You can install the package via composer:

```bash
composer require tutortonym/laravel-blade-directives
```

The package will automatically register itself and it will be ready to use.

## Available Directives

* @form(optional)
    * Creates an HTML form opening tag: `<form>`
    * Creates a hidden input for the Laravel CSRF token and adds it to the form
    * Takes an optional parameter (a single string separated by commas to set options. Example: `@form(option1,option2,option3,etc...)`)
    * Has a total of seven options in the following order:
        * 1- action = Sets the value for the action attribute on the form tag (it can be a route, internal url, or external url)
        * 2- title = Creates an h1 tag and adds it to the form as its title
        * 3- classes = Adds the provided class or classes to the form tag
        * 4- id = Adds the provided id to the form tag
        * 5- attributes = Includes any additional attributes to the form tag
        * 6- method = Allows the user to change the method attribute on the form tag to GET
        * 7- csrf = Allows the user to disable the auto-creation of the CSRF token hidden field
    
* @endform
  * Creates an html form closing tag: `</form>`
  
* @input(optional)
    * Creates an HTML input tag: `<input>`
    * Creates the PHP logic to handle validation errors and it adds it below the input field
    * Takes an optional parameter (a single string separated by commas to set options. Example: `@input(option1,option2,option3,etc...)`)
    * Has a total of seven options in the following order:
        * 1- name = Sets the value for the name attribute
        * 2- placeholder = Sets the value for the placeholder attribute
        * 3- classes = Adds the provided class or classes
        * 4- id = Sets the value for the id attribute
        * 5- attributes = Includes any additional attributes
        * 6- value = Sets the value for the value attribute. By default, it adds the PHP logic to display the old form value in case of validation fail.
        * 7- type = Sets the value for the type attribute. By default, it is set to "text"
    * It has different alternate versions
        * @number(optional) = which sets the type attribute to "number"
        * @email(optional) = which sets the type attribute to "email"
        * @hidden(optional) = which sets the type attribute to "hidden"
        * @password(optional) = which sets the type attribute to "password"
    * It also has versions that make the fields required
        * @input_req(optional)
        * @number_req(optional)
        * @email_req(optional)
        * @hidden_req(optional)
        * @password_req(optional)
        
  
Select directive coming in the versions. `<select>`


## How to Use

All Blade directives are used on the views.

### @form

In this example we are using the directive with no options. This can be helpful when creating the HTML
but the route or link for the action is not ready or is not known yet.

```blade
@form

@endform
```

The result will be a form with no action attribute, a method of post and a csrf token field.

```html
<form method="POST">
  <input type="hidden" name="_token" value="##############">
</form>
```

### @form(action)

In this example we are using the directive with the action option. The value given will be the
the name of a route in your project. This is how it should be used, however, you are not limited
to using route names. Look below for other url options.

* action = the route name for the form submintion

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

If you need your action to point to an internal url or relative path, you have to start the action option with a forward slash "/"

* action = a slash followed by the relative url (/myurl)

```blade
@form(/login)

@endform
```

The result will be a form with an action attribute pointing to a relative path, a method of post and a csrf token field.

```html
<form action="/login" method="POST">
  <input type="hidden" name="_token" value="##############">
</form>
```

If you need your action to point to an external url or an absolute path, you have to start the action option with an asterisk "*"

  *action = a slash followed by the relative url (*http://exampledomain.com)

```blade
@form(*http://exampledomain.com)

@endform
```

The result will be a form with an action attribute pointing to an absolute path, a method of post and a csrf token field.

```html
<form action="http://exampledomain.com" method="POST">
  <input type="hidden" name="_token" value="##############">
</form>
```

### @form(action,title)

In this example we are using the directive with the action and title options.

  * title = the desired title for the form (case sensitive)

```blade
@form(login,Login Form)

@endform
```

The result will be a form with an h1 tag as the title.

```html
<form action="http://url/to/your/login/page" method="POST">
  <h1>Login Form</h1>
  <input type="hidden" name="_token" value="##############">
</form>
```

By default an h1 element is used. However, if you want to use a different element 
you can specify it by stating the element followd by a colon before the title itself.

```blade
@form(login,h3:Login Form)

@endform
```

The result will be a form with an h3 tag as the title.

```html
<form action="http://url/to/your/login/page" method="POST">
  <h3>Login Form</h3>
  <input type="hidden" name="_token" value="##############">
</form>
```

### @form(action,title,classes)

In this example we are using the directive with the action, title and classes options.

  * classes = the class to add to the form tag

```blade
@form(login,Login Form,class1)

@endform
```

The result will be a form tag with a class attribute and the provided class.

```html
<form action="http://localhost/zaz16/public/login" method="POST" class="class1">
  <h1>Login Form</h1>
  <input type="hidden" name="_token" value="##############">
</form>
```

If you need to add multiple classes, you can do so by separating them with a space in between each

```blade
@form(login,Login Form,class1 class2 class3)

@endform
```

The result will be a form tag with a class attribute and the provided classes.

```html
<form action="http://localhost/zaz16/public/login" method="POST" class="class1 class2 class3">
  <h1>Login Form</h1>
  <input type="hidden" name="_token" value="##############">
</form>
```

### @form(action,title,classes,id)

In this example we are using the directive with the action, title, classes, and id options.

  * id = the id name to add to the form tag

```blade
@form(login,Login Form,class1,login-form)

@endform
```

The result will be a form tag with the id attribute and the provided id name.

```html
<form id="login-form" action="http://localhost/zaz16/public/login" method="POST" class="class1">
  <h1>Login Form</h1>
  <input type="hidden" name="_token" value="##############">
</form>
```

### @form(action,title,classes,id,attributes)

In this example we are using the directive with the action, title, classes, id, and attributes options.

  * attributes = any additional attributes to add to the form tag.
  
  Note: The equal sign needs to be escaped with a back slash "\"
  (Example: enctype="multipart/form-data" should be enctype\="multipart/form-data").
  Optionally, a caret can be used instead of the equals sign and quotes are optional
  (Example: enctype="multipart/form-data" should be enctype^multipart/form-data).

```blade
@form(login,Login Form,class1,login-form,enctype^multipart/form-data)

@endform
```

The result will be a form tag with the additional attributes

```html
<form id="login-form" action="http://localhost/zaz16/public/login" method="POST" class="class1" enctype="multipart/form-data">
  <h1>Login Form</h1>
  <input type="hidden" name="_token" value="##############">
</form>
```

If more than one attribute is needed, simply separate them with a space in between each.

```blade
@form(login,Login Form,class1,login-form,enctype^multipart/form-data novalidate)

@endform
```

The result will be a form tag with the additional attributes

```html
<form id="login-form" action="http://localhost/zaz16/public/login" method="POST" class="class1" enctype="multipart/form-data" novalidate="novalidate">
  <h1>Login Form</h1>
  <input type="hidden" name="_token" value="##############">
</form>
```

### @form(action,title,classes,id,attributes,method)

In this example we are using the directive with the action, title, classes, id, attributes, and method options.

  * method = the method to the form submission route. By default it is "POST" and you only need to set this 
  option if it is something other than "POST".
  
  Note: Supported methods are "get", "put", "patch", and "delete"

```blade
@form(login,Login Form,class1,login-form,enctype^multipart/form-data,get)

@endform
```

The result will be a form tag with the attribute method set to get.

```html
<form id="login-form" action="http://localhost/zaz16/public/login" method="GET" class="class1" enctype="multipart/form-data">
  <h1>Login Form</h1>
  <input type="hidden" name="_token" value="##############">
</form>
```

If you set the method to "put", "patch", or "delete", a spoofing field will be
created for Laravel to know what method to use for this form.

```blade
@form(login,Login Form,class1,login-form,enctype^multipart/form-data,patch)

@endform
```

The result will be a form tag with the attribute method set to post and a hidden spoofing field with a value set to patch.

```html
<form id="login-form" action="http://localhost/zaz16/public/login" method="POST" class="class1" enctype="multipart/form-data">
  <h1>Login Form</h1>
  <input type="hidden" name="_token" value="##############">
  <input type="hidden" name="_method" value="PATCH">
</form>
```

### @form(action,title,classes,id,attributes,method,csrf)

In this example we are using the directive with the action, title, classes, id, attributes, method, and csrf options.

  * csrf = this is a swtich. By default it is on. You can disable it with any 
  of the following values: '0', 'false', 'off' and 'no'

```blade
@form(login,Login Form,class1,login-form,enctype^multipart/form-data,patch,off)

@endform
```

The result will be a form with no CSRF token field.

```html
<form id="login-form" action="http://localhost/zaz16/public/login" method="POST" class="class1" enctype="multipart/form-data">
  <h1>Login Form</h1>
  <input type="hidden" name="_method" value="PATCH">
</form>
```
## Inplicit Options and Nulls

All the examples in the "How to Use" section use implicit options. That means that options are determined by
their position in the comma separated string array.

When declaring options implicitly, the order matters. However, you are not required to provide a 
value for each of them.

You can opt to leave options undeclared simply by not writing anything for each as long as they are after
the ones you do declare and are in their respective order.

In the following example we are only declaring two options (1 and 2 respectively). The other five (3 to 7) 
are undeclared and the default values will be used since the two that are declared are in the correct order 
wich are "action" and "title".

```blade
@form(login,Login Form)

@endform
```

What if I want to declare options 1, 2 and 6 only?

In that scenario we need to let our directive know that options 3, 4 and 5 will be null from our end.
We do this by writing the word "null" in place of each option.

```blade
@form(login,Login Form,null,null,null,patch)

@endform
```

## Explicit Options and Nulls

All the examples in the "How to Use" section use implicit options. However, there is another way to
declare options and that is explicitly.

When declaring options explicitly, the order does not matters. However, you are required to provide a
key=value set for each option you want to use.

```blade
@form(action=login,title=Login Form)

@endform
```

Just like when declaring options implicitly, you are not require to provide a value to all seven options.

The advantage of declaring options explicitally is that we can declare only the ones we need
in any order we want. There is no need to declare null on the ones we don't want to use.


What if I want to declare options 1, 3 and 6 only?

In that scenario we need to provide a key=value pair for each of the desired options.
Notice how the options are out of order but this will work just fine because they are
being declare explicitly.

```blade
@form(method=patch,class=class1,action=login)

@endform
```

We can also combine inplicit and explicit option. The thing to keep in mind is that the order
of the implicit options matter.

For example if I want to declare options 1, 2, and 6 I can do the following:

```blade
@form(login,Login Form,method=patch)

@endform
```

The previos example works because options 1 and 2 are in order thus allowing me to declare them
implicitly. However, option 6 is out of order so I chose to declare it explicitly to not have 
to write "null" for all skipped options.

## About TutorTonyM

I'm a developer from the United States who creates software and websites on a daily basis. I'm passionate about what
I do and I like to share the little knowledge I possess. I share my knowledge on different platforms such as
[YouTube.com/TutorTonyM](https://www.youtube.com/tutortonym) and [TutorTonyM.com](https://tutortonym.com/).
You can follow me on my social media @TutorTonyM on [Facebook](http://www.facebook.com/tutortonym), 
[Instagram](https://www.instagram.com/tutortonym), and [Twitter](https://www.twitter.com/tutortonym).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
