<?php 
    $data = $_POST;
    $user_id = (int) $data['userId'];
    $first_name = $data['f_name'];
    $last_name = $data['l_name'];
    $email = $data['email'];


    try{
        $sql = "UPDATE users SET email=?, first_name=?, last_name=?, update_at=? WHERE id=?";
        include('connection.php');

        $conn->prepare($sql)->execute([$email, $first_name, $last_name, date('Y-m-d H:i:s'), $user_id]);
       
        echo json_encode([
            'success' => true,
            'message' => $first_name . ' ' . $last_name . ' cập nhật thành công.'
        ]);
    } catch (PDOException $e){
        echo json_encode([
            'success' => false,
            'message' => 'Lỗi trong quá trình xử lý yêu cầu của bạn!'
        ]);
    }
?>