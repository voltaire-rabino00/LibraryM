$(document).ready(function() {
  $(".sidebar-link[href='#books']").click(function() {
    $("#dashboard").hide();
    $("#books").show();
  });

  $(".sidebar-link[href='#dashboard']").click(function() {
    $("#books").hide();
    $("#dashboard").show();
  });
});