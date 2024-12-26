<?php
session_start();
include 'db.php'; // 데이터베이스 연결 파일

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 입력값 받아오기
    $username = trim($_POST['id']); // 사용자 아이디
    $email = trim($_POST['email']); // 이메일
    $password = trim($_POST['password']); // 비밀번호

    // 1. 유효성 검사
    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>alert('모든 필드를 채워주세요.'); history.back();</script>";
        exit;
    }

    // 2. 입력 길이 제한 검사
    if (strlen($username) > 50 || strlen($email) > 100 || strlen($password) > 255) {
        echo "<script>alert('입력값이 너무 깁니다. 다시 확인해주세요.'); history.back();</script>";
        exit;
    }

    // 3. 이메일 형식 확인
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('올바른 이메일 형식을 입력해주세요.'); history.back();</script>";
        exit;
    }

    try {
        // 4. 이메일 중복 체크
        $check_query = "SELECT id FROM users WHERE email = ?";
        $stmt = $conn->prepare($check_query);
        if (!$stmt) {
            throw new Exception("쿼리 준비에 실패했습니다: " . $conn->error);
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('이미 사용 중인 이메일입니다.'); history.back();</script>";
            exit;
        }

        // 5. 비밀번호 암호화
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // 6. 데이터 삽입
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            throw new Exception("쿼리 준비에 실패했습니다: " . $conn->error);
        }
        $stmt->bind_param('sss', $username, $email, $hashed_password);

        if ($stmt->execute()) {
            // 성공적으로 회원가입 완료
            echo "<script>alert('회원가입이 완료되었습니다. 로그인해주세요.'); location.href='membership.php?page=login';</script>";
        } else {
            throw new Exception("데이터 삽입에 실패했습니다.");
        }
    } catch (Exception $e) {
        // 예외 처리 및 에러 로그 기록
        error_log($e->getMessage());
        echo "<script>alert('서버 오류가 발생했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
    } finally {
        // 리소스 정리
        if (isset($stmt)) $stmt->close();
        $conn->close();
    }
}
?>
