<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Cache-Control" content="max-age=900 , must-revalidate">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $data['title_page']?></title>

        <link rel="stylesheet" href="<?=ROOT?>css/styles.css">
    </head>
    <body>
        <header>            
            <h1 id="homeLinkText"><a class="headerLink" href="<?=ROOT?>">Dungeon Viewer</a></h1>
            <?php if (isset($_SESSION['username'])) {
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'campaign">Campaigns</a></h2>';
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'character">Characters</a></h2>';
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'account">Account</a></h2>';
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'account/signout">Sign Out</a></h2>';
            } else {
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'account/signin">Sign In</a></h2>';
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'account/signup">Create Account</a></h2>';                
            }?>
        </header>
        <main>