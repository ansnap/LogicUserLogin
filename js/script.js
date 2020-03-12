$(document).ready(function () {
    // Обновление GET параметра 'lang' при переключении языка
    $('#lang select').change(function () {
        var url = new URL(window.location.href);

        if ($(this).val() === '') {
            url.searchParams.delete('lang');
        } else {
            url.searchParams.set('lang', $(this).val());
        }

        window.location.href = url;
    });

    // Переключение форм входа и регистрации
    $('.form-switcher').click(function () {
        if (!$(this).is('.active')) {
            $('[id^=form-').toggle();
            $('.form-switcher').toggleClass('active');
        }
    });
});


