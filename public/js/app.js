$(document).ready(function() {

  $('#addCar').click(function() {

    // Serialize the data in the form
    var serializedData = $('#add-car-form').serialize();

    $.post("/add", serializedData, function(result){
      location.reload();
    });

  });

  $(".editCarBtn").click(function() {
    var carId = $(this).data('car');
    $.get("/car?car=" + carId, function(result) {
      var jsonObject = JSON.parse(result);
      var id    = jsonObject.id;
      var brand = jsonObject.brand;
      var model = jsonObject.model;
      var color = jsonObject.color;
      var price = jsonObject.price;

      $("#editBrand").val(brand);
      $("#editModel").val(model);
      $("#editColor").val(color);
      $("#editPrice").val(price);
      $("#editCar").data('car', id);
    });

    $("#editCarModal").show();
  })

  $('.edit-modal-closer').click(function() {
    $('#editCarModal').hide();
  });

  $('#editCar').click(function() {
    var serializedData = $('#edit-car-form').serialize();
    var carId = $(this).data('car');

    $.post("/edit?car=" + carId, serializedData, function(result) {
      location.reload();
    });
  });

  $('.deleteCarBtn').click(function() {
    var carId = $(this).data('car');
    $('#confirmDelete').data('car', carId);
    $('#deleteConfirmationModal').show();
  });

  $('.delete-modal-closer,#delete-modal-closer').click(function() {
    $('#deleteConfirmationModal').hide();
  });

  $("#confirmDelete").click(function() {
    var carId = $(this).data('car');
    
    $.get("/delete?car=" + carId, function(result) {
     // location.reload();
    });
  });






});