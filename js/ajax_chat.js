$(document).ready(function () {
    fetch_user();
    setInterval(function () {
        update_last_activity();
        fetch_user();
        update_chat_history_data();
    }, 5000);

    function fetch_user() {
        $.ajax({
            url: "fetch_user.php",
            method: "POST",
            success: function (data) {
                $('#user_details').html(data);
            }
        })
    }
    function update_last_activity() {
        $.ajax({
            url: "update_last_activity.php",
            success: function () {
            }
        })
    }
    function make_chat_dialog_box(to_user_id, to_user_name) {
        var modal_content = '<div  id="user_dialog_' + to_user_id + '" class="chat col-12" >';

        modal_content += '<div class="chat-header clearfix">';

        modal_content += '<div class="chat-about">';
        modal_content += '<div class="chat-with">' + to_user_name + '</div>';
        modal_content += '</div>';

        modal_content += '</div>';

        modal_content += '<div class="chat-history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
        modal_content += fetch_user_chat_history(to_user_id);
        modal_content += '</div>';

        modal_content += '<div class="chat-box">';
        modal_content += '<textarea class="chat_message" name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '"  placeholder ="Type your message" rows="2"></textarea>';
        modal_content += '<button type="button" name="send_chat" id="' + to_user_id + '" class="send_chat">Send</button>';
        modal_content += '</div>';

        modal_content += '</div>';

        $('#user_model_details').html(modal_content);
    }

    $(document).on('click', '.start_chat', function () {
        var to_user_id = $(this).data('touserid');
        var to_user_name = $(this).data('tousername');
        make_chat_dialog_box(to_user_id, to_user_name);

    });

    $(document).on('click', '.send_chat', function () {
        var to_user_id = $(this).attr('id');
        var chat_message = $('#chat_message_' + to_user_id).val().trim();
        // var thi =  $(this);
        if((chat_message != '') && (chat_message != ' ')) {
        $.ajax({
            url: "insert_chat.php",
            method: "POST",
            data: { to_user_id: to_user_id, chat_message: chat_message },
            success: function (data) {

                $('#chat_history_' + to_user_id).html(data);
                
            }
        })
        var chat_message = $('#chat_message_' + to_user_id).val(' ');
        // console.log(chat_message);
    }
    });

    function fetch_user_chat_history(to_user_id) {
        $.ajax({
            url: "fetch_user_chat_history.php",
            method: "POST",
            data: { to_user_id: to_user_id },
            success: function (data) {
                $('#chat_history_' + to_user_id).html(data);
            }
        })
    }

    function update_chat_history_data() {
        $('.chat_history').each(function () {
            var to_user_id = $(this).data('touserid');
            fetch_user_chat_history(to_user_id);
        });
    }


    function fetch_user_chat_history(to_user_id) {
        $.ajax({
            url: "fetch_user_chat_history.php",
            method: "POST",
            data: { to_user_id: to_user_id },
            success: function (data) {
                $('#chat_history_' + to_user_id).html(data);
            }
        })
    }



    $(document).on('focus', '.chat_message', function () {
        var is_type = 'yes';
        $.ajax({
            url: "update_is_type_status.php",
            method: "POST",
            data: { is_type: is_type },
            success: function () {
            }
        })
    });

    $(document).on('blur', '.chat_message', function () {
        var is_type = 'no';
        $.ajax({
            url: "update_is_type_status.php",
            method: "POST",
            data: { is_type: is_type },
            success: function () {
            }
        })
    });

});  