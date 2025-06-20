<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class CustomersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id_customer' => 'CADMP1', 'customer_name' => 'ADM Plant 1', 'plant' => 'Plant Alpha', 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['id_customer' => 'COTHR1', 'customer_name' => 'Other Customer', 'plant' => 'Plant Beta', 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['id_customer' => 'CATST1', 'customer_name' => 'Test Customer', 'plant' => 'Plant Gamma', 'created_at' => Time::now(), 'updated_at' => Time::now()],
        ];
        foreach ($data as $row) {
            $this->db->table('customers')->insert($row);
        }
    }
}

class MachinesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id_machine' => 'MWSSA1', 'machine_name' => 'WSS A1', 'line_name' => 'Line A', 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['id_machine' => 'MSTP1', 'machine_name' => 'STP Press 1', 'line_name' => 'Line B', 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['id_machine' => 'MWSSB2', 'machine_name' => 'WSS B2', 'line_name' => 'Line A', 'created_at' => Time::now(), 'updated_at' => Time::now()],
        ];
        foreach ($data as $row) {
            $this->db->table('machines')->insert($row);
        }
    }
}

class ModelsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id_model' => 'SUC2ID', 'model_name' => 'Hyundai Creta', 'customer_id' => 1, 'year_masspro' => 2023, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['id_model' => 'KWSPO1', 'model_name' => 'Kia Seltos', 'customer_id' => 1, 'year_masspro' => 2022, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['id_model' => 'OTHMDL', 'model_name' => 'Other Model', 'customer_id' => 2, 'year_masspro' => 2024, 'created_at' => Time::now(), 'updated_at' => Time::now()],
        ];
        foreach ($data as $row) {
            $this->db->table('models')->insert($row);
        }
    }
}

class PartListsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['part_no' => 'PN1001', 'job_no' => 'JB001', 'part_name' => 'Bracket A', 'pack_qty' => 10, 'part_status' => 'rm', 'routing_process' => 'stamping-welding-fp', 'process' => 'stamping', 'machine_id' => 1, 'uph' => 200, 'model_id' => 1, 'customer_id' => 1, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['part_no' => 'PN1002', 'job_no' => 'JB002', 'part_name' => 'Bracket B', 'pack_qty' => 20, 'part_status' => 'wip', 'routing_process' => 'stamping', 'process' => 'stamping', 'machine_id' => 3, 'uph' => 180, 'model_id' => 2, 'customer_id' => 1, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['part_no' => 'PN2001', 'job_no' => 'JB003', 'part_name' => 'Frame C', 'pack_qty' => 5, 'part_status' => 'fp', 'routing_process' => 'welding', 'process' => 'welding', 'machine_id' => 2, 'uph' => 150, 'model_id' => 3, 'customer_id' => 2, 'created_at' => Time::now(), 'updated_at' => Time::now()],
        ];
        foreach ($data as $row) {
            $this->db->table('part_lists')->insert($row);
        }
    }
}

class ForecastsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['part_no' => 'PN1001', 'forecast_month' => '2025-05', 'forecast_qty' => 500, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['part_no' => 'PN1002', 'forecast_month' => '2025-05', 'forecast_qty' => 300, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['part_no' => 'PN2001', 'forecast_month' => '2025-05', 'forecast_qty' => 150, 'created_at' => Time::now(), 'updated_at' => Time::now()],
        ];
        foreach ($data as $row) {
            $this->db->table('forecasts')->insert($row);
        }
    }
}

class DeliveriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['part_no' => 'PN1001', 'delivery_date' => '2025-05-01', 'delivery_qty' => 100, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['part_no' => 'PN1002', 'delivery_date' => '2025-05-02', 'delivery_qty' => 80, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['part_no' => 'PN2001', 'delivery_date' => '2025-05-01', 'delivery_qty' => 50, 'created_at' => Time::now(), 'updated_at' => Time::now()],
        ];
        foreach ($data as $row) {
            $this->db->table('deliveries')->insert($row);
        }
    }
}

class ProductionPlansSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['part_no' => 'PN1001', 'plan_date' => '2025-05-01', 'shift' => '1', 'plan_qty' => 200, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['part_no' => 'PN1002', 'plan_date' => '2025-05-01', 'shift' => '2', 'plan_qty' => 150, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['part_no' => 'PN2001', 'plan_date' => '2025-05-01', 'shift' => '3', 'plan_qty' => 100, 'created_at' => Time::now(), 'updated_at' => Time::now()],
        ];
        foreach ($data as $row) {
            $this->db->table('production_plans')->insert($row);
        }
    }
}

class ProductionActualsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['part_no' => 'PN1001', 'production_date' => '2025-05-01', 'shift' => '1', 'production_qty' => 190, 'problem' => null, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['part_no' => 'PN1002', 'production_date' => '2025-05-01', 'shift' => '2', 'production_qty' => 140, 'problem' => 'Minor stop', 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['part_no' => 'PN2001', 'production_date' => '2025-05-01', 'shift' => '3', 'production_qty' => 90, 'problem' => null, 'created_at' => Time::now(), 'updated_at' => Time::now()],
        ];
        foreach ($data as $row) {
            $this->db->table('production_actuals')->insert($row);
        }
    }
}

class ProblemsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['production_actual_id' => 2, 'problem_date' => '2025-05-01', 'problem_desc' => 'Minor stop due to jam', 'created_at' => Time::now(), 'updated_at' => Time::now()],
        ];
        foreach ($data as $row) {
            $this->db->table('problems')->insert($row);
        }
    }
}

class StocksSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['part_no' => 'PN1001', 'stock_date' => '2025-05-01', 'stock_qty' => 290, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['part_no' => 'PN1002', 'stock_date' => '2025-05-01', 'stock_qty' => 260, 'created_at' => Time::now(), 'updated_at' => Time::now()],
            ['part_no' => 'PN2001', 'stock_date' => '2025-05-01', 'stock_qty' => 190, 'created_at' => Time::now(), 'updated_at' => Time::now()],
        ];
        foreach ($data as $row) {
            $this->db->table('stocks')->insert($row);
        }
    }
}

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CustomersSeeder::class);
        $this->call(MachinesSeeder::class);
        $this->call(ModelsSeeder::class);
        $this->call(PartListsSeeder::class);
        $this->call(ForecastsSeeder::class);
        $this->call(DeliveriesSeeder::class);
        $this->call(ProductionPlansSeeder::class);
        $this->call(ProductionActualsSeeder::class);
        $this->call(ProblemsSeeder::class);
        $this->call(StocksSeeder::class);
    }
}
