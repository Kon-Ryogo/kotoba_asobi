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
                <h2>参照</h2>
            </div><!-- /.header-contents -->
        </header>
        
        <div class="main-wrapper">
            <a class="title-button" onclick="sound_push();href_sound('setting.php')">戻る</a>
            <div class="center">
                <section>
                    <div class="home-content">
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
                            $disp_gazou='<img src="./gazou/'.$gazou_name.'">';
                        }
                    }

                    catch(Exception $e)
                    {
                        print'ただいま障害により大変ご迷惑をおかけしております。';
                        exit();
                    }


                    $kotoba_str=preg_split("//u", $rec['kotoba'], -1, PREG_SPLIT_NO_EMPTY);
                
                    $array_count=0;
                    foreach($kotoba_str as $c)
                    {
                        $array_count++;
                    }
    
                    print$disp_gazou;
                    print'<div class="tomei" id="kotoba">'.$rec['kotoba'].'</div>';
                
    
                    ?>
    
                                            
                    <div class="container">
                    <?php
                            for($a=0;$a<$array_count;$a++)
                            {
                                $b=$a+1;
                                print'<h1 class="item_b">'.$kotoba_str[$a].'</h1>';
                            }
                    ?>
                    
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
