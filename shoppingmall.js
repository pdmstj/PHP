document.addEventListener('DOMContentLoaded', () => {
    // 자동으로 스크롤되는 기능 추가
    const horizontalScroll = document.querySelector('.horizontal-scroll');

    let scrollLeft = 0;
    const scrollSpeed = 0.5; // 스크롤 속도

    const animateScroll = () => {
        scrollLeft += scrollSpeed;
        horizontalScroll.scrollTo(scrollLeft, 0);

        if (scrollLeft >= horizontalScroll.scrollWidth - horizontalScroll.clientWidth) {
            scrollLeft = 0;
        }

        requestAnimationFrame(animateScroll);
    };

    animateScroll();

    const products = {
        summer: [
            {src: "img/모어티 입술넥 여리핏 니트.gif", caption: "모어티 입술넥 여리핏 니트"},
            {src: "img/에센트 브이넥 썸머 린넨 가디건.gif", caption: "에센트 브이넥 썸머 린넨 가디건"},
            {src: "img/다이렌 스트랩 데님 반바지.gif", caption: "다이렌 스트랩 데님 반바지"},
            {src: "img/로엘리 앞셔링 하트넥 퍼프 2기장 도트 원피스.gif", caption: "로엘리 앞셔링 하트넥 도트 원피스"},
            {src: "img/루밍 바스락 롱원피스.gif", caption: "루밍 바스락 롱 원피스"},
            {src: "img/콜링 데일리 스트라이프 셔츠.gif", caption: "콜링 데일리 스트라이프 셔츠"},
            {src: "img/프렐린 세키크롭 골지 니트 가디건.gif", caption: "프렐린 세키크롭 골지 니트 가디건"},
            {src: "img/프레코 핀턱 코튼 플레어 롱 셔츠 원피스.gif", caption: "프레코 코튼 플레어 롱 셔츠 원피스"},
            {src: "img/이퓨 밴딩 플레어 치마 바지.gif", caption: "이퓨 밴딩 플레어 치마 바지"},
            {src: "img/르베르 코튼 레이스 뷔스티에 원피스.gif", caption: "르베르 코튼 레이스 뷔스티에 원피스"}
        ],
        resort: [
            {src: "img/나이브 데님 셔츠 원피스.gif", caption: "이브 데님 셔츠 원피스"},
            {src: "img/노브스트라이프 라운드넥 쿨링 긴팔 니트.gif", caption: "라운드넥 쿨링 긴팔 니트"},
            {src: "img/르주아 가디건 뷔스티에 플라워 롱 원피스.gif", caption: "르주아 가디건 플라워 롱 원피스"},
            {src: "img/리브엘 셔링 캉캉 미니 원피스.gif", caption: "리브엘 셔링 캉캉 미니 원피스"},
            {src: "img/센트 보트넥 슬릿 썸머 긴팔 니트.gif", caption: "센트 보트넥 슬릿 썸머 긴팔 니트"},
            {src: "img/셔버 투웨이 하트넥 수채화 반팔 원피스.gif", caption: "셔버 투웨이 하트넥 수채화 원피스"},
            {src: "img/아르덴 스모크 밴딩 플라워 뷔스티에 롱 원피스.gif", caption: "아르덴 스모크 밴딩 플라워 롱 원피스"},
            {src: "img/엔디 투웨이 롱 원피스.gif", caption: "엔디 투웨이 롱 원피스"},
            {src: "img/피버 린넨 반팔셔츠.gif", caption: "피버 린넨 반팔셔츠"},
            {src: "img/허쉬 브이넥 플라워 롱 원피스.gif", caption: "허쉬 브이넥 플라워 롱 원피스"},
        ],
        guest: [
            {src: "img/라네즈 트위드 배색 포켓 미니 원피스.gif", caption: "라네즈 트위드 배색 포켓 미니 원피스"},
            {src: "img/레이나 반팔 블라우스.gif", caption: "레이나 반팔 블라우스"},
            {src: "img/로렌 벨트 플레어 롱 여름 원피스.gif", caption: "로렌 벨트 플레어 롱 여름 원피스"},
            {src: "img/로에드 시스루 카라 블라우스.gif", caption: "로에드 시스루 카라 블라우스"},
            {src: "img/메이듀 투핀턱 주름 하프 슬랙스.gif", caption: "메이듀 투핀턱 주름 하프 슬랙스"},
            {src: "img/블론드 꼬임 캡소매 블라우스.gif", caption: "블론드 꼬임 캡소매 블라우스"},
            {src: "img/비비 트위드 반팔 여름 원피스.gif", caption: "비비 트위드 반팔 여름 원피스"},
            {src: "img/올데이 3기장 H라인 스커트.gif", caption: "올데이 3기장 H라인 스커트"},
            {src: "img/올데이 모먼트 핀턱 슬랙스.gif", caption: "올데이 모먼트 핀턱 슬랙스"},
            {src: "img/쫀쫀이 하트넥 원피스.gif", caption: "쫀쫀이 하트넥 원피스"}
        ],
        icepants: [
            {src: "img/넛츠 배색 스트링 핀턱 와이드 슬랙스.gif", caption: "넛츠 배색 스트링 핀턱 와이드 슬랙스"},
            {src: "img/누아 포멀 사이드 지퍼 숏 팬츠.gif", caption: "누아 포멀 사이드 지퍼 숏 팬츠"},
            {src: "img/라이튼 스트라이프 밴딩 반바지.gif", caption: "라이튼 스트라이프 밴딩 반바지"},
            {src: "img/벨로드 썸머 쿨링 세미 와이드 냉장고 밴딩 팬츠.gif", caption: "썸머 쿨링 와이드 냉장고 밴딩 팬츠"},
            {src: "img/솔티드 생지 데님 반바지.gif", caption: "솔티드 생지 데님 반바"},
            {src: "img/에이든 핀턱 숏 팬츠.gif", caption: "에이든 핀턱 숏 팬츠"},
            {src: "img/에이트 썸머 와샤 투핀턱 일자핏 슬랙스.gif", caption: "에이트 썸머 투핀턱 일자핏 슬랙스"},
            {src: "img/조인 핀턱 코튼 반바지.gif", caption: "조인 핀턱 코튼 반바지"},
            {src: "img/키츠 썸머 나일론 투웨이 밴딩 카고 팬츠.gif", caption: "썸머 나일론 투웨이 밴딩 카고 팬츠"},
            {src: "img/플루 찰랑 썸머 밴딩 팬츠.gif", caption: "플루 찰랑 썸머 밴딩 팬츠"}
        ]
    };

    // 태그 클릭 이벤트 처리
    const tags = document.querySelectorAll(".tag");
    const productGrid = document.getElementById("product-grid");

    tags.forEach(tag => {
        tag.addEventListener("click", function() {
            // 모든 태그에서 active 클래스 제거
            tags.forEach(t => t.classList.remove("active"));
            // 클릭된 태그에 active 클래스 추가
            this.classList.add("active");

            // 카테고리에 맞는 상품 표시
            const category = this.getAttribute("data-category");
            const selectedProducts = products[category];
            displayProducts(selectedProducts);
        });
    });

    function displayProducts(productList) {
        productGrid.innerHTML = "";
        productList.forEach(product => {
            const productDiv = document.createElement("div");
            productDiv.className = "product-item";

            const img = document.createElement("img");
            img.src = product.src;

            const caption = document.createElement("div");
            caption.className = "product-caption";
            caption.textContent = product.caption;

            productDiv.appendChild(img);
            productDiv.appendChild(caption);

            productGrid.appendChild(productDiv);
        });
    }

    // 초기 표시: 첫 번째 카테고리의 상품
    tags[0].click();
});
