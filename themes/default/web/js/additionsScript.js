$(document).ready(function(){

    $('.no-click, .no-click > a, #top-menu .active > a, #footer-menu .active > a').click(function(e){
        e.preventDefault();
        return false;
    })
});

function showFlashMessage(){
    $("#flashMessage").addClass("bounceInLeft");
    hideFlashMessage();
}

function hideFlashMessage(){
    setTimeout(function(){
        $("#flashMessage").addClass("bounceOutRight");
        setTimeout(function(){
            $("#flashMessage").html('').removeClass("bounceInLeft bounceOutRight");
        }, 500);
    }, 2000);
}

$(document).ready(function(){
    if( $('#flashMessage .alert').length > 0 ){
        showFlashMessage();
    }
});

$(document).ready(function(){
    $(".fancybox-button").fancybox({
        prevEffect		: 'none',
        nextEffect		: 'none',
        closeBtn		: false,
        helpers		: {
            title	: { type : 'inside' },
            buttons	: {}
        }
    });

    $("a.iframe").click(function() {
        $.fancybox({
            'transitionIn'	: 'none',
            'transitionOut'	: 'none',
            'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
            'type'			: 'swf',
            'swf'			: {
                'wmode'				: 'transparent',
                'allowfullscreen'	: 'true'
            }
        });

        return false;
    });

});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.preview-image').attr('src', e.target.result).show();
        };

        reader.readAsDataURL(input.files[0]);
    }
}