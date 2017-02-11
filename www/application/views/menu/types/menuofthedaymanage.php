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

        $("#options button").button({disabled: readOnlyMenu});
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
            $("#sectionId" + section.id + " button.removeItem").button({ 
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
        } else
            initMenu(Menu.EMPTY());
    }
    
    function errorRetreavingAjax(e, xhr, exception) {
        alert("error: " + exception);
    }
    
    function getMenusForDate(date) {
        changeEditMenuState(new Date(date) < today());
        $.ajax({
            url: BASE_URL + "MenuOfTheDayController/getMenusForDate/" + date,
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
        $("#sectionId" + sectionId + " button.removeItem").button({ 
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
            error: errorRetreavingAjax
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
        $.views.helpers({
		shouldBeHidden: function (price) {
                    return eval(price) == 0 ? "hidden" : "show";
		}
	});
    });
</script>
<style type="text/css">
    .description { padding: 10pt}
    .products, #lMenus { list-style-type: none; margin: 0; padding: 0;  }
    #menuContent .products li { margin: 0 3px 3px 3px; padding: 0.4em; height: 18px; position: relative; background-color: #edf3f3; cursor: move; }
    #menuContent .products li button { position: absolute; right: 0; font-size: 62.5%}
    #menuPreview .products li, #lMenus li { margin: 0 3px 3px 3px; padding: 0.4em; height: 18px; position: relative; }
    #menuPreview .products li.selected, #lMenus li.selected { background-color: #edf3f3; }
    .newProductName { width: 70%}
    .newProductPrice { width: 10%}
    .buttonAdd { float: right;}
    .section h2 { padding-top: 15px; }
    #options { padding-top: 10px; padding-bottom: 10px}
    #options button { margin-right: 5px; }
    #configPannel > * { display: block; width: 100%; margin-top: 10px }
    #configPannel textarea { min-height: 60px; max-width: 100%; }
    .sectionType1 .addZone .newProductPrice { visibility: hidden }
    .addZone { margin-bottom: 10px }
    #menuListTemplate, #menuListTemplate, #sectionProductsTemplate, #previewSectionsTemplate, #previewProductsTemplate { display: none }
    #menu label { font-weight: normal; }
</style>
<div id="menu" class="prepend-0_1 prepend-top">
    <div id="options" class="append-bottom">
        <button id="btnNew" onclick="btnNew_click()">Nuevo</button>
        <button id="btnSave" onclick="btnSave_click()">Guardar</button>
        <button id="btnDelete" onclick="btnDelete_click()">Eliminar</button>
    </div>
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
            <select id="sMenuType" title="Tipo de menú" onchange="sMenuType_change()">
            <?php foreach ($menuTypes as $menuType): ?>
                <option value="<?php echo $menuType->id ?>"><?php echo $menuType->name ?></option>
            <?php endforeach ?>
            </select>
            <input id="iMenuId" type="hidden" data-link="id"/>
            <input id="iMenuName" title="Nombre del menú" data-link="name"/>
            <input id="iMenuBasePrice" title="Precio base" data-link="base_price" />
            <textarea id="tMenuDescription" title="Descripción del menú" data-link="description" readonly class="span-6"></textarea>
        </div>
    </div>
    <h1 id="hMenuName" class="span-16 last"><span data-link="name"/></h1>
    <div id="menuContent" class="span-8 colborder">
        <h2>Configurar menú</h2>
        <div id="menuSections"></div>
        <script id="menuSectionsTemplate" type="text/x-jsrender">
            <div class="section sectionType{{:id_type}}" id="sectionId{{:id}}" data-section-type="{{:id_type}}">
                <h3 class="sectionName">{{:name}}</h3>
                <ul class="products">
                </ul>
                <div class="addZone">
                    <input class="newProductId" type="hidden" />
                    <input class="newProductName productFilter" />
                    <input class="newProductPrice" />
                    <button class="buttonAdd" onclick="addProduct_click(this)">Adicionar</button>
                </div>
            </div>
        </script>
        <script id="sectionProductsTemplate" type="text/x-jsrender">
            <li id="productId{{:id}}">
                <span class="productName">{{:name}}</span>
                <span class="productPrice" data-link="css-visibility{:~shouldBeHidden(price)}">(+ {{:price}})</span>
                <button class="removeItem" onclick="removeProduct(this, 'productId{{:id}}')">Eliminar</button>
            </li>
        </script>
    </div>
    <div id="menuPreview" class="span-7 last">
        <h2>Vista previa</h2>
        <div id="previewSections"></div>
        <script id="previewSectionsTemplate" type="text/x-jsrender">
            <div class="section sectionType{{:id_type}}" id="preview_sectionId{{:id}}" data-section-type="{{:id_type}}">
                <h3>{{:name}}</h3>
                <ul class="products">
                </ul>
            </div>
        </script>
        <script id="previewProductsTemplate" type="text/x-jsrender">
            <li>
                <input type="{{:input_type}}" name="{{:id_section}}" id="preview_productId{{:id}}" onclick="higlightSelection(this)" />
                <label for="preview_productId{{:id}}">{{:name}}</label>
            </li>
        </script>
    </div>
<div style="clear">
</div>

    