$(document).ready(function (e) {

    $("#addStartupForm").attr("capchSeccess", 'false');

    $("#addStartupForm").submit(function (ev) {
        if ($('#addStartupForm').attr("capchSeccess") == 'false') {
            addStartupValidate();
            ev.preventDefault();
        }
    });

    showForm4();


});

function showForm4() {

    if ($('#formPart4').hasClass('show')) {
        ga('send', 'event', 'button', 'click', 'add invent - success');
        //$('#offer-zone').show();
        //$('.next-page').css("display", "none");
        //$('.last-page').css("display", "none");
        //$('.submit input').css("display", "none");
        //$('.last-page').css("display", "none");
        $('#formPart1').hide();
        //$('#formPart1-2').hide();
        //$('#formPart2').hide();
        //$('#page-number-1').hide();
        $('#formPart4').show();
        //$('#formPart4').css("display", "inline-block");
    }
    else {
        $('#offer-zone').hide();
    }
}

function checkCaptcha() {

    recaptcha_challenge = $("input#recaptcha_challenge_field").val();
    recaptcha_response = $("input#recaptcha_response_field").val();

    $.post('wp-admin/admin-ajax.php', {
        action: 'checkCaptcha',
        recaptcha_challenge_field: recaptcha_challenge,
        recaptcha_response_field: recaptcha_response

    }
			, function (data) {
			    console.log(data);
			    if (data == 1) {
			        $('#addStartupForm').attr("capchSeccess", 'true');
			        $('#submit').click();
			        return true;
			    } else {
			        alert('captcha is not valid');
			        $('#addStartupForm').attr("capchSeccess", 'false');
			        return false;
			    }
			});



   // var formData = new FormData();
   // formData.append('aaa', "aaa");

   // $.post('wp-admin/admin-ajax.php', {
   //     action: 'addStartUp',
   //     processData: false,  // tell jQuery not to process the data
   //     contentType: false,  // tell jQuery not to set contentType
   //     cache: false,
   //     dataType: 'json',
   //     data: formData

   //     //recaptcha_challenge_field: recaptcha_challenge,
   //     //recaptcha_response_field: recaptcha_response

   // }
			//, function (data) {
			//    console.log(data);
			//}
   //             );
}
///////////////////////////////////////////////////////////validate

function addStartupValidate() {
    // var startup = {};

    $(".validate-error").hide();

    //StartUp Name
    var title = validateEmptyInput($("#title"));

    //email not empty
    var emailNotEmpty = validateEmptyInput($("#email"));

    //Invet city
    var invetCity = validateEmptyInput($("#city"));

    //Invet country
    var invetCountry = validateEmptyInput($("#country"));

    //Invet Name
    var invetName = validateEmptyInput($("#invetName"));


    //slogen's length
    var slogen = slogenValidate($("#slogen"));

    //emails
    var email = emailValidate($("#email"));
    var emailFounder = emailValidate($("#founderMail"));

    var category = dropSelect();

    //StartUp Name
    var siteNotEmpty = validateEmptyInput($("#site"));

    //description
    var descript = descriptionValidate($("#description"));

    //video
    var videotrue = (getMovieDataByURL($("#youtubeUrl").val()) != null);
    //videotrue = true;

    //site
    var site = validateSite($("#site"));

    if (title & invetName & invetCity & invetCountry & emailNotEmpty & (email == undefined || email) & (emailFounder == undefined || emailFounder) & slogen & category & siteNotEmpty & descript & videotrue & site) {
        //    startup.invetName = $("#invetName").val();
        //    startup.email = $("#email").val();
        //startup.invetCity = $("#city").val();
        //startup.invetCountry = $("#country").val();
        //        startup.title = $("#title").val();
        //  startup.founder = $("#founder").val();
        // startup.emailFounder = $("#founderMail").val();
        //startup.slogen = $("#slogen").val();
        //startup.category = [];
        // $("#category input").each(
        //    function (i) {
        //        if (this.checked) {
        //            startup.category.push = $(this).val();
        //        }
        //    });
        //    startup.tags = [];
        //    $("#tags input").each(
        //    function (i) {
        //        if (this.checked) {
        //            startup.tags.push = $(this).val();
        //        }
        //    });
        //     startup.tracks = [];
        //    $("#tracks input").each(
        //    function (i) {
        //        if (this.checked) {
        //            startup.tracks.push = $(this).val();
        //        }
        //    });
        //startup.descript = $("#description").val();
        //  startup.site = $("#site").val();
        //startup.video = $("#youtubeUrl").val()
        // 
         //if (document.getElementById(("ads")).checked && document.getElementById(("terms")).checked)
        if (document.getElementById(("terms")).checked) {
            checkCaptcha();
        }
        else{
            $("#validate-checkbox-error").show();
        }
      
       
    }
    //return true;
    //return false;
}

//validate empty field
function validateEmptyInput(input) {
    if (input.val() == "") {
        input.addClass("error");
        $("#validate-general-error").show();
        return false;
    }
    else {
        input.removeClass("error");
        $("#validate-general-error").hide();
        return true;
    }
}

//validate email field
function emailValidate(input) {
    var email = input.val();
    if (email != "") {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(email)) {
            input.addClass("error");
            $("#validate-general-error").show();
            return false;
        }
        else {
            input.removeClass("error");
            $("#validate-general-error").hide();
            return true;
        }
    }
}

//validate webSite field
function validateSite(input) {
    //if there is not http
    if (input.val() != "") {
        if (input.val().indexOf("http") == -1) {
            input.val("http://" + input.val());
        }
        return true;
    }
    else {
        $("#validate-general-error").show();
        return false;
    }

}

//validate logo field
function validateLogo(img) {
    if (img.text() == "Logo") {
        $(".formfield.input-border").addClass("error");
        $("#validate-general-error").show();
        return false;
    }
    $(".formfield.input-border").removeClass("error");
    $("#validate-general-error").hide();
    return true;
}

//validate selected
function dropSelect() {
    var catVal = false;
    var tagVal = false;
    $("#category input").each(
    function (i) {
        if (this.checked) {
            console.log(i);
            catVal = true;
        }
    });
    $("#tags input").each(
    function (i) {
        if (this.checked) {
            console.log(i);
            tagVal = true;
        }
    });
    if (catVal && tagVal) {
        $('#validate-select-error').hide();
        return true;
    }
    else {
        $('#validate-select-error').show();
        return false;
    }

}

//validate slogen field
function slogenValidate(input) {
    var words = $('#slogen').val().split('');
    if (words.length > 140 || input.val() == "") {
        input.addClass("error");
        $("#validate-slogen-error").show();
        if (input.val() == "")
            $("#validate-general-error").show();
        return false;
    }
    else {
        input.removeClass("error");
        $("#validate-slogen-error").hide();
        return true;
    }
}


//validate description field
function descriptionValidate(input) {
    var words = $('#description').val().split(' ');
    if ($('#description').val() == "") {
        input.addClass("error");
        $("#validate-general-error").show();
        return false;
    }
    else if (words.length > 200) {
        input.addClass("error");
        $("#validate-description-error").show();
        return false;
    }
    else {
        input.removeClass("error");
        return true;
    }
}
