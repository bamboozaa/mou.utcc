<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Define sample department data
        $departments = [
            ['dep_name' => 'สำนักอำนวยการ', 'cost_center' => '20101'],
            ['dep_name' => 'สำนักบริหารทรัพยากรมนุษย์', 'cost_center' => '20102'],
            ['dep_name' => 'กองประชาสัมพันธ์', 'cost_center' => '20701'],
            ['dep_name' => 'กองวิเทศสัมพันธ์', 'cost_center' => '21001'],
            ['dep_name' => 'กองส่งเสริมการรับนักศึกษา', 'cost_center' => '20702'],
            ['dep_name' => 'ฝ่ายบริหาร', 'cost_center' => '20100'],
            ['dep_name' => 'กองการเงิน', 'cost_center' => '20104'],
            ['dep_name' => 'กองพัสดุและจัดการทรัพย์สิน', 'cost_center' => '20106'],
            ['dep_name' => 'กองบัญชีและควบคุมงบประมาณ', 'cost_center' => '20103'],
            ['dep_name' => 'กองอาคารและสิ่งแวดล้อม', 'cost_center' => '20105'],
            ['dep_name' => 'กองนิติการ', 'cost_center' => '20107'],
            ['dep_name' => 'ฝ่ายวางแผนและพัฒนา', 'cost_center' => '20300'],
            ['dep_name' => 'ฝ่ายเทคโนโลยีสารสนเทศ', 'cost_center' => '20500'],
            ['dep_name' => 'สำนักบริการคอมพิวเตอร์', 'cost_center' => '20501'],
            ['dep_name' => 'สำนักหอสมุดกลาง', 'cost_center' => '20502'],
            ['dep_name' => 'ฝ่ายกิจการนักศึกษา', 'cost_center' => '20600'],
            ['dep_name' => 'กองส่งเสริมศิลปะและวัฒนธรรม', 'cost_center' => '20604'],
            ['dep_name' => 'กองแนะแนวและศิษย์เก่าสัมพันธ์', 'cost_center' => '20603'],
            ['dep_name' => 'ฝ่ายวิชาการ', 'cost_center' => '20200'],
            ['dep_name' => 'สำนักทะเบียนและประมวลผล', 'cost_center' => '20201'],
            ['dep_name' => 'สำนักวิชาการ', 'cost_center' => '20203'],
            ['dep_name' => 'บัณฑิตวิทยาลัย', 'cost_center' => '10900'],
            ['dep_name' => 'คณะบริหารธุรกิจ', 'cost_center' => '10100'],
            ['dep_name' => 'คณะบัญชี', 'cost_center' => '10200'],
            ['dep_name' => 'คณะเศรษฐศาสตร์', 'cost_center' => '10300'],
            ['dep_name' => 'คณะมนุษยศาสตร์', 'cost_center' => '10400'],
            ['dep_name' => 'คณะวิทยาศาสตร์และเทคโนโลยี', 'cost_center' => '10500'],
            ['dep_name' => 'คณะนิเทศศาสตร์', 'cost_center' => '10600'],
            ['dep_name' => 'คณะวิศวกรรมศาสตร์', 'cost_center' => '10700'],
            ['dep_name' => 'คณะนิติศาสตร์', 'cost_center' => '10800'],
            ['dep_name' => 'ฝ่ายวิจัยและบริการธุรกิจ', 'cost_center' => '20400'],
            ['dep_name' => 'ศูนย์พยากรณ์เศรษฐกิจธุรกิจ', 'cost_center' => '20402'],
            ['dep_name' => 'ศูนย์ศึกษาการค้าระหว่างประเทศ', 'cost_center' => '20403'],
            ['dep_name' => 'ศูนย์ศึกษาธุรกิจครอบครัวและ SMEs', 'cost_center' => '20414'],
            ['dep_name' => 'ศูนย์บริการวิชาการ', 'cost_center' => '20401'],
            ['dep_name' => 'สำนักงานตรวจสอบภายใน', 'cost_center' => '20800'],
            ['dep_name' => 'ฝ่ายยุทธศาสตร์และกิจการพิเศษ', 'cost_center' => '20900'],
            ['dep_name' => 'วิทยาลัยนานาชาติเพื่อการจัดการ', 'cost_center' => '11000'],
            ['dep_name' => 'สถาบันวิจัยและพัฒนาโลจิสติกส์', 'cost_center' => '20407'],
            ['dep_name' => 'ฝ่ายสื่อสารการตลาด', 'cost_center' => '20700'],
            ['dep_name' => 'วิทยาลัยผู้ประกอบการ', 'cost_center' => '11100'],
            ['dep_name' => 'คณะวิทยพัฒน์', 'cost_center' => '11200'],
            ['dep_name' => 'คณะการท่องเที่ยวและอุตสาหกรรมบริการ', 'cost_center' => '11300'],
            ['dep_name' => 'IDE Center', 'cost_center' => '20415'],
            ['dep_name' => 'คณะการศึกษาปฐมวัย', 'cost_center' => '11400'],
            ['dep_name' => 'คณะศิลปะและการออกแบบดิจิทัล', 'cost_center' => '11500'],
            ['dep_name' => 'สำนักยุทธศาสตร์และ Data Analytics', 'cost_center' => '20901'],
            ['dep_name' => 'สำนักสวัสดิการนักศึกษา', 'cost_center' => '20607'],
            ['dep_name' => 'สำนักพัฒนานักศึกษา', 'cost_center' => '20606'],
            ['dep_name' => 'วิทยาลัยนานาชาติ ไทย-จีน เพื่อการจัดการ', 'cost_center' => '11600'],
            ['dep_name' => 'วิทยาลัยการศึกษาต่อเนื่อง', 'cost_center' => '11700'],
            ['dep_name' => 'ฝ่ายธุรกิจองค์กร', 'cost_center' => '21300'],
            ['dep_name' => 'สำนักศิษย์เก่าสัมพันธ์', 'cost_center' => '21301'],
            ['dep_name' => 'กองการตลาด', 'cost_center' => '20703'],
            ['dep_name' => 'ฝ่ายวิเทศสัมพันธ์', 'cost_center' => '21000'],
            // Add more departments as needed
        ];


        // Insert data into the departments table
        DB::table('departments')->insert($departments);
    }
}
