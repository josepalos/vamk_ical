Configuration
==
1. Copy the repository in a web server public folder with
PHP activated.
2. Create the auth.php file containing the following (with
the username and the password of Vamk university):
```php
<?php
$username = "";
$password = "";
?>
```

3. Put the auth.php file in a protected folder and set the
path to this file in [ical.php](ical.php#L3) require line.

4. Create a json file with the following format:
```javascript
{
    "<degree code (IB, IT...)>": {
        "base_url": "<base url of the calendar (without the degree code)>",
        "groups": {
            "<group code 1>": ["<subject 1>", "<subject 2>", ...],
            "<group code 2>": [...],
            ...
        }
    },
    ...
}
```

TODO
==
 - [ ] Create an installation script.
 - [ ] Create a configuration script for the subjects.
