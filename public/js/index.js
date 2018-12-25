$(document).ready(function () {
    $(".btn-refresh").on('click', function () {

        $.ajax({
            type: 'GET',
            url: '/refresh_captcha',
            success: function (data) {
                $(".captcha-container").html(data.captcha);
            }
        })
    });


    var btn = document.getElementsByClassName('expand'),
        hiddenDiv = document.getElementsByClassName('hidden-div'),
        background = document.querySelector('.background');


    $('.expand').on('click', function () {
        var $button = $(this);
        var $contentModal = $('#content-modal');
        var articleId = $button.data('article-id');
        var _token = $('meta[name="csrf-token"]').attr('content');

        $contentModal.find('.downloaded-content').html('');

        $.ajax({
            type: 'POST',
            url: '/show_attachment',
            data: {_token: _token, article_id: articleId},
            success: function (data) {
                $contentModal.find('.downloaded-content').html(data);
            }
        });
    });


    var $textarea = $('.text-area');
    var $previewContainer = $('.preview-container');

    $('.tag-i').on('click', function (event) {
        event.preventDefault();
        var value = $textarea.val();
        var inputText = value + '<i></i> ';
        $textarea.val(inputText);
    });

    $('.tag-strong').on('click', function (event) {
        event.preventDefault();
        var value = $textarea.val();
        var inputText = value + '<strong></strong> ';
        $('.text-area').val(inputText);

    });

    $textarea.bind('input propertychange', function () {
        var $value = this.value;
        $previewContainer.html($value);
    });

    $('.preview').on('click', function (event) {
        event.preventDefault();
        if ($previewContainer.is('.clicked')) {
            $previewContainer.removeClass('clicked');
            $previewContainer.css('display', 'none');
        } else if (!$('.preview').is('.clicked')) {
            $previewContainer.addClass('clicked');
            $previewContainer.css('display', 'block');
        }
    });


});