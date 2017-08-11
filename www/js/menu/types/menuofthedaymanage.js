var readOnlyMenu = true;
var sectionConfig = {
    1: {inputType: "radio", showPrice: false},
    2: {inputType: "checkbox", showPrice: true},
    3: {inputType: "radio", showPrice: true}
};
var menus = [];
var selectedMenuIndex = 0;
var currentMenu = Menu.EMPTY();

function removeProduct(button, productId) {
    var productIdPrefixLen = "productId".length;
    var sectionIdPrefixLen = "sectionId".length;
    var section = $(button).parent().parent().parent();
    var sectionId = $(section).attr("id").substr(sectionIdPrefixLen);
    for(i=0; i < currentMenu.sections.length && currentMenu.sections[i].id != sectionId; i++);
    var section = currentMenu.sections[i];
    productId = productId.substr(productIdPrefixLen);
    for(j=0; j < section.products.length && section.products[j].id != productId; j++);
    $.observable(section.products).remove(j, 1);
}

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

function changeEditMenuState(readOnly) {
    readOnlyMenu = readOnly;

    $("#options button").attr({disabled: readOnlyMenu});
    if (readOnlyMenu) {
        $(".addZone").children().each(function (index, child) { $(child).attr("disabled", "disabled") });
        $("#currentMenu input, #sMenuType").each(function (index, item) { $(item).attr("disabled", "disabled") });
    } else {
        $(".addZone").children().each(function (index, child) { $(child).removeAttr("disabled") });
        $("#currentMenu input, #sMenuType").each(function (index, item) { $(item).removeAttr("disabled") });
    }
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
        $("#sectionId" + section.id + " button.removeItem").attr({disabled: readOnlyMenu});
        $(".addZone button").attr({disabled: readOnlyMenu});
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
    if (menus.length > 0) {
        $("#lMenus input:first").click();
    } else
        initMenu(Menu.EMPTY());
}

function errorRetreavingAjax(e, xhr, exception) {
    alert("error: " + exception);
}

function getMenusForDate(date) {
    changeEditMenuState(new Date(date) < today());
    $.ajax({
        url: BASE_URL + "menuofthedaycontroller/getMenusForDate/" + date,
        dataType: 'json',
        success: function (data) {
            showMenus(data.menus);
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
    $("#sectionId" + sectionId + " button.removeItem").attr({disabled: readOnlyMenu});
    $(newProductName).focus();
}

function initMenu(menu) {
    $.observable(currentMenu).setProperty({
        "id": menu.id,
        "id_type": menu.id_type,
        "name": menu.name,
        "base_price": menu.base_price,
        "description": menu.description
    });
    $("#sMenuType option[value|=" + currentMenu.id_type + "]").attr("selected", "selected");

    currentMenu.sections = [];
    if (currentMenu.id_type != null)
        $.each(sectionsByMenuType[currentMenu.id_type], function (index, section) {
            currentMenu.sections.push($.extend(true, {}, section));
        });
    $("#menuSections").html($.templates.menuSectionsTemplate.render(currentMenu.sections));
    $("#previewSections").html($.templates.previewSectionsTemplate.render(currentMenu.sections));
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
    changeEditMenuState(false);
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
        error: errorRetreavingAjax
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

$(function () {
    $("#calendar").datepicker({
        onSelect: function(dateText, inst) {
            getMenusForDate(dateText);
        }
    });
    $("#menuContent .products" ).disableSelection();
    getMenusForDate(getSelectedDate());
    $.templates({
        menuListTemplate: "#menuListTemplate",
        menuSectionsTemplate: "#menuSectionsTemplate",
        sectionProductsTemplate: "#sectionProductsTemplate",
        previewSectionsTemplate: "#previewSectionsTemplate",
        previewProductsTemplate: "#previewProductsTemplate"
    });
    $.link(currentMenu, "#currentMenu");
    $.link(currentMenu, "#hMenuName");
    $.views.helpers({
        shouldBeHidden: function (price) {
            return price ? "show" : "hidden";
        }
    });
});
