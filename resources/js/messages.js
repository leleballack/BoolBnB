$(function() {
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
});
