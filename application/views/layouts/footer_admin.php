</div>
      </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded-circle" href="#page-top">
      <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-gradient-primary text-white">
            <h5 class="modal-title font-weight-bold" id="logoutModalLabel">Konfirmasi Logout</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body py-4">
            <div class="d-flex align-items-center">
              <div class="mr-3">
                <div class="bg-primary rounded-circle p-2 text-white">
                  <i class="fas fa-sign-out-alt fa-lg"></i>
                </div>
              </div>
              <div>
                <h6 class="font-weight-bold mb-1">Anda yakin ingin logout?</h6>
                <p class="text-muted mb-0">Semua perubahan yang belum disimpan akan hilang.</p>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">
              <i class="fas fa-times mr-2"></i>Batal
            </button>
            <a class="btn btn-danger btn-gradient" href="<?= site_url('Login/Logout'); ?>">
              <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <!-- <footer class="sticky-footer bg-white border-top">
      <div class="container my-auto">
        <div class="copyright text-center my-auto py-3">
          <span class="text-muted small">Copyright &copy; SPK MARCOS - SMK Negeri Bali Mandara <?= date('Y'); ?></span>
        </div>
      </div>
    </footer> -->

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/')?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/')?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url('assets/')?>vendor/chart.js/Chart.min.js"></script>
    
    <!-- Page level plugins -->
    <script src="<?= base_url('assets/')?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/')?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url('assets/')?>js/demo/datatables-demo.js"></script>
    
    <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
      
      // Smooth scrolling for anchor links
      $('a.scroll-to-top').click(function(e) {
        e.preventDefault();
        $('html, body').animate({
          scrollTop: 0
        }, 800);
      });
    });
    
    </script>
    
  </body>
</html>