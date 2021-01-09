<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_type_id')->constrained()->comment('活動類別ID');
            $table->string('activity_no', 20)->comment('活動編號');
            $table->string('activity_name', 150)->comment('活動名稱');
            $table->datetime('apply_sdate')->comment('報名日期(起)');
            $table->datetime('apply_edate')->comment('報名日期(訖)');
            $table->datetime('activity_sdate')->comment('活動日期(訖)');
            $table->datetime('activity_edate')->comment('活動日期(訖)');
            $table->string('act_place', 100)->comment('活動地點');
            $table->string('act_content', 600)->comment('活動內容');
            $table->integer('apply_fee')->comment('報名費用');
            $table->string('identity', 20)->comment('參加身分別');
            $table->smallInteger('per_limit')->comment('人數上限');
            $table->string('host_unit', 50)->comment('主辦單位');
            $table->string('contact', 150)->comment('聯絡方式');
            $table->string('memo', 600)->nullable()->comment('備註');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
