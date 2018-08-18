<div class="container">
<div class="row mt-5 mb-5">
<div class="col-sm-8">
<h2>グループ詳細</h2>
</div>
<div class="col-sm-2">
<a class="btn btn-info btn-lg" href="<?=$this->Url->build('/Groups/edit/'.$group[0]["id"]);?>">編集</a>
</div>
<div class="col-sm-2">
<button class="btn btn-info btn-lg" onClick="del()">削除</button>
</div>
</div>

<table class="table">
<tr>
<th scope="col">NO</th>
<td scope="row"><?=$group[0]["id"];?></td>
</tr>
<tr>
<th scope="col">グループ名</th>
<td scope="row"><?=h($group[0]["name"]);?></td>
</tr>
<tr>
<th scope="col">コメント</th>
<td scope="row"><?=h($group[0]["comment"]);?></td>
</tr>
<tr>
<th scope="col">作成日</th>
<td scope="row"><?=$group[0]["create_date"];?></td>
</tr>
<tr>
<th scope="col">編集日</th>
<td scope="row"><?=$group[0]["modified_date"];?></td>
</tr>
</table>

<div class="row">
<div class="col-sm-12">
<div class="modal fade" id="delete">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h2 class="modal-title text-center">グループ削除確認</h2>
</div>
<div class="modal-body">
<h5>「グループID:<?=h($group[0]["id"]);?>、グループ名:<?=h($group[0]["name"]);?>」を削除してもよろしいですか?</h5>
</div>
<div class="modal-footer">
<button class="btn btn-info btn-lg float-left mr-5" type="button" data-dismiss="modal" onClick="doOK()">OK</button>
<button class="btn btn-info btn-lg float-left mr-5" type="button" data-dismiss="modal">キャンセル</button>
</div>
</div>
</div>
</div>
<script>
function del() {
    $("#delete").modal();
}

function doOK() {
    window.location.href("<?=$this->Url->build('/groups/delete/'.$group[0]["id"]);?>");
}
</script>
</div>
</div>
</div>