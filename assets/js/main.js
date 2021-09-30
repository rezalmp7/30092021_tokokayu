$(document).ready(function () {

    $('#gallery').simplegallery({
        galltime: 400,
        gallcontent: '.content',
        gallthumbnail: '.thumbnail',
        gallthumb: '.thumb'
    });

});
$('#better-rating-form').betterRating({
    wrapper: '#better-rating-list'
});

$(document).ready(function () {
    $('#datatables').DataTable();
});

$(document).ready(function(){
    $("#cari_produk").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#daftar_produk>div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});