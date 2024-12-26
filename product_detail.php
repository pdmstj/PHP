<?php
require_once 'db.php';

// 상품 ID 가져오기
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 데이터베이스에서 해당 상품 정보 조회
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "상품 정보를 찾을 수 없습니다.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - 상세 페이지</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .product-detail {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }
        .product-image {
            flex: 1 1 500px;
            text-align: center;
        }
        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .product-info {
            flex: 1 1 500px;
        }
        .product-info h1 {
            font-size: 2rem;
            color: #333;
        }
        .product-price {
            font-size: 1.8rem;
            color: #d9534f;
            margin: 10px 0;
            font-weight: bold;
        }
        .original-price {
            font-size: 1rem;
            text-decoration: line-through;
            color: #999;
        }
        .discount-rate {
            color: #ff6b6b;
            font-size: 1.2rem;
            margin-left: 10px;
            font-weight: bold;
        }
        .product-description {
            margin: 20px 0;
            line-height: 1.6;
            color: #555;
        }
        .actions {
            display: flex;
            gap: 10px;
            margin: 20px 0;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .buy-now-button {
            font-weight: bold;
            flex: 1;
            background-color: #D8A69D;
            color: white;
        }
        .buy-now-button:hover {
            background-color: #C7918A;
        }
        .add-to-cart-button {
         
        }
        .add-to-cart-button:hover {
            
        }
        .back-link {
            margin-top: 30px;
            display: inline-block;
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .option-select {
            margin: 20px 0;
        }
        .option-select select {
            padding: 10px;
            width: 100%;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .like-button{

        }

    </style>
</head>
<body>
    <div class="container">
        <div class="product-detail">
            <!-- 상품 이미지 -->
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>

            <!-- 상품 정보 -->
            <div class="product-info">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="original-price"><?php echo number_format($product['original_price']); ?>원</p>
                <p class="product-price">
                    <?php echo number_format($product['price']); ?>원
                    <span class="discount-rate"><?php echo $product['discount_rate']; ?>%</span>
                </p>
                <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>

                <!-- 옵션 선택 -->
                <div class="option-select">
                    <label for="option">옵션 선택</label>
                    <select id="option" name="option">
                        <option value="option1">옵션 1</option>
                        <option value="option2">옵션 2</option>
                        <option value="option3">옵션 3</option>
                    </select>
                </div>

                <!-- 버튼 -->
                <div class="actions">
                    <button class="like-button">❤ 좋아요</button>
                    <button class="add-to-cart-button">🛒 장바구니</button>
                    <button class="buy-now-button">💳 바로 구매</button>
                </div>
                <a href="shoppingmall.html" class="back-link">목록으로 돌아가기</a>
            </div>
        </div>
    </div>
</body>
</html>
