<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMonitoringTables extends Migration
{
    public function up()
    {
        /*
         * TABEL: customers
         */
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'id_customer' => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'customer_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'plant' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('customers', true);

        /*
         * TABEL: models
         */
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'id_model' => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'model_name' => ['type' => 'VARCHAR', 'constraint' => 50],
            'customer_id' => ['type' => 'INT', 'null' => true],
            'year_masspro' => ['type' => 'INT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('models', true);

        /*
         * TABEL: machines
         */
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'id_machine' => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'machine_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'line_name' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('machines', true);

        /*
         * TABEL: part_lists
         */
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'part_no' => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'job_no' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'part_name' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'pack_qty' => ['type' => 'INT', 'null' => true],
            'part_status' => ['type' => "ENUM('rm','wip','fp')", 'null' => true],
            'routing_process' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'process' => ["type" => "ENUM('stamping','welding','others')", 'null' => true],
            'machine_id' => ['type' => 'INT', 'null' => true],
            'uph' => ['type' => 'INT', 'null' => true],
            'model_id' => ['type' => 'INT', 'null' => true],
            'customer_id' => ['type' => 'INT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('part_lists', true);

        /*
         * TABEL: forecasts
         */
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'part_no' => ['type' => 'VARCHAR', 'constraint' => 50],
            'forecast_month' => ['type' => 'CHAR', 'constraint' => 7],
            'forecast_qty' => ['type' => 'INT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('forecasts', true);

        /*
         * TABEL: deliveries
         */
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'part_no' => ['type' => 'VARCHAR', 'constraint' => 50],
            'delivery_date' => ['type' => 'DATE', 'null' => true],
            'delivery_qty' => ['type' => 'INT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('deliveries', true);

        /*
         * TABEL: production_plans
         */
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'part_no' => ['type' => 'VARCHAR', 'constraint' => 50],
            'plan_date' => ['type' => 'DATE', 'null' => true],
            'shift' => ['type' => "ENUM('1','2','3')", 'null' => true],
            'plan_qty' => ['type' => 'INT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('production_plans', true);

        /*
         * TABEL: production_actuals
         */
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'part_no' => ['type' => 'VARCHAR', 'constraint' => 50],
            'production_date' => ['type' => 'DATE', 'null' => true],
            'shift' => ['type' => "ENUM('1','2','3')", 'null' => true],
            'production_qty' => ['type' => 'INT', 'null' => true],
            'problem' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('production_actuals', true);

        /*
         * TABEL: problems
         */
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'production_actual_id' => ['type' => 'INT', 'null' => true],
            'problem_date' => ['type' => 'DATE', 'null' => true],
            'problem_desc' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('problems', true);

        /*
         * TABEL: stocks
         */
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'part_no' => ['type' => 'VARCHAR', 'constraint' => 50],
            'stock_date' => ['type' => 'DATE', 'null' => true],
            'stock_qty' => ['type' => 'INT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('stocks', true);

        // Tambahkan FK
        $this->forge->addColumn('models', [
            'CONSTRAINT fk_models_customer_id FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL ON UPDATE CASCADE'
        ]);

        $this->forge->addColumn('part_lists', [
            'CONSTRAINT fk_part_lists_machine_id FOREIGN KEY (machine_id) REFERENCES machines(id) ON DELETE SET NULL ON UPDATE CASCADE',
            'CONSTRAINT fk_part_lists_model_id FOREIGN KEY (model_id) REFERENCES models(id) ON DELETE SET NULL ON UPDATE CASCADE',
            'CONSTRAINT fk_part_lists_customer_id FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL ON UPDATE CASCADE'
        ]);

        $this->forge->addColumn('forecasts', [
            'CONSTRAINT fk_forecasts_part_no FOREIGN KEY (part_no) REFERENCES part_lists(part_no) ON DELETE CASCADE ON UPDATE CASCADE'
        ]);
        $this->forge->addColumn('deliveries', [
            'CONSTRAINT fk_deliveries_part_no FOREIGN KEY (part_no) REFERENCES part_lists(part_no) ON DELETE CASCADE ON UPDATE CASCADE'
        ]);
        $this->forge->addColumn('production_plans', [
            'CONSTRAINT fk_prod_plans_part_no FOREIGN KEY (part_no) REFERENCES part_lists(part_no) ON DELETE CASCADE ON UPDATE CASCADE'
        ]);
        $this->forge->addColumn('production_actuals', [
            'CONSTRAINT fk_prod_actuals_part_no FOREIGN KEY (part_no) REFERENCES part_lists(part_no) ON DELETE CASCADE ON UPDATE CASCADE'
        ]);
        $this->forge->addColumn('stocks', [
            'CONSTRAINT fk_stocks_part_no FOREIGN KEY (part_no) REFERENCES part_lists(part_no) ON DELETE CASCADE ON UPDATE CASCADE'
        ]);

        $this->forge->addColumn('problems', [
            'CONSTRAINT fk_problems_prod_actual_id FOREIGN KEY (production_actual_id) REFERENCES production_actuals(id) ON DELETE CASCADE ON UPDATE CASCADE'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('problems', true);
        $this->forge->dropTable('production_actuals', true);
        $this->forge->dropTable('production_plans', true);
        $this->forge->dropTable('deliveries', true);
        $this->forge->dropTable('forecasts', true);
        $this->forge->dropTable('stocks', true);
        $this->forge->dropTable('part_lists', true);
        $this->forge->dropTable('machines', true);
        $this->forge->dropTable('models', true);
        $this->forge->dropTable('customers', true);
    }
}
