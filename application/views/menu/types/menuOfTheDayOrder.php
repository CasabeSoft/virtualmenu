<?php
    /**
     * Vista de construcción de un menú del día, utilizada por los gestores
     * de los proveedores.
     * @author: Carlos Bello
     * @since 2012-06-10 
     */
?>
<script src="<?php echo base_url(); ?>js/jsrender.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery.observable.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery.views.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/virtualmenu.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/accounting.min.js" type="text/javascript"></script>
<style type="text/css">
    .description { padding: 10pt}
    ul { list-style-type: none; margin: 0; padding: 0;  }
    #menuPreview .products li, #lMenus li { margin: 0 3px 3px 3px; padding: 0.4em; height: 18px; position: relative; }
    #menuPreview .products li.selected, #lMenus li.selected { background-color: #edf3f3; }
    .newProductName { width: 70%}
    .newProductPrice { width: 10%}
    .buttonAdd { float: right;}
    .section h2 { padding-top: 15px; }
    #options { padding-top: 10px; padding-bottom: 10px}
    #options button { margin-right: 5px; }
    #configPannel > * { display: block; width: 100%; margin-top: 10px }
    #menuActions button { display: block; margin-top: 10px }
    #menuActions button { width: 100%;}
    .buttonRemove { font-size: 62.5% !important; float: right; }
    #configPannel textarea, #menuPreview textarea { height: 60px; }
    .sectionType1 .addZone .newProductPrice { visibility: hidden }
    #menuListTemplate, #menuListTemplate, #sectionProductsTemplate, #previewSectionsTemplate, #previewProductsTemplate { display: none }
    #menu label { font-weight: normal; }
    #orders tr { cursor: pointer; }
    .text-right { text-align: right; }
    #payMethods div { height: 35px; }
    #cachAmount { visibility: hidden; }
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
            <textarea id="tMenuDescription" title="Descripción del menú" data-link="description" readonly class="span-6"></textarea>
        </div>
    </div>
    <h1 id="hMenuName" class="span-16 last"><span data-link="name"/></h1>
    <div id="menuPreview" class="span-8 colborder">
        <div><button id="btnAddOrder" class="right" onclick="orderMenu()">Añadir a mi pedido</button></div>
        <div class="clearfix"></div>
        <span id="sNoMenuMessage">No hay ningún menú planificado para este día.</span>
        <div id="previewSections"></div>
        <hr class="space" >
        <hr />
        <h2>Comentarios</h2>
        <textarea id="tComments" class="span-8"></textarea>
        <script id="previewSectionsTemplate" type="text/x-jsrender">
            <div class="section sectionType{{:id_type}}" id="preview_sectionId{{:id}}" data-section-type="{{:id_type}}">
                <h2>{{:name}}</h2>
                <ul class="products">
                </ul>
            </div>
        </script>
        <script id="previewProductsTemplate" type="text/x-jsrender">
            <li data-id="{{:id}}" data-price="{{:price}}" data-name="{{:name}}">
                <input type="{{:input_type}}" name="{{:id_section}}" id="preview_productId{{:id}}" onclick="higlightSelection(this)" />
                <label for="preview_productId{{:id}}">{{:name}}</label>
                <span class="productPrice" data-link="css-visibility{:~shouldBeHidden(price)}">(+ {{:price}})</span>
            </li>
        </script>
    </div>
    <div id="orders" class="ui-widget span-7 last">
        <fieldset>
            <legend>Nuevo pedido</legend>
            <table class="highlight-content-rows">
                <thead>
                    <tr>
                        <th>Menú</th><th class="text-right">Precio</th><th></th>
                    </tr>
                </thead>
                <tbody id="orderList">
                </tbody>
            </table>
            <script id="ordersTemplate" type="text/x-jsrender">
                <tr>
                    <td>{{:menu.name}}</td>
                    <td class="text-right"><span data-link="{:~formatCurrency(getFinalPrice())}"></span></td>
                    <td><button class="buttonRemove">Eliminar</button></td>
                </tr>
            </script>
            <div id="menuActions">
            <button id="btnConfirm" onclick="confirmOrderRequest()">Confirmar pedido</button>
            </div>
        </fieldset>
        <fieldset>
            <legend>Tus pedidos</legend>
            <table class="highlight-content-rows">
                <thead>
                    <tr>
                        <th>Pedido</th><th class="text-right">Valor</th><th></th>
                    </tr>
                </thead>
                <tbody id="billList">
                </tbody>
            </table>
            <script id="billsListTemplate" type="text/x-jsrender">
                <tr>
                    <td>{{:id}}</td>
                    <td class="text-right"><span data-link="{:~formatCurrency(amount)}"></span></td>
                    <td><button class="buttonRemove">Eliminar</button></td>
                </tr>
            </script>
        </fieldset>
    </div>
