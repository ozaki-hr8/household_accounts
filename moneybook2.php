<!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>大学生の夏休み家計簿</title>
  </head>

  <div id="header">
    <div id="header-container">
      <header class="header-inner-container">
           <h1 class="logo"><img class="logo-image" src="moneybook_logo.png"></h1>
      </header>
    </div>
  </div>

  <body>
    <?php
    $allmoney=$_POST['allmoney'];
    print '<form method="post" action="moneybook3.php">';
    print '<input type="hidden" name="allmoney" value="'.$allmoney.'">';
    print '毎月の収入を入力<br>';
    print '<input type="text" name="income">円<br>';
    print '<input type="button" onclick="history.back()" value="戻る" class="nav">';
    print '<input type="submit" value="次へ" class="nav">';
    print '</form>';
    ?>
  </body>
</html>
