<!DOCTYPE html>
<html>
    <head>
        <title><?=$data['title_page']?></title>
    </head>
    <body>
        <h1>Username: <?=$data['user'][0]->username?></h1>
        <h1>Email: <?=$data['user'][0]->userEmail?></h1>
        <h1>Hashed Password: <?=$data['user'][0]->userPassword?></h1>
    </body>
</html>