## 什麼是 DOM？
全名為 Document Object Model，一個 HTML 檔案可解析為一個 DOM 物件，程式設計師可以透過 JavaScirpt 操作 DOM 物件，並以此改變網頁的呈現結果，達到動態網頁的效果。

## 什麼是 Ajax？
全名為 Asynchronous JavaScript and XML，主要功用為讓瀏覽器透過 Web API 可以不用進行換頁就能夠與伺服器進行溝通。
其回傳值通常不會是一個完整的網頁而是資料內容。

## HTTP method 有哪幾個？有什麼不一樣？
1. GET：用於向伺服器取得資料。

2. POST：從用戶端將資料送交至伺服器。

3. PATCH：用於更改資料，僅更改需要異動的值。

4. PUT：同樣用於更改資料，但會將整個資料取代成更新後的資料，可以理解為使用 Replace 去更新資料。
PATCH、PUT 舉例像是一台汽車要更換擋風玻璃，PATCH 的話就只會把擋風玻璃換掉；PUT 則會是把一台已經換好擋風玻璃的新車給你。

5. DELETE：刪除資料。

6. OPTIONS：回傳伺服器所支援 method 清單。

7. HEAD：類似於 GET 但回傳的資料不會包含 body 的內容。

## `GET` 跟 `POST` 有哪些區別，可以試著舉幾個例子嗎？
1. GET 會將傳遞參數放至 url 中，故可以直接在瀏覽器的網址列上看到傳遞參數內容，因此一般不會將敏感性內容使用 GET 進行傳遞。
2. POST 會將傳遞參數放置 body 中，故使用者沒有辦法直接看到瀏覽器送出的參數內容。
舉例而言，使用 google 進行搜尋，就是使用 GET 所以你在搜尋完後會看到網址列有所改變。但如果是要登入會員，就會使用 POST 去傳遞資料，所以不會在網址列上看到你的會員帳號密碼。

## 什麼是 RESTful API？
一種 Web API 設計架構，會充分使用到 HTTP method 所有內容，讓使用者操作上會比較直覺且簡潔。

## JSON 是什麼？
一種資料格式，一般用於網頁資料傳遞、交換上。單一筆資料的呈現方式為 key : vlaue；一個物件的呈現方式為 { key1:value, key2:value }；陣列呈現方式為 [ value1, value2 ]。

## JSONP 是什麼？
全名為 JSON with padding，主要用於避免 Same-origin policy 的狀況，可以取得到其他網域的資料。

## 要如何存取跨網域的 API？
利用 <script> 的 src 去載入不同網域的 js 資料，但只能搭配 GET method 使用。