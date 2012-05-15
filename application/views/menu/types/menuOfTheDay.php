<?php
    /**
     * Vista de construcción de un menú del día, utilizada por los gestores
     * de los proveedores.
     * @author: Carlos Bello
     * @since 2012-04-28 
     */
?>
<script src="<?php echo base_url(); ?>js/jquery.qtip-1.0.0-rc3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/virtualmenu.js" type="text/javascript"></script>
<script>
    var BASE_URL = "<?php echo base_url(); ?>";
    var readOnlyMenu = true;
    var sectionConfig = {
        1: {inputType: "radio", showPrice: false},
        2: {inputType: "checkbox", showPrice: true},
        3: {inputType: "radio", showPrice: true}
    };
    
    function removeProduct(button, productId) {
        var li = $(button).parent();
        if ($(li).hasClass("qtipAdded"))
            $(li).qtip("destroy");
        $(li).remove();
        $("#preview_" + productId).remove();
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
    
    function updatePreview(event, ui) {
        var menuPreview = $("#preview_" + $(event.target).parent().attr("id"));
        var productsConfig = $(event.target);
        var productsPreview = $(menuPreview).children("ul");
        $(productsPreview).children("li").remove();
        $(productsConfig).children("li").each(
        function (index) {
            var productName = $($(this).children("span")[0]).text();
            var productPriceText = $($(this).children("span")[1]).text();
            var productPriceVal = eval(productPriceText);
            addProductToPreview($(event.target).parent().attr("id"),
            $(this).attr("id"), $(productsConfig).parent().attr("data-section-type"),
            productName + (productPriceVal <= 0 ? "" : productPriceText));
        }
    );
    }
    
    function addProductToPreview(sectionId, productId, sectionType, productName) {
        var previewProducts = $("#preview_" + sectionId).children(".products");
        $(previewProducts).append("<li id='preview_productId" + productId+ "'><input type='" 
            + sectionConfig[sectionType].inputType 
            + "' name='"
            + sectionId +"' onclick='higlightSelection(this)' /><label for='preview_productId" 
            + productId + "' onclick=\"$('#preview_productId" + productId+ " input').click()\">" + productName + "</lable></li>");
    }
    
    function addProduct(section, products, productId, productName, productPrice) {
        $(products).append("<li id='productId" + productId + "'><span class='productName'>" + productName 
            + "</span><span class='productPrice'" + (productPrice <= 0 ? " style='visibility:hidden'" : "") + "> (+" + productPrice
            + ")</span><button class='btnRemoveProduct' onclick=\"removeProduct(this, 'productId" + productId 
            + "')\">Eliminar</button></li>");
        $(products).find("button").button({ 
            icons: {primary: 'ui-icon-minus'},
            text: false,
            disabled: readOnlyMenu
        });
        addProductToPreview($(section).attr("id"), productId, $(section).attr("data-section-type"), productName + (productPrice <= 0 ? "" : " (+" + productPrice + ")"));
        if (!readOnlyMenu && $(products).children().length == 2)
            $("#productId" + productId).showTooltip("Arrastra el producto para colocarlo en la posición que desees.", true, 5000);
    }
    
    function addProduct_click(button) {
        var section = $(button).parent().parent();
        var products = $(section).children(".products");
        var productId = $(section).find('.newProductId').val();
        var newProductName = $(section).find('.newProductName');
        var price = $(section).find('.newProductPrice');
        var productName = $(newProductName).val();
        var productPrice = $(price).css("visibility") == "hidden" ? 0
            : isFinite(parseFloat($(price).val())) ? parseFloat($(price).val()) : 0;
        $(productId).val("");
        $(newProductName).val("");
        $(price).val("");
        addProduct(section, products, productId, productName, productPrice);
        $(newProductName).focus();
    }
    
    function today() {
        var today = new Date();
        return new Date(today.getFullYear(), today.getMonth(), today.getDate());
    }
    
    function changeEditMenuState(readOnlyMenu) {
        if (readOnlyMenu) {
            $("#btnSave").button({disabled: true});
            $("#btnReuse").button({disabled: false});
            $(".addZone").children().each(function (index, child) { $(child).attr("disabled", "disabled") });
            $(".btnRemoveProduct").button({disabled: true});
            $("#iMenuName, #iMenuBasePrice, #tMenuDescription, #sMenuType").each(function (index, item) { $(item).attr("disabled", "disabled") });
        } else {
            $("#btnSave").button({disabled: false});
            $("#btnReuse").button({disabled: true});
            $(".btnRemoveProduct").button({disabled: false});
            $(".addZone").children().each(function (index, child) { $(child).removeAttr("disabled") });
            $("#iMenuName, #iMenuBasePrice, #tMenuDescription, #sMenuType").each(function (index, item) { $(item).removeAttr("disabled") });
        }
    }
    
    function showMenuContent(data) {
        $("ul.products").html("");
        $.each(data, function (index, product) {
            addProduct(
                $("#sectionId" + product.id_section),
                $("#sectionId" + product.id_section + " ul"),
                product.id_product,
                product.name,
                product.price
            );
        });
    }
    
    function menuId_click(input) {
        const menuIdPrefixLen = "menuId".length;
        higlightSelection(input);
        $.ajax({
            url: BASE_URL + "MenuOfTheDayController/getMenuContent/" + $(input).attr("id").substr(menuIdPrefixLen),
            dataType: 'json',
            success: showMenuContent,
            error: errorRetreavingAjax
        });
    }
    
    function addMenu(id, idType, name, basePrice, description) {
        $("#lMenus").append(
            '<li><input type="radio" id="menuId' + id + '" name="menuId" onclick="menuId_click(this)"/><label for="menuId' + id + '" onclick="$(this).parent().children(\'input\').click()">' + name + '</label></li>'
        );
    }
    
    function showMenus(data) { 
        readOnlyMenu = new Date(data.date) < today();
        $("#menuContent ul.products li").each(function (index, item) {
            if ($(item).hasClass("qtipAdded"))
                $(item).qtip("destroy");
        });
        $("ul.products, #lMenus").html("");
        changeEditMenuState(readOnlyMenu);
        if (data.menus.length > 0) {
            var firstMenu = data.menus[0];
            $("#iMenuId").val(firstMenu.id);
            $("#sMenuType").val(firstMenu.id_type);
            $("#hMenuName").text(firstMenu.name);
            $("#iMenuName").val(firstMenu.name);
            $("#iMenuBasePrice").val(firstMenu.base_price);
            $("#tMenuDescription").val(firstMenu.description);
            $.each(data.menus, function (index, menu) {
                addMenu(menu.id, menu.id_type, menu.name, menu.base_price, menu.description);                
            });
            $("#menuId" + firstMenu.id).attr("checked", "checked");
            showMenuContent(data.firstMenuContent);
        } else {
            $("#btnReuse").button({disabled: true});
            $("#iMenuId, #iMenuName, #iMenuBasePrice, #tMenuDescription").val("");
            $("#sMenuType option").removeAttr("checked");
            $("#hMenuName").text("");
        }
    }
    
    function errorRetreavingAjax(e, xhr, exception) {
        alert("error: " + exception);
    }
    
    function getMenusForDate(date) {
        $.ajax({
            url: BASE_URL + "MenuOfTheDayController/getMenusForDate/" + date,
            dataType: 'json',
            success: showMenus,
            error: errorRetreavingAjax   // TODO: Procesar errores
        });
    }
    
    function btnSave_click() {
        var date = $.datepicker.formatDate($.datepicker.ATOM, $("#calendar").datepicker("getDate"));
        $.ajax({
            type: 'POST',
            url: BASE_URL + "MenuOfTheDayController/saveMenuForDate/" + date,
            dataType: 'json',
            data: {"menu": buildMenuFromUI()},
            success: function (data) { alert("Los cambios han sido guardados.");  $("#tMenuDescription").val(JSON.stringify(data)); },
            error: errorRetreavingAjax   // TODO: Procesar errores
        });
    }
    
    function btnReuse_click() {
        $("#calendar").datepicker("setDate", today());
        changeEditMenuState(false);
    }
    
    function buildMenuFromUI() {
        const sectionIdPrefixLen = "sectionId".length;
        const productIdPrefixLen = "productId".length;
        var newMenu = new Menu(
            $("#iMenuId").val(),
            $("#sMenuType").val(),
            $("#iMenuName").val(),
            $("#iMenuBasePrice").val(),
            $("#tMenuDescription").text(),
            []
        );
        $("#menuContent div.section").each(function (sectionIndex, section) {
            var newSection = new Section(
                $(section).attr("id").substr(sectionIdPrefixLen),
                $(section).children(".sectionName").text(),
                $(section).attr("data-section-type"),
                sectionIndex,
                [],
                newMenu.id
            );
            $("#" + $(section).attr("id") + " li").each(function (productIndex, product) {
                var newProduct = new Product(
                    $(product).attr("id").substr(productIdPrefixLen),
                    $(product).children("span.productName").text(),
                    productIndex,
                    $(product).children("span.productPrice").text(),
                    newSection.id
                );
                newSection.products.push(newProduct);
            });
            newMenu.sections.push(newSection);
        });
        return newMenu;
    }
    
    $(function () {
        $("#calendar").datepicker({ 
            onSelect: function(dateText, inst) { getMenusForDate(dateText); }        
        });
        $(".buttonAdd").button({ 
            icons: {primary: 'ui-icon-plus'},
            text: false
        });
        $(".buttonRemove").button({ 
            icons: {primary: 'ui-icon-minus'},
            text: false
        });
        $("#menuContent .products").sortable({ 
            placeholder: "ui-state-highlight", 
            forcePlaceholderSize: true, 
            update: updatePreview
        });
        $("#menuContent .products" ).disableSelection();
        $(".newProductName, .newProductPrice").keypress(function(e) {
            if (e.which == 13) {
                $(this).parent().children(".buttonAdd").click();
                $(this).parent().children(".newProductName").focus();
            }
        });
        $()
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
        $("#btnSave").button({disabled: true, icons: {primary: 'ui-icon-disk'}});
        $("#btnCancel").button({disabled: true, icons: {primary: 'ui-icon-cancel'}});
        $("#btnReuse").button({disabled: true, icons: {primary: 'ui-icon-refresh'}});
        $("#iMenuName").change(function ()  { $("#hMenuName").text($(this).val()); });
    });
</script>
<style type="text/css">
    .description { font-size: 1.2em; padding: 10pt}
    #menu { position: relative; }
    #configPannel { float: left; width: 20%}
    #menuContent, #menuPreview { float: left; margin-left: 50px; width: 35%; }
    .products, #lMenus { list-style-type: none; margin: 0; padding: 0;  }
    #menuContent .products li { margin: 0 3px 3px 3px; padding: 0.4em; font-size: 1.4em; height: 18px; position: relative; background-color: #edf3f3; cursor: move; }
    #menuContent .products li button { position: absolute; right: 0; font-size: 62.5%}
    #menuPreview .products li, #lMenus li { margin: 0 3px 3px 3px; padding: 0.4em; font-size: 1.4em; height: 18px; position: relative; }
    #menuPreview .products li.selected, #lMenus li.selected { background-color: #edf3f3; }
    .newProductName { width: 70%}
    .newProductPrice { width: 10%}
    .buttonAdd { float: right;}
    .section h2 { padding-top: 15px; }
    #options { padding-top: 10px; padding-bottom: 10px}
    #options button { margin-right: 5px; }
    #configPannel > * { display: block; width: 100%; margin-top: 10px }
    #configPannel textarea { min-height: 60px; max-width: 100% }
    #lMenus li { }
    .sectionType1 .addZone .newProductPrice { visibility: hidden }
</style>
<div id="menu">
    <h1 id="hMenuName"></h1>
    <div id="options">
        <button id="btnSave" onclick="btnSave_click()">Guardar</button><button id="btnCancel">Cancelar</button><button id="btnReuse" onclick="btnReuse_click()">Reutilizar</button>
    </div>
    <div id="configPannel">
        <input id="iMenuId" type="hidden" />
        <div id="calendar"></div>
        <ul id="lMenus">
            <?php foreach ($menuTypes as $menuType): ?>
            <li><input type="radio" id="menuId<?php echo $menuType->id ?>" name="menuId" onclick="higlightSelection(this)"/><label for="menuId<?php echo $menuType->id ?>" onclick="$(this).parent().children('input').click()"><?php echo $menuType->name ?></label></li>
            <?php endforeach ?>
        </ul>
        <select id="sMenuType" title="Tipo de menú">
            <?php foreach ($menuTypes as $menuType): ?>
                <option value="<?php echo $menuType->id ?>"><?php echo $menuType->name ?></option>
            <?php endforeach ?>
        </select>
        <input id="iMenuName" title="Nombre del menú"/>
        <input id="iMenuBasePrice" title="Precio base"/>
        <textarea id="tMenuDescription" style="width: 100%" title="Descripción del menú"></textarea>
    </div>
    <div id="menuContent">
        <h2>Configurar menú</h2>
    <?php foreach ($sections as $section): ?>
        <div class="section sectionType<?php echo $section['id_section_type']?>" id="sectionId<?php echo $section['id']?>" data-section-type="<?php echo $section['id_section_type']?>">
            <h2 class="sectionName"><?php echo $section['name'] ?></h2>
            <ul class="products">
            </ul>
            <div class="addZone">
                <input class="newProductId" type="hidden" />
                <input class="newProductName productFilter" /><input class="newProductPrice" /><button class="buttonAdd" onclick="addProduct_click(this)">Adicionar</button>
            </div>
        </div>
    <?php endforeach ?>
    </div>
    <div id="menuPreview">
        <h2>Vista previa</h2>
        <?php foreach ($sections as $section): ?>
        <div class="section sectionType<?php echo $section['id_section_type']?>" id="preview_sectionId<?php echo $section['id']?>" data-section-type="<?php echo $section['id_section_type']?>">
            <h2><?php echo $section['name'] ?></h2>
            <ul class="products">
            </ul>
        </div>
    <?php endforeach ?>
    </div>
</div>
<div style="clear: both"></div>
