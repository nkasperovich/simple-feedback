<?php
if (isset($_POST['save']) && $_POST['action'] == 'save_settings') {

    $mail_host = htmlspecialchars($_POST['mail_host']);
    $host_port = htmlspecialchars($_POST['host_port']);
    $host_user = htmlspecialchars($_POST['host_user']);
    $host_pass = htmlspecialchars($_POST['host_pass']);

    try {
        global $wpdb;
        $table_name = $wpdb->prefix . 'feedback_settings';
        $wpdb->insert($table_name, array(
            'mail_host' => $mail_host,
            'host_port' => $host_port,
            'host_user' => $host_user,
            'host_pass' => $host_pass
        ));
        echo 'Settings saved';
    } catch (Exception $e) {
        echo $e;
    }

} elseif (isset($_POST['delete_subject'])) {
    $id = $_POST['delete_subject_id'];
    $table_name = $wpdb->prefix . 'subjects';

    try {
        $wpdb->delete($table_name, array('id' => $id));
        echo 'Subject deleted';
    } catch (Exception $e) {
        echo $e;
    }
}
else { ?>
<div class="wrap">
    <h1>Plugin Settings</h1>
    <form method="post" action="" name="settings" enctype="multipart/form-data">
        <table >
            <tbody>
            <tr>
                <th>
                    <label for="mail_host">SMTP HOST</label>
                </th>
                <td>
                    <input type="text"  name="mail_host">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="host_port">Port</label>
                </th>
                <td>
                    <input type="text"  name="host_port">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="host_user">Username</label>
                </th>
                <td>
                    <input type="text"  name="host_user">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="host_pass">Password</label>
                </th>
                <td>
                    <input type="text"  name="host_pass">
                </td>
            </tr>
            </tbody>
        </table>
        <input type="hidden" name="action" value="save_settings"/>
        <input type="submit" name="save" class="button button-primary" value="Save settings">
    </form>
</div>
<?php }