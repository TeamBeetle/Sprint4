<?php
require '/home/teambeet/dbConnect.php';

$receivedValue = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receivedValue = $_POST['hidden-value'];
}

$sql3 = "SELECT * FROM user_data WHERE uid = '$receivedValue'";
$result = @mysqli_query($cnxn, $sql3);
while ($row = mysqli_fetch_assoc($result))
{
    $uid = $row['uid'];
    $name = $row['user_name'];
    $email = $row['user_email'];
    $cohort = $row['user_cohort'];
    $user_seeking_internship = $row['user_seeking_internship'];
    $user_seeking_job = $row['user_seeking_job'];
    $user_not_seeking = $row['user_not_seeking'];
    $user_interest = $row['user_interest'];
    $user_admin_status = $row['user_admin_status'];
}


// Queries
$sql_check_permission_level = "SELECT user_admin_status FROM user_data WHERE uid = $receivedValue;";
$sql_get_user_data = "SELECT * FROM user_data WHERE uid=$receivedValue;";
$sql_make_admin = "UPDATE user_data SET user_admin_status = 1 WHERE uid = $receivedValue;";
$sql_remove_admin = "UPDATE user_data SET user_admin_status = 0 WHERE uid = $receivedValue;";

// query to check and save the current admin status
$current_permission_query = @mysqli_query($cnxn, $sql_check_permission_level);

$permission_column = @mysqli_fetch_assoc($current_permission_query);

$current_permission_level = $permission_column['user_admin_status'];

if ($current_permission_level == 1) {
    @mysqli_query($cnxn, $sql_remove_admin);
    echo "
            <html lang='en'>
                <head>
                    <link href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity = 'sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN'crossorigin='anonymous'>
                    <link href='style.css' rel='stylesheet' type='text/css'/>
                </head>
                <body class='receiptPageBody'>
                    <nav id='background' class='navbar navbar-expand-md  navbar-dark'>

                        <img id='grc-logo' class='navbar-brand'  src='images/GRC Logo.png'>
                        <button class='navbar-toggler' type='button' data-toggle='collapse'
                            data-target='#collapsibleNavbar'>
                            <span class='navbar-toggler-icon'></span>
                        </button>
    
                        <div class='collapse navbar-collapse links' id='collapsibleNavbar'>

                            <ul class='navbar-nav links'>
                                <li class='nav-item'>
                                    <a class='nav-link' href='index.php'>Dashboard</a>
                                </li>
                                <li class='navbar-nav links'>
                                    <a class='nav-link' href='admin-page.php'>Admin</a>
                                </li>
                            </ul>
                        </div>
                        <div id='toggleContainer' class='col-2'>
                            <button type='button' class='btn toggle active-mode btn-light'>Light</button>
                            <button type='button' class='btn toggle btn-dark'>Dark</button>
                        </div>
                    </nav>  
                    
                    <div class='receiptPage'>
                        <h1>The user '$name' has been removed as Admin</h1>
                        <h3>User-ID: $uid</h3>
 
                           <table id='receiptPageTable'>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Name</td>
                              <td class='receiptPageData'>$name</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Email</td>
                              <td class='receiptPageData'>$email</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Cohort Number</td>
                              <td class='receiptPageData'>$cohort</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Seeking1</td>
                              <td class='receiptPageData'>$user_seeking_internship</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Seeking2</td>
                              <td class='receiptPageData'>$user_seeking_job</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Seeking3</td>
                              <td class='receiptPageData'>$user_not_seeking</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Fields of interest</td>
                              <td class='receiptPageData'>$user_interest</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Permissions</td>
                              <td class='receiptPageData'>Admin -> User</td>
                            </tr>
                          </table>
   
                     </div>
                </body>
            </html> 
        ";
} elseif ($current_permission_level == 0) {
    @mysqli_query($cnxn, $sql_make_admin);
    echo "
            <html lang='en'>
                <head>
                    <link href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity = 'sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN'crossorigin='anonymous'>
                    <link href='style.css' rel='stylesheet' type='text/css'/>
                </head>
                <body class='receiptPageBody'>
                    <nav id='background' class='navbar navbar-expand-md  navbar-dark'>

                        <img id='grc-logo' class='navbar-brand'  src='images/GRC Logo.png'>
                        <button class='navbar-toggler' type='button' data-toggle='collapse'
                            data-target='#collapsibleNavbar'>
                            <span class='navbar-toggler-icon'></span>
                        </button>
    
                        <div class='collapse navbar-collapse links' id='collapsibleNavbar'>

                            <ul class='navbar-nav links'>
                                <li class='nav-item'>
                                    <a class='nav-link' href='index.php'>Dashboard</a>
                                </li>
                            </ul>
                        </div>
                        <div id='toggleContainer' class='col-2'>
                            <button type='button' class='btn toggle active-mode btn-light'>Light</button>
                            <button type='button' class='btn toggle btn-dark'>Dark</button>
                        </div>
                    </nav>  
                    
                    <div class='receiptPage'>
                        <h1>The user '$name' has been added as Admin</h1>
                        <h3>User-ID: $uid</h3>
 
                           <table id='receiptPageTable'>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Name</td>
                              <td class='receiptPageData'>$name</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Email</td>
                              <td class='receiptPageData'>$email</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Cohort Number</td>
                              <td class='receiptPageData'>$cohort</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Seeking1</td>
                              <td class='receiptPageData'>$user_seeking_internship</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Seeking2</td>
                              <td class='receiptPageData'>$user_seeking_job</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Seeking3</td>
                              <td class='receiptPageData'>$user_not_seeking</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Fields of interest</td>
                              <td class='receiptPageData'>$user_interest</td>
                            </tr>
                            <tr class='receiptPageRow'>
                              <td class='receiptPageData'>Permissions</td>
                              <td class='receiptPageData'>User -> Admin</td>
                            </tr>
                          </table>
   
                     </div>
                </body>
            </html> 
        ";
}
?>