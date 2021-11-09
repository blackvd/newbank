/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/
$('.scrollTop').click(function () {
    $("html, body").animate({ scrollTop: 0 });
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function (e) {
    e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
*/

function multiCheck(tb_var) {
    tb_var.on("change", ".chk-parent", function () {
        var e = $(this).closest("table").find("td:first-child .child-chk"), a = $(this).is(":checked");
        $(e).each(function () {
            a ? ($(this).prop("checked", !0), $(this).closest("tr").addClass("active")) : ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
    }),
        tb_var.on("change", "tbody tr .new-control", function () {
            $(this).parents("tr").toggleClass("active")
        })
}

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
    template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
    var sAgent = window.navigator.userAgent;
    var Idx = sAgent.indexOf("MSIE");

    // If IE, return version number.
    if (Idx > 0)
        return parseInt(sAgent.substring(Idx + 5, sAgent.indexOf(".", Idx)));

    // If IE 11 then look for Updated user agent string.
    else if (!!navigator.userAgent.match(/Trident\/7\./))
        return 11;

    else
        return 0; //It is not IE
}

/*
================================================
|           add Agent Depot script             |
================================================
*/

$("#btnFormAgent").on('click', () => {
    Swal.fire({
        icon: "question",
        title: "Ajout d'agent",
        text: "Voulez vous ajouter ce agent ?",
        showCancelButton: true,
        confirmButtonColor: 'primary',
        confirmButtonText: 'Enregistrez',
        cancelButtonColor: '#bbb',
        cancelButtonText: "Annuler",
        preConfirm: () => {
            axios.post("/admin/useragent", {
                nameAgent: $("#name").val(),
                username: $("#username").val(),
                paswd: $("#pswd").val(),
                paswd_confirmation: $("#confirmation").val(),
                role: $("#role").val(),
            }).then(response => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response.data.message,
                }).then(result => {
                    if (result.isConfirmed) {
                        $("#name").val("");
                        $("#username").val("");
                        $("#pswd").val("");
                        $("#confirmation").val("");
                        window.location.reload()
                    }
                })
                window.location.reload
            }).catch(error => {
                let erreur = '';
                datas = error.response.data.errors.paswd;
                datas.forEach(element => {
                    erreur += `<p class="help text-bold text-danger">` + element + `</p><br>`
                });
                Swal.fire({
                    title: error.response.data.message,
                    position: 'center',
                    icon: 'error',
                    html: erreur,
                }).then(result => {
                    if (result.isConfirmed) {
                        $("#name").val("");
                        $("#username").val("");
                        $("#pswd").val("");
                        $("#confirmation").val("");
                    }
                })
            })
        }
    }).then((result) => {
        if (!result.isConfirmed) {
            Swal.fire({
                title: "Ajout d'agent",
                text: "Action annulez",
                icon: "info",
            }).then(result => {
                if (result.isConfirmed) {
                    $("#name").val("");
                    $("#username").val("");
                    $("#pswd").val("");
                    $("#confirmation").val("");
                    window.location.reload()
                }
            })
        }
    })
})