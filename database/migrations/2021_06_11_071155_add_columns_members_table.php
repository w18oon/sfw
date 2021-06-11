<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('status', 10);
            $table->string('updated_by', 10);
            $table->string('field_1_1', 100)->comment('ข้อมูลส่วนตัว-คำนำหน้าชื่อ');
            $table->string('field_1_2', 100)->comment('ข้อมูลส่วนตัว-ชื่อ');
            $table->string('field_1_3', 100)->comment('ข้อมูลส่วนตัว-นามสกุล');
            $table->string('field_1_4', 100)->comment('ข้อมูลส่วนตัว-บัตรประจำตัวประชาชนเลขที่');
            $table->string('field_1_5', 100)->comment('ข้อมูลส่วนตัว-บัตรข้ารายการ/บัตรพนักงานรัฐวิสาหกิจเลขที่');
            $table->string('field_1_6', 100)->comment('ข้อมูลส่วนตัว-วันหมดอายุ');
            $table->string('field_1_7', 100)->comment('ข้อมูลส่วนตัว-อายุ');
            $table->string('field_1_8', 100)->comment('ข้อมูลส่วนตัว-สัญชาติ');
            $table->string('field_1_9', 100)->comment('ข้อมูลส่วนตัว-โทรศัพท์');
            $table->string('field_1_10', 100)->comment('ข้อมูลส่วนตัว-เป็นบุคคลล้มละลายหรือไม่');
            $table->string('field_1_11', 100)->comment('ข้อมูลส่วนตัว-คนไร้ความสามารถ');
            $table->string('field_1_12', 100)->comment('ข้อมูลส่วนตัว-ทุพพลภาพถาวร');
            $table->string('field_1_13', 100)->comment('ข้อมูลส่วนตัว-คนเสมือนไร้ความสามารถ');
            $table->string('field_1_14', 100)->comment('ข้อมูลส่วนตัว-สถานภาพสมรส');
            $table->string('field_1_15', 100)->comment('ข้อมูลส่วนตัว-จำนวนบุตร');
            $table->string('field_1_16', 100)->comment('ข้อมูลส่วนตัว-กำลังศึกษาอยู่');
            $table->string('field_1_17', 100)->comment('คู่สมรส-คำนำหน้าชื่อ');
            $table->string('field_1_18', 100)->comment('คู่สมรส-ชื่อ');
            $table->string('field_1_19', 100)->comment('คู่สมรส-นามสกุล');
            $table->string('field_1_20', 100)->comment('คู่สมรส-เลขที่บัตรประชาชน');
            $table->string('field_1_21', 100)->comment('คู่สมรส-บ้านเลขที่');
            $table->string('field_1_22', 100)->comment('คู่สมรส-หมู่ที่');
            $table->string('field_1_23', 100)->comment('คู่สมรส-ตรอก/ซอย');
            $table->string('field_1_24', 100)->comment('คู่สมรส-ถนน');
            $table->string('field_1_25', 100)->comment('คู่สมรส-ตำบล/แขวง');
            $table->string('field_1_26', 100)->comment('คู่สมรส-อำเภอ/เขต');
            $table->string('field_1_27', 100)->comment('คู่สมรส-จังหวัด');
            $table->string('field_1_28', 100)->comment('คู่สมรส-รหัสไปรษณีย์');
            $table->string('field_1_29', 100)->comment('คู่สมรส-โทรศัพท์');
            $table->string('field_1_30', 100)->comment('คู่สมรส-โทรสาร');
            $table->string('field_1_31', 100)->comment('คู่สมรส-อีเมล');
            $table->string('field_1_32', 100)->comment('ที่อยู่จัดส่งเอกสาร-บ้านเลขที่');
            $table->string('field_1_33', 100)->comment('ที่อยู่จัดส่งเอกสาร-หมู่ที่');
            $table->string('field_1_34', 100)->comment('ที่อยู่จัดส่งเอกสาร-ตรอก/ซอย');
            $table->string('field_1_35', 100)->comment('ที่อยู่จัดส่งเอกสาร-ถนน');
            $table->string('field_1_36', 100)->comment('ที่อยู่จัดส่งเอกสาร-ตำบล/แขวง');
            $table->string('field_1_37', 100)->comment('ที่อยู่จัดส่งเอกสาร-อำเภอ/เขต');
            $table->string('field_1_38', 100)->comment('ที่อยู่จัดส่งเอกสาร-จังหวัด');
            $table->string('field_1_39', 100)->comment('ที่อยู่จัดส่งเอกสาร-รหัสไปรษณีย์');
            $table->string('field_1_40', 100)->comment('ที่อยู่จัดส่งเอกสาร-โทรศัพท์');
            $table->string('field_1_41', 100)->comment('ที่อยู่จัดส่งเอกสาร-อีเมล');
            $table->string('field_1_42', 100)->comment('ที่อยู่จัดส่งเอกสาร-Line');
            $table->string('field_1_43', 100)->comment('ที่อยู่จัดส่งเอกสาร-Facebook');
            $table->string('field_1_44', 100)->comment('ที่อยู่อาศัยปัจจุบัน-ที่อยู่อาศัย');
            $table->string('field_1_45', 100)->comment('ที่อยู่อาศัยปัจจุบัน-ผ่อนชำระ/ค่าเช่า');
            $table->string('field_1_46', 100)->comment('ที่อยู่อาศัยปัจจุบัน-อาศัยอยู่เป็นเวลา');
            $table->string('field_1_47', 100)->comment('ระดับการศึกษาสูงสุด-ระดับการศึกษา');
            $table->string('field_1_48', 100)->comment('ระดับการศึกษาสูงสุด-อื่นๆ');
            $table->string('field_1_49', 100)->comment('สาขาอาชีพ-สาขาอาชีพ');
            $table->string('field_1_50', 100)->comment('สาขาอาชีพ-อื่นๆ');
            $table->string('field_2_1', 100)->comment('รายได้-รายได้ประจำ');
            $table->string('field_2_2', 100)->comment('รายได้-บาท/เดือน');
            $table->string('field_2_3', 100)->comment('รายได้-รายได้อื่นๆ');
            $table->string('field_2_4', 100)->comment('รายได้-รายได้อื่นๆ');
            $table->string('field_2_5', 100)->comment('รายได้-บาท/เดือน');
            $table->string('field_2_6', 100)->comment('รายได้-แหล่งที่มา');
            $table->string('field_3_1', 100)->comment('ภาระหนี้-ภาระหนี้กับสถาบันการเงิน/บริษัท/หนี้นอกระบบ');
            $table->string('field_4_1', 100)->comment('สถานที่ทำงาน-ชื่อสถานที่ทำงาน');
            $table->string('field_4_2', 100)->comment('สถานที่ทำงาน-อาคาร');
            $table->string('field_4_3', 100)->comment('สถานที่ทำงาน-ชั้น');
            $table->string('field_4_4', 100)->comment('สถานที่ทำงาน-แผนก/ฝ่าย');
            $table->string('field_4_5', 100)->comment('สถานที่ทำงาน-เลขที่');
            $table->string('field_4_6', 100)->comment('สถานที่ทำงาน-หมู่ที่');
            $table->string('field_4_7', 100)->comment('สถานที่ทำงาน-ตรอก/ซอย');
            $table->string('field_4_8', 100)->comment('สถานที่ทำงาน-ถนน');
            $table->string('field_4_9', 100)->comment('สถานที่ทำงาน-ตำบล/แขวง');
            $table->string('field_4_10', 100)->comment('สถานที่ทำงาน-อำเภอ/เขต');
            $table->string('field_4_11', 100)->comment('สถานที่ทำงาน-จังหวัด');
            $table->string('field_4_12', 100)->comment('สถานที่ทำงาน-รหัสไปรษณีย์');
            $table->string('field_4_13', 100)->comment('สถานที่ทำงาน-โทรศัพท์');
            $table->string('field_4_14', 100)->comment('สถานที่ทำงาน-โทรสาร');
            $table->string('field_4_15', 100)->comment('สถานที่ทำงาน-อายุงานปัจจุบัน');
            $table->string('field_4_16', 100)->comment('สถานที่ทำงาน-ชื่อตำแหน่งงาน');
            $table->string('field_4_17', 100)->comment('สถานที่ทำงาน-ชื่อสถานที่ทำงานเดิม');
            $table->string('field_5_1', 100)->comment('ผู้รับโอนผลประโยชน์-คำนำหน้าชื่อ');
            $table->string('field_5_2', 100)->comment('ผู้รับโอนผลประโยชน์-ชื่อ');
            $table->string('field_5_3', 100)->comment('ผู้รับโอนผลประโยชน์-นามสกุล');
            $table->string('field_5_4', 100)->comment('ผู้รับโอนผลประโยชน์-เลขที่บัตรประชาชน');
            $table->string('field_5_5', 100)->comment('ผู้รับโอนผลประโยชน์-มีความสัมพันธ์เป็น');
            $table->string('field_5_6', 100)->comment('ผู้รับโอนผลประโยชน์-บ้านเลขที่');
            $table->string('field_5_7', 100)->comment('ผู้รับโอนผลประโยชน์-หมู่ที่');
            $table->string('field_5_8', 100)->comment('ผู้รับโอนผลประโยชน์-ตรอก/ซอย');
            $table->string('field_5_9', 100)->comment('ผู้รับโอนผลประโยชน์-ถนน');
            $table->string('field_5_10', 100)->comment('ผู้รับโอนผลประโยชน์-ตำบล/แขวง');
            $table->string('field_5_11', 100)->comment('ผู้รับโอนผลประโยชน์-อำเภอ/เขต');
            $table->string('field_5_12', 100)->comment('ผู้รับโอนผลประโยชน์-จังหวัด');
            $table->string('field_5_13', 100)->comment('ผู้รับโอนผลประโยชน์-รหัสไปรษณีย์');
            $table->string('field_5_14', 100)->comment('ผู้รับโอนผลประโยชน์-โทรศัพท์');
            $table->string('field_5_15', 100)->comment('ผู้รับโอนผลประโยชน์-อีเมล');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('updated_by');
            $table->dropColumn('field_1_1');
            $table->dropColumn('field_1_2');
            $table->dropColumn('field_1_3');
            $table->dropColumn('field_1_4');
            $table->dropColumn('field_1_5');
            $table->dropColumn('field_1_6');
            $table->dropColumn('field_1_7');
            $table->dropColumn('field_1_8');
            $table->dropColumn('field_1_9');
            $table->dropColumn('field_1_10');
            $table->dropColumn('field_1_11');
            $table->dropColumn('field_1_12');
            $table->dropColumn('field_1_13');
            $table->dropColumn('field_1_14');
            $table->dropColumn('field_1_15');
            $table->dropColumn('field_1_16');
            $table->dropColumn('field_1_17');
            $table->dropColumn('field_1_18');
            $table->dropColumn('field_1_19');
            $table->dropColumn('field_1_20');
            $table->dropColumn('field_1_21');
            $table->dropColumn('field_1_22');
            $table->dropColumn('field_1_23');
            $table->dropColumn('field_1_24');
            $table->dropColumn('field_1_25');
            $table->dropColumn('field_1_26');
            $table->dropColumn('field_1_27');
            $table->dropColumn('field_1_28');
            $table->dropColumn('field_1_29');
            $table->dropColumn('field_1_30');
            $table->dropColumn('field_1_31');
            $table->dropColumn('field_1_32');
            $table->dropColumn('field_1_33');
            $table->dropColumn('field_1_34');
            $table->dropColumn('field_1_35');
            $table->dropColumn('field_1_36');
            $table->dropColumn('field_1_37');
            $table->dropColumn('field_1_38');
            $table->dropColumn('field_1_39');
            $table->dropColumn('field_1_40');
            $table->dropColumn('field_1_41');
            $table->dropColumn('field_1_42');
            $table->dropColumn('field_1_43');
            $table->dropColumn('field_1_44');
            $table->dropColumn('field_1_45');
            $table->dropColumn('field_1_46');
            $table->dropColumn('field_1_47');
            $table->dropColumn('field_1_48');
            $table->dropColumn('field_1_49');
            $table->dropColumn('field_1_50');
            $table->dropColumn('field_2_1');
            $table->dropColumn('field_2_2');
            $table->dropColumn('field_2_3');
            $table->dropColumn('field_2_4');
            $table->dropColumn('field_2_5');
            $table->dropColumn('field_2_6');
            $table->dropColumn('field_3_1');
            $table->dropColumn('field_4_1');
            $table->dropColumn('field_4_2');
            $table->dropColumn('field_4_3');
            $table->dropColumn('field_4_4');
            $table->dropColumn('field_4_5');
            $table->dropColumn('field_4_6');
            $table->dropColumn('field_4_7');
            $table->dropColumn('field_4_8');
            $table->dropColumn('field_4_9');
            $table->dropColumn('field_4_10');
            $table->dropColumn('field_4_11');
            $table->dropColumn('field_4_12');
            $table->dropColumn('field_4_13');
            $table->dropColumn('field_4_14');
            $table->dropColumn('field_4_15');
            $table->dropColumn('field_4_16');
            $table->dropColumn('field_4_17');
            $table->dropColumn('field_5_1');
            $table->dropColumn('field_5_2');
            $table->dropColumn('field_5_3');
            $table->dropColumn('field_5_4');
            $table->dropColumn('field_5_5');
            $table->dropColumn('field_5_6');
            $table->dropColumn('field_5_7');
            $table->dropColumn('field_5_8');
            $table->dropColumn('field_5_9');
            $table->dropColumn('field_5_10');
            $table->dropColumn('field_5_11');
            $table->dropColumn('field_5_12');
            $table->dropColumn('field_5_13');
            $table->dropColumn('field_5_14');
            $table->dropColumn('field_5_15');
        });
    }
}
