<!DOCTYPE html>
<html>
    <head>
        <title><?=$data['title_page']?></title>
    </head>
    <body>
        <form method="POST">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" maxlength=16 required>
            <br />
            <label for="email">Email</label>
            <input id="email" name="email" type="email" required>
            <br />
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>
            <br />
            <button type="submit">Submit</button>
        </form>
    </body>
</html>