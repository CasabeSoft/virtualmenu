var readOnlyMenu = true;
var sectionConfig = {
    1: {inputType: "radio", showPrice: false},
    2: {inputType: "checkbox", showPrice: true},
    3: {inputType: "radio", showPrice: true}
};
var menus = [];
var orders = [];
var bills = [];
var selectedMenuIndex = 0;
var currentMenu = Menu.EMPTY();
var currentOrder = Order.EMPTY();
var currentBill = Bill.EMPTY();

function higlightSelection(input) {
    var li = $(input).parent();
    if ($(input).attr("type") === "radio") {
        $(li).parent().children().removeClass("selected");
        $(li).addClass("selected");
    } else {
        $(li).toggleClass("selected");
    }
}

function today() {
    var today = new Date();
    return new Date(today.getFullYear(), today.getMonth(), today.getDate());
}

function changeMenuActionsState(readOnly) {
    readOnlyMenu = readOnly;
    $("#btnConfirm, #btnAddOrder").button({disabled: readOnlyMenu});
}

function showMenuContent(data) {
    $.each(currentMenu.sections, function(sIndex, section) {
        $.each(data, function (index, product) {
            if (section.id == product.id_section) {
                var p = new Product(
                    product.id_product,
                    product.name,
                    product.order,
                    product.price,
                    product.id_section);
                p.input_type = sectionConfig[section.id_type].inputType;
                section.products.push(p);
            }
        });
        $.link.sectionProductsTemplate(section.products, "#sectionId" + section.id + " ul.products");
        $.link.previewProductsTemplate(section.products, "#preview_sectionId" + section.id + " ul.products");
        $("#sectionId" + section.id + " button.btnRemoveProduct").button({
            icons: {primary: 'ui-icon-minus'},
            text: false,
            disabled: readOnlyMenu
        });
        $(".addZone button").button({disabled: readOnlyMenu});
        if (readOnlyMenu)
            $(".addZone input").attr("disabled", "disabled");
        else
            $(".addZone input").removeAttr("disabled");
    });
    $("#menuContent .products").sortable({
        placeholder: "ui-state-highlight",
        forcePlaceholderSize: true,
        update: function(event, ui) {
            alert(ui.item);
        }
    });
}

function menuId_click(input) {
    var index = 0;
    var menuIdPrefixLen = "menuId".length;
    var id = $(input).attr("id").substr(menuIdPrefixLen);
    higlightSelection(input);
    for(; index < menus.length && menus[index].id != id; index++);
    selectedMenuIndex = index;
    initMenu(menus[index]);
    $.ajax({
        url: BASE_URL + "menuofthedaycontroller/getMenuContent/" + id,
        dataType: 'json',
        success: function(data) {
            showMenuContent(data);
        },
        error: errorRetreavingAjax
    });
}

function showMenus(newMenus) {
    menus = newMenus;
    $.link.menuListTemplate(menus, "#lMenus");
    $.observable(orders).refresh([]);
    $.observable(bills).refresh([]);
    if (menus.length > 0) {
        $("#lMenus input:first").click();
        $("#sNoMenuMessage").hide();
    } else {
        initMenu(Menu.EMPTY());
        $("#sNoMenuMessage").show();
    }
}

function errorRetreavingAjax(e, xhr, exception) {
    alert("error: " + exception);
}

function getMenusAndBillsForDate(date) {
    changeMenuActionsState(new Date(date) < today());
    $.ajax({
        url: BASE_URL + "menuofthedaycontroller/getMenusAndBillsForDate/" + date,
        dataType: 'json',
        success: function (data) {
            showMenus(data.menus);
            var newBills = [];
            $.each(data.bills, function (index, bill) {
                newBills.push(Bill.buildFrom(bill));
            });
            $.observable(bills).refresh(newBills);
            $(".buttonRemove").button({
                icons: {primary: 'ui-icon-minus'},
                text: false
            });
        },
        error: errorRetreavingAjax   // TODO: Procesar errores
    });
}

function getSelectedDate() {
    return $.datepicker.formatDate($.datepicker.ATOM, $("#calendar").datepicker("getDate"));
}

