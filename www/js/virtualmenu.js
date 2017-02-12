/**
 * @fileOverview Extensiones a jQuery y funciones de uso general en la aplicación
 */

/**
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

$(function(){
    $("ul.dropdown li").hover(function(){
        $(this).addClass("hover");
        $('ul:first',this).css('visibility', 'visible');

    }, function(){
        $(this).removeClass("hover");
        $('ul:first',this).css('visibility', 'hidden');
    });
    $("ul.dropdown li ul li:has(ul)").find("a:first").append(" &raquo; ");
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

Bill.cloneOrders = function (orders) {
    var newOrders = [];
    $.each(orders, function (index, order) {
        newOrders.push(order.clone(true));
    });
    return newOrders;
}

Bill.calcAmount = function (orders) {
    var amount = 0;
    $.each(orders, function (index, order) {
        amount += order.getFinalPrice();
    });
    return amount;
}

Bill.EMPTY = function () {
    return new Bill(0, [], "");
}

Bill.PAYMENT_NAMES = {
    "1": "Efectivo",
    "2": "Tarjeta",
    "3": "PayPal",
    "4": "Google Walet"
}

function Bill(id, orders, comments, payment, amount, generated, paid) {
    this.updateAmount = function () {
        this.amount = Bill.calcAmount(orders);
        return this.amount;
    }

    this.id = id;
    this.comments = comments;
    this.orders = Bill.cloneOrders(orders);
    this.payment = payment;
    this.amount = amount ? amount : this.updateAmount();
    this.generated = generated;
    this.paid = paid;
}

Bill.buildFrom = function (data) {
    var newOrders = [];
    $.each(data.orders, function (index, order) {
       newOrders.push(Order.buildFrom(order));
    });
    return new Bill(
        data.id,
        newOrders,
        data.comments,
        data.payment,
        data.amount,
        data.generated,
        data.paid
    );
}

function Order(id, menu, comments, products, bill) {
    this.id = id;
    this.menu = menu;
    this.comments = comments;
    this.products = products;
    this.bill = bill;

    this.getFinalPrice = function () {
        var extras = 0;
        $.each(products, function (index, item) {
            extras += item.price;
        });
        return menu.base_price + extras;
    };

    this.clone = function (deep) {
        deep = deep || false;
        return $.extend(deep, {}, this)
    }
}

Order.EMPTY = function () {
    return new Order(0, Menu.EMPTY(), "", []);
}

Order.buildFrom = function (data) {
    return new Order(
        data.id,
        data.menu,
        data.comments,
        data.products,
        data.bill
    );
}
