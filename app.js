$(document).ready(function() {
  $("#cardForm").on("submit", function(event) {
    event.preventDefault();
    distributeCards();
  });

  function distributeCards() {
    var numberOfPeople = parseInt($("#numberOfPeople").val());

    // Validate the input value
    if (isNaN(numberOfPeople) || numberOfPeople <= 0) {
      alert("Input value does not exist or value is invalid");
      return;
    }

    $.ajax({
      url: "backend.php",
      data: { numberOfPeople: numberOfPeople },
      dataType: "json",
      success: function(data) {
        var output = $("#output");
        output.text(data.join("\n"));
      },
      error: function(xhr, status, error) {
        console.log(error);
        alert("An error occurred");
      }
    });
  }
});