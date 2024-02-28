<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $data['title_page']?></title>

        <link rel="stylesheet" href="<?= ROOT?>css/styles.css">
    </head>
    <body>
        <header>            
            <h1 id="homeLinkText"><a class="headerLink" href="<?=ROOT?>">DND Viewer</a></h1>
            <?php if (isset($_SESSION['user_name'])) {
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'campaign" target="_blank">Campaigns</a></h2>';
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'character" target="_blank">Characters</a></h2>';
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'user" target="_blank">Account</a></h2>';
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'user/signout">Sign Out</a></h2>';
            } else {
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'user/signin">Sign In</a></h2>';
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'user/signup">Create Account</a></h2>';                
            }
            ?>
        </header>