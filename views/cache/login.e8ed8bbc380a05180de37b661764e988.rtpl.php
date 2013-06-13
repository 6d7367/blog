<?php if(!class_exists('raintpl')){exit;}?><div>
    <form action='/admin/login' method='post'>
        <table>
            <tr>
                <td>
                    Login:
                </td>
                <td>
                    <input type='text' name='login'>
                </td>
            </tr>
            <tr>
                <td>
                    Password:
                </td>
                <td>
                    <input type='text' name='password'>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type='submit' value='Login' name='login_btn'/>
                </td>
            </tr>
        </table>
    </form>
</div>