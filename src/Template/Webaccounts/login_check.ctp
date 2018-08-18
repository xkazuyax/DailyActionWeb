<!DOCTYPE html>
<html>
<head>
<?=$this->Html->charset('utf-8');?>
<?=$this->Html->css('bootstrap.min.css');?>
<?=$this->Html->script('jquery-3.3.1.min.js');?>
<?=$this->Html->script('popper.min.js');?>
<?=$this->Html->script('bootstrap.min.js');?>
<title>日常行動アプリ</title>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-sm-12 text-info">
<div class="m-5 text-center">
<h1>日常活動記録アプリケーション</h>
</div>
</div>
<?php
if ($error) {
?>
<div class="row">
<div class="col-sm-12 text-danger">
<div class="text-center">
<h2><?=$error;?></h2>
</div>
</div>
</div>
<?php
}
?>
</div>
<div class="row">
<div class="col-sm-12">
<?=$this->Form->create($entity,["url" => ["Controller" => "Webaccount","action" => "loginCheck"]]);?>
<div class="form-group">
<label for="login_id" class="h4">ID</label>
<input type="text" name="login_id" id="login_id" class="form-control form-control-lg" placeholder="IDを入力してください" required>
</div>
<div class="form-group">
<label for="password" class="h4">PASS</label>
<input type="password" name="pass" id="password" class="form-control form-control-lg" placeholder="パスワードを入力してください" required>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-auto">
<div class="form-group mt-5">
<input type="submit" class="btn btn-primary btn-lg" value="ログイン">
</div>
</div>
</div>
</div>
</body>
</html>