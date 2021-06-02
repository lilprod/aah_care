$(function () {

    let pusher = new Pusher($("#pusher_app_key").val(), {
        cluster: $("#pusher_cluster").val(),
        encrypted: true
    });

    let channel = pusher.subscribe('chat');


    // on click on any chat btn render the chat box
   $(".chat-toggle").on("click", function (e) {
       e.preventDefault();

       let ele = $(this);

       let user_id = ele.attr("data-id");

       let username = ele.attr("data-user");

       cloneChatBox(user_id, username, function () {

           let chatBox = $("#chat_box_" + user_id);

           if(!chatBox.hasClass("chat-opened")) {

               chatBox.addClass("chat-opened").slideDown("fast");

               loadLatestMessages(chatBox, user_id);

               chatBox.find(".chat-area").animate({scrollTop: chatBox.find(".chat-area").offset().top + chatBox.find(".chat-area").outerHeight(true)}, 800, 'swing');
           }
       });
   });

   // on close chat close the chat box but don't remove it from the dom
   $(".close-chat").on("click", function (e) {

       $(this).parents("div.chat-opened").removeClass("chat-opened").slideUp("fast");
   });


   // on change chat input text toggle the chat btn disabled state
    $(".chat_input").on("change keyup", function (e) {
       if($(this).val() != "") {
           $(this).parents(".form-controls").find(".btn-chat").prop("disabled", false);
       } else {
           $(this).parents(".form-controls").find(".btn-chat").prop("disabled", true);
       }
    });


    // on click the btn send the message
   $(".btn-chat").on("click", function (e) {
       send($(this).attr('data-to-user'), $("#chat_box_" + $(this).attr('data-to-user')).find(".chat_input").val());
   });

   // listen for the send event, this event will be triggered on click the send btn
    channel.bind('send', function(data) {
        displayMessage(data.data);
    });


    // handle the scroll top of any chat box
    // the idea is to load the last messages by date depending of last message
    // that's already loaded on the chat box
    let lastScrollTop = 0;

   $(".chat-area").on("scroll", function (e) {
       let st = $(this).scrollTop();

       if(st < lastScrollTop) {

           fetchOldMessages($(this).parents(".chat-opened").find("#to_user_id").val(), $(this).find(".msg_container:first-child").attr("data-message-id"));
       }

       lastScrollTop = st;
   });

    // listen for the oldMsgs event, this event will be triggered on scroll top
    channel.bind('oldMsgs', function(data) {
        displayOldMessages(data);
    });
});

/**
 * loaderHtml
 *
 * @returns {string}
 */
function loaderHtml() {
    return '<i class="glyphicon glyphicon-refresh loader"></i>';
}

/**
 * cloneChatBox
 *
 * this helper function make a copy of the html chat box depending on receiver user
 * then append it to 'chat-overlay' div
 *
 * @param user_id
 * @param username
 * @param callback
 */
function cloneChatBox(user_id, username, callback)
{
    if($("#chat_box_" + user_id).length == 0) {

        let cloned = $("#chat_box").clone(true);

        // change cloned box id
        cloned.attr("id", "chat_box_" + user_id);

        cloned.find(".chat-user").text(username);

        cloned.find(".btn-chat").attr("data-to-user", user_id);

        cloned.find("#to_user_id").val(user_id);

        $("#chat-overlay").append(cloned);
    }

    callback();
}

/**
 * loadLatestMessages
 *
 * this function called on load to fetch the latest messages
 *
 * @param container
 * @param user_id
 */
function loadLatestMessages(container, user_id)
{
    let chat_area = container.find(".chat-area");

    chat_area.html("");

    $.ajax({
        url: base_url + "/load-latest-messages",
        data: {user_id: user_id, _token: $("meta[name='csrf-token']").attr("content")},
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            if(chat_area.find(".loader").length  == 0) {
                chat_area.html(loaderHtml());
            }
        },
        success: function (response) {
            if(response.state == 1) {
                response.messages.map(function (val, index) {
                    $(val).appendTo(chat_area);
                });
            }
        },
        complete: function () {
            chat_area.find(".loader").remove();
        }
    });
}

/**
 * send
 *
 * this function is the main function of chat as it send the message
 *
 * @param to_user
 * @param message
 */
