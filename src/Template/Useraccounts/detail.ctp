
<div class="container">
<div class="row mt-5 mb-5">
<div class="col-sm-6">
<h2 class="text-info">ユーザー詳細</h2>
</div>
<div class="col-sm-3">
<a href="<?=$this->Url->build('/useraccounts/edit/'.$id);?>" class="btn btn-info btn-lg">編集</a>
</div>
<div class="col-sm-3">
<button class="btn btn-info btn-lg" onClick="del();">削除</button>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<table class="table">
<tr>
<th scope="col">ID</th>
<td scope="row"><?=h($user[0]["id"]);?></td>
</tr>
<tr>
<th scope="col">ログインID</th>
<td scope="row"><?=h($user[0]["login_id"]);?></td>
</tr>
<tr>
<th scope="col">ユーザー名</th>
<td scope="row"><?=h($user[0]["name"]);?></td>
</tr>
<tr>
<th scope="col">顔写真パス</th>
<td scope="row"><?=h($user[0]["picture"]);?></td>
</tr>
<tr>
<th scope="col">緯度</th>
<td scope="row"><?=h($user[0]["latitude"]);?></td>
</tr>
<tr>
<th scope="col">経度</th>
<td scope="row"><?=h($user[0]["longitude"]);?></td>
</tr>
<tr>
<th scope="col">ログイン状態</th>
<td scope="row"><?="ログイン中";?></td>
</tr>
<tr>
<th scope="col">最終ログイン日時</th>
<td scope="row"><?="2018/5/10";?></td>
</tr>
<tr>
<th scope="col">登録日時</th>
<td scope="row"><?=h($user[0]["create_date"]);?></td>
</tr>
<tr>
<th scope="col">編集日時</th>
<td scope="row"><?=h($user[0]["modified_date"]);?></td>
</tr>
</table>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="modal fade" id="delete">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h2 class="modak-title text-center">ユーザーアカウント削除確認</h2>
</div>
<div class="modal-body">
<h5>ユーザーアカウント「ID:<?=h($user[0]["id"]);?>、ユーザー名:<?=h($user[0]["name"]);?>」を削除してもよろしいですか？</h5>
</div>
<div class="modal-footer">
<button class="btn btn-info btn-lg mr-5" onClick="doOK();" data-dismiss="modal">OK</button>
<button class="btn btn-info btn-lg ml-5" data-dismiss="modal">キャンセル</button>
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
    window.location.href="<?=$this->Url->build('/Useraccounts/delete/'.$user[0]['id']);?>";
}

</script>
