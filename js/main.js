    function add_comment() {

        $(".text-error").remove();

        // Check name
        var name = $("#inputName");
        if ( name.val().length == 0) {
            var name_error = true;
            name.after('<span class="text-error for-name" style="color:red">This field can not be empty</span>');
            $(".for-name").css({top: name.position().top + name.outerHeight() + 2});
            return;
        }
        if ( name.val().length > 50 ) {
            var name_error = true;
            name.after('<span class="text-error for-name" style="color:red">Max length is 50 symbols</span>');
            $(".for-name").css({top: name.position().top + name.outerHeight() + 2});
            return;
        }
        $("#inputName").toggleClass('error', name_error );

        // Check email
        var email = $("#inputEmail");
        if ( email.val().length == 0 ) {
            var email_error = true;
            email.after('<span class="text-error for-email" style="color:red">This field can not be empty</span>');
            $(".for-email").css({top: email.position().top + email.outerHeight() + 2});
            return;
        }
        if ( email.val().length > 100) {
            var email_error = true;
            email.after('<span class="text-error for-email" style="color:red">Max length is 100 symbols</span>');
            $(".for-email").css({top: email.position().top + email.outerHeight() + 2});
            return;
        }

        var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if( !reg.test(email.val()) ){
            email.after('<span class="text-error for-email" style="color:red">Please enter valid email address</span>');
            $(".for-email").css({top: email.position().top + email.outerHeight() + 2});
            return;
        }
        $("#inputEmail").toggleClass('error', email_error );

        // Check comment
        var comment = $("#textareaComment");
        if ( comment.val().length == 0 ) {
            var comment_error = true;
            comment.after('<span class="text-error for-comment" style="color:red">This field can not be empty</span>');
            $(".for-name").css({top: comment.position().top + comment.outerHeight() + 2});
            return;
        }
        if ( comment.val().length > 1000) {
            var comment_error = true;
            comment.after('<span class="text-error for-comment" style="color:red">Max length is 1000 symbols</span>');
            $(".for-name").css({top: comment.position().top + comment.outerHeight() + 2});
            return;
        }
        $("#textareaComment").toggleClass('error', comment_error );

        //add comment if everything ok
        var msg = $('#add_comment').serialize();
        $.ajax({
            type: 'POST',
            url: '/app/RequestHandler.php?action=add_comment',
            data: msg,
            success: function (data) {
                $('#inputName').val('');
                $('#inputEmail').val('');
                $('#textareaComment').val('');

                $('#comments').html(data);
                $(document).scrollTop( $(document).height() - $('#comments').height() - 50);
            },
            error: function (xhr, str) {}
        });
    }