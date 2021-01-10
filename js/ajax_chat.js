$(document).ready(function () {
    $('#msgAudio').play();
    fetch_user();
    setInterval(function () {
        update_last_activity();
        fetch_user();
        update_chat_history_data();
    }, 2000);

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
    function make_chat_dialog_box(to_user_id, to_user_name, toType) {
        var modal_content = '<div  id="user_dialog_' + to_user_id + '" class="chat col-12" >';

        modal_content += '<div class="chat-header clearfix">';

        modal_content += '<div class="chat-about">';
        if (toType == "Provider") {
            modal_content += '<div style="cursor:pointer;" class="chat-with"><a href="../visitProvider.php?id=' + to_user_id + '">' + to_user_name + '</a></div>';
        } else {
            modal_content += '<div class="chat-with">' + to_user_name + '-User</div>';
        }
        modal_content += '</div>';
        modal_content += '</div>';

        modal_content += '<div class="chat-history" name="' + to_user_id + '" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
        chat_content = fetch_user_chat_history(to_user_id);
        if (chat_content !== undefined) {
            modal_content += chat_content;
            // document.getElementById('msgAudio').play();
        }
        else
            modal_content += '<i style="display:block; margin:0 auto"; class="fa fa-spinner fa-pulse fa-3x fa-fw" style="margin:16px;"></i> <span class="sr-only">Loading...</span>';
        modal_content += '</div>';

        modal_content += '<div class="chat-box">';
        modal_content += '<textarea onfocus="hamada()" class="chat_message" name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '"  placeholder ="Type your message" rows="2"></textarea>';
        modal_content += '<button type="button" name="send_chat" id="' + to_user_id + '" class="send_chat">Send</button>';
        modal_content += '</div>';

        modal_content += '</div>';



        $('#user_model_details').html(modal_content);

    }


    $(document).on('click', '.start_chat', function () {
        var to_user_id = $(this).data('touserid');
        var to_user_name = $(this).data('tousername');
        var toType = $(this).data('totype');
        console.log(toType);
        console.log(to_user_name);
        make_chat_dialog_box(to_user_id, to_user_name, toType);
    });

    $(document).on('click', '.send_chat', function () {
        $('.chat-history').animate({ scrollTop: $('.chat-history').prop('scrollHeight') }, 1000);
        var to_user_id = $(this).attr('id');
        var chat_message = $('#chat_message_' + to_user_id).val().trim();
        if ((chat_message != '') && (chat_message != ' ')) {
            $.ajax({
                url: "insert_chat.php",
                method: "POST",
                data: { to_user_id: to_user_id, chat_message: chat_message },
                success: function (data) {
                    $('#chat_history_' + to_user_id).html(data);
                }
            })
            var chat_message = $('#chat_message_' + to_user_id).val(' ');
        }
    });

    function fetch_user_chat_history(to_user_id) {
        $.ajax({
            url: "fetch_user_chat_history.php",
            method: "POST",
            data: { to_user_id: to_user_id },
            success: function (data) {
                var chatDiv = $('#chat_history_' + to_user_id);
                chatDiv.html(data);
            }
        })
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

    function update_chat_history_data() {
        $('.chat-history').each(function () {
            var to_user_id = $(this).attr('name');
            fetch_user_chat_history(to_user_id);

        });

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