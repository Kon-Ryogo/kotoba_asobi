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
            <div class="add-content">
                <p class="mondai" style="margin-top:72px;">問題削除</p><br />
            </div>
            <div class="center">
                <section>
                    <div class="home-content" style="margin-top:94px;">
                    <?php

                    try
                    {
                        require_once('./common/common.php');
                        $post=sanitize($_POST);
                        $gazou_name=$post['gazou_name'];
                        $code=$post['code'];
                        
                        $dbh=mondaidb();
                        
                        $sql='DELETE FROM mondai WHERE code=?';
                        $stmt=$dbh->prepare($sql);
                        $data[]=$code;
                        $stmt->execute($data);

                        $dbh=null;
                        
                        if($gazou_name!='')
                        {
                            unlink('./gazou/'.$gazou_name);
                        }
                    }
                    catch(Exception $e)
                    {
                            print 'ただいま障害により大変ご迷惑をおかけしております。';
                            exit();
                    }
                    ?>

                    <div class="form-style" >削除しました。</div><br/>
                        <br/>
                        <br/>
                        <a class="button" onclick="sound_push();href_sound('setting.php')">設定画面へ</a>
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
