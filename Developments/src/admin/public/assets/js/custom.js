$('#sale').change(function() {
  console.log($(this).val());
  var filter = $(this).val();  
  var scope= "sale";
       
  $.ajax({
    url: "../../modules/dashboard/detail.php",
    method: "POST",
    data: {filter:filter, scope:scope},
    dataType: "JSON",
    success: function (response) {       
      $("#total_sale").text(response.total);          
      $("#percent_sale").text(response.percent);          
      $("#status_sale").text(response.status);          
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
    },
  });
});
$('#revenue').change(function() {
  console.log($(this).val());
  var filter = $(this).val();  
  var scope= "revenue";
       
  $.ajax({
    url: "../../modules/dashboard/detail.php",
    method: "POST",
    data: {filter:filter, scope:scope},
    dataType: "JSON",
    success: function (response) {       
      $("#total_revenue").text(response.total);          
      $("#percent_revenue").text(response.percent);          
      $("#status_revenue").text(response.status);          
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
    },
  });
});
$('#customer').change(function() {
  console.log($(this).val());
  var filter = $(this).val();  
  var scope= "customer";
       
  $.ajax({
    url: "../../modules/dashboard/detail.php",
    method: "POST",
    data: {filter:filter, scope:scope},
    dataType: "JSON",
    success: function (response) {       
      $("#total_customer").text(response.total);          
      $("#percent_customer").text(response.percent);          
      $("#status_customer").text(response.status);          
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
    },
  });
});


  