function addProduct_click(button) {
    var sectionIdPrefixLen = "sectionId".length;
    var section = $(button).parent().parent();
    var newProductId = $(section).find('.newProductId')
    var productId = newProductId.val();
    if (productId == undefined || productId == null | productId == "" || productId == 0)
        return;
    var sectionId = $(section).attr("id").substr(sectionIdPrefixLen);
    var products = $(section).children(".products");
    var newProductName = $(section).find('.newProductName');
    var price = $(section).find('.newProductPrice');
    var productName = $(newProductName).val();
    var productPrice = ($(price).css("visibility") == "hidden")
        ? 0
        : isFinite(parseFloat($(price).val()))
            ? parseFloat($(price).val())
            : 0;
    for(i=0; i < currentMenu.sections.length && currentMenu.sections[i].id != sectionId; i++);
    var newProduct = new Product(productId, productName,
        currentMenu.sections[i].products.length , productPrice, sectionId);
    newProduct.input_type = sectionConfig[currentMenu.sections[i].id_type].inputType;
    $.observable(currentMenu.sections[i].products).insert(newProduct.order, newProduct);
    $(newProductId).val("");
    $(newProductName).val("");
    $(price).val("");
    $("#sectionId" + sectionId + " button.btnRemoveProduct").button({
            icons: {primary: 'ui-icon-minus'},
            text: false,
            disabled: readOnlyMenu
    });
    $(newProductName).focus();
}

function initMenu(menu) {
    $.observable(currentMenu).setProperty({
        "id": menu.id,
        "id_type": menu.id_type,
        "name": menu.name,
        "base_price": eval(menu.base_price),
        "description": menu.description
    });
    $("#sMenuType option[value|=" + currentMenu.id_type + "]").attr("selected", "selected");
    $("#tComments").val("");
    currentMenu.sections = [];
    if (currentMenu.id_type != null)
        $.each(sectionsByMenuType[currentMenu.id_type], function (index, section) {
            currentMenu.sections.push($.extend(true, {}, section));
        });
    $("#menuSections").html($.templates.menuSectionsTemplate.render(currentMenu.sections));
    $("#previewSections").html($.templates.previewSectionsTemplate.render(currentMenu.sections));
    $(".buttonAdd").button({
        icons: {primary: 'ui-icon-plus'},
        text: false
    });
    $(".productFilter").autocomplete({
        minLength: 2,
        source: BASE_URL + "menuofthedaycontroller/getProducts",
        select: function(event, ui) {
            $(this).parent().children(".newProductId").val(ui.item.id);
            $(this).parent().children(".newProductName").val(ui.item.label);
            $(this).parent().children(".newProductPrice").val(ui.item.base_price);
            return false;
        }
    });
    $(".newProductName, .newProductPrice").keypress(function(e) {
        if (e.which == 13) {
            $(this).parent().children(".buttonAdd").click();
            $(this).parent().children(".newProductName").focus();
        }
    });
}

function btnNew_click() {
    $("#sMenuType").removeAttr("disabled");
    changeMenuActionsState(false);
    $.observable(currentMenu).setProperty("id", 0);
    sMenuType_change();
    selectOption("lMenus", -1);
}

function selectOption(optionListId, index) {
    if (index >= 0) {
    $("#" + optionListId + " li:nth-child(" + (index + 1) + ")")
        .addClass("selected")
        .children("input").attr("checked", "checked");
    } else {
        $("#lMenus li.selected").removeClass("selected");
        $("#lMenus input").removeAttr("checked");
    }
}

function btnSave_click() {
    if (!currentMenu.id_type) return;

    var date = getSelectedDate();
    $.ajax({
        type: 'POST',
        url: BASE_URL + "menuofthedaycontroller/saveMenuForDate/" + date,
        dataType: 'json',
        data: {"menu": eval("(" + JSON.stringify(currentMenu) + ")")},  // HACK! En Firefox falla si se pasa currentMenu, tal cual; entonces, garantizamos con esto que el objeto pueda ser un json correctamente formado.
        success: function (data) {
            if (data == 0)
                alert("Ha ocurrido un error guardando los cambios");
            else {
                if (currentMenu.id == 0) {
                    currentMenu.id = data;
                    $.observable(menus).insert(menus.length, currentMenu.clone());
                    selectedMenuIndex = menus.length - 1;
                } else {
                    menus[selectedMenuIndex] = currentMenu.clone();
                    $.observable(menus).refresh(menus);
                }
                selectOption("lMenus", selectedMenuIndex);
            }
        },
        error: errorRetreavingAjax   // TODO: Procesar errores
    });
}

