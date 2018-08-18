
<div class="container">
<div class="row">
<div class="col-sm-12 bg-secondary text-light text-center m-5"><h1>チャット画面</h1></div>
</div>
<div class="card border border-primary m-5">
<div class="card-body">
<?php foreach ($chat_data as $chat) {
    if ($chat->sendto_id) {
?>
      <div class="row justify-content-start m-5">
        <div class="col-sm-8 col-sm-offset-4">
        <?php foreach ($sendto_data as $sendto) {
          if ($chat->sendto_id == $sendto->id) {
        ?>
              <p><?=h($login_name);?>|日付:<?=$sendto->date;?></p>
              <h2 class="border border-success rounded"><?=h($sendto->message);?></h2>
        <?php
          }
        }?>
        </div>
      </div>
<?php
    } else {
?>
      <div class="row justify-content-end m-5">
        <div class="col-sm-8 col-sm-offset-4">
      <?php foreach ($sendfrom_data as $sendfrom) {
        if ($chat->sendfrom_id == $sendfrom->id) {
      ?>
            <p><?php $web_name ? print h($web_name) : print h($user_name);?> | 日付:<?=$sendfrom->date;?></p>
            <h2 class="border border-info rounded"><?=h($sendfrom->message);?></h2>
      <?php
        }
      }
        ?>
        </div>
      </div>
<?php
    }
}
?>
<div id="msg-area">
</div>
</div>
</div>
  <div class="card border border-secondary m-5">
  <div class="card-body">
  <div class="row">
    <div class="col-sm-10"><input type="text" class="form-control form-control-lg" id="text"></div>
    <div class="col-sm-2"><input type="button" id="button" value="送信" class="btn btn-lg btn-info"></div>
  </div>
  </div>
  </div>
  </div>
  <script>
    var conn = new WebSocket("ws://160.16.233.165:8080");
    var msg_area = $("#msg-area");
    conn.onopen = function (e) {
        console.log("Connection established");
    }
    $("#button").click(function (){
        var msg = $("#text").val();
        $("#text").val("");
        //相手に送信
        conn.send(msg);
        //自分の投稿内容を表示
        msg_area.append(wrapMessage(msg, "to"));
        $(function() {
            $.ajax({
                type : "POST",
                url : "http://160.16.233.165/cakephp3_yanagi/Chats/chatRegister",
                data : {
                       "web_id" : <?=$web_id;?>,
                       "opponent_id" : <?=$account_id;?>,
                       "type" : "<?=$type;?>",
                       "msg" : msg
                       },
                dataType : "json",
                success : function(data) {
                    console.log(data);
                },
                error : function() {
                    alert("通信失敗");
                }
            });
        }

        );
    });

    conn.onmessage = function(e) {
        //相手の送信内容を表示
        msg_area.append(wrapMessage(e.data, "from"));

        );
    };

    function wrapMessage(msg, type) {
        if (type == "to") {
            return "<div class='row justify-content-start m-5'>"+"<div class='col-sm-8 col-sm-offset-4'>"+"<p>"+"<?=h($login_name);?>|日付:"+"<?php echo date("Y m d");?>"+"</p>"+"<h2 class='border border-success rounded'>"+msg+"</h2>"+"</div>"+"</div>";

        } else {
            <?php
            if ($web_name) {
            ?>
              var web_name = "<?=h($web_name);?>";
              console.log("aaaa");
              return "<div class='row justify-content-end m-5'>"+"<div class='col-sm-8 col-sm-offset-4'>"+"<p>"+"<?=h($web_name);?>|日付:"+"<?php echo date("Y m d");?>"+"</p></br>"+"<h2 class='border border-info rounded'>"+msg+"</h2>"+"</div>"+"</div>";;

            <?php
            } else {
            ?>
              var user_name = "<?=h($user_name);?>";
              return "<div class='row justify-content-end m-5'>"+"<div class='col-sm-8 col-sm-offset-4'>"+"<p>"+<?=h($user_name);?>"|日付:".<?php echo date("Y m d");?>+"</p></br>"+"<h2 class='border border-info rounded'>"+msg+"</h2>"+"</div>"+"</div>";;

            <?php
            }
            ?>
        }
    }
  </script>
