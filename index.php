<?php
require_once ('vendor/autoload.php');
require_once ('database.php');
require_once ('Controller.php');
use Monolog\Logger;
use Monolog\Handler\StreamHandler;



//add new record to DB
$addRecord = setCredentials($link);


$params = getCredentials($link);


$arParams['B24_APPLICATION_ID'] = 'local.60ed80d9614835.27511525';
$arParams['B24_APPLICATION_SECRET'] = 'U6rRlmPauD7aslSHRASw8mASGKWKLdDtm9JeRyNVNbdb6mXBm3';
$arParams['B24_APPLICATION_SCOPE'] = array('user');

// create a log channel
$log = new Logger('bitrix24');
$log->pushHandler(new StreamHandler('path/to/your.log', Logger::DEBUG));

// init lib
$obB24App = new \Bitrix24\Bitrix24(false, $log);
$obB24App->setApplicationScope($arParams['B24_APPLICATION_SCOPE']);
$obB24App->setApplicationId($arParams['B24_APPLICATION_ID']);
$obB24App->setApplicationSecret($arParams['B24_APPLICATION_SECRET']);

// set user-specific settings
$obB24App->setDomain($params[0]['DOMAIN']);
$obB24App->setMemberId($params[0]['member_id']);
$obB24App->setAccessToken($params[0]['AUTH_ID']);
$obB24App->setRefreshToken($params[0]['REFRESH_ID']);

// get information about current user from bitrix24
$obB24User = new \Bitrix24\User\User($obB24App);
$arCurrentB24User = $obB24User->get('', '', '');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Список сотрудников</title>
</head>
<body>
    <table class="table">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Имя</th>
            <th scope="col">Фамилия</th>
            <th scope="col">Email</th>
            <th scope="col">Дата рождения</th>
        </tr>
        <? foreach ($arCurrentB24User['result'] as $value){?>
        <tr>
            <td><?echo $value['ID']?></td>
            <td><?echo $value['NAME']?></td>
            <td><?echo $value['LAST_NAME']?></td>
            <td><?echo $value['EMAIL']?></td>
            <td>
                <?
                    if (strlen($value['PERSONAL_BIRTHDAY']) != 0)
                    {
                    echo date('d-m-Y', strtotime($value['PERSONAL_BIRTHDAY']));
                    }
                ?>
            </td>
        </tr>
        <? }?>
    </table>
</body>
</html>
