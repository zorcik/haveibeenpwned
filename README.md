# haveibeenpwned
Library to check if password is compromised

Requires Guzzle

Example:

```php

$haveIbeenPwndScore = (new \WebLogic\haveibeenpwned\haveibeenpwned())->checkPassword($password);

if ($haveIbeenPwndScore > 0)
{
    die("Your password is compromised!");
}
```
