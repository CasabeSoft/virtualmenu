<?php
    /**
     * Vista de construcción de un menú del día, utilizada por los gestores
     * de los proveedores.
     * @author: Carlos Bello
     * @since 2012-04-28 
     */
?>
<script src="<?php echo base_url(); ?>js/jsrender.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery.observable.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery.views.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/virtualmenu.js" type="text/javascript"></script>
<script type="text/javascript">
    var BASE_URL = "<?php echo base_url(); ?>";
    var readOnlyMenu = true;
    var sectionConfig = {
        1: {inputType: "radio", showPrice: false},
        2: {inputType: "checkbox", showPrice: true},
        3: {inputType: "radio", showPrice: true}
    };
    var menuTypes = <?php echo json_encode($menuTypes) ?>;
    var sectionsByMenuType = <?php echo json_encode($sectionsByMenuType) ?>;
    var menus = [];
    var orders = [];
    var selectedMenuIndex = 0;
    var currentMenu = Menu.EMPTY();
    
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

        $("#menuActions button").button({disabled: readOnlyMenu});
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
            url: BASE_URL + "MenuOfTheDayController/getMenuContent/" + id,
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
            $("#sNoMenuMessage").hide();
        } else {
            initMenu(Menu.EMPTY());
            $("#sNoMenuMessage").show();
        }
        /*
        menus = newMenus;
        $("#lMenus").html($("#menuListTemplate" ).render(menus));
        if (menus.length > 0) {
            $("#lMenus input:first").click();
        } else
            initMenu(Menu.EMPTY());
        */
    }
    
    function errorRetreavingAjax(e, xhr, exception) {
        alert("error: " + exception);
    }
    
    function getMenusForDate(date, onGetMenusForDateFinished) {
        changeMenuActionsState(new Date(date) < today());
        $.ajax({
            url: BASE_URL + "MenuOfTheDayController/getMenusForDate/" + date,
            dataType: 'json',
            success: function (data) { 
                showMenus(data.menus);  
                if ($.isFunction(onGetMenusForDateFinished))
                    onGetMenusForDateFinished();
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
        $(".buttonAdd").button({ 
            icons: {primary: 'ui-icon-plus'},
            text: false
        });
        $(".productFilter").autocomplete({
            minLength: 2,
            source: BASE_URL + "MenuOfTheDayController/getProducts",
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
            url: BASE_URL + "MenuOfTheDayController/saveMenuForDate/" + date,
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
            url: BASE_URL + "MenuOfTheDayController/removeMenu/" + currentMenu.id,
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
        $(".buttonRemove").button({ 
            icons: {primary: 'ui-icon-minus'},
            text: false
        });
        $("#menuContent .products" ).disableSelection();
        $("#btnNew").button({icons: {primary: 'ui-icon-document'}});
        $("#btnSave").button({icons: {primary: 'ui-icon-disk'}});
        $("#btnDelete").button({icons: {primary: 'ui-icon-trash'}});
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
        $.link(currentMenu, "#menuActions");
        $("#menuActions button").button();
    });
</script>
<style type="text/css">
    .description { padding: 10pt}
    .products, #lMenus { list-style-type: none; margin: 0; padding: 0;  }
    #menuPreview .products li, #lMenus li { margin: 0 3px 3px 3px; padding: 0.4em; height: 18px; position: relative; }
    #menuPreview .products li.selected, #lMenus li.selected { background-color: #edf3f3; }
    .newProductName { width: 70%}
    .newProductPrice { width: 10%}
    .buttonAdd { float: right;}
    .section h2 { padding-top: 15px; }
    #options { padding-top: 10px; padding-bottom: 10px}
    #options button { margin-right: 5px; }
    #configPannel > * { display: block; width: 100%; margin-top: 10px }
    #menuActions * { display: block; margin-top: 10px }
    #menuActions button { width: 100%;}
    #configPannel textarea { min-height: 60px; max-width: 100%; }
    .sectionType1 .addZone .newProductPrice { visibility: hidden }
    #menuListTemplate, #menuListTemplate, #sectionProductsTemplate, #previewSectionsTemplate, #previewProductsTemplate { display: none }
    #menu label { font-weight: normal; }
</style>
<div id="menu" class="prepend-0_1 prepend-top">
    <div id="configPannel" class="span-6 colborder">
        <div id="calendar"></div>
        <ul id="lMenus">
        </ul>
        <script id="menuListTemplate" type="text/x-jsrender">
            <li>
                <input type="radio" id="menuId{{:id}}" name="menuId" onclick="menuId_click(this)"/>
                <label for="menuId{{:id}}">{{:name}}</label>
            </li>
        </script>
        <div id="currentMenu">
            <select id="sMenuType" title="Tipo de menú" disabled>
            <?php foreach ($menuTypes as $menuType): ?>
                <option value="<?php echo $menuType->id ?>" disabled><?php echo $menuType->name ?></option>
            <?php endforeach ?>
            </select>
            <input id="iMenuId" type="hidden" data-link="id" />
            <input id="iMenuName" title="Nombre del menú" data-link="name" readonly />
            <input id="iMenuBasePrice" title="Precio base" data-link="base_price" readonly />
            <textarea id="tMenuDescription" title="Descripción del menú" data-link="description" readonly ></textarea>
        </div>
    </div>
    <h1 id="hMenuName" class="span-16 last"><span data-link="name"/></h1>
    <div id="menuPreview" class="span-8 colborder">
        <span id="sNoMenuMessage">No hay ningún menú planificado para este día.</span>
        <div id="previewSections"></div>
        <script id="previewSectionsTemplate" type="text/x-jsrender">
            <div class="section sectionType{{:id_type}}" id="preview_sectionId{{:id}}" data-section-type="{{:id_type}}">
                <h2>{{:name}}</h2>
                <ul class="products">
                </ul>
            </div>
        </script>
        <script id="previewProductsTemplate" type="text/x-jsrender">
            <li>
                <input type="{{:input_type}}" name="{{:id_section}}" id="preview_productId{{:id}}" onclick="higlightSelection(this)" />
                <label for="preview_productId{{:id}}">{{:name}}</lable>
            </li>
        </script>
    </div>
    <div id="menuActions" class="ui-widget span-7 last">
        <fieldset>
            <legend>Reserva</legend>
            <label for="finalPrice">Precio</label>
            <span name="finalPrice" data-link="base_price"></span>
            <button>Pedir menú</button>
            <button>Solicitar pedido</button>
            <button>Cambiar pedido</button>
            <button>Solicitar cambios</button>
            <button>Cancelar pedido</button>
        </fieldset>    
    </div>
</div>
<div style="clear: both"></div>
    