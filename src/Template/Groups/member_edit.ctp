<div class="container">
<div class="row mt-5 mb-5">
<div class="col-sm-12">
<h2>グループメンバー編集</h2>
</div>
</div>
<?=$this->Form->create($entity,["url" => ["controller" => "Groups","action" => "memberEditCheck/".$group_id]]);?>
<div class="form-group">
<h3>制御者アカウント</h3>
<table class="table">
<thead class="thead-dark">
<tr>
<th scope="col"></th>
<th scope="col">NO</th>
<th scope="col">ログインID</th>
<th scope="col">名前</th>
<th scope="col">アカウント種別</th>
<th scope="col">ログイン状態</th>
<th scope="col">最終ログイン</th>
</tr>
</thead>
<tbody class="">
<?php
$webaccount_data =$webaccounts->toArray();
foreach($webaccount_data as $num => $webaccount) {

?>
<tr class="table-primary">
<td scope="row"><input type="checkbox" name="web[]" value="<?=$webaccount->id;?>" <?php if (in_array($webaccount->id,$web)) { echo "checked";}?>></td>
<td scope="row"><?=$webaccount->id;?></td>
<td scope="row"><?=$webaccount->login_id;?></td>
<td scope="row"><?=h($webaccount->name);?></td>
<td scope="row">
<?php
switch($webaccount->role) {
    case 1:
        echo "保守";
        break;

    case 2:
        echo "一般";
        break;
}
?>
</td>
<td scope="row">ログイン中</td>
<td scope="row">2018/5/11</td>
</tr>
<?php

}
?>
</tbody>
</table>

<h3>ユーザーアカウント</h3>
<table class="table">
<thead class="thead-dark">
<tr>
<th scope="col"></th>
<th scope="col">ID</th>
<th scope="col">ログインID</th>
<th scope="col">ユーザー名</th>
<th scope="col">顔写真パス</th>
<th scope="col">緯度</th>
<th scope="col">経度</th>
<th scope="col">ログイン状態</th>
<th scope="col">最終ログイン時間</th>
<th scope="col">登録日</th>
<th scope="col">編集日時</th>
</tr>
</thead>
<tbody class="">
<?php
$user_data = $useraccounts->toArray();
foreach($user_data as $num => $useraccount) {

?>
<tr class="table-primary">
<td scope="row"><input type="checkbox" name="user[]" value="<?=$useraccount->id;?>" <?php if (in_array($useraccount->id,$user)) {echo "checked";}?>></td>
<td scope="row"><?=$useraccount->id;?></td>
<td scope="row"><?=h($useraccount->login_id);?></td>
<td scope="row"><?=h($useraccount->name);?></td>
<td scope="row"><?=h($useraccount->picture);?></td>
<td scope="row"><?=$useraccount->latitude;?></td>
<td scope="row"><?=$useraccount->longitude;?></td>
<td scope="row">ログイン中</td>
<td scope="row">2018/5/10</td>
<td scope="row"><?=$useraccount->create_date;?></td>
<td scope="row"><?=$useraccount->modified_date;?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
<div class="row">
<div class="col-sm-4"></div>
<div class="col-sm-offset6 col-sm-4 m-5">
<input type="submit" value="保存" class="btn btn-lg btn-info">
</div>
<div class="col-sm-4"></div>
</div>
</div>
