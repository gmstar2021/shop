<?php
session_start();
$id=$_GET['id'];
$name=$_GET['name'];
$price=$_GET['price'];
$upd=$_GET['upd'];
if($upd=="add"){
	if(empty($_SESSION['cart'])){
		$order=array();
		$order_item=array(
		'id'=>$id,
		'name'=>$name,
		'price'=>$price,
		'num'=>1
		);
		array_push($order,$order_item);
		$_SESSION['cart']=$order;
	}
	else{
		$order=$_SESSION['cart'];
		if(in_array($id,array_column($order,'id'))){
			$key=array_search($id,array_column($order,'id'));
			$order[$key]['num']+=1;
		}
		else{
			$order_item=array(
			'id'=>$id,
			'name'=>$name,
			'price'=>$price,
			'num'=>1
			);
			array_push($order,$order_item);
		}
		$_SESSION['cart']=$order;
	}
	header('Location:index.php');
}
if($upd=="cart"){
	if(!empty($_SESSION['cart'])){
		header('Location:cart.php');
	}
	else{
		header('Location:index.php');
	}
}
?>