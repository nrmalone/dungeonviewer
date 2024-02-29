<?php require_once '../app/components/pageheader.php'; ?>

<!-- <div style="margin: auto; justify-content: center; max-width: 50%;"> -->
<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1>Account Creation</h1>
    <div class="signin-signup-Div" style="max-width: 100%; max-height: max-content;">
        <table style="display: flex;">        
            <form method="POST">
                <tr align="center">
                    <td><p style="display: inline; width: 25%;">Username: </p></td>
                    <td><input name="username" class="textField" type="text" required></td>
                </tr>
                <tr align="center">
                    <td><p style="display: inline; width: 25%;">Email: </p></td>
                    <td><input name="email" class="textField" type="email" required></td>
                </tr>
                <tr align="center">
                    <td><p style="display: inline; width: 25%;">Password: </p></td>
                    <td><input name="password" class="textField" type="password" required></td>
                </tr>
                <tr align="center">
                    <td><h5>*Username must be 4-16<br>
                            alphanumeric characters.<br>
                            Password cannot contain:<br>
                            \ &nbsp; / &nbsp; ' &nbsp; " &nbsp; , &nbsp; < &nbsp; > &nbsp; ! &nbsp; &
                    </h5></td>
                    <td><button style="background-color: #1E1E1E; color: white; border-radius: 10px 10px 10px 10px; padding: 5px 10px 5px 10px;" type="submit">Submit</button></td>
                </tr>
            </form>
        </table>
    </div>
</div>

<?php require_once '../app/components/pagefooter.php'; ?>