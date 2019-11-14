$(function(){
    // Нажатие на кнопку "Сгенерировать"
    $('#js-send-form-button').click(function() {

        var url = $('#js-url-field').val();
        var urlRegExp = new RegExp('(?:(?:ht|f)tps?://)?(?:[\\-\\w]+:[\\-\\w]+@)?(?:[0-9a-z][\\-0-9a-z]*[0-9a-z]\\.)+[a-z]{2,6}(?::\\d{1,5})?(?:[?/\\\\#][?!^$.(){}:|=[\\]+\\-/\\\\*;&~#@,%\\wА-Яа-я]*)?');

        if(url){
            // Если есть ссылка после предыдущего запроса - удалить её
            if ($('a').is('#link')){
                $('#link').remove();
            }

            if (url.search(urlRegExp) == -1) {
                showErrorMessage('Некорректный URL');
                return false;
            }
            else {
                $.post({url: '/get-short-link', data: {url: url}})
                    .done(function (data) {
                        console.log(data);
                        if (data.status) {
                            $("#js-data-title").text('Ваша ссылка:');
                            $("#js-data-value").prepend("<a herf='' id='link' target='_blank'>" + data.link + "</a>");
                            $("#link").attr('href', data.link);
                        }
                        else {
                            showErrorMessage(data.error);
                            return false;
                        }
                    })
                    .fail(function () {
                        showErrorMessage('Произошла ошибка!');
                        return false;
                    });
            }
        }
    });
});

// Вывод тескстового сообщения с ошибкой
function showErrorMessage(content){
    $('#js-data-title').addClass('error').text(content);

    setTimeout(function(){
        $('#js-data-title').removeClass('error').text('');
    }, 3000);

    $('#js-url-field').val('');
};