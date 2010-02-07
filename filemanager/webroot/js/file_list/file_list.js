if(jQuery) (function($){
    
    $.extend($.fn, {

        fileList: function(o, h) {

            if( !o ) o = {};
            if( o.root == undefined ) o.root = '/';
            if( o.script == undefined ) o.script = 'jqueryFileTree.php';
            if( o.clickEvent == undefined ) o.clickEvent = 'click';
            if( o.clickElement == undefined ) o.clickEvent = 'click';

            $(this).each( function() {

                function listFiles(c, t) {
                    $(c).addClass('wait');
                    $(".jqueryFileTree.start").remove();
                    $.post(o.script, { dir: t }, function(data) {
                        $(c).find('.start').html('');
                        $(c).removeClass('wait').append(data);
                        if( o.root == t ) $(c).find('UL:hidden').show(); else $(c).find('UL:hidden').slideDown({ duration: o.expandSpeed, easing: o.expandEasing });
                        bindTree(c);
                        o.after(data);
                    });
                }

            });

        }

    });

}