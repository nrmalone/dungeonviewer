<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1>Account info for <?= $_SESSION['username'] ?></h1>
    <div class="accountDiv">
        <table>
            <tr>
                <td>Email: </td>
                <td><?= $_SESSION['email'] ?></td>
                <td><a>Edit</a></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><?= $_SESSION['username'] ?></td>
                <td><a>Edit</a></td>
            </tr>
            <tr>
                <td></td>
                <td><a style="background-color: #1E1E1E; color: white; border-radius: 10px 10px 10px 10px; padding: 5px 10px 5px 10px;">Delete Account</a></td>
                <td></td>
            </tr>
        </table>
    </div>
</div>