// var ex = document.getElementById('recipe_rating');
// ex.addEventListener('click', function(){
//     console.log('clicked');
// })

(function($){
    // console.log('main  js loaded');
    $("#recipe_rating").bind( 'rated', function(){
        // console.log('YOU CLICKED TO RATE');
        $(this).rateit( 'readonly', true );

        var form            =   {
            action:             'r_rate_recipe',
            rid:                $(this).data( 'rid' ),
            rating:             $(this).rateit( 'value' )
        };

        $.post( recipe_obj.ajax_url, form, function( data ){
            
        } )

    });

    var featured_frame              =   wp.media({
        title:                          'Select or Upload Media',
        button: {
            text:                       'Use this media'                
        },
        multiple:                       false
    });

    featured_frame.on( 'select', function(){
        var attachment              =   featured_frame.state().get('selection').first().toJSON();
        $("#recipe-img-preview").attr( 'src', attachment.url );
        $("#r_inputImgID").val( attachment.id );
    });

    $(document).on( 'click', '#recipe-img-upload-btn', function(e){
        e.preventDefault();
        featured_frame.open();
    } )

    $("#recipe-form").on( 'submit', function(e){
        console.log("TEST submitted");
        e.preventDefault();

        $(this).hide();

        $("#recipe-status").html(
            '<div class="alert alert-info">Please wait! We are submitting your recipe.</div>'
        );

        var form            =   {
            action:             'r_submit_user_recipe',
            title:              $("#r_inputTitle").val(),
            content:            tinymce.activeEditor.getContent(),
            attachment_id:      $("#r_inputImgID").val()
        }

        $.post( recipe_obj.ajax_url, form, function(data){
            if( data.status == 2 ){
                $("#recipe-status").html(
                    '<div class="alert alert-success">Recipe Submitted Successfully.</div>'
                );
            } else {
                $("#recipe-status").html(
                    '<div class="alert alert-danger">Unable to submit your recipe. Please fill in all the fields.</div>'
                );
                $( "#recipe-form" ).show();
            }
        });
    });

    $(document).on( 'submit', '#register-form', function(e){
        e.preventDefault();

        $("#register-status").html(
            '<div class="alert alert-info">Please Wait!</div>'
        );
        $(this).hide();

        var form                        =   {
            _wpnonce:                       $("#_wpnonce").val(),
            action:                         "recipe_create_account",
            name:                           $("#register-form-name").val(),
            username:                       $("#register-form-username").val(),
            email:                          $("#register-form-email").val(),
            pass:                           $("#register-form-password").val(),
            confirm_pass:                   $("#register-form-repassword").val(),
        };

        $.post( recipe_obj.ajax_url, form ).always(function(data){
            if( data.status == 2 ){
                $("#register-status").html(
                    '<div class="alert alert-success">Account Created!</div>'
                );
                location.href           =   recipe_obj.home_url;
            } else {
                $("#register-status").html(
                    '<div class="alert alert-danger">Unable to create an account.</div>'
                );
                $( "#register-form" ).show();
            }
        });

    });

    $(document).on( 'submit', '#login-form', function(e){
        e.preventDefault();

        $("#login-status").html(
            '<div class="alert alert-info">Please Wait while we log you in!</div>'
        );
        $(this).hide();

        var form                        =   {
            _wpnonce:                       $("#_wpnonce").val(),
            action:                         "recipe_user_login",
            username:                       $("#login-form-username").val(),
            pass:                           $("#login-form-password").val(),
        };

        $.post( recipe_obj.ajax_url, form ).always(function(data){
            if( data.status == 2 ){
                $("#login-status").html(
                    '<div class="alert alert-success">Success!</div>'
                );
                location.href           =   recipe_obj.home_url;
            } else {
                $("#login-status").html(
                    '<div class="alert alert-danger">Unable to login.</div>'
                );
                $( "#login-form" ).show();
            }
        });

    });

})(jQuery);