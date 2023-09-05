<?php

require_once __DIR__ . '/./database.class.php';
class Invoice
{
        // The variable used in the constructor. An instance of the PDO object will be assigned to it.
        private $db;

        private int $user_id;
        private string $invoice_no;
        private int $invoice_id;

        /* CONSTRUCTOR
         * Connect to DB.
         * Assigns values to the object's private variables ($invoice_id only if the invoice already exists).
         */
        public function __construct(string $invoice_no , int $user_id)
        {
                // Connect to database
                // Assign the returned $db object (PDO instance) to the $this->db variable).
                $this->db = Database::getInstance()->getConnection();

                // Assign values to private variables.
                $this->invoice_no = $invoice_no;
                $this->user_id = $user_id;

                // Check if the invoice already exists, if so, assign its id to a private variable.
                if (gettype(self::get_invoice_id_if_exist()) === 'integer') $this->invoice_id = self::get_invoice_id_if_exist();
        }

        /* Return an invoice as associative array
         * Find invoices in DB.
         *
         * If found - returns an associative array with invoice information. The array with services is assigned to the key 'services'.
         * If it does not find - it returns an empty array.
         */
        public function get_invoice() : array
        {
                // Get invoice from DB.
                $invoice_query = $this->db->prepare("SELECT * FROM invoices
                        WHERE user_id = :user_id AND no = :invoice_no");
                $invoice_query->bindValue(':user_id' , $this->user_id , PDO::PARAM_INT);
                $invoice_query->bindValue(':invoice_no' , $this->invoice_no , PDO::PARAM_STR);
                $invoice_query->execute();
                $invoice = $invoice_query->fetch(PDO::FETCH_ASSOC);

                // If an invoice is found - create a new element (key) in the array and assign an array of services to it.
                if (!empty($invoice)) $invoice['services'] = self::get_services();

                // Return output.
                return !empty($invoice) ? $invoice : [];
        }

        /* Add invoice and services to DB
         *
         * It takes an associative array with invoice information as a parameter.
         * The array passed as a parameter must be consistent with the one returned by the get_invoice() method).
         *
         * Returns an associative array with invoice data (or an empty array) using the get_invoice() method.
         */
        public function add_invoice(array $invoice) : array
        {
                // If $invoice['services'] did not exist create it as an empty array.
                if (!isset($invoice['services'])) $invoice['services'] = [];

                // Insert invoice to DB.
                $add_query = $this->db->prepare("INSERT INTO invoices
                        (`user_id`,
                        `no`,
                        `date`,
                        `sum_net`,
                        `sum_gross`,
                        `city`,
                        `bank`,
                        `account_no`,
                        `payment_term`,
                        `to_pay`,
                        `to_pay_in_words`,
                        `additional_notes`,
                        `customer_name`,
                        `customer_address1`,
                        `customer_address2`,
                        `customer_company_no`,
                        `seller_name`,
                        `seller_address1`,
                        `seller_address2`,
                        `seller_company_no`)
                VALUES
                        (:user_id,
                        :no ,
                        :date,
                        :sum_net,
                        :sum_gross ,
                        :city,
                        :bank,
                        :account_no ,
                        :term,
                        :to_pay,
                        :to_pay_in_words,
                        :comment,
                        :customer_name,
                        :customer_address1,
                        :customer_address2,
                        :customer_company_no,
                        :seller_name,
                        :seller_address1,
                        :seller_address2,
                        :seller_company_no)");
                $add_query->bindvalue(':user_id', $this->user_id , PDO::PARAM_INT);
                $add_query->bindvalue(':no', $this->invoice_no, PDO::PARAM_STR);
                $add_query->bindvalue(':date', $invoice['date'], PDO::PARAM_STR);
                $add_query->bindvalue(':sum_net', $invoice['sum_net'], PDO::PARAM_STR);
                $add_query->bindvalue(':sum_gross', $invoice['sum_gross'], PDO::PARAM_STR);
                $add_query->bindvalue(':city', $invoice['city'], PDO::PARAM_STR);
                $add_query->bindvalue(':bank', $invoice['bank'], PDO::PARAM_STR);
                $add_query->bindvalue(':account_no', $invoice['account_no'], PDO::PARAM_STR);
                $add_query->bindvalue(':term', $invoice['payment_term'], PDO::PARAM_STR);
                $add_query->bindvalue(':to_pay',$invoice['to_pay'], PDO::PARAM_STR);
                $add_query->bindvalue(':to_pay_in_words',$invoice['to_pay_in_words'], PDO::PARAM_STR);
                $add_query->bindvalue(':comment', $invoice['additional_notes'], PDO::PARAM_STR);
                $add_query->bindvalue(':customer_name', $invoice['customer_name'], PDO::PARAM_STR);
                $add_query->bindvalue(':customer_address1', $invoice['customer_address1'], PDO::PARAM_STR);
                $add_query->bindvalue(':customer_address2', $invoice['customer_address2'], PDO::PARAM_STR);
                $add_query->bindvalue(':customer_company_no', $invoice['customer_company_no'], PDO::PARAM_STR);
                $add_query->bindvalue(':seller_name', $invoice['seller_name'], PDO::PARAM_STR);
                $add_query->bindvalue(':seller_address1', $invoice['seller_address1'], PDO::PARAM_STR);
                $add_query->bindvalue(':seller_address2', $invoice['seller_address2'], PDO::PARAM_STR);
                $add_query->bindvalue(':seller_company_no', $invoice['seller_company_no'], PDO::PARAM_STR);
                $add_query->execute();

                // Services are inserted in separate method
                self::add_services($invoice['services']);

                // Return an array which is ready tu use
                return self::get_invoice();
        }

        /* Updates invoice and service information in DB.
         *
         * It takes an associative array with invoice information as a parameter.
         * The array passed as a parameter must be consistent with the one returned by the get_invoice() method.
         */
        public function update_invoice(array $invoice) : void
        {
                // Assigns new values to the invoice.
                $update_invoice_query = $this->db->prepare("UPDATE invoices
                        SET
                                `date` = :date,
                                sum_net = :sum_net,
                                sum_gross = :sum_gross,
                                city = :city,
                                bank = :bank,
                                account_no = :account_no,
                                payment_term = :term,
                                to_pay = :to_pay_numeric,
                                to_pay_in_words = :to_pay_verbal,
                                additional_notes = :comment,
                                seller_name = :seller_name,
                                seller_address1 = :seller_address1,
                                seller_address2 = :seller_address2,
                                seller_company_no = :seller_company_no,
                                customer_name = :customer_name,
                                customer_address1 = :customer_address1,
                                customer_address2 = :customer_address2,
                                customer_company_no = :customer_company_no
                        WHERE
                                id = :invoice_id");
                $update_invoice_query->bindvalue(':date', $invoice['date'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':sum_net', $invoice['sum_net'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':sum_gross', $invoice['sum_gross'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':city', $invoice['city'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':bank', $invoice['bank'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':account_no', $invoice['account_no'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':term', $invoice['payment_term'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':to_pay_numeric',$invoice['to_pay'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':to_pay_verbal',$invoice['to_pay_in_words'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':comment', $invoice['additional_notes'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':seller_name', $invoice['seller_name'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':seller_address1', $invoice['seller_address1'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':seller_address2', $invoice['seller_address2'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':seller_company_no', $invoice['seller_company_no'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':customer_name', $invoice['customer_name'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':customer_address1', $invoice['customer_address1'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':customer_address2', $invoice['customer_address2'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':customer_company_no', $invoice['customer_company_no'], PDO::PARAM_STR);
                $update_invoice_query->bindvalue(':invoice_id', $this->invoice_id, PDO::PARAM_INT);
                $update_invoice_query->execute();

                // Services are updated in a separate method.
                self::update_services($invoice['services']);
        }

        /* Removes invoice and services from DB.
         */
        public function delete_invoice() : void
        {
                // Delete Invoice from DB.
                $delete_invoice_query = $this->db->prepare("DELETE FROM invoices
                        WHERE id = :id");
                $delete_invoice_query->bindValue(':id', $this->invoice_id, PDO::PARAM_INT);
                $delete_invoice_query->execute();

                // Deletes services assigned to an invoice.
                self::delete_services();
        }

        /* Get invoice services.
         */
        private function get_services() : array
        {
                // Get servies from DB.
                $services_query = $this->db->prepare("SELECT services.* FROM services
                        INNER JOIN
                                invoices ON services.invoice_id = invoices.id
                        WHERE
                                services.user_id = :user_id AND
                                invoices.no = :invoice_no");
                $services_query->bindvalue(':user_id', $this->user_id , PDO::PARAM_INT);
                $services_query->bindvalue(':invoice_no', $this->invoice_no , PDO::PARAM_STR);
                $services_query->execute();
                $services = $services_query->fetchAll(PDO::FETCH_ASSOC);

                // Return an array of services (each service is a separate array element).
                return $services;
        }

        /* Add services to DB.
         */
        private function add_services(array $services) : void
        {
                // Set the id of the newly created invoice
                $this->invoice_id = self::get_invoice_id_if_exist();

                // Assign each service as a separate record in the DB
                foreach($services as $service)
                {
                        $add_service_query = $this->db->prepare("INSERT INTO `services`(
                                        `user_id`,
                                        `invoice_id`,
                                        `position`,
                                        `service_name`,
                                        `service_code`,
                                        `quantity`,
                                        `item_net_price`,
                                        `service_tax`,
                                        `service_total_net`,
                                        `service_total_gross`)
                                VALUES (
                                        :user_id,
                                        :invoice_id,
                                        :position,
                                        :service_name,
                                        :service_code,
                                        :quantity,
                                        :item_net_price,
                                        :service_tax,
                                        :service_total_net,
                                        :service_total_gross
                        )");
                        $add_service_query->bindvalue(':user_id', $this->user_id, PDO::PARAM_INT);
                        $add_service_query->bindvalue(':invoice_id', $this->invoice_id, PDO::PARAM_INT);
                        $add_service_query->bindvalue(':position', $service['position'], PDO::PARAM_INT);
                        $add_service_query->bindvalue(':service_name', $service['service_name'], PDO::PARAM_STR);
                        $add_service_query->bindvalue(':service_code', $service['service_code'], PDO::PARAM_STR);
                        $add_service_query->bindvalue(':quantity', $service['quantity'], PDO::PARAM_INT);
                        $add_service_query->bindvalue(':item_net_price', $service['item_net_price'], PDO::PARAM_INT);
                        $add_service_query->bindvalue(':service_tax', $service['service_tax'], PDO::PARAM_INT);
                        $add_service_query->bindvalue(':service_total_net', $service['service_total_net'], PDO::PARAM_INT);
                        $add_service_query->bindvalue(':service_total_gross', $service['service_total_gross'], PDO::PARAM_INT);
                        $add_service_query->execute();
                }
        }

        /* Updates service information in DB.
         */
        private function update_services(array $services) : void
        {
                // Delete old services from DB.
                self::delete_services();

                // Insert updates services to DB.
                self::add_services($services);
        }

        /* Deletes services assigned to a given invoice.
         */
        private function delete_services() : void
        {
                $delete_services_query = $this->db->prepare("DELETE FROM services
                        WHERE invoice_id = :invoice_id");
                $delete_services_query->bindValue(':invoice_id', $this->invoice_id, PDO::PARAM_INT);
                $delete_services_query->execute();
        }

        /* Get invoice id if exist and returns it.
         */
        private function get_invoice_id_if_exist() : mixed
        {
                // Try to find invoice in DB.
                $invoice_id_query = $this->db->prepare("SELECT id FROM invoices
                        WHERE
                                no = :invoice_no AND
                                user_id = :user_id");
                $invoice_id_query->bindvalue(':invoice_no', $this->invoice_no, PDO::PARAM_STR);
                $invoice_id_query->bindvalue(':user_id', $this->user_id, PDO::PARAM_INT);
                $invoice_id_query->execute();

                // Return output. If the invoice was found it will return an integer, if not it will return false.
                return $invoice_id_query->fetchColumn();
        }
}
?>