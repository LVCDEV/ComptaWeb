<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    <title>Document</title>
</head>
<body>
    <div class="container py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="progress-title">HTML5</h3>
                    <div class="progress orange">
                        <div class="progress-bar" style="width:60%; background:#fe3b3b;">
                            <div class="progress-value">60%</div>
                        </div>
                    </div>
                    <h3 class="progress-title">CSS3</h3>
                    <div class="progress blue">
                        <div class="progress-bar" style="width:90%; background:#1a4966;">
                            <div class="progress-value">90%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
