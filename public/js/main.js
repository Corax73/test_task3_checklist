$(function() {

    /**
     * Левое меню
     */
    //$('.sidebar-menu__subitems').hide();
    
    $('.sidebar-menu__item-title').click(function() {
        $(this).find('+ .sidebar-menu__subitems').slideToggle('fast');
        $(this).find('i').toggleClass('fa-caret-down');
    });
    
    });
    