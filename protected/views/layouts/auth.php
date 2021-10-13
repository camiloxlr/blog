<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/auth.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/jpg" href="<?php echo Yii::app()->request->baseUrl; ?>/images/conexa.jpeg"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

    <div class="container w-100 h-100 d-flex justify-content-center align-items-center" id="page">

        <div class="authContent">
            <div class="mb-3">
                <div id="header">
                    <a id="go-to-post" href="<?php echo Yii::app()->request->baseUrl; ?>">
                        <div id="logo">
                            <?php echo CHtml::encode(Yii::app()->name); ?>
                        </div>
                    </a>
                </div>
            </div>
            <div class="formContent">
                <?php echo $content; ?>
            </div>
        </div>

    </div><!-- page -->

</body>

</html>