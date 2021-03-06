## 請解釋後端與前端的差異。
通常使用者所能夠觀看、操作到的網頁或應用程式介面，可稱之為前端。一般而言就是指網站本體或者是應用程式的操作介面，讓使用者能夠觀看伺服器欲呈現的資料，並進行互動。
當使用者送出請求(Request)後，網頁或程式會將參數往後傳到伺服器，由此之後(含伺服器)的邏輯運算、連結資料庫進行新刪修查都可稱之為後端，直到伺服器回傳(Response)資料，才又重回前端。
簡而言之，使用者所能夠接觸到的部分稱之為前端，反之負責進行運算與連結資料庫的部分則稱之為後端。

為此我們可以知道很明顯後端會主要負責商業邏輯運算，以及資料庫連結的部分，也就是一套系統的本體所在，通常也比較會是開發的重心所在。
但這不代表前端就不重要，因為前端才是使用者接觸到的部分，若前端設計不良，導致使用者無法順暢操作，那無論你的後端寫的再怎麼厲害，也只會收到糟糕的使用者回饋。

## 假設我今天去 Google 首頁搜尋框打上：JavaScript 並且按下 Enter，請說出從這一刻開始到我看到搜尋結果為止發生在背後的事情。
1. 瀏覽器將搜尋框內的字串 JavaScript 作為參數，連同使用者資料等包裝成封包送出 Request ，由後端的伺服器進行接收。
2. 伺服器接收到 Request 並將其傳送過來的封包後，送至其餘邏輯運算單元或資料庫單元做進一步封包驗證、演算法運行或資料檢索等處理。
3. 伺服器取得其餘單元所回傳的結果資料，重新將其包裝成封包並發送 Response 回傳至使用者的瀏覽器。
4. 瀏覽器同樣會先進行驗證檢查封包的正確性，並將將網頁重新導向至呈現搜尋結果的頁面。
5. 最後則是瀏覽器會將結果頁面的原始碼，轉換為使用者所看到的圖形化介面。  

## 請列舉出 5 個 command line 指令並且說明功用
- ls 
列出當前所在位置的檔案清單，常用參數為 -al 可以顯示出較詳細的檔案資訊及隱藏檔案

- cd <資料夾名 / 絕對路徑>  
用來切換位置所使用，輸入資料夾名稱則會進入該層目錄；輸入 .. 則是返回上一層；除了資料夾名稱外，也可以輸入絕對路徑進行移動。

- rm <檔案名>
用來移除檔案，常用參數為 -r 可以將資料夾也進行移除。

- mkdir <資料夾名>
用來新增資料夾所使用

- mv <檔案名> <資料夾名 / 絕對路徑>
將檔案移動到指定的資料夾內；若指定的資料夾名不存在，則會將檔案名稱改名為後面的資料夾名，故亦可作為檔案改名用途。
