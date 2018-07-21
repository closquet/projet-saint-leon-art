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
    const $result = $("#result");
    const email = $("#mce-EMAIL").val();

    if (!validateEmail(email)) {
        $result.css('display', 'block');
        return false;
    }
}





function mainFunction() {

    burgerMenuLink.on( 'click', handleBurgerMenuClick);
    Array.from(mainNavLinks).map( link => link.addEventListener('click', handleMainNavLinksClick) );
    $("#mc-embedded-subscribe").bind("click", validate);

}

window.addEventListener( "load", mainFunction);