function btnDelete_click() {
    if (!currentMenu.id_type || currentMenu.id == 0) return;

    if (confirm("¿Quiere eliminar el menú actual?"))
        $.ajax({
        url: BASE_URL + "menuofthedaycontroller/removeMenu/" + currentMenu.id,
        success: function (data) {
            $.observable(menus).remove(selectedMenuIndex);
            selectedMenuIndex = menus.length > 0 && selectedMenuIndex == 0
                ? 0 : selectedMenuIndex - 1;
            selectOption("lMenus", selectedMenuIndex);
        },
        error: errorRetreavingAjax   // TODO: Procesar errores
    });
}

function sMenuType_change() {
    var current = document.getElementById("sMenuType").selectedIndex;
    var baseMenuInfo =  menuTypes[current];
    var menu = new Menu(currentMenu.id, baseMenuInfo.id, baseMenuInfo.name, "0.00",
        baseMenuInfo.description, []);
    initMenu(menu);
    showMenuContent([]);
}

function orderMenu() {
    var newOrder = new Order(0, currentMenu.clone(), $("#tComments").val(), []);
    $("li.selected").each(function(index, item) {
        if ($(item).attr("data-id"))
            newOrder.products.push(new Product(
                $(item).attr("data-id"), $(item).attr("data-name"), 0, eval($(item).attr("data-price"))));
    });
    $.observable(orders).insert(orders.length, newOrder);
    $(".buttonRemove").button({
        icons: {primary: 'ui-icon-minus'},
        text: false
    });
}

function assert(condition, message) {
    if (!condition)
        alert(message);
    return condition;
}

function confirmOrderRequest() {
    if (!assert(orders.length > 0, "Antes de confirmar, debe añadir a su pedido al menos un menú."))
        return;
    $("#totalPrice").text($.views.helpers["formatCurrency"](Bill.calcAmount(orders)));
    $("#dlgConfirmOrder").dialog("open");
}

function needChange_click(sender) {
    if (sender.id == "nchNo") {
        $("#cachAmount").val("");
        $("#cachAmount").css("visibility", "hidden");
    } else
        $("#cachAmount").css("visibility", "visible");
}

function payMode_click(sender) {
    switch (sender.id) {
        case "pmCach":
            $("#pmCachParams input").prop('disabled', false);
            break;
        case "pmCard":
        case "pmPayPal":
            pmCachParamsInit();
            $("<div title='Alerta'><strong>¡En breve!</strong><br/>Estamos trabajando para incluir nuevas formas de pago pero, de momento, solo está disponible el pago en efectivo.</div>")
                .dialog({autoOpen: true, modal: true,
                    buttons: {"Aceptar": function() { $(this).dialog("close"); } },
                    close: function () { $("#pmCach").click(); }
                });
            break;
    }
}

function confirmOrder() {
    if (!(assert($("input[name|=payMode]:checked").length > 0, "Debe seleccionar un método de pago, para confirmar su orden.")
        && assert($("input[name|=payMode]:checked").attr("id") == "pmCach" && ($("#nchNo").prop("checked") || $.isNumeric($("#cach").val())),
                  "Si indicó que necesita cambio, debe indicar para qué cantidad lo necesita")
       ))
        return;
    var comments = $("input[name|=payMode]:checked").attr("id") == "pmCach" && $("#nchYes").prop("checked")
            ? $("#cach").val() : null;
    var newBill = new Bill(0, orders, comments, $("input[name|=payMode]:checked").val());
    $(this).dialog("close");
    $.ajax({
        type: 'POST',
        url: BASE_URL + "menuofthedaycontroller/confirmOrder",
        dataType: 'json',
        data: {"bill": eval("(" + JSON.stringify(newBill) + ")")},  // HACK! En Firefox falla si se pasa newBill, tal cual; entonces, garantizamos con esto que el objeto pueda ser un json correctamente formado.
        success: function (data) {
            if (data == 0)
                alert("Ha ocurrido un error guardando los cambios");
            else {
                newBill.id = data;
                $.observable(bills).insert(bills.length, newBill);
                $.observable(orders).refresh([]);
                $(".buttonRemove").button({
                    icons: {primary: 'ui-icon-minus'},
                    text: false
                });
            }
        },
        error: errorRetreavingAjax
    });
}

