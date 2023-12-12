<?php
use CodeIgniter\HTTP\RequestInterface;
use \Config\Database;


/**
 * @author Pritam Khan  <pritamkhanofficial@gmail.com>
 * @return array
 */

function getUserList(){
    $db = Database::connect();
    $sql = "SELECT
                u.id,
                me.*
            FROM
                users u
                LEFT JOIN master_employee me ON me.id=u.emp_id
            WHERE
                u.blocked = 0 AND u.row_status = 1 AND me.row_status = 1";
    return  $db->query($sql)->getResult();
}
?>