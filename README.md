# PHP CLI tool builder

> A lightweight library to build your own custom CLI scripts.

---

## 📄 Library Details

- 👤 **Author and maintainer**: Yahaya Bathily - [GitHub](https://github.com/yahvya)
- 📄 **License**: MIT
- 🧾 **License usage**: Free to use in both commercial and non-commercial projects under the MIT license.
- 🗓️ **Created at**: 25/08/2025

---

## 📚 Documentation

The steps to create your own scripts are as follows:

- Create the script file
- Load your autoload file
- Create an instance of the ```CliToolBuilder``` class with the expected configuration like bellow
- Call the treat input method with the arguments of the script as a parameter (you can simulate your arguments by passing a formated array like ```$argv```, 'command name' 'arguments...')

```
<?php

use Yahvya\PhpCliToolBuilder\Builder\CliToolBuilder;
use Yahvya\PhpCliToolBuilder\Builder\CliToolConfiguration;
use Yahvya\PhpCliToolBuilder\Default\Command\HelpCommand;

require_once(__DIR__ . "/vendor/autoload.php");

$cliToolBuilder = new CliToolBuilder(
    configuration: new CliToolConfiguration(
        toolName: "cli-lib",
        toolDescription: "A tool to help you build your cli tool",
        toolVersion: "1.0.0",
        toolAuthor: "Yahvya",
        commands: [
            new HelpCommand()
        ]
    )
);

try
{
    $cliToolBuilder->treatInput(cliArguments: $argv);
}
catch(Exception $e)
{
    echo $e->getMessage();
}
```

## ✅ Library Test Coverage

To run the tests, clone the repository and run:

```
php vendor/bin/phpunit
```

### Code Coverage Report

```
```

---

## 🙌 Contributing

Contributions are welcome! Feel free to open issues or submit pull requests.

---

## 📫 Contact

If you have any questions or suggestions, feel free to reach out via [GitHub](https://github.com/yahvya).