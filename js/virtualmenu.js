/**
 * @fileOverview Extensiones a jQuery y funciones de uso general en la aplicación 
 */

/**
 * @description Extensión a jQuery que asocia a la derecha de un elemento un  
 * tooltip que podría autoocultarse y autodestrirse
 * @param text Texto a mostrar en el tooltip
 * @param autoDestroy Booleano (opcional) que inidca si el tooltipo se 
 *        autodestruirá, una vez se haya ocultado.
 * @param showTime Tiempo (opcional) que deberá mostrarse el tooltip antes de 
 *        ocultarse automáticamente. Si este parámetro no se especifica el 
 *        tooltip no se ocultará automáticamente.
 */
$.fn.showTooltip = function(text, /*opt*/ autoDestroy, /*opt*/ showTime) {
    var element = this[0];
    $(element).addClass("qtipAdded");
    $(element).qtip({
            content: text,
            style: { 
                tip: 'leftMiddle',
                name: 'cream',
                border: {radius: 5}
            },
            position: {
                corner: {
                    target: 'rightMiggle',
                    tooltip: 'leftMiggle'
                }
            },
            show: {ready: true},
            hide: {
                event: false,
                effect: function(api) {
                    $(this).stop(0, 1).fadeOut(400).queue(function() {
                        if (autoDestroy)
                            $(this).qtip("destroy");
                    })
                }
            }
    });
    if (showTime)
        setTimeout(function () {$(element).qtip("hide")}, showTime);
}

/**
 *
 * @description  Inicializa todos los datepicker con los textos en español.
 */ 
$.datepicker.setDefaults({
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        dayNamesShort: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        monthNamesShort: ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],
        monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
        nextText: "Mes siguiente",
        prevText: "Mes anterior"
});

function Section(id, name, idType, order, products, idMenu) {
    this.id = id;
    this.name = name;
    this.id_type = idType;
    this.order = order;
    this.products = products;
    this.id_menu = idMenu;
}
function Product(id, name, order, price, idSection) {
    this.id = id;
    this.name = name;
    this.order = order;
    this.price = price;
    this.id_section = idSection;
}
function Menu(id, idType, name, basePrice, description, sections) {
    this.id = id;
    this.id_type = idType;
    this.name = name;
    this.base_price = basePrice;
    this.description = description;
    this.sections = sections;
    
    this.clone = function (deep) {
        deep = deep || false;
        return $.extend(deep, {}, this)
    }
}

Menu.EMPTY = function () {
    return new Menu(0, null, "", "", "", []);    
}
