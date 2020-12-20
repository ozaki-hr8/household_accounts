<!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>大学生の夏休み家計簿</title>
  </head>

  <div id="header">
    <div id="header-container">
      <div class="header-inner-container">
           <h1 class="logo"><img class="logo-image" src="moneybook_logo.png"></h1>
      </div>
    </div>
  </div>

  <body>
    <form method="post" action="moneybook2.php">
    現在の総資産を入力<br>
    <input type="text" name="allmoney">円<br>
    <input type="button" onclick="history.back()" value="戻る" class="nav">
    <input type="submit" value="次へ" class="nav">
  </form>
  </body>
</html>
