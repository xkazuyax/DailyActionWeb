
<div class="container">
<div class="col-sm-10">
<div class="row m-5">
<div class="col-sm-8">
<h2>制御者管理一覧</h2>
</div>
<div class="col-sm-2">
<a class="btn btn-lg btn-info" href="<?=$this->Url->build('/webaccounts/add');?>">追加</a>
</div>
</div>
<div class="row m-5">
<div class="col-sm-12">
<table class="table">
<thead class="thead-dark">
<tr>
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
$webaccounts = $webaccount_list->toArray();
foreach($webaccounts as $webaccount) {
?>
<tr class="table-primary">
<td scope="row"><a href="<?=$this->Url->build('/webaccounts/detail/'.$webaccount->id);?>"><?=h($webaccount->id);?></a></td>
<td scope="row"><?=h($webaccount->login_id);?></td>
<td scope="row"><?=h($webaccount->name);?></td>
<td scope="row">
<?php
switch($webaccount->role){
	case 1:
	    echo("保守");
	    break;

	case 2:
		echo("一般");
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
</div>
</div>
</div>
</div>