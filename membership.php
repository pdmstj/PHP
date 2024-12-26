<?php
session_start();

// 로그인 여부 확인
$loggedIn = isset($_SESSION['user_id']);

// 현재 페이지 결정 (기본값: login)
$page = isset($_GET['page']) ? $_GET['page'] : ($loggedIn ? 'profile' : 'login');
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 및 로그인</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .container {
            flex-direction: column;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #c7877f;
        }

        .form-box {
            width: 88%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
            justify-content: center;
            align-items: center;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
            margin: 15px;
        }

        input {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #C7918A;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #cf7d72;
        }

        .toggle-link {
            margin-top: 20px;
            color: #cc7e76;
            cursor: pointer;
            text-align: center;
        }

        .toggle-link:hover {
            text-decoration: underline;
        }

        .find-links {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .find-links a {
            margin: 0 10px;
            color: #cc7e76;
            text-decoration: none;
            cursor: pointer;
        }

        .find-links a:hover {
            text-decoration: underline;
        }

        span {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php if ($page === 'profile' && $loggedIn): ?>
        <!-- 내 정보 화면 -->
        <div class="container">
        <h2>내 정보</h2>
        <p>이름: <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p>이메일: <?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8'); ?></p>
        
        <!-- 로그아웃 버튼 -->
        <button onclick="location.href='logout.php'">로그아웃</button>

        <!-- 돌아가기 버튼 -->
        <button onclick="location.href='shoppingmall.html'" style="margin-top: 10px;">돌아가기</button>
    </div>
    <?php elseif ($page === 'signup'): ?>
        <!-- 회원가입 화면 -->
        <div class="container">
            <h2>회원가입</h2>
            <form action="signup.php" method="post">
                <div class="form-box">
                    <label for="username">아이디</label>
                    <input type="text" id="username" name="username" required>

                    <label for="email">이메일</label>
                    <input type="email" id="email" name="email" required>

                    <label for="password">비밀번호</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">가입하기</button>
            </form>
            <span class="toggle-link" onclick="location.href='membership.php?page=login'">이미 계정이 있으신가요? 로그인</span>
        </div>
    <?php else: ?>
        <!-- 로그인 화면 -->
        <div class="container">
            <h2>로그인</h2>
            <form action="login.php" method="post">
                <div class="form-box">
                    <label for="username">아이디</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">비밀번호</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">로그인</button>
            </form>
            <div class="find-links">
                <a href="find_id.php">아이디 찾기</a> | 
                <a href="find_password.php">비밀번호 찾기</a>
            </div>
            <span class="toggle-link" onclick="location.href='membership.php?page=signup'">계정이 없으신가요? 회원가입</span>
        </div>
    <?php endif; ?>
</body>
</html>
