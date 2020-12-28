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
   // タイムゾーンを設定
   date_default_timezone_set('Asia/Tokyo');

   // 前月・次月リンクが押された場合は、GETパラメーターから年月を取得
   if (isset($_GET['ym'])) {
       $ym = $_GET['ym'];
   } else {
       // 今月の年月を表示
       $ym = date('Y-m');
   }

   // タイムスタンプを作成し、フォーマットをチェックする
   $timestamp = strtotime($ym . '-01');
   if ($timestamp === false) {
       $ym = date('Y-m');
       $timestamp = strtotime($ym . '-01');
   }

   // 今日の日付 フォーマット　例）2018-07-3
   $today = date('Y-m-j');

   $dsn='mysql:dbname=moneybook;host=localhost;charset=utf8';
   $user='root';
   $password='';
   $dbh=new PDO($dsn,$user,$password);
   $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

   $sql='SELECT allmoney,income,food,dn,expense,finalmoney,want1date,want1,want1ex,want2date,want2,want2ex,rest,other,wallet FROM moneybook_user WHERE date=?';
   $stmt=$dbh->prepare($sql);
   $data[]=$today;
   $stmt->execute($data);

   $rec=$stmt->fetch(PDO::FETCH_ASSOC);
   $allmoney=$rec['allmoney'];
   $income=$rec['income'];
   $food=$rec['food'];
   $dn=$rec['dn'];
   $expense=$rec['expense'];
   $finalmoney=$rec['finalmoney'];
   $want1date=$rec['want1date'];
   $want1=$rec['want1'];
   $want1ex=$rec['want1ex'];
   $want2date=$rec['want2date'];
   $want2=$rec['want2'];
   $want2ex=$rec['want2ex'];
   $other=$rec['other'];
   $rest=$rec['rest'];
   $wallet=$rec['wallet'];

   $dbh=null;

   // カレンダーのタイトルを作成　例）2017年7月
   $html_title = date('Y年n月', $timestamp);

   // 前月・次月の年月を取得
   // 方法１：mktimeを使う mktime(hour,minute,second,month,day,year)
   $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
   $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

   // 方法２：strtotimeを使う
   // $prev = date('Y-m', strtotime('-1 month', $timestamp));
   // $next = date('Y-m', strtotime('+1 month', $timestamp));

   // 該当月の日数を取得
   $day_count = date('t', $timestamp);

   // １日が何曜日か　0:日 1:月 2:火 ... 6:土
   // 方法１：mktimeを使う
   $youbi = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
   // 方法２
   // $youbi = date('w', $timestamp);


   // カレンダー作成の準備
   $weeks = [];
   $week = '';

   // 第１週目：空のセルを追加
   // 例）１日が水曜日だった場合、日曜日から火曜日の３つ分の空セルを追加する
   $week .= str_repeat('<td></td>', $youbi);

   for ( $day = 1; $day <= $day_count; $day++, $youbi++) {

       // 2017-07-3
       $date = $ym . '-' . $day;

       if ($date == $today) {
           // 今日の日付の場合は、class="today"をつける
           $week .= '<td class="today">' . $day;
       } else if ($date == $want1date) {
           // 今日の日付の場合は、class="today"をつける
           $week .= '<td class="want">' . $day;
       } else if ($date == $want2date) {
           // 今日の日付の場合は、class="today"をつける
           $week .= '<td class="want">' . $day;
       } else {
           $week .= '<td>' . $day;
       }
       $week .= '</td>';

       // 週終わり、または、月終わりの場合
       if ($youbi % 7 == 6 || $day == $day_count) {

           if ($day == $day_count) {
               // 月の最終日の場合、空セルを追加
               // 例）最終日が木曜日の場合、金・土曜日の空セルを追加
               $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
           }

           // weeks配列にtrと$weekを追加する
           $weeks[] = '<tr>' . $week . '</tr>';

           // weekをリセット
           $week = '';
     }
   }
   ?>


