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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css">
    <link rel="shortcut icon" type="image/jpg" href="<?php echo Yii::app()->request->baseUrl; ?>/images/conexa.jpeg" />

    <script src="https://use.fontawesome.com/935025f712.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

    <div class="container" id="page">

        <div id="main" class="element-box mt-3">
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

<script type="application/javascript">
    var app = new Vue({

        'el': '#main',

        'data': function() {
            return {
                name: 'Blog',
                comments: [],
                user: <?php echo Yii::app()->user->id ?? '0'; ?>
            };
        },

        created() {

            currentUrl = window.location.href;

            if (currentUrl.includes('post/view')) {

                let url = new URL(currentUrl);
                let searchParams = new URLSearchParams(url.search);

                this.loadComments(searchParams.get('id'));
            }
        },

        methods: {

            // Add um comentário a um artigo
            sendComment: function(id) {

                let data = {
                    'id': id,
                    'comment': document.getElementById('comment-input').value,
                };

                axios.post('<?php echo Yii::app()->createAbsoluteUrl("comment/create"); ?>', data)
                    .then(response => {
                        this.loadComments(id)
                        showAlert("Sucesso.", "Comentário adicionado.");
                        document.getElementById('comment-input').value = '';
                    })
                    .catch(error => {
                        showAlert("Erro.", error.response.data.content, "error");
                    });
            },

            // Exibe um artigo
            showArticle: function(id) {
                location.href = '<?php echo Yii::app()->createAbsoluteUrl("post/view"); ?>' + '?id=' + id;
            },

            // Carrega os comentários de um artigo
            loadComments: function(id) {
                var vm = this
                axios.get('<?php echo Yii::app()->createAbsoluteUrl("comment/postcomments"); ?>?id=' + id)
                    .then(response => {
                        vm.comments = response.data
                    })
                    .catch(error => console.error(error));
            },
            // Deleta um artigo
            deleteArticle: function(id) {

                let data = {
                    'id': id
                };
                console.log(data);
                axios.post('<?php echo Yii::app()->createAbsoluteUrl("post/delete"); ?>', data)
                    .then(response => {
                        showAlert("Sucesso.", "Artigo deletado.");
                        setTimeout(function() {
                            location.href = '<?php echo Yii::app()->createAbsoluteUrl("post/index"); ?>'
                        }, 2000);
                    })
                    .catch(error => console.error(error));
            },
            // Deleta um comentário
            deleteComment: function(id, post) {

                let data = {
                    'id': id
                };
                console.log(data);
                axios.post('<?php echo Yii::app()->createAbsoluteUrl("comment/delete"); ?>', data)
                    .then(response => {
                        showAlert("Sucesso.", "Comentário deletado.");
                        this.loadComments(post)
                    })
                    .catch(error => console.error(error));
            },
        }
    });

    function deleteArticle(id) {
        console.log(id);
        app.deleteArticle(id);
    }

    function openArticle(id) {
        app.showArticle(id);
    }

    var categories = document.getElementById("category");

    if (categories) {
        categories.addEventListener("change", function() {
            const params = new URLSearchParams();
            params.append('id', categories.value);
            axios.post('<?php echo Yii::app()->createAbsoluteUrl("post/index"); ?>', params)
                .then(response => {
                    document.open();
                    document.write(response.data);
                    document.close();
                })
                .catch(error => console.error(error));
        });
    }

    function showAlert(title, msg, type = "success") {
        icon_types = {
            success: "text-success fa fa-check",
            error: "text-danger fa fa-exclamation-circle",
            info: "text-info fa fa-info-circle",
            warning: "text-warning fa fa-exclamation-circle",
        };
        iziToast.show({
            class: "",
            title: title,
            titleColor: "",
            titleSize: "",
            message: msg,
            messageColor: "",
            messageSize: "",
            backgroundColor: "",
            theme: "dark", // dark
            color: "", // blue, red, green, yellow
            icon: icon_types[type],
            iconText: "",
            iconColor: "",
            iconUrl: null,
            image: "",
            imageWidth: 50,
            maxWidth: null,
            zindex: null,
            layout: 1,
            balloon: false,
            close: true,
            closeOnEscape: false,
            closeOnClick: false,
            displayMode: 0, // once, replace
            position: "bottomCenter", // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
            target: "",
            targetFirst: true,
            timeout: 5000,
            rtl: false,
            animateInside: true,
            drag: true,
            pauseOnHover: true,
            resetOnHover: false,
            progressBar: true,
            progressBarColor: "",
            progressBarEasing: "linear",
            overlay: false,
            overlayClose: false,
            overlayColor: "rgba(0, 0, 0, 0.6)",
            transitionIn: "fadeInUp",
            transitionOut: "fadeOut",
            transitionInMobile: "fadeInUp",
            transitionOutMobile: "fadeOutDown",
            buttons: {},
            inputs: {},
            onOpening: function() {},
            onOpened: function() {},
            onClosing: function() {},
            onClosed: function() {},
        });
    }
</script>