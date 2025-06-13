<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

//custom
//defined('FROM_PHONE_NUMBER')   || define('FROM_PHONE_NUMBER', 174421629079556); // TESTING
//defined('WHATSAPP_ACCESS_TOKEN')   || define('WHATSAPP_ACCESS_TOKEN', "EAADjTjNOf98BO074Q0K1peIFoDHCasQP8RAXzft1RBpDDde76mfIovO9JmMhhS69nNPyiybPh2NMqXN0FyId9aoqej5ePC7aUFS8tDK1V3yanPE8lpBLk1ZBdOffgHYUxuQNXLZB3Ohp90qtisaDl3yr2yXTvMUaNTq5fhwqj5H5Cyah4qNEEev9ZCQKnfKZBFLIqB9CEoGEAutgbPoZD"); //TESTING

defined('FROM_PHONE_NUMBER')   || define('FROM_PHONE_NUMBER', 169426479586602); // LIVE
defined('WHATSAPP_ACCESS_TOKEN')   || define('WHATSAPP_ACCESS_TOKEN', "EAADjTjNOf98BO6xZAsgjp5euYZBm3uxddKi1eQAWZCed5ZBL7FiZCv4DHHiVvAXaUEZBfZCZB7YKmXkbGYaKKgvGMeZBNvubpcN5p6Uj0LRJSMjvsZCqkubU2OpyqrE8cnp45HXpLUx4ZC6PllcgghUu3ZAWIYUkLS3ZBM9t5rEpHnVijys2ogpOs8DEjmTA1qgOWxZAmD"); // LIVE

defined('WEBHOOK_VERIFY_TOKEN')   || define('WEBHOOK_VERIFY_TOKEN', 'e732aa139b63391d9a6bd7cbcf5b49e4');

defined('REF_EARN_AMOUNT')   || define('REF_EARN_AMOUNT', 1000);

defined('SITEKEY')                  || define('SITEKEY', '6Lc82JEpAAAAAN6fy2FTeiOvavSF4ZmridBiUgjU');
defined('SECRETKEY')                || define('SECRETKEY', '6Lc82JEpAAAAADkKB29S_VPrjsbStF0xm-FDlNrI');

define('SUBJECT_LOGO', [
    '669a35f991d365d61a43af0f' => 'speak-english.png',
    '6502e4739c3b25b8bb3c7c9e' => 'node.png',
    '6502e43e9c3b25b8bb3c7c9a' => 'angular.png',
    '6502e4269c3b25b8bb3c7c96' => 'js.png',
    '6502e40e9c3b25b8bb3c7c92' => 'css.png',
    '6502e3f59c3b25b8bb3c7c8e' => 'html.png',
    '6620a199742118c3cb901a33' => 'html.png',
    '661ca316742118c3cb901488' => 'html.png',
    '6544820f8ceaa77e9c2fe677' => 'ms-excel.png',
    '6566ce8b9132c5ab7f29241d' => 'ms-excel.png',
    '654482028ceaa77e9c2fe673' => 'ms-word.jpg',
    '6566ce7a9132c5ab7f292404' => 'ms-word.jpg',
    '654481f38ceaa77e9c2fe66f' => 'os.png',
    '6566ce689132c5ab7f292400' => 'os.png',
    '654481d48ceaa77e9c2fe66b' => 'funda.png',
    '6566ce569132c5ab7f2923f9' => 'funda.png',
]);
define('API_BASE_URL', 'https://career-boss.vercel.app/');
define('ERP_BASE_API', 'https://erp.webpanelsolutions.com/api/cbinstitute/');