<div class="leftnav">
 <h4>
   <div style="margin-left:45px; padding-bottom: 20px;">
   <form method="post" action="?ym=<?php echo $prev; ?>" class="cal" style="float:left;">
     <input type="hidden" name="allmoney" value="<?php print $allmoney;?>" class="cal"><input type="hidden" name="income" value="<?php print $income;?>" class="cal"><input type="hidden" name="food" value="<?php print $food;?>" class="cal"><input type="hidden" name="dn" value="<?php print $dn;?>" class="cal"><input type="hidden" name="expense" value="<?php print $expense;?>" class="cal"><input type="hidden" name="finalmoney" value="<?php print $finalmoney;?>" class="cal"><input type="hidden" name="want1date" value="<?php print $want1date;?>" class="cal"><input type="hidden" name="want1" value="<?php print $want1;?>" class="cal"><input type="hidden" name="want1ex" value="<?php print $want1ex;?>" class="cal"><input type="hidden" name="want2date" value="<?php print $want2date;?>" class="cal"><input type="hidden" name="want2" value="<?php print $want2;?>" class="cal"><input type="hidden" name="want2ex" value="<?php print $want2ex;?>" class="cal"><input type="hidden" name="foodtoday" value="0" class="cal"><input type="hidden" name="dntoday" value="0" class="cal"><input type="hidden" name="othertoday" value="0" class="cal"><input type="hidden" name="other" value="<?php print $other;?>" class="cal"><input type="hidden" name="rest" value="<?php print $rest;?>" class="cal"><input type="hidden" name="wallet" value="<?php print $wallet;?>" class="cal"><a href="?ym=<?php echo $prev; ?>"><input type="submit" value=&lt; class="cal"></a></form>
   <div style="float:left; margin: 0px 10px;"><?php echo $html_title; ?></div>
   <form method="post" action="?ym=<?php echo $next; ?>" class="cal" style="float:left;">
     <input type="hidden" name="allmoney" value="<?php print $allmoney;?>" class="cal"><input type="hidden" name="income" value="<?php print $income;?>" class="cal"><input type="hidden" name="food" value="<?php print $food;?>" class="cal"><input type="hidden" name="dn" value="<?php print $dn;?>" class="cal"><input type="hidden" name="expense" value="<?php print $expense;?>" class="cal"><input type="hidden" name="finalmoney" value="<?php print $finalmoney;?>" class="cal"><input type="hidden" name="want1date" value="<?php print $want1date;?>" class="cal"><input type="hidden" name="want1" value="<?php print $want1;?>" class="cal"><input type="hidden" name="want1ex" value="<?php print $want1ex;?>" class="cal"><input type="hidden" name="want2date" value="<?php print $want2date;?>" class="cal"><input type="hidden" name="want2" value="<?php print $want2;?>" class="cal"><input type="hidden" name="want2ex" value="<?php print $want2ex;?>" class="cal"><input type="hidden" name="foodtoday" value="0" class="cal"><input type="hidden" name="dntoday" value="0" class="cal"><input type="hidden" name="othertoday" value="0" class="cal"><input type="hidden" name="other" value="<?php print $other;?>" class="cal"><input type="hidden" name="rest" value="<?php print $rest;?>" class="cal"><input type="hidden" name="wallet" value="<?php print $wallet;?>" class="cal"><a href="?ym=<?php echo $next; ?>"><input type="submit" value=&gt; class="cal"></a></form>
</div>
</h4>
       <table class="table table-bordered">
           <tr>
               <th>日</th>
               <th>月</th>
               <th>火</th>
               <th>水</th>
               <th>木</th>
               <th>金</th>
               <th>土</th>
           </tr>
           <?php
               foreach ($weeks as $week) {
                   echo $week;
               }
           ?>
       </table>
       <div class="dayrest1">
         <?php print $want1;?>まで<br><br>
         <div class="resttxtall">
         <div class="resttxt">
         あと
         </div>
         <div class="dayrest">
         <?php
         $unixtoday = new DateTime($today);
          $unixday1 = new DateTime($want1date);

          $interval = $unixtoday->diff($unixday1);

          echo $interval->format('%a');
          ?>
        </div>
        <div class="resttxt">
          日
          </div>
        </div>
        </div>
        <div class="dayrest2">
          <?php print $want2;?>まで<br><br>
          <div class="resttxtall">
          <div class="resttxt">
          あと
          </div>
          <div class="dayrest">
          <?php
          $unixtoday = new DateTime($today);
           $unixday2 = new DateTime($want2date);

           $interval = $unixtoday->diff($unixday2);

           echo $interval->format('%a');
           ?>
         </div>
         <div class="resttxt">
           日

         </div>
         </div>
        </div>
