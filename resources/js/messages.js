$(function() {
  $(".search-bar").keyup(function() {
    var word = $(this)
      .val()
      .toLowerCase();
    $(".chat_list").each(function() {
      if (
        $(this)
          .find(".apt_title, .contacts")
          .text()
          .toLowerCase()
          .includes(word)
      ) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
});
