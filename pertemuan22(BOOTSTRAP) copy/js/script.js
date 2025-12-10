$(document).ready(function() {

  // sembunyikan tombol cari
  $('#search').hide();

  // event ketika keyword ditulis
  $('#keyword').on('keyup', function() {

    // munculkan loading
    $('.load').show();

    // // ajax menggunakan load
    // $('#cont').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());

    // ajax menggunakan get
   $.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(), function(data) {
      $('#cont').html(data);
      $('.load').hide();
    });

  });

});