<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/app.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

    <div class="container" id="page">

        <div class="element-box mt-3">
            <div class="px-3 mx-auto" id="main-content">
                <div id="header d-flex justify-content-between align-items-center">
                    <div id="" class="d-flex justify-content-between align-items-center">
                        <a id="go-to-post" href="<?php echo Yii::app()->request->baseUrl; ?>">
                            <?php echo CHtml::encode(Yii::app()->name); ?>
                        </a>
                        <?php if (Yii::app()->user->isGuest) : ?>
                            <a href="<?php echo Yii::app()->baseUrl . '/index.php/user/login' ?>" class="btn btn-primary btn-sm">Login</a>
                        <?php else : ?>
                            <a href="<?php echo Yii::app()->baseUrl . '/index.php/user/logout' ?>" class="btn btn-secondary btn-sm">Logout</a>
                        <?php endif ?>
                    </div>
                </div><!-- header -->

                <div class="mt-3">
                    <?php if (isset($this->breadcrumbs)) : ?>
                        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                        )); ?>
                        <!-- breadcrumbs -->
                    <?php endif ?>
                </div>

                <?php echo $content; ?>

                <div class="clear"></div>

                <div id="footer">
                    &copy; <?php echo date('Y'); ?> Conexa Blog<br />
                </div><!-- footer -->
            </div>
        </div>

    </div><!-- page -->

</body>

</html>