/**
 * FontAwesome Fallback Check (jQuery Powered)
 */
$(document).ready(function() {
    const $testElement = $('<span>')
        .addClass('fa fa-check')
        .css({ display: 'none', position: 'absolute' })
        .appendTo('body');

    const fontFamily = $testElement.css('font-family') || '';
    if (!fontFamily.includes('Font Awesome') && !fontFamily.includes('FontAwesome')) {
        console.warn('Font Awesome failed to load properly from primary source.');
    }

    $testElement.remove();
});
