<!DOCTYPE html>
<html lang ="ja">
<body>
<form action="mission_4-1.php" method="post">
<p>
 <input type = "text" name="name" value="<?=$ename?>"  placeholder="名前"><br>
 <input type = "text" name="come" value="<?=$ecome?>"  placeholder="コメント"><br>
 <input type = "hidden" name="num2" value="<?=$edinum?>">
 <input type = "text" name="pass" value=""placeholder="パスワード">
 <input type="submit" value="送信">
</p>
<p>
 <input type = "text" name="renum" value=""placeholder="削除対象番号"><br>
 <input type = "text" name="pass1" value=""placeholder="パスワード">
 <input type="submit" value="削除">
</p>
<p>
 <input type = "text" name="edinum" value=""placeholder="編集対象番号"><br>
 <input type = "text" name="pass2" value=""placeholder="パスワード">
 <input type="submit" value="編集">
</p>
</form>


<?
$name=$_POST['name'];
$come=$_POST['come'];
$renum=$_POST['renum'];
$num2=$_POST['num2'];
$pass=$_POST['pass'];


$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn,$user,$password);//MySQLへ接続

$sql1= "CREATE TABLE board"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"//自動で連番作成
."name char(32),"
."comment TEXT"
.");";
$stmt = $pdo->query($sql1);

if(isset($_POST['name'])&&($_POST['come'])){

	$sql2 = $pdo -> prepare("INSERT INTO board (name,comment) VALUES (:name,:comment)"); //データの追加
	$sql2 -> bindParam(':name',$_POST['name'],PDO::PARAM_STR);
	$sql2 -> bindParam(':comment',$_POST['come'],PDO::PARAM_STR);
	/*1個目で :name のようにパラメータを指定。
	 ２個目に、それに入れる変数指定。bindParam には直接数値を入れれない。変数のみです。
	 ３個目で型を指定。PDO::PARAM_STR は文字列。*/

	$sql2 -> execute(); //prepareの実行
}

$sql3 = 'SELECT*FROM board';
$results = $pdo -> query($sql3);
foreach ($results as $row){
	echo $row['id'].',';
	echo $row['name'].',';
	echo $row['comment'].'<br>';
}

$sql4 ='SHOW TABLES';
$result = $pdo -> query($sql4);
	foreach ($result as $row){
	echo $row[0];
	echo '<br>';
}
echo "<hr>";

$sql5 ='SHOW CREATE TABLE board';
$result = $pdo -> query($sql5);
foreach ($result as $row){
	print_r($row);
}
echo "<hr>";


?>
</body>
</HTML>
