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
                <h2>追加</h2>
            </div><!-- /.header-contents -->
        </header>
        
        <div class="main-wrapper">
            <div class="center">
                <section>
                    <div class="home-content">
                    
                    <div class="form-style" >問題が選択されていません。</div><br/>
                    <br/>
                    <br/>
                    <a onclick="sound_push();href_sound('setting.php')" class="button">設定画面へ</a>
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
