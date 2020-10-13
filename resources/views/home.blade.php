<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>文章导入工具</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/vendor/wangEditor-3.1.1/release/wangEditor.min.css') }}">
    <meta name="theme-color" content="#563d7c">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        .w-e-text-container {
            height: 800px !important;;
        }
    </style>
</head>
<body class="bg-light">
<div class="mt-5">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="needs-validation" novalidate>
                {{ csrf_field() }}
                <h4 class="mb-3">链接</h4>
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control" name="article_url" placeholder="文章链接: https://mp.weixin.qq.com/#/#########" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary" id="query_list">采集</button>
                        </div>
                    </div>
                </div>
                <h4 class="mb-3">标题</h4>
                <input type="text" name="title" id="title" class="form-control" placeholder="文章的标题" required>
                <hr class="mb-4">
                <h4 class="mb-3">内容</h4>
                <div id="content">

                </div>
                <hr>
                <div class="text-center">
                    <button id="submit" class="btn btn-outline-info btn-lg" style="width: 20vh;" type="button">保存</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small"></footer>
</div>
</body>
<!-- JS, Popper.js, and jQuery -->
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="{{ asset('/vendor/wangEditor-3.1.1/release/wangEditor.min.js') }}"></script>
<script>
    let E = window.wangEditor;
    let editor = new E('#content');
    editor.create();

    $("#query_list").click(function () {
        let article_url = $("input[name='article_url']").val();
        let query_list = '/api/query_list';
        $.ajax({
            type: 'POST',
            async: false,
            url: query_list,
            data: {'article_link': article_url},
            success: function (response) {
                // console.log(response);
                editor.txt.html(response.content);
                $("#title").attr('value',response.title);
            }
        });
        $("#content img").each(function () {
            var download_url = '/api/download/image';
            var image_url = $(this).attr("src");
            var image_path = '';

            $.ajax({
                type: 'POST',
                async: false,
                url: download_url,
                data: {'image_url': image_url},
                success: function (response) {
                    image_path = response.image_path;
                }
            });
            $(this).attr("src", '/storage/' + image_path);
        });
    });

    $("#submit").click(function () {
        const url = '/api/contents';
        $.ajax({
            headers: {
                Accept: "application/json; charset=utf-8",
                'X-XSRF-TOKEN': $("input[name='_token']").val(),
            },
            type: 'POST',
            async: false,
            url: url,
            data: {
                'content': editor.txt.html(),
                'title': $("input[name='title']").val(),
                'article_link': $("input[name='article_url']").val()
            },
            success: function (response) {
                alert('保存成功')
            },
            error: function (error) {
                alert(error.message)
            }
        });

    });
</script>
</html>
