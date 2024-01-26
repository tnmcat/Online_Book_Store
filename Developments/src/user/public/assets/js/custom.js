$(document).ready(function () {
  $(".plus").click(function (e) {
    e.preventDefault();
    var qty = $("#input-qty").val();
    var value = parseInt(qty);
    value = isNaN(value) ? alert("Quantity must be number") : value;
    if (value < 100) {
      value++;
      $("#input-qty").val(value);
    }
  });
  $(".minus").click(function (e) {
    e.preventDefault();
    var qty = $("#input-qty").val();
    var value = parseInt(qty);
    value = isNaN(value) ? alert("Quantity must be number") : value;
    if (value > 1) {
      value--;
      $("#input-qty").val(value);
    }
  });
  $(".add-btn").click(function (e) {
    e.preventDefault();
    var qty_input = $("#input-qty").val();
    var book_id = $(this).attr("data-id");
    var book_price = $(this).attr("data-price");
    if (qty_input > 0) {
      if (qty_input < 100) {
        location.reload(true);
        $.ajax({
          url: "../cart/add.php",
          method: "POST",
          data: {
            qty_input: qty_input,
            book_id: book_id,
            book_price: book_price,
          },
          success: function (data) {
            alert("Add cart successfully");
          },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
          },
        });
      } else {
        alert("Please contact admin for wholesale customer policy");
      }
    } else {
      alert("Quantity must be greater than 0");
    }
  });

  $(".input-qty").change(function () {
    var qty_input = $(this).val();
    var book_price = $(this).attr("data-price");
    var book_id = $(this).attr("data-id");
    if (qty_input == 0) {
      alert("Quantity must be greater than 0");
      
    } else if (qty_input > 100) {
      alert("Please contact admin for wholesale customer policy");
    }
    else{
      $.ajax({
        url: "../cart/update.php",
        method: "POST",
        data: { qty_input: qty_input, book_id: book_id, book_price: book_price },
        dataType: "JSON",
        success: function (response) {
          $("#subtotal-" + book_id).text(response.subtotal);
          $("#qty-book-id-" + book_id).text(response.qty);
          $("#total").text(response.total);
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        },
      });
    }

  });

  $(".input-qty").change(function () {
    var total = 0;
    $(".input-qty").each(function () {
      var qty = $(this).val();
      var book_price = $(this).attr("data-price");
      var subtotal = parseInt(qty * book_price);
      total = total + subtotal;
    });
    $("#overall_total").text(total);
  });
});
