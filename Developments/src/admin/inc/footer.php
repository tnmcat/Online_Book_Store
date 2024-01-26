  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>OnBookStore</span></strong>. All Rights Reserved
    </div>
    <div class="credits">     
      Designed by <a href="https://bootstrapmade.com/">Group 5 Aptech</a>
    </div>
  </footer>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="../../public/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../public/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../public/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../public/assets/vendor/quill/quill.min.js"></script>
  <script src="../../public/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../public/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../public/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../public/assets/js/main.js"></script>


  <!-- khai báo file js tự viết ở đây -->
  <script src="../../public/assets/js/custom.js"></script>
  <!-- search feedback -->
  <script>
    $(document).ready(function(){
    load_data();
    function load_data(search){
        $.ajax({
            url:"search.php",
            method:"POST",
            data:{query: search},
            success:function(data){
                    $('#txtDisplay').html(data);
            }
        });
    }
    $('#txtSearch').keyup(function(){
        var search = $(this).val();
        if(search != ''){
                load_data(search);
        }
        else{
                load_data();
        }
    });
});
  </script>

</body>

</html>