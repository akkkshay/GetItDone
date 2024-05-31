<?php 
include('config/constants.php');
?>
<html>
    <head>
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>

        <title>Task Manager with PHP and MySQL</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
    </head>
    <body>
        <div class="wrapper">
        <h1>GetItDone</h1>
        <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
        <h3>Manage Lists Page</h3>
        <p>
            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['delete_fail']))
                {
                    echo $_SESSION['delete_fail'];
                    unset($_SESSION['delete_fail']);
                }
            ?>
        </p>
        <div class="all-lists">
            <a class="btn-primary" href="<?php echo SITEURL; ?>add-list.php">Add List</a>
            <table class="tbl-half">
                <tr>
                    <th>S.N.</th>
                    <th>List Name</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                    $sql = "SELECT * FROM tbl_lists";
                    $res = mysqli_query($conn, $sql);
                    if($res==true)
                    {
                        $count_rows = mysqli_num_rows($res);
                        $sn = 1;
                        if($count_rows>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $list_id = $row['list_id'];
                                $list_name = $row['list_name'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $list_name; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>update-list.php?list_id=<?php echo $list_id; ?>">Update</a> 
                                        <a href="<?php echo SITEURL; ?>delete-list.php?list_id=<?php echo $list_id; ?>">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="3">No List Added Yet.</td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </table>
        </div>
        </div>
    </body>
</html>