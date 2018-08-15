// handle the responsive navigation menu

const burgerMenuLink = $('#burgerMenuLink');
const myTopNav = $('#myTopNav');
const mainNavLinks = $('.main-nav__links-list__link');


let topScroll = $(window).scrollTop();
function handleBurgerMenuClick() {
    myTopNav.toggleClass('responsive');

    if ( myTopNav.hasClass('responsive') ) {
        topScroll = $(window).scrollTop();
        disableScroll();
    } else {
        enableScroll();
        window.scrollTo(0,parseInt(topScroll));
    }
}

function handleMainNavLinksClick() {
    myTopNav.removeClass('responsive');
    enableScroll();
    window.scrollTo(0,parseInt(topScroll));
}

function disableScroll(){
    $('body').css({
        overflow: 'hidden',
        height: '100%'
    });
}
function enableScroll(){
    $('body').css({
        overflow: 'auto',
        height: 'auto'
    });
}

// handle email in the newsletter form
function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validate() {
    const result = $("#result");
    const result_msfw = $(".mc4wp-response");
    const email = $("#mce-EMAIL").val();

    result_msfw.css('display', 'none');

    if (!validateEmail(email)) {
        result.css('display', 'block');
        return false;
    }
}

// handle the close button of the "MailChimp for Wordpress" notice on the top
function form_notice_close_link(){
    const mail_chimp_fw_form_notice = $(".mc4wp-response");
    mail_chimp_fw_form_notice.css('display', 'none');
    return false;
}

// handle the back button of the "MailChimp for Wordpress" notice on the top
function form_notice_close_back_link(){
    const mail_chimp_fw_form_notice = $(".mc4wp-response");
    mail_chimp_fw_form_notice.css('display', 'none');
}

// handle the contact-form field focus/blur and add class to its label
function add_lablel_class_on_field_focus(e){
    const the_field = $(e.currentTarget);
    const its_label = the_field.parent().parent().children(".contact-form-label");
    the_field.removeClass('wpcf7-not-valid');
    its_label.toggleClass('focus');
}



//END

function mainFunction() {

    $( "html" ).easeScroll();
    burgerMenuLink.on( 'click', handleBurgerMenuClick);
    Array.from(mainNavLinks).map( link => link.addEventListener('click', handleMainNavLinksClick) );
    $( "#mc-embedded-subscribe" ).bind("click", validate);
    $(".form-notice-close").bind("click", form_notice_close_link);
    $( ".form-notice-back" ).bind("click", form_notice_close_back_link);
    $( ".contact-form-field" ).focus( (e) => add_lablel_class_on_field_focus(e) );
    $( ".contact-form-field" ).blur( (e) => add_lablel_class_on_field_focus(e) );
}

window.addEventListener( "load", mainFunction);