$(".messages").animate({
    scrollTop: $(document).height()
}, "fast");

//# sourceURL=pen.js
$(document).ready(function () {

    $(function () {
        $('.message').keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                sendTxtMessage($(this).val());
            }
        });
        $('.btnSendData').click(function () {
            sendTxtMessage($('.message').val());
        });

        $(document).on('click', '.selectVendor', function (e) {
            ChatSection(1);
            var receiver_id = $(this).attr('id');
            //alert(receiver_id);
            $('#ReciverId_txt').val(receiver_id);
            let res = $('#ReciverName_txt').html($(this).attr('title'));
            $('#ReciverName_txt').html($(this).attr('title'));
            GetChatHistory(receiver_id);
        });

        $('.upload_attachmentfile').change(function () {
            DisplayMessage('<div class="spiner"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
            // ScrollDown();
            var file_data = $('.upload_attachmentfile').prop('files')[0];
            var receiver_id = $('#ReciverId_txt').val();
            var form_data = new FormData();
            form_data.append('attachmentfile', file_data);
            form_data.append('type', 'Attachment');
            form_data.append('receiver_id', receiver_id);
            $.ajax({
                url: 'chat-attachment/upload',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    $('.upload_attachmentfile').val('');
                    GetChatHistory(receiver_id);
                },
                error: function (jqXHR, status, err) {
                    // alert('Local error callback');
                }
            });
        });
        $('.ClearChat').click(function () {
            var receiver_id = $('#ReciverId_txt').val();
            $.ajax({
                //dataType : "json",
                url: 'chat-clear?receiver_id=' + receiver_id,
                success: function (data) {
                    GetChatHistory(receiver_id);
                },
                error: function (jqXHR, status, err) {
                    // alert('Local error callback');
                }
            });
        });
    }); ///end of jquery

    function ViewAttachment(message_id) { }

    function ViewAttachmentImage(image_url, imageTitle) {
        $('#modelTitle').html(imageTitle);
        $('#modalImgs').attr('src', image_url);
        $('#myModalImg').modal('show');
    }

    function ChatSection(status) {
        if (status == 0) {
            $('#chatSection :input').attr('disabled', true);
        } else {
            $('#chatSection :input').removeAttr('disabled');
        }
    }
    ChatSection(0);

    function DisplayMessage(message) {
        var Sender_Name = $('#Sender_Name').val();
        var Sender_ProfilePic = $('#Sender_ProfilePic').val();
        var str = `<li class="sent">`;
        str += `<img src="${Sender_ProfilePic}" alt="">`;
        str += `<p>${message}</p></li>`;
        $('#dumppy').append(str);
    }

    function sendTxtMessage(message) {
        var messageTxt = message.trim();
        if (messageTxt != '') {
            //console.log(message);
            DisplayMessage(messageTxt);
            var receiver_id = $('#ReciverId_txt').val();
            $.ajax({
                dataType: "json",
                type: 'post',
                data: {
                    messageTxt: messageTxt,
                    receiver_id: receiver_id
                },
                url: base_url + 'chat/send_message',
                success: function (data) {
                    GetChatHistory(receiver_id)
                },
                error: function (jqXHR, status, err) { }
            });
            // ScrollDown();
            $('.message').val('');
            $('.message').focus();
        } else {
            $('.message').focus();
        }
    }

    function ScrollDown() {
        var elmnt = document.getElementById("konten");
        var h = elmnt.scrollHeight;
        console.log(h);
        $('#konten').animate({
            scrollTop: h
        }, 1000);
    }
    // window.onload = ScrollDown();

    function GetChatHistory(receiver_id) {
        $.ajax({
            url: base_url + 'chat/chat_history?receiver_id=' + receiver_id,
            success: function (data) {
                $('#dumppy').html(data);
                ScrollDown();
            },
            error: function (jqXHR, status, err) {
                // alert('Local error callback');
            }
        });
    }

    setInterval(function () {
        var receiver_id = $('#ReciverId_txt').val();
        if (receiver_id != '') {
            GetChatHistory(receiver_id);
        }
    }, 5000);

    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>chat/fetchData",
            method: "POST",
            dataType: 'html',
            data: {
                query: query
            },
            success: function (data) {
                parser = new DOMParser();
                doc = parser.parseFromString(data, "text/html");
                console.log(doc);
                $('#res').html(data);
            }
        })
    }
});
