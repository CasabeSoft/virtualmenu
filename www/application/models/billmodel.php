<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BillModel
 *
 * @author Carlos Bello
 */
class BillModel extends CI_Model {

    public $id = 0;
    public $generated = NULL;
    public $paid = NULL;
    public $amount = 0;
    public $comments = NULL;
    public $payment = NULL;

    public function __construct() {
        parent::__construct();
    }

    public function setConfirmedOrder($bill) {
        $this->db->trans_start();
        try {
            $billData = array(
                "amount" => $bill["amount"],
                "id_user" => $bill["id_user"],
                "id_provider" => $bill["id_provider"],
                "payment" => $bill["payment"],
                "comments" => $bill["comments"],
            );
            $this->db->insert("bills", $billData);
            $bill["id"] = $this->db->query("SELECT LAST_INSERT_ID() AS id;")->row()->id;

            $productsByOrder = array();
            foreach ($bill["orders"] as $order) {
                $orderContent = array(
                    "id_bill" => $bill["id"],
                    "id_menu" => $order["menu"]["id"],
                    "comments" => $order["comments"]
                );
                $this->db->insert("orders", $orderContent);
                $orderContent["id"] = $this->db->query("SELECT LAST_INSERT_ID() AS id;")->row()->id;

                foreach ($order["products"] as $product) {
                    // TODO: Tener en cuenta órdenes donde el producto esté repetido
                    $productsByOrder[] = array(
                        "id_order" => $orderContent["id"],
                        "id_product" => $product["id"],
                    );
                }
            }
            $this->db->insert_batch("products_by_order", $productsByOrder);
        } catch (Exception $ex) {
            // TODO: tratar el error
        }
        $this->db->trans_complete();
        return $this->db->trans_status() ? $bill["id"] : 0;
    }

    public function remove($id) {
        $this->db->from("bills")
                ->where("id", $id)
                ->where("paid is null")
                ->delete();
        return 0 == $this->db->from("bills")->where("id", $id)->count_all_results();
    }

    public function getOrdersForBill($idBill) {
        $qOrders = <<<EOD
SELECT o.id, o.comments, o.ordered, m.`name`, m.base_price
FROM orders o INNER JOIN menus m on o.id_menu = m.id
WHERE id_bill = $idBill;
EOD;
        $orders = $this->db->query($qOrders)
                ->result_array();
        for ($i = 0; $i < count($orders); $i++) {
            $orders[$i]["menu"] = array(
                "name" => $orders[$i]["name"],
                "base_price" => $orders[$i]["base_price"]
            );

            $qProducts = <<<EOD
SELECT po.id_product id, p.`name`, pm.price
FROM products_by_order po INNER JOIN products p on po.id_product = p.id
    INNER JOIN orders o on po.id_order = o.id
    INNER JOIN menus m on o.id_menu = m.id
    INNER JOIN products_by_menu pm on o.id_menu = pm.id_menu and po.id_product = pm.id_product
WHERE id_order = {$orders[$i]["id"]};
EOD;
            $orders[$i]["products"] = $this->db->query($qProducts)
                    ->result_array();
        }
        return $orders;
    }

    public function getBillsForDate($date, $idProvider, $idUser) {
        $qBills = <<<EOD
SELECT id, generated, paid, amount, comments, payment
FROM bills
WHERE date(generated) = '$date'
    AND id_provider = $idProvider
    AND id_user = $idUser;
EOD;
        $bills = $this->db->query($qBills)
                ->result_array();

        for ($i = 0; $i < count($bills); $i++) {
            $bills[$i]["orders"] = $this->getOrdersForBill($bills[$i]["id"]);
        }

        return $bills;
    }
}

/* End of file BillModel.php */
/* Location: ./application/models/BillModel.php */
