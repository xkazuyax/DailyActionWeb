<div class="container">
<div class="row mt-5 mb-5">
<div class="col-sm-8">
<h2>グループ管理</h2>
</div>
<div class="col-sm-4">
<a class="btn btn-lg btn-info" href="<?=$this->Url->build('/Groups/add');?>">追加</a>
</div>
</div>

<table class="table">
<thead class="thead-dark">
<tr>
<th scope="col">NO</th>
<th scope="col">グループ名</th>
<th scope="col">グループメンバー</th>
<th scope="col">作成日</th>
<th scope="col">編集日</th>
<th scope="col"></th>
</tr>
</thead>
<tbody class="">
<?php
foreach($groups as $group) {
?>
<tr class="table-primary">
<td scope="row"><a href="<?=$this->Url->build('/Groups/detail/'.$group->id);?>"><?=$group->id;?></a></td>
<td scope="row"><?=h($group->name);?></td>
<td scope="row"><a class="btn btn-info" href="<?=$this->Url->build('/Groups/memberList/'.$group->id);?>">表示</a></td>
<td scope="row"><?=$group->create_date;?></td>
<td scope="row"><?=$group->modified_date;?></td>
<td scope="row"><a href="<?=$this->Url->build('/Groups/memberEdit/'.$group->id);?>" class="btn btn-info">メンバー編集</a></td>
</tr>
<?php
}
?>
</tbody>
</table>

</div>