function send(to_user, message)
{
    let chat_box = $("#chat_box_" + to_user);
    let chat_area = chat_box.find(".chat-area");

    $.ajax({
        url: base_url + "/send",
        data: {to_user: to_user, message: message, _token: $("meta[name='csrf-token']").attr("content")},
        method: "POST",
        dataType: "json",
        beforeSend: function () {
            if(chat_area.find(".loader").length  == 0) {
                chat_area.append(loaderHtml());
            }
        },
        success: function (response) {
        },
        complete: function () {
            chat_area.find(".loader").remove();
            chat_box.find(".btn-chat").prop("disabled", true);
            chat_box.find(".chat_input").val("");
            chat_area.animate({scrollTop: chat_area.offset().top + chat_area.outerHeight(true)}, 800, 'swing');
        }
    });
}

/**
 * fetchOldMessages
 *
 * this function load the old messages if scroll up triggerd
 *
 * @param to_user
 * @param old_message_id
 */
function fetchOldMessages(to_user, old_message_id)
{
    let chat_box = $("#chat_box_" + to_user);
    let chat_area = chat_box.find(".chat-area");

    $.ajax({
        url: base_url + "/fetch-old-messages",
        data: {to_user: to_user, old_message_id: old_message_id, _token: $("meta[name='csrf-token']").attr("content")},
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            if(chat_area.find(".loader").length  == 0) {
                chat_area.prepend(loaderHtml());
            }
        },
        success: function (response) {
        },
        complete: function () {
            chat_area.find(".loader").remove();
        }
    });
}

/**
 * getMessageSenderHtml
 *
 * this is the message template for the sender
 *
 * @param message
 * @returns {string}
 */
function getMessageSenderHtml(message)
{
  return `
        <li class="media sent" data-message-id="${message.id}">
        <div class="media-body">
          <div class="msg-box">
            <div>
              <p>${message.content}</p>
              <ul class="chat-msg-info">
                <li>
                  <div class="chat-time">
                    <!--<span>8:30 AM</span>-->
                    <time datetime="${message.id}">${message.fromUserName} • ${message.dateHumanReadable}</time>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </li>
  `;
}

/**
 * getMessageReceiverHtml
 *
 * this is the message template for the receiver
 *
 * @param message
 * @returns {string}
 */
function getMessageReceiverHtml(message)
{
    return `
    <li class="media received" data-message-id="${message.id}">
    <div class="avatar">
      <img src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image" class="avatar-img rounded-circle">
    </div>
    <div class="media-body">
      <div class="msg-box">
        <div>
          <p>${message.content}</p>
          <ul class="chat-msg-info">
            <li>
              <div class="chat-time">
                <!--<span>8:55 PM</span>-->
                <time datetime="${message.dateTimeStr}">${message.fromUserName}  • ${message.dateHumanReadable} </time>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </li>
    `;
}

/**
 * This function called by the send event triggered from pusher to display the message
 *
 * @param message
 */
function displayMessage(message)
{
    let alert_sound = document.getElementById("chat-alert-sound");

    if($("#current_user").val() == message.from_user_id) {

        let messageLine = getMessageSenderHtml(message);

        $("#chat_box_" + message.to_user_id).find(".chat-area").append(messageLine);

    } else if($("#current_user").val() == message.to_user_id) {

        alert_sound.play();

        // for the receiver user check if the chat box is already opened otherwise open it
        cloneChatBox(message.from_user_id, message.fromUserName, function () {

            let chatBox = $("#chat_box_" + message.from_user_id);

            if(!chatBox.hasClass("chat-opened")) {

                chatBox.addClass("chat-opened").slideDown("fast");

                loadLatestMessages(chatBox, message.from_user_id);

                chatBox.find(".chat-area").animate({scrollTop: chatBox.find(".chat-area").offset().top + chatBox.find(".chat-area").outerHeight(true)}, 800, 'swing');
            } else {

                let messageLine = getMessageReceiverHtml(message);

                // append the message for the receiver user
                $("#chat_box_" + message.from_user_id).find(".chat-area").append(messageLine);
            }
        });
    }
}

function displayOldMessages(data)
{
    if(data.data.length > 0) {

        data.data.map(function (val, index) {
            $("#chat_box_" + data.to_user).find(".chat-area").prepend(val);
        });
    }
}