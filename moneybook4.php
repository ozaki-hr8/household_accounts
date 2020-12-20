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
    $food=$_POST['food'];
    $dn=$_POST['dn'];
    $expense=$_POST['expense'];
    print'<form method="post" action="moneybook5.php">';
    print '<input type="hidden" name="allmoney" value="'.$allmoney.'">';
    print '<input type="hidden" name="income" value="'.$income.'">';
    print '<input type="hidden" name="food" value="'.$food.'">';
    print '<input type="hidden" name="dn" value="'.$dn.'">';
    print '<input type="hidden" name="expense" value="'.$expense.'">';
    print'夏休みが終わったら何円残しておきたい？<br>';
    print'<input type="text" name="finalmoney">円<br>';
    print '<input type="button" onclick="history.back()" value="戻る" class="nav">';
    print '<input type="submit" value="次へ" class="nav">';
    print'</form>';
    ?>
  </body>
</html>
