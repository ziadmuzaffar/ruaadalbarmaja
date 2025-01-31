$(document).ready(function () {
    /************************************************/
    $('.sidebar ul li a').each(function () {
        let href = $(this).attr('href').split('/')[4]
        let url = window.location.pathname.split('/')[2]
        if (href == url) {
            $(this).addClass('active')
        } else {
            $(this).removeClass('active')
        }
    })

    let deleteItem

    $('a[href="#delete"]').click(function () {
        deleteItem = $(this).next()
    })

    $('#modal-delete').click(function () {
        deleteItem.submit()
    })
    
    $('.alerts i').click(function () {
        $('.alerts').slideUp(300);
    })

    $('.panel .panel-head i').click(function () {
        $(this).parent().next().slideToggle(300)
    })
    /************************************************/
})