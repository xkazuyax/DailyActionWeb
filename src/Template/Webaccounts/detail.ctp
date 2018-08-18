
<div class="container">
<div class="row mt-5 mb-5">
<div class="col-sm-6">
<h2>制御者詳細画面</h2>
</div>
<div class="col-sm-3">
<a class="btn btn-info btn-lg" href="<?=$this->Url->build('/webaccounts/edit/'.$id);?>">編集</a>
</div>
<div class="col-sm-3">
<button class="btn btn-info btn-lg" onClick="del()">削除</button>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card border-info">
<div class="card-body">
<table class="table">
<tr>
<th scope="col">ID</th>
<td scope="row"><?=h($webaccount[0]["id"]);?></td>
</tr>
<tr>
<th scope="col">制御者アカウント名</th>
<td scope="row"><?=h($webaccount[0]["name"]);?></td>
</tr>
<tr>
<th scope="col">アカウント種別</th>
<td scope="row">
<?php
switch ($webaccount[0]["role"]) {
    case 1:
        echo ("保守");
        break;

    case 2:
        echo ("通常");
        break;
}
?>
</td>
</tr>
<tr>
<th scope="col">最終ログイン時間</th>
<td scope="row">2018/5/10</td>
</tr>
<tr>
<th scope="col">登録日時</th>
<td scope="row"><?=h($webaccount[0]["create_date"]);?></td>
</tr>
<tr>
<th scope="col">編集日時</th>
<td scope="row"><?=h($webaccount[0]["modified_date"]);?></td>
</tr>
</table>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="modal fade" id="delete">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h2 class="modal-title text-center">制御者削除確認</h2>
</div>
<div class="modal-body">
<h5>制御者アカウント「ID:<?=h($id);?>,名前:<?=h($webaccount[0]["name"]);?>」を削除してもよろしいですか?</h5>
</div>
<div class="modal-footer">
<button class="btn btn-info btn-lg float-left mr-5" type="button" data-dismiss="modal" onClick="doOK()">OK</button>
<button class="btn btn-info btn-lg ml-5" type="button" data-dismiss="modal">キャンセル</button>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
<script>
function del() {
    $("#delete").modal();
}

function doOK() {
    window.location.href="<?=$this->Url->build('/webaccounts/delete/'.$id);?>";
}

</script>
