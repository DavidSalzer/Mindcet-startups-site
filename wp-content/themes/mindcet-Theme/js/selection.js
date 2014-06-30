$(document).ready(function (e) {
    $('#categoryNav,#tagsNav').on('change', this, function () {
        setTimeout(function () {
            catId = $('#categoryNav').val();
            tagName = $('#tagsNav').val();
            year = $('#yearNav').val();
            buildCatGallery(catId, tagName, year);
        }, 500);
    });



});

var catGalleryCall;

function buildCatGallery(catId, tagName, year) {

    if (tagName == 'none') {
        tagName = '';
    }
    if (catId == 'none') {
        catId = '';
    }

    catGalleryCall = jQuery.post('wp-admin/admin-ajax.php', {
        catId: catId,
        tagName: tagName,
        currentYear: year,
        action: 'catGallery'
    }
			, function (data) {

			    console.log(data);
			    $('.inventList').fadeOut();
			    $('#scrollInventorCon').html(data);
			    $('.inventList').fadeIn();
			    setStartupUl();
			    $('#scrollInventorCon').animate({ scrollLeft: 0 });
			    showArrowsStartups();

			});

}

function stopAjax() {
    if (catGalleryCall) {
        catGalleryCall.abort();
    }
}