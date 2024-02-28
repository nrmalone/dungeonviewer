<?php require_once '../app/components/pageheader.php'; ?>

<!-- <div style="margin: auto; justify-content: center; max-width: 50%;"> -->
<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1>Account Creation</h1>
    <div class="signin-signup-Div" style="max-width: 100%; height: 120px;">
        <form>
            <table style="display: flex;">
                <tr align="center">
                    <td><p style="display: inline; width: 25%;">Username: </p><input id="username" class="textField" type="text" required placeholder="4-16 alphanumeric chars"></td>
                </tr>
                <tr align="center">
                    <td><p style="display: inline; width: 25%;">Email: </p><input id="email" class="textField" type="email" required></td>
                </tr>
                <tr align="center">
                    <td><p style="display: inline; width: 25%;">Password: </p><input id="password" class="textField" type="password" required></td>
                </tr>
                <tr align="center">
                    <td><button style=" background-color: #1E1E1E; color: white; border-radius: 10px 10px 10px 10px; padding: 5px 10px 5px 10px;" type="submit">Submit</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php require_once '../app/components/pagefooter.php'; ?>