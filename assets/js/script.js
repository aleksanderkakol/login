function getPeopleNumber() {
    $.ajax({
        type: "post",
        url: "/ajax/count",
        dataType: "json",
        success: function(e, n) {
            let navbar_brand = document.querySelector('.navbar-brand');
            navbar_brand.textContent = 'Liczba osób: ' + e;
        },
        error: function(e, n, t) {
            console.log(e), console.log(n), console.log(t);
            let navbar_brand = document.querySelector('.navbar-brand');
            navbar_brand.textContent = 'Błąd połączenia z serwerem!';
        },
        complete: function(o, e) {}
    })
}
getPeopleNumber();
setInterval(getPeopleNumber, 1000 * 60);

function peopleSuggests(input) {
    $.ajax({
        type: "post",
        url: "/ajax/people",
        dataType: "json",
        success: function(e, n) {
            $('.ui-helper-hidden-accessible').remove();
            $(input).autocomplete({
                maxShowItems: 10,
                source: e
            });
        },
        error: function(e, n, t) {
            console.log(e), console.log(n), console.log(t);
        },
        complete: function(o, e) {}
    })
}

function doorSuggests(input) {
    $.ajax({
        type: "post",
        url: "/ajax/doors",
        dataType: "json",
        success: function(e, n) {
            $(input).autocomplete({
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
    const teamarray = ["DN", "DT", "DE", "DF", "DP", "DG", "DR", "EU", "ED", "EM", "EB", "EO", "EG", "FK", "IR", "II", "LB", "LP", "ME", "MA", "MM", "MT", "MB", "MI", "NK", "NI", "NA", "NB", "NZ", "NS", "ND", "NO", "NR", "OE", "OZ", "OA", "OR", "OS", "OM", "OG", "PE", "PT", "PS", "TL", "TM", "TR", "TI"]
    $.ajax({
        type: "post",
        url: "/ajax/lista",
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
            //employees
            for (let i = 0; i < teamarray.length; i++) {
                let arrayfiltered = arraymap.filter(function(item) {
                    return item.name.indexOf(`[${teamarray[i]}]`) > -1;
                })
                let total = 0;
                for (let j = 0; j < arrayfiltered.length; j++) {
                    total = total + arrayfiltered[j].quantity
                }
                if (total === 0) {
                    $(`.${teamarray[i]}`).parent().parent().parent().css('display', 'none');
                } else {
                    $(`<p><strong>Liczba osób ${total}</strong></p>`).appendTo($(`.${teamarray[i]}`).parent().parent().parent().find('.panel-heading'));
                }
            }
            // guests and others
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
    });
}