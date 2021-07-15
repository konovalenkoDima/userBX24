<?php
    $json = json_encode($_REQUEST);
    $file = fopen('credentials.json', 'w+');
    fwrite($file, $json);
    fclose($file);


    ?>
<head>
    <script src="//api.bitrix24.com/api/v1/"></script>
    <script>
        console.log('test');
        BX24.init(function (){
            BX24.installFinish();
        })
    </script>
</head>
<body>
    <? echo '<h3> Данные записаны! <h3>'; ?>
</body>