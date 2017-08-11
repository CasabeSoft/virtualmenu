<?php
/**
 * Vista de construcción de un menú del día, utilizada por los gestores
 * de los proveedores.
 */
?>
<style type="text/css">
    .description { padding: 10pt}
    .products, #lMenus { list-style-type: none; margin: 0; padding: 0; }
    #currentMenu .form-control { margin-bottom: 10px; }
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
<div id="menu">
    <div id="options" class="row append-bottom">
        <div class="col-sm-12">
            <button id="btnNew" onclick="btnNew_click()" class="btn btn-default">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo
            </button>
            <button id="btnSave" onclick="btnSave_click()" class="btn btn-default">
                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar
            </button>
            <button id="btnDelete" onclick="btnDelete_click()" class="btn btn-default">
                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Eliminar
            </button>
        </div>
    </div>
    <div class="row">
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
                <select id="sMenuType" title="Tipo de menú" onchange="sMenuType_change()" class="form-control">
                <?php foreach ($menuTypes as $menuType) { ?>
                    <option value="<?php echo $menuType->id ?>"><?php echo $menuType->name ?></option>
                <?php } ?>
                </select>
                <input id="iMenuId" type="hidden" data-link="id" class="form-control" />
                <input id="iMenuName" title="Nombre del menú" data-link="name" class="form-control" />
                <input id="iMenuBasePrice" title="Precio base" data-link="base_price" class="form-control" />
                <textarea id="tMenuDescription" title="Descripción del menú" data-link="description" readonly class="form-control"></textarea>
            </div>
        </div>
        <div class="col-md-8">
            <h1 id="hMenuName"><span data-link="name"/></h1>
            <div id="menuContent">
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
            <div id="menuPreview">
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
        </div>
    </div>
</div>
<script type="text/javascript">
    var BASE_URL = "<?php echo base_url(); ?>";
    var menuTypes = <?php echo json_encode($menuTypes) ?>;
    var sectionsByMenuType = <?php echo json_encode($sectionsByMenuType) ?>;
</script>
