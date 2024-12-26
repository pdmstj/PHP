<?php
session_start();
include 'db.php'; // 데이터베이스 연결 파일

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 입력값 받아오기
    $username = trim($_POST['username']); // 아이디 입력값
    $password = trim($_POST['password']); // 비밀번호 입력값

    // 유효성 검사
    if (empty($username) || empty($password)) {
        echo "<script>alert('아이디와 비밀번호를 입력해주세요.'); history.back();</script>";
        exit;
    }

    try {
        // 사용자 조회
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            throw new Exception("쿼리 준비 실패: " . $conn->error);
        }

        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // 비밀번호 검증
            if (password_verify($password, $user['password'])) {
                // 세션에 사용자 정보 저장
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email']; // 필요한 경우 이메일도 저장

                // 리다이렉트
                echo "<script>alert('로그인 성공!'); location.href='membership.php?page=profile';</script>";
                exit;
            } else {
                echo "<script>alert('잘못된 비밀번호입니다.'); history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('등록되지 않은 아이디입니다.'); history.back();</script>";
            exit;
        }
    } catch (Exception $e) {
        error_log($e->getMessage()); // 에러 로그 기록
        echo "<script>alert('서버 오류가 발생했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
        exit;
    } finally {
        $stmt->close();
        $conn->close();
    }
}
?>
