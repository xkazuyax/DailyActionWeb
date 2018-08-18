<div class="row">
<div class="col-sm-12">
<?=$this->Form->create($entity,["url" => ["controller" => "groups","action" => "editCheck"]]);?>
<div class="form-group">
<label for ="name">グループ名</label>
<input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="20文字以内で入力してください">
<div class="error text-danger"><?=$this->Form->error("name");?></div>
</div>
<div class="form-group">
<label for="comment">コメント</label>
<input type="text" name="comment" id="comment" class="form-control form-control-lg" placeholder="40文字以内で入力してください">
<div class="error text-danger"><?=$this->Form->error("comment");?></div>
</div>
<div class="form-group">
<button type="submit" class="btn btn-lg" name="send">追加</button> 
</div>
</div>
</div>