</div>
</div>

<div class="mainarea">

<?php
      if($other>0){
      print '<form method="post" action="moneybook7.php">';
      print '<input type="hidden" name="allmoney" value="'.$allmoney.'">';
      print '<input type="hidden" name="income" value="'.$income.'">';
      print '<input type="hidden" name="food" value="'.$food.'">';
      print '<input type="hidden" name="dn" value="'.$dn.'">';
      print '<input type="hidden" name="expense" value="'.$expense.'">';
      print '<input type="hidden" name="finalmoney" value="'.$finalmoney.'">';
      print '<input type="hidden" name="want1date" value="'.$want1date.'">';
      print '<input type="hidden" name="want1" value="'.$want1.'">';
      print '<input type="hidden" name="want1ex" value="'.$want1ex.'">';
      print '<input type="hidden" name="want2date" value="'.$want2date.'">';
      print '<input type="hidden" name="want2" value="'.$want2.'">';
      print '<input type="hidden" name="want2ex" value="'.$want2ex.'">';
      print '<input type="hidden" name="other" value="'.$other.'">';
      print'この月あと使える額<br>';
      print '<div class="rest">';
      print $rest;
      print'円';
      print '</div>';
      print '<input type="hidden" name="rest" value="'.$rest.'">';
      print'<br><br>今日使った金額<br>';
      print '<div class="list">';
      print'食費<input type="text" name="foodtoday" class="multi">円&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;残り:';
      print $food;
      print'円<br>';
      print'日用品<input type="text" name="dntoday" value="0" class="multi">円&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;残り:';
      print $dn;
      print'円<br>';
      print'その他<input type="text" name="othertoday" value="0" class="multi">円&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;残り:';
      print $other;
      print'円<br>';
      print '</div>';
      print '<input type="button" onclick="history.back()" value="戻る" class="nav">';
      print '<input type="submit" value="更新" class="nav">';
      }else{
      print '<form method="post" action="moneybook_review.php">';
      print '<input type="hidden" name="allmoney" value="'.$allmoney.'">';
      print '<input type="hidden" name="income" value="'.$income.'">';
      print '<input type="hidden" name="food" value="'.$food.'">';
      print '<input type="hidden" name="dn" value="'.$dn.'">';
      print '<input type="hidden" name="expense" value="'.$expense.'">';
      print '<input type="hidden" name="finalmoney" value="'.$finalmoney.'">';
      print '<input type="hidden" name="want1date" value="'.$want1date.'">';
      print '<input type="hidden" name="want1" value="'.$want1.'">';
      print '<input type="hidden" name="want1ex" value="'.$want1ex.'">';
      print '<input type="hidden" name="want2date" value="'.$want2date.'">';
      print '<input type="hidden" name="want2" value="'.$want2.'">';
      print '<input type="hidden" name="want2ex" value="'.$want2ex.'">';
      print '<input type="hidden" name="other" value="'.$other.'">';
      print'お金が不足しています、戻って項目を見直しましょう<br><br>';
      print'不足額<br>';
      print '<div class="rest">';
      print -$other;
      print'円';
      print '</div>';
      print '<div class="list6">';
      print'<br>変更例1：バイトを増やして収入を上げる<br><br>';
      print'変更例2：食費や日用品の支出を見直す<br><br>';
      print'変更例3：残しておきたいお金を減らす<br>';
      print '</div>';
      print '<input type="submit" value="戻る" class="nav">';
      }
      ?>
    </div>
    <div class="rightnav">
      現在の総資産<br>
      <div class="wallet">
      <?php
      print $wallet;
      print'円';
      print '<input type="hidden" name="wallet" value="'.$wallet.'">';
      print'</form>';
      ?>
      </div>
      </div>
    </body>
  </html>
