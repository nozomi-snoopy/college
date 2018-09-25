<!DOCTYPE html>
<html lang ="ja">
<body>

<?
if(isset($_POST['edinum'])){//表示
$edinum=$_POST['edinum'];
$afile='mission_2_1_Shirai.txt';
	if(file_exists($afile)){   //投稿内容
	$array_a=file($afile);//一行ずつ読み込み
		foreach($array_a as $aa){//配列の要素ごとに行う
		$a2=explode("<>",$aa);
		$num=intval($a2[0]);
			if($_POST['pass2']==$a2[4]){
				if($num==$edinum){
				$ename=$a2[1];
				$ecome=$a2[2];
				}
			}
		}
	}
}

?>

<form action="mission_2-5.php" method="post">
<p>
 <input type = "text" name="name" value="<?=$ename?>"><br>
 <input type = "text" name="come" value="<?=$ecome?>"><br>
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

<?php
$afile='mission_2_1_Shirai.txt';

$name=$_POST['name'];
$come=$_POST['come'];
$renum=$_POST['renum'];
$num2=$_POST['num2'];
$pass=$_POST['pass'];


if((!empty($_POST['renum'])&&($_POST['pass1']))){//削除対象番号あり、issetだと起動する
	if(file_exists($afile)){   //投稿内容
	$array_a=file($afile);//一行ずつ読み込み,空になる前に
	$fp1=fopen($afile,'w'); //fileの書きこみ、空になった
	$i=1;
		foreach($array_a as $aa){//配列の要素ごとに行う
		$a2=explode("<>",$aa);
		$num=intval($a2[0]);
			if($num==$renum){
				if($_POST['pass1']==$a2[4]){
				$aa='';
				$i--;
				}
			}
			else{
			$a2[0]=$i;
			$aa="$a2[0]<>$a2[1]<>$a2[2]<>$a2[3]<>$a2[4]<>\n";
			}
		fwrite($fp1,$aa); /*fileの書き換え*/
		$i++;
		}
	fclose($fp1);
	}
}


if(isset($_POST['name'])&&($_POST['come'])&&($_POST['pass'])){
	if(empty($_POST['num2'])){
		if(file_exists($afile)){ //()の中身にデータがセットされていれば真
		$array_a=file($afile);//一行ずつ読み込み
		}
	$fp2=fopen($afile,'a'); //fileの書き換え,なくても作ってる
	$date=date("Y/m/d H:i:s");
	$num=count($array_a)+1;
	$show="$num<>$name<>$come<>$date<>$pass<>";
	fwrite($fp2,$show."\n");
	fclose($fp2);
	}
}


if(!empty($_POST['num2'])){//編集
	if(file_exists($afile)){   //投稿内容
	$array_a=file($afile);//一行ずつ読み込み,空になる前に
	$fp3=fopen($afile,'w'); //fileの書きこみ、空になった
		foreach($array_a as $aa){//配列の要素ごとに行う
		$a2=explode("<>",$aa);
		$num=intval($a2[0]);
			if($num==$num2){
			$date=date("Y/m/d H:i:s");
			$aa="$num2<>$name<>$come<>$date<>$pass<>\n";
			}
			else{
			$aa="$a2[0]<>$a2[1]<>$a2[2]<>$a2[3]<>$a2[4]<>\n";
			}
		fwrite($fp3,$aa); /*fileの書き換え*/
		$i++;
		}
	fclose($fp3);
	}
}


if(file_exists($afile)){   //投稿内容
$array_a=file($afile);//一行ずつ読み込み
	foreach($array_a as $aa){//配列の要素ごとに行う
	$a2=explode("<>",$aa);
	echo "$a2[0]"." $a2[1]"." $a2[2]"." $a2[3]";
	echo"</br>";
	}
}


?>
</body>
</HTML>
