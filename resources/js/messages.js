$(function() {
  $(".fa-paper-plane").click(function() {
    var text = $(".write_msg").val();
    if (text) {
      var new_text = $(".template .outgoing_msg").clone();
      new_text.find(".content").text(text);
      new_text.find(".message_time").text();
      $(".msg_history").append(new_text);
      $(".msg_history").scrollTop(10000);
    }
    $(".write_msg").val("");
  });

  $(".write_msg").keypress(function(e) {
    var key = e.which;
    if (key == 13) {
      $(".fa-paper-plane").click();
      return false;
    }
  });

  $(".search-bar").keyup(function() {
    var lookup = $(this)
      .val()
      .toLowerCase();
    $(".chat_people").each(function() {
      if (
        $(this)
          .find(".apt_title, .contacts")
          .text()
          .toLowerCase()
          .includes(lookup)
      ) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  $(".chat_list").click(function() {
    var chat = $(this).attr("data-attribute");
    var chatscreen = $('.msg_history[data-attribute="' + chat + '"]');
    console.log(chatscreen);
    $(".msg_history").removeClass("active_chat");
    $(".chat_list").removeClass("active_chat");
    chatscreen.addClass("active_chat");
    $(this).addClass("active_chat");
  });
});
