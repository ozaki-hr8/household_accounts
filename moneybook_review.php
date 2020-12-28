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
    $finalmoney=$_POST['finalmoney'];
    $want1date=$_POST['want1date'];
    $want1=$_POST['want1'];
    $want1ex=$_POST['want1ex'];
    $want2date=$_POST['want2date'];
    $want2=$_POST['want2'];
    $want2ex=$_POST['want2ex'];
    print '<form method="post" action="moneybook6.php" class="review">';
    print '現在の総資産を入力<br>';
    print '<input type="text" name="allmoney" value="'.$allmoney.'">円<br>';
    print '<hr class="border"></border>';
    print '毎月の収入を入力<br>';
    print '<input type="text" name="income" value="'.$income.'">円<br>';
    print '<hr class="border"></border>';
    print'毎月かかる必要最低限の支出を入力<br>';
    print '<div class="list3">';
    print'食費<input type="text" name="food" class="multi" value="'.$food.'">円<br>';
    print'日用品<input type="text" name="dn" class="multi" value="'.$dn.'">円<br>';
    print'固定費<input type="text" name="expense" class="multi" value="'.$expense.'">円<br>';
    print '</div>';
    print '<hr class="border"></border>';
    print'夏休みが終わったら何円残しておきたい？<br>';
    print'<input type="text" name="finalmoney" value="'.$finalmoney.'">円<br>';
    print '<hr class="border"></border>';
    print '夏休みにやりたいこと、欲しいもの<br><br><br>';
    print '日程&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;内容&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp費用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>';
    print '<div class="list5">';
    print'<input type="text" name="want1date" class="multi5" value="'.$want1date.'">:<input type="text" name="want1" class="multi5" value="'.$want1.'">:<input type="text" name="want1ex" class="multi5" value="'.$want1ex.'">円<br>';
    print'<input type="text" name="want2date" class="multi5" value="'.$want2date.'">:<input type="text" name="want2" class="multi5" value="'.$want2.'">:<input type="text" name="want2ex" class="multi5" value="'.$want2ex.'">円<br>';
    print '</div>';
    print '<input type="button" onclick="history.back()" value="戻る" class="nav">';
    print '<input type="submit" value="次へ" class="nav">';
    print '</form>';
    ?>
  </body>
</html>
