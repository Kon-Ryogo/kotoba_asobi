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
                <h2>修正</h2>
            </div>
        </header>
        
        <div class="main-wrapper">
            <div class="add-content">
                <p class="mondai" style="margin-top:71px;">問題修正</p><br />
            </div>
            <div class="center">
                <section>
                    <div class="home-content">
                    <?php

                    try
                    {
                        require_once('./common/common.php');

                        $post=sanitize($_POST);
                        $code=$post['code'];
                        $gazou_name_old=$post['gazou_name_old'];
                        $gazou_name=$post['gazou_name'];
                        $kotoba=$post['kotoba'];

                        if($gazou_name==false)
                        {
                            $gazou_name=$gazou_name_old;
                        }

                        $dbh=mondaidb();
                        
                        $sql='UPDATE mondai SET gazou=?,kotoba=? WHERE code=?';
                        $stmt=$dbh->prepare($sql);
                        $data[]=$gazou_name;
                        $data[]=$kotoba;
                        $data[]=$code;
                        
                        $stmt->execute($data);

                        $dbh=null;

                        if($gazou_name_old!=$gazou_name)
                        {
                            if($gazou_name_old!='')
                            {
                                unlink('./gazou/'.$gazou_name_old);
                            }
                        }  
                        print '<div class="form-style">'.$kotoba.'修正しました。</div><br /><br /><br />';
                    }
                    catch(Exception $e)
                    {
                            print 'ただいま障害により大変ご迷惑をおかけしております。';
                            exit();
                    }
                    ?>
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
