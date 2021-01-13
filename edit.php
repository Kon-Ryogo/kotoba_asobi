<?php
    session_start();
?>
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
            </div><!-- /.header-contents -->
        </header>
        
        <div class="main-wrapper">
            <?php
            if(isset($_POST['gazou_name'])==true)
            {
                $gazou_name=$_POST['gazou_name'];
                if(isset($_SESSION['edit_back'])==true&&$_SESSION['edit_back']==1)
                {
                    if(isset($_SESSION['edit_back_existing']))
                    {
                        if($_SESSION['edit_back_existing']==0)
                        {
                            $result_gazou_name=glob('./gazou/'.$gazou_name);
                            if(isset($result_gazou_name)&&$_SESSION['edit_back']==1)
                            {
                                unlink('./gazou/'.$gazou_name);

                                $_SESSION['edit_back']=0;
                            }
                            else
                            {
                                $_SESSION['edit_back']=0;
                            }
                        }
                    }
                }
                if(isset($_SESSION['edit_back_existing']))
                {
                    $_SESSION['edit_back_existing']=0;
                }
            }
            ?>
            <a class="title-button" onclick="sound_push();href_sound('setting.php')">戻る</a>
            <section>
                <div class="add-content">
                <?php

                try
                {
                    if(isset($_POST['code'])==true)
                    {
                        $code=$_POST['code'];
                    }
                    else
                    {
                        $code=$_GET['code'];
                    }
                    require_once('common/common.php');
                    $dbh=mondaidb();

                    $sql='SELECT gazou,kotoba FROM mondai WHERE code=?';
                    $stmt=$dbh->prepare($sql);
                    $data[]=$code;
                    $stmt->execute($data);

                    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                    $gazou_name_old=$rec['gazou'];
                    $kotoba=$rec['kotoba'];

                    $dbh=null;

                    if($gazou_name_old=='')
                    {
                        $disp_gazou='';
                    }
                    else
                    {
                        $disp_gazou='<img src="./gazou/'.$gazou_name_old.'" style="height:100px;">';
                    }
                }

                catch(Exception $e)
                {
                    print'ただいま障害により大変ご迷惑をおかけしております。';
                    exit();
                }

                ?>
                <p class="mondai" style="margin-top:47px;">問題修正</p><br />
                <form class="form-style" accept="image/*" method="post" action="edit_check.php" enctype="multipart/form-data">
                    <input type="hidden" name="code" value="<?php print$code;?>">
                    <input type="hidden" name="gazou_name_old" value="<?php print$gazou_name_old;?>">
                    <?php print$disp_gazou;?><br/>
                    画像を選択してください。<br />
                    ※２MBより小さいサイズの画像を選択してください。<br />
                    <input type="file" accept="image/*" name="gazou" style="width:425px" ><br />
                    言葉を入力してください。<br />
                    <input type="text" name="kotoba" style="width:220px" value="<?php print$kotoba;?>"><br />
                    <br />
                    <input type="submit" value="OK" class="button">
                </form>
            </section>
        </div><!-- /.main-wrapper -->
        <footer>日本工業大学　先進工学部　情報メディア工学科　シュガーマンズ</footer>
        <audio id="push" preload="auto">
            <source src="sounds/push.mp3" type="audio/mp3">
            <source src="sounds/push.wav" type="audio/wav">
        </audio>
        <script src="script.js"></script>

    </body>
</html>
