<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <title>ことばあそび</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <div class="header-contents item">
                <h1>ことばあそび</h1>
                <h2>削除</h2>
            </div><!-- /.header-contents -->
        </header>
        
        <div class="main-wrapper">
            <a class="title-button" onclick="sound_push();href_sound('setting.php')">戻る</a>
            <div class="add-content">
                <p class="mondai" style="margin-top:48px;">問題削除</p><br />
            </div>
            <div class="center">
                <section>
                    <div class="home-content" style="margin-top:-30px;">
                    <?php

                    try
                    {

                        $code=$_GET['code'];

                        require_once('./common/common.php');
                        $dbh=mondaidb();

                        $sql='SELECT gazou,kotoba FROM mondai WHERE code=?';
                        $stmt=$dbh->prepare($sql);
                        $data[]=$code;
                        $stmt->execute($data);

                        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                        $gazou_name=$rec['gazou'];
                        $kotoba=$rec['kotoba'];

                        $dbh=null;

                        if($gazou_name=='')
                        {
                            $disp_gazou='';
                        }
                        else
                        {
                            $disp_gazou='<img src="./gazou/'.$gazou_name.'" style="height:200px;">';
                        }
                    }

                    catch(Exception $e)
                    {
                        print'ただいま障害により大変ご迷惑をおかけしております。';
                        exit();
                    }

                    ?>

                    問題削除<br/>
                    <br/>
                    問題コード<br/>
                    <?php print $code;?>
                    <br/>
                    問題<br/>
                    <?php print$disp_gazou;?>
                    <br/>
                    <?php 
                    print '<div class="container">';
                    $kotoba_check=preg_split("//u", $kotoba, -1, PREG_SPLIT_NO_EMPTY);
                    for($i=0;$i<count($kotoba_check);$i++)
                    {
                        print '<h1 class="item_a">'.$kotoba_check[$i].'</h1>';
                    }
                    print '</div>';?>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-style" >この問題を削除してよろしいですか？</div>
                        <br/>
                        <form method="post" action="delete_done.php">
                            <input type="hidden" name="code" value="<?php print$code;?>">
                            <input type="hidden" name="gazou_name" value="<?php print$gazou_name;?>">
                            <input class="button" type="submit" value="OK" onclick="sound_push();sound_chien()">
                        </form>
                    </div>
                    
                </section>
            </div>
        </div><!-- /.main-wrapper -->
        <footer>日本工業大学　先進工学部　情報メディア工学科　シュガーマンズ</footer>
        <audio id="push" preload="auto">
            <source src="sounds/push.mp3" type="audio/mp3">
            <source src="sounds/push.wav" type="audio/wav">
        </audio>
        <script src="script.js"></script>

    </body>
</html>