</div>
<div style="clear: both"></div>
<div id="dlgOrderDetails" title="Detalles del pedido">    
    <div id="orderContent">
    </div>
</div>
<script id="orderContentTemplate" type="text/x-jsrender">
       <h2>{{:menu.name}}</h2>
       <h3>Precio: {{:getFinalPrice()}}</h3>
       <h3>Contenido</h3>
       <p>
       {{for products ~count=products.length}}
            {{:name}}{{if #index === ~count-2 || #index < ~count-2}}, {{/if}}
       {{/for}}
       </p>
       {{if comments.length > 0}}
       <blockquote><strong>Comentarios:</strong> {{:comments}}</blockquote>
       {{/if}}       
</script>

<div id="dlgConfirmOrder" title="Confirmación de pedido">
    <h2>Confirmar pedido</h2>
    <h3>Tu pedido</h3>
    <table>
        <thead>
            <tr><th>Menú</th><th class="text-right">Precio</th></tr>
        </thead>
        <tbody id="ordersToConfirmContent"></tbody>
        <tfoot>
            <tr><th>Total</th><th class="text-right"><span id="totalPrice"></span></th></tr>
        </tfoot>
    </table>
    <hr />
    <h3>Método de pago</h3>
    <div id="payMethods">
        <div class="span-3">
                    <input type="radio" name="payMode" id="pmCach" onclick="payMode_click(this)" value="1" />
                    <label for="pmCach">Efectivo</label>
        </div>
        <div id="pmCachParams" class="span-10">
            ¿Necesitas cambio?
            <input type="radio" name="needChange" id="nchNo" value="0" checked onclick="needChange_click(this)" /><label for="nchNo">No</label>
            <input type="radio" name="needChange" id="nchYes" value="1" onclick="needChange_click(this)"/><label for="nchYes">Si</label>
            <span id="cachAmount">de <input id="cach" type="number" min="5" max="100"></span>
        </div>
        <div class="clearfix"></div>
        <div class="span-3">
                    <input type="radio" name="payMode" id="pmCard" onclick="payMode_click(this)" value="2" />
                    <label for="pmCard">Targeta</label></li> 
        </div>
        <div class="span-10">
            <img src="<?php echo base_url(); ?>img/cards.gif" alt="Tarjetas: Visa, MasterCard, Visa Electron" />
        </div>
        <div class="clearfix"></div>
        <div class="span-3">
                    <input type="radio" name="payMode" id="pmPayPal" onclick="payMode_click(this)" value="3" />
                    <label for="pmPayPal">PayPal</label>
        </div>
        <div class="span-10">
            <!-- PayPal Logo --><a href="<?php echo current_url(); ?>#" onclick="javascript:window.open('https://www.paypal.com/es/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=350');"><img  src="<?php echo base_url(); ?>img/PayPal_mark_37x23.gif" border="0" alt="Marca de aceptación de PayPal"></a><!-- PayPal Logo -->
        </div>
    </div>
    <hr class="space" />
    <hr />
    <h3>Dirección de entrega</h3>
    <address><?php echo $address ?></address>
</div>
<script id="ordersContentTemplate" type="text/x-jsrender">
    <tr>
        <td>
            <strong>{{:menu.name}}</strong><br>
            {{for products ~count=products.length}}
                    {{:name}}{{if #index === ~count-2 || #index < ~count-2}}, {{/if}}
            {{/for}}<br>
            {{if comments.length > 0}}
            <em>{{:comments}}</em>
            {{/if}}       
        </td>
        <td class="text-right"><span data-link="{:~formatCurrency(getFinalPrice())}"></span></td>
    </tr>
</script>
<div id="dlgBillDetails" title="Información del pedido">
    <div id="billDetailsContent">
        <h2>Información del pedido</h2>
        <h3>Tu pedido <span data-link="id"></span></h3>
        <table>
            <thead>
                <tr><th>Menú</th><th class="text-right">Precio</th></tr>
            </thead>
            <tbody id="billDetailsOrdersContent">
            </tbody>
            <tfoot>
                <tr><th>Total</th><th class="text-right"><span data-link="amount"></span></th></tr>
            </tfoot>
        </table>
        <hr />
        <h3>Método de pago</h3>
        <span data-link="{:~paymentName(payment)}"></span>
        <hr class="space" />
        <hr />
        <h3>Dirección de entrega</h3>
        <address><?php echo $address ?></address>
    </div>
</div>
<form id="frmOrder" method="post" action="<?php echo base_url(); ?>menu/order/confirm" >
    <input type="hidden" name="bill" id="bill" />
</form>
   
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
            url: BASE_URL + "MenuOfTheDayController/getMenusAndBillsForDate/" + date,
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
            url: BASE_URL + "MenuOfTheDayController/confirmOrder",
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
                url: BASE_URL + "MenuOfTheDayController/removeBill/" + bills[index].id,
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
</script>
    