function getPeopleNumber() {
    $.ajax({
        type: "post",
        url: "/www/home/count",
        dataType: "json",
        success: function(e, n) {
            let navbar_brand = document.querySelector('.navbar-brand');
            navbar_brand.textContent = 'Liczba osób: ' + e;
        },
        error: function(e, n, t) {
            console.log(e), console.log(n), console.log(t);
            let navbar_brand = document.querySelector('.navbar-brand');
            navbar_brand.textContent = 'Odśwież stronę!';
        },
        complete: function(o, e) {}
    })
}
getPeopleNumber();
setInterval(getPeopleNumber, 1000 * 60);

function getVisitorCards() {
    $.ajax({
        type: "post",
        url: "/www/visit/option",
        dataType: "json",
        success: function(e, n) {
            const doctype = document.getElementById('doctype');
            const vcardOption = document.getElementById('card_id');
            if (vcardOption && doctype) {
                e.docname.map((e, n) => {
                    $(`<option class='ajax_option' value=${e.doctype_id}>${e.doctype_name}</option>`).appendTo(doctype);
                });
                e.vcards.map((e, n) => {
                    $(`<option class='ajax_option' value=${e.id}>${e.name}</option>`).appendTo(vcardOption);
                });
            }
        },
        error: function(e, n, t) {
            console.log(e), console.log(n), console.log(t);
        },
        complete: function(o, e) {}
    })
}

function openExe() {
    $.ajax({
        type: "post",
        url: "/www/home/exe",
        dataType: "json",
        success: function(e, n) {},
        error: function(e, n, t) {
            console.log(e), console.log(n), console.log(t);
        },
        complete: function(o, e) {}
    })
}
const zewng = document.getElementById('zewng');
zewng.addEventListener('click', function(e) {
    e.preventDefault();
    openExe();
});

function peopleSuggests() {
    $.ajax({
        type: "post",
        url: "/www/raport/people",
        dataType: "json",
        success: function(e, n) {
            $("#raport_username").autocomplete({
                source: e
            });
        },
        error: function(e, n, t) {
            console.log(e), console.log(n), console.log(t);
        },
        complete: function(o, e) {}
    })
}

function doorSuggests() {
    $.ajax({
        type: "post",
        url: "/www/raport/doors",
        dataType: "json",
        success: function(e, n) {
            $("#raport_doorname").autocomplete({
                source: e
            });
        },
        error: function(e, n, t) {
            console.log(e), console.log(n), console.log(t);
        },
        complete: function(o, e) {}
    })
}

function getUsers() {
    let teamarray = [
        "DN",
        "DT",
        "DE",
        "DF",
        "DP",
        "DG",
        "DR",
        "EU",
        "ED",
        "EM",
        "EB",
        "EO",
        "EG",
        "FK",
        "IR",
        "II",
        "LB",
        "LP",
        "ME",
        "MA",
        "MM",
        "MT",
        "MB",
        "MI",
        "NK",
        "NI",
        "NA",
        "NB",
        "NZ",
        "NS",
        "ND",
        "NO",
        "NR",
        "OE",
        "OZ",
        "OA",
        "OR",
        "OS",
        "OM",
        "OG",
        "PE",
        "PT",
        "PS",
        "TL",
        "TM",
        "TR",
        "TI"
    ]
    const divs = document.querySelectorAll(".ajax");
    $.ajax({
        type: "post",
        url: "/www/login/getUsers",
        dataType: "json",
        success: function(response, status) {
            let arraymap = response.map((item, index) => {
                if (item.user_name.indexOf('[') >= 0) {
                    let divclass = item.user_name.slice(-3, -1);
                    $(`<tr class='ajax_fetch' value=${item.quantity} ><td>${item.user_name}</td><td>${item.dor_name}</td></tr>`).appendTo(`tbody.${divclass}`);
                } else {
                    $(`<tr class='ajax_fetch' value=${item.quantity} ><td>${item.user_name}</td><td>${item.dor_name}</td><td>${item.quantity}</td></tr>`).appendTo(`tbody.others`);
                }
                return { quantity: item.quantity, name: item.user_name };
            });
            for (let i = 0; i < teamarray.length; i++) {
                let arrayfiltered = arraymap.filter(function(item) {
                    return item.name.indexOf(`[${teamarray[i]}]`) > -1;
                })
                let total = 0;
                for (let j = 0; j < arrayfiltered.length; j++) {
                    total = total + arrayfiltered[j].quantity
                }
                $(`<p><strong>Liczba osób ${total}</strong></p>`).appendTo($(`.${teamarray[i]}`).parent().parent().parent().find('.panel-heading'));
            }
            let othersfiltered = arraymap.filter(function(item) {
                return item.name.indexOf(`[`) === -1;
            })
            let othersquantity = 0;
            for (let k = 0; k < othersfiltered.length; k++) {
                othersquantity = othersquantity + othersfiltered[k].quantity
            }
            $(`<p><strong>Liczba osób ${othersquantity}</strong></p>`).appendTo($(`.others`).parent().parent().parent().find('.panel-heading'));
        },
        error: function(e, n, t) {
            console.log(e), console.log(n), console.log(t);
        }
    })
}