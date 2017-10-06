<?php
/**
 * Vista de construcción de un menú del día, utilizada por los gestores
 * de los proveedores.
 */
?>
<style type="text/css">
    .description { padding: 10pt}
    ul { list-style-type: none; margin: 0; padding: 0; }
    #currentMenu .form-control { margin-bottom: 10px; }
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
<div id="menu" class="row">
    <div id="configPannel" class="col-md-4">
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
            <select id="sMenuType" title="Tipo de menú" disabled class="form-control">
            <?php foreach ($menuTypes as $menuType) { ?>
                <option value="<?php echo $menuType->id ?>" disabled><?php echo $menuType->name ?></option>
            <?php } ?>
            </select>
            <input id="iMenuId" type="hidden" data-link="id" />
            <input id="iMenuName" title="Nombre del menú" data-link="name" readonly class="form-control" />
            <input id="iMenuBasePrice" title="Precio base" data-link="base_price" readonly class="form-control" />
            <textarea id="tMenuDescription" title="Descripción del menú" data-link="description" readonly class="form-control"></textarea>
        </div>
    </div>
    <div class="col-md-8">
        <h1 id="hMenuName"><span data-link="name"/></h1>
        <div id="menuPreview">
            <div class="row">
                <div class="col-sm-12">
                    <button id="btnAddOrder" class="right" onclick="orderMenu()">Añadir a mi pedido</button>
                </div>
            </div>
            <span id="sNoMenuMessage">No hay ningún menú planificado para este día.</span>
            <div id="previewSections"></div>
            <h2>Comentarios</h2>
            <textarea id="tComments" class="form-control"></textarea>
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
        <div id="orders" class="ui-widget">
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
</div>
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
        <div class="row">
            <div class="col-md-4">
                <input type="radio" name="payMode" id="pmCach" onclick="payMode_click(this)" value="1" />
                <label for="pmCach">Efectivo</label>
            </div>
            <div id="pmCachParams" class="col-md-8">
                ¿Necesitas cambio?
                <input type="radio" name="needChange" id="nchNo" value="0" checked onclick="needChange_click(this)" /><label for="nchNo">No</label>
                <input type="radio" name="needChange" id="nchYes" value="1" onclick="needChange_click(this)"/><label for="nchYes">Si</label>
                <span id="cachAmount">de <input id="cach" type="number" min="5" max="100"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <input type="radio" name="payMode" id="pmCard" onclick="payMode_click(this)" value="2" />
                <label for="pmCard">Targeta</label></li>
            </div>
            <div class="col-md-8">
                <img src="<?php echo base_url(); ?>img/cards.gif" alt="Tarjetas: Visa, MasterCard, Visa Electron" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <input type="radio" name="payMode" id="pmPayPal" onclick="payMode_click(this)" value="3" />
                <label for="pmPayPal">PayPal</label>
            </div>
            <div class="col-md-8">
                <!-- PayPal Logo --><a href="<?php echo current_url(); ?>#" onclick="javascript:window.open('https://www.paypal.com/es/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=350');"><img  src="<?php echo base_url(); ?>img/PayPal_mark_37x23.gif" border="0" alt="Marca de aceptación de PayPal"></a><!-- PayPal Logo -->
            </div>
        </div>
    </div>
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
        <h3>Dirección de entrega</h3>
        <address><?php echo $address ?></address>
    </div>
</div>
<form id="frmOrder" method="post" action="<?php echo base_url(); ?>menu/order/confirm" >
    <input type="hidden" name="bill" id="bill" />
</form>

<script type="text/javascript">
    var BASE_URL = "<?php echo base_url(); ?>";
    var menuTypes = <?php echo json_encode($menuTypes) ?>;
    var sectionsByMenuType = <?php echo json_encode($sectionsByMenuType) ?>;
</script>
