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
    $income=$_POST['income'];
    print'<form method="post" action="moneybook4.php">';
    print '<input type="hidden" name="allmoney" value="'.$allmoney.'">';
    print '<input type="hidden" name="income" value="'.$income.'">';
    print'毎月かかる必要最低限の支出を入力<br>';
    print '<div class="list3">';
    print'食費<input type="text" name="food" class="multi">円<br>';
    print'日用品<input type="text" name="dn" class="multi">円<br>';
    print'固定費<input type="text" name="expense" class="multi">円<br>';
    print '</div>';
    print '<input type="button" onclick="history.back()" value="戻る" class="nav">';
    print '<input type="submit" value="次へ" class="nav">';
    print'</form>';
    ?>
  </body>
</html>
