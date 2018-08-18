<!DOCTYPE html>
<html lang="ja">
<head>
<?=$this->Html->charset("utf-8");?>
<?=$this->Html->css('bootstrap.min.css');?>
<?=$this->Html->script('jquery-3.3.1.min.js');?>
<?=$this->Html->script('popper.min.js');?>
<?=$this->Html->script('bootstrap.min.js');?>
<title>日常行動アプリ</title>
<meta charset="utf-8">
</head>
<body>
<div class="container-fluid">
<div class="row bg-danger p-5">
<div class="col-sm-8">
<h1 class="text-center">日常行動アプリ</h1>
</div>
<div class="col-sm-2">
<a class="btn  bg-light" href="<?=$this->Url->build('/Webaccounts/logout');?>">ログアウト</a>
</div>
</div>
</div>
<div class="container-fluid">
<div class="row mt-5 mb-5">
<div class="col-sm-2  p-0">
<div class="list-group">
<a href="<?=$this->Url->build('/Maps/index');?>" class=" p-5 list-group-item list-group-item-action bg-dark text-light">マップ</a>
<a href="<?=$this->Url->build('/Webaccounts/webList');?>" class="p-5 list-group-item list-group-item-action bg-dark text-light">制御者アカウント管理</a>
<a href="<?=$this->Url->build('/Useraccounts/userList');?>" class="p-5 list-group-item list-group-item-action bg-dark text-light">ユーザー管理</a>
<a href="<?=$this->Url->build('/Groups/groupList');?>" class="p-5 list-group-item list-group-item-action bg-dark text-light">グループ管理</a>
<a href="<?=$this->Url->build('/Chats/memberSelect');?>" class="p-5 list-group-item list-group-item-action bg-dark text-light">チャット</a>
</div>
</div>

<?=$this->fetch("content");?>
</div>
</div>
</body>
</html>
