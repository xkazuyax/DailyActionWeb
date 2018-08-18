
<div class="container">
<div class="row mt-5 mb-5">
<div class="col-sm-10">
<h2 class="text-info text-info">ユーザー一覧</h2>
</div>
<div class="col-sm-2">
<a class="btn btn-lg btn-info" href="<?=$this->Url->build('/Useraccounts/add');?>">追加</a>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<table class="table">
<thead class="thead-dark">
<tr>
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
foreach($users as $user) {
?>
<tr>
<td scope="row"><a href="<?=$this->Url->build('/Useraccounts/detail/'.$user->id);?>"><?=h($user->id);?></a></td>
<td scope="row"><?=h($user->login_id);?></td>
<td scope="row"><?=h($user->name);?></td>
<td scope="row"><?=h($user->picture);?></td>
<td scope="row"><?=h($user->latitude);?></td>
<td scope="row"><?=h($user->longitude);?></td>
<td scope="row">ログイン中</td>
<td scope="row">2018/5/10</td>
<td scope="row"><?=h($user->create_date);?></td>
<td scope="row"><?=h($user->modified_date);?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
</div>
</div>
