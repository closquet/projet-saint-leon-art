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




function mainFunction() {

    burgerMenuLink.on( 'click', handleBurgerMenuClick);
    Array.from(mainNavLinks).map( link => link.addEventListener('click', handleMainNavLinksClick) ); //scroll nav issue

}

window.addEventListener( "load", mainFunction);