function pmCachParamsInit() {
    $("#nchNo").click();
    $("#pmCachParams input").prop('disabled', true);
}

$(function () {
    $("#calendar").datepicker({
        onSelect: function(dateText, inst) {
            getMenusAndBillsForDate(dateText);
        }
    });
    $("#dlgOrderDetails").dialog({
        autoOpen: false,
        modal: true
    });
    $("#dlgConfirmOrder").dialog({
        autoOpen: false,
        modal: true,
        width: 800,
        buttons: {
            "Confirmar" : confirmOrder,
            "Cancelar" : function () { $(this).dialog("close"); }
        }
    });
    $("#dlgBillDetails").dialog({
        autoOpen: false,
        modal: true,
        width: 800
    });
    $("#menuContent .products" ).disableSelection();
    $("#btnNew").button({icons: {primary: 'ui-icon-document'}});
    $("#btnSave").button({icons: {primary: 'ui-icon-disk'}});
    $("#btnDelete").button({icons: {primary: 'ui-icon-trash'}});
    $("#btnAddOrder").button({icons: {secondary: 'ui-icon-circle-arrow-e'}});
    $("#btnConfirm").button({icons: {primary: 'ui-icon-circle-check'}});
    getMenusAndBillsForDate(getSelectedDate());
    $.templates({
        menuListTemplate: "#menuListTemplate",
        menuSectionsTemplate: "#menuSectionsTemplate",
        sectionProductsTemplate: "#sectionProductsTemplate",
        previewSectionsTemplate: "#previewSectionsTemplate",
        previewProductsTemplate: "#previewProductsTemplate",
        ordersTemplate: "#ordersTemplate",
        orderContentTemplate: "#orderContentTemplate",
        ordersContentTemplate: "#ordersContentTemplate",
        billsListTemplate: "#billsListTemplate",
        billDetailsOrdersContentTemplate: "#ordersContentTemplate"
    });
    $.link(currentMenu, "#currentMenu");
    $.link(currentMenu, "#hMenuName");
    $.link.ordersTemplate(orders, "#orderList");
    $.link.ordersContentTemplate(orders, "#ordersToConfirmContent");
    $.link.billsListTemplate(bills, "#billList");
    $.link(currentBill, "#billDetailsContent");
    $.link.billDetailsOrdersContentTemplate(currentBill.orders, "#billDetailsOrdersContent");
    $("#menuActions button").button();
    $("#orderList" ).on("click", "tr", function() {
        currentOrder = orders[$.view(this).index];
        $("#orderContent").html($.render.orderContentTemplate(currentOrder));
        $("#dlgOrderDetails").dialog("open");
    }).on("click", ".buttonRemove", function() {
        $.observable(orders).remove($.view(this).index, 1);
        return false;
    });
    $("#billList").on("click", "tr", function() {
        var newCurrentBill = bills[$.view(this).index];
        $.observable(currentBill).setProperty({
            id: newCurrentBill.id,
            comments: newCurrentBill.comments,
            payment: newCurrentBill.payment,
            amount: newCurrentBill.amount
        });
        $.observable(currentBill.orders).refresh(newCurrentBill.orders);
        $("#dlgBillDetails").dialog("open");
    }).on("click", ".buttonRemove", function() {
        var index = $.view(this).index;
        $.ajax({
            url: BASE_URL + "menuofthedaycontroller/removeBill/" + bills[index].id,
            dataType: 'json',
            success: function (successfulyRemoved) {
                if (successfulyRemoved)
                    $.observable(bills).remove(index, 1);
                else {
                    alert("No pudo eliminarse el pedido indicado");
                }
            },
            error: errorRetreavingAjax
        });
        return false;
    });
    $.views.helpers({
        shouldBeHidden: function (price) {
            return eval(price) == 0 ? "hidden" : "show";
        },
        formatCurrency: function (price) {
            return accounting.toFixed(price, 2);
        },
        paymentName: function (payment) {
            return Bill.PAYMENT_NAMES[payment];
        }
    });
    pmCachParamsInit();
});
