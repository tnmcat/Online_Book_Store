<?php
    #1. Kết nối CSDL
    include_once '../../db/DBConnect.php';

    $return = '';
    #2. Thực hiện query
    if(isset($_POST["query"])){
        $search = mysqli_real_escape_string($conn, $_POST["query"]);
        $query = "select * from feedback where "
                . "feedback_id like '%{$search}%' or "
                . "book_id like '%{$search}%'";      
    }
    else{
            $query = "select * from feedback";
    }
    $rs = mysqli_query($conn, $query);
    if(mysqli_num_rows($rs) > 0){
            $return .='
            <table class="table table-hover table-bordered">
                <tr>
                  <th>ID</th>
                  <th>Book ID</th>
                  <th>Customer</th>
                  <th>Rating</th>
                  <th>Content</th>
                  <th>Detail ID</th>
                </tr>';
            while($data = mysqli_fetch_array($rs)){
                    $return .= '
                    <tr>
                    <td>' . $data[0] . '</td>
                    <td>' . $data[1] . '</td>
                    <td>' . $data[3] . '</td>
                    <td>' . $data[2] . '</td>
                    <td>' . $data[1] . '</td>
                    <td>' . $data[4] . '</td>
                    </tr>';
            }
            echo $return;
            }
    else{
            echo 'Record not found!';